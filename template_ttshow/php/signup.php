<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            switch ($_REQUEST["cmd"]) {
                case "addbyfb":
                    foreach ($_REQUEST as $key => $value)  
                    {  
                        $data{$key} = $value;
                    }  
                    $birthday = date( "Y-m-d" , (float)$data{'birthday'}/1000 + get_timezone_offset( 'UTC' , 'Asia/Krasnoyarsk' ) );
                    $json = add_account( $contorl_table , $data , $birthday , "fb" );
                    break;
                case "add":
                    foreach ($_REQUEST as $key => $value)  
                    {  
                        $data{$key} = $value;
                    }  
                    $birthday = date( "Y-m-d" , (float)$data{'birthday'}/1000 + get_timezone_offset( 'UTC' , 'Asia/Krasnoyarsk' ) );
                    $json = add_account( $contorl_table , $data , $birthday , "common" );
                    break;
                case "modify":
                    foreach ($_REQUEST as $key => $value)  
                    {  
                        $data{$key} = $value;
                    }
                    $json = modify_account( $contorl_table , $_REQUEST["data"] );
                    break;
                case "select":
                    $json = select_account( $contorl_table , $_REQUEST["data"] );
                    break;
                case "transient_file":
                    $filepath_o = $upload_transient_file.$_REQUEST['transient_file'];
                    if( file_exists($filepath_o) && $_REQUEST['transient_file'] != "" && isset($_REQUEST['transient_file']) && !empty($_REQUEST['transient_file']) ) {
                        unlink($filepath_o);
                    }
                    $json = true;
                    break;
                default:
                    break;
            }
        }
        echo json_encode( $json );
        
        function add_account( $contorl_table , $jsonData , $birthday , $way ) {
                
                global $server_website_path;
                global $upload_transient_file;
                
                if( $way === "fb" )
                {
                    $jsonData{'email'} = $jsonData{'facebook_mail'};
                }
                else if( $way === "common" )
                {
                    $jsonData{'facebook_mail'} = "";
                }
                //cheack email ++
                $data = array(
                        "email" => $jsonData{'email'},
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                        $json{'success'} = "false";
                        $json{'describe'} = "email";
                        return $json;
                }
                //cheack email --
           
                $next = $contorl_table->select_AUTO_INCREMENT( "ttshow" , "user" );
                //mkdir ++
                $dir_path = $server_website_path.$next;
                $dirName = array(
                        $dir_path ,
                        $dir_path."/Draft" ,
                        $dir_path."/Original" ,
                        $dir_path."/Preview" ,
                        $dir_path."/ThumbnailM" ,
                        $dir_path."/ThumbnailS" ,
                        $dir_path."/Profile" ,
                );
                for( $i=0 ; $i<count($dirName) ; $i++ ) {
                    if( !file_exists( $dirName[$i]."/" ) ) {
                        $old = umask(0); 
                        mkdir( $dirName[$i] , 0777 );
                        umask($old);
                    }
                }
                //mkdir --
                
                //process usericon  ++
                $usericon = "";//preinstall  usericon
                $icon_path = $upload_transient_file.$jsonData{'usericon'};
                
                $subname = substr( $jsonData{'usericon'} , strrpos( $jsonData{'usericon'} , ".")+1 , strlen( $jsonData{'usericon'} )+1-strrpos($jsonData{'usericon'}, ".") );
                $filepath = $server_website_path.$next."/Profile/profile.".$subname;

                if( file_exists($icon_path) && $jsonData{'usericon'} != "" && isset($jsonData{'usericon'}) && !empty($jsonData{'usericon'}) ) {
                        if ($handle = opendir($server_website_path.$next."/Profile/")) {
                            while ($entry = readdir($handle)) {
                                if( is_file( $server_website_path.$next."/Profile/".$entry ) ) {
                                    unlink( $server_website_path.$next."/Profile/".$entry );
                                }
                            }
                        }
                        closedir($handle);
                        copy( $icon_path , $filepath );
                        unlink($icon_path);
                        $usericon = "http://".$_SERVER["SERVER_NAME"]."/ttshow/account/".$next."/Profile/profile.".$subname;
                } else if( $jsonData{'usericon'} != "" && isset($jsonData{'usericon'}) && !empty($jsonData{'usericon'}) ) {
                        $usericon = $jsonData{'usericon'};
                }
                //process usericon  --
                $time = date("Y-m-d H:i:s");
                
                $email_confirm = ( $way == "fb" ) ? "2" : "";
                
                $data = array(
                    "usericon" => $usericon,
                    "facebook_mail" => $jsonData{'facebook_mail'},
                    "email" => $jsonData{'email'},
                    "password" => $jsonData{'paw'},
                    "user_name" => $jsonData{'nickname'},
                    "birthday" => $birthday,
                    "sex" => $jsonData{'sex'},
                    "residence" => $jsonData{'address'},
                    "phone" => $jsonData{'phone'},
                    "registration_time" => $time,
                    "email_confirm" => $email_confirm
                );
                $process_DB = $contorl_table->table_add_insert("user", $data);
                
                if( $process_DB == "false" ) {
                    if( $dir_path != $server_website_path && is_dir( $dir_path ) ) {
                        rrmdir( $dir_path );
                    }
                }
                $json{"success"} = $process_DB;
                
                return $json;
        }

        function modify_account( $contorl_table , $jsonData ) {
                
                global $server_website_path;
                global $upload_transient_file;
                
                //get user_id ++
                $data = array(
                    "email" => $jsonData{'email'},
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                    $row = $data->fetch_assoc();
                    $user_id = (int)$row["user_id"];
                } else {
                    $user_id = "undefined";
                }
                //get user_id --
                
                $data = array(
                    "email" => $jsonData{'email'},
                    "user_name" => $jsonData{'name'},
                    "birthday" => $jsonData{'birthday'},
                    "sex" => $jsonData{'sex'},
                    "residence" => $jsonData{'residence'}
                );
                    
                //process usericon  ++
                if( $jsonData{'usericon'} == "" ) {
                        $data{"usericon"} = "";//preinstall  usericon
                } 
                else if( $jsonData{'usericon'} != "default" && $user_id != "undefined" ) {
                        //$icon_path = $upload_transient_file.$jsonData{'usericon'};
                        $icon_path = $server_website_path.$user_id."/Original/".$jsonData{'usericon'};
                        $subname = substr( $jsonData{'usericon'} , strrpos( $jsonData{'usericon'} , ".")+1 , strlen( $jsonData{'usericon'} )+1-strrpos($jsonData{'usericon'}, ".") );
                        $filepath = $server_website_path.$user_id."/Profile/profile.".$subname;
                        
                        if( file_exists($icon_path) && $jsonData{'usericon'} != "" && isset($jsonData{'usericon'}) && !empty($jsonData{'usericon'}) ) {
                                if ($handle = opendir($server_website_path.$user_id."/Profile/")) {
                                    while ($entry = readdir($handle)) {
                                        if( is_file( $server_website_path.$user_id."/Profile/".$entry ) ) {
                                            unlink( $server_website_path.$user_id."/Profile/".$entry );
                                        }
                                    }
                                }
                                closedir($handle);
                                copy( $icon_path , $filepath );
                                //unlink($icon_path);
                                $data{"usericon"} = "http://".$_SERVER["SERVER_NAME"]."/ttshow/account/".$user_id."/Profile/profile.".$subname;
                        }
                }
                //process usericon  --
                
                $data2 = array(
                    "email" => $jsonData{'email'},
                );
                $process_DB = $contorl_table->table_update( "user",$data,$data2 );
                
                //print_r($data);
                //print_r($data2);;
                
                $json{"success"} = $process_DB;
                
                return $json;
        }
        
        function select_account( $contorl_table , $jsonData ) {
                //cheack email ++
                $data = array(
                        "email" => $jsonData{'email'},
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows == 1) {
                        while($row = $data->fetch_assoc()) {
                                $json{'user_name'} = $row["user_name"];
                                $json{'usericon'} = $row["usericon"];
                                $json{'sex'} = $row["sex"];
                                $json{'usertype'} = $row["usertype"];
                                $json{'email'} = $row["email"];
                                $json{'birthday'} = $row["birthday"];
                                $json{'phone'} = $row["phone"];
                                $json{'residence'} = $row["residence"];
                                $json{'registration_time'} = $row["registration_time"];
                                $json{'last_login_time'} = $row["last_login_time"];
                        }
                        return $json;
                }
                //cheack email --
        }
        
        function get_timezone_offset($remote_tz, $origin_tz = null) {
                if($origin_tz === null) {
                    if(!is_string($origin_tz = date_default_timezone_get())) {
                        return false; // A UTC timestamp was returned -- bail out!
                    }
                }
                $origin_dtz = new DateTimeZone($origin_tz);
                $remote_dtz = new DateTimeZone($remote_tz);
                $origin_dt = new DateTime("now", $origin_dtz);
                $remote_dt = new DateTime("now", $remote_dtz);
                $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
                
                return $offset;
        }
?>
