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
                    if( $row["usertype"] == "root" || $row["usertype"] == "boss" ) {
                        $check = true;
                    }
                }
            }
        }
        //check root --
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) && $check) {
            switch ($_REQUEST["cmd"]) {
                case "list":
                    $json = list_account( $contorl_table , $_REQUEST["mail"]);
                    break;
                case "add":
                    $json = add_account( $contorl_table , $_REQUEST["data"]);
                    break;
                case "delete":
                    $json = delete_account( $contorl_table , $_REQUEST["data"]);
                    break;
                case "select":
                    $json = select_account( $contorl_table , $_REQUEST["data"]);
                    break;
                case "modify":
                    $json = modify_account( $contorl_table , $_REQUEST["data"]);
                    break;
                case "people":
                    $json = list_people( $contorl_table , $_REQUEST["data"]);
                    break;
                default:
                    break;
            }
        }
        echo json_encode( $json );
        
        function list_account( $contorl_table , $mail ) {
            $data = array(
                "facebook_mail" => $_REQUEST["mail"],
            );
            $data = $contorl_table->select_table_column( "user" , $data );
            if ($data->num_rows == 1) {
                while($row = $data->fetch_assoc()) {
                    if( $row["usertype"] == "root" || $row["usertype"] == "boss" ) {
                        $usertype = $row["usertype"];
                    }
                }
            }
            
            $cmd = "select * from user order by registration_time desc";
            $data = $contorl_table->SQL_cmd( $cmd );
            if( ( $usertype == "root" || $usertype == "boss" ) && $data->num_rows > 0 ) {
                    while($row = $data->fetch_assoc()) {
                            $files[] = array(
                                "id"     => $row["user_id"],
                                "name"   => $row["user_name"],
                                "icon"   => $row["usericon"],
                                "mail"   => $row["email"],
                                "type"   => $row["usertype"],
                            );
                    }
            } else if( $data->num_rows > 0 ) {
                    while($row = $data->fetch_assoc()) {
                        if( $row["usertype"] != "root" && $row["usertype"] != "boss" ) {
                            $files[] = array(
                                "id"     => $row["user_id"],
                                "name"   => $row["user_name"],
                                "icon"   => $row["usericon"],
                                "mail"   => $row["email"],
                                "type"   => $row["usertype"],
                            );
                        }
                    }
            }
            return $files;
        }
        
        function add_account( $contorl_table , $jsonData ) {
            
                $data = array(
                    "user_name" => $jsonData{'name'},
                    "facebook_mail" => $jsonData{'mail'},
                );
                $process_DB = $contorl_table->table_add_insert("user", $data);
                
                return $process_DB;
        }
        
        function delete_account( $contorl_table , $jsonData ) {
                $data = array(
                    "usertype" => "freeze",
                );
                $data2 = array(
                    "user_id" => (int)$jsonData{'id'},
                );
                $process_DB = $contorl_table->table_update( "user" , $data,$data2 );
                
                return $process_DB;
        }
        
        function select_account( $contorl_table , $jsonData ) {
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
        
        function modify_account( $contorl_table , $jsonData ) {
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
