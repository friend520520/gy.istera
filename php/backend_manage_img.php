<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        ini_set( "memory_limit", "512M");
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            switch ($_REQUEST["cmd"]) {
                case "list":
                    foreach ($_REQUEST as $key => $value)  
                    {  
                        $jsonData{$key} = stripslashes($value);
                    }
                    $jsonData['ttshow'] = json_decode( stripslashes( $jsonData['ttshow'] ) );
                    $json = list_user_img( $contorl_table , $jsonData );
                    break;
                default:
                    break;
            }
        }
        echo json_encode( $json );
        
        function list_user_img( $contorl_table , $jsonData ) {
                global $server_website_path;
                $img_floder = $server_website_path.$jsonData["ttshow"]->user_id."/Original/";
                $files = scandir( $img_floder );
                unset($files[0]);
                unset($files[1]);
                $files["url"] = "http://".$_SERVER["SERVER_NAME"]."/ttshow/account/".$jsonData["ttshow"]->user_id."/Original/";
                return $files;
        }

?>
