<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        //ajax ++
        //ajax --
        
        
        //user account get login session

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        if( isset($_REQUEST["cmd"]) && !empty($_REQUEST["cmd"]) ) {
            switch ($_REQUEST["cmd"]) {
                case "list":
                    $json = list_specialtag( $contorl_table );
                    break;
                case "add":
                    $json = add_specialtag( $contorl_table , $_REQUEST["data"]);
                    break;
                case "delete":
                    $json = delete_specialtag( $contorl_table , $_REQUEST["data"]);
                    break;
                case "select":
                    $json = select_specialtag( $contorl_table , $_REQUEST["data"]);
                    break;
                case "modify":
                    $json = modify_specialtag( $contorl_table , $_REQUEST["data"]);
                    break;
                default:
                    break;
            }
        }
        echo json_encode( $json );
        
        
        
        
        
        function list_specialtag( $contorl_table ) {
            $data = "";
            $data = $contorl_table->select_table_column( "specialtag" , $data );
            if ($data->num_rows > 0) {
                while($row = $data->fetch_assoc()) {
                    $files[] = array(
                        "id" => $row["id"],
                        "name" => $row["name"],
                        "img_path" => $row["img_path"],
                    );
                }
            }
            return $files;
        }
        
        function add_specialtag( $contorl_table , $jsonData ) {
                $arr_test = get_headers( $jsonData{'img'} );
                $test = stripos($arr_test[0],'ok');
                if($test!=''){
                        $data = array(
                            "name" => $jsonData{'name'},
                            "img_path" => $jsonData{'img'},
                        );
                        $process_DB = $contorl_table->table_add_insert("specialtag", $data);
                }else{
                    return "false";
                }
                return $process_DB;
        }
        
        function delete_specialtag( $contorl_table , $jsonData ) {
                //select ++
                global $server_specialIcon_path;
                $data = array(
                    "id" => $jsonData{'id'},
                );
                $data = $contorl_table->select_table_column( "specialtag" , $data );
                if ($data->num_rows > 0) {
                    $row = $data->fetch_assoc();
                } else {
                    $row = "undefined";
                }
                //select --
                
                $fileName = substr( $row["img_path"] , strrpos($row["img_path"], "/")+1 , strlen($row["img_path"])+1-strrpos($row["img_path"], "/") );
                if( is_file( $server_specialIcon_path.$fileName) ) {
                    unlink($server_specialIcon_path.$fileName);
                }
                
                $data = array(
                    "id" => $jsonData{'id'}
                );
                $process_DB = $contorl_table->table_delete("specialtag", $data );
                return $process_DB;
        }
        
        function select_specialtag( $contorl_table , $jsonData ) {
                //select ++
                $data = array(
                    "id" => $jsonData{'id'},
                );
                $data = $contorl_table->select_table_column( "specialtag" , $data );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{'id'} = $row["id"];
                        $files{'name'} = $row["name"];
                        $files{'img'} = $row["img_path"];
                    }
                } else {
                    $files = false;
                }
                //select --
                return $files;
        }
        
        function modify_specialtag( $contorl_table , $jsonData ) {
            
                global $server_specialIcon_path;
                $data = array(
                    "id" => $jsonData{'id'},
                );
                $data = $contorl_table->select_table_column( "specialtag" , $data );
                if ($data->num_rows > 0) {
                    $row = $data->fetch_assoc();
                } else {
                    $row = "undefined";
                }
                //select --
                $fileName = substr( $row["img_path"] , strrpos($row["img_path"], "/")+1 , strlen($row["img_path"])+1-strrpos($row["img_path"], "/") );
                if( is_file( $server_specialIcon_path.$fileName) ) {
                    unlink($server_specialIcon_path.$fileName);
                }
            
                $data = array(
                    "name" => $jsonData{'name'},
                    "img_path" => $jsonData{'img'},
                );
                $data2 = array(
                    "id" => (int)$jsonData{'id'},
                );
                $process_DB = $contorl_table->table_update( "specialtag" , $data,$data2 );
               
                return $process_DB;
        }
        
        
        
        
        
        
        
?>