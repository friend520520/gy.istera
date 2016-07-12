<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';
include 'account_event.php';
include 'sample/check_login.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "build_help":
        $echo = build_help();
        break;
    case "build_helped":
        $echo = build_helped();
        break;
    case "get_my_help_and_helped":
        $echo = get_my_help_and_helped();
        break;
    case "get_my_ava_helped":
        $echo = get_my_ava_helped();
        break;
    case "get_my_help":
        $echo = get_my_help();
        break;
    case "get_pair_detail_by_help":
        $echo = get_pair_detail_by_help();
        break;
    case "edit_pair_detail_by_help":
        $echo = edit_pair_detail_by_help();
        break;
    case "get_my_helped":
        $echo = get_my_helped();
        break;
    case "get_pair_detail_by_helped":
        $echo = get_pair_detail_by_helped();
        break;
    case "check_pair_detail_by_helped":
        $echo = check_pair_detail_by_helped();
        break;
    case "get_all_pair":
        $echo = get_all_pair();
        break;
    case "get_pair_detail":
        $echo = get_pair_detail();
        break;
    case "get_sms":
        $echo = get_sms();
        break;
    case "send_sms":
        $echo = send_sms();
        break;
    case "cal_interest":
        $echo = cal_interest();
        break;
    case "check_pair":
        $echo = check_pair();
        break;
    case "pause_member":
        $echo = pause_member();
        break;
    case "cancel_pair":
        $echo = cancel_pair();
        break;
    case "support_back_day":
        $echo = support_back_day();
        break;
    case "get_can_be_change_helped":
        $echo = get_can_be_change_helped();
        break;
    case "get_income_history":
        $echo = get_income_history();
        break;
    case "get_income_history_by_admin":
        $echo = get_income_history_by_admin();
        break;
    case "get_interest_history_by_admin":
        $echo = get_interest_history_by_admin();
        break;
    case "get_need_process_help_helped":
        $echo = get_need_process_help_helped();
        break;
}

echo json_encode($echo);

