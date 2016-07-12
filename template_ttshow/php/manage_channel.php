<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        //check root ++
        $check = false;
        if( isset($_REQUEST["mail"]) && !empty($_REQUEST["mail"]) ) {
            $data = array(
                "email" => $_REQUEST["mail"],
            );
            $data = $contorl_table->select_table_column( "user" , $data );
            if ($data->num_rows == 1) {
                while($row = $data->fetch_assoc()) {
                    if( $row["usertype"] == "root" || $row["usertype"] == "boss" || $row["usertype"] == "manage" ) {
                        $check = true;
                    }
                }
            }
        }
        //check root --

        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) && $check) {
            switch ($_REQUEST["cmd"]) {
                case "list":
                    $json = list_channel( $contorl_table );
                    break;
                case "examine":
                    $json = examine_channel( $contorl_table , $_REQUEST["data"]);
                    break;
                case "delete":
                    $json = delete_channel( $contorl_table , $_REQUEST["data"]);
                    break;
                case "select":
                    $json = select_channel( $contorl_table , $_REQUEST["data"]);
                    break;
                case "modify":
                    $json = modify_channel( $contorl_table , $_REQUEST["data"]);
                    break;
                case "people":
                    $json = list_people( $contorl_table , $_REQUEST["data"]);
                    break;
                default:
                    break;
            }
        }
        
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            switch ($_REQUEST["cmd"]) {
                case "media_network_list":
                    $json = media_network_list( $contorl_table , $_REQUEST["data"]);
                    break;
                case "media_network_rank":
                    $json = media_network_rank( $contorl_table , $_REQUEST["data"]);
                    break;
                default:
                    break;
            }
        }
        
        
        echo json_encode( $json );
        
        function list_channel( $contorl_table ) {
            $cmd = "select *,a.registration_time channel_registration_time "
                  ."from channel as a join user as b "
                  ."on a.user_id = b.user_id "
                  ."where a.ch_examine = false "
                  ."order by channel_registration_time desc ";
            $data = $contorl_table->SQL_cmd( $cmd );
            if( $data->num_rows > 0 ) {
                    while($row = $data->fetch_assoc()) {
                            if( $row["ch_examine"] == "false" ) {
                                    $files[] = array(
                                        "id"     => $row["channel_id"],
                                        "username"   => $row["user_name"],
                                        "channelname"   => $row["ch_name"],
                                        "icon"   => $row["ch_icon"],
                                        "cover"   => $row["ch_cover"],
                                        "type"   => $row["ch_type"],
                                        "introduce"   => $row["ch_introduce"],
                                        "url"   => $row["ch_url"],
                                        "facebook"   => $row["facebook_url"],
                                        "youtube"   => $row["youtube_url"],
                                        "instagram"   => $row["instagram_url"],
                                        "other"   => $row["other_url"],
                                    );
                            }
                    }
            }
            return $files;
        }
        
        function examine_channel( $contorl_table , $jsonData ) {
            
                $data = array(
                    "ch_examine" => "true",
                );
                $data2 = array(
                    "channel_id" => (int)$jsonData{'id'},
                );
                $process_DB = $contorl_table->table_update( "channel" , $data,$data2 );
                
                ////////////////////////////////////////////////////////////////////////
                $data = $contorl_table->select_table_column( "channel" , $data2 );
                if ($data->num_rows == 1) {
                    while($row = $data->fetch_assoc()) {
                        $user_id = $row["user_id"];
                    }
                }
                if( $user_id )
                {
                    $data = $contorl_table->select_table_column( "user" , array("user_id" => (int)$user_id) );
                    if ($data->num_rows == 1) {
                        while($row = $data->fetch_assoc()) {
                            $usertype = $row["usertype"];
                            
                            if( $usertype === "" )
                            {
                                $contorl_table->table_update( "user" , array("usertype" => "editor"),array("user_id" => (int)$user_id) );
                            }
                            
                        }
                    }
                }
                
                ////////////////////////////////////////////////////////////////////////
                return $process_DB;
        }
        
        function delete_channel( $contorl_table , $jsonData ) {
                $data = array(
                    "usertype" => "freeze",
                );
                $data2 = array(
                    "user_id" => (int)$jsonData{'id'},
                );
                $process_DB = $contorl_table->table_update( "user" , $data,$data2 );
                
                return $process_DB;
        }
        
        function select_channel( $contorl_table , $jsonData ) {
                //select account ++
                $data = array(
                    "user_id" => $jsonData{'id'},
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{'id'} = $row["user_id"];
                        $files{'type'} = $row["usertype"];
                    }
                } else {
                    $files = false;
                }
                //select account --
                
                return $files;
        }
        
        function modify_channel( $contorl_table , $jsonData ) {
                $data = array(
                    "usertype" => $jsonData{'manage'},
                );
                $data2 = array(
                    "user_id" => (int)$jsonData{'id'},
                );
                $process_DB = $contorl_table->table_update( "user" , $data,$data2 );
                
                return $process_DB;
        }
        
        function media_network_list( $contorl_table , $jsonData ) {
                $Range = 12;
                if( $jsonData["ch_type"] == "all" ) {
                        $cmd = "select * from channel "
                              ."LIMIT ".(int)$jsonData{'pageNumber'}.", ".$Range;                    
                } else {
                        $cmd = "select * from channel "
                              ."where ch_type = '".urldecode($jsonData["ch_type"])."' "
                              ."LIMIT ".(int)$jsonData{'pageNumber'}.", ".$Range;   
                }
                $data = $contorl_table->SQL_cmd( $cmd );
                if ($data->num_rows > 0) {
                    $files['success'] = "true";
                    while($row = $data->fetch_assoc()) {
                            $files["channel"][] = array(
                                "id"     => $row["channel_id"],
                                "username"   => $row["user_name"],
                                "channelname"   => $row["ch_name"],
                                "icon"   => $row["ch_icon"],
                                "cover"   => $row["ch_cover"],
                                "type"   => $row["ch_type"],
                                "introduce"   => $row["ch_introduce"],
                                "url"   => $row["ch_url"],
                                "facebook"   => $row["facebook_url"],
                                "youtube"   => $row["youtube_url"],
                                "instagram"   => $row["instagram_url"],
                                "other"   => $row["other_url"],
                            );
                    }
                } else {
                    $files = false;
                }
                return $files;
        }
        
        function media_network_rank( $contorl_table , $jsonData ) {
                $cmd = "select *,sum(b.c_num_click) as click "
                      ."from channel as a join page as b "
                      ."on a.channel_id = b.channel_id "
                      ."where a.channel_id != 0 "
                      ."GROUP BY a.channel_id order by click desc "
                      ." LIMIT 0, 5";
                
                $data = $contorl_table->SQL_cmd( $cmd );

                if ($data->num_rows > 0) {
                    $files['success'] = "true";
                    while($row = $data->fetch_assoc()) {
                            $files["rank"][] = array(
                                "id"     => $row["channel_id"],
                                "ch_name"   => $row["ch_name"],
                                "ch_icon"   => $row["ch_icon"],
                                "url"   => $row['ch_url'],
                                "click"   => $row['click'],
                            );
                    }
                } else {
                    $files = false;
                }
                
                return $files;
        }
?>
