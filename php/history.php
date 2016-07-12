<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_my_page":
        $echo = get_my_page();
        break;
    case "delete":
        $echo = delete();
        break;
    case "delete_all":
        $echo = delete_all();
        break;
}

echo json_encode($echo);

function get_my_page(){
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
                    
                    
                    $page = get_sql( $con , 
                            "channel as ch join page as p join history as his on ch.ch_id = p.p_channel_id AND his.his_page_id = p.page_id" , 
                            "where his.his_a_id='".$account[0]['a_id']."' AND p.p_display='block' Order by his.his_datetime DESC" );
                    
                    if( $page ){
                            foreach ($page as $key => $value) {
                                    $data[] = array( "page_id" => $value["page_id"] ,
                                                      "p_icon" => http_page_path.$value["page_id"]."/ThumbnailM/".$value["p_icon"] ,
                                                      "p_category_id" => $value["p_category_id"] ,
                                                      "p_title" => $value["p_title"] ,
                                                      "p_date" => $value["p_date"] ,
                                                      "his_datetime" => $value["his_datetime"] ,
                                                      "his_id" => $value["his_id"] ,
                                                      "p_click_num" => $value["p_click_num"] ,
                                                      "ch_id" => $value["ch_id"] ,
                                                      "ch_name" => $value["ch_name"] );
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

function delete(){
        $callback = array();
        try{
                if( check_empty( array( "token","his_id" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $his_id = $_REQUEST[ "his_id" ];
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
                    
                    $history = get_sql( $con , "history" ,"where his_id=$his_id" );
                    
                    if( $history ){
                            if( $history[0]["his_a_id"] !== $account[0]['a_id'] ){
                                    $callback['msg'] = "沒有權限";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            
                            $cmd = "DELETE FROM history WHERE his_id=" . $history[0]["his_id"];
                            if( mysqli_query($con, $cmd) ){
                                    $callback['data'] = $his_id;
                                    $callback['success'] = true;
                            }
                            else{
                                    $callback['msg'] = "刪除歷史記錄錯誤";
                                    $callback['success'] = false;
                            }
                    }
                    else {
                            $callback['data'] = $his_id;
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

function delete_all(){
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    
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
                    
                    $history = get_sql( $con , "history" ,"where his_a_id='".$account[0]['a_id']."'" );
                    
                    if( $history ){
                            $cmd = "DELETE FROM history WHERE his_a_id='".$account[0]['a_id']."'";
                            if( mysqli_query($con, $cmd) ){
                                    $callback['success'] = true;
                            }
                            else{
                                    $callback['msg'] = "刪除歷史記錄錯誤";
                                    $callback['success'] = false;
                            }
                    }
                    else {
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

?>