function build_help()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","value" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $value = $_REQUEST[ "value" ];
//                $password = $_REQUEST[ "password" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                if( $account["a_payment_bank"] === "" || $account["a_payment_account"] === "" || $account["a_payment_account_name"] === "" ){
                        $callback['url'] = "mgc_data_collection.php";
                        $callback['msg'] = "匯款資訊未填完整，三秒後轉跳到匯款資訊頁面";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $help_money = get_sql($con, "help_money", "WHERE hm_id=".$value);
                if( !$help_money ){
                        $callback['msg'] = "幫助金額錯誤";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $fn_event = fn_event( $con, "H00001", $account["a_id"], null , $help_money[0]["hm_value"] );
                if( !$fn_event["success"] ) {
                        $callback['msg'] = $fn_event["msg"];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function build_helped()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","a_no" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $a_no = $_REQUEST[ "a_no" ];
                foreach ($a_no as $key => $value) {
                    $a_no[$key] = "'".$value."'";
                }
                $a_no = implode(",",$a_no);
//                $password = $_REQUEST[ "password" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                
                $account_order = get_sql($con, "account_order", "WHERE a_no IN ($a_no) AND a_state=5.1");
                if( !$account_order ) {
                        $callback['msg'] = "訂單資料錯誤";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $sql = "UPDATE `account_order` SET a_state=6 WHERE a_no IN ($a_no) AND a_state=5.1";
                if ( mysqli_query($con, $sql) ) {
                    $callback['success'] = true;
                } else {
                    $callback['msg'] = "建立被幫助單失敗";
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

function get_my_help_and_helped()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","start_date","end_date" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $start_date = $_REQUEST[ "start_date" ];
                $end_date = $_REQUEST[ "end_date" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $operation_html = isset($_REQUEST[ "operation_html" ]) ? mysqli_real_escape_string($con,$_REQUEST[ "operation_html" ]) : "";
                
                $type_cond = "CASE WHEN a_type=2 THEN '直推獎金'"
                                . " WHEN a_type=3 THEN '組織獎金'"
                                . " WHEN a_type=4 THEN '首次幫助獎金'"
                                . " WHEN a_state<6 THEN '提供幫助'"
                                . " WHEN a_state>=6 THEN '得到幫助'"
                                . " ELSE '不明' END";
                
                $cond = "CASE WHEN a_state=1 OR a_state=6 THEN '尚未匹配'"
                          . " WHEN a_state=3 OR a_state=8 THEN '匹配成功'"//配對成功
                          . " WHEN a_state=2 OR a_state=7 THEN '取消匹配'"
                          . " WHEN a_state=4 OR a_state=9 THEN '匯款失敗'"
                          . " WHEN a_state=5 OR a_state=10 THEN '待確認收款'"
                          . " WHEN a_state=5.1 OR a_state=10.1 THEN '完成幫助'"
                          . " WHEN a_state=5.2 THEN '被幫助者未確認'"
                          . " WHEN a_state=10.2 THEN '未確認匯款'"
                          . " ELSE '不明' END";
                
                $account_order = get_sql_array_for_datatable($con, "account_order"
                                            , array( "a_no" , "a_no" , "type" , "a_start" , "a_principle" , "a_interest" , "con" , "sta" , "opera" )
                                            , "WHERE a_id='".$account["a_id"]."' AND a_start between '$start_date 00:00:00' and '$end_date 23:59:59' ORDER BY a_start DESC"
                                            , "*,($type_cond) as type,($cond) as con,'否' as sta,'$operation_html' as opera");
                if( $account_order ){
                    $data = $account_order;
                }
                else{
                    $data = array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_my_ava_helped()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $operation_html = isset($_REQUEST[ "operation_html" ]) ? mysqli_real_escape_string($con,$_REQUEST[ "operation_html" ]) : "";
                
                $account_order = get_sql_array($con, "account_order"
                                            , array( "a_no" , "a_start" , "a_principle" , "a_interest" )
                                            , "WHERE a_id='".$account["a_id"]."' AND a_state = 6  ORDER BY a_start DESC" );
                if( $account_order ){
                    $data = $account_order;
                }
                else{
                    $data = array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_my_help()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","start_date","end_date" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $start_date = $_REQUEST[ "start_date" ];
                $end_date = $_REQUEST[ "end_date" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $operation_html = isset($_REQUEST[ "operation_html" ]) ? mysqli_real_escape_string($con,$_REQUEST[ "operation_html" ]) : "";
                
                $state_cond = "CASE WHEN ap.ap_confirm=0 OR ap.ap_confirm=5 THEN '未付款'"
                          . " WHEN ap.ap_confirm=1 THEN '未確認'"
                          . " WHEN ap.ap_confirm=2 THEN '已確認'"
                          . " ELSE '未配對' END";
                $transfer_cond = "CASE WHEN ap.ap_confirm=0 OR ap.ap_confirm=5 THEN '尚未匯款'"
                          . " WHEN ap.ap_transfer_time!='0000-00-00 00:00:00' THEN date_format(ap.ap_transfer_time,'%Y/%m/%d %H:%i')"
                          . " ELSE '' END";
                $dead_time_cond = "CASE WHEN ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) < 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"undone\">匯款剩餘時間',24-HOUR(TIMEDIFF(NOW(),  ap.a_time)) ,'小時</em>')"
                          . " WHEN ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) >= 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">匯款時間到期</em>')"
                          . " WHEN ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) < 48 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"undone\">確認剩餘時間',48-HOUR(TIMEDIFF(NOW(),  ap.ap_transfer_time)) ,'小時</em>')"
                          . " WHEN ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) >= 48 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">確認時間到期</em>')"
                          . " WHEN ap.ap_confirm=2 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em>已確認</em>')"
                          . " WHEN ap.ap_confirm=5 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) >= 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">已封鎖幫助者</em>')"
                          . " ELSE '' END";
                $opera1_cond = "CASE WHEN ap.ap_id is null THEN ''"
                          . " ELSE '<a href=\"#\" class=\"detail\">詳細資料</a>' END";
                $opera2_cond = "CASE WHEN ap.ap_id is null THEN ''"
                          . " ELSE CONCAT('<a href=\"#\" class=\"mark msg_box\">訊息(<strong>',COALESCE(COUNT(apm.apm_id),0),'</strong>)</a>') END";
                
                
//                <td>王小明</td>
//                <td>未付款</td>
//                <td>1000USD</td>
//                <td>2016/01/02 19:20</td>
//                <td>2016/01/03 19:20<em class="undone">剩餘時間3小時</em></td>
//                <td><a href="#" data-target="#myModalHelp" data-toggle="modal">詳細資料</a></td>
//                <td><a href="#" data-target="#myModalSMS" data-toggle="modal" class="mark">訊息(<strong>2</strong>)</a></td>
                
                $account_order = get_sql_array_for_datatable($con, "account_order `ao`"
                                                        . " LEFT JOIN account_pair `ap` on ao.a_no=ap.a_no_help"
                                                        . " LEFT JOIN account `a` on a.a_id=ap.a_id_ask"
                                                        . " LEFT JOIN account_pair_msg `apm` on apm.ap_id=ap.ap_id"
//                                                        . " LEFT JOIN (SELECT COUNT(*),ap_id FROM account_pair_msg GROUP BY ap_id) `apm` on apm.ap_id=ap.ap_id"
                                            , array( "ap_id" , "a_no" , "helped_person" , "state" , "a_principle" , "a_time" , "transfer_time" , "a_dead_time" , "opera1" , "opera2" )
                                            , "WHERE ao.a_id='".$account["a_id"]."' AND date_format(ao.a_start,'%Y-%m-%d')>='".$start_date."' AND date_format(ao.a_start,'%Y-%m-%d')<='".$end_date."' AND ao.a_state<6 GROUP BY ao.a_no ORDER BY ao.a_start DESC"
                                            , "*,ap.ap_id 'ap_id',COALESCE(a.a_nickname,'') 'helped_person',($state_cond) 'state',ao.a_principle 'a_principle',COALESCE(date_format(ap.a_time,'%Y/%m/%d %H:%i'),'') 'a_time',($transfer_cond) 'transfer_time',($dead_time_cond) as 'a_dead_time',($opera1_cond) as opera1,($opera2_cond) as opera2");
                if( $account_order ){
                    $data = $account_order;
                }
                else{
                    $data = array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_pair_detail_by_help()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","ap_id" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $ap_id = $_REQUEST[ "ap_id" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $account_pair = get_sql($con, "`account_pair` `ap`"
                                    . " join `account` `a` on ap.a_id_ask=a.a_id"
                                    . " LEFT JOIN `account` `par` on a.a_parent=par.a_id"
                                    . " join `account_order` `ao` on ap.a_no_help=ao.a_no"
                                    , "WHERE ap.ap_id='$ap_id' AND ap.a_id_help='".$account["a_id"]."'"
                                    , "*,a.a_payment_bank 'a_payment_bank',a.a_payment_account 'a_payment_account',a.a_payment_account_name 'a_payment_account_name',a.a_email 'ask_a_email',a.a_phone 'ask_a_phone',par.a_email 'par_a_email',par.a_phone 'par_a_phone'");
                 
                if( $account_pair ){
                    $callback['data'] = array( "a_no" => $account_pair[0]["a_no"] 
                                             , "ap_value" => $account_pair[0]["ap_value"]
                                             , "ap_transfer_time" => $account_pair[0]["ap_transfer_time"] === "0000-00-00 00:00:00" ? "未轉入" : $account_pair[0]["ap_transfer_time"]
                                             , "ap_remark" => $account_pair[0]["ap_remark"]
                                             , "ap_photo" => $account_pair[0]["ap_photo"] ? http_pair_path.$account_pair[0]["ap_id"]."/".$account_pair[0]["ap_photo"] : "images/remittances.jpg"
                                             , "ap_confirm" => $account_pair[0]["ap_confirm"]
//                                             , "a_id_ask" => $account_pair[0]["a_id_ask"]
                                             , "a_payment_bank" => $account_pair[0]["a_payment_bank"]
                                             , "a_payment_account" => $account_pair[0]["a_payment_account"]
                                             , "a_payment_account_name" => $account_pair[0]["a_payment_account_name"]
                                             , "a_email" => $account_pair[0]["ask_a_email"]
                                             , "a_phone" => $account_pair[0]["ask_a_phone"]
                                             , "par_a_email" => $account_pair[0]["par_a_email"] ? $account_pair[0]["par_a_email"] : "無"
                                             , "par_a_phone" => $account_pair[0]["par_a_phone"] ? $account_pair[0]["par_a_phone"] : "無"
                                             , "a_time" => $account_pair[0]["a_time"] );
                    $callback['success'] = true;
                }
                else{
                    $callback['msg'] = "資料錯誤";
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

function edit_pair_detail_by_help()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","ap_id" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                date_default_timezone_set('Asia/Taipei');
                $token = md5( $_REQUEST[ "token" ] );
                $ap_id = $_REQUEST[ "ap_id" ];
                $ap_remark = $_REQUEST[ "ap_remark" ];
                $ap_photo = $_REQUEST[ "ap_photo" ];
                $update_json = array();
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $account_pair = get_sql($con, "`account_pair` `ap`"
                                    . " join `account_order` `ao` on ap.a_no_help=ao.a_no"
                                    , "WHERE ap.ap_id='$ap_id' AND ap.a_id_help='".$account["a_id"]."'");
                 
                if( !$account_pair ){
                        $callback['msg'] = "資料錯誤";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $diff = abs(strtotime("now") - strtotime($account_pair[0]["a_time"]));
                if( $diff > (60*60*24) ){
                        $callback['msg'] = "匯款時間到期，無法修改資料";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $update_json["ap_remark"] = mysqli_real_escape_string( $con , $ap_remark );
                
                if( $ap_photo !== "" ) {
                    if( $ap_photo === "CLEAR" ){
                            if( $account_pair[0]["ap_photo"] !== "" ){
                                if( file_exists(pair_path.$account_pair[0]["ap_id"]."\\".$account_pair[0]["ap_photo"]) ){
                                    unlink(pair_path.$account_pair[0]["ap_id"]."\\".$account_pair[0]["ap_photo"]);
                                }
                                $update_json["ap_photo"] = "";
                            }
                    }
                    else{
                            if( !file_exists(upload_transient_file.$ap_photo) ){
                                $callback['msg'] = "icon not exist";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                            }
                            $ap_photo_sub = explode( "." , $ap_photo );
                            $ap_photo_sub = $ap_photo_sub[count($ap_photo_sub)-1];
                            $ap_photo_name = getRandom( 10 );
                            if( !copy( upload_transient_file.$ap_photo , pair_path.$account_pair[0]["ap_id"]."\\".$ap_photo_name.".".$ap_photo_sub ) ){
                                $callback['success'] = false;
                                $callback['msg'] = "Upload photo fail";
                                mysqli_close($con);
                                return $callback;
                            }
                            $update_json["ap_photo"] = $ap_photo_name . "." . $ap_photo_sub;
                            if( $account_pair[0]["ap_transfer_time"] === "0000-00-00 00:00:00" ){
                                    $update_json["ap_transfer_time"] = date('Y-m-d H:i:s');
                                    $update_json["ap_confirm"] = 1;
                                    
                                    if( !update_2table_sql( $con , "account_order as help", array( "help.a_state" => 5 ), array( "help.a_no" => $account_pair[0]["a_no_help"] )
                                                         , "account_order as ask", array( "ask.a_state" => 10 ), array( "ask.a_no" => $account_pair[0]["a_no_ask"] ) ) ){
                                            $callback['success'] = false;
                                            $callback['msg'] = "update information fail";
                                            mysqli_close($con);
                                            return $callback;
                                    }
                            }
                    }
                }
                if( update_sql($con, "account_pair", $update_json, array( "ap_id" => $ap_id )) ){
                        $callback['success'] = true;
                }
                else{
                        $callback['success'] = false;
                        $callback['msg'] = "update information fail";
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

function get_my_helped()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","start_date","end_date" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $start_date = $_REQUEST[ "start_date" ];
                $end_date = $_REQUEST[ "end_date" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
//                $operation_html = isset($_REQUEST[ "operation_html" ]) ? mysqli_real_escape_string($con,$_REQUEST[ "operation_html" ]) : "";
                
                $state_cond = "CASE WHEN ap.ap_confirm=0 OR ap.ap_confirm=5 THEN '未付款'"
                          . " WHEN ap.ap_confirm=1 THEN '未確認'"
                          . " WHEN ap.ap_confirm=2 THEN '已確認'"
                          . " ELSE '未配對' END";
                $transfer_cond = "CASE WHEN ap.ap_confirm=0 OR ap.ap_confirm=5 THEN '尚未匯款'"
                          . " WHEN ap.ap_transfer_time!='0000-00-00 00:00:00' THEN date_format(ap.ap_transfer_time,'%Y/%m/%d %H:%i')"
                          . " ELSE '' END";
                $dead_time_cond = "CASE WHEN ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) < 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"undone\">匯款剩餘時間',24-HOUR(TIMEDIFF(NOW(),  ap.a_time)) ,'小時</em>')"
                          . " WHEN ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) >= 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">匯款時間到期</em>')"
                          . " WHEN ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) < 48 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"undone\">確認剩餘時間',48-HOUR(TIMEDIFF(NOW(),  ap.ap_transfer_time)) ,'小時</em>')"
                          . " WHEN ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) >= 48 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">確認時間到期</em>')"
                          . " WHEN ap.ap_confirm=2 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em>已確認</em>')"
                          . " WHEN ap.ap_confirm=5 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) >= 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">已封鎖幫助者</em>')"
                          . " ELSE '' END";
                $opera1_cond = "CASE WHEN ap.ap_id is null THEN ''"
                          . " ELSE '<a href=\"#\" class=\"detail\">詳細資料</a>' END";
                $opera2_cond = "CASE WHEN ap.ap_id is null THEN ''"
                          . " ELSE CONCAT('<a href=\"#\" class=\"mark msg_box\">訊息(<strong>',COALESCE(COUNT(apm.apm_id),0),'</strong>)</a>') END";
                
                
//                <td>王小明</td>
//                <td>未付款</td>
//                <td>1000USD</td>
//                <td>2016/01/02 19:20</td>
//                <td>2016/01/03 19:20<em class="undone">剩餘時間3小時</em></td>
//                <td><a href="#" data-target="#myModalHelp" data-toggle="modal">詳細資料</a></td>
//                <td><a href="#" data-target="#myModalSMS" data-toggle="modal" class="mark">訊息(<strong>2</strong>)</a></td>
                
                $account_order = get_sql_array_for_datatable($con, "account_order `ao`"
                                                        . " LEFT JOIN account_pair `ap` on ao.a_no=ap.a_no_ask"
                                                        . " LEFT JOIN account `a` on a.a_id=ap.a_id_help"
                                                        . " LEFT JOIN account_pair_msg `apm` on apm.ap_id=ap.ap_id"
//                                                        . " LEFT JOIN (SELECT COUNT(*),ap_id FROM account_pair_msg GROUP BY ap_id) `apm` on apm.ap_id=ap.ap_id"
                                            , array( "ap_id" , "a_no" , "help_person" , "state" , "a_value" , "a_time" , "transfer_time" , "a_dead_time" , "opera1" , "opera2" )
                                            , "WHERE ao.a_id='".$account["a_id"]."' AND date_format(ao.a_start,'%Y-%m-%d')>='".$start_date."' AND date_format(ao.a_start,'%Y-%m-%d')<='".$end_date."' AND ao.a_state>=6 GROUP BY ao.a_no  ORDER BY ao.a_start DESC"
                                            , "*,ap.ap_id 'ap_id',COALESCE(a.a_nickname,'') 'help_person',($state_cond) 'state',ao.a_principle+ao.a_interest 'a_value',COALESCE(date_format(ap.a_time,'%Y/%m/%d %H:%i'),'') 'a_time',($transfer_cond) 'transfer_time',($dead_time_cond) as 'a_dead_time',($opera1_cond) as opera1,($opera2_cond) as opera2");
                if( $account_order ){
                    $data = $account_order;
                }
                else{
                    $data = array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_pair_detail_by_helped()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","ap_id" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $ap_id = $_REQUEST[ "ap_id" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $account_pair = get_sql($con, "`account_pair` `ap`"
                                    . " join `account` `a` on ap.a_id_help=a.a_id"
                                    . " LEFT JOIN `account` `par` on a.a_parent=par.a_id"
                                    . " join `account_order` `ao` on ap.a_no_ask=ao.a_no"
                                    , "WHERE ap.ap_id='$ap_id' AND ap.a_id_ask='".$account["a_id"]."'"
                                    , "*,a.a_payment_bank 'a_payment_bank',a.a_payment_account 'a_payment_account',a.a_payment_account_name 'a_payment_account_name',a.a_email 'help_a_email',a.a_phone 'help_a_phone',par.a_email 'par_a_email',par.a_phone 'par_a_phone'");
                 
                if( $account_pair ){
                    $callback['data'] = array( "a_no" => $account_pair[0]["a_no"] 
                                             , "ap_value" => $account_pair[0]["ap_value"]
                                             , "ap_transfer_time" => $account_pair[0]["ap_transfer_time"] === "0000-00-00 00:00:00" ? "未轉入" : $account_pair[0]["ap_transfer_time"]
                                             , "ap_remark" => $account_pair[0]["ap_remark"]
                                             , "ap_photo" => $account_pair[0]["ap_photo"] ? http_pair_path.$account_pair[0]["ap_id"]."/".$account_pair[0]["ap_photo"] : "images/remittances.jpg"
                                             , "ap_confirm" => $account_pair[0]["ap_confirm"]
//                                             , "a_id_ask" => $account_pair[0]["a_id_ask"]
                                             , "a_payment_bank" => $account_pair[0]["a_payment_bank"]
                                             , "a_payment_account" => $account_pair[0]["a_payment_account"]
                                             , "a_payment_account_name" => $account_pair[0]["a_payment_account_name"]
                                             , "a_email" => $account_pair[0]["help_a_email"]
                                             , "a_phone" => $account_pair[0]["help_a_phone"]
                                             , "par_a_email" => $account_pair[0]["par_a_email"] ? $account_pair[0]["par_a_email"] : "無"
                                             , "par_a_phone" => $account_pair[0]["par_a_phone"] ? $account_pair[0]["par_a_phone"] : "無" );
                    $callback['success'] = true;
                }
                else{
                    $callback['msg'] = "資料錯誤";
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

function check_pair_detail_by_helped()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","ap_id" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                date_default_timezone_set('Asia/Taipei');
                $token = md5( $_REQUEST[ "token" ] );
                $ap_id = $_REQUEST[ "ap_id" ];
                $update_json = array();
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $account_pair = get_sql( $con, "`account_pair` `ap`"
                                    . " join `account_order` `ao` on ap.a_no_ask=ao.a_no"
                                    . " join `account_order` `ao_help` on ap.a_no_help=ao_help.a_no"
                                    , "WHERE ap.ap_id='$ap_id' AND ap.a_id_ask='".$account["a_id"]."'"
                                    , "*,ao_help.a_no as 'ao_help_no'" );
                
                if( !$account_pair ){
                        $callback['msg'] = "資料錯誤";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $diff = abs(strtotime("now") - strtotime($account_pair[0]["ap_transfer_time"]));
                if( $diff > (60*60*24*2) ){
                        $callback['msg'] = "確認時間到期，無法確認。";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                if( $account_pair[0]["ap_confirm"] === "0" ){
                        $callback['msg'] = "此筆資料尚未匯款";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                if( $account_pair[0]["ap_confirm"] === "2" ){
                        $callback['msg'] = "此筆資料已確認過";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                if( $account_pair[0]["ap_confirm"] === "5" ){
                        $callback['msg'] = "此筆資料幫助者已被封鎖";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $update_json["ap_confirm"] = "2";
                $date = date('Y-m-d H:i:s');
                $update_json["ap_confirm_time"] = $date;
                
                $table_json = array( "account_order as help" , "account_order as ask" , "account_pair" );
                $update_json_for_multi = array( array( "help.a_state" => 5.1 ) , array( "ask.a_state" => 10.1 ) , $update_json );
                $key_json_for_multi = array( array( "help.a_no" => $account_pair[0]["a_no_help"] ) , array( "ask.a_no" => $account_pair[0]["a_no_ask"] ) , array( "ap_id" => $ap_id ) );
                
                if( update_multi_sql( $con , $table_json , $update_json_for_multi , $key_json_for_multi ) ){
                        $callback['success'] = true;
                        
                        //發放獎金單++
                        $first_parent = get_sql($con, "account as child JOIN account as parent on child.a_parent = parent.a_id AND child.a_parent !=''"
                                                    , "WHERE child.a_id='".$account_pair[0]["a_id_help"]."'"
                                                    , "parent.a_id,parent.a_manager" );
                        if( $first_parent ){

                                $system = get_sql( $con , "system" ,"WHERE s_id = 1");
                                $s_direct_push_income = $system ? (DOUBLE)$system[0]["s_direct_push_income"] : DEFAULT_DIRECT_PUSH_INCOME;

                                //直推獎金
                                $fn_bonus = fn_bonus( $con, "AV00100", $first_parent[0]["a_id"]
                                            , (int)$account_pair[0]["ap_value"]*$s_direct_push_income
                                            , "我直接推薦會員的幫助金額".$account_pair[0]["ap_value"]."*直推獎金%數".$s_direct_push_income
                                            , $date, $account_pair[0]["ao_help_no"] );
                                //組織獎金
                                $organize_income = get_sql( $con , "organize_income" ,"ORDER BY o_id ASC");

                                if( $first_parent[0]["a_manager"] === "true" && $organize_income && isset($organize_income[0]) ){
                                    $fn_bonus = fn_bonus( $con, "AV00200", $first_parent[0]["a_id"]
                                                , (int)$account_pair[0]["ap_value"]*(DOUBLE)$organize_income[0]["o_income"]
                                                , "下線會員的幫助金額".$account_pair[0]["ap_value"]."*".$organize_income[0]["o_name"]."組織獎金%數".$organize_income[0]["o_income"]
                                                , $date, $account_pair[0]["ao_help_no"] );
                                    give_organize_income( $con , $first_parent[0]["a_id"] , $account_pair[0]["ap_value"] , 2 , $organize_income , $date , $account_pair[0]["ao_help_no"] );
                                }

                        }
                        //首次提供幫助獎金
                        $check = get_sql($con, "account_order", "WHERE a_id='".$account_pair[0]["a_id_help"]."' AND a_type=4");
                        if( !$check ){
                            $check2 = get_sql($con, "first_time_income", "WHERE fti_least_money <= ".$account_pair[0]["ap_value"]." AND fti_most_money >= ".$account_pair[0]["ap_value"]);
                            if( $check2 ){
                                $a_first_income_datetime = date('Y-m-d H:i:s',strtotime("+".$check2[0]["fti_need_day"]." day"));
                                $fn_bonus = fn_bonus( $con, "AV00300", $account_pair[0]["a_id_help"]
                                                , (int)$check2[0]["fti_income"]
                                                , "首次幫助金額".$account_pair[0]["ap_value"]." => 首次提供幫助獎金".$check2[0]["fti_income"]
                                                , $date, $account_pair[0]["ao_help_no"], $a_first_income_datetime );
                            }
                        }


                        //發放獎金單--
                        
                        
                }
                else{
                        $callback['success'] = false;
                        $callback['msg'] = "update information fail";
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

function get_all_pair()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","start_date","end_date" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $start_date = $_REQUEST[ "start_date" ];
                $end_date = $_REQUEST[ "end_date" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_admin($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $operation_html = isset($_REQUEST[ "operation_html" ]) ? mysqli_real_escape_string($con,$_REQUEST[ "operation_html" ]) : "";
                
                $state_cond = "CASE WHEN ap.ap_confirm=0 OR ap.ap_confirm=5 THEN '未付款'"
                          . " WHEN ap.ap_confirm=1 THEN '未確認'"
                          . " WHEN ap.ap_confirm=2 THEN '已確認'"
                          . " ELSE '未配對' END";
                $transfer_cond = "CASE WHEN ap.ap_confirm=0 OR ap.ap_confirm=5 THEN '尚未匯款'"
                          . " WHEN ap.ap_transfer_time!='0000-00-00 00:00:00' THEN date_format(ap.ap_transfer_time,'%Y/%m/%d %H:%i')"
                          . " ELSE '' END";
                $dead_time_cond = "CASE WHEN ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) < 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"undone\">匯款剩餘時間',24-HOUR(TIMEDIFF(NOW(),  ap.a_time)) ,'小時</em>')"
                          . " WHEN ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) >= 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">匯款時間到期</em>')"
                          . " WHEN ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) < 48 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"undone\">確認剩餘時間',48-HOUR(TIMEDIFF(NOW(),  ap.ap_transfer_time)) ,'小時</em>')"
                          . " WHEN ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) >= 48 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">確認時間到期</em>')"
                          . " WHEN ap.ap_confirm=2 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em>已確認</em>')"
                          . " WHEN ap.ap_confirm=5 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) >= 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"error\">已封鎖幫助者</em>')"
                          . " ELSE '' END";
                $opera1_cond = "CASE WHEN ap.ap_id is null THEN ''"
                          . " ELSE CONCAT('<a href=\"#\" class=\"detail\">詳細資料</a><a href=\"#\" class=\"mark msg_box\">訊息(<strong>',COALESCE(COUNT(apm.apm_id),0),'</strong>)</a>') END";
                
                
//                <td>王小明</td>
//                <td>未付款</td>
//                <td>1000USD</td>
//                <td>2016/01/02 19:20</td>
//                <td>2016/01/03 19:20<em class="undone">剩餘時間3小時</em></td>
//                <td><a href="#" data-target="#myModalHelp" data-toggle="modal">詳細資料</a></td>
//                <td><a href="#" data-target="#myModalSMS" data-toggle="modal" class="mark">訊息(<strong>2</strong>)</a></td>
                
                $account_order = get_sql_array_for_datatable( $con, "account_pair `ap`"
                                                        . " LEFT JOIN account `a` on a.a_id=ap.a_id_help"
                                                        . " LEFT JOIN account `a2` on a2.a_id=ap.a_id_ask"
                                                        . " LEFT JOIN account_pair_msg `apm` on apm.ap_id=ap.ap_id"
//                                                        . " LEFT JOIN (SELECT COUNT(*),ap_id FROM account_pair_msg GROUP BY ap_id) `apm` on apm.ap_id=ap.ap_id"
                                            , array( "ap_id" , "help_person" , "ask_person" , "state" , "ap_value" , "a_time" , "transfer_time" , "a_dead_time" , "opera1" )
                                            , "WHERE date_format(ap.a_time,'%Y-%m-%d')>='".$start_date."' AND date_format(ap.a_time,'%Y-%m-%d')<='".$end_date."' GROUP BY ap.ap_id ORDER BY ap.a_time DESC"
                                            , "*,ap.ap_id 'ap_id',COALESCE(a.a_email,'') 'help_person',COALESCE(a2.a_email,'') 'ask_person',($state_cond) 'state',ap.ap_value 'ap_value',COALESCE(date_format(ap.a_time,'%Y/%m/%d %H:%i'),'') 'a_time',($transfer_cond) 'transfer_time',($dead_time_cond) as 'a_dead_time',($opera1_cond) as opera1");
                if( $account_order ){
                    $data = $account_order;
                }
                else{
                    $data = array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_pair_detail()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","ap_id" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $ap_id = $_REQUEST[ "ap_id" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_admin($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $account_pair = get_sql($con, "`account_pair` `ap`"
                                    . " join `account` `a` on ap.a_id_help=a.a_id"
                                    . " join `account_order` `ao` on ap.a_no_ask=ao.a_no"
                                    , "WHERE ap.ap_id='$ap_id'"
                                    , "*");
                
                if( $account_pair ){
                    $callback['data'] = array( "a_no" => $account_pair[0]["a_no"] 
                                             , "ap_value" => $account_pair[0]["ap_value"]
                                             , "ap_transfer_time" => $account_pair[0]["ap_transfer_time"] === "0000-00-00 00:00:00" ? "未轉入" : $account_pair[0]["ap_transfer_time"]
                                             , "ap_remark" => $account_pair[0]["ap_remark"]
                                             , "ap_photo" => $account_pair[0]["ap_photo"] ? http_pair_path.$account_pair[0]["ap_id"]."/".$account_pair[0]["ap_photo"] : "images/remittances.jpg"
                                             , "ap_confirm" => $account_pair[0]["ap_confirm"] );
                    $callback['success'] = true;
                }
                else{
                    $callback['msg'] = "資料錯誤";
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

function get_sms()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","ap_id","identity" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $ap_id = $_REQUEST[ "ap_id" ];
                $identity = $_REQUEST[ "identity" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                            
                if( !in_array($identity, array("help","helped","admin")) ){
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                        return $callback;
                }
                
                if( $identity === "help" || $identity === "helped" ){
                        $check = check_login($con);
                        if( !$check["success"] ){
                                $callback['msg'] = $check['msg'];
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        $account = $check["data"];
                        
                        $cond = $identity === "help" ? " AND ap.a_id_help='".$account["a_id"]."'" : " AND ap.a_id_ask='".$account["a_id"]."'";
                        $account_pair = get_sql($con
                                            , "`account_pair` `ap`"
                                    . " join `account_pair_msg` apm on ap.ap_id=apm.ap_id"
                                            , "WHERE ap.ap_id='$ap_id'" . $cond
                                            , "apm.apm_a_id,apm.apm_time,apm.apm_msg");
                }
                else if( $identity === "admin" ){
                        $check = check_admin($con);
                        if( !$check["success"] ){
                                $callback['msg'] = $check['msg'];
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        $account = $check["data"];
                        
                        $account_pair = get_sql($con
                                            , "`account_pair` `ap`"
                                    . " join `account_pair_msg` apm on ap.ap_id=apm.ap_id"
                                    . " left join `account` a on a.a_id=apm.apm_a_id"
                                            , "WHERE ap.ap_id='$ap_id'"
                                            , "apm.apm_a_id,apm.apm_time,apm.apm_msg,a.a_email");
                }
                
                 
                if( $account_pair ){
                    $callback['data'] = $account_pair;
                    $callback['success'] = true;
                }
                else{
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

function send_sms()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","ap_id","apm_msg" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                date_default_timezone_set('Asia/Taipei');
                $token = md5( $_REQUEST[ "token" ] );
                $ap_id = $_REQUEST[ "ap_id" ];
                $apm_msg = $_REQUEST[ "apm_msg" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $account_pair = get_sql($con
                                    , "`account_pair` `ap`"
                                    , "WHERE ap.ap_id='$ap_id' AND (ap.a_id_help='".$account["a_id"]."' OR ap.a_id_ask='".$account["a_id"]."')" );
                
                if( $account_pair ){
                    
                    $insert_array = array();
                    $insert_array["ap_id"] = $ap_id;
                    $insert_array["apm_a_id"] = $account["a_id"];
                    $insert_array["apm_msg"] = mysqli_real_escape_string( $con , $apm_msg );
                    $insert_array["apm_time"] = date('Y-m-d H:i:s');
                    
                    if( insert_sql($con, "account_pair_msg", $insert_array) ){
                            $callback['data'] = $ap_id;
                            $callback['success'] = true;
                    }
                    else{
                            $callback['msg'] = "寄送訊息失敗";
                            $callback['success'] = false;
                    }
                    
                }
                else{
                    $callback['msg'] = "此配對資料不存在";
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

function cal_interest()
{
        $callback = array();
        try{
                
//                if( !check_empty( array( "token" ) ) ) {
//                    $callback['msg'] = "parameter is error.";
//                    $callback['success'] = false;
//                    return $callback;
//                }
//                
//                $token = md5( $_REQUEST[ "token" ] );
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
//                $check = check_login($con);
//                if( !$check["success"] ){
//                        $callback['msg'] = $check['msg'];
//                        $callback['success'] = false;
//                        mysqli_close($con);
//                        return $callback;
//                }
//                $account = $check["data"];
                
                $fn_event = fn_event( $con, "H00011" );
                if( !$fn_event["success"] ) {
                        $callback['msg'] = $fn_event["msg"];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function check_pair()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","ap_id" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                date_default_timezone_set('Asia/Taipei');
                $token = md5( $_REQUEST[ "token" ] );
                $ap_id = $_REQUEST[ "ap_id" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_admin($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $data = array( "success" => 0 , "fail" => 0 );
                
                foreach ($ap_id as $k => $v) {
                        
                        $update_json = array();
                        $account_pair = get_sql($con, "`account_pair` `ap`"
                                            . " join `account_order` `ao` on ap.a_no_ask=ao.a_no"
                                            . " join `account_order` `ao_help` on ap.a_no_help=ao_help.a_no"
                                            , "WHERE ap.ap_id='$v'"
                                            , "*,ao_help.a_no as 'ao_help_no'" );
                        
                        if( !$account_pair ){
                                $data['fail']++;
                                continue;
                        }
                        $diff = abs(strtotime("now") - strtotime($account_pair[0]["ap_transfer_time"]));
                        //過期也要能pair
//                        if( $diff > (60*60*24*2) ){
//                                $data['fail']++;
//                                continue;
//                        }
                        if( $account_pair[0]["ap_confirm"] === "0" ){
                                $data['fail']++;
                                continue;
                        }
                        if( $account_pair[0]["ap_confirm"] === "2" ){
                                $data['fail']++;
                                continue;
                        }
                        if( $account_pair[0]["ap_confirm"] === "5" ){
                                $data['fail']++;
                                continue;
                        }
                        
                        $date = date('Y-m-d H:i:s');
                        $update_json["ap_confirm"] = "2";
                        $update_json["ap_confirm_time"] = $date;

                        $table_json = array( "account_order as help" , "account_order as ask" , "account_pair" );
                        $update_json_for_multi = array( array( "help.a_state" => 5.1 ) , array( "ask.a_state" => 10.1 ) , $update_json );
                        $key_json_for_multi = array( array( "help.a_no" => $account_pair[0]["a_no_help"] ) , array( "ask.a_no" => $account_pair[0]["a_no_ask"] ) , array( "ap_id" => $v ) );

                        if( update_multi_sql( $con , $table_json , $update_json_for_multi , $key_json_for_multi ) ){
                                $data['success']++;
                                
                                //發放獎金單++
                                $first_parent = get_sql($con, "account as child JOIN account as parent on child.a_parent = parent.a_id AND child.a_parent !=''"
                                                            , "WHERE child.a_id='".$account_pair[0]["a_id_help"]."'"
                                                            , "parent.a_id,parent.a_manager" );
                                if( $first_parent ){
                                        
                                        $system = get_sql( $con , "system" ,"WHERE s_id = 1");
                                        $s_direct_push_income = $system ? (DOUBLE)$system[0]["s_direct_push_income"] : DEFAULT_DIRECT_PUSH_INCOME;
                                        
                                        //直推獎金
                                        $fn_bonus = fn_bonus( $con, "AV00100", $first_parent[0]["a_id"]
                                                    , (int)$account_pair[0]["ap_value"]*$s_direct_push_income
                                                    , "我直接推薦會員的幫助金額".$account_pair[0]["ap_value"]."*直推獎金%數".$s_direct_push_income
                                                    , $date, $account_pair[0]["ao_help_no"] );
                                        //組織獎金
                                        $organize_income = get_sql( $con , "organize_income" ,"ORDER BY o_id ASC");
                                        
                                        if( $first_parent[0]["a_manager"] === "true" && $organize_income && isset($organize_income[0]) ){
                                            $fn_bonus = fn_bonus( $con, "AV00200", $first_parent[0]["a_id"]
                                                        , (int)$account_pair[0]["ap_value"]*(DOUBLE)$organize_income[0]["o_income"]
                                                        , "下線會員的幫助金額".$account_pair[0]["ap_value"]."*".$organize_income[0]["o_name"]."組織獎金%數".$organize_income[0]["o_income"]
                                                        , $date, $account_pair[0]["ao_help_no"] );
                                            give_organize_income( $con , $first_parent[0]["a_id"] , $account_pair[0]["ap_value"] , 2 , $organize_income , $date , $account_pair[0]["ao_help_no"] );
                                        }
                                        
                                }
                                //首次提供幫助獎金
                                $check = get_sql($con, "account_order", "WHERE a_id='".$account_pair[0]["a_id_help"]."' AND a_type=4");
                                if( !$check ){
                                    $check2 = get_sql($con, "first_time_income", "WHERE fti_least_money <= ".$account_pair[0]["ap_value"]." AND fti_most_money >= ".$account_pair[0]["ap_value"]);
                                    if( $check2 ){
                                        $a_first_income_datetime = date('Y-m-d H:i:s',strtotime("+".$check2[0]["fti_need_day"]." day"));
                                        $fn_bonus = fn_bonus( $con, "AV00300", $account_pair[0]["a_id_help"]
                                                        , (int)$check2[0]["fti_income"]
                                                        , "首次幫助金額".$account_pair[0]["ap_value"]." => 首次提供幫助獎金".$check2[0]["fti_income"]
                                                        , $date, $account_pair[0]["ao_help_no"], $a_first_income_datetime );
                                    }
                                }
                                
                                
                                //發放獎金單--
                                
                        }
                        else{
                                $data['fail']++;
                        }
                        
                }
                
                $data = "成功".$data['success']."筆，失敗".$data['fail']."筆";
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function give_organize_income( $con , $parent_a_id , $ap_value , $level , $organize_income , $date , $ao_help_no ){
        
        
        $parent = get_sql($con, "account as child JOIN account as parent on child.a_parent = parent.a_id AND child.a_parent !=''"
                                    , "WHERE child.a_id='".$parent_a_id."'"
                                    , "parent.a_id,parent.a_manager" );
        if( $parent && $parent[0]["a_manager"] === "true" ){
                
                if( $organize_income && isset( $organize_income[$level-1] ) ){
                        $o_income = (DOUBLE)$organize_income[$level-1]["o_income"];
                        fn_bonus( $con, "AV00200", $parent[0]["a_id"]
                            , (int)$ap_value*$o_income
                            , "下線會員的幫助金額".$ap_value."*".$organize_income[$level-1]["o_name"]."組織獎金%數".$o_income
                            , $date, $ao_help_no );
                        give_organize_income( $con , $parent[0]["a_id"] , $ap_value , $level+1 , $organize_income , $date , $ao_help_no );
                }
                
        }
        
}

function pause_member(){
        $callback = array();
        try{
                if( check_empty( array( "token","ap_id" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $ap_id = $_REQUEST[ "ap_id" ];
                    date_default_timezone_set('Asia/Taipei');
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];

                    $check = check_admin($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    $data = array( "success" => 0 , "fail" => 0 );
                    foreach ($ap_id as $k => $v) {

                            $update_json = array();
                            $account_pair = get_sql($con, "`account_pair` `ap`"
                                                . " join `account_order` `ao` on ap.a_no_ask=ao.a_no"
                                                , "WHERE ap.ap_id='$v'");

                            if( !$account_pair ){
                                    $data['fail']++;
                                    continue;
                            }
                            if( $account_pair[0]["ap_confirm"] === "1" || $account_pair[0]["ap_confirm"] === "2" || $account_pair[0]["ap_confirm"] === "5" ){
                                    $data['fail']++;
                                    continue;
                            }
                            $diff = abs(strtotime("now") - strtotime($account_pair[0]["a_time"]));
                            if( $diff <= (60*60*24) ){
                                    //匯款時間未過期
                                    $data['fail']++;
                                    continue;
                            }
                            
                            $table_json = array( "account as a" , "account_pair as ap", "account_order as help" , "account_order as ask" );
                            $update_json_for_multi = array( array( "a.a_state" => "blockade" ) , array( "ap.ap_confirm" => 5 ) , array( "help.a_state" => 1 ) , array( "ask.a_state" => 6 ) );
                            $key_json_for_multi = array( array( "a.a_id" => $account_pair[0]["a_id_help"] ) , array( "ap.ap_id" => $account_pair[0]["ap_id"] ) , array( "help.a_no" => $account_pair[0]["a_no_help"] ) , array( "ask.a_no" => $account_pair[0]["a_no_ask"] ) );
                            
//                            mysqli_begin_transaction($con);
//                            
//                            mysqli_commit($con);
                            
                            if( !update_multi_sql( $con , $table_json , $update_json_for_multi , $key_json_for_multi ) ){
                                    $data['fail']++;
                                    continue;
                            }
                            
                            $sql = "INSERT INTO account_pair_cancel (ap_id, a_id_help, a_no_help, a_id_ask, a_no_ask, ap_value, a_time, ap_photo, ap_transfer_time, ap_remark, ap_confirm, ap_confirm_time, apc_time, apc_ip, apc_reason)"
                            . " SELECT ap_id, a_id_help, a_no_help, a_id_ask, a_no_ask, ap_value, a_time, ap_photo, ap_transfer_time, ap_remark, ap_confirm, ap_confirm_time, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."',5 FROM account_pair WHERE ap_id=$v";

                            if( !mysqli_query($con, $sql) ){
                                    $data['fail']++;
                                    continue;
                            }
                            if( !mysqli_query($con, "DELETE FROM account_pair WHERE ap_id=$v") ){
                                    $data['fail']++;
                                    continue;
                            }
                            $data['success']++;
                            //新增封鎖紀錄
                            insert_sql($con, "account_pause_history"
                                           , array( "aph_a_id" => $account_pair[0]["a_id_help"]
                                                  , "aph_ap_id" => $account_pair[0]["ap_id"]
                                                  , "aph_datetime" => date('Y-m-d H:i:s') ));
                            
                    }

                    $data = "成功".$data['success']."筆，失敗".$data['fail']."筆";
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

function cancel_pair(){
        $callback = array();
        try{
                if( check_empty( array( "token","ap_id" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $ap_id = $_REQUEST[ "ap_id" ];
                    date_default_timezone_set('Asia/Taipei');
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];

                    $check = check_admin($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    $data = array( "success" => 0 , "fail" => 0 );
                    foreach ($ap_id as $k => $v) {

                            $update_json = array();
                            $account_pair = get_sql($con, "`account_pair` `ap`"
                                                . " join `account_order` `ao` on ap.a_no_ask=ao.a_no"
                                                , "WHERE ap.ap_id='$v'");

                            if( !$account_pair ){
                                    $data['fail']++;
                                    continue;
                            }
                            if( $account_pair[0]["ap_confirm"] !== "0" ){
                                    $data['fail']++;
                                    continue;
                            }
                            
                            $table_json = array( "account_order as help" , "account_order as ask" );
                            $update_json_for_multi = array( array( "help.a_state" => 1 ) , array( "ask.a_state" => 6 ) );
                            $key_json_for_multi = array( array( "help.a_no" => $account_pair[0]["a_no_help"] ) , array( "ask.a_no" => $account_pair[0]["a_no_ask"] ) );
                            
                            if( !update_multi_sql( $con , $table_json , $update_json_for_multi , $key_json_for_multi ) ){
                                    $data['fail']++;
                                    continue;
                            }
                            
                            $sql = "INSERT INTO account_pair_cancel (ap_id, a_id_help, a_no_help, a_id_ask, a_no_ask, ap_value, a_time, ap_photo, ap_transfer_time, ap_remark, ap_confirm, ap_confirm_time, apc_time, apc_ip)"
                                    . " SELECT ap_id, a_id_help, a_no_help, a_id_ask, a_no_ask, ap_value, a_time, ap_photo, ap_transfer_time, ap_remark, ap_confirm, ap_confirm_time, '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."' FROM account_pair WHERE ap_id=$v";
                            
                            if( !mysqli_query($con, $sql) ){
                                    $data['fail']++;
                                    continue;
                            }
                            if( !mysqli_query($con, "DELETE FROM account_pair WHERE ap_id=$v") ){
                                    $data['fail']++;
                                    continue;
                            }
                            
                            $data['success']++;
                            
                            //刪除資料夾搬移 雖然是空的
                            $filepath_from = pair_path.$v;
                            $filepath_to = delete_pair_path.$v;
                            if( file_exists( $filepath_from ) ) {
                                    recurse_copy( $filepath_from , $filepath_to );
//                                    if( file_exists( $filepath_to ) ) {}
//                                    else{}
                            }
                            
                    }

                    $data = "成功".$data['success']."筆，失敗".$data['fail']."筆";
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

function support_back_day(){
        $callback = array();
        try{
                if( check_empty( array( "token","ap_id" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $ap_id = $_REQUEST[ "ap_id" ];
                    date_default_timezone_set('Asia/Taipei');
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];

                    $check = check_admin($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    $data = array( "success" => 0 , "fail" => 0 );
                    foreach ($ap_id as $k => $v) {

                            $update_json = array();
                            $account_pair = get_sql($con, "`account_pair`"
                                                , "WHERE ap_id='$v'");
                            
                            if( !$account_pair ){
                                    $data['fail']++;
                                    continue;
                            }
                            
                            $sql = "UPDATE account_pair SET a_time=DATE_SUB(a_time,INTERVAL 1 DAY),ap_transfer_time=DATE_SUB(ap_transfer_time,INTERVAL 1 DAY) WHERE ap_id=$v";
                            if ( mysqli_query($con, $sql) ) {
                                $data['success']++;
                            } else {
                                $data['fail']++;
                            }
                            
                    }

                    $data = "成功".$data['success']."筆，失敗".$data['fail']."筆";
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

function get_can_be_change_helped(){
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    date_default_timezone_set('Asia/Taipei');
                    $date = date('Y-m-d H:i:s');
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];

                    $check = check_login($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    
                    $account_order = get_sql($con, "account_order", "WHERE a_id='".$account["a_id"]."' AND a_state=5.1 AND ( a_type!=4 OR a_first_income_datetime <= '$date' )", "*");
                    
                    $data = $account_order ? $account_order : array();
                    
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

function get_income_history()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","start_date","end_date" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $start_date = $_REQUEST[ "start_date" ];
                $end_date = $_REQUEST[ "end_date" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $type_cond = "CASE WHEN ao.a_type=2 THEN '直推獎金'"
                                . " WHEN ao.a_type=3 THEN '組織獎金'"
                                . " WHEN ao.a_type=4 THEN '首次幫助獎金'"
                                . " ELSE '利息' END";
                $value_cond = "CASE WHEN ao.a_type IN (2,3,4) THEN ao.a_principle+ao.a_interest"
                                . " WHEN ao.a_type IN (0,1) THEN ao.a_interest"
                                . " ELSE 0 END";
                $description_cond = "CASE WHEN ao.a_type=2 THEN CONCAT('下線完成訂單【',ab.a_source_a_no,'】 之直推獎金<em>',ab.a_detail_des,'</em>')"
                                . " WHEN ao.a_type=3 THEN CONCAT('下線完成訂單【',ab.a_source_a_no,'】 之組織獎金<em>',ab.a_detail_des,'</em>')"
                                . " WHEN ao.a_type=4 THEN CONCAT('完成訂單【',ab.a_source_a_no,'】 之首次幫助獎金<em>',ab.a_detail_des,'</em>')"
                                . " ELSE CONCAT('援助【',ap.a_no_ask,'】 利息') END";
                
                $account_order = get_sql_array_for_datatable($con, "account_order ao"
                                                        . " LEFT JOIN account_bonus ab on ao.a_bonus_id=ab.a_bonus_id"
                                                        . " LEFT JOIN account_pair ap on ao.a_no=ap.a_no_help"
                                            , array( "a_start" , "type" , "value" , "a_start" , "description" )
                                            , "WHERE ao.a_id='".$account["a_id"]."' AND ao.a_start between '$start_date 00:00:00' and '$end_date 23:59:59' AND ( ao.a_type IN (2,3,4) OR ( ao.a_type IN (0,1) AND ao.a_interest!=0 ) ) ORDER BY ao.a_start DESC"
                                            , "*,($type_cond) as type,($value_cond) as value,($description_cond) as description");
                if( $account_order ){
                    $data = $account_order;
                }
                else{
                    $data = array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_income_history_by_admin()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","start_date","end_date" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $start_date = $_REQUEST[ "start_date" ];
                $end_date = $_REQUEST[ "end_date" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_admin($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $type_cond = "CASE WHEN ao.a_type=2 THEN '直推獎金'"
                                . " WHEN ao.a_type=3 THEN '組織獎金'"
                                . " WHEN ao.a_type=4 THEN '首次幫助獎金'"
                                . " ELSE '不明' END";
                $description_cond = "CASE WHEN ao.a_type=2 THEN CONCAT('下線完成訂單【',ab.a_source_a_no,'】 之直推獎金<em>',ab.a_detail_des,'</em>')"
                                . " WHEN ao.a_type=3 THEN CONCAT('下線完成訂單【',ab.a_source_a_no,'】 之組織獎金<em>',ab.a_detail_des,'</em>')"
                                . " WHEN ao.a_type=4 THEN CONCAT('完成訂單【',ab.a_source_a_no,'】 之首次幫助獎金<em>',ab.a_detail_des,'</em>')"
                                . " ELSE '不明' END";
                
                $account_order = get_sql_array_for_datatable($con, "account_order ao"
                                                        . " JOIN account a on ao.a_id=a.a_id"
                                                        . " LEFT JOIN account_bonus ab on ao.a_bonus_id=ab.a_bonus_id"
                                            , array( "a_no" , "a_email" , "type" , "value" , "a_start" , "description" )
                                            , "WHERE ao.a_start between '$start_date 00:00:00' and '$end_date 23:59:59' AND ao.a_type IN (2,3,4) ORDER BY ao.a_start DESC"
                                            , "*,($type_cond) as type,(ao.a_principle+ao.a_interest) as value,($description_cond) as description");
                if( $account_order ){
                    $data = $account_order;
                }
                else{
                    $data = array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_interest_history_by_admin()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","start_date","end_date" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $start_date = $_REQUEST[ "start_date" ];
                $end_date = $_REQUEST[ "end_date" ];
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_admin($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $account_order = get_sql_array_for_datatable($con, "account_order ao"
                                                        . " JOIN account a on ao.a_id=a.a_id"
                                                        . " LEFT JOIN account_pair ap on ao.a_no=ap.a_no_help"
                                            , array( "a_no" , "a_email" , "type" , "a_principle", "a_interest" , "a_start" , "description" )
                                            , "WHERE ao.a_start between '$start_date 00:00:00' and '$end_date 23:59:59' AND ao.a_type IN (0,1) AND ao.a_interest!=0 ORDER BY ao.a_start DESC"
                                            , "*,'利息' as type,CONCAT('援助【',ap.a_no_ask,'】 利息') as description");
                if( $account_order ){
                    $data = $account_order;
                }
                else{
                    $data = array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_need_process_help_helped()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $data = array( "help" => "" , "helped" => "" );
                $token = md5( $_REQUEST[ "token" ] );
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
//                $operation_html = isset($_REQUEST[ "operation_html" ]) ? mysqli_real_escape_string($con,$_REQUEST[ "operation_html" ]) : "";
                
                $state_cond = "CASE WHEN ap.ap_confirm=0 OR ap.ap_confirm=5 THEN '未付款'"
                          . " WHEN ap.ap_confirm=1 THEN '未確認'"
                          . " WHEN ap.ap_confirm=2 THEN '已確認'"
                          . " ELSE '未配對' END";
                $transfer_cond = "CASE WHEN ap.ap_confirm=0 OR ap.ap_confirm=5 THEN '尚未匯款'"
                          . " WHEN ap.ap_transfer_time!='0000-00-00 00:00:00' THEN date_format(ap.ap_transfer_time,'%Y/%m/%d %H:%i')"
                          . " ELSE '' END";
                $dead_time_cond = "CASE WHEN ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) < 24 THEN CONCAT( date_format(DATE_ADD(ap.a_time, INTERVAL 1 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"undone\">匯款剩餘時間',24-HOUR(TIMEDIFF(NOW(),  ap.a_time)) ,'小時</em>')"
                          . " WHEN ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) < 48 THEN CONCAT( date_format(DATE_ADD(ap.ap_transfer_time, INTERVAL 2 DAY),'%Y/%m/%d %H:%i') ,'<em class=\"undone\">確認剩餘時間',48-HOUR(TIMEDIFF(NOW(),  ap.ap_transfer_time)) ,'小時</em>')"
                          . " ELSE '' END";
                
                $account_order = get_sql_array_for_datatable($con, "account_order `ao`"
                                                        . " JOIN account_pair `ap` on ao.a_no=ap.a_no_help AND ( (ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) < 24) OR (ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) < 48) )"
                                                        . " LEFT JOIN account `a` on a.a_id=ap.a_id_ask"
                                                        . " LEFT JOIN account_pair_msg `apm` on apm.ap_id=ap.ap_id"
//                                                        . " LEFT JOIN (SELECT COUNT(*),ap_id FROM account_pair_msg GROUP BY ap_id) `apm` on apm.ap_id=ap.ap_id"
                                            , array( "ap_id" , "a_no" , "helped_person" , "state" , "a_principle" , "a_time" , "transfer_time" , "a_dead_time" , "opera1" , "opera2" )
                                            , "WHERE ao.a_id='".$account["a_id"]."' AND ao.a_state<6 GROUP BY ao.a_no ORDER BY ao.a_start DESC limit 2"
                                            , "*,ap.ap_id 'ap_id',COALESCE(a.a_nickname,'') 'helped_person',($state_cond) 'state',ao.a_principle 'a_principle',COALESCE(date_format(ap.a_time,'%Y/%m/%d %H:%i'),'') 'a_time',($transfer_cond) 'transfer_time',($dead_time_cond) as 'a_dead_time','<a href=\"#\" class=\"detail\">詳細資料</a>' as opera1,CONCAT('<a href=\"#\" class=\"mark msg_box\">訊息(<strong>',COALESCE(COUNT(apm.apm_id),0),'</strong>)</a>') as opera2");
                
                $data["help"] = $account_order ? $account_order : array();
                
                $account_order = get_sql_array_for_datatable($con, "account_order `ao`"
                                                        . " JOIN account_pair `ap` on ao.a_no=ap.a_no_ask AND ( (ap.ap_confirm=0 AND HOUR(TIMEDIFF(NOW(),ap.a_time)) < 24) OR (ap.ap_confirm=1 AND HOUR(TIMEDIFF(NOW(),ap.ap_transfer_time)) < 48) )"
                                                        . " LEFT JOIN account `a` on a.a_id=ap.a_id_help"
                                                        . " LEFT JOIN account_pair_msg `apm` on apm.ap_id=ap.ap_id"
//                                                        . " LEFT JOIN (SELECT COUNT(*),ap_id FROM account_pair_msg GROUP BY ap_id) `apm` on apm.ap_id=ap.ap_id"
                                            , array( "ap_id" , "a_no" , "help_person" , "state" , "a_value" , "a_time" , "transfer_time" , "a_dead_time" , "opera1" , "opera2" )
                                            , "WHERE ao.a_id='".$account["a_id"]."' AND ao.a_state>=6 GROUP BY ao.a_no  ORDER BY ao.a_start DESC limit 2"
                                            , "*,ap.ap_id 'ap_id',COALESCE(a.a_nickname,'') 'help_person',($state_cond) 'state',ao.a_principle+ao.a_interest 'a_value',COALESCE(date_format(ap.a_time,'%Y/%m/%d %H:%i'),'') 'a_time',($transfer_cond) 'transfer_time',($dead_time_cond) as 'a_dead_time','<a href=\"#\" class=\"detail\">詳細資料</a>' as opera1,CONCAT('<a href=\"#\" class=\"mark msg_box\">訊息(<strong>',COALESCE(COUNT(apm.apm_id),0),'</strong>)</a>') as opera2");
                
                $data["helped"] = $account_order ? $account_order : array();
                
                $callback['data'] = $data;
                $callback['success'] = true;
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
