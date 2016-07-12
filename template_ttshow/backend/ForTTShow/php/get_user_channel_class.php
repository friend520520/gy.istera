<?php 
        include("global.php");
        include("SQL_table_control.php");
        $contorl_table = new SQL_table_control();
        
        //echo $_REQUEST["user_mail"];
        
        $contorl_table->init_DBconnect($SQL_host, $SQL_account, $SQL_password, "ttshow");
        

        //list tab ++
        $data = "";
        $data = $contorl_table->select_table_column( "category" , $data );
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                $json{"tab"}[] = array(
                    "id" => $row["id"],
                    "name" => $row["name"],
                );
            }
        }
        //list tab --
    
        //get user_id ++
        $data = array(
            "facebook_mail" => $_REQUEST["user_mail"],
        );
        $data = $contorl_table->select_table_column( "user" , $data );
        if ($data->num_rows > 0) {
            $row = $data->fetch_assoc();
            $user_id = (int)$row["user_id"];
        } else {
            $user_id = "undefined";
        }
        //get user_id --
        
        //list channel ++
        if( $user_id != "undefined" ) {
                $cmd = "select * "
                      ."from channel as a join channel_group as b "
                      ."on a.channel_id = b.channel_id "
                      ."where b.user_id = ".$user_id;
                $data = $contorl_table->SQL_cmd( $cmd );
                if ($data->num_rows > 0) {
                        while($row = $data->fetch_assoc()) {
                            $json{"channel"}[] = array(
                                "id" => $row["channel_id"],
                                "name" => $row["ch_name"],
                            );
                        }
                }
        }
        //list channel --
        echo json_encode( $json );
?>