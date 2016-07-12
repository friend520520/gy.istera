<?php
        /*
        * @file json_site_notice_manage.php
        * @brief DB:funbook19 TABLE: board 
        *           frontpage: site_notice_manage.php

        * detail 

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-31 */

        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "sql_show_full_columns_from_board":
                $echo = sql_show_full_columns_from_board();
                break;
            case "fn_btn_search_all":
                $echo = fn_btn_search_all();
                break;
            case "fn_list_site_notice_message_single_dialogue":
                $echo = fn_list_site_notice_message_single_dialogue();
                break;
            case "fn_btn_new_post_board":
                $echo = fn_btn_new_post_board();
                break;
            case "fn_btn_update_board":
                $echo = fn_btn_update_board();
                break;
            case "fn_btn_rubbish_delete_board":
                $echo = fn_btn_rubbish_delete_board();
                break;
            case "fn_btn_checkbox_delete_board": //批次刪除公告
                $echo = fn_btn_checkbox_delete_board();
                break;
        }
        
    function sql_show_full_columns_from_board(){
        
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
                         $result = mysqli_query($con,"SHOW FULL COLUMNS FROM board");
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
                            
                        $res = mysqli_query($con, "SELECT * FROM board ORDER BY b_date DESC");
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
                                            
                                            if( $key == 'b_date' ){
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
        
    function fn_list_site_notice_message_single_dialogue(){
        try{
                if( check_empty( array( "token" , "b_id" ) ) ){
                        $token = md5( $_REQUEST[ "token" ] );
                        $b_id = $_REQUEST[ 'b_id' ];

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
                        
                        $res = mysqli_query($con, "SELECT * FROM board WHERE b_id=$b_id");
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                    $cart = array( "b_id"       => $row["b_id"] , 
                                                    "b_title"   => $row["b_title"] ,
                                                    "b_content" => $row["b_content"] );
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
    
        
    function fn_btn_new_post_board(){
        try{
                date_default_timezone_set('Asia/Taipei');
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                
                //$token = md5( $_REQUEST[ AJAX_ENTER_TOKEN ] );
                //$a_id = $_REQUEST[ 'a_id' ];
                $b_title = $_REQUEST[ 'title' ];
                $b_content = $_REQUEST[ 'content' ];
                //$b_receiver = $_REQUEST[ 'b_receiver' ];
                $b_date = date('Y-m-d H:i:s');
                
                $callback = array();
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                    
                        $sql_cmd = "INSERT INTO board( b_title, b_content, b_date ) "
                                            . "VALUES ( '$b_title','$b_content','$b_date')";

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
        
    function fn_btn_update_board(){
        try{
                date_default_timezone_set('Asia/Taipei');
                
                $token = md5( $_REQUEST[ "token" ] );
                $b_id = $_REQUEST[ 'b_id' ];
                $b_title = $_REQUEST[ 'title' ];
                $b_content = $_REQUEST[ 'content' ];
                //$b_date = date('Y-m-d H:i:s');
                
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
                    
                        $sql_cmd = "UPDATE board SET b_title='$b_title', b_content='$b_content' WHERE b_id=$b_id";

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
                if( check_empty( array( "token" , "b_id" ) ) ){
                        $token = md5( $_REQUEST[ "token" ] );
                        $b_id = $_REQUEST[ 'b_id' ];

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

                        $sql_cmd = "DELETE FROM board WHERE b_id='$b_id'";

                        if( mysqli_query($con, $sql_cmd) ) {
                                $callback['success'] = true;
                                $callback['data'] = $b_id;
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
    
function fn_btn_checkbox_delete_board(){
        $callback = array();
        try{
                if( check_empty( array( "token","list" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $list = json_decode($_REQUEST[ "list" ],true);
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            echo json_encode($callback);
                            return;
                    }
                    
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            echo json_encode($callback);
                            return;
                    }
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            echo json_encode($callback);
                            return;
                    }
                    
                    $cond = "";
                    foreach ($list as $key => $value) {
                            $cond .= ( $key === 0 ) ? "b_id='$value'" : " OR b_id='$value'";
                    }
                    
                    if( mysqli_query($con, "DELETE FROM board WHERE $cond") ){
                            $callback['data'] = $list;
                            $callback['success'] = true;
                    }
                    else{
                            $callback['msg'] = "刪除失敗";
                            $callback['success'] = false;
                    }
                    
                    mysqli_close($con);
                }
                else {
                    $callback['msg'] = "輸入資料不完整";
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