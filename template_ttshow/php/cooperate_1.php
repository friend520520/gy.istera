<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            foreach ($_REQUEST as $key => $value)  
            {
                $data{$key} = stripslashes($value);
                if( $key == "people" ) {
                        $data{$key} = $value;
                } else {
                        $data{$key} = stripslashes($value);
                }
            }
            $data['ttshow'] = json_decode( stripslashes( $data{'ttshow'} ) );
            switch ($_REQUEST["cmd"]) {
                case "add":
                    $json = add_cooperate( $contorl_table , $data );
                    break;
                case "modify":
                    $json = modify_cooperate( $contorl_table , $data , $user_message );
                    if( $json{"success"} == true ) {
                        $json = select_cooperate( $contorl_table , $data );
                    }
                    break;
                case "select":
                    $select = select_cooperate( $contorl_table , $data  );
                    if( $select != false ) {
                        $json = $select;
                    }
                    break;
                case "select_authority" : 
                    $select = select_authority( $contorl_table , $data );
                    if( $select != false ) {
                        $json = $select;
                    }
                    break;
                case "add_authority" : 
                        $select = add_authority( $contorl_table , $data );
                        if( $select != false ) {
                            $json = $select;
                        }
                    break;
                case "update_authority" : 
                        $select = update_authority( $contorl_table , $data );
                        if( $select != false ) {
                            $json = $select;
                        }
                    break;
                case "delete_authority" : 
                        $select = delete_authority( $contorl_table , $data );
                        if( $select != false ) {
                            $json = $select;
                        }
                    break;

                case "check_user_identity" : 
                        $check_channel = check_channel( $contorl_table , $data );
                        $select = check_user_identity( $contorl_table , $data , $check_channel["ch"]);
                        if( $select != false ) {
                            $json = $select;
                        }
                    break;
                default:
                    break;
            }
        }
        echo json_encode( $json );
        
        function add_cooperate( $contorl_table , $jsonData ) {
                
                global $server_channel_path;
                global $upload_transient_file;
                //cheack email ++
                $data = array(
                        "ch_url" => $jsonData{'url'},
                );
                $data = $contorl_table->select_table_column( "channel" , $data );
                if ($data->num_rows > 0) {
                        $json{'success'} = "false";
                        $json{'describe'} = "url";
                        return $json;
                }
                //cheack email --

                $next = $contorl_table->select_AUTO_INCREMENT( "ttshow" , "channel" );
                //mkdir ++
                $dir_path = $server_channel_path.$next;
                $dirName = array(
                        $dir_path ,
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
                
                //process icon  ++
                $icon = "";//preinstall  usericon
                $icon_path = $upload_transient_file.$jsonData{'icon'};
                $subname = substr( $jsonData{'icon'} , strrpos( $jsonData{'icon'} , ".")+1 , strlen( $jsonData{'icon'} )+1-strrpos($jsonData{'icon'}, ".") );
                $filepath = $server_channel_path.$next."/Profile/profile.".$subname;

                if( file_exists($icon_path) && $jsonData{'icon'} != "" && isset($jsonData{'icon'}) && !empty($jsonData{'icon'}) ) {
                        if ($handle = opendir($server_channel_path.$next."/Profile/")) {
                            while ($entry = readdir($handle)) {
                                if( is_file( $server_channel_path.$next."/Profile/".$entry ) ) {
                                    unlink( $server_channel_path.$next."/Profile/".$entry );
                                }
                            }
                        }
                        closedir($handle);
                        copy( $icon_path , $filepath );
                        unlink($icon_path);
                        $icon = "http://".$_SERVER["SERVER_NAME"]."/ttshow/channel/".$next."/Profile/profile.".$subname;
                }
                $icon = ( $icon === "" ) ? "http://ttshow.tw/images/logo.png" : $icon;
                //process icon  --

                //process cover  ++
                $cover = "";//preinstall  usericon
                $icon_path = $upload_transient_file.$jsonData{'cover'};
                $subname = substr( $jsonData{'cover'} , strrpos( $jsonData{'cover'} , ".")+1 , strlen( $jsonData{'cover'} )+1-strrpos($jsonData{'cover'}, ".") );
                $filepath = $server_channel_path.$next."/cover.".$subname;
                if( file_exists($icon_path) && $jsonData{'cover'} != "" && isset($jsonData{'cover'}) && !empty($jsonData{'cover'}) ) {
                        if ($handle = opendir($server_channel_path.$next."/")) {
                            while ($entry = readdir($handle)) {
                                if( is_file( $server_channel_path.$next."/".$entry ) ) {
                                    unlink( $server_channel_path.$next."/".$entry );
                                }
                            }
                        }
                        closedir($handle);
                        copy( $icon_path , $filepath );
                        unlink($icon_path);
                        $cover = "http://".$_SERVER["SERVER_NAME"]."/ttshow/channel/".$next."/cover.".$subname;
                }
                $cover = ( $cover === "" ) ? "http://ttshow.tw/images/logo.png" : $cover;
                //process cover  --
         
                
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
                
                $time = date("Y-m-d H:i:s");
                $data = array(
                    "user_id" => $user_id,
                    "ch_icon" => $icon,
                    "ch_cover" => $cover,
                    "ch_type" => $jsonData{'usertype'},
                    "ch_name" => $jsonData{'name'},
                    "ch_introduce" => $jsonData{'introduce'},
                    "ch_url" => $jsonData{'url'},
                    "facebook_url" => $jsonData{'facebook'},
                    "youtube_url" => $jsonData{'youtube'},
                    "instagram_url" => $jsonData{'instagram'},
                    "line_url" => $jsonData{'line'},
                    "pixnet_url" => $jsonData{'pixnet'},
                    "other_url" => $jsonData{'link_place'},
                            
                    "browser" => "all",
                    "allow_message" => "true",
                    "allow_subscribe" => "true",
                    "allow_search" => "true",
                    "get_message" => "all",
                    "get_statistics" => "all",
                            
                    "registration_time" => $time,
                    "ch_examine" => "false",
                );
                $process_DB = $contorl_table->table_add_insert("channel", $data);
                
                if( $process_DB == "false" ) {
                    if( $dir_path != $server_channel_path && is_dir( $dir_path ) ) {
                        rrmdir( $dir_path );
                    }
                } else {
                        $data = array(
                            "channel_id"  => $next,
                            "user_id"     => $user_id,
                            "ch_usertype" => "manage",
                        );
                        $contorl_table->table_add_insert("channel_group", $data);
                }
                $json{"success"} = $process_DB;
       
                return $json;
        }
        
        function select_cooperate( $contorl_table , $jsonData ) {
                $check = check_user( $contorl_table , $jsonData );
                if( !$check["success"] ) {
                        return $check;
                }

                if( $check["usertype"] == "boss" || $check["usertype"] == "manage" ) {
                        $channel_data{'manage_authority'} = true;
                } else if( $check["usertype"] == "editor" ) {
                        $ch = check_channel( $contorl_table , $jsonData );
                        $ch_usertype = check_user_in_channel_identity( $contorl_table , $jsonData , $ch["ch"] );
                        if( $ch_usertype["success"] && $ch_usertype["channel_usertype"] == "manage" ) {
                                $channel_data{'manage_authority'} = true;
                        }
                }
                
                $ch = check_channel( $contorl_table , $jsonData );

                if( $ch["success"] ) {
                        $data = array(
                                "channel_id" => $ch['ch'],
                        );
                        $data = $contorl_table->select_table_column( "channel" , $data );
                        if ($data->num_rows > 0) {
                                $row = $data->fetch_assoc();
                                $channel_data{'icon'} = $row["ch_icon"];
                                $channel_data{'cover'} = $row["ch_cover"];
                                $channel_data{'type'} = $row["ch_type"];
                                $channel_data{'name'} = $row["ch_name"];
                                $channel_data{'introduce'} = $row["ch_introduce"];
                                $channel_data{'url'} = $row["ch_url"];
                                $channel_data{'facebook_url'} = $row["facebook_url"];
                                $channel_data{'youtube_url'} = $row["youtube_url"];
                                $channel_data{'instagram_url'} = $row["instagram_url"];
                                $channel_data{'line_url'} = $row["line_url"];
                                $channel_data{'pixnet_url'} = $row["pixnet_url"];
                                $channel_data{'other_url'} = $row["other_url"];
                                $channel_data{'registration_time'} = $row["registration_time"];
                                $channel_data{'ch_work'} = $row["ch_work"];

                                $channel_data{'browser'} = $row["browser"];
                                $channel_data{'allow_message'} = $row["allow_message"];
                                $channel_data{'allow_subscribe'} = $row["allow_subscribe"];
                                $channel_data{'allow_search'} = $row["allow_search"];
                                $channel_data{'get_message'} = $row["get_message"];
                                $channel_data{'get_statistics'} = $row["get_statistics"];

                                $channel_data{'success'} = true;
                        } else {
                                $channel_data = false;
                        }
                        return $channel_data;
                }
                else {
                    return $ch;
                }
        }
        
        function modify_cooperate( $contorl_table , $jsonData ) {
                $check = check_user( $contorl_table , $jsonData );
                if( !$check["success"] ) {
                        return $check;
                } 
                $ch = check_channel( $contorl_table , $jsonData );
                
                global $server_channel_path;
                global $upload_transient_file;

                //process icon  ++
                $icon = $jsonData{'icon'};
                if( !strpos ($jsonData['icon'], "http") ){
                        $icon_path = $upload_transient_file.$jsonData{'icon'};
                        $subname = substr( $jsonData{'icon'} , strrpos( $jsonData{'icon'} , ".")+1 , strlen( $jsonData{'icon'} )+1-strrpos($jsonData{'icon'}, ".") );
                        $filepath = $server_channel_path.$ch["ch"]."/Profile/profile.".$subname;
                        if( file_exists($icon_path) && $jsonData{'icon'} != "" && isset($jsonData{'icon'}) && !empty($jsonData{'icon'}) ) {
                                if ($handle = opendir($server_channel_path.$ch["ch"]."/Profile/")) {
                                    while ($entry = readdir($handle)) {
                                        if( is_file( $server_channel_path.$ch["ch"]."/Profile/".$entry ) ) {
                                            unlink( $server_channel_path.$ch["ch"]."/Profile/".$entry );
                                        }
                                    }
                                }
                                closedir($handle);
                                copy( $icon_path , $filepath );
                                unlink($icon_path);
                                $icon = "http://".$_SERVER["SERVER_NAME"]."/ttshow/channel/".$ch["ch"]."/Profile/profile.".$subname;
                        }
                }
                //process icon  --
                
                //process cover  ++
                $cover = $jsonData{'cover'};
                if( !strpos ($jsonData['cover'], "http") ){
                        $icon_path = $upload_transient_file.$jsonData{'cover'};
                        $subname = substr( $jsonData{'cover'} , strrpos( $jsonData{'cover'} , ".")+1 , strlen( $jsonData{'cover'} )+1-strrpos($jsonData{'cover'}, ".") );
                        $filepath = $server_channel_path.$ch["ch"]."/cover.".$subname;
                        if( file_exists($icon_path) && $jsonData{'cover'} != "" && isset($jsonData{'cover'}) && !empty($jsonData{'cover'}) ) {
                                if ($handle = opendir($server_channel_path.$ch["ch"]."/")) {
                                    while ($entry = readdir($handle)) {
                                        if( is_file( $server_channel_path.$ch["ch"]."/".$entry ) ) {
                                            unlink( $server_channel_path.$ch["ch"]."/".$entry );
                                        }
                                    }
                                }
                                closedir($handle);
                                copy( $icon_path , $filepath );
                                unlink($icon_path);
                                $cover = "http://".$_SERVER["SERVER_NAME"]."/ttshow/channel/".$ch["ch"]."/cover.".$subname;
                        }  
                }
                //process cover  --
                
                $time = date("Y-m-d H:i:s");
                $data = array(
                    "ch_icon" => $icon,
                    "ch_cover" => $cover,
                    "ch_type" => $jsonData{'usertype'},
                    "ch_name" => $jsonData{'name'},
                    "ch_introduce" => $jsonData{'introduce'},
                    "facebook_url" => $jsonData{'facebook_url'},
                    "youtube_url" => $jsonData{'youtube_url'},
                    "instagram_url" => $jsonData{'instagram_url'},
                    "other_url" => $jsonData{'link_place'},
                            
                    "browser" => $jsonData{'browser'},
                    "allow_message" => $jsonData{'allow_message'},
                    "allow_subscribe" => $jsonData{'allow_subscribe'},
                    "allow_search" => $jsonData{'allow_search'},
                    "get_message" => $jsonData{'get_message'},
                    "get_statistics" => $jsonData{'get_statistics'},
                );
                $data2 = array(
                    "channel_id" => $ch["ch"],
                );
                $process_DB = $contorl_table->table_update( "channel" , $data,$data2 );

                
                $json{"success"} = $process_DB;
                return $json;
        }
        
        function select_authority( $contorl_table , $jsonData ) {
                $check = check_user( $contorl_table , $jsonData );
                if( !$check["success"] ) {
                        return $check;
                }
                
                $ch = check_channel( $contorl_table , $jsonData );
                if( $check["usertype"] == "editor" ) {
                        $ch_usertype = check_user_in_channel_identity( $contorl_table , $jsonData , $ch["ch"] );
                        if( !$ch_usertype["success"] ) {
                                return $ch_usertype;
                        }
                }
                $cmd = "select * "
                      ."from channel_group as a join channel as b join user as c "
                      ."on a.channel_id = b.channel_id AND a.user_id = c.user_id "
                      ."where a.channel_id = ".$ch["ch"]." ";
                $data = $contorl_table->SQL_cmd( $cmd );
                
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files[] = array(
                            "user_id" => $row["user_id"],
                            "usericon" => $row["usericon"],
                            "user_name" => $row["user_name"],
                            "last_login_time" => $row["last_login_time"],
                            "mail" => $row["facebook_mail"],
                            "type" => $row["ch_usertype"],
                        );
                    }
                }
                $json["success"] = true;
                $json["data"] = $files;
                        
                return $json;
        }
        
        function delete_authority( $contorl_table , $jsonData ) {
                $json["success"] = true;
                $check = check_user( $contorl_table , $jsonData );
                if( !$check["success"] ) {
                        return $check;
                }
                
                $ch = check_channel( $contorl_table , $jsonData );
                if( $check["usertype"] == "editor" ) {
                        $ch_usertype = check_user_in_channel_identity( $contorl_table , $jsonData , $ch["ch"] );
                        if( !$ch_usertype["success"] ) {
                                return $ch_usertype;
                        }
                }
                
                $delete_data = array(
                    "user_id" => $jsonData['id'],
                    "channel_id" => $ch['ch'],
                );
                $json["success"] = $contorl_table->table_delete("channel_group", $delete_data );
                return $json;
        }
        
        function add_authority( $contorl_table , $jsonData ) {
                $json["success"] = true;
                $check = check_user( $contorl_table , $jsonData );
                if( !$check["success"] ) {
                        return $check;
                }
                
                $ch = check_channel( $contorl_table , $jsonData );
                if( $check["usertype"] == "editor" ) {
                        $ch_usertype = check_user_in_channel_identity( $contorl_table , $jsonData , $ch["ch"] );
                        if( !$ch_usertype["success"] ) {
                                return $ch_usertype;
                        }
                }
                
                $data = array(
                        "facebook_mail" => $jsonData["mail"],
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                        $row = $data->fetch_assoc();
                        $user_id = $row["user_id"];
                } else {
                        $json["success"] = false;
                        $json["msg"] = "mail錯誤";
                        return $json;
                }
                
                
                $data = array(
                        "user_id" => $user_id,
                        "channel_id" => $ch["ch"],
                );
                $data = $contorl_table->select_table_column( "channel_group" , $data );
                if ($data->num_rows > 0) {
                        $json["success"] = false;
                        $json["msg"] = "使用者已存在";
                        return $json;
                }
                
                
                $data = array(
                    "user_id" => $user_id,
                    "channel_id" => $ch["ch"],
                    "ch_usertype" => $jsonData["type"],
                );
                $json["success"] = $contorl_table->table_add_insert("channel_group", $data);
                return $json;
        }
        
        function update_authority( $contorl_table , $jsonData ) {
                $json["success"] = true;
                $check = check_user( $contorl_table , $jsonData );
                if( !$check["success"] ) {
                        return $check;
                }
                
                $ch = check_channel( $contorl_table , $jsonData );
                if( $check["usertype"] == "editor" ) {
                        $ch_usertype = check_user_in_channel_identity( $contorl_table , $jsonData , $ch["ch"] );
                        if( !$ch_usertype["success"] ) {
                                return $ch_usertype;
                        }
                }
                
                for( $i=0;$i<count( $jsonData["people"] );$i++) {
                        $data = array(
                            "ch_usertype" => $jsonData["people"][$i]["type"]
                        );
                        $data2 = array(
                            "channel_id" => $ch["ch"],
                            "user_id" => $jsonData["people"][$i]["id"]
                        );
                        $json["success"] = $contorl_table->table_update( "channel_group" , $data,$data2 );
                }
                return $json;
        }
        
        function cheack_usertype( $contorl_table , $jsonData ) {
                $jsonData['ttshow'] = json_decode( stripslashes( $jsonData{'ttshow'} ) );
                //cheack usertype ++
                $usertype = "undefined";
                if( $jsonData['url'] == "true" ) 
                {
                        $data = array(
                                "ch_url" => $jsonData['ch'],
                        );
                        $data = $contorl_table->select_table_column( "channel" , $data );
                        if ($data->num_rows > 0) {
                                $row = $data->fetch_assoc();
                                $channel_id = (int)$row["channel_id"];
                                
                                
                                $return_data{'ch_id'} = $channel_id;
                        }
                        
                        $data = array(
                                "user_id" => $jsonData['ttshow']->user_id ,
                                "channel_id" => $channel_id ,
                        );
                        $data = $contorl_table->select_table_column( "channel_group" , $data );
                        if ($data->num_rows > 0) {
                                $row = $data->fetch_assoc();
                                $usertype = $row["ch_usertype"];
                        }
                } 
                else if( $jsonData['url'] == "false" ) 
                {
                        $data = array(
                                "user_id" => $jsonData['ttshow']->user_id ,
                                "channel_id" => $jsonData['ch'] ,
                        );
                        $data = $contorl_table->select_table_column( "channel_group" , $data );
                        if ($data->num_rows > 0) {
                                $row = $data->fetch_assoc();
                                $usertype = $row["ch_usertype"];
                                
                                
                                $return_data{'ch_id'} = $jsonData['ch'];
                        }
                }
                //cheack usertype --
                $return_data{'usertype'} = $usertype;
                return $return_data;
        }
        
        
        
        
        function check_user_in_channel_identity( $contorl_table , $jsonData , $channel_id ) {
                $json["success"] = true;
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
                
                if( $json["channel_usertype"] != "manage" ) {
                        $json["success"] = false;
                        $json["msg"] = "無管理此頻道權限";                    
                }
                
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
                $json["success"] = false;
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
                                $json["success"] = true;
                        } else {
                                $json["success"] = false;
                                $json["msg"] = "無管理此頻道權限";
                        }
                } else if( $json["usertype"] != "" ) {
                        $json["success"] = true;
                }
                return $json;
        }
        
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
