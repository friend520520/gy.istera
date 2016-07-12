<?php

    include 'config.php'; 
    include 'global.php';
    include 'sample/check_login.php';    
    
    if(isset($_REQUEST["a_principle"]) && !empty($_REQUEST["a_principle"]))  
    {
            $a_principle = $_REQUEST["a_principle"];
    }
    if(isset($_REQUEST["operation_html"]) && !empty($_REQUEST["operation_html"]))  
    {
            $operation_html = $_REQUEST["operation_html"];
    }
    else 
    {
            $operation_html = "";
    }        
/*
    if(isset($_REQUEST["token"]) && !empty($_REQUEST["token"])) 
    {
            $token = $_REQUEST["token"];
    }   
    
    $check = check_login($con);
    if( !$check["success"] )
    {
            $callback['msg'] = "token not given";
            $callback['success'] = false;
    } 
    $account = $check["data"];     
    $a_id    = $account["a_id"];    
*/
    
    switch ( $_REQUEST["func"] ) 
    {
        case "per_help":
            $echo = per_help($_REQUEST["a_id"],$operation_html);
            break;
        case "per_ask":
            $echo = per_ask($_REQUEST["a_id"],$operation_html);
            break;
        case "help":
            $echo = help($operation_html);
            break;
        case "ask":
            $echo = ask($operation_html);
            break;
        case "fake_help":
            $echo = fake_help($a_principle);
            break; 
        case "fake_ask":
            $echo = fake_ask($a_principle);
            break;
        case "pair":
            $echo = pair($_REQUEST["a_no_help"], $_REQUEST["a_no_ask"]);
            break;
        case "pairlist":
            $echo = pairlist($operation_html);
            break; 
        case "account":
            $echo = account($_REQUEST["a_id"],$operation_html);
            break;
        case "sms":
            $echo = sms($_REQUEST["msg"]);
            break;
        case "check_state_change":
            $echo = check_state_change($_REQUEST["a_id"],$_REQUEST["a_no"]);
            break;
        case "lock":
            $echo = lock($_REQUEST["a_id"]);
            break;
        case "multi_pair":
            $echo = multi_pair($_REQUEST["a_id_help"], $_REQUEST["a_no_help"], $_REQUEST["a_id_ask"], $_REQUEST["a_no_ask"]);
            break;
    }

    function per_help($a_id, $operation_html ="")
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return $callback;
            }  

            $a_order = mysqli_query($con, "   SELECT * 
                                                FROM account_order 
                                           Left Join account
                                                  on account.a_id = account_order.a_id
                                               WHERE account_order.a_state = 1
                                                 AND account_order.a_id = '$a_id'
                                            order by ( a_principle + a_interest )
                                          ");
            
            if( mysqli_num_rows($a_order) > 0 )
            {    
                    //$i = 0;
                    while( $row = mysqli_fetch_array($a_order) ) 
                    {
                            $total = $row["a_principle"] + $row["a_interest"];
                            $data[] = array(
                                                    "0" => $row['a_no'],
                                                    "1" => $row['a_start'],
                                                    "2" => $row['a_email'],
                                                    "3" => $row['a_phone'],
                                                    "4" => "$total",
                                                    "5" => $operation_html
                                            );
                    }

                    $callback['data'] = $data;
                    $callback['success'] = true;
            }
            else  
            {
                    $callback['success'] = false;
                    $callback['msg'] = 'order not found';
            }
            mysqli_close($con);
            echo json_encode($callback);
    }
    
    function per_ask($a_id, $operation_html ="")
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return $callback;
            }  

            $a_order = mysqli_query($con, "   SELECT * 
                                                FROM account_order 
                                           Left Join account
                                                  on account.a_id = account_order.a_id
                                               WHERE account_order.a_state = 6
                                                 AND account_order.a_id = '$a_id'
                                            order by ( a_principle + a_interest )
                                          ");
            
            if( mysqli_num_rows($a_order) > 0 )
            {    
                    //$i = 0;
                    while( $row = mysqli_fetch_array($a_order) ) 
                    {
                            $total = $row["a_principle"] + $row["a_interest"];
                            $data[] = array(
                                                    "0" => $row['a_no'],
                                                    "1" => $row['a_start'],
                                                    "2" => $row['a_email'],
                                                    "3" => $row['a_phone'],
                                                    "4" => "$total",
                                                    "5" => $operation_html
                                            );
                    }

                    $callback['data'] = $data;
                    $callback['success'] = true;
            }
            else  
            {
                    $callback['success'] = false;
                    $callback['msg'] = 'order not found';
            }
            mysqli_close($con);
            echo json_encode($callback);
    }
    
    function help($operation_html = "")
    {
            date_default_timezone_set('Asia/Taipei');    
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return $callback;
            }  

            $a_order = mysqli_query($con, "   SELECT * 
                                                FROM account_order 
                                           Left Join account
                                                  on account.a_id = account_order.a_id
                                               WHERE account_order.a_state = 1 
                                            order by ( a_principle )
                                          ");
            
            if( mysqli_num_rows($a_order) > 0 )
            {    
                    //$i = 0;
                    while( $row = mysqli_fetch_array($a_order) ) 
                    {
                            $total = $row["a_principle"];
                            $data[] = array(
                                                    "0" => $row['a_no'],
                                                    "1" => $row['a_start'],
                                                    "2" => $row['a_email'],
                                                    "3" => $row['a_registration_time'],
                                                    "4" => "$total",
                                                    "5" => $operation_html
                                            );
                    }

                    $callback['data'] = $data;
                    $callback['success'] = true;
            }
            else  
            {
                    $callback['success'] = false;
                    $callback['msg'] = 'order not found';
            }
            mysqli_close($con);
            echo json_encode($callback);
    }
    
    function ask($operation_html = "")
    {
            date_default_timezone_set('Asia/Taipei');    
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array(); 

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return $callback; 
            }  

            $a_order = mysqli_query($con, "   SELECT * 
                                                FROM account_order 
                                           Left Join account
                                                  on account.a_id = account_order.a_id
                                               WHERE account_order.a_state = 6 
                                            order by ( a_principle + a_interest )
                                          "); 
            
            if( mysqli_num_rows($a_order) > 0 )
            {    
                    //$i = 0;
                    while( $row = mysqli_fetch_array($a_order) ) 
                    {
                            $total = $row["a_principle"] + $row["a_interest"];
                            $data[] = array(
                                                    "0" => $row['a_no'],
                                                    "1" => $row['a_start'],
                                                    "2" => $row['a_email'],
                                                    "3" => $row['a_registration_time'],
                                                    "4" => "$total",
                                                    "5" => $operation_html
                                            );
                    }
                    $callback['data'] = $data;
                    $callback['success'] = true;
            }
            else  
            {
                    $callback['success'] = false;
                    $callback['msg'] = 'order not found';
            }
            mysqli_close($con);
            echo json_encode($callback);
    }
    
    function fake_help($a_principle)
    {
            $a_id = 'HPBBZ0952JFMHTSRVFIW';

            date_default_timezone_set('Asia/Taipei');    

            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return $callback;
            }  

            if( $a_principle != null )
            {    
                    date_default_timezone_set('Asia/Taipei');    
                    $callback = array();
                    $check_account = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
                    if( mysqli_num_rows($check_account) > 0 )
                    {
                            $callback['msg'] = "Id exist in account_profile";
                    }
                    else 
                    {
                            $insert_array_profile = array( "a_id"       => $a_id ,
                                                           "a_s1_num"   => 0 ,
                                                           "a_s2_num"   => 0,
                                                           "a_s3_num"   => 0,
                                                           "a_s4_num"   => 0,
                                                           "a_s5_num"   => 0,
                                                           "a_s5.1_num" => 0,
                                                           "a_s5.2_num" => 0,
                                                           "a_s6_num"   => 0,
                                                           "a_s7_num"   => 0,
                                                           "a_s7_total" => 0,
                                                           "a_s8_num"   => 0,
                                                           "a_s8.1_num" => 0,
                                                           "a_s9_num"   => 0,
                                                           "a_s10_num"  => 0 );

                            if( insert_sql($con, "account_profile", $insert_array_profile) ) 
                            {
                                    $callback['success'] = true;
                            }
                            else  
                            {
                                    $callback['success'] = false;
                                    $callback['msg'] = "Id add fail in account_profile";
                                    echo json_encode($callback);
                                    //mysqli_close($con);
                                    return $callback;
                            }
                    }

                    // Do event
                    $a_now =date('Y-m-d H:i:s');
                    $build_a_no = microtime(true)*10000;
                    while (1){
                        if( !get_sql($con, "account_order" , "WHERE a_no='$build_a_no'") ){
                            break;
                        }
                        $build_a_no--;
                    }
                    $insert_array = array( "a_id"        => $a_id,
                                           "a_no"        => $build_a_no,
                                           "a_principle" => $a_principle,
                                           "a_interest"  => 0,
                                           "a_state"     => 1,
                                           "a_start"     => $a_now/*,
                                           "a_type"      => false */);

                    if( insert_sql($con, "account_order", $insert_array) ) 
                    { 
                            $callback['success'] = true;
                    }
                    else
                    {
                            $callback['success'] = false;
                            $callback['msg'] = "account_order add fail";
                            echo json_encode($callback);
                            return $callback; 
                   }

                    $result = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
                    if( mysqli_num_rows($result) > 0 ) 
                    {
                            while( $col = mysqli_fetch_array($result) )
                            {
                                    $json = array( "a_s1_num" => $col["a_s1_num"] + 1 );
                                    update_sql($con, "account_profile", $json , array( "a_id" => $col["a_id"] ));
                                    $callback['success'] = true;                                                        
                            }
                    }
                    else
                    {
                            $callback['success'] = false;
                            $callback['msg'] = "account_profile update fail";
                    }
            }
            else
            {
                    $callback['msg'] = "a_principle is null";
                    $callback['success'] = false;
            }        
            echo json_encode($callback);
    }
    
    function fake_ask($a_principle)
    {
            $a_id = 'HPBBZ0952JFMHTSRVFI2';

            date_default_timezone_set('Asia/Taipei');     

            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return $callback;
            }  

            if( $a_principle != null )
            {    
                    date_default_timezone_set('Asia/Taipei');    
                    $callback = array();
                    $check_account = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
                    if( mysqli_num_rows($check_account) > 0 )
                    {
                            $callback['msg'] = "Id exist in account_profile";
                    }
                    else 
                    {
                            $insert_array_profile = array( "a_id"       => $a_id ,
                                                           "a_s1_num"   => 0 ,
                                                           "a_s2_num"   => 0,
                                                           "a_s3_num"   => 0,
                                                           "a_s4_num"   => 0,
                                                           "a_s5_num"   => 0,
                                                           "a_s5.1_num" => 0,
                                                           "a_s5.2_num" => 0,
                                                           "a_s6_num"   => 0,
                                                           "a_s7_num"   => 0,
                                                           "a_s7_total" => 0,
                                                           "a_s8_num"   => 0,
                                                           "a_s8.1_num" => 0,
                                                           "a_s9_num"   => 0,
                                                           "a_s10_num"  => 0 );

                            if( insert_sql($con, "account_profile", $insert_array_profile) ) 
                            {
                                    $callback['success'] = true;
                            }
                            else  
                            {
                                    $callback['success'] = false;
                                    $callback['msg'] = "Id add fail in account_profile";
                                    echo json_encode($callback);
                                    return $callback;
                            }
                    }

                    // Do event
                    $a_now =date('Y-m-d H:i:s');
                    $build_a_no = microtime(true)*10000;
                    while (1){
                        if( !get_sql($con, "account_order" , "WHERE a_no='$build_a_no'") ){
                            break;
                        }
                        $build_a_no--;
                    }
                    $insert_array = array( "a_id"        => $a_id,
                                           "a_no"        => $build_a_no,
                                           "a_principle" => $a_principle,
                                           "a_interest"  => 0,
                                           "a_state"     => 6,
                                           "a_start"     => $a_now/*,
                                           "a_type"      => false */);
                    
                    if( insert_sql($con, "account_order", $insert_array) ) 
                    { 
                            $callback['success'] = true;
                    }
                    else
                    {
                            $callback['success'] = false;
                            $callback['msg'] = "account_order add fail";
                            echo json_encode($callback);
                            return $callback;
                   }

                    $result = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
                    if( mysqli_num_rows($result) > 0 ) 
                    {
                            while( $col = mysqli_fetch_array($result) )
                            {
                                    $json = array( "a_s6_num" => $col["a_s6_num"] + 1 );
                                    update_sql($con, "account_profile", $json , array( "a_id" => $col["a_id"] ));
                                    $callback['success'] = true;                                                        
                            }
                    }
                    else
                    {
                            $callback['success'] = false;
                            $callback['msg'] = "account_profile update fail";
                    }
            }
            else
            {
                    $callback['msg'] = "a_principle is null";
                    $callback['success'] = false;
                    return $callback; 
            }        
            $callback['success'] = true;
            echo json_encode($callback);
    }
    
    function pair($a_no_help, $a_no_ask)
    {
            if($a_no_help != null && $a_no_ask != null )
            {
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    
                    date_default_timezone_set('Asia/Taipei');    

                    $check_help_pair = mysqli_query($con, "select a_no,a_state,a_id,a_principle as 'total' from account_order where a_no='$a_no_help'" );
                    $c_h_p = mysqli_fetch_array($check_help_pair);
                    
                    $check_ask_pair = mysqli_query($con, "select a_no,a_state,a_id,a_principle+a_interest as 'total' from account_order where a_no='$a_no_ask'" );
                    $c_a_p = mysqli_fetch_array($check_ask_pair);
                    
                    if( $c_h_p["total"] !== $c_a_p["total"] ){
                            $callback['success'] = false;
                            $callback['msg'] = "配對金額不同";
                    }
                    else if( $c_h_p["a_state"] == 1 || $c_a_p["a_state"] == 6 )
                    {
                            $insert_array_profile = array( "a_id_help" => $c_h_p["a_id"],
                                                           "a_no_help" => $a_no_help,
                                                           "a_id_ask"  => $c_a_p["a_id"],
                                                           "a_no_ask"  => $a_no_ask,
                                                           "ap_value"  => $c_h_p["total"],
                                                           "a_time"    =>date('Y-m-d H:i:s') );

                            if( insert_sql($con, "account_pair", $insert_array_profile) ) 
                            {
                                    $callback['success'] = true;
                                    
                                    $result = mysqli_query($con,"SHOW TABLE STATUS LIKE 'account_pair'");
                                    $row = mysqli_fetch_array($result);
                                    $ap_id = (int)$row['Auto_increment'] - 1 ;
                                    if( !file_exists(pair_path.$ap_id) ){
                                        mkdir(pair_path.$ap_id, 0777, true);
                                    }
                                    
                                    $cmd = "INSERT INTO account_order (a_no,a_state) VALUES (".$c_h_p["a_no"].",3),(".$c_a_p["a_no"].",8)
                                                ON DUPLICATE KEY UPDATE a_state=VALUES(a_state),a_state=VALUES(a_state)";
                                    if( !mysqli_query( $con , $cmd ) ){
                                            $callback['success'] = false;
                                            $callback['msg'] = "update state error";
                                    }
                            }
                            else  
                            {
                                    $callback['success'] = false;
                                    $callback['msg'] = "Pair add fail in account_pair";
                            }
                    }
                    else
                    {
                            $callback['success'] = false;
                            $callback['msg'] = "幫助單或被幫助單錯誤";
                    }        
                    mysqli_close($con);
            }
            else
            {
                    $callback['success'] = false;
                    $callback['msg'] = "help or ask have a_id or a_no missing or both id are same";
            }
            echo json_encode($callback);
    }
    
    function pairlist($operation_html = "")
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");
            
            date_default_timezone_set('Asia/Taipei');    

            $result = mysqli_query($con, "   SELECT a_id_help,
                                                    a_no_help,
                                                    a_id_ask,
                                                    a_no_ask,
                                                    a_time,
                                                    b1.a_email     as help_email,
                                                    c1.a_caption   as help_caption,
                                                    a1.a_principle as help_principle,
                                                    a_time         as help_time,
                                                    b2.a_email     as ask_email, 
                                                    c2.a_caption   as ask_caption,
                                                    a2.a_principle as ask_principle,
                                                    a_time         as ask_time
                                               FROM account_pair
                                          LEFT JOIN account b1
                                                 ON b1.a_id = a_id_help
                                          LEFT JOIN account b2
                                                 ON b2.a_id = a_id_ask
                                          LEFT JOIN account_order a1
                                                 ON a1.a_id = a_id_help
                                                AND a1.a_no = a_no_help
                                          LEFT JOIN account_order a2
                                                 ON a2.a_id = a_id_ask
                                                AND a2.a_no = a_no_ask
                                          LEFT JOIN account_event c1
                                                 ON c1.a_state = a1.a_state 
                                          LEFT JOIN account_event c2
                                                 ON c2.a_state = a2.a_state");

            if( mysqli_num_rows($result) > 0 )
            {
                    while( $row = mysqli_fetch_array($result) ) 
                    { 
                            $a_now = date('Y-m-d H:i:s'); 
                            $help_day = floor((strtotime($a_now) - strtotime($row['a_time']))/ (60*60*24)); 
                            $ask_day  = floor((strtotime($a_now) - strtotime($row['a_time']))/ (60*60*24)); 
                            $left_help_hour = floor((strtotime("{$row['a_time']} +1 day") - strtotime($a_now))/ (60*60)); 
                            $left_ask_hour = floor((strtotime("{$row['a_time']} +3 day") - strtotime($a_now))/ (60*60)); 

                            if( $help_day > 1 )  
                            { 
                                    $help_expired = "已過期 $help_day 天" ; 
                            }     
                            else
                            {
                                    $help_expired = "剩餘 $left_help_hour 小時";
                                    if( $left_help_hour < 1 )
                                    {
                                            $left_help_hour = floor($left_help_hour*60);
                                            $help_expired = "剩餘 $left_help_hour 分鐘";
                                    } 
                            }

                            if( $ask_day > 3 )
                            {
                                    $ask_day = $ask_day-3;
                                    $ask_expired = "已過期 $ask_day 天";
                            }    
                            else
                            {
                                    if( $left_ask_hour == 72 )
                                    {
                                            $ask_expired = "剩餘 3 天"; 
                                    }
                                    else if( 48 <= $left_ask_hour && $left_ask_hour < 72 )
                                    {
                                            $left_ask_hour = $left_ask_hour - 48;
                                            $ask_expired = "剩餘 2 天 $left_ask_hour 小時";
                                    }
                                    else if( 24 <= $ask_day && $ask_day < 48 )
                                    {
                                            $left_ask_hour = $left_ask_hour - 24;
                                            $ask_expired = "剩餘 1 天 $left_ask_hour 小時";
                                    }
                                    else if( 1 <= $ask_day && $ask_day < 24 )
                                    {
                                            $ask_expired = "剩餘 $left_ask_hour 小時";
                                    }
                                    else
                                    {
                                            $left_ask_hour = floor($left_ask_hour*60);
                                            $ask_expired = "剩餘 $left_ask_hour 分鐘";
                                    }
                            }

                            $data[] = array(
                                                    "0" => array($row['a_id_help'],$row['a_no_help'],$row['a_id_ask'],$row['a_no_ask'],$row['a_time']),
                                                    "1" => $row['help_email'],
                                                    "2" => $row['help_caption'],
                                                    "3" => $row['help_principle'],
                                                    "4" => $row['help_time'],
                                                    "5" => $help_expired,
                                                    "6" => $row["ask_email"],
                                                    "7" => $row["ask_caption"],
                                                    "8" => $row['ask_principle'],
                                                    "9" => $row['ask_time'],
                                                    "10" => $ask_expired,
                                                    "11" => $operation_html
/*                                                    "9" => "<td class=\"child-inline center\">".
                                                                    "<button id=\"pencil\" style=\"margin-right:5px;\" class=\"btn btn-xs btn-info blue-button\">".
                                                                        "<i class=\"ace-icon fa fa-pencil bigger-120\"></i>".
                                                                    "</button>".
                                                                    "<button id=\"pause_member\" style=\"margin-right:5px;\" class=\"btn btn-xs btn-danger green-button\"></button>".
                                                            "</td>"*/
                                            );
                      } 
 
                    $callback['data'] = $data;  
                    $callback['success'] = true;
            }
            else
            {
                    $callback['msg'] = 'no order pairing';  
                    $callback['success'] = false;
            }
            mysqli_close($con); 
            echo json_encode($callback);
    }
    
    function account( $a_id, $operation_html = "" )
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");
            
            date_default_timezone_set('Asia/Taipei');    

            $result = mysqli_query($con, "SELECT * FROM account where a_id='$a_id'");

            if( mysqli_num_rows($result) > 0 )
            {
                    while( $row = mysqli_fetch_array($result) ) 
                    {
                            $i = 0;
                            $box = array();
                            foreach( $row as $val )
                            {
                                    if( $i%2 == 0 )  
                                    {
                                            $j = $i/2;
                                            $box[$j] = $val;
                                    }
                                    $i++;
                            }
                            
                            $data[] = array(
                                                    "0" => $box,
                                                    "1" => $operation_html
                                            );
                      } 
 
                    $callback['data'] = $data;  
                    $callback['success'] = true;
            }
            else
            {
                    $callback['msg'] = 'no order pairing';  
                    $callback['success'] = false;
            }
            mysqli_close($con); 
            echo json_encode($callback);
    }
    
    function sms($msg)
    {
            $ID="jack99";//帳號..
            $PW="jack99";//密碼..

            //SourceProdID,SourceMsgID 可依時間亂數產生..
            $SourceProdID="YOYO8SMS";
            srand((double)microtime()*1000000);
            $SourceMsgID=time().rand(1,9999);
            $Password=md5("$ID:$PW:$SourceProdID:$SourceMsgID");

            //$Phone=$_REQUEST["num"];//接收簡訊手機號碼..
            $Phone='0933516336';//接收簡訊手機號碼..
            $CharSet="U";//簡訊文字編碼..

            //$SMSMessage=$_REQUEST["msg"];//簡訊內容..
            $SMSMessage=$msg;//簡訊內容..
            $SMSMessage=urlencode($SMSMessage);//URLEncode..

            $ch = curl_init();
            $ChkUrl="http://www.yoyo8.com.tw/SMSBridge.php"
            ."?MemberID=$ID"
            ."&Password=$Password"
            ."&MobileNo=$Phone"
            ."&CharSet=$CharSet"
            ."&SMSMessage=$SMSMessage"
            ."&SourceProdID=$SourceProdID"
            ."&SourceMsgID=$SourceMsgID"
            ;

            curl_setopt($ch, CURLOPT_URL, $ChkUrl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $aResult = curl_exec($ch);
            curl_close($ch);

            $cReturnArray=array();
            $cReturnArray=explode("&",$aResult);
            foreach ($cReturnArray as $row) 
            {
                    $row=trim(urldecode($row));
                    if (preg_match("/^status=/",$row)) 
                    {
                            $status=preg_replace("/^status=/","",$row);
                    }

                    if (preg_match("/^MemberID=/",$row)) 
                    {
                            $MemberID=preg_replace("/^MemberID=/","",$row);
                    }

                    if (preg_match("/^MessageID=/",$row)) 
                    {
                            $MessageID=preg_replace("/^MessageID=/","",$row);
                    }

                    if (preg_match("/^UsedCredit=/",$row)) 
                    {
                            $UsedCredit=preg_replace("/^UsedCredit=/","",$row);
                    }

                    if (preg_match("/^Credit=/",$row)) 
                    {
                            $Credit=preg_replace("/^Credit=/","",$row);
                    }

                    if (preg_match("/^MobileNo=/",$row)) 
                    {
                            $MobileNo=preg_replace("/^MobileNo=/","",$row);
                    }

                    if (preg_match("/^retstr=/",$row)) 
                    {
                            $retstr=preg_replace("/^retstr=/","",$row);
                    }
            }

            if (strcmp($status,"0")==0) 
            {
                    //寫入廠商資料庫..
                    echo "發送成功...";
            } 
            else 
            {
                    echo "發送失敗...錯誤碼為 $status ";
            }
    }

    function check_state_change($a_id, $a_no)
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);        
                    return $callback;
            }  

            if( mysqli_query($con, "update account_order set a_state = 5.2 WHERE a_id ='$a_id' and a_no='$a_no'") ) 
            {
                    $callback['success'] = true;
            }
            else
            {
                    $callback['success'] = false;
                    $callback['msg'] = "Fail for updating a_state";
            }
        
            mysqli_close($con);
            echo json_encode($callback);        
    }
    
    function lock($a_id)
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);        
                    return $callback;
            }  

            if( mysqli_query($con, "update account set a_state = 'blockade' WHERE a_id ='$a_id'") ) 
            {
                    $callback['success'] = true;
            }
            else
            {
                    $callback['success'] = false;
            }
        
            mysqli_close($con);
            echo json_encode($callback);        
    }

    function multi_pair($a_id_help, $a_no_help, $a_id_ask, $a_no_ask)
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            date_default_timezone_set('Asia/Taipei');    

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return $callback;
            }  
            
            $a_id_help = explode(",",$a_id_help); 
            $a_no_help = explode(",",$a_no_help);
            $a_id_ask = explode(",",$a_id_ask);
            $a_no_ask = explode(",",$a_no_ask);

            $help_total = 0;
            for( $i=0; $i<count($a_id_help); $i++ )
            {
                    $result = mysqli_query($con, "select a_principle from account_order where a_id='$a_id_help[$i]' and a_no='$a_no_help[$i]'");
                    if( mysqli_num_rows($result) > 0 )
                    {
                            while( $row = mysqli_fetch_array($result) ) 
                            {
                                    $help_total = $help_total + $row['a_principle'];
                            }
                    }
                    else 
                    {
                            $callback['msg'] = "'$a_id_help[$i]' Order '$a_no_help[$i][$i]' not found";
                            $callback['success'] = false;
                            echo json_encode($callback);
                            return $callback;
                    }
                    
            }
            $ask_total = 0;
            for( $i=0; $i<count($a_id_ask); $i++ )
            {
                    $result = mysqli_query($con, "select a_principle from account_order where a_id='$a_id_ask[$i]' and a_no='$a_no_ask[$i]'");
                    if( mysqli_num_rows($result) > 0 )
                    {
                            while( $row = mysqli_fetch_array($result) ) 
                            {
                                    $ask_total = $ask_total + $row['a_principle'];
                            }
                    }
                    else 
                    {
                            $callback['msg'] = "'$a_id_ask[$i]' Order '$a_no_ask[$i][$i]' not found";
                            $callback['success'] = false;
                            echo json_encode($callback);
                            return $callback;
                    }
                    
            }

            if( $help_total != $ask_total )
            {
                    $callback['msg'] = "Both sides are not equal amount";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return $callback;
            }
            
            for( $i=0; $i<count($a_id_help); $i++ )
            {
                    for( $j=0; $j<count($a_id_ask); $j++ )
                    {
                            if( $a_id_help[$i] == $a_id_ask[$j] )
                            {
                                    $callback['success'] = false;
                                    $callback['msg'] = "you can't pair yourself";
                                    echo json_encode($callback);
                                    return $callback;
                            }
                    } 
            }
            
            if( count($a_id_help) != count($a_no_help) )
            {
                    $callback['success'] = false;
                    $callback['msg'] = "num of help id and no are not same";
                    echo json_encode($callback);
                    return $callback;
            }
            else if( count($a_id_ask) != count($a_no_ask) )
            {
                    $callback['success'] = false;
                    $callback['msg'] = "num of ask id and no are not same";
                    echo json_encode($callback);
                    return $callback;
            }
            else if( count($a_id_help) > 1 &&  count($a_id_ask) > 1 )
            {
                    $callback['success'] = false;
                    $callback['msg'] = "you can't pair many-to-many";
                    echo json_encode($callback);
                    return $callback;
            }
            else
            {
                    for( $i=0; $i<count($a_id_help); $i++ )
                    {
                            $check_help_pair = mysqli_query($con, "select a_state from account_order where a_id='$a_id_help[$i]' and a_no='$a_no_help[$i]'" );
                            $c_h_p = mysqli_fetch_array($check_help_pair);
                            if( $c_h_p["a_state"] == 3 )
                            {
                                    $callback['success'] = false;
                                    $callback['msg'] = "$a_id_help[$i]'s order $a_no_help[$i] is paring";
                                    echo json_encode($callback);
                                    return $callback;
                            }
                    }
                    
                    for( $j=0; $j<count($a_id_ask); $j++ )
                    {
                            $check_ask_pair = mysqli_query($con, "select a_state from account_order where a_id='$a_id_ask[$j]' and a_no='$a_no_ask[$j]'" );
                            $c_a_p = mysqli_fetch_array($check_ask_pair);
                            if( $c_a_p["a_state"] == 8 )
                            {
                                    $callback['success'] = false;
                                    $callback['msg'] = "$a_id_ask[$j]'s order $a_no_ask[$j] is paring";
                                    echo json_encode($callback);
                                    return $callback;
                            }
                    }
                    
                    if( count($a_id_help) > count($a_id_ask) )
                    {
                            for( $i=0; $i<count($a_id_help); $i++ )
                            {
                                    $insert_array_profile = array( "a_id_help" => $a_id_help[$i],
                                                                   "a_no_help" => $a_no_help[$i],
                                                                   "a_id_ask"  => $a_id_ask[0],
                                                                   "a_no_ask"  => $a_no_ask[0],
                                                                   "a_time"    =>date('Y-m-d H:i:s') );

                                    if( insert_sql($con, "account_pair", $insert_array_profile) ) 
                                    {
                                            $callback['success'] = true;
                                            mysqli_query($con, "update account_order set a_state = 3 where a_id='$a_id_help[$i]' and a_no='$a_no_help[$i]'" );
                                    }
                                    else  
                                    {
                                            $callback['success'] = false;
                                            $callback['msg'] = "Pair add fail in account_pair";
                                            echo json_encode($callback);
                                            return $callback;
                                    } 
                            }
                            mysqli_query($con, "update account_order set a_state = 8 where a_id='$a_id_ask[0]' and a_no='$a_no_ask[0]'" );
                    }
                    else if( count($a_id_help) < count($a_id_ask) )
                    {
                            for( $i=0; $i<count($a_id_ask); $i++ )
                            {
                                    $insert_array_profile = array( "a_id_help" => $a_id_help[0],
                                                                   "a_no_help" => $a_no_help[0],
                                                                   "a_id_ask"  => $a_id_ask[$i],
                                                                   "a_no_ask"  => $a_no_ask[$i],
                                                                   "a_time"    =>date('Y-m-d H:i:s') );

                                    if( insert_sql($con, "account_pair", $insert_array_profile) ) 
                                    {
                                            $callback['success'] = true;
                                            
                                            mysqli_query($con, "update account_order set a_state = 8 where a_id='$a_id_ask[$i]' and a_no='$a_no_ask[$i]'" );
                                   }
                                    else  
                                    {
                                            $callback['success'] = false;
                                            $callback['msg'] = "Pair add fail in account_pair";
                                            echo json_encode($callback);
                                            return $callback;
                                    } 
                            }
                            mysqli_query($con, "update account_order set a_state = 3 where a_id='$a_id_help[0]' and a_no='$a_no_help[0]'" );
                    }
                    else if( count($a_id_help) == count($a_id_ask) )
                    {
                            $insert_array_profile = array( "a_id_help" => $a_id_help[0],
                                                           "a_no_help" => $a_no_help[0],
                                                           "a_id_ask"  => $a_id_ask[0],
                                                           "a_no_ask"  => $a_no_ask[0],
                                                           "a_time"    =>date('Y-m-d H:i:s') );

                            if( insert_sql($con, "account_pair", $insert_array_profile) ) 
                            {
                                    $callback['success'] = true;

                                    mysqli_query($con, "update account_order set a_state = 3 where a_id='$a_id_help[0]' and a_no='$a_no_help[0]'" );
                                    mysqli_query($con, "update account_order set a_state = 8 where a_id='$a_id_ask[0]' and a_no='$a_no_ask[0]'" );
                            }
                            else  
                            {
                                    $callback['success'] = false;
                                    $callback['msg'] = "Pair add fail in account_pair";
                                    echo json_encode($callback);
                                    return $callback;
                            } 
                    }
                    else
                    {
                            $callback['success'] = false;
                    }
            }

            mysqli_close($con);
            echo json_encode($callback);
    }
    
?>