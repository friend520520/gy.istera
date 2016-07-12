<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_my_page":
        $echo = get_my_page();
        break;
    case "collect":
        $echo = collect();
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
                            "channel as ch join page as p join collect as col on ch.ch_id = p.p_channel_id AND col.col_page_id = p.page_id" , 
                            "where col.col_a_id='".$account[0]['a_id']."' AND p.p_display='block' Order by col.col_id DESC" );
                    
                    if( $page ){
                            foreach ($page as $key => $value) {
                                    $data[] = array( "page_id" => $value["page_id"] ,
                                                      "p_icon" => http_page_path.$value["page_id"]."/ThumbnailM/".$value["p_icon"] ,
                                                      "p_category_id" => $value["p_category_id"] ,
                                                      "p_title" => $value["p_title"] ,
                                                      "p_date" => $value["p_date"] ,
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

function collect(){
        $callback = array();
        try{
                if( check_empty( array( "token","page","action" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $page_id = $_REQUEST[ "page" ];
                    $action = $_REQUEST[ "action" ];
                    $data = array();                    
                    if( !in_array($action, array("collect","cancel")) ){
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
                    
                    $page = get_sql( $con , "page" ,"where page_id=$page_id" );
                    if( !$page ) {
                            $callback['msg'] = "頁面不存在";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $collect = get_sql( $con , "collect" ,"where col_a_id='".$account[0]['a_id']."' AND col_page_id=$page_id" );
                    
                    if( $collect ){
                            if( $action === "collect" ){
                                    $callback['data'] = "already";
                                    $callback['success'] = true;
                            }
                            else if( $action === "cancel" ){
                                    $cmd = "DELETE FROM collect WHERE col_id=" . $collect[0]["col_id"];
                                    if( mysqli_query($con, $cmd) ){
                                            $callback['data'] = "yet";
                                            $callback['success'] = true;
                                    }
                                    else{
                                            $callback['msg'] = "取消收藏錯誤";
                                            $callback['success'] = false;
                                    }
                            }
                    }
                    else {
                            if( $action === "collect" ){
                                    if( insert_sql($con, "collect", array( "col_a_id" => $account[0]['a_id'] , "col_page_id" => (int)$page_id )) ){
                                            $callback['data'] = "already";
                                            $callback['success'] = true;
                                    }
                                    else{
                                            $callback['msg'] = "收藏失敗";
                                            $callback['success'] = false;
                                    }
                                        
                            }
                            else if( $action === "cancel" ){
                                    $callback['data'] = "yet";
                                    $callback['success'] = true;
                            }
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
