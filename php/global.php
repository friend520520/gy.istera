<?php

        function udate($format = 'u', $utimestamp = null) {
                if (is_null($utimestamp))
                    $utimestamp = microtime(true);
                $timestamp = floor($utimestamp);
                $milliseconds = round(($utimestamp - $timestamp) * 1000000);

                return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
        }
        
        function get_sql( $con , $table , $Condition = "" , $SELECT = '*' ){
                $return = array();
                $i = 0;
                $result = mysqli_query($con, "SELECT $SELECT FROM $table $Condition");

                if ( mysqli_num_rows($result) > 0) {
                        //$return[$i] = array();
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                            
                                    $return[$i] = $row;
                                    $i ++;

                        }
                        return $return;
                }
                else {
                        return FALSE;
                }
        }
        
        function get_sql_debug( $con , $table , $Condition = "" , $SELECT = '*' ){
                $return = array();
                $i = 0;
                $result = mysqli_query($con, "SELECT $SELECT FROM $table $Condition");

                if ( mysqli_num_rows($result) > 0) {
                        //$return[$i] = array();
                        while($row = mysqli_fetch_array($result)) {
                            print_r($row);
                            echo " ";
                                    $return[$i] = $row;
                                    $i ++;

                        }
                        return $return;
                }
                else {
                        return FALSE;
                }
        }
        
        function get_sql_by_array( $con , $table , $Condition_arr = array() , $SELECT = '*' ){
                $return = array();
                $i = 0;
                $Condition = "";
                if( !empty($Condition_arr) ){
                    $Condition = "WHERE ";
                    foreach ($Condition_arr as $key => $value) {
                        
                        $Condition = $Condition."`".$key."`=";
                        
                        if( gettype($value) == "NULL" ) {
                            $Condition = $Condition."'NULL' AND ";
                        } else if ( gettype($value) == "integer"){
                            $Condition = $Condition.$value." AND ";
                        } else if ( $value == ""){
                            $Condition = $Condition."'' AND ";
                        }  else {
                            $Condition = $Condition."'".$value."' AND ";
                        }                    
                    }
                    $Condition = substr( $Condition ,0 ,-4);
                }
                $result = mysqli_query($con, "SELECT $SELECT FROM $table $Condition");

                if ( mysqli_num_rows($result) > 0) {
                        //$return[$i] = array();
                        while($row = mysqli_fetch_array($result)) {

                                    $return[$i] = $row;
                                    $i ++;

                        }
                        return $return;
                }
                else {
                        return FALSE;
                }
        }
        
        function get_sql_array( $con , $table , $Get , $Condition = "" , $SELECT = '*' )
        {
                $return = array();
                $i = 0;
                $result = mysqli_query($con, "SELECT $SELECT FROM $table $Condition");
                
                if ( mysqli_num_rows($result) > 0) {

                        while($row = mysqli_fetch_array($result)) {
                                $return[$i] = array();
                                foreach ($Get as $key => $value) {
                                        $return[$i][$value] = $row[$value];
                                }
                                $i++;
                        }
                        return $return;

                }
                else {
                        return FALSE;
                }

        }
        
        function get_sql_array_for_datatable( $con , $table , $Get , $Condition = "" , $SELECT = '*' )
        {
                $return = array();
                $i = 0;
                $result = mysqli_query($con, "SELECT $SELECT FROM $table $Condition");
                
                if ( mysqli_num_rows($result) > 0) {

                        while($row = mysqli_fetch_array($result)) {
                                $return[$i] = array();
                                foreach ($Get as $key => $value) {
                                        $return[$i][] = $row[$value];
                                }
                                $i++;
                        }
                        return $return;

                }
                else {
                        return FALSE;
                }

        }
        
        function insert_sql( $con , $table , $insert_array )
        {
                $bool = false;
                $sql_column = "";
                $sql_value = "";                   
                foreach ($insert_array as $key => $value) {

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
                if ( mysqli_query($con, $sql) ) {
                    $bool = true;
                }
                return $bool;

        }
        
        function update_sql( $con , $table , $json , $keyword ) {
                
                $bool = true;
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
                
                $sql = "UPDATE `$table` SET  $set_value WHERE $key_string";
                if ( mysqli_query($con, $sql) ) {
                    $bool = true;
                } else {
                    $bool = false;
                }
                return $bool;
        }
        
        function update_2table_sql( $con , $table , $json , $keyword , $table2 , $json2 , $keyword2 ) {
                
                $bool = true;
                $set_value = "";   
                $key_string = "";
                
                foreach ($json as $key => $value) {
                    if(gettype($value) == "string") {
                        $set_value = $set_value."$key='$value',";
                    } else {
                        $set_value = $set_value."$key=$value,";
                    }
                }
                $set_value = substr( $set_value ,0 ,-1);
                
                foreach ($keyword as $key => $value) {
                    if(gettype($value) == "string") {
                        $key_string = $key_string."$key= '$value' AND";
                    }
                    else if( gettype($value) == "integer" ) {
                        $key_string = $key_string."$key=$value AND";
                    } else if ( $value == ""){
                        $key_string = $key_string."$key= '' AND";
                    } else {
                        $value = (string) $value;
                        $key_string = $key_string."$key= $value AND";
                    }
                }
                $key_string = substr( $key_string ,0 ,-3);
                
                $set_value2 = "";   
                $key_string2 = "";
                
                foreach ($json2 as $key => $value) {
                    if(gettype($value) == "string") {
                        $set_value2 = $set_value2."$key='$value',";
                    } else {
                        $set_value2 = $set_value2."$key=$value,";
                    }
                }
                $set_value2 = substr( $set_value2 ,0 ,-1);
                
                foreach ($keyword2 as $key => $value) {
                    if(gettype($value) == "string") {
                        $key_string2 = $key_string2."$key= '$value' AND";
                    }
                    else if( gettype($value) == "integer" ) {
                        $key_string2 = $key_string2."$key=$value AND";
                    } else if ( $value == ""){
                        $key_string2 = $key_string2."$key= '' AND";
                    } else {
                        $value = (string) $value;
                        $key_string2 = $key_string2."$key= $value AND";
                    }
                }
                $key_string2 = substr( $key_string2 ,0 ,-3);
                $sql = "UPDATE $table, $table2 SET $set_value,$set_value2 WHERE $key_string AND $key_string2";
                if ( mysqli_query($con, $sql) ) {
                    $bool = true;
                } else {
                    $bool = false;
                }
                return $bool;
        }
        
        function update_multi_sql( $con , $table , $json , $keyword ) {
                
                $bool = true;
                $table_value = "";
                $set_value = "";   
                $key_string = "";
                
                foreach ($table as $k => $v) {
                        $table_value .= $v.",";
                        $set_value_tmp = "";   
                        $key_string_tmp = "";
                        foreach ($json[$k] as $key => $value) {
                            if(gettype($value) == "string") {
                                $set_value_tmp = $set_value_tmp."$key='$value',";
                            } else {
                                $set_value_tmp = $set_value_tmp."$key=$value,";
                            }
                        }
                        $set_value .= substr( $set_value_tmp ,0 ,-1).",";

                        foreach ($keyword[$k] as $key => $value) {
                            if(gettype($value) == "string") {
                                $key_string_tmp = $key_string_tmp."$key='$value' AND ";
                            }
                            else if( gettype($value) == "integer" ) {
                                $key_string_tmp = $key_string_tmp."$key=$value AND ";
                            } else if ( $value == ""){
                                $key_string_tmp = $key_string_tmp."$key='' AND ";
                            } else {
                                $value = (string) $value;
                                $key_string_tmp = $key_string_tmp."$key=$value AND ";
                            }
                        }
                        $key_string .= substr( $key_string_tmp ,0 ,-4)." AND ";
                        
                }
                $table_value = substr( $table_value ,0 ,-1);
                $set_value = substr( $set_value ,0 ,-1);
                $key_string = substr( $key_string ,0 ,-4);
                
                
                $sql = "UPDATE $table_value SET $set_value WHERE $key_string";
                if ( mysqli_query($con, $sql) ) {
                    $bool = true;
                } else {
                    $bool = false;
                }
                return $bool;
        }
        
        function rrmdir($dir) {
            if (is_dir($dir)) {
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
                    }
                }
                reset($objects);
                rmdir($dir);
                return "true";
            }
            return "false";
         }
         
         function check_empty( $value ) {
                
                $return = true;
                if( gettype($value) === "array" ) {
                    foreach ($value as $key => $value2) {
                        if( !isset($_REQUEST[$value2]) || empty($_REQUEST[$value2]) ) {
                            return false;
                        }
                    }
                }
                else if( gettype($value) === "string" ) {
                    if( isset($_REQUEST[$value]) && !empty($_REQUEST[$value]) ) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
                return $return;
        }
         
         function check_isset( $value ) {
                
                $return = true;
                if( gettype($value) === "array" ) {
                    foreach ($value as $key => $value2) {
                        if( !isset($_REQUEST[$value2]) ) {
                            return false;
                        }
                    }
                }
                else if( gettype($value) === "string" ) {
                    if( isset($_REQUEST[$value]) ) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
                return $return;
        }

        function getRandom( $num )
        {
            $var = "";
            for( $i=1 ; $i<=$num ; $i++ )
            {
                $ASCII = getASCII();
                $var .= $ASCII;
            }
            return $var;
        }

        function getASCII()
        {//48~57,65~90 //48~83 65-58=7
            $count = ceil(lcg_randf(47, 83));
            if( $count >= 58 )
            {
                $count += 7;
            }
            return chr( $count );
        }

        function lcg_randf($min, $max)
        {
            return $min + lcg_value() * abs($max - $min);
        }
        

        function recurse_copy($src,$dst) {
            $dir = opendir($src); 
            @mkdir($dst); 
            while(false !== ( $file = readdir($dir)) ) { 
                if (( $file != '.' ) && ( $file != '..' )) { 
                    if ( is_dir($src . '/' . $file) ) { 
                        recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                    } 
                    else { 
                        copy($src . '/' . $file,$dst . '/' . $file); 
                    } 
                } 
            } 
            closedir($dir); 
        } 

        function start_session($expire = 0)
        {
            if ($expire == 0) {
                $expire = ini_get('session.gc_maxlifetime');
            } else {
                ini_set('session.gc_maxlifetime', $expire);
            }

            if (empty($_COOKIE['PHPSESSID'])) {
                session_set_cookie_params($expire);
                session_start();
            } else {
                session_start();
                setcookie('PHPSESSID', session_id(), time() + $expire);
            }
        }
        
        function get_string_bywidth( $utf8_str , $length ){

            if( get_string_width($utf8_str) <= $length ){
                    return $utf8_str;
            }
            else {
                    $i = 0;
                    $str = "";
                    for ($index = 0; $index < mb_strlen($utf8_str,'utf8'); $index++) {
                        $i += get_string_width( mb_substr($utf8_str,$index,1,"UTF-8") );
                        if( $i > $length-3 ){
                            $str .= "...";
                            break;
                        }
                        else{
                            $str .= mb_substr($utf8_str,$index,1,"UTF-8");
                        }
                    }
                    return $str;
            }

        }
        function get_string_width( $utf8_str ){
                $i = 0;
                for ($index = 0; $index < mb_strlen($utf8_str,'utf8'); $index++) {
                    if( preg_match("/\p{Han}+/u", mb_substr($utf8_str,$index,1,"UTF-8")) ){
                        //中文 寬度3
                        $i += 3;
                    }
                    else if( ctype_upper(mb_substr($utf8_str,$index,1,"UTF-8")) ){
                        //大寫英文 寬度2
                        $i += 2;
                    }
                    else{
                        //其他1
                        $i ++;
                    }
                }
                return $i;
        }
        
        function DB_CON( $DB_NAME ){
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,$DB_NAME);
                $con->query("SET NAMES utf8");
                $callback = array();
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                $callback['data'] = $con;
                $callback['success'] = true;
                return $callback;
        }
        
        function Check_Member( $con , $token ){
                date_default_timezone_set('Asia/Taipei');
                $callback = array();
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $a_token = json_decode($account[0]["a_token"],true);
                foreach ($a_token as $key => $value) {
                    if( $value["token"] === $token ){
                        if( (int)$value["time"] < (int)strtotime("now") ){
                            unset($a_token[$key]);
                            $a_token = json_encode($a_token);
                            update_sql($con, "account", array( "a_token" => $a_token ), array("a_id"=>$account[0]["a_id"]));
                            $callback['msg'] = "自動登入到期";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                        }
                        else{
                            break;
                        }
                    }
                }
                $callback['data'] = $account;
                $callback['success'] = true;
                return $callback;
        }

//        function Check_Admin( $con , $token ){
//                date_default_timezone_set('Asia/Taipei');
//                $callback = array();
//                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
//                if( !$account ) {
//                        $callback['msg'] = "Login fail";
//                        $callback['success'] = false;
//                        mysqli_close($con);
//                        return $callback;
//                }
//                if( $account[0]['a_admin'] !== "true" ){
//                        $callback['msg'] = "you dont have admin";
//                        $callback['success'] = false;
//                        mysqli_close($con);
//                        return $callback;
//                }
//                $a_token = json_decode($account[0]["a_token"],true);
//                foreach ($a_token as $key => $value) {
//                    if( $value["token"] === $token ){
//                        if( (int)$value["time"] < (int)strtotime("now") ){
//                            unset($a_token[$key]);
//                            $a_token = json_encode($a_token);
//                            update_sql($con, "account", array( "a_token" => $a_token ), array("a_id"=>$account[0]["a_id"]));
//                            $callback['msg'] = "自動登入到期";
//                            $callback['success'] = false;
//                            mysqli_close($con);
//                            return $callback;
//                        }
//                        else{
//                            break;
//                        }
//                    }
//                }
//                $callback['data'] = $account;
//                $callback['success'] = true;
//                return $callback;
//        }
?>