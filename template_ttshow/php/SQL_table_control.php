<?php 
class SQL_table_control {
        
        public $conn;
        
        function init_DBconnect( $SQL_host, $SQL_account, $SQL_password , $DB ) {
            $this->conn = new mysqli( $SQL_host, $SQL_account, $SQL_password, $DB );
            $this->conn->query("SET NAMES UTF8");
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            } 
        }
        
        function dis_DBconnect() {
            $this->conn->close();
        }
        /*
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
                $bool = "false";
                $sql_column = "";
                $sql_value = "";                   
                foreach ($json as $key => $value) {

                    $sql_column = $sql_column."`".$key."` ,";
                    
                    if( gettype($value) == "NULL" ) {
                        $sql_value = $sql_value."'NULL' ,";
                    } else if ( gettype($value) == "integer"){
                        $sql_value = $sql_value.$value." ,";
                    } else if ( $value == ""){
                        $sql_value = $sql_value."'' ,";
                    }  else {
                        $sql_value = $sql_value."'".$value."' ,";
                    }                    
                }
                $sql_column = substr( $sql_column ,0 ,-1);
                $sql_value = substr( $sql_value   ,0 ,-1);
                $sql = "INSERT INTO `$table` ( $sql_column ) VALUES ( $sql_value )";
                
                if ($this->conn->query($sql) === TRUE) {
                    $bool = "true";
                }
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
                    }
                    else if( gettype($value) == "integer" ) {
                        $key_string = $key_string."`$key`=$value AND";
                    } else if ( $value == ""){
                        $key_string = $key_string."`$key`= '' AND";
                    } else {
                        $value = (string) $value;
                        $key_string = $key_string."`$key`= $value AND";
                    }
                }
                $key_string = substr( $key_string ,0 ,-3);
                
                $sql = "UPDATE  `$table` SET  $set_value WHERE $key_string";
                
                if ($this->conn->query($sql) === TRUE) {
                    $bool = "true";
                } else {
                    $bool = "false";
                }
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
                $bool = "true";
                $key_string = "";
                
                foreach ($keyword as $key => $value) {
                    if(gettype($value) == "string") {
                        $key_string = $key_string."`$key`= '$value' AND";
                    } else if( gettype($value) == "integer" ) {
                        $key_string = $key_string."`$key`=$value AND";
                    } else {
                        $value = (string) $value;
                        $key_string = $key_string."`$key`= $value AND";
                    }
                }
                $key_string = substr( $key_string ,0 ,-3);
                
                $sql = "DELETE FROM `$table` WHERE $key_string";
                
                if ($this->conn->query($sql) === TRUE) {
                    $bool = "true";
                } else {
                    $bool = "false";
                }
                return $bool;
        }
        
        /*
        $data2 = array(
            "editor_id" => 1,
        );
        select_table_column( "editor" , $data2 );
        */
        function check_table_column( $table , $keyword ) {
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
                $result = $this->conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        foreach ($row as $key => $value) {
                            //echo $key." : ".$value."<br>";
                        }
                    }
                } else {
                    $bool = "false";
                }
                return $bool;
        }
        
        /*
        $data2 = array(
            "editor_id" => 1,
        );
        select_table_column( "editor" , $data2 );
        */
        function select_table_column( $table , $keyword ) {
                $bool = "true";
                if( $keyword == "" ) {
                        $sql = "SELECT * FROM `$table` ";
                } else {
                        $key_string = "";
                        foreach ($keyword as $key => $value) {
                            if(gettype($value) == "string") {
                                $key_string = $key_string."`$key`= '$value' AND";
                            } else if( gettype($value) == "integer" ) {
                                $key_string = $key_string."`$key`=$value AND";
                            } else {
                                $value = (string) $value;
                                $key_string = $key_string."`$key`= $value AND";
                            }
                        }
                        $key_string = substr( $key_string ,0 ,-3);

                        $sql = "SELECT * FROM `$table` WHERE $key_string";
                }
                
                $result = $this->conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    return $result;
                } else {
                    $bool = "false";
                }
                return $bool;
        }
        
        function select_AUTO_INCREMENT ( $DB , $table ) {
            
                $result = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$DB' AND TABLE_NAME = '$table'";

                $row = $this->conn->query($result);

                if ($row->num_rows > 0) {
                    $row2 = $row->fetch_assoc();
                    $AUTO_INCREMENT = $row2["AUTO_INCREMENT"];
                }
                return $AUTO_INCREMENT;
        }
        
        function SQL_cmd( $cmd ) {
                $row = $this->conn->query($cmd);
                return $row;
        }
        
        function Check_mysqli_real_escape_string( $content ) {
            
                return mysqli_real_escape_string($this->conn,$content);
                
        }
        
}
?>
