<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        $cmd = "select * from user where usertype = 'editor' OR usertype = 'manage'";
        $data = $contorl_table->SQL_cmd( $cmd );
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                $files[] = array(
                    "link" => $row["user_id"],
                    "user_name" => $row["user_name"],
                    "usericon" => $row["usericon"],
                    "cover_photo" => $row["cover_photo"],
                    "channel_name" => $row["channel_name"],
                    "channel_introduce" => $row["channel_introduce"],
                );
            }
            echo json_encode( $files );
        } else {
            echo "false";
        }
                
        
?>