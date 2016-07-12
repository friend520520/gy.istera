<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $url = $_REQUEST["url"];
	
        //abin edit  2015.6.5  ++
        if( $url == "true" ) {
                $data = array(
                        "ch_url" => urldecode($_REQUEST["data"]["id"]),
                );
                $data = $contorl_table->select_table_column( "channel" , $data );
                if ($data->num_rows > 0) {
                        $row = $data->fetch_assoc();
                        $_REQUEST["data"]["id"] = $row["channel_id"];
                }
        }
        //abin edit  2015.6.5  --
        
        //check root ++
        /*
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
        $check = true;
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
        echo json_encode( $json );
        
        function list_channel( $contorl_table ) {
                    $cmd =      "select *,a.registration_time channel_registration_time "
                                ."from channel as a join user as b "
                                ."on a.user_id = b.user_id "
                                ."where a.ch_examine = false "
                                ."order by channel_registration_time desc ";
                    
                    $data = $contorl_table->SQL_cmd( $cmd );
                    if( $data->num_rows > 0 ) {
                                while($row = $data->fetch_assoc()) {
                                            //if( $row["ch_examine"] == "false" ) 
                                            {
                                                        $files[] = array(
                                                                    "id"            => $row["channel_id"],
                                                                    "username"      => $row["user_name"],
                                                                    "channelname"   => $row["ch_name"],
                                                                    "icon"          => $row["ch_icon"],
                                                                    "cover"         => $row["ch_cover"],
                                                                    "type"          => $row["ch_type"],
                                                                    "introduce"     => $row["ch_introduce"],
                                                                    "url"           => $row["ch_url"],
                                                                    "facebook"      => $row["facebook_url"],
                                                                    "youtube"       => $row["youtube_url"],
                                                                    "instagram"     => $row["instagram_url"],
                                                                    "other"         => $row["other_url"],
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
                                "channel_id" => $jsonData{'id'},
                    );

                    $data = $contorl_table->select_table_column( "channel" , $data );
                    
                    if ($data->num_rows > 0) {
                                while($row = $data->fetch_assoc()) {
                                            $files{'ch_id'}  = $jsonData{'id'};
                                            $files{'ch_icon'}    = $row["ch_icon"];
                                            $files{'ch_cover'}  = $row["ch_cover"];
                                            $files{'ch_type'}  = $row["ch_type"];
                                            $files{'subscribe_newsletter'}  = $row["subscribe_newsletter"];
                                            $files{'ch_name'}  = $row["ch_name"];
                                            $files{'ch_introduce'}  = $row["ch_introduce"];
                                            $files{'facebook_url'}  = $row["facebook_url"];
                                            $files{'youtube_url'}  = $row["youtube_url"];
                                            $files{'instagram_url'}  = $row["instagram_url"];
                                            $files{'line_url'}  = $row["line_url"];
                                            $files{'pixnet_url'}  = $row["pixnet_url"];
                                            $files{'other_url'}  = $row["other_url"];
                                            $files{'registration_time'}  = $row["registration_time"];
                                            $files{'ch_work'}  = $row["ch_work"];
                                            $files{'ch_examine'}  = $row["ch_examine"];
                                }
                    }
                    else
                    {
                                $files = false;
                    }
                    //select account --

                    //print_r( $data );

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
        
?>
