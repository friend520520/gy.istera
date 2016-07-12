<?php

    include 'config.php';
    include 'global.php';
    include 'sample/check_login.php';    

    if(isset($_REQUEST["a_principle"]) && !empty($_REQUEST["a_principle"]))  
    {
            $a_principle = $_REQUEST["a_principle"];
    }

    if(isset($_REQUEST["token"]) && !empty($_REQUEST["token"])) 
    {
            $token = $_REQUEST["token"];
    }   

    $check = check_login($con);
    if( !$check["success"] )
    {
            $callback['msg'] = "token not given";
            $callback['success'] = false;
            mysqli_close($con);
            return $callback; 
    }
    $account = $check["data"];     
    $a_id    = $account["a_id"];    
  
    switch ( $_REQUEST["func"] ) 
    {
        case "help":
            $echo = help();
            break;
        case "ask":
            $echo = ask();
            break;
        case "fake":
            if( $a_principle != null && $a_id != null )
            {
                    $echo = fake($a_principle, $a_id );
            }
            else
            {
                    $callback['success'] = false;
                    $callback['msg'] = 'a_principle is null';
                    return $callback;
            }
            break;
        case "pair":
            $echo = pair($_REQUEST["a_id_help"], $_REQUEST["a_no_help"], $_REQUEST["a_id_ask"], $_REQUEST["a_no_ask"]);
            break;
        case "pairlist":
            $echo = pairlist();
            break;
            
    }

    function help()
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    return $callback;
            }  

            $a_order = mysqli_query($con, "   SELECT * 
                                                FROM account_order 
                                           Left Join account
                                                  on account.a_id = account_order.a_id
                                               WHERE account_order.a_state = 1 
                                            order by ( a_principle + a_interest )
                                          ");
            
            if( mysqli_num_rows($a_order) > 0 )
            {    
                    //$i = 0;
                    while( $row = mysqli_fetch_array($a_order) ) 
                    {
                            $data[] = array(
                                                    "0" => $row['a_no'],
                                                    "1" => $row['a_start'],
                                                    "2" => $row['a_email'],
                                                    "3" => $row['a_registration_time'],
                                                    "4" => $row["a_principle"] + $row["a_interest"],
                                                    "5" => $row["a_start"],
                                                    "6" => "<td class=\"child-inline center\">".
                                                                    "<button id=\"pencil\" style=\"margin-right:5px;\" class=\"btn btn-xs btn-info blue-button\">".
                                                                        "<i class=\"ace-icon fa fa-pencil bigger-120\"></i>".
                                                                    "</button>".
                                                                    "<button id=\"pause_member\" style=\"margin-right:5px;\" class=\"btn btn-xs btn-danger green-button\"></button>".
                                                            "</td>"
                                            );
/*                        
                            $data = array( "a_no"    => $row["a_no"] ,
                                           "a_start" => $row["a_start"],
                                           "a_email" => $row["a_email"],
                                           "a_registration_time" => $row["a_registration_time"],                                
                                           "a_money" => $row["a_principle"] + $row["a_interest"], 
                                           "a_start" => $row["a_start"] );

                            $i=$i+1;
                            $box[$i] = array($data); 
*/
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
    
    function ask()
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
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
                            $data[] = array(
                                                    "0" => $row['a_no'],
                                                    "1" => $row['a_start'],
                                                    "2" => $row['a_email'],
                                                    "3" => $row['a_registration_time'],
                                                    "4" => $row["a_principle"] + $row["a_interest"],
                                                    "5" => $row["a_start"],
                                                    "6" => "<td class=\"child-inline center\">".
                                                                    "<button id=\"pencil\" style=\"margin-right:5px;\" class=\"btn btn-xs btn-info blue-button\">".
                                                                        "<i class=\"ace-icon fa fa-pencil bigger-120\"></i>".
                                                                    "</button>".
                                                                    "<button id=\"pause_member\" style=\"margin-right:5px;\" class=\"btn btn-xs btn-danger green-button\"></button>".
                                                            "</td>"
                                            );
/*                            
                            $data = array( "a_no"    => $row["a_no"] ,
                                           "a_start" => $row["a_start"],
                                           "a_email" => $row["a_email"],
                                           "a_registration_time" => $row["a_registration_time"],                                
                                           "a_money" => $row["a_principle"] + $row["a_interest"], 
                                           "a_start" => $row["a_start"] );

                            $i=$i+1;
                            $box[$i] = array($data); 
*/
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
    
    function fake( $a_principle, $a_id )
    {
            date_default_timezone_set('Asia/Taipei');    

            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            $callback = array();

            if (mysqli_connect_errno()) 
            {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
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
                                                           "a_s6_num"   => 0,
                                                           "a_s7_num"   => 0,
                                                           "a_s7_total" => 0,
                                                           "a_s8_num"   => 0,
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
                                    //mysqli_close($con);
                                    return $callback;
                            }
                    }

                    // Do event
                    $a_now = date('Y-m-d h:i:s');
                    $insert_array = array( "a_id"        => $a_id,
                                           "a_no"        => strtotime($a_now),
                                           "a_principle" => $a_principle,
                                           "a_interest"  => 0,
                                           "a_state"     => 6,
                                           "a_start"     => $a_now,
                                           "a_type"      => false );

                    if( insert_sql($con, "account_order", $insert_array) ) 
                    { 
                            $callback['success'] = true;
                    }
                    else
                    {
                            $callback['success'] = false;
                            $callback['msg'] = "account_order add fail";
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
    
    function pair($a_id_help, $a_no_help, $a_id_ask, $a_no_ask)
    {
            if($a_id_help != null && $a_no_help != null && $a_id_ask != null && $a_no_ask != null)
            {
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    date_default_timezone_set('Asia/Taipei');    
                    
                    $check_help_pair = mysqli_query($con, "select a_state from account_order where a_id='$a_id_help' and a_no='$a_no_help'" );
                    $c_h_p = mysqli_fetch_array($check_help_pair);

                    $check_ask_pair = mysqli_query($con, "select a_state from account_order where a_id='$a_id_ask' and a_no='$a_no_ask'" );
                    $c_a_p = mysqli_fetch_array($check_ask_pair);
                    
                    if( $c_h_p["a_state"] == 3 || $c_a_p["a_state"] == 6 )
                    {
                            $callback['success'] = false;
                            $callback['msg'] = "one or both order are pairing";
                    }
                    else
                    {
                            $insert_array_profile = array( "a_id_help" => $a_id_help,
                                                           "a_no_help" => $a_no_help,
                                                           "a_id_ask"  => $a_id_ask,
                                                           "a_no_ask"  => $a_no_ask,
                                                           "a_time"    => date('Y-m-d h:i:s') );

                            if( insert_sql($con, "account_pair", $insert_array_profile) ) 
                            {
                                    $callback['success'] = true;

                                    mysqli_query($con, "update account_order set a_state = 3 where a_id='$a_id_help' and a_no='$a_no_help'" );
                                    mysqli_query($con, "update account_order set a_state = 6 where a_id='$a_id_ask' and a_no='$a_no_ask'" );
                            }
                            else  
                            {
                                    $callback['success'] = false;
                                    $callback['msg'] = "Pair add fail in account_pair";
                            } 
                    }        
            }
            else
            {
                    $callback['success'] = false;
                    $callback['msg'] = "help or ask have a_id or a_no missing";
            }
            mysqli_close($con);
            echo json_encode($callback);
    }
    
    function pairlist()
    {
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");
            
            date_default_timezone_set('Asia/Taipei');    

            $result = mysqli_query($con, "   SELECT b1.a_email     as help_email,
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
            //$i = 0;
            if( mysqli_num_rows($result) > 0 )
            {
                    while( $row = mysqli_fetch_array($result) ) 
                    {
                            $data[] = array(
                                                    "0" => $row['help_email'],
                                                    "1" => $row['help_caption'],
                                                    "2" => $row['help_principle'],
                                                    "3" => $row['help_time'],
                                                    "4" => $row["ask_email"],
                                                    "5" => $row["ask_caption"],
                                                    "6" => $row['ask_principle'],
                                                    "7" => $row['ask_time'],
                                                    "8" => "<td class=\"child-inline center\">".
                                                                    "<button id=\"pencil\" style=\"margin-right:5px;\" class=\"btn btn-xs btn-info blue-button\">".
                                                                        "<i class=\"ace-icon fa fa-pencil bigger-120\"></i>".
                                                                    "</button>".
                                                                    "<button id=\"pause_member\" style=\"margin-right:5px;\" class=\"btn btn-xs btn-danger green-button\"></button>".
                                                            "</td>"
                                            );
/*                          
                            $data = array( "help_email"     => $row["help_email"],
                                           "help_caption"   => $row["help_caption"],
                                           "help_principle" => $row["help_principle"],
                                           "help_time"      => $row["help_time"],
                                           "ask_email"      => $row["ask_email"],
                                           "ask_caption"    => $row["ask_caption"],
                                           "ask_principle"  => $row["ask_principle"],
                                           "ask_time"       => $row["ask_time"] ); 

                            $box[$i] = array($data);
                            $i=$i+1;
*/
                      } 
 
                    $callback['data'] = $data;  

                    //$callback['data'] = $box;  
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
?>