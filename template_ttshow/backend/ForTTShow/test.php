<?php
        include("global.php");
        include("SQL_table_control.php");
        include("php_lib/json/Services_JSON.php");
        $json = new Services_JSON();
        
        $conn = new mysqli( $SQL_host, $SQL_account, $SQL_password, "ttshow" );
        $conn->query("SET NAMES utf8");
        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $result = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'ttshow' AND TABLE_NAME = 'examine'";

        $row = $conn->query($result);
        
        if ($row->num_rows > 0) {
            $row2 = $row->fetch_assoc();
            $abc = $row2["AUTO_INCREMENT"];
        }
        echo $abc;
        
        if ( $conn->query($result) === TRUE ) {
            $bool = "true";
        } else {
            $bool = "false";
        }
        /*
        $data = mysql_fetch_assoc($result);
        $next_increment = $data['Auto_increment'];
        echo $next_increment;
        */
        //$sql = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'DatabaseName' AND TABLE_NAME = 'TableName'";
        
        
        /*    
        $conn = new mysqli( $SQL_host, $SQL_account, $SQL_password, "ttshow");
        $conn->query("SET NAMES utf8");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        //GET UTC +8 time    ++
        $timezone = '+8:00';
        $timezone = preg_replace('/[^0-9]/', '', $timezone) * 36;
        $timezone_name = timezone_name_from_abbr(null, $timezone, true);
        date_default_timezone_set($timezone_name);
        //GET UTC +8 time    --
        
        $time = date("Y-m-d H:i:s");
        $data = array(
            "editor_id" => null,
            "user_id" => "Jack",
            "name" => "project",
            "title" => "Hello" ,
            "describe" => "www" ,
            "state" => "edit" ,
            "date" => $time
        );
        */
        //echo table_add_insert("editor",$data);
        //SQL insert Data
        function table_add_insert( $table , $json ) {
                global $conn;
                $bool = "true";
                $sql_column = "";
                $sql_value = "";   
                foreach ($json as $key => $value) {
                    $sql_column = $sql_column."`".$key."` ,";
                    if( $value == null ) {
                        $sql_value = $sql_value."NULL ,";
                    } else {
                        $sql_value = $sql_value."'".$value."' ,";
                    }
                }
                $sql_column = substr( $sql_column ,0 ,-1);
                $sql_value = substr( $sql_value   ,0 ,-1);
                $sql = "INSERT INTO `$table` ( $sql_column ) VALUES ( $sql_value )";
                if ($conn->query($sql) === TRUE) {
                    $bool = "true";
                } else {
                    $bool = "false";
                }
                $conn->close();
                return $bool;
        }
        
        /*
        $data = array(
            "describe" => "ggg" ,
            "state" => "aaa" ,
            "date" => $time
        );
        $data2 = array(
            "user_id" => "0",
        );
        table_update( "editor",$data,$data2 );
        */
        //SQL update Data
        function table_update( $table , $json , $keyword ) {
                //$sqlcode = "UPDATE  `ttshow`.`editor` SET  `title` =  'saasas' WHERE  `editor`.`editor_id` =5 LIMIT 1 ;";
                global $conn;
                $bool = "true";
                $set_value = "";   
                $key_string = "";
                
                foreach ($json as $key => $value) {
                    if(gettype($value) == "string") {
                        $set_value = $set_value."`$key`='$value',";
                    } else {
                        $set_value = $set_value."`$key`=$value,";
                    }
                }
                $set_value = substr( $set_value ,0 ,-1);
                
                foreach ($keyword as $key => $value) {
                    if(gettype($value) == "string") {
                        $key_string = $key_string."`$key`= '$value' AND";
                    } else {
                        $value = (string) $value;
                        $key_string = $key_string."`$key`= $value AND";
                    }
                }
                $key_string = substr( $key_string ,0 ,-3);
                
                $sql = "UPDATE  `$table` SET  $set_value WHERE $key_string";

                if ($conn->query($sql) === TRUE) {
                    $bool = "true";
                } else {
                    $bool = "false";
                }
                $conn->close();
                return $bool;
        }
        /*
        $data2 = array(
            "editor_id" => 2,
        );
        table_delete( "editor", $data2 );
        */
        //SQL Delete Data
        function table_delete( $table , $keyword ) {
                //$sql = "DELETE FROM MyGuests WHERE id=3";
                global $conn;
                $bool = "true";
                $key_string = "";
                
                foreach ($keyword as $key => $value) {
                    if(gettype($value) == "string") {
                        $key_string = $key_string."`$key`= '$value' AND";
                    } else {
                        $value = (string) $value;
                        $key_string = $key_string."`$key`= $value AND";
                    }
                }
                $key_string = substr( $key_string ,0 ,-3);
                
                $sql = "DELETE FROM `$table` WHERE $key_string";

                if ($conn->query($sql) === TRUE) {
                    $bool = "true";
                } else {
                    $bool = "false";
                }
                $conn->close();
                return $bool;
        }
        
        /*
        $data2 = array(
            "editor_id" => 1,
        );
        select_table_column( "editor" , $data2 );
        */
        function check_table_column( $table , $keyword ) {
                global $conn;
                $bool = "true";
                
                $key_string = "";
                foreach ($keyword as $key => $value) {
                    if(gettype($value) == "string") {
                        $key_string = $key_string."`$key`= '$value' AND";
                    } else {
                        $value = (string) $value;
                        $key_string = $key_string."`$key`= $value AND";
                    }
                }
                $key_string = substr( $key_string ,0 ,-3);
                
                $sql = "SELECT * FROM `$table` WHERE $key_string";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        foreach ($row as $key => $value) {
                            echo $key." : ".$value."<br>";
                        }
                    }
                } else {
                    $bool = "false";
                }
                return $bool;
        }
        
?>