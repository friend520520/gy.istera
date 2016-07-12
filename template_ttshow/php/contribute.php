<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        
        date_default_timezone_set('Asia/Taipei');

        $contorl_table = new SQL_table_control();
        //settingUTCtime();
        
        //$project = urldecode($_POST["project"]);
        //$dialog_data = json_decode( stripslashes($_POST["data"]) );
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
	ini_set( "memory_limit", "512M");
        
        $user_id = $_REQUEST["user_id"];
        
        $con_type = $_REQUEST["con_type"];
        
        //mkdir ++
        $next = $contorl_table->select_AUTO_INCREMENT( "ttshow" , "contribute" );
        $contribute_path = $server_contribute_path.$next."/";
        
        $dirName = array(
                $contribute_path ,
                $contribute_path."/Original" ,
                $contribute_path."/Preview" ,
                $contribute_path."/ThumbnailM" ,
                $contribute_path."/ThumbnailS" ,
        );
        for( $i=0 ; $i<count($dirName) ; $i++ ) {
            if( !file_exists( $dirName[$i]."/" ) ) {
                $old = umask(0); 
                mkdir( $dirName[$i] , 0777 );
                umask($old);
            }
        }
        //mkdir -- 
       
        //process pageicon  ++        
        if( $con_type === "illustration" )
        {
            if( $_REQUEST["icon"] != "" && isset($_REQUEST["icon"]) && !empty($_REQUEST["icon"]) ) {
                    $filepath_o = $upload_transient_file.$_REQUEST["icon"];
                    $subname = substr( $_REQUEST["icon"] , strrpos( $_REQUEST["icon"] , ".")+1 , strlen( $_REQUEST["icon"] )+1-strrpos($_REQUEST["icon"], ".") );
                    $filepath_to = $contribute_path."Original/pagicon.".$subname;
                    if( file_exists($filepath_o) ) {
                            copy( $filepath_o , $filepath_to );
                            //unlink($icon_path);
                            mkdir_trun_picture( $filepath_to , $contribute_path , "pagicon.".$subname );
                            $pageicon = "pagicon.".$subname;
                    }
            }
        }
        else if( $con_type === "video" )
        {
            $pageicon = $_REQUEST["icon"];
        }
        
        //process pageicon  -- 

        //process img  ++
        /*if( $_REQUEST["data"] != "" && isset($_REQUEST["data"]) && !empty($_REQUEST["data"]) ) {
            $content_data = json_decode( stripslashes($_REQUEST["data"]) );
            foreach ( $content_data as $key => $value) {
                if( $key == "img" ) {
                    foreach ( $value as $key => $value) {
                        $subname = substr( $value , strrpos( $value , ".")+1 , strlen( $value )+1-strrpos($value, ".") );
                        $time = udate('YmdHisu');
                        $sql_photo_list->$key = $time.".".$subname;
                        copy( $value , $contribute_path."image_".$key.".".$subname );
                    }
                } else if( $key == "movie" ){
                    $sql_movie_list = json_encode($value);
                }
            }
        }
        $sql_photo_list = json_encode( $sql_photo_list );*/
        //process img  --
        
        //process file  ++
        $content = $_REQUEST["content"];
        
        $content = '<div class="container-full">' .
                        '<div class="row">' .
                            '<div hassortable="true" class="col-md-12">' .
                                $content .
                                $_REQUEST["html"] .
                            '</div>' .
                        '</div>' .
                    '</div>';
        /*$createData = array(
            array(
                path => $contribute_path,
                name => "index.html",
                content => $html,
            ),
            array(
                path => $contribute_path,
                name => "index.html.edit",
                content => $edit,
            ),
            array(
                path => $contribute_path,
                name => "index.html.publish",
                content => $content,
            ),
        );
        $process_file = PublishProject( $createData );*/
        //process file  --
        
        //sql ++
        $time = date("Y-m-d H:i:s");
        $data = array(
            "page_id" => $next,
            "user_id" => $user_id ,
            "article_icon" => $pageicon ,
            "c_num_click" => 0,
            "tag" => $_REQUEST["tag"],
            "title" => $_REQUEST["title"],
            "appraisal" => 0,
            "html" => $contorl_table->Check_mysqli_real_escape_string($content),
            "date" => $time ,
        );
        $process_sql = $contorl_table->table_add_insert("contribute", $data);
        echo $process_sql;
        //sql --
        
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
