<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        $project = urldecode($_POST["project"]);
        $dialog_data = json_decode( stripslashes($_POST["data"]) );
        //user account get login session
        $user_mail = $_POST["user_mail"];
        $draft = $_POST["draft"];
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
	ini_set( "memory_limit", "512M");

if( isset($user_mail) && !empty($user_mail) && isset($draft) && !empty($draft) ) {
        $next = (int)$contorl_table->select_AUTO_INCREMENT( "ttshow" , "examine" );
        //$file_src   = $server_website_path.$user_mail."\draft\\".iconv("UTF-8","BIG5",$project);
        $file_src   = $server_website_path.$user_mail."\draft\\".$draft;
        $file_move  = $server_examine_path.$next."\\";
        $SQL_photo_list = array();
        $photo_list = "{}";
        $movie_list = "{}";
        
        //get user_id ++
        $data = array(
            "facebook_mail" => $user_mail,
        );
        $data = $contorl_table->select_table_column( "user" , $data );
        if ($data->num_rows > 0) {
            $row = $data->fetch_assoc();
            $user_id = (int)$row["user_id"];
            //$user_class = (int)$row["channel_subordinate"];
        } else {
            $user_id = "undefined";
        }
        //get user_id --
     
        //file ++
        $process_file = Copy_folder( $file_src , $file_move );
        //process  move  img ++ 尚未考慮  其他http網址的圖片
        $data = array(
                "draft_id" => $draft,
                "user_id" => $user_id,
        );
        $data = $contorl_table->select_table_column( "draft" , $data );
        
        if ($data->num_rows > 0) {
            // output data of each row
            while($row = $data->fetch_assoc()) {
                //process path data
                $photo_list = json_decode($row["photo_list"]);
                $movie_list = json_decode($row["movie_list"]);
                $name = $row["name"];
            }
        }

        if( json_encode($photo_list) != "{}" ) {
                foreach ($photo_list as $key => $value) {
                    $time = getdate();
                    $time = $time[0]."_".$key;
                    $fileName = substr( $value , strrpos($value, "/")+1 , strlen($value)+1-strrpos($value, "/") );
                    copy( $value , $file_move.$fileName);
                    $SQL_photo_list["\"".$key."\""] = $fileName;
                }
                $SQL_photo_list = json_encode($SQL_photo_list);
                $SQL_photo_list = str_replace("\\\"","", $SQL_photo_list);
        } else {
                $SQL_photo_list = "{}";
        }

        if( $dialog_data->{'article_icon'} != "undefined" ) {
                $fileName = substr( $dialog_data->{'article_icon'} , strrpos($dialog_data->{'article_icon'}, "/")+1 , strlen($dialog_data->{'article_icon'})+1-strrpos($dialog_data->{'article_icon'}, "/") );
                copy( $dialog_data->{'article_icon'} , $file_move.$fileName);
                if( file_exists($file_move.$fileName) ) {
                        mkdir_trun_picture( $file_move.$fileName , $file_move , $fileName );
                }
        } else {
            $fileName = $dialog_data->{'article_icon'};
        }
        $process_file = "true";
        //process  move  img --
        
        //file --

        //SQL ++
        $time = date("Y-m-d H:i:s");
        $data = array(
            "examine_id" => $next,
            "user_id" => $user_id,
            "draft_id" => (int)$draft,
            "photo_list" => $SQL_photo_list ,
            "movie_list" => str_replace("\\\"","",json_encode($movie_list)),
            "name"       => $contorl_table->Check_mysqli_real_escape_string($name),
            "article_icon" => $fileName ,
            //"class" => $user_class ,
            //"tag" => $dialog_data->{'tag'} ,
            "tag" => "[]" ,
            "title" => $contorl_table->Check_mysqli_real_escape_string($dialog_data->{'title'}) ,
            "describe" => $contorl_table->Check_mysqli_real_escape_string($dialog_data->{'describe'}) ,
            "date" => $time ,
        );
        $process_sql = $contorl_table->table_add_insert("examine", $data);
        
        $data = array(
            "state"  => "check_ing"
        );
        $data2 = array(
            "user_id" => $user_id,
            "name"    => $name,
            "draft_id" => $draft,
        );
        $contorl_table->table_update( "draft",$data,$data2 );
        //SQL --
        
        if( $process_file == "true" && $process_sql == "true" ) {
            echo "true";
        } else {
            echo "false";
        } 

        
}        
        function mkdir_trun_picture( $src , $to , $fileName ) {
                $data = array(
                    array(
                        "path"  => $to."ThumbnailS",
                        "width" => 240,
                        "height" => 180
                    ),
                    array(
                        "path"  => $to."ThumbnailM",
                        "width" => 480,
                        "height" => 360
                    ),
                    array(
                        "path"  => $to."Preview",
                        "width" => 1920,
                        "height" => 1080
                    ),
                );
                
                $filetype = substr( $fileName , strrpos($fileName, ".")+1 , strlen($fileName)+1-strrpos($fileName, ".") );
            
                for( $i=0; $i<count($data); $i++ ) {
                        $old = umask(0); 
                        mkdir( $data[$i]["path"] , 0777 );
                        umask($old);
                        
                        list($width, $height) = getimagesize( $src );   

                        if( $data[$i]["width"]/$width > $data[$i]["height"]/$height )
                            $data[$i]["width"] = $width*$data[$i]["height"]/$height;
                        else if( $data[$i]["height"]/$height > $data[$i]["width"]/$width )
                            $data[$i]["height"] = $height*$data[$i]["width"]/$width;

                        $process_img = imagecreatetruecolor($data[$i]["width"], $data[$i]["height"]);
                        imagealphablending($process_img,false);                     
                        imagesavealpha($process_img,true);

                        if( $filetype === "gif" ) {
                            $source = imagecreatefromgif( $src );
                            imagesavealpha($source,true);
                            imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);
                            imagegif ( $process_img , $data[$i]["path"]."/".$fileName );
                        }
                        else if( $filetype === "jpeg" || $filetype === "jpg") {
                            $source = imagecreatefromjpeg( $src );
                            imagesavealpha($source,true);
                            imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);

                            imagejpeg( $process_img , $data[$i]["path"]."/".$fileName );
                        }
                        else if( $filetype === "png" ) {
                            $source = imagecreatefrompng( $src );
                            imagesavealpha($source,true);
                            imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);

                            imagepng ( $process_img , $data[$i]["path"]."/".$fileName );
                        }
                }

        }        
?>
