<?php 
        include("config.php");
        include("emoji.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $page_id = $_POST["page_id"];
        echo echoHtml( $page_id );
        
        function echoHtml( $page_id ) {
                global $contorl_table;
                $data = array(
                    "page_id" => $page_id ,
                );
                $data = $contorl_table->select_table_column( "page" , $data );
                if ($data->num_rows > 0) {
                    // output data of each row
                    $row = $data->fetch_assoc();
                    return emoji_html_to_unified( $row["html"] );
                } else {
                    return "false";
                }
        }
?>