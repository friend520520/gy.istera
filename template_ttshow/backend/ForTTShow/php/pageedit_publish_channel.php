<?php 
        include("SQL_table_control.php");
        include("global.php");
        
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        //$project = urldecode($_POST["project"]);
        //$dialog_data = json_decode( stripslashes($_POST["data"]) );
        
        $contorl_table->init_DBconnect($SQL_host, $SQL_account, $SQL_password, "ttshow");
	ini_set( "memory_limit", "512M");
        
        $user_mail = $_REQUEST["user_mail"];
        
        //get user_id ++
        $data = array(
            "facebook_mail" => $user_mail,
        );
        $data = $contorl_table->select_table_column( "user" , $data );
        if ($data->num_rows > 0) {
            $row = $data->fetch_assoc();
            $user_id = (int)$row["user_id"];
        } else {
            $user_id = "undefined";
        }
        //get user_id --

        //mkdir ++
        $next = $contorl_table->select_AUTO_INCREMENT( "ttshow" , "page" );
        $page_path = $server_page_path.$next."/";
        
        $dirName = array(
                $page_path ,
                $page_path."/Original" ,
                $page_path."/Preview" ,
                $page_path."/ThumbnailM" ,
                $page_path."/ThumbnailS" ,
        );
        for( $i=0 ; $i<count($dirName) ; $i++ ) {
            if( !file_exists( $dirName[$i]."/" ) ) {
                mkdir( $dirName[$i] , "0777" );
            }
        }
        //mkdir -- 
       
        //process pageicon  ++        
        if( $_REQUEST["icon"] != "" && isset($_REQUEST["icon"]) && !empty($_REQUEST["icon"]) ) {
                $filepath_o = $upload_transient_file.$_REQUEST["icon"];
                $subname = substr( $_REQUEST["icon"] , strrpos( $_REQUEST["icon"] , ".")+1 , strlen( $_REQUEST["icon"] )+1-strrpos($_REQUEST["icon"], ".") );
                $filepath_to = $page_path."Original/pagicon.".$subname;
                if( file_exists($filepath_o) ) {
                        copy( $filepath_o , $filepath_to );
                        //unlink($icon_path);
                        mkdir_trun_picture( $filepath_to , $page_path , "pagicon.".$subname );
                        $pageicon = "pagicon.".$subname;
                }
        }
        //process pageicon  -- 

        //process img  ++
        if( $_REQUEST["data"] != "" && isset($_REQUEST["data"]) && !empty($_REQUEST["data"]) ) {
            $content_data = json_decode( stripslashes($_REQUEST["data"]) );
            foreach ( $content_data as $key => $value) {
                if( $key == "img" ) {
                    foreach ( $value as $key => $value) {
                        $subname = substr( $value , strrpos( $value , ".")+1 , strlen( $value )+1-strrpos($value, ".") );
                        $time = udate('YmdHisu');
                        $sql_photo_list->$key = $time.".".$subname;
                        copy( $value , $page_path."image_".$key.".".$subname );
                    }
                } else if( $key == "movie" ){
                    $sql_movie_list = json_encode($value);
                }
            }
        }
        $sql_photo_list = json_encode( $sql_photo_list );
        //process img  --
        
        //process file  ++
        $html = stripslashes($_POST["html"]);
        $edit = stripslashes($_POST["edit"]);
        $content = stripslashes($_POST["content"]);
        $createData = array(
            array(
                path => $page_path,
                name => "index.html",
                content => $html,
            ),
            array(
                path => $page_path,
                name => "index.html.edit",
                content => $edit,
            ),
            array(
                path => $page_path,
                name => "index.html.publish",
                content => $content,
            ),
        );
        $process_file = PublishProject( $createData );
        //process file  --
        
        //sql ++
        $time = date("Y-m-d H:i:s");
        $data = array(
            "page_id" => $next,
            "user_id" => $user_id ,
            "channel_id" => $_REQUEST["channel"] ,
            "photo_list" => $sql_photo_list ,
            "movie_list" => $sql_movie_list,
            "article_icon" => $pageicon ,
            "c_num_click" => 0,
            "class" => (int)$_REQUEST["class"],
            "tag" => $_REQUEST["tag"],
            "title" => $_REQUEST["title"],
            "appraisal" => 0,
            "html" => mysql_real_escape_string($content),
            "date" => $time ,
        );
        $process_sql = $contorl_table->table_add_insert("page", $data);
        //sql --
        function mkdir_trun_picture( $src , $to , $fileName ) {
                $data = array(
                    array(
                        "path"  => $to."thumbnailS",
                        "width" => 240,
                        "height" => 180
                    ),
                    array(
                        "path"  => $to."thumbnailM",
                        "width" => 480,
                        "height" => 360
                    ),
                    array(
                        "path"  => $to."preview",
                        "width" => 1920,
                        "height" => 1080
                    ),
                );
                
                $filetype = substr( $fileName , strrpos($fileName, ".")+1 , strlen($fileName)+1-strrpos($fileName, ".") );
            
                for( $i=0; $i<count($data); $i++ ) {
                        //mkdir( $data[$i]["path"], 0777);
                        
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
                            imagegif ( $process_img , $data[$i]["path"]."//".$fileName );
                        }
                        else if( $filetype === "jpeg" || $filetype === "jpg") {
                            $source = imagecreatefromjpeg( $src );
                            imagesavealpha($source,true);
                            imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);

                            imagejpeg( $process_img , $data[$i]["path"]."//".$fileName );
                        }
                        else if( $filetype === "png" ) {
                            $source = imagecreatefrompng( $src );
                            imagesavealpha($source,true);
                            imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);

                            imagepng ( $process_img , $data[$i]["path"]."//".$fileName );
                        }
                }

        }        
        
        function PublishProject( $data ) {
                for( $i=0; $i<count($data); $i++ ) {
                        $filepath = $data[$i]["path"].$data[$i]["name"];
                        if( file_exists($filepath) ) {
                            unlink( $filepath );
                        }
                        $file = fopen( $filepath  ,"x+"); //開啟檔案
                        //header("Content-Type:text/html; charset=utf-8");
                        fwrite($file , $data[$i]["content"]);
                        fclose($file);
                }
                return "true";
        }
        
        function udate($format = 'u', $utimestamp = null) {
                if (is_null($utimestamp))
                    $utimestamp = microtime(true);

                $timestamp = floor($utimestamp);
                $milliseconds = round(($utimestamp - $timestamp) * 1000000);

                return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
        }
?>
