<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            switch ($_REQUEST["cmd"]) {
                case "list":
                    $json = list_category( $contorl_table );
                    break;
                case "add":
                    $json = add_category( $contorl_table , $_REQUEST["data"]);
                    break;
                case "delete":
                    $json = delete_category( $contorl_table , $_REQUEST["data"]);
                    break;
                case "select":
                    $json = select_category( $contorl_table , $_REQUEST["data"]);
                    break;
                case "modify":
                    $json = modify_category( $contorl_table , $_REQUEST["data"]);
                    break;
                case "people":
                    $json = list_people( $contorl_table , $_REQUEST["data"]);
                    break;
                default:
                    break;
            }
        }
        echo json_encode( $json );
        
        function list_category( $contorl_table ) {
            $data = "";
            $data = $contorl_table->select_table_column( "category" , $data );
            if ($data->num_rows > 0) {
                while($row = $data->fetch_assoc()) {
                    $files[] = array(
                        "id" => $row["id"],
                        "name" => $row["name"],
                        "display" => $row["display"],
                    );
                }
            }
            return $files;
        }
        
        function add_category( $contorl_table , $jsonData ) {
            
                $next = $contorl_table->select_AUTO_INCREMENT( "ttshow" , "category" );
                $data = array(
                    "channel_subordinate" => $next,
                );
                $data2 = array(
                    "user_id" => (int)$jsonData{'manage'},
                );
                $process_DB_1 = $contorl_table->table_update( "user" , $data,$data2 );
            
                $data = array(
                    "name" => $jsonData{'name'},
                    "display" => "true",
                );
                $process_DB_2 = $contorl_table->table_add_insert("category", $data);
                
                if( $process_DB_1 && $process_DB_2 ) { 
                    return true; 
                } else { 
                    return false;
                }
        }
        
        function delete_category( $contorl_table , $jsonData ) {
                $data = array(
                    "id" => $jsonData{'id'}
                );
                $process_DB_1 = $contorl_table->table_delete("category", $data );
                
                $data = array(
                    "channel_subordinate" => "null",
                );
                $data2 = array(
                    "channel_subordinate" => $jsonData{'id'},
                );
                $process_DB_2 = $contorl_table->table_update( "user" , $data,$data2 );
                
                if( $process_DB_1 && $process_DB_2 ) { 
                    return true; 
                } else { 
                    return false;
                }
        }
        
        function select_category( $contorl_table , $jsonData ) {
                //select category ++
                $data = array(
                    "id" => $jsonData{'id'},
                );
                $data = $contorl_table->select_table_column( "category" , $data );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{'id'} = $row["id"];
                        $files{'name'} = $row["name"];
                        $files{'display'} = $row["display"];
                    }
                } else {
                    $files = false;
                }
                //select category --
                
                //select user ++
                $data = array(
                    "usertype" => "manage",
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                $files{'manage'} = "";
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{'people'}[] = array(
                            "id"   => $row["user_id"] ,
                            "name" => $row["user_name"] ,
                            "email" => $row["facebook_mail"] ,
                            "manage" => $row["channel_subordinate"] ,
                        );
                        if( $jsonData{'id'} == $row["channel_subordinate"] ) {
                            $files{'manage'} = $row["user_id"];
                        }
                    }
                }
                //select user --
                
                return $files;
        }
        
        function modify_category( $contorl_table , $jsonData ) {
                //modify category ++
                $data = array(
                    "name" => $jsonData{'name'},
                    //"display" => $jsonData{'display'},
                );
                $data2 = array(
                    "id" => (int)$jsonData{'id'},
                );
                $process_DB_1 = $contorl_table->table_update( "category" , $data,$data2 );
                //modify category --

                //clean user ++
                $data = array(
                    "channel_subordinate" => "null",
                );
                $data2 = array(
                    "channel_subordinate" => $jsonData{'id'},
                );
                $process_DB_2 = $contorl_table->table_update( "user" , $data,$data2 );
                //clean user --
                
                //modify user ++
                $data = array(
                    "channel_subordinate" => $jsonData{'id'},
                );
                $data2 = array(
                    "user_id" => (int)$jsonData{'manage'},
                );
                $process_DB_3 = $contorl_table->table_update( "user" , $data,$data2 );
                //modify user --
                
                if( $process_DB_1 && $process_DB_2 && $process_DB_3 ) { 
                    return true; 
                } else { 
                    return false;
                }
        }
        
        function list_people( $contorl_table , $jsonData ) {
                //select user ++
                $data = array(
                    "usertype" => "manage",
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{'people'}[] = array(
                            "id"   => $row["user_id"] ,
                            "name" => $row["user_name"] ,
                            "email" => $row["facebook_mail"] ,
                            "manage" => $row["channel_subordinate"],
                        );
                    }
                }
                //select user --
                
                return $files;
        }
        
?>
