<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        //ajax ++
        //ajax --
        
        settingUTCtime();
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            switch ($_REQUEST["cmd"]) {
                case "list":
                    $json = list_history( $contorl_table , $_REQUEST["data"]);
                    break;
                case "add":
                    $json = add_history( $contorl_table , $_REQUEST["data"]);
                    break;
                case "delete":
                    $json = delete_history( $contorl_table , $_REQUEST["data"]);
                    break;
                case "delete_all":
                    $json = delete_all_history( $contorl_table , $_REQUEST["data"]);
                    break;
                default:
                    break;
            }
        }
        $contorl_table->dis_DBconnect();
        echo json_encode( $json );
        

        function list_history( $contorl_table , $jsonData ) {
            //get user_id ++
            $data = array(
                "facebook_mail" => $jsonData{'email'},
            );
            $data = $contorl_table->select_table_column( "user" , $data );
            if ($data->num_rows > 0) {
                $row = $data->fetch_assoc();
                $user_id = (int)$row["user_id"];
            } else {
                $user_id = "undefined";
            }
            //get user_id --
            $Range = 10;
            
            if( $user_id != "undefined" ) {
                
                $cmd = "select *,a.page_id collect_id,b.date page_date,c.user_name author,d.name class_name,e.name specialtag_name "
                      ."from collect as a join page as b join user as c join category as d join specialtag as e "
                      ."on a.page_id = b.page_id AND b.user_id = c.user_id AND b.class = d.id AND b.special_tag_id = e.id "
                      ."where a.user_id = ".$user_id." "
                      ."LIMIT ".((int)$jsonData{'pageNumber'}).", ".$Range;
                $data = $contorl_table->SQL_cmd( $cmd );
                
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{'collect'}[] = array(
                            "collect_id" => $row["collect_id"],
                            "page_id" => $row["page_id"],
                            "icon" => "http://".$_SERVER["SERVER_NAME"]."/ttshow/web/data/".$row["page_id"]."/".$row["article_icon"],
                            "specialtag_name" => $row["specialtag_name"],
                            "specialtag_icon" => $row["img_path"],
                            "title" => $row["title"],
                            "author" => $row["author"],
                            "author_id" => $row["user_id"],
                            "author_icon" => $row["usericon"],
                            "class" => $row["class_name"],
                            "tag" => $row["tag"],
                            "page_date" => $row["page_date"],
                            "click" => $row["c_num_click"],
                            "share" => $row["share_num"],
                            "history_date" => $row["history_date"],
                        );
                    }
                }
                $files{'length'} = $data->num_rows;
                //add subscribe message ++
                $data = array(
                    "user_id" => $user_id,
                );
                $data = $contorl_table->select_table_column( "subscribe" , $data );
                
                if ($data->num_rows > 0) {
                    $i = 0;
                    $files{'subscribe'} = array();
                    while($row = $data->fetch_assoc()) {
                        $files{'subscribe'}[$i] = $row["author_id"];
                        $i++;
                    }
                    unset($files{'subscribe'}[$i-1]);
                }
                //add subscribe message --
            }
            return $files;
        }
        
        function add_history( $contorl_table , $jsonData ) {
            //get user_id ++
            $data = array(
                "facebook_mail" => $jsonData{'email'},
            );
            $data = $contorl_table->select_table_column( "user" , $data );
            if ($data->num_rows > 0) {
                $row = $data->fetch_assoc();
                $user_id = (int)$row["user_id"];
            } else {
                $user_id = "undefined";
            }
            //get user_id --
            if( $user_id != "undefined" ) {
                //  data > 100     =>  delete data  ++
                $data = array(
                    user_id => $user_id
                );
                $data = $contorl_table->select_table_column( "history" , $data );
                if ($data->num_rows > 99) {
                    $cmd = "select * from history where user_id = '".$user_id."' order by date asc limit 1";
                    $data = $contorl_table->SQL_cmd( $cmd );
                    $row = $data->fetch_assoc();
                    $delete_data = array(
                        "user_id" => $row["user_id"],
                        "date" => $row["date"]
                    );
                    $process_DB = $contorl_table->table_delete("history", $delete_data );
                }
                //  data > 100     =>  delete data  --
                
                //add history ++
                $time = date("Y-m-d H:i:s");
                $data = array(
                    "user_id" => $user_id,
                    "page_id" => (int)$jsonData{'page'},
                    "date" => $time,
                );
                $process_DB = $contorl_table->table_add_insert("history", $data);
                //add history --
            }
        }
       
        function delete_history( $contorl_table , $jsonData ) {
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
                    "user_id" => $user_id,
                    "page_id" => (int)$jsonData{'collect_id'}
                );
                $process_DB = $contorl_table->table_delete("collect", $data );
                $files{'success'} = $process_DB;
                $files{'collect_id'} = (int)$jsonData{'collect_id'};
                return $files;
        }
        
        function delete_all_history( $contorl_table , $jsonData ) {
                //get user_id ++
                $data = array(
                    "facebook_mail" => $jsonData{'email'},
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
                    "user_id" => $user_id,
                );
                $process_DB = $contorl_table->table_delete("history", $data );
                return $process_DB;
        }
        
?>
