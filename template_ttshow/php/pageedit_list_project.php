<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        $user_mail = $_POST["user_mail"];
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        //get user_id ++
        $data = array(
            "facebook_mail" => $user_mail,
        );
        $data = $contorl_table->select_table_column( "user" , $data );
        if ($data->num_rows > 0) {
            $row = $data->fetch_assoc();
            $user_id = (int)$row["user_id"];
            //$class_id = (int)$row["channel_subordinate"];
        } else {
            $user_id = "undefined";
        }
        //get user_id --
        
        //calss name ++
        /*$data = array(
            "id" => $class_id,
        );
        $data = $contorl_table->select_table_column( "category" , $data );
        if ($data->num_rows > 0) {
            $row = $data->fetch_assoc();
            $calss_name = $row["name"];
        } else {
            $user_id = "undefined";
        }*/
        //calss name --
        
        //SQL ++
        if( $user_id != "undefined" ) {
                $data = array(
                    "user_id" => $user_id ,
                );
                $data = $contorl_table->select_table_column( "draft" , $data );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files[] = array(
                            "draft" => $row["draft_id"],
                            "name" => urlencode( $row["name"] ) ,
                            "state"=> $row["state"],
                            //"class" => $calss_name,
                            "type" => "folder" ,
                            "path" => "" ,
                        );
                    }
                    echo $json->encode( $files );
                } else {
                    echo "false";
                }
        } else {
            echo "false";
        }
        //SQL --
?>