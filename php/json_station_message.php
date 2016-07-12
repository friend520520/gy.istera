<?php
        /*
        * @file json_station_message.php
        * @brief mamage account

        * detail 

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-18 */

        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "fn_sql_show_full_columns_from_message":
                $echo = fn_sql_show_full_columns_from_message();
                break;            
	    case "fn_btn_search_all":
                $echo = fn_btn_search_all();
                break;            
	    case "fn_list_mgc_station_message":
                $echo = fn_list_mgc_station_message();
                break;
            case "fn_btn_new_post_message":
                $echo = fn_btn_new_post_message();
                break;
            case "fn_list_station_message_single_dialogue":
                $echo = fn_list_station_message_single_dialogue();
                break;
            case "fn_btn_update_message":
                $echo = fn_btn_update_message();
                break;
            case "fn_btn_rubbish_delete_board":
                $echo = fn_btn_rubbish_delete_board();
                break;
        }
        
    function fn_sql_show_full_columns_from_message(){
        
        try{
                
                //$token = md5( $_REQUEST[ AJAX_ENTER_TOKEN ] );
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                $cart = array();
                $callback = array();
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                         $result = mysqli_query($con,"SHOW FULL COLUMNS FROM message");
                        if (!$result) {
                            echo 'Could not run query: ' . mysql_error();
                            exit;
                        }
                        if (mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                //print_r($row);
                                $cart[] = array( "field" => $row['Field'],
                                                 "comment" => $row['Comment']);
                            }
                            
                            $callback['data'] = $cart;
                            $callback['success'] = true;
                        }
                        
                        mysqli_close($con);
                        
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
        
    function fn_btn_search_all(){
        try{
                
                //$token = md5( $_REQUEST[ AJAX_ENTER_TOKEN ] );
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                $cart = array();
                $callback = array();
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                            
                        $res = mysqli_query($con, "SELECT * FROM message ORDER BY m_question_date DESC");
                        $i=0;
                        //print_r(mysqli_fetch_array($res));
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                $cart[$i] = array();
                                
                                foreach ($row as $key => $value) {
                                    
                                    if( gettype($key) !== "integer" ){
                                        
                                        if(strpos($value, ".jpg") ||
                                           strpos($value, ".jpeg") ||
                                           strpos($value, ".png") ||
                                           strpos($value, ".gif")){
                                                $cart[$i][$key] = "./data/account/". $cart[$i]["a_id"] ."/". $value;
                                        } else {
                                            
                                            if( $key == 'm_date' ){
                                                $cart[$i][$key] = substr($value,0,10);
                                            } else {
                                                $cart[$i][$key] = $value;
                                            }
                                            
                                        }
                                        
                                    }
                                    
                                }
                                $i++;
                                /*
                                    $cart[] = array( "a_id" => $row["a_id"] , 
                                        "a_icon" => $row["a_icon"] ,
                                        "a_name" => $row["a_name"] ,
                                        "a_nickname" => $row["a_nickname"] ,
                                        "a_email" => $row["a_email"] ,
                                        "a_country" => $row["a_country"] , );
                                */
                        }

                        $callback['data'] =  $cart;
                        $callback['success'] = true;
                        
                        mysqli_close($con);
                        
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
        
    function fn_list_mgc_station_message(){
        try{
                
                //$token = md5( $_REQUEST[ AJAX_ENTER_TOKEN ] );
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                $cart = array();
                $callback = array();
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                            
                        $res = mysqli_query($con, "SELECT * FROM message ORDER BY m_date DESC");
                        $i=0;
                        //print_r(mysqli_fetch_array($res));
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                $cart[$i] = array();
                                
                                foreach ($row as $key => $value) {
                                    
                                    if( gettype($key) !== "integer" ){
                                        
                                        if(strpos($value, ".jpg") ||
                                           strpos($value, ".jpeg") ||
                                           strpos($value, ".png") ||
                                           strpos($value, ".gif")){
                                                $cart[$i][$key] = "./data/account/". $cart[$i]["a_id"] ."/". $value;
                                        } else {
                                            
                                            if( $key == 'm_date' ){
                                                $cart[$i][$key] = substr($value,0,10);
                                            } else {
                                                $cart[$i][$key] = $value;
                                            }
                                            
                                        }
                                        
                                    }
                                    
                                }
                                $i++;
                                /*
                                    $cart[] = array( "a_id" => $row["a_id"] , 
                                        "a_icon" => $row["a_icon"] ,
                                        "a_name" => $row["a_name"] ,
                                        "a_nickname" => $row["a_nickname"] ,
                                        "a_email" => $row["a_email"] ,
                                        "a_country" => $row["a_country"] , );
                                */
                        }

                        $callback['data'] =  $cart;
                        $callback['success'] = true;
                        
                        mysqli_close($con);
                        
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function fn_btn_new_post_message(){
        try{
                date_default_timezone_set('Asia/Taipei');
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                
                //$token = md5( $_REQUEST[ AJAX_ENTER_TOKEN ] );
                //$a_id = $_REQUEST[ 'a_id' ];
                $m_title = $_REQUEST[ 'title' ];
                $m_content = $_REQUEST[ 'content' ];
                //$b_receiver = $_REQUEST[ 'b_receiver' ];
                $m_date = date('Y-m-d H:i:s');
                
                $callback = array();
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                    
                        $sql_cmd = "INSERT INTO message( m_title, m_content, m_date ) "
                                            . "VALUES ( '$m_title','$m_content','$m_date')";

                        if( mysqli_query($con, $sql_cmd) ) {
                            $callback['success'] = true;
                        }
                        else {
                            $callback['msg'] = "INSERT fail";
                            $callback['success'] = false;
                        }
                        
                        mysqli_close($con);
                        
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
        
    function fn_list_station_message_single_dialogue(){
        try{
                if( check_empty( array( "token" , "m_id" ) ) ){
                        $token = md5( $_REQUEST[ "token" ] );
                        $m_id = $_REQUEST[ 'm_id' ];

                        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        $con->query("SET NAMES utf8");

                        $callback = array();
                        $cart = array();

                        if (mysqli_connect_errno()) {
                                $callback['msg'] = "SQL connect fail";
                                $callback['success'] = false;
                                return $callback;
                        }  
                                
                        $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        
                        $res = mysqli_query($con, "SELECT * FROM message WHERE m_id=$m_id");
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                    $cart = array( "m_id"       => $row["m_id"] , 
                                                    "m_title"   => $row["m_title"] ,
                                                    "m_content" => $row["m_content"] );
                        }

                        $callback['data'] =  $cart;
                        $callback['success'] = true;
                        
                        mysqli_close($con);

                        
                }
                else {
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
        
    function fn_btn_update_message(){
        try{
                date_default_timezone_set('Asia/Taipei');
                
                $token = md5( $_REQUEST[ "token" ] );
                $m_id = $_REQUEST[ 'm_id' ];
                $m_title = $_REQUEST[ 'title' ];
                $m_content = $_REQUEST[ 'content' ];
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                
                $callback = array();
                                
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                    
                        $sql_cmd = "UPDATE message SET m_title='$m_title', m_content='$m_content' WHERE m_id=$m_id";

                        if( mysqli_query($con, $sql_cmd) ) {
                                $callback['success'] = true;
                        }
                        else {
                                $callback['msg'] = "UPDATE fail";
                                $callback['success'] = false;
                        }
                        
                        mysqli_close($con);
                        
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function fn_btn_rubbish_delete_board(){
        try{
                if( check_empty( array( "token" , "m_id" ) ) ){
                        $token = md5( $_REQUEST[ "token" ] );
                        $m_id = $_REQUEST[ 'm_id' ];

                        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        $con->query("SET NAMES utf8");

                        $callback = array();

                        if (mysqli_connect_errno()) {
                                $callback['msg'] = "SQL connect fail";
                                $callback['success'] = false;
                                return $callback;
                        }  
                                
                        $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }

                        $sql_cmd = "DELETE FROM message WHERE m_id='$m_id'";

                        if( mysqli_query($con, $sql_cmd) ) {
                                $callback['success'] = true;
                                $callback['data'] = $m_id;
                        }
                        else {
                                $callback['msg'] = "DELETE fail";
                                $callback['success'] = false;
                        }

                        mysqli_close($con);

                        
                }
                else {
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
?>