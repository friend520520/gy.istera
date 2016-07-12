<?php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "report":
        $echo = report();
        break;
    case "get_report_page":
        $echo = get_report_page();
        break;
    case "get_report_one_page":
        $echo = get_report_one_page();
        break;
    case "clear_report_one_page":
        $echo = clear_report_one_page();
        break;
    case "delete_report":
        $echo = delete_report();
        break;
}

echo json_encode($echo);

function report(){
        $callback = array();
        try{
                if( check_empty( array( "token" , "page" , "r_reason" , "r_explanation" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $page = $_REQUEST["page"];
                    $r_reason = $_REQUEST["r_reason"];
                    $r_explanation = $_REQUEST["r_explanation"];
                    
                    if( !in_array($r_reason, array("1","2","3","4","5")) ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
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
                    
                    $insert_array = array();
                    date_default_timezone_set('Asia/Taipei');
                    $insert_array["r_date"] = date("Y-m-d H:i:s");
                    $insert_array[ "r_a_id" ] = $account[0]["a_id"];
                    $insert_array[ "r_page" ] = $page;
                    $insert_array[ "r_reason" ] = $r_reason;
                    $insert_array[ "r_explanation" ] = $r_explanation;
                    $insert_array[ "r_ip" ] = $_SERVER['REMOTE_ADDR'];
                    
                    if( insert_sql($con, "report", $insert_array) ){
                        
                            $report = get_sql($con, "report", "WHERE r_page=" . $page);
                            if( $report && count( $report ) >= 5 ){
                                    update_sql($con, "page", array( "p_display" => "blockade" ), array( "page_id" => (int)$page ));
                                    $callback['data'] = "blockade";
                            }
                            
                            $callback['success'] = true;
                    }
                    else{
                            $callback['msg'] = "檢舉失敗";
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
        return $callback;
        
}

function get_report_page(){
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $data = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
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
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $page = get_sql( $con , 
                            "channel as b join page as c join category as d on b.ch_id = c.p_channel_id AND c.p_category_id= d.cate_id" ,
                            "WHERE c.p_display = 'blockade'");
                    
                    if( $page ){
                            foreach ($page as $key => $value) {
                                
                                    //$report = get_sql_array( $con , "report" , array( "r_reason","r_explanation","r_date","r_ip","r_id","r_a_id" ) , "WHERE r_page = " . $value["page_id"] );
                                    //$report_arr = $report ? $report : array();
                                    
                                    $data[] = array( "page_id" => $value["page_id"] ,
                                                      "p_channel_id" => $value["p_channel_id"] ,
                                                      "p_display" => $value["p_display"] ,
                                                      "p_icon" => http_page_path.$value["page_id"]."/ThumbnailM/".$value["p_icon"] ,
                                                      "p_category_id" => $value["p_category_id"] ,
                                                      "cate_name" => $value["cate_name"] ,
                                                      "p_title" => $value["p_title"] ,
                                                      "p_date" => $value["p_date"] ,
                                                      "p_click_num" => $value["p_click_num"] ,
                                                      "ch_name" => $value["ch_name"] ,
                                                      "ch_id" => $value["ch_id"] );
                            }
                            
                            $callback['data'] = $data;
                            $callback['success'] = true;
                    }
                    else {
                            $callback['data'] = array();
                            $callback['success'] = true;
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
        return $callback;
        
}

function get_report_one_page(){
        $callback = array();
        try{
                if( check_empty( array( "token","page_id" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $page_id = $_REQUEST[ "page_id" ];
                    $data = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
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
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                          
                    $report = get_sql_array( $con , "report" , array( "r_reason","r_explanation","r_date","r_ip","r_id","r_a_id" ) , "WHERE r_page = " . $page_id );
                    $data = $report ? $report : array();

                    $callback['data'] = $data;
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
        return $callback;
        
}

function clear_report_one_page(){
        $callback = array();
        try{
                if( check_empty( array( "token","page_id" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $page_id = $_REQUEST[ "page_id" ];
                    $data = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
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
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $cmd = "DELETE FROM report WHERE r_page=$page_id";
                    if( mysqli_query($con, $cmd) ){
                            $callback['success'] = true;
                    }
                    else {
                            $callback['msg'] = "清除失敗";
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
        return $callback;
        
}

function delete_report(){
        $callback = array();
        try{
                if( check_empty( array( "token","r_id" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $r_id = $_REQUEST[ "r_id" ];
                    $data = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
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
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    
                    $cmd = "DELETE FROM report WHERE r_id=$r_id";
                    if( mysqli_query($con, $cmd) ){
                            $callback['data'] = $r_id;
                            $callback['success'] = true;
                    }
                    else {
                            $callback['msg'] = "清除失敗";
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
        return $callback;
        
}

?>
