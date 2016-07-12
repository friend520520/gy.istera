<?php 
        ini_set('magic_quotes_gpc', 'On');
        
        include("config.php");
        include("emoji.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        settingUTCtime();
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        ini_set( "memory_limit", "512M");
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            switch ($_REQUEST["cmd"]) {
                case "edit":
                    foreach ($_REQUEST as $key => $value)  
                    {  
                        $jsonData{$key} = stripslashes($value);
                    }
                    $jsonData['ttshow'] = json_decode( stripslashes( $jsonData['ttshow'] ) );
                    $json = publish_edit( $contorl_table , $jsonData );
                    break;
                case "modify":
                    foreach ($_REQUEST as $key => $value)  
                    {
                        $jsonData{$key} = stripslashes($value);
                    }
                    $jsonData['ttshow'] = json_decode( stripslashes( $jsonData['ttshow'] ) );
                    $json = publish_modify( $contorl_table , $jsonData );
                    break;
                default:
                    break;
            }
        }
        echo json_encode( $json );
        
        function publish_edit( $contorl_table , $jsonData ) {
                $check = check_user( $contorl_table , $jsonData );
                if( !$check["success"] ) {
                        return $check;
                } 
                global $server_page_path;
                global $upload_transient_file;
                //mkdir ++
                $next = $contorl_table->select_AUTO_INCREMENT( "ttshow" , "page" );
                $page_path = $server_page_path.$next."/";
                $dirName = array(
                        $page_path ,
                        $page_path."Original" ,
                        $page_path."Preview" ,
                        $page_path."ThumbnailM" ,
                        $page_path."ThumbnailS" ,
                );
                for( $i=0 ; $i<count($dirName) ; $i++ ) {
                    if( !file_exists( $dirName[$i] ) ) {
                        $old = umask(0); 
                        mkdir( $dirName[$i] , 0777 );
                        umask($old);
                    }
                }
                //mkdir -- 
 
                //process pageicon  ++
                if( $jsonData["icon"] == "empty_picture" && isset($jsonData["icon"]) && !empty($jsonData["icon"]) ) {
                        $pageicon = "";
                        $data["article_icon"] = $pageicon;
                }
                if( $jsonData["icon"] != "" && isset($jsonData["icon"]) && !empty($jsonData["icon"]) ) {
                        $filepath_o = $upload_transient_file.$jsonData["icon"];
                        $subname = substr( $jsonData["icon"] , strrpos( $jsonData["icon"] , ".")+1 , strlen( $jsonData["icon"] )+1-strrpos($jsonData["icon"], ".") );
                        $filepath_to = $page_path."Original/pagicon.".$subname;
                        if( file_exists($filepath_o) ) {
                                copy( $filepath_o , $filepath_to );
                                //unlink($icon_path);
                                mkdir_trun_picture( $filepath_to , $page_path , "pagicon.".$subname );
                                $pageicon = "pagicon.".$subname;
                                $data["article_icon"] = $pageicon;
                        }
                }
                //process pageicon  -- 
     
                //process img  ++
                if( $jsonData["data"] != "" && isset($jsonData["data"]) && !empty($jsonData["data"]) ) {
                    $content_data = json_decode( stripslashes($jsonData["data"]) );
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
                if( $sql_photo_list == "null" ) {
                    $sql_photo_list = "{}";
                }
                //process img  --
                
                //process file  ++
                $html = stripslashes($jsonData["html"]);
                //echo $jsonData["edit"] . "  ";
                $edit = stripslashes($jsonData["edit"]);
                //echo $edit . "  ";
                $content = stripslashes($jsonData["content"]);
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
                /*$file_path = $page_path."index.html.edit";
                
                if(file_exists($file_path)){
                        $file = fopen( $file_path , "r");
                        $theData = fread($file, filesize($file_path));
                        echo $theData . "   ";
                        fclose($file);
                }*/
                //process file  --
                
                //check channel display++
                $channel_data = $contorl_table->select_table_column( "channel" , array( "channel_id" => (int)$jsonData["channel"] ) );
                if ($channel_data->num_rows == 1) {
                    while($row = $channel_data->fetch_assoc()) {
                        $display = $row["display"];
                    }
                }
                //check channel display--
                
                //sql ++
                $time = date("Y-m-d H:i:s");
                $data["page_id"] = $next;
                $data["user_id"] = $jsonData["ttshow"]->user_id;
                $data["channel_id"] = $jsonData["channel"];
                $data["photo_list"] = $sql_photo_list;
                $data["movie_list"] = $sql_movie_list;
                $data["c_num_click"] = 0;
                $data["class"] = (int)$jsonData["class"];
                $data["tag"] = str_replace ("'","\'", $jsonData["tag"] );
                $data["title"] = stripslashes($jsonData["title"]);
                $data["appraisal"] = 0;
                $data["html"] = $contorl_table->Check_mysqli_real_escape_string(emoji_unified_to_html($content));
                $data["display"] = $display;
                
                $data["date"] = $time;
                $process_sql = $contorl_table->table_add_insert("page", $data);
                //sql --
                $json["success"] = $process_sql;
                $json["page_id"] = $next;
                return $json;
        }
        
        function publish_modify( $contorl_table , $jsonData ) {
                $check = check_user( $contorl_table , $jsonData );
                if( !$check["success"] ) {
                        return $check;
                }
                
                global $server_page_path;
                global $upload_transient_file;
                $page_path = $server_page_path.$jsonData["page"]."/";
                
                //process pageicon  ++
                if( $jsonData["icon"] == "empty_picture" && isset($jsonData["icon"]) && !empty($jsonData["icon"]) ) {
                        $pageicon = "";
                        $data["article_icon"] = $pageicon;
                }
                else if( $jsonData["icon"] != "" && isset($jsonData["icon"]) && !empty($jsonData["icon"]) ) {
                        $filepath_o = $upload_transient_file.$jsonData["icon"];
                        $subname = substr( $jsonData["icon"] , strrpos( $jsonData["icon"] , ".")+1 , strlen( $jsonData["icon"] )+1-strrpos($jsonData["icon"], ".") );
                        $filepath_to = $page_path."Original/pagicon.".$subname;
                        if( file_exists($filepath_o) ) {
                                copy( $filepath_o , $filepath_to );
                                //unlink($icon_path);
                                mkdir_trun_picture( $filepath_to , $page_path , "pagicon.".$subname );
                                $pageicon = "pagicon.".$subname;
                                $data["article_icon"] = $pageicon;
                        }
                }
                //process pageicon  -- 
     
                //process img  ++
                if( $jsonData["data"] != "" && isset($jsonData["data"]) && !empty($jsonData["data"]) ) {
                    $content_data = json_decode( stripslashes($jsonData["data"]) );
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
                if( $sql_photo_list == "null" ) {
                    $sql_photo_list = "{}";
                }
                //process img  --

                //process file  ++
                $html = stripslashes($jsonData["html"]);
                $edit = stripslashes($jsonData["edit"]);
                $content = stripslashes($jsonData["content"]);
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
                              
                //sql ++;
                $time = date("Y-m-d H:i:s");
                $data["user_id"] = $jsonData["ttshow"]->user_id;
                $data["channel_id"] = $jsonData["channel"];
                $data["photo_list"] = $sql_photo_list;
                $data["movie_list"] = $sql_movie_list;
                //$data["c_num_click"] = 0;
                $data["class"] = (int)$jsonData["class"];
                $data["tag"] = stripslashes($jsonData["tag"]);
                $data["title"] = stripslashes($jsonData["title"]);
                $data["appraisal"] = 0;
                $data["html"] = $contorl_table->Check_mysqli_real_escape_string($content);
                //$data["date"] = $time;
                
                $data2 = array(
                    "page_id" => (int)$jsonData["page"]
                );
                
                $process_sql = $contorl_table->table_update( "page",$data,$data2 );
                //sql --

                $json["success"] = $process_sql;
                $json["page_id"] = $jsonData["page"];
                return $json;
        }
        
        function check_user( $contorl_table , $jsonData ) {
                $json["success"] = true;
                $json = select_user_type( $contorl_table , $jsonData );
                if( !$json["success"] ) {
                        return $json;
                } 
                
                if( $json["usertype"] == "" ) {
                        $json["msg"] = "尚未擁有頻道!!";
                        return $json;
                } else if ( $json["usertype"] == "editor" ) {
                        $check_channel = check_channel( $contorl_table , $jsonData );
                        if( !$check_channel["success"] ) {
                                return $check_channel;
                        }
                        $identity = check_user_identity( $contorl_table , $jsonData , $check_channel["ch"] );
                        if( !$identity["success"] ) {
                                return $identity;
                        }
                } else if ( $json["usertype"] == "root" || $json["usertype"] == "boss" || $json["usertype"] == "manage" ) {
                }
                return $json;
        }
         
        function check_channel( $contorl_table , $jsonData ) {
                $json["success"] = true;
                if( $jsonData['url'] == "true" )
                {   
                        $data = array(
                                "ch_url" => urldecode($jsonData['ch']) ,
                        );
                        $data = $contorl_table->select_table_column( "channel" , $data );
                        if ($data->num_rows > 0) {
                                $row = $data->fetch_assoc();
                                $json["ch"] = (int)$row["channel_id"];
                        } else {
                                $json["success"] = false;
                                $json["msg"] = "無此頻道連結!!";
                                return $json;
                        }
                }
                else if( $jsonData['url'] == "false" ) 
                {
                        $data = array(
                                "channel_id" => $jsonData['ch'],
                        );
                        $data = $contorl_table->select_table_column( "channel" , $data );
                        if ($data->num_rows > 0) {
                                $row = $data->fetch_assoc();
                                $json["ch"] = (int)$row["channel_id"];
                        } else {
                                $json["success"] = false;
                                $json["msg"] = "無此頻道連結!!";
                                return $json;
                        }
                }
                return $json;
        }
        
        function check_user_identity( $contorl_table , $jsonData , $channel_id ) {
                $json["success"] = true;
                $data = array(
                        "user_id" => $jsonData['ttshow']->user_id ,
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                        $row = $data->fetch_assoc();
                        $json["usertype"] = $row["usertype"];
                }
                
                if( $json["usertype"] == "editor" ) { 
                        $data = array(
                                "user_id" => $jsonData['ttshow']->user_id ,
                                "channel_id" => $channel_id ,
                        );
                        $data = $contorl_table->select_table_column( "channel_group" , $data );
                        if ($data->num_rows > 0) {
                                $row = $data->fetch_assoc();
                                $json["channel_usertype"] = $row["ch_usertype"];
                        } else {
                                $json["success"] = false;
                                $json["msg"] = "無管理此頻道權限";
                        }
                }
                return $json;
        }
/*
        function check_user_modify( $contorl_table , $jsonData ) {
                $json["success"] = true;
                
                global $server_page_path;
                //get ch ++
                $data = array(
                        "page_id" => $jsonData["page"] ,
                );
                $data = $contorl_table->select_table_column( "page" , $data );
                if ($data->num_rows > 0) {
                        $row = $data->fetch_assoc();
                        $json["ch"] = $row["channel_id"];
                }
                //get ch --
                
                $data = array(
                        "user_id" => $jsonData["ttshow"]->user_id ,
                        "channel_id" => $json["ch"] ,
                );
                $data = $contorl_table->select_table_column( "channel_group" , $data );
                if ($data->num_rows > 0) {
                        $row = $data->fetch_assoc();
                        //$json["ch_usertype"] = $row["ch_usertype"];
                } else {
                        $json["success"] = false;
                        $json["msg"] = "無編輯此文章權限";
                        return $json;
                }
                
                return $json;
        }
*/        
        function select_user_type( $contorl_table , $jsonData ) {
                $json["success"] = true;
                $data = array(
                        "user_id" => $jsonData['ttshow']->user_id ,
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                        $row = $data->fetch_assoc();
                        $json["usertype"] = $row["usertype"];
                } else {
                        $json["success"] = false;
                        $json["msg"] = "查無會員資料!!";
                }
                return $json;
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
        
        function removeEmoji($text) {

            $clean_text = "";

            // Match Emoticons
            $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
            $clean_text = preg_replace($regexEmoticons, '', $text);

            // Match Miscellaneous Symbols and Pictographs
            $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
            $clean_text = preg_replace($regexSymbols, '', $clean_text);

            // Match Transport And Map Symbols
            $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
            $clean_text = preg_replace($regexTransport, '', $clean_text);

            // Match Miscellaneous Symbols
            $regexMisc = '/[\x{2600}-\x{26FF}]/u';
            $clean_text = preg_replace($regexMisc, '', $clean_text);

            // Match Dingbats
            $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
            $clean_text = preg_replace($regexDingbats, '', $clean_text);

            return $clean_text;
        }
        
?>
