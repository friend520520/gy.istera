<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        $user_mail = $_POST["user_mail"];
        //$path = $server_website_path.$user."\edit";
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
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
/*        
        $data = array(
            "user_id" => $user_id
        );
        $data = $contorl_table->select_table_column( "page" , $data );
*/        
        
        $cmd = "select * from page as a join category as b on a.class = b.id where a.user_id = ".$user_id;
        $data = $contorl_table->SQL_cmd( $cmd );
        
        
        if ($data->num_rows > 0) {
            // output data of each row
            while($row = $data->fetch_assoc()) {
                if( $row["article_icon"] != "undefined" ) {
                    $icon_path = "http://".$_SERVER["SERVER_NAME"]."/ttshow/web/data/".$row["page_id"]."/".$row["article_icon"];
                } else {
                    $icon_path = "undefined";
                }
                $row["name"] = urlencode($row["name"]);
                $files[] = array(
                    "icon_path" => $icon_path ,
                    "title" => $row["title"],
                    "describe" => urlencode($row["describe"]),
                    "class" => $row["name"],
                    "time" => $row["date"],
                );
            }
            echo json_encode( $files );
        } else {
            echo "false";
        }
/*        
        $data =  ListProject( $project , $html , $edit );
        if( $data == null ) {
                echo "false";
        } else {
                echo $output = $json->encode( YPAjaxJson_init_Children($data) );
        }
                
        function ListProject() {
            global $path;
            $handle = opendir( $path ); 
            while (($file = readdir($handle)) !== false) {
                if ($file == '.' || $file == '..') { 
                    continue;
                } 
                $filepath = $path == '.' ? $file : $path . '/' . $file; 
                if (is_link($filepath)) {
                    continue;
                }
                if (is_file($filepath)) {
                    $filepath = str_replace("/","\\",$filepath);
                    $files[] = array(
                        "type" => "file" ,
                        "path" => $filepath ,
                        "name" => urlencode( iconv("BIG5","UTF-8", substr( $filepath , strrpos($filepath, "\\")+1 , strlen($filepath)+1 - strrpos($filepath, "\\") ) ) )
                    );
                }
                else if (is_dir($filepath)) {
                    $filepath = str_replace("/","\\",$filepath);
                    $files[] = array(
                        "type" => "folder" ,
                        "path" => $filepath ,
                        "name" => urlencode( iconv("BIG5","UTF-8", substr( $filepath , strrpos($filepath, "\\")+1 , strlen($filepath)+1 - strrpos($filepath, "\\") ) ) )
                    );
                } 
            }
            closedir($handle); 
            return $files;
        }
*/        
?>