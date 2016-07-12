<?php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_my_page":
        $echo = get_my_page();
        break;
    case "set_page_display":
        $echo = set_page_display();
        break;
    case "delete_page":
        $echo = delete_page();
        break;
    case "delete_pagefile":
        $echo = delete_pagefile();
        break;
    case "get_all_page":
        $echo = get_all_page();
        break;
    case "get_page_simple_info":
        $echo = get_page_simple_info();
        break;
    case "get_page_info":
        start_session( 3600 );
        $echo = get_page_info();
        break;
    case "getbody":
        $echo = getbody();
        break;
    case "get_this_week_hot_page":
        $echo = get_this_week_hot_page();
        break;
    case "get_page":
        $echo = get_page();
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
                            "channel as b join page as c on b.ch_id = c.p_channel_id" , 
                            "where b.ch_user_id='".$account[0]['a_id']."'" );
                    
                    if( $page ){
                            foreach ($page as $key => $value) {
                                    $data[] = array( "page_id" => $value["page_id"] ,
                                                      "p_channel_id" => $value["p_channel_id"] ,
                                                      "p_display" => $value["p_display"] ,
                                                      "p_icon" => http_page_path.$value["page_id"]."/ThumbnailM/".$value["p_icon"] ,
                                                      "p_category_id" => $value["p_category_id"] ,
                                                      "p_title" => $value["p_title"] ,
                                                      "p_date" => $value["p_date"] ,
                                                      "p_click_num" => $value["p_click_num"] );
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

function set_page_display(){
        $callback = array();
        try{
                if( check_empty( array( "token" , "page_id" , "change_display" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $page_id = $_REQUEST[ "page_id" ];
                    $change_display = $_REQUEST[ "change_display" ];
                    if( $change_display !== "block" && $change_display !== "none" ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
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
                            "account as a join channel as b join page as c on b.ch_id = c.p_channel_id AND a.a_id = b.ch_user_id" , 
                            "where c.page_id=$page_id" );
                    
                    if( !$page ){
                            $callback['msg'] = "page isnt exist.";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    if( $account[0]['a_admin'] !== "true" ){
                            if( $page[0]['a_id'] !== $account[0]['a_id'] ){
                                    $callback['msg'] = "you dont have admin";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            if( $page[0]["p_display"] === "blockade" ){
                                    $callback['msg'] = "封鎖文章，等待管理員解鎖";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                    }
                    
                    if( $page[0]["p_display"] === $change_display ){
                            $callback['success'] = true;
                    }
                    else {
                            $json = array( "p_display" => $change_display );
                            $keyword = array( "page_id" => (int)$page[0]["page_id"] );
                            if( update_sql($con, "page", $json, $keyword) ){
                                    $callback['success'] = true;
                            }
                            else {
                                    $callback['msg'] = "operation fail";
                                    $callback['success'] = false;
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

function delete_page(){
        $callback = array();
        try{
                if( check_empty( array( "token" , "page_id" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $page_id = $_REQUEST[ "page_id" ];
                    
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
                            "account as a join channel as b join page as c on b.ch_id = c.p_channel_id AND a.a_id = b.ch_user_id" , 
                            "where c.page_id=$page_id" );
                    
                    if( !$page ){
                            $callback['msg'] = "page isnt exist.";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    if( $account[0]['a_admin'] !== "true" && $page[0]['a_id'] !== $account[0]['a_id'] ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $cmd = "DELETE FROM page WHERE page_id=$page_id";
                    if( mysqli_query($con, $cmd) ){

                        $filepath_from = page_path.$page_id;
                        $filepath_to = delete_page_path.$page_id;
                        if( file_exists( $filepath_from ) ) {
                                recurse_copy( $filepath_from , $filepath_to );
                                if( file_exists( $filepath_from ) ) {
                                    
                                        $cmd = "DELETE FROM report WHERE r_page=$page_id";
                                        mysqli_query($con, $cmd);
                                        
                                        $callback['data'] = $page_id;
                                        $callback['success'] = true;
                                }
                                else{
                                        $callback['msg'] = "delete database success,but folder not";
                                        $callback['success'] = false;
                                }
                        }
                        else{
                                $callback['data'] = $page_id;
                                $callback['success'] = true;
                        }
                            
                    }
                    else {
                            $callback['msg'] = "you dont have admin";
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

function delete_pagefile(){
        $callback = array();
        try{
                if( check_empty( array( "token" , "pf_id" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $pf_id = $_REQUEST[ "pf_id" ];
                    
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
                    
                    $page_file = get_sql( $con , 
                            "account as a join channel as b join page as c join page_file as d on b.ch_id = c.p_channel_id AND a.a_id = b.ch_user_id AND c.page_id = d.pf_page_id" , 
                            "where d.pf_id='$pf_id'" );
                    
                    if( !$page_file ){
                            $callback['msg'] = "file isnt exist.";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    if( $account[0]['a_admin'] !== "true" && $page_file[0]['a_id'] !== $account[0]['a_id'] ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $cmd = "DELETE FROM page_file WHERE pf_id='$pf_id'";
                    if( mysqli_query($con, $cmd) ){

                        $filepath_from = page_path.$page_file[0]["page_id"]."/Attachment/".$page_file[0]["pf_name"];
                        //$filepath_to = delete_page_path.$page_id;
                        if( file_exists( $filepath_from ) ) {
                                if (!unlink($filepath_from)) {
                                        $callback['msg'] = "delete database success,but file not";
                                        $callback['success'] = false;
                                }
                                else {
                                        $callback['data'] = $pf_id;
                                        $callback['success'] = true;
                                }
                        }
                        else{
                                $callback['data'] = $pf_id;
                                $callback['success'] = true;
                        }
                            
                    }
                    else {
                            $callback['msg'] = "delete file fail";
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

function get_all_page(){
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
                    
                    if( $account[0]["a_admin"] !== "true" ) {
                            $callback['msg'] = "you're not the administrator";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $page = get_sql( $con , 
                            "account as a join channel as b join page as c join category as d on b.ch_id = c.p_channel_id AND a.a_id = b.ch_user_id AND c.p_category_id= d.cate_id" );
                    
                    if( $page ){
                            foreach ($page as $key => $value) {
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
                            $callback['msg'] = "get fail";
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

function get_page_simple_info(){
        $callback = array();
        try{
                if( check_empty( array( "page" ) ) ) {
                    
                    $page = $_REQUEST[ "page" ];
                    $data = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $page = get_sql( $con , 
                            "channel as b join page as c on b.ch_id = c.p_channel_id" , 
                            "where c.page_id=".$page );
                    
                    if( !$page ){
                            $callback['msg'] = "頁面不存在或是被隱藏";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    if( $page[0]["p_display"] === "blockade" ){
                            $callback['msg'] = "頁面被過多檢舉，暫時關閉";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    else if( $page[0]["p_display"] === "none" ){
                            $callback['msg'] = "頁面不存在或是被隱藏";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    else if( $page[0]["p_display"] === "block" ){
                            
                            $data = array();
                            $data["p_icon"] = http_page_path.$page[0]["page_id"]."/Preview/".$page[0]["p_icon"];
                            $data["p_title"] = $page[0]["p_title"];
                            $data["p_pre_html"] = $page[0]["p_pre_html"];
                            
                            $callback['data'] = $data;
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
function get_page_info(){
        $callback = array();
        try{
                if( check_empty( array( "page" ) ) ) {
                    
                    $token = !isset($_REQUEST["token"]) || empty($_REQUEST["token"]) ? "" : md5( $_REQUEST[ "token" ] );
                    $page = $_REQUEST[ "page" ];
                    $data = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $page = get_sql( $con , 
                            "channel as b join page as c on b.ch_id = c.p_channel_id" , 
                            "where c.page_id=".$page );
                    
                    if( !$page ){
                            $callback['msg'] = "頁面不存在或是被隱藏";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    if( $page[0]["p_display"] === "blockade" ){
                            $callback['msg'] = "頁面被過多檢舉，暫時關閉";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    else if( $page[0]["p_display"] === "none" ){
                            $callback['msg'] = "頁面不存在或是被隱藏";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    else if( $page[0]["p_display"] === "block" ){
                            
                            if( $token === "" ){
                                $login = false;
                            }
                            else {
                                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                                $login = $account ? true : false;
                            }
                            
                            $data = array();
                            $data["page_id"] = $page[0]["page_id"];
                            $data["p_channel_id"] = $page[0]["p_channel_id"];
                            $data["p_display"] = $page[0]["p_display"];
                            $data["p_icon"] = http_page_path.$page[0]["page_id"]."/ThumbnailS/".$page[0]["p_icon"];
                            $data["p_category_id"] = $page[0]["p_category_id"];
                            $data["p_tag"] = json_decode( $page[0]["p_tag"] );
                            $data["p_title"] = $page[0]["p_title"];
                            $data["p_date"] = $page[0]["p_date"];
                            $data["p_click_num"] = (int)$page[0]["p_click_num"]+1;
                            $data["ch_name"] = $page[0]["ch_name"];
                            $data["ch_id"] = $page[0]["ch_id"];
                            $data["ch_icon"] = http_channel_path.$page[0]["ch_id"]."/".$page[0]["ch_icon"];
                            
                            
                            //文章附件
                            $page_file = get_sql_array( $con , "page_file" , array( "pf_id" , "pf_des" , "pf_original_name" , "pf_size" , "pf_download_num" ) , "WHERE pf_page_id=".$page[0]["page_id"] );
                            $data["page_file_exist"] = $page_file ? true : false;
                            
                            $data["p_html"] = $page[0]["p_html"];
                            if( $login ){
                                $data["page_file"] = $page_file ? $page_file : array();
                                //檢查有沒有收藏
                                $collect = get_sql($con, "collect", "WHERE col_a_id='". $account[0]["a_id"] ."' AND col_page_id=" . $page[0]["page_id"]);
                                $data["collect"] = $collect ? "already" : "yet";
                                //檢查有沒有追蹤
                                $track = get_sql($con, "track", "WHERE t_a_id='". $account[0]["a_id"] ."' AND t_ch_id=" . $page[0]["ch_id"]);
                                $data["track"] = $track ? "already" : "yet";
                                //增加歷史紀錄
                                date_default_timezone_set('Asia/Taipei');
                                insert_sql($con, "history", array( "his_a_id" => $account[0]["a_id"] , "his_page_id" => (int)$page[0]["page_id"] , "his_datetime" => date('Y-m-d H:i:s') ));
                                //拿到channel的ch_url 推廣文章網域
                                $channel = get_sql($con, "channel", "WHERE ch_user_id='".$account[0]["a_id"]."'");
                                if( $channel ){
                                    $data["ch_url"] = $channel[0]["ch_url"];
                                }
                                else{
                                    $data["ch_url"] = $account[0]["a_id"];
                                }
                            }
                            else{
                                //文章附件
                                $data["page_file"] = array();
                            }
                            
                            //you might like these pages
                            $ch_page = get_sql_array( $con , "channel as b join page as c on b.ch_id = c.p_channel_id" , 
                                                                array( "page_id" , "p_title" ) , 
                                                                "WHERE c.page_id!=".$page[0]["page_id"]." AND b.ch_id=".$page[0]["ch_id"]." AND c.p_display='block' limit 6" );
                            $data["ch_page"] = $ch_page ? $ch_page : array();
                            //you might like these pages
                            //hot pages
                            $hot_page = get_sql_array( $con , "page" , array( "page_id" , "p_title" , "p_icon" ) , "WHERE page_id!=".$page[0]["page_id"]." AND p_display='block' order by p_click_num DESC limit 10" );
                            $data["hot_page"] = $hot_page ? $hot_page : array();
                            //hot pages
                            
                            $index = "_" . (string)$page[0]["page_id"];
                            if( !isset($_SESSION[ $index ]) )
                            {
                                $_SESSION[ $index ] = true;
                                database_add_click( $con , $page[0]["page_id"] , $page[0]["ch_id"] );
                                database_spread_add_click( $con , $page[0]["page_id"] , $page[0]["ch_percent"] , $page[0]["ch_user_id"] );
                                
                            }
                            
                            $callback['data'] = $data;
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

function getbody(){
        $callback = array();
        try{
                if( check_empty( array( "page" ) ) ) {
                    
                    $token = !isset($_REQUEST["token"]) || empty($_REQUEST["token"]) ? "" : md5( $_REQUEST[ "token" ] );
                    $page = $_REQUEST[ "page" ];
                    $data = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $page = get_sql( $con , 
                            "channel as ch join page as p on ch.ch_id = p.p_channel_id" , 
                            "where p.page_id=".$page );
                    
                    if( !$page ){
                            $callback['msg'] = "頁面不存在或是被隱藏";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    if( $page[0]["p_display"] === "blockade" ){
                            $callback['msg'] = "頁面被過多檢舉，暫時關閉";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    else if( $page[0]["p_display"] === "none" ){
                            $callback['msg'] = "頁面不存在或是被隱藏";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    else if( $page[0]["p_display"] === "block" ){
                            
                            $data['page_id'] = $page[0]['page_id'];
                            if( $token === "" ){
                                $login = false;
                            }
                            else {
                                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                                if( !$account ) {
                                        $callback['msg'] = "Login fail";
                                        $callback['success'] = false;
                                        mysqli_close($con);
                                        return $callback;
                                }
                                $login = true;
                            }
                            
                            $page_file = get_sql_array( $con , "page_file" , array( "pf_id" , "pf_des" , "pf_original_name" , "pf_size" , "pf_download_num" ) , "WHERE pf_page_id=".$page[0]["page_id"] );
                            $data["page_file_exist"] = $page_file ? true : false;
                            $data["p_html"] = $page[0]["p_html"];
                            if( $login ){
                                //文章附件
                                $data["page_file"] = $page_file ? $page_file : array();
                                //檢查有沒有收藏
                                $collect = get_sql($con, "collect", "WHERE col_a_id='". $account[0]["a_id"] ."' AND col_page_id=" . $page[0]["page_id"]);
                                $data["collect"] = $collect ? "already" : "yet";
                                //推廣文章
                                $channel = get_sql($con, "channel", "WHERE ch_user_id='".$account[0]["a_id"]."'");
                                if( $channel ){
                                    $data["ch_url"] = $channel[0]["ch_url"];
                                }
                                else{
                                    $data["ch_url"] = $account[0]["a_id"];
                                }
                            }
                            else{
                                //文章附件
                                $data["page_file"] = array();
                            }
                            
                            $callback['data'] = $data;
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

function get_this_week_hot_page(){
        
        $callback = array();
        try{
                if( check_empty( array( "page_num" ) ) ) {
                    
                    $page_num = $_REQUEST[ "page_num" ];
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    date_default_timezone_set('Asia/Taipei');
                    //本周熱門++
                    $w = date('Y-W');
                    $this_week_hot_page = get_sql_array( $con , "page as p join page_click_num_w as cli on p.page_id=cli.cliw_page_id"
                                                , array( "page_id" , "p_title" , "p_icon" )
                                                , "WHERE p.p_display='block' AND cli.cliw_w='$w' order by cli.cliw_click_num DESC limit " . $page_num );
                    $data = $this_week_hot_page ? $this_week_hot_page : array();
                    //本周熱門--

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
        //本周熱門++
        $w = date('Y-W');
        $this_week_hot_page = get_sql_array( $con , "page as p join page_click_num_w as cli join category as c on p.page_id=cli.cliw_page_id AND p.p_category_id = c.cate_id"
                                    , array( "page_id" , "p_title" , "cate_name" , "cate_color" )
                                    , "WHERE p.p_display='block' AND cli.cliw_w='$w' order by cli.cliw_click_num DESC limit 13" );
        $data["this_week_hot_page"] = $this_week_hot_page ? $this_week_hot_page : array();
        //本周熱門--
        
        
}

function get_page(){
        $callback = array();
        try{
                if( check_empty( array( "ch","category","mod","ori","cur_page","page_num" ) ) ) {
                    
                    $ch = $_REQUEST[ "ch" ];
                    $category = $_REQUEST[ "category" ];
                    $mod = $_REQUEST[ "mod" ];
                    $ori = $_REQUEST[ "ori" ];
                    $cur_page = $_REQUEST[ "cur_page" ];
                    $page_num = $_REQUEST[ "page_num" ];
                    $_page = ( (int)$cur_page - 1 )* (int)$page_num;
                    
                    $data = array();
                    if( !in_array($mod, array("Common","New","Hot")) ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    if( !in_array($ori, array("All","true","false")) ){
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
                    
                    switch ($ori) {
                        case "All":
                            $ori_mysql_str = "";
                            break;
                        case "true":
                            $ori_mysql_str = " AND p.p_originality=1";
                            break;
                        case "false":
                            $ori_mysql_str = " AND p.p_originality=0";
                            break;
                    }
                    $category_mysql_str = $category === "All" ? "" : " AND p.p_category_id=$category";
                    $ch_mysql_str = $ch === "All" ? "" : " AND c.ch_id=$ch";
                    
                    switch ($mod) {
                        case "Common":
                            $page = get_sql( $con , "page as p join channel as c join category as d on c.ch_id = p.p_channel_id AND p.p_category_id = d.cate_id" , "where p.p_display='block'" .$ori_mysql_str.$category_mysql_str.$ch_mysql_str. " Order by p_date DESC LIMIT $_page, $page_num" );
                            break;
                        case "New":
                            $page = get_sql( $con , "page as p join channel as c join category as d on c.ch_id = p.p_channel_id AND p.p_category_id = d.cate_id" , "where p.p_display='block'" .$ori_mysql_str.$category_mysql_str.$ch_mysql_str. " Order by p_date DESC LIMIT $_page, $page_num" );
                            break;
                        case "Hot":
                            $page = get_sql( $con , "page as p join channel as c join category as d on c.ch_id = p.p_channel_id AND p.p_category_id = d.cate_id" , "where p.p_display='block'" .$ori_mysql_str.$category_mysql_str.$ch_mysql_str. " Order by p_click_num DESC LIMIT $_page, $page_num" );
                            break;
                    }
                    
                    if( $page ){
                            
                            foreach ($page as $key => $value) {
                                    $data[] = array( "page_id" => $value["page_id"] ,
                                                     "p_icon" => http_page_path.$value["page_id"]."/ThumbnailS/".$value["p_icon"] ,
                                                     "p_click_num" => $value["p_click_num"] ,
                                                     "p_share_num" => $value["p_share_num"] ,
                                                     "p_category_id" => $value["p_category_id"] ,
                                                     "p_title" => $value["p_title"] ,
                                                     "p_tag" => json_decode($value["p_tag"]) ,
                                                     "p_date" => $value["p_date"] ,
                                                     "ch_id" => $value["ch_id"] ,
                                                     "ch_name" => $value["ch_name"] ,
                                                     "cate_name" => $value["cate_name"] );
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


function database_add_click( $con , $page , $ch ) {
        
        date_default_timezone_set('Asia/Taipei');
        $time = time();
        $date = date('Y-m-d');
        $w = date('Y-W');
        $m = date('Y-m');
        //$datetime = date('Y-m-d H:i:s');
        
        
        $page_click_everytime = get_sql($con, "page_click_everytime" , "WHERE cli_page_id=$page");
        if( $page_click_everytime ){
            if( $page_click_everytime[0]['cli_time'] !== "" ) {
                $datetime_arr = json_decode($page_click_everytime[0]['cli_time']);
                $datetime_arr[] = $time;
            }
            else {
                $datetime_arr = array( $time );
            }
            $sql = "UPDATE page_click_everytime SET cli_time='" . json_encode($datetime_arr) . "' WHERE cli_page_id=$page";
            mysqli_query( $con , $sql );
        }
        else {
            mysqli_query($con, "INSERT INTO page_click_everytime( cli_page_id, cli_time) VALUES ( $page, '[$time]')");
        }

        $page_click_num_d = get_sql($con, "page_click_num_d" , "WHERE clid_page_id=$page AND clid_date='$date'");
        if( $page_click_num_d ){
                $sql = "UPDATE page_click_num_d SET clid_click_num=clid_click_num+1 WHERE clid_id=" . $page_click_num_d[0]['clid_id'];
                mysqli_query( $con , $sql );
        }
        else {
                mysqli_query($con,"INSERT INTO page_click_num_d( clid_page_id, clid_click_num, clid_date ) VALUES ( $page, 1, '$date')");
        }

        $page_click_num_w = get_sql($con, "page_click_num_w" , "WHERE cliw_page_id=$page AND cliw_w='$w'");
        if( $page_click_num_w ){
                $sql = "UPDATE page_click_num_w SET cliw_click_num=cliw_click_num+1 WHERE cliw_id=" . $page_click_num_w[0]['cliw_id'];
                mysqli_query( $con , $sql );
        }
        else {
                mysqli_query($con,"INSERT INTO page_click_num_w( cliw_page_id, cliw_click_num, cliw_w ) VALUES ( $page, 1, '$w')");
        }
        
        $page_click_num_m = get_sql($con, "page_click_num_m" , "WHERE clim_page_id=$page AND clim_m='$m'");
        if( $page_click_num_m ){
                $sql = "UPDATE page_click_num_m SET clim_click_num=clim_click_num+1 WHERE clim_id=" . $page_click_num_m[0]['clim_id'];
                mysqli_query( $con , $sql );
        }
        else {
                mysqli_query($con,"INSERT INTO page_click_num_m( clim_page_id, clim_click_num, clim_m ) VALUES ( $page, 1, '$m')");
        }

        $channel_click_num_w = get_sql($con, "channel_click_num_w" , "WHERE ch_cliw_channel_id=$ch AND ch_cliw_w='$w'");
        if( $channel_click_num_w ){
                $sql = "UPDATE channel_click_num_w SET ch_cliw_click_num=ch_cliw_click_num+1 WHERE ch_cliw_id=" . $channel_click_num_w[0]['ch_cliw_id'];
                mysqli_query( $con , $sql );
        }
        else {
                mysqli_query($con,"INSERT INTO channel_click_num_w( ch_cliw_channel_id, ch_cliw_click_num, ch_cliw_w ) VALUES ( $ch, 1, '$w')");
        }

        $channel_click_num_m = get_sql($con, "channel_click_num_m" , "WHERE ch_clim_channel_id=$ch AND ch_clim_m='$m'");
        if( $channel_click_num_m ){
                $sql = "UPDATE channel_click_num_m SET ch_clim_click_num=ch_clim_click_num+1 WHERE ch_clim_id=" . $channel_click_num_m[0]['ch_clim_id'];
                mysqli_query( $con , $sql );
        }
        else {
                mysqli_query($con,"INSERT INTO channel_click_num_m( ch_clim_channel_id, ch_clim_click_num, ch_clim_m ) VALUES ( $ch, 1, '$m')");
        }
        
        $sql = "UPDATE `page` SET p_click_num=p_click_num+1 WHERE page_id=".$page;
        mysqli_query($con, $sql);
        
}

function database_spread_add_click( $con , $page_id , $ch_percent , $ch_user_id ) {
        
        date_default_timezone_set('Asia/Taipei');
        $m = date('Y-m');
        
        $json = array();
        $host = explode(".", $_SERVER["HTTP_HOST"]);
        array_splice($host, -2);
        $host = join($host, ".");
        if( $host !== "www" ){
            $promoter = get_sql($con, "channel", "WHERE ch_url='$host'");
            if( $promoter ){
                    $json["ps_promoter"] = $promoter[0]["ch_user_id"];
                    $json["ps_page_id"] = (int)$page_id;
                    $json["ps_beneficiary"] = $ch_user_id;
                    $json["ps_percent"] = (int)$ch_percent;
                    $json["ps_date_m"] = $m;
                    $page_spread = get_sql_by_array($con, "page_spread", $json);
                    if( $page_spread ){
                        $sql = "UPDATE `page_spread` SET ps_click=ps_click+1 WHERE ps_id=" . $page_spread[0]["ps_id"];
                        mysqli_query($con, $sql);
                    }
                    else {
                        $json["ps_click"] = 1;
                        insert_sql($con, "page_spread", $json);
                    }
            }
        }

}

?>
