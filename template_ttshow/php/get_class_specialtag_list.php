<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        
        $Request = array(
            "class" => array(),
            "specialtag" => array()
        );
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $data = $contorl_table->select_table_column( "specialtag" , "" );
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                $Request["specialtag"][ $row["id"] ] = $row["name"];
            }
        } 
        $data = $contorl_table->select_table_column( "category" , "" );
        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                $Request["class"][ $row["id"] ] = $row["name"];
            }
        }
        echo json_encode( $Request ); 
?>