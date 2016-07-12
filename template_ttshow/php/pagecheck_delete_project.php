<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        $index = $_POST["index"];
        $user_id      = "undefine";
        $project_name = "undefine";
        
        //file ++
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        $data = array(
            "examine_id" =>  (int)$index ,
        );
        $data = $contorl_table->select_table_column( "examine" , $data );
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                $user_id = $row["user_id"];
                $project_name = $row["name"];
                $draft_id = $row["draft_id"];
            }
        }
        
        if( isset($index) && !empty($index) && (int)$index != 0 ) {
                $delete_path = $server_examine_path.$index."\\";
                $process_file = rrmdir( $delete_path );
        } else if( $index == "0" ) {
                $delete_path = $server_examine_path.$index."\\";
                $process_file = rrmdir( $delete_path );
        } else {
            //echo "is null";
        }
        //file --
        
        //SQL ++
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $target = array(
            "examine_id" => (int)$index ,
        );
        $process_sql = $contorl_table->table_delete("examine", $target);
        
        
        $data = array(
            "state" => "check_fail",
        );
        $target = array(
            "user_id" => $user_id ,
            "name" => $project_name ,
            "draft_id" => $draft_id,
        );
        $process_sql = $contorl_table->table_update( "draft",$data,$target );
        //SQL --

        if( $process_file == "true" && $process_sql == "true" ) {
            echo "true";
        } else {
            echo "false";
        }
?>