<?php 
        include("config.php");
        include("global.php");
        include("SQL_table_control.php");
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        //user account get login session
        $user_mail = $_POST["user_mail"];
        $project = urldecode($_POST["project"]);
        $draft = $_POST["draft"];
        
        
        //File ++ 
        if( isset($user_mail) && !empty($user_mail) ) {
            $delete_path = $server_website_path.$user_mail."\draft\\".$draft."\\" ;
        }
        $process_file = rrmdir( $delete_path );
        //File --

        
        //SQL ++ 
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        //get user_id ++
        $data = array(
            "facebook_mail" => $user_mail,
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
            "draft_id" => (int)$draft,
            "user_id" => $user_id,
            "name" => $project,
        );
        
        $process_DB = $contorl_table->table_delete("draft", $data );
        
        if( $process_DB == "true" && $process_file == "true" ) {
            echo "true";
        } else {
            echo "false";
        }
        //SQL --
?>
