<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        $check = true;
        /*
        //check root ++
        $check = false;
        if( isset($_REQUEST["mail"]) && !empty($_REQUEST["mail"]) ) {
            $data = array(
                "facebook_mail" => $_REQUEST["mail"],
            );
            $data = $contorl_table->select_table_column( "user" , $data );
            if ($data->num_rows == 1) {
                while($row = $data->fetch_assoc()) {
                    if( $row["usertype"] == "root" || $row["usertype"] == "boss" || $row["usertype"] == "manage" ) {
                        $check = true;
                    }
                }
            }
        }*/
        //check root --
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) && $check) {
                switch ($_REQUEST["cmd"]) {
                        case "list":
                                $json = list_page( $contorl_table );
                                break;
                        case "examine":
                                $json = examine_page( $contorl_table , $_REQUEST["obj"]);
                                break;
                        case "delete":
                                $json = delete_page( $contorl_table , $_REQUEST["obj"]);
                                break;
                        case "display":
                                $json = display_page( $contorl_table , $_REQUEST["obj"]);
                                break;
                        case "select":
                                $json = select_page( $contorl_table , $_REQUEST["obj"]);
                                break;
                        case "modify":
                                $json = modify_page( $contorl_table , $_REQUEST["obj"]);
                                break;
                        case "people":
                                $json = list_people( $contorl_table , $_REQUEST["obj"]);
                                break;
                        default:
                                break;
                }
        }
        
        //echo json_encode( $json );
        
        function list_page( $contorl_table ) {
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
        
        function examine_page( $contorl_table , $jsonData ) {
            
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
                                $contorl_table->table_update( "user" , array("usertype" => "manage"),array("user_id" => (int)$user_id) );
                            }
                            
                        }
                    }
                }
                
                ////////////////////////////////////////////////////////////////////////
                return $process_DB;
        }
        
        function delete_page( $contorl_table , $jsonData ) {
                
                $obj = array(
                    "page_id" => (int)$jsonData{'page_id'},
                );
                //print_r($obj);
                //echo $obj["page_id"];
                
                $cmd = "DELETE FROM click_num WHERE page_id=". $obj["page_id"];
                $contorl_table->SQL_cmd( $cmd );
                $cmd = "DELETE FROM click_num_m WHERE page_id=". $obj["page_id"];
                $contorl_table->SQL_cmd( $cmd );
                $cmd = "DELETE FROM click_num_w WHERE page_id=". $obj["page_id"];
                $contorl_table->SQL_cmd( $cmd );
                $cmd = "DELETE FROM collect WHERE page_id=". $obj["page_id"];
                $contorl_table->SQL_cmd( $cmd );
                $cmd = "DELETE FROM history WHERE page_id=". $obj["page_id"];
                $contorl_table->SQL_cmd( $cmd );
                $cmd = "DELETE FROM page WHERE page_id=". $obj["page_id"];
                echo $contorl_table->SQL_cmd( $cmd );
                
                /*
                $data = array(
                    "usertype" => "freeze",
                );
                $data2 = array(
                    "user_id" => (int)$jsonData{'id'},
                );
                $process_DB = $contorl_table->table_update( "user" , $data, $data2 );
                
                return $process_DB;*/
                
        }
        
        function display_page( $contorl_table , $jsonData ) {
                
                $obj = array(
                    "page_id" => (int)$jsonData{'page_id'},
                    "display" => $jsonData{'display'}
                );
                //print_r($obj);
                //echo $obj["page_id"];
                
                if( $obj["display"] === "" ) {
                    
                    $data = $contorl_table->select_table_column( "page" , array( "page_id" => (int)$obj["page_id"] ) );
                    
                    if ($data->num_rows == 1) {
                        while($row = $data->fetch_assoc()) {
                            $channel = $row["channel_id"];
                            
                            $data = $contorl_table->select_table_column( "channel" , array( "channel_id" => (int)$channel ) );
                            if ($data->num_rows == 1) {
                                while($row = $data->fetch_assoc()) {
                                    $display = $row["display"];
                                    if( $display === "none" ) {
                                        
                                        echo "channel display none";
                                        return false;
                                    }
                                }
                            }
                            
                            
                        }
                    }
                    
                }
                
                $cmd = "UPDATE page SET display='" . $obj["display"] . "' WHERE page_id=" . $obj["page_id"] ;
                echo $contorl_table->SQL_cmd( $cmd );
                
        }
        
        
        
        function select_page( $contorl_table , $jsonData ) {
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
        
        function modify_page( $contorl_table , $jsonData ) {
                $data = array(
                    "usertype" => $jsonData{'manage'},
                );
                $data2 = array(
                    "user_id" => (int)$jsonData{'id'},
                );
                $process_DB = $contorl_table->table_update( "user" , $data,$data2 );
                
                return $process_DB;
        }
        
?>
