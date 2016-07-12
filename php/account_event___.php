<?php
    /*
    include 'config.php';
    include 'global.php';
    
    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $con->query("SET NAMES utf8");

    // Check connection
    if (mysqli_connect_errno())  
    {
            $callback['msg'] = "SQL connect fail";
            $callback['success'] = false;
            return $callback;
    }
    
    $func  = $_REQUEST["func"];  
    
    if(isset($_REQUEST["a_id"]) && !empty($_REQUEST["a_id"])) 
    {
            $a_id  = $_REQUEST["a_id"];
    }   
    else 
    {
            $callback['msg'] = "a_id not given";
            $callback['success'] = false;
            return $callback; 
    }

    if(isset($_REQUEST["event_id"]) && !empty($_REQUEST["event_id"])) 
    {
            $event_id = $_REQUEST["event_id"];   
    }    

    if(isset($_REQUEST["h_table"]) && !empty($_REQUEST["h_table"])) 
    {
            $h_table = $_REQUEST["h_table"];    
    }    
    
    switch ($func) 
    {
        case "count":
            if( isset($event_id) )
            {
                    $echo = fn_count( $con, $event_id, $a_id );
            } 
            else
            {
                    $callback['msg'] = "Event_id not given";
                    $callback['success'] = false; 
                    return $callback; 
            }    
            break;
        case "asset":
            $echo = fn_asset( $con, $a_id );
            break;
        case "history":
            if( isset($h_table) )
            {
                    $echo = fn_history( $con, $a_id, $h_table );
            } 
            else
            {
                    $callback['msg'] = "h_table not given";
                    $callback['success'] = false;
                    return $callback; 
            }    
            break;
        case "position":
            $echo = fn_position( $con );
            break;
    }
    
    echo json_encode( $echo ); */
  
    function fn_count( $con, $event_id, $a_id ) 
    {
            //$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME); 
            //$con->query("SET NAMES utf8");
            date_default_timezone_set('Asia/Taipei');    
            $callback = array();
            //Check account_profile id
            //var_dump( $con );
            $check_account = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
            if( mysqli_num_rows($check_account) > 0 )
            {
                    $callback['msg'] = "Id exist in account_profile";
            }
            else 
            {
                    $insert_array_profile = array( "a_id"  =>  $a_id ,
                                               "a_value_coins"  => 0 ,
                                               "a_value_bonus" => 0 ,
                                               "a_value_cash"   => 0 );

                    
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
            $a_today = date('Y-m-d');
            $result = mysqli_query($con, "SELECT * FROM account_event WHERE a_event='$event_id'");    
            if( mysqli_num_rows($result) > 0 )  
            {
                    while( $row = mysqli_fetch_array($result) )
                    {
                            // 事件判斷
                            if( $event_id === "AV00001" )
                            {
                                    $check_date = mysqli_query($con, "SELECT * FROM account_coins WHERE a_id='$a_id' AND a_date Like '$a_today%' AND a_event='$event_id'" );
                                    if( mysqli_num_rows($check_date) > 0 ) 
                                    {
                                            $callback['msg'] = "login coins added";
                                            $callback['success'] = false;
                                            //mysqli_close($con);
                                            return $callback;
                                    }
                            }
                            else if( $event_id === "AV00028" || $event_id === "AV00029" || $event_id === "AV00030" || $event_id === "AV00031" || $event_id === "AV00032" || $event_id === "AV00033" )
                            { 
                                    $check_asset = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'" );
                                    if( mysqli_num_rows($check_asset) > 0 ) 
                                    {
                                            while( $profile_asset = mysqli_fetch_array($check_asset) )
                                            {
                                                    if( $profile_asset["a_value_cash"] < 35 && $event_id === "AV00028" )
                                                    {
                                                            $callback['msg'] = "cash not enough";
                                                            $callback['success'] = false;
                                                            //mysqli_close($con);
                                                            return $callback;
                                                    }
                                                    else if( $profile_asset["a_value_cash"] < 70 && $event_id === "AV00029" )
                                                    {
                                                            $callback['msg'] = "cash not enough";
                                                            $callback['success'] = false;
                                                            //mysqli_close($con);
                                                            return $callback;
                                                    } 
                                                    else if( $profile_asset["a_value_cash"] < 140 && $event_id === "AV00030" )
                                                    {
                                                            $callback['msg'] = "cash not enough";
                                                            $callback['success'] = false;
                                                            //mysqli_close($con);
                                                            return $callback;
                                                    } 
                                                    else if( $profile_asset["a_value_bonus"] < 35 && $event_id === "AV00031" )
                                                    {
                                                            $callback['msg'] = "bonus not enough";
                                                            $callback['success'] = false;
                                                            //mysqli_close($con);
                                                            return $callback;
                                                    } 
                                                    else if( $profile_asset["a_value_bonus"] < 70 && $event_id === "AV00032" )
                                                    {
                                                            $callback['msg'] = "bonus not enough";
                                                            $callback['success'] = false;
                                                            //mysqli_close($con);
                                                            return $callback;
                                                    } 
                                                    else if( $profile_asset["a_value_bonus"] < 140 && $event_id === "AV00033" )
                                                    {
                                                            $callback['msg'] = "bonus not enough";
                                                            $callback['success'] = false;
                                                            //mysqli_close($con);
                                                            return $callback;
                                                    } 
                                            }        
                                    } 
                                    else
                                    {
                                            $callback['msg'] = "profile a_id not found";
                                            $callback['success'] = false;
                                            //mysqli_close($con);
                                            return $callback;
                                    }
                            }
                            else
                            {
                                
                            }
                  
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                            if( $event_id === "AV00034" || $event_id === "AV00035" || $event_id === "AV00036" || $event_id === "AV00037" )
                            {
                                    $insert_array = array( "a_id"     => $a_id,
                                                           "a_value"  => $row["a_vip"],
                                                           "a_date"   => date('Y-m-d H:i'),
                                                           "a_event"  => $event_id,
                                                           "a_detail" => $row["a_detail"] );

                                     if( insert_sql($con, "account_vip", $insert_array) ) 
                                     { 
                                             $callback['success'] = true;
                                     }
                                     else
                                     {
                                             $callback['success'] = false;
                                             $callback['msg'] = "account_vip add fail";
                                             //mysqli_close($con); 
                                             return $callback;
                                    }

                                    $result = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
                                    if( mysqli_num_rows($result) > 0 ) 
                                    {
                                            while( $col = mysqli_fetch_array($result) )
                                            {
                                                    if( $col["a_vip_start"] === '0000-00-00 00:00:00' || $col["a_vip_end"] < date('Y-m-d H:i:s') )
                                                    {
                                                            $d = date('Y-m-d H:i');
                                                            $json = array( "a_vip_start" => date('Y-m-d H:i'),
                                                                           "a_vip_end"   => date('Y-m-d H:i',strtotime("{$d} {$row["a_vip"]} month"))  );
                                                            update_sql($con, "account_profile", $json , array( "a_id" => $col["a_id"] ));
                                                            $callback['success'] = true;                                                        
                                                    }                                                
                                                    else if( $col["a_vip_start"] != '0000-00-00 00:00:00' && $col["a_vip_end"] > date('Y-m-d H:i:s') )
                                                    {
                                                            $d = $col["a_vip_end"];
                                                            $json = array( "a_vip_end"   => date('Y-m-d H:i',strtotime("{$d} {$row["a_vip"]} month"))  );
                                                            update_sql($con, "account_profile", $json , array( "a_id" => $col["a_id"] ));
                                                            $callback['success'] = true;                                                        
                                                    }
                                                    else
                                                    {}
                                            }
                                    }
                                    else 
                                    {
                                            $callback['success'] = false;
                                            $callback['msg'] = "account_profile vip time update fail";
                                            return $callback;
                                    } 
                            }    
                            else
                            {
                                    $event_table = array(
                                            array( $row["a_coins"], $row["a_bonus"], $row["a_cash"], $row["a_detail"] ), 
                                            array( "account_coins", "account_bonus", "account_cash" ),
                                            array( "a_value_coins", "a_value_bonus", "a_value_cash" )  );  

                                    for ( $i=0 ; $i<3 ; $i++ ) 
                                    { 
                                            if( $event_table[0][$i] != 0 )
                                            {
                                                    $insert_array = array( "a_id"    => $a_id,
                                                                           "a_value" => $event_table[0][$i],
                                                                           "a_date"  => date('Y-m-d H:i:s'),
                                                                           "a_event" => $event_id,
                                                                           "a_detail" => $row["a_detail"] );

                                                    if( insert_sql($con, $event_table[1][$i], $insert_array) ) 
                                                    { 
                                                            $callback['success'] = true;
                                                    }
                                                    else
                                                    {
                                                            $callback['success'] = false;
                                                            $callback['msg'] = $event_table[1][$i] + " add fail";
                                                            //mysqli_close($con);
                                                            return $callback;
                                                    }

                                                    // Update account_profile
                                                    $result = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
                                                    if( mysqli_num_rows($result) > 0 ) 
                                                    {
                                                            while( $col = mysqli_fetch_array($result) )
                                                            {
                                                                    $json = array( $event_table[2][$i] => $col[$event_table[2][$i]] + $event_table[0][$i] );
                                                                    update_sql($con, "account_profile", $json , array( "a_id" => $col["a_id"] ));
                                                                    $callback['success'] = true;
                                                            }
                                                    }  
                                                    else
                                                    {
                                                            $callback['success'] = false;
                                                            $callback['msg'] = "account_profile :　" + $event_table[2][$i] + "update fail";
                                                            return $callback;
                                                    } 
                                            }
                                            else
                                            {
                                                    $callback['success'] = true;
                                            }
                                    }
                            }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    }
            }
            else
            {
                    $callback['success'] = false;
                    $callback['msg'] = "event undefine";
            }
            //mysqli_close($con);
            return $callback;
    }
     
    function fn_asset( $con, $a_id )
    {
            //$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            //$con->query("SET NAMES utf8");
            $callback = array();

            $result = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'" );
            if( mysqli_num_rows($result) > 0 ) 
            {
                    while( $row = mysqli_fetch_array($result) )
                    {
                            $data = array( "a_id"          => $row["a_id"] ,
                                          "a_value_coins"  => $row["a_value_coins"] ,
                                          "a_value_bonus" => $row["a_value_bonus"] ,
                                          "a_value_cash"   => $row["a_value_cash"] );
                            $callback['data'] = $data;
                            $callback['success'] = true;
                            //mysqli_close($con); 
                            return $callback;
                    }
            }
            else
            {
                    $callback['msg'] = "a_id not found";
                    $callback['success'] = false;
                    //mysqli_close($con); 
                    return $callback;
            }
    }

    function fn_history( $con, $a_id, $h_table )  
    {
            //$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            //$con->query("SET NAMES utf8");
            $callback = array();
 
            $result = mysqli_query($con, "SELECT * FROM `$h_table` WHERE a_id='$a_id'" );// Limit x,y = 從...取...筆 
            $result_total = mysqli_num_rows($result);
            //echo $result_total;
            $box = array();
            $i = 0;
            if( 0 < $result_total && $result_total< 100 )
            {
                    while( $row = mysqli_fetch_array($result) )
                    {
                            $box[] = array( "a_id"      => $row["a_id"],
                                           "a_value"   => $row["a_value"],
                                           "a_date"    => $row["a_date"],
                                           "a_event"   => $row["a_event"],
                                           "a_detailt" => $row["a_detail"]);
                            //echo '<pre />';
                            //var_dump( $data );
                    } 

                    $callback['data'] = $box;  
                    $callback['success'] = true;
                    //mysqli_close($con); 
                    return $callback;
            }
            else
            {
                    $head = $result_total - 100;
                    //echo '<pre />';
                    //echo $head;
                    $result = mysqli_query($con, "SELECT * FROM `$h_table` WHERE a_id='$a_id' Limit $head,100" );
                    while( $row = mysqli_fetch_array($result) )
                    {
                            $box[] = array( "a_id"      => $row["a_id"],
                                           "a_value"   => $row["a_value"],
                                           "a_date"    => $row["a_date"],
                                           "a_event"   => $row["a_event"],
                                           "a_detailt" => $row["a_detail"]);
                            //echo '<pre />';
                            //var_dump( $data );
                    } 
        
                    $callback['data'] = $box;    
                    $callback['success'] = true;
                    //mysqli_close($con); 
                    return $callback;
            }
    }   

    function fn_position( $con )
    {
            $callback = array(); 

            $account = get_sql_array($con, "account", array("a_id"));
            if( $account )
            {
                    $j = 0;
                    $callback['success'] = true;
                    for( $i=0; $i<count($account); $i++ )
                    {
                            $a_id = $account[$i]["a_id"];
                            print $a_id;
                            print "<br>";
                            //uid 換發表文章數
                            $publish = get_sql($con, "page as p join channel as ch on p.p_channel_id = ch.ch_id", "WHERE ch.ch_user_id='$a_id'", "COUNT(p.page_id)");
                            if( $publish ){
                                echo "發表文章數 : " . $publish[0]['COUNT(p.page_id)'] . "<br>";
                            }

                            //uid 換上傳附件數
                            $upload = get_sql($con, "page as p join channel as ch join page_file as pf on p.p_channel_id = ch.ch_id AND p.page_id=pf.pf_page_id", "WHERE ch.ch_user_id='$a_id'", "COUNT(pf.pf_page_id)");
                            if( $upload ){
                                echo "上傳附件數 : " . $upload[0]['COUNT(pf.pf_page_id)'] . "<br>";
                            }

                            //uid 換下線數
                            $child = get_sql($con, "account", "WHERE a_parent='$a_id'", "COUNT(a_id)");
                            if( $child ){
                                echo "下線數 : " . $child[0]['COUNT(a_id)'] . "<br>";
                            }

                            //uid 換所有文章總點閱數
                            $total = get_sql($con, "page as p join channel as ch on p.p_channel_id = ch.ch_id", "WHERE ch.ch_user_id='$a_id'", "sum(p.p_click_num)");
                            if( $total ){
                                echo "所有文章總點閱數 : " . $total[0]["sum(p.p_click_num)"] . "<br>";
                            }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                            $a_level = 1;
                            if( $publish[0]['COUNT(p.page_id)'] >= 50 && $upload[0]['COUNT(pf.pf_page_id)'] >= 10 && $child[0]['COUNT(a_id)'] >= 6 )
                            {
                                    $a_level = 2;
                                    if( $publish[0]['COUNT(p.page_id)'] >= 100 && $upload[0]['COUNT(pf.pf_page_id)'] >= 10 && $child[0]['COUNT(a_id)'] >= 30 )
                                    {
                                            $a_level = 3;
                                            if( $publish[0]['COUNT(p.page_id)'] >= 200 && $upload[0]['COUNT(pf.pf_page_id)'] >= 10 && $child[0]['COUNT(a_id)'] >= 50 )
                                            {
                                                    $a_level = 4;
                                                    if( $total[0]["sum(p.p_click_num)"] >= 1000000 && $upload[0]['COUNT(pf.pf_page_id)'] >= 100 && $child[0]['COUNT(a_id)'] >= 100 )
                                                    {
                                                            $a_level = 5;
                                                    }
                                            }
                                    }
                            }
////----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                            // Update account_profile
                            $result = mysqli_query($con, "SELECT * FROM account_profile WHERE a_id='$a_id'");
                            if( mysqli_num_rows($result) > 0 ) 
                            {
                                    while( $col = mysqli_fetch_array($result) )
                                    {
                                            $json = array( "a_publish" => $publish[0]['COUNT(p.page_id)'],
                                                           "a_upload"  => $upload[0]['COUNT(pf.pf_page_id)'],
                                                           "a_child"   => $child[0]['COUNT(a_id)'],
                                                           "a_total"   => $total[0]["sum(p.p_click_num)"],
                                                           "a_level"   => $a_level  );

                                            update_sql($con, "account_profile", $json , array( "a_id" => $col["a_id"] ));
                                    }
                            }  
                            else
                            {
                                    $j=$j+1;
                                    $callback['success'] = false;
                                    $callback['msg'] = "Id not found in account_profile";
                                    $data = $a_id;
                                    $box[$j] = $data;
                            } 
                    }
                    $callback['data'] = $box;
                    return $callback;
            }
    }
?> 