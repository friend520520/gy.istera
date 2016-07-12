<?php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_simple_channel_info":
        $echo = get_simple_channel_info();
        break;
    case "get_channel_info":
        $echo = get_channel_info();
        break;
    case "get_my_channel_info":
        $echo = get_my_channel_info();
        break;
    case "get_my_ch_url":
        $echo = get_my_ch_url();
        break;
    case "set_channel":
        $echo = set_channel();
        break;
    case "get_all_channel":
        $echo = get_all_channel();
        break;
}

echo json_encode($echo);

function get_simple_channel_info(){
        $callback = array();
        try{
                if( !check_empty( array( "ch" ) ) ) {
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $ch = $_REQUEST["ch"];
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $channel = get_sql($con, "channel", "WHERE ch_id=$ch");
                if( $channel ){
                        $data["ch_icon"] = http_channel_path.$channel[0]["ch_id"]."/".$channel[0]["ch_icon"];
                        $data["ch_name"] = $channel[0]["ch_name"];
                        $data["ch_introduce"] = $channel[0]["ch_introduce"];
                        
                        $callback['data'] = $data;
                        $callback['success'] = true;
                }
                else {
                        $callback['msg'] = "YET";
                        $callback['success'] = false;
                }


                mysqli_close($con);

                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function get_channel_info(){
        $callback = array();
        try{
                if( !check_empty( array( "ch","ori" ) ) ) {
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $token = !isset($_REQUEST["token"]) || empty($_REQUEST["token"]) ? "" : md5( $_REQUEST[ "token" ] );
                $ch = $_REQUEST["ch"];
                $ori = $_REQUEST["ori"];
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
                
                $channel = get_sql($con, "channel", "WHERE ch_id=$ch");
                if( $channel ){
                        //文章數，下架數
                        $page_num = 0;
                        $blockade_page_num = 0;
                        $data = array();
                        $page = get_sql($con, "page", "WHERE p_channel_id=$ch GROUP BY p_display", "p_display,COUNT(page_id)");
                        if( $page ){
                            foreach ($page as $key => $value) {
                                if( $value["p_display"] === "block" ){
                                        $page_num += (int)$value["COUNT(page_id)"];
                                }
                                else if( $value["p_display"] === "blockade" ){
                                        $page_num += (int)$value["COUNT(page_id)"];
                                        $blockade_page_num += (int)$value["COUNT(page_id)"];
                                }
                                else if( $value["p_display"] === "none" ){
                                        $page_num += (int)$value["COUNT(page_id)"];
                                        $blockade_page_num += (int)$value["COUNT(page_id)"];
                                }
                            }
                        }
                        //全部文章點閱總數
                        $page = get_sql($con, "page", "WHERE p_channel_id=$ch", "sum(p_click_num)");
                        $all_page_click_num = $page ? $page[0]["sum(p_click_num)"] : 0;
                        //當月點閱數
                        date_default_timezone_set('Asia/Taipei');
                        $m = date('Y-m');
                        $page = get_sql($con, "channel_click_num_m as ccm", "WHERE ccm.ch_clim_channel_id=$ch AND ccm.ch_clim_m='$m'" , "ch_clim_click_num");
                        $month_click_num = $page ? $page[0]["ch_clim_click_num"] : 0;
                        //分類文章數量
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
                        $page = get_sql_array($con, "page as p join category as c on p.p_category_id=c.cate_id"
                                            , array( "cate_id" , "COUNT(page_id)", "cate_name" )
                                            , "WHERE p.p_channel_id=$ch AND p.p_display='block'".$ori_mysql_str." GROUP BY p.p_category_id"
                                            , "cate_id, COUNT(page_id), cate_name");
                        $page = $page ? $page : array();
                        
                        if( $token === "" ){
                            $login = false;
                        }
                        else {
                            $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                            $login = $account ? true : false;
                        }
                        if( $login ){
                            //檢查有沒有追蹤
                            $track = get_sql($con, "track", "WHERE t_a_id='". $account[0]["a_id"] ."' AND t_ch_id=" . $channel[0]["ch_id"]);
                            $data["track"] = $track ? "already" : "yet";
                        }
                        else{
                        }
                        
                        $data["ch_icon"] = http_channel_path.$channel[0]["ch_id"]."/".$channel[0]["ch_icon"];
                        $data["ch_cover"] = http_channel_path.$channel[0]["ch_id"]."/".$channel[0]["ch_cover"];
                        $data["ch_name"] = $channel[0]["ch_name"];
                        $data["ch_introduce"] = $channel[0]["ch_introduce"];
                        $data["ch_category"] = $channel[0]["ch_category"];
                        $data["ch_url"] = $channel[0]["ch_url"];
                        $data["ch_sign"] = $channel[0]["ch_sign"];
                        $data["ch_id"] = $channel[0]["ch_id"];
                        $data["page_num"] = $page_num;
                        $data["blockade_page_num"] = $blockade_page_num;
                        $data["all_page_click_num"] = $all_page_click_num;
                        $data["month_click_num"] = $month_click_num;
                        $data["cate_page"] = $page;
                        
                        $callback['data'] = $data;
                        $callback['success'] = true;
                }
                else {
                        $callback['msg'] = "YET";
                        $callback['success'] = false;
                }


                mysqli_close($con);

                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function get_my_channel_info(){
        $callback = array();
        try{
                
                if( !check_empty( array( "token" ) ) ) {
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                        return $callback;
                }
                
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
                
                $channel = get_sql($con, "channel", "WHERE ch_user_id='" . $account[0]["a_id"] . "'");
                if( $channel ){
                        $callback['data'] = array( "ch_icon" => http_channel_path.$channel[0]["ch_id"]."/".$channel[0]["ch_icon"] ,
                                                   "ch_cover" => http_channel_path.$channel[0]["ch_id"]."/".$channel[0]["ch_cover"] ,
                                                   "ch_name" => $channel[0]["ch_name"] ,
                                                   "ch_introduce" => $channel[0]["ch_introduce"] ,
                                                   "ch_category" => $channel[0]["ch_category"] ,
                                                   "ch_percent" => $channel[0]["ch_percent"] ,
                                                   "ch_url" => $channel[0]["ch_url"] ,
                                                   "ch_sign" => $channel[0]["ch_sign"] ,
                                                   "ch_id" => $channel[0]["ch_id"] );
                        $callback['success'] = true;
                }
                else {
                        $callback['msg'] = "YET";
                        $callback['success'] = false;
                }


                mysqli_close($con);

                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function get_my_ch_url(){
        $callback = array();
        try{
                
                if( !check_empty( array( "token" ) ) ) {
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                        return $callback;
                }
                
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
                
                $channel = get_sql($con, "channel", "WHERE ch_user_id='" . $account[0]["a_id"] . "'");
                if( $channel ){
                        $callback['data'] = $channel[0]["ch_url"];
                        $callback['success'] = true;
                }
                else {
                        $callback['msg'] = "YET";
                        $callback['success'] = false;
                }


                mysqli_close($con);

                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function set_channel(){
        $callback = array();
        try{
                if( check_empty( array( "token" , 
                                        "a_ch_name" , 
                                        "a_ch_introduction" , 
                                        "a_ch_category" , 
                                        "a_ch_id" ,
                                        "a_ch_share" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $a_ch_name = $_REQUEST["a_ch_name"];
                    $a_ch_introduction = $_REQUEST["a_ch_introduction"];
                    $a_ch_category = $_REQUEST["a_ch_category"];
                    $a_ch_id = $_REQUEST["a_ch_id"];
                    $a_ch_share = (int)$_REQUEST["a_ch_share"];
                    $a_ch_sign = $_REQUEST["a_ch_sign"];
                    $a_ch_icon = $_REQUEST["a_ch_icon"];
                    $a_ch_cover = $_REQUEST["a_ch_cover"];
                    
                    if( $a_ch_id === "www" ){
                            $callback['msg'] = "自定義不可命名www";
                            $callback['success'] = false;
                            return $callback;
                    }
                    if( !($a_ch_share >= 1 && $a_ch_share <= 60) ){
                            $callback['msg'] = "推廣%數錯誤";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    if( !in_array($a_ch_category, array("1","2","3","4","5","6","7","8")) ){
                            $callback['msg'] = "頻道分類錯誤";
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
                    
                    $channel = get_sql($con, "channel", "WHERE ch_user_id='" . $account[0]["a_id"] . "'");
                    if( $channel ){
                            if( $channel[0]["ch_name"] !== $a_ch_name && get_sql($con, "channel", "WHERE ch_name='$a_ch_name'") ) {
                                    $callback['msg'] = "頻道名稱已存在";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            if( $channel[0]["ch_url"] !== $a_ch_id && get_sql($con, "account as a join channel as ch", "WHERE a.a_id='$a_ch_id' OR ch.ch_url='$a_ch_id'") ) {
                                    $callback['msg'] = "自定義頻道網址已存在";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $ch_id = $channel[0]["ch_id"];
                            $event = "update";
                    }
                    else {
                            if( get_sql($con, "channel", "WHERE ch_name='$a_ch_name'") ) {
                                    $callback['msg'] = "頻道名稱已存在";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            if( get_sql($con, "channel", "WHERE ch_url='$a_ch_id'") ) {
                                    $callback['msg'] = "自定義頻道網址已存在";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $result = mysqli_query($con,"SHOW TABLE STATUS LIKE 'channel'");
                            $row = mysqli_fetch_array($result);
                            $ch_id = $row['Auto_increment'];
                            $event = "insert";
                    }
                    
                    if( !file_exists(channel_path.$ch_id) ){
                        mkdir(channel_path.$ch_id, 0777, true);
                    }
                    
                    $json = array();
                    if( $a_ch_icon !== "" ) {
                        if( !file_exists(upload_transient_file.$a_ch_icon) ){
                            $callback['msg'] = "icon not exist";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                        }
                        $a_ch_icon_sub = explode( "." , $a_ch_icon );
                        $a_ch_icon_sub = $a_ch_icon_sub[count($a_ch_icon_sub)-1];
                        copy( upload_transient_file.$a_ch_icon , channel_path.$ch_id."\\ch_icon.".$a_ch_icon_sub );
                        $add_a_ch_icon = "ch_icon." . $a_ch_icon_sub;
                        if( !file_exists( channel_path.$ch_id."\\ch_icon.".$a_ch_icon_sub ) ){
                            $callback['success'] = false;
                            $callback['msg'] = "Upload channel icon fail";
                            mysqli_close($con);
                            return $callback;
                        }
                        $json["ch_icon"] = $add_a_ch_icon;
                    }
                    if( $a_ch_cover !== "" ) {
                        if( !file_exists(upload_transient_file.$a_ch_cover) ){
                            $callback['msg'] = "icon not exist";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                        }
                        $a_ch_cover_sub = explode( "." , $a_ch_cover );
                        $a_ch_cover_sub = $a_ch_cover_sub[count($a_ch_cover_sub)-1];
                        copy( upload_transient_file.$a_ch_cover , channel_path.$ch_id."\\ch_cover.".$a_ch_cover_sub );
                        $add_a_ch_cover = "ch_cover." . $a_ch_cover_sub;
                        if( !file_exists( channel_path.$ch_id."\\ch_cover.".$a_ch_cover_sub ) ){
                            $callback['success'] = false;
                            $callback['msg'] = "Upload channel cover fail";
                            mysqli_close($con);
                            return $callback;
                        }
                        $json["ch_cover"] = $add_a_ch_cover;
                    }
                    
                    $json["ch_name"] = mysqli_real_escape_string($con,$a_ch_name);
                    $json["ch_introduce"] = mysqli_real_escape_string($con,$a_ch_introduction);
                    $json["ch_url"] = mysqli_real_escape_string($con,$a_ch_id);
                    $json["ch_sign"] = mysqli_real_escape_string($con,$a_ch_sign);
                    $json["ch_category"] = $a_ch_category;
                    $json["ch_percent"] = $a_ch_share;
                    
                    if( $event === "update" ){
                            if (update_sql( $con , "channel" , $json , array( "ch_id" => $ch_id ) )) {
                                $callback['success'] = true;
                            }
                            else {
                                $callback['msg'] = "update fail";
                                $callback['success'] = false;
                            }
                    }
                    else if( $event = "insert" ){
                            date_default_timezone_set('Asia/Taipei');
                            $json["ch_registration_time"] = date('Y-m-d H:i:s');
                            $json["ch_user_id"] = $account[0]["a_id"];
                            if (insert_sql( $con , "channel" , $json )) {
                                $callback['success'] = true;
                            }
                            else {
                                $callback['msg'] = "apply fail";
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

function get_all_channel(){
        $callback = array();
        try{
                if( !check_empty( array( "mod" ) ) ) {
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $mod = $_REQUEST["mod"];
                if( !in_array($mod, array("New","Cotent","Hot")) ){
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
                
                $search = !isset($_REQUEST["search"]) || empty($_REQUEST["search"])  ? "" : $_REQUEST["search"];
                $search_SQL_string = $search !== "" ? "WHERE ch_name like '%$search%'" : "";
                
                switch ($mod) {
                    case "New":
                        $channel = get_sql($con, "channel as ch" , $search_SQL_string." Order by ch.ch_registration_time DESC");
                        break;
                    case "Cotent":
                        $channel = get_sql($con, "channel as ch join page as p on ch.ch_id=p.p_channel_id" , $search_SQL_string." GROUP BY p.p_channel_id Order by COUNT(p.page_id) DESC" , "*");
                        break;
                    case "Hot":
                        $channel = get_sql($con, "channel as ch join page as p on ch.ch_id=p.p_channel_id" , $search_SQL_string." GROUP BY p.p_channel_id Order by SUM(p.p_click_num) DESC" , "*");
                        break;
                }
                
                if( $channel ){
                        $data = array();
                        foreach ($channel as $key => $value) {
                                $data[] = array( "ch_id" => $value["ch_id"] ,
                                                 "ch_name" => $value["ch_name"] ,
                                                 "ch_icon" => http_channel_path.$value["ch_id"]."/".$value["ch_icon"] );
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
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}


?>
