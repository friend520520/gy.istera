<?php
    
//    include 'config.php';
//    include 'global.php';
//    
//    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
//    $con->query("SET NAMES utf8");
//
//    // Check connection
//    if (mysqli_connect_errno())  
//    {
//            $callback['msg'] = "SQL connect fail";
//            $callback['success'] = false;
//            echo json_encode($callback);
//            return $callback;
//    }
//        
//    switch ($_REQUEST["func"]) 
//    {
//        case "event":
//            $echo = fn_event( $con, $_REQUEST["event_id"], $a_id = null, $a_no = null, $a_principle = null );
//            break; 
//    }
    
    function fn_event( $con, $event_id, $a_id = null, $a_no = null, $a_principle = null )
    {
            date_default_timezone_set('Asia/Taipei');    
            if( $event_id === "H00001" )
            {    
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
                            $a_now = date('Y-m-d h:i:s');
                            $insert_array = array( "a_id"        => $a_id,
                                                   "a_no"        => strtotime($a_now),
                                                   "a_principle" => $a_principle,
                                                   "a_interest"  => 0,
                                                   "a_state"     => 1,
                                                   "a_start"     => $a_now/*,
                                                   "a_type"      => true */); 

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
                                    echo json_encode($callback);
                                    return $callback;
                            }
                    }
                    else
                    {
                            $callback['msg'] = "a_principle is null";
                            $callback['success'] = false;
                            echo json_encode($callback);
                            return $callback; 
                    }        
            }
            else if( $event_id === "H00002" || $event_id === "H00003" ||  $event_id === "H00004" || $event_id === "H00005" || $event_id === "H00051" || $event_id === "H00052" || $event_id === "H00006" ||  $event_id === "H00007" || $event_id === "H00008" || $event_id === "H00081" || $event_id === "H00009" ||  $event_id === "H00010" )
            {    
                    if( $a_no != null && $a_id != null )
                    {
                            date_default_timezone_set('Asia/Taipei');    
                            $callback = array();

                            $result = mysqli_query($con, "SELECT * FROM account_event WHERE a_event='$event_id'" );
                            if( mysqli_num_rows($result) > 0 ) 
                            {
                                    while( $row = mysqli_fetch_array($result) )
                                    {
                                            $ord_no = mysqli_query($con, "SELECT * FROM account_order WHERE a_no='$a_no' and a_id ='$a_id'");
                                            if( mysqli_num_rows($ord_no) > 0 ) 
                                            {
                                                    while( $col = mysqli_fetch_array($ord_no) )
                                                    {
                                                            //更新訂單狀態
                                                            $state = array( "a_state" => $row["a_state"] );
                                                            update_sql($con, "account_order", $state , array( "a_no" => $col["a_no"], "a_id" => $col["a_id"]));
                                                            
                                                            //profile紀錄
                                                            $a_profile = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
                                                            if( $event_id === "H00002" || $event_id === "H00003" ||  $event_id === "H00004" || $event_id === "H00005" || $event_id === "H00051" || $event_id === "H00052" || $event_id === "H00006" ||  $event_id === "H00007" || $event_id === "H00008" || $event_id === "H00081" || $event_id === "H00009" ||  $event_id === "H00010" )
                                                            {
                                                                    if( mysqli_num_rows($a_profile) > 0 ) 
                                                                    {
                                                                            while( $hg = mysqli_fetch_array($a_profile) )
                                                                            {
                                                                                    if( $event_id === "H00002" )
                                                                                    {
                                                                                            $json = array( "a_s1_num" => $hg["a_s1_num"] - 1,
                                                                                                           "a_s2_num" => $hg["a_s2_num"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00003" )
                                                                                    {
                                                                                            $json = array( "a_s1_num" => $hg["a_s1_num"] - 1,
                                                                                                           "a_s3_num" => $hg["a_s3_num"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00004" )  
                                                                                    {
                                                                                            $json = array( "a_s3_num" => $hg["a_s3_num"] - 1,
                                                                                                           "a_s4_num" => $hg["a_s4_num"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00005" )
                                                                                    {
                                                                                            $json = array( "a_s3_num" => $hg["a_s3_num"] - 1,
                                                                                                           "a_s5_num" => $hg["a_s5_num"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00051" )
                                                                                    {
                                                                                            $json = array( "a_s5_num"   => $hg["a_s5_num"] - 1,
                                                                                                           "a_s5.1_num" => $hg["a_s5.1_num"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00052" )
                                                                                    {
                                                                                            $json = array( "a_s5_num" => $hg["a_s5_num"] - 1,
                                                                                                           "a_s5.2_num" => $hg["a_s5.2_num"] + 1,
                                                                                                           "a_s1_num" => $hg["a_s1_num"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00006" )
                                                                                    {
                                                                                            $cancel_order = mysqli_query($con, "SELECT * FROM account_order_cancel WHERE a_no='$a_no' and a_state = 7");
                                                                                            if( mysqli_num_rows($cancel_order) <= 0 ) 
                                                                                            {                                                        
                                                                                                    $json = array( "a_s5.1_num" => $hg["a_s5.1_num"] - 1,
                                                                                                                   "a_s6_num"   => $hg["a_s6_num"] + 1 );
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                    $json = array( "a_s5.1_num" => $hg["a_s5.1_num"] - 1,
                                                                                                                   "a_s6_num"   => $hg["a_s6_num"] + 1, 
                                                                                                                   "a_s7_num"   => $hg["a_s7_num"] - 1 );
                                                                                            }
                                                                                    }
                                                                                    else if( $event_id === "H00007" )
                                                                                    {
                                                                                            $json = array( "a_s5.1_num" => $hg["a_s5.1_num"] + 1,
                                                                                                           "a_s6_num"   => $hg["a_s6_num"] - 1,
                                                                                                           "a_s7_num"   => $hg["a_s7_num"] + 1,
                                                                                                           "a_s7_total" => $hg["a_s7_total"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00008" )
                                                                                    {
                                                                                            $json = array( "a_s6_num" => $hg["a_s6_num"] - 1,
                                                                                                           "a_s8_num" => $hg["a_s8_num"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00081" )
                                                                                    {
                                                                                            $json = array( "a_s8_num"   => $hg["a_s8_num"] - 1,
                                                                                                           "a_s8.1_num" => $hg["a_s8.1_num"] + 1 );
                                                                                    }
                                                                                    else if( $event_id === "H00009" )
                                                                                    {
                                                                                            $json = array( "a_s8_num" => $hg["a_s8_num"] - 1,
                                                                                                           "a_s9_num" => $hg["a_s9_num"] + 1 );
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                            $json = array( "a_s8_num" => $hg["a_s8_num"] - 1,
                                                                                                           "a_s10_num" => $hg["a_s10_num"] + 1 );
                                                                                    }

                                                                                    update_sql($con, "account_profile", $json , array( "a_id" => $hg["a_id"] ));
                                                                                    $callback['success'] = true;                                                        
                                                                            }
                                                                    }
                                                                    else
                                                                    {
                                                                            $callback['success'] = false;
                                                                            $callback['msg'] = "account_profile update fail";
                                                                    } 
                                                            }
                                                            
                                                            //取消紀錄
                                                            if( $event_id === "H00002" || $event_id === "H00004" || $event_id === "H00007" || $event_id === "H00081" || $event_id === "H00009" )
                                                            {
                                                                    if( $event_id === "H00002" )
                                                                    {                                    
                                                                            $insert_array = array( "a_id"        => $col["a_id"],
                                                                                                   "a_no"        => $col["a_no"],
                                                                                                   "a_principle" => $col["a_principle"],
                                                                                                   "a_interest"  => $col["a_interest"],
                                                                                                   "a_state"     => 2,
                                                                                                   "a_date"      => date('y:m:d h:i:d')/*, 
                                                                                                   "a_type"      => true */);             
                                                                    }
                                                                    else if( $event_id === "H00004" )
                                                                    {                                    
                                                                            $insert_array = array( "a_id"        => $col["a_id"],
                                                                                                   "a_no"        => $col["a_no"],
                                                                                                   "a_principle" => $col["a_principle"],
                                                                                                   "a_interest"  => $col["a_interest"],
                                                                                                   "a_state"     => 4,
                                                                                                   "a_date"      => date('y:m:d h:i:d')/*,
                                                                                                   "a_type"      => true */);             
                                                                    }
                                                                    else if( $event_id === "H00007" )
                                                                    {                                    
                                                                            $insert_array = array( "a_id"        => $col["a_id"],
                                                                                                   "a_no"        => $col["a_no"],
                                                                                                   "a_principle" => $col["a_principle"],
                                                                                                   "a_interest"  => $col["a_interest"],
                                                                                                   "a_state"     => 7,
                                                                                                   "a_date"      => date('y:m:d h:i:d')/*,
                                                                                                   "a_type"      => true*/ );             
                                                                    }
                                                                    else if( $event_id === "H00081" )
                                                                    {                                    
                                                                            $insert_array = array( "a_id"        => $col["a_id"],
                                                                                                   "a_no"        => $col["a_no"],
                                                                                                   "a_principle" => $col["a_principle"],
                                                                                                   "a_interest"  => $col["a_interest"],
                                                                                                   "a_state"     => 8.1,
                                                                                                   "a_date"      => date('y:m:d h:i:d')/*,
                                                                                                   "a_type"      => true*/ );             
                                                                    }
                                                                    else
                                                                    {                                    
                                                                            $insert_array = array( "a_id"        => $col["a_id"],
                                                                                                   "a_no"        => $col["a_no"],
                                                                                                   "a_principle" => $col["a_principle"],
                                                                                                   "a_interest"  => $col["a_interest"],
                                                                                                   "a_state"     => 9,
                                                                                                   "a_date"      => date('y:m:d h:i:d')/*,
                                                                                                   "a_type"      => true */);             
                                                                    }

                                                                    if( insert_sql($con, "account_order_cancel", $insert_array) ) 
                                                                    { 
                                                                            $callback['success'] = true;
                                                                    }
                                                                    else
                                                                    {
                                                                            $callback['msg'] = "account_order_cancel add fail";
                                                                            $callback['success'] = false;
                                                                            echo json_encode($callback);
                                                                            return $callback;
                                                                    }           
                                                            }  
                                                    }
                                            }
                                            else
                                            { 
                                                    $callback['success'] = false;
                                                    $callback['msg'] = "a_no not found";
                                            }
                                    }
                            }
                            else
                            {
                                    $callback['msg'] = "event_id not found";
                                    $callback['success'] = false;
                                    echo json_encode($callback);
                                    return $callback;
                            }
                    }
                    else 
                    {
                            $callback['msg'] = "a_no is null";
                            $callback['success'] = false;
                            echo json_encode($callback);
                            return $callback; 
                    } 
            }
            else if( $event_id === "H00011" )
            {
                    $a_now = date('Y-m-d h:i:s');
                    $callback = array();
                    $result = mysqli_query($con, "select * from account_order where a_state in (1,3,5,5.1,5.2)" ); 
                    if( mysqli_num_rows($result) > 0 ) 
                    {
                            while( $row = mysqli_fetch_array($result) )
                            {
                                    $interest_day = floor((strtotime($a_now) - strtotime($row[5]))/ (60*60*24)); 
                                    mysqli_query($con, "update account_order set a_interest = '$row[2]'*0.007*'$interest_day' WHERE a_state in (1,3,5,5.1,5.2) and a_id ='$row[0]' and a_no='$row[1]'");
                            }
                    }                
                    $callback['success'] = true;
            }  
            else
            {
                    $callback['msg'] = "event id undefine";
                    $callback['success'] = false;  
            } 
            mysqli_close($con);
            echo json_encode($callback);
    }
   
?> 