<?php
        /*
        * @file json_mg_account.php
        * @brief TABLE:account

        * detail 

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-18 */

        define('TABLE_MESSAGE', 'message');
        define('TABLE_MESSAGE_SEARCH', 'message_search');
        
        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "fn_set_answer_message":
                $echo = fn_set_answer_message();
                break;
            case "fn_put_re_answer_message":
                $echo = fn_put_re_answer_message();
                break;
            case "fn_read_howManyMessages_backend"://未答覆、已答覆之訊息數
                $echo = fn_read_howManyMessages_backend();
                break;
            case "fn_read_message_backend_notAnswer_regex"://未答覆
                $echo = fn_read_message_backend_notAnswer_regex();
                break;
            case "fn_read_message_backend_answered_regex"://已答覆
                $echo = fn_read_message_backend_answered_regex();
                break;
            case "fn_read_message_single_dialogue":
                $echo = fn_read_message_single_dialogue();
                break;
            case "fn_btn_checkbox_delete_message":
                $echo = fn_btn_checkbox_delete_message();
                break;
        }
        

    function fn_set_answer_message(){
        try{
                $callback = array();
                $content_arr = array();
                
                if( !check_empty( array( "token" , "email" , "title" , "content" ) ) ){
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                date_default_timezone_set('Asia/Taipei');
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $email = mysqli_real_escape_string($con,$_REQUEST[ 'email' ]);
                $title = mysqli_real_escape_string($con,$_REQUEST[ 'title' ]);
                $content = $_REQUEST[ 'content' ];
                $token = md5($_REQUEST[ 'token' ]);
                
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");//管理員a_id
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                
                $receiver = get_sql($con, "account", "WHERE a_email LIKE '".$email."'");//管理員a_id
                if( !$receiver ) {
                        $callback['msg'] = "會員Email有誤";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                
                $date = date('Y-m-d H:i:s');
                $date_to_sec = strtotime($date);
                
                $content_arr[] = array(
                        "second" => $date_to_sec,
                        "role" => "answer",
                        "content" => $content
                );
                
                $sql = "INSERT INTO message ( a_id, m_admin_id, m_answer_date, m_title, m_answer ) VALUES ( '" .$receiver[0]['a_id']. "' , '".$account[0]['a_id']."', '" .$date. "' , '" .$title. "' , '" .mysqli_real_escape_string($con,json_encode($content_arr)). "' )";
                if( mysqli_query($con, $sql) ) {
                        $callback['success'] = true;
                }
                else {
                        $callback['msg'] = "INSERT fail";
                        $callback['success'] = false;
                }

                mysqli_close($con);
                     
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function fn_put_re_answer_message(){
        try{
                $callback = array();
                $content_arr = array();
                
                if( !check_empty( array( "token" , "m_id" , "content" ) ) ){
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                date_default_timezone_set('Asia/Taipei');
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $m_id = $_REQUEST[ 'm_id' ];
                $content = $_REQUEST[ 'content' ];
                $token = md5($_REQUEST[ 'token' ]);
                
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                $admin_id = $account[0]['a_id'];
                
                $date = date('Y-m-d H:i:s');
                $date_to_sec = strtotime($date);
                
                $content_arr_original = get_sql($con, "message", "WHERE m_id=$m_id" , "m_answer");
                $content_arr = $content_arr_original[0]["m_answer"];
                $content_arr = json_decode($content_arr,true);
                
                $content_arr[] = array(
                        "second" => $date_to_sec,
                        "role" => "answer",
                        "content" => $content );
                
                $sql = "UPDATE message SET m_answer_date='".$date."', m_answer='".mysqli_real_escape_string($con,json_encode($content_arr))."', m_admin_id='$admin_id'  WHERE m_id=$m_id";
                if( mysqli_query($con, $sql) ) {
                        $callback['success'] = true;
                }
                else {
                        $callback['msg'] = "INSERT fail";
                        $callback['success'] = false;
                }

                mysqli_close($con);
                     
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function fn_read_howManyMessages_backend(){
        try{
                $callback = array();
                $cart = array();
                
                if( !check_empty( array( "token" ) ) ){
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                date_default_timezone_set('Asia/Taipei');
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $token = md5($_REQUEST[ 'token' ]);
                
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                
                $res_notAnswer = mysqli_query($con, "SELECT * FROM message WHERE m_display='block' AND m_answer_date < m_question_date");
                $res_answered = mysqli_query($con, "SELECT * FROM message WHERE m_display='block' AND m_answer_date > m_question_date");
                
                $cart = array( "notAnswer"   => mysqli_num_rows($res_notAnswer) ,
                                "answered"   => mysqli_num_rows($res_answered) );
                
                $callback['data'] = $cart;
                $callback['success'] = true;
                
                mysqli_close($con);
                     
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);


    }
    
    function fn_read_message_backend_notAnswer_regex(){
        try{
                $operation_html = empty($_REQUEST[ "operation_html" ]) ? "" : $_REQUEST["operation_html"];
                
                $callback = array();
                $content_arr = array();
                $cart_not_answer = array();
                
                if( !check_empty( array( "token" ) ) ){
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                date_default_timezone_set('Asia/Taipei');
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $token = md5($_REQUEST[ 'token' ]);
                
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                
                $not_answer = mysqli_query($con, "SELECT m.m_id, m.a_id, m.m_question_date, m.m_title, m.m_file, m.m_admin_id, m.m_answer_date, a.a_nickname FROM message as m LEFT JOIN account as a on a.a_id = m.a_id WHERE m.m_display='block' AND m.m_answer_date < m.m_question_date ORDER BY m.m_question_date DESC");

                while($row = mysqli_fetch_array($not_answer)) {
                        
                        $m_title = (mb_strlen( $row['m_title'], "utf-8")>20)? mb_substr( $row['m_title'],0,19, "utf-8")."...":$row['m_title'];
                        
                        $cart_not_answer[] = array( "0"   => $row["m_id"] ,
                                                    "1"   => $row["m_question_date"] ,
                                                    "2"   => $row["a_nickname"],
                                                    "3"   => $m_title ,
                                                    "4"   => $operation_html );
                }

                $callback['data'] = $cart_not_answer;
                
                mysqli_close($con);
                     
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);


    }
    
    function fn_read_message_backend_answered_regex(){
        try{
                $operation_html = empty($_REQUEST[ "operation_html" ]) ? "" : $_REQUEST["operation_html"];
                
                $callback = array();
                $content_arr = array();
                $cart_answered = array();
                
                if( !check_empty( array( "token" ) ) ){
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                date_default_timezone_set('Asia/Taipei');
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $token = md5($_REQUEST[ 'token' ]);
                
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                $a_id = $account[0]['a_id'];
                                
                $answered = mysqli_query($con, "SELECT m.m_id, m.a_id, m.m_question_date, m.m_title, m.m_file, m.m_admin_id, m.m_answer_date, a.a_nickname FROM message as m LEFT JOIN account as a on a.a_id = m.m_admin_id WHERE m.m_display='block' AND m.m_answer_date > m.m_question_date ORDER BY m.m_question_date DESC");

                while($row = mysqli_fetch_array($answered)) {
                        
                        $m_title = (mb_strlen( $row['m_title'], "utf-8")>20)? mb_substr( $row['m_title'],0,19, "utf-8")."...":$row['m_title'];
                        
                        $cart_answered[] = array( "0" => $row["m_id"] ,
                                                "1"   => $row["m_answer_date"],
                                                "2"   => $row["a_nickname"],
                                                "3"   => $m_title ,
                                                "4"   => $operation_html );
                }

                $callback['data'] = $cart_answered;
                
                mysqli_close($con);
                     
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);


    }
    
    function fn_read_message_single_dialogue(){
        try{
                $callback = array();
                $cart = array();
                $i = 0;

                if( !check_empty( array( "token" , "m_id") ) ){
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }

                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                date_default_timezone_set('Asia/Taipei');

                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }

                $token = md5($_REQUEST[ 'token' ]);
                $m_id = $_REQUEST[ 'm_id' ];

                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }

                $res = mysqli_query($con, "SELECT * FROM message WHERE m_id=$m_id");

                while($row = mysqli_fetch_array($res)) {
//                        $m_content = json_decode($row["m_content"],true);
                        $m_content = ($row["m_content"] == "")? array():json_decode($row["m_content"],true);
                        ($row["m_answer"] == "")? $m_answer ="" : $m_answer = json_decode($row["m_answer"],true);
                        
                        if( $m_answer ) {
                                /*若$m_answer為array 則與$m_content合併成$q_and_a，在依照$q_and_a[$i]['second']排序*/
                                $q_and_a = array_merge($m_content,$m_answer);
                                // [{"second":1460707890,"content":"question"},{"second":1460707891,"content":"answer"}, ...]
                                uasort($q_and_a, 'sort_by_second');
                                $q_and_a = array_values($q_and_a);

                                foreach ($q_and_a as $key => $value) {
                                        $q_and_a[$i]['second'] = date('Y-m-d H:i:s', (int)$value['second']);
                                        $i++;
                                }
                                //print_r($q_and_a);

                                $cart = array( "m_id"       => $row["m_id"] ,
                                                "a_id"   => $row["a_id"] ,
                                                "m_question_date"   => $row["m_question_date"] ,
                                                "m_title"   => $row["m_title"] ,
                                                "q_and_a" => json_encode($q_and_a) ,
                                                "m_file" => $row["m_file"] ,
                                                "m_admin_id"   => $row["m_admin_id"] ,
                                                "m_answer_date" => $row["m_answer_date"] );
                        } else {
                                /*若$m_answer為空字串*/
                                foreach ($m_content as $key => $value) {
                                        $m_content[$i]['second'] = date('Y-m-d H:i:s', (int)$value['second']);
                                        $i++;
                                }
                                $cart = array( "m_id"       => $row["m_id"] ,
                                                "a_id"   => $row["a_id"] ,
                                                "m_question_date"   => $row["m_question_date"] ,
                                                "m_title"   => $row["m_title"] ,
                                                "q_and_a" => json_encode($m_content) ,
                                                "m_file" => $row["m_file"] ,
                                                "m_answer_date" => $row["m_answer_date"] );
                        }
                }

                $callback['data'] =  $cart;
                $callback['success'] = true;

                mysqli_close($con);

        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function sort_by_second($a, $b)
    {
        if($a['second'] == $b['second']) return 0;
        return ($a['second'] > $b['second']) ? 1 : -1;
    }
    
    function fn_btn_checkbox_delete_message(){
        $callback = array();
        try{
                if( !check_empty( array( "token" ,"trash_can" ) ) ){
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }

                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                date_default_timezone_set('Asia/Taipei');

                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }

                $token = md5($_REQUEST[ 'token' ]);
                $trash_can = json_decode($_REQUEST[ "trash_can" ],true);

                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }

                    $cond = "";
                    foreach ($trash_can as $key => $value) {
                            $cond .= ( $key === 0 ) ? "m_id=$value" : " OR m_id=$value";
                    }

                    if( mysqli_query($con, "UPDATE message SET m_display='deleted' WHERE $cond") ){
                            $callback['data'] = $trash_can;
                            $callback['success'] = true;
                    }
                    else{
                            $callback['msg'] = "刪除訊息失敗";
                            $callback['success'] = false;
                    }

                    mysqli_close($con);

        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);

    }

?>
