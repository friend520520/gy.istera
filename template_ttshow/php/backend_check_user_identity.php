<?php 
        
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            switch ($_REQUEST["cmd"]) {
                case "init_edit":
                    foreach ($_REQUEST as $key => $value)  
                    {
                        $data{$key} = stripslashes($value);
                    }
                    $data['ttshow'] = json_decode( stripslashes( $data['ttshow'] ) );
                    $json = init_edit( $contorl_table , $data );
                    break;
                case "init_modify":
                    foreach ($_REQUEST as $key => $value)  
                    {
                        $data{$key} = stripslashes($value);
                    }
                    $data['ttshow'] = json_decode( stripslashes( $data['ttshow'] ) );
                    $json = init_modify( $contorl_table , $data );
                    break;
                default:
                    break;
            }
        }
        echo json_encode( $json );
        
        function init_edit( $contorl_table , $jsonData ) {
                $json = select_user_type( $contorl_table , $jsonData );
                if( !$json["success"] ) {
                        return $json;
                } 
                
                if( $json["usertype"] == "" ) {
                        $json["msg"] = "尚未擁有頻道!!";
                        return $json;
                } /*else if (  ) {
                        $check_channel = check_channel( $contorl_table , $jsonData );
                        if( !$check_channel["success"] ) {
                                return $check_channel;
                        }
                        $identity = check_user_identity( $contorl_table , $jsonData , $check_channel["ch"] );
                        if( !$identity["success"] ) {
                                return $identity;
                        }
                        $json["ch"] = $check_channel["ch"];
                        $json["tab"] = get_tab( $contorl_table , $json["usertype"] );
                        $json["channel"] = get_channel( $contorl_table , $jsonData['ttshow']->user_id , $json["usertype"]);
                        unset( $json["usertype"] );
                } */else if ( $json["usertype"] == "editor" || $json["usertype"] == "root" || $json["usertype"] == "boss" || $json["usertype"] == "manage" ) {
                        $check_channel = check_channel( $contorl_table , $jsonData );
                        $json["ch"] = $check_channel["ch"];
                        $json["tab"] = get_tab( $contorl_table , $json["usertype"] );
                        $json["channel"] = get_channel( $contorl_table , $jsonData['ttshow']->user_id , $json["usertype"] );
                        unset( $json["usertype"] );
                }
                return $json;
        }

        function init_modify( $contorl_table , $jsonData ) {
                $json = select_user_type( $contorl_table , $jsonData );
                if( !$json["success"] ) {
                        return $json;
                } 
                
                if( $json["usertype"] == "" ) {
                        $json["msg"] = "無編輯文章權限!!";
                        return $json;
                } else if ( $json["usertype"] == "editor" ) {
                        $identity = check_user_modify( $contorl_table , $jsonData );
                        if( !$identity["success"] ) {
                                return $identity;
                        }
                        $page = get_page_data($contorl_table, $jsonData);
                        if( !$page["success"] ) {
                                return $page;
                        }
                        $json["page"] = $page["page"];
                        $json["ch"] = $page["ch"];
                        $json["tab"] = get_tab( $contorl_table , $json["usertype"] );
                        $json["channel"] = get_channel( $contorl_table , $jsonData['ttshow']->user_id , $json["usertype"]);
                        unset( $json["usertype"] );
                } else if ( $json["usertype"] == "root" || $json["usertype"] == "boss" || $json["usertype"] == "manage" ) {
                        $page = get_page_data($contorl_table, $jsonData);
                        if( !$page["success"] ) {
                                return $page;
                        }
                        $json["page"] = $page["page"];
                        $json["ch"] = $page["ch"];
                        $json["tab"] = get_tab( $contorl_table , $json["usertype"] );
                        $json["channel"] = get_channel( $contorl_table , $jsonData['ttshow']->user_id , $json["usertype"] );                                
                        unset( $json["usertype"] );
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
        
        function get_page_data( $contorl_table , $jsonData ) {
                global $server_page_path;
                //check page ++
                $data = array(
                        "page_id" => $jsonData["page"] ,
                );
                $data = $contorl_table->select_table_column( "page" , $data );
                if ($data->num_rows > 0) {
                        $row = $data->fetch_assoc();
                        $ch = $row["channel_id"];
                        $page['icon'] = "http://".$_SERVER["SERVER_NAME"]."/ttshow/web/data/".$jsonData["page"]."/ThumbnailM/".$row["article_icon"];
                        $page['class'] = $row["class"];
                        $page['tag'] = $row["tag"];
                        $page['title'] = $row["title"];
                        $page['time'] = $row["date"];//publish time
                        $page['page'] = $jsonData["page"];
                        //$json["success"] = true;/*bohan07241408*/
                        //$page['file'] = $row["html"];/*bohan07241408*/
                        //$json["page"] = $page;/*bohan07241408*/
                        //$json["ch"] = $ch;/*bohan07241408*/
                        //return $json;/*bohan07241408*/
                } else {
                        $json["success"] = false;
                        $json["msg"] = "檔案已損毀";
                        return $json;
                }
                //check page --
                
                $file_path = $server_page_path.$jsonData["page"]."/index.html.edit";
                if(file_exists($file_path)){
                        $file = fopen( $file_path , "r");
                        while (!feof($file)) {
                            $value = $value.fgets($file);
                        }
                        fclose($file);
                        $json["success"] = true;
                        $page["file"] = $value;
                        $json["page"] = $page;
                        $json["ch"] = $ch;
                        return $json;
                }else{
                        $json["success"] = false;
                        $json["msg"] = "檔案已損毀";
                        return $json;
                }
        }
        
        function get_tab( $contorl_table , $usertype ) {
                if( $usertype == "root" || $usertype == "boss" || $usertype == "manage" || $usertype == "editor") {
                        $cmd = "select * "
                              ."from category "
                              ."where display = 'true' ORDER BY _order ASC ";
                        $data = $contorl_table->SQL_cmd( $cmd );
                        if ($data->num_rows > 0) {
                                while($row = $data->fetch_assoc()) {
                                    $json[] = array(
                                        "id" => $row["id"],
                                        "name" => $row["name"],
                                    );
                                }
                        }
                        return $json;
                }
        }
        
        function get_channel( $contorl_table , $user_id , $usertype) {
                if( $usertype == "root" || $usertype == "boss" || $usertype == "manage" ) {
                        $data = $contorl_table->select_table_column( "channel" , "" );
                        if ($data->num_rows > 0) {
                                while($row = $data->fetch_assoc()) {
                                    $json[] = array(
                                        "id" => $row["channel_id"],
                                        "name" => $row["ch_name"],
                                        "display" => $row["display"]
                                    );
                                }
                        }
                        return $json;
                } else if( $usertype == "editor" ) {
                        $cmd = "select * "
                              ."from channel_group as a join channel as b "
                              ."on a.channel_id = b.channel_id "
                              ."where a.user_id = ".$user_id." ";
                        $data = $contorl_table->SQL_cmd( $cmd );
                        if ($data->num_rows > 0) {
                                while($row = $data->fetch_assoc()) {
                                    $json[] = array(
                                        "id" => $row["channel_id"],
                                        "name" => $row["ch_name"],
                                        "display" => $row["display"]
                                    );
                                }
                        }
                        return $json;
                }       
        }
        
?>
