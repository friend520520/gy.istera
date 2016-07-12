<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';
include 'account_event.php';
include 'sample/check_login.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_income_partner":
        $echo = get_income_partner();
        break;
}

echo json_encode($echo);

function get_income_partner()
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
                date_default_timezone_set('Asia/Taipei');
                
                $day = date('w');
                $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
                $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
                
                $data = array( "income" => array()
                             , "partner" => array()
                             , "direct_income" => array()
                             , "first_income" => "");
                
                $time_arr = array( " like '".date('Y-m-d')."%'"
                                 , " between '$week_start 00:00:00' and '$week_end 23:59:59'"
                                 , " like '".date('Y-m')."%'"
                                 , "" );
                
                foreach ($time_arr as $key => $value) {
                        
                        $date_column = " and a_date";
                        $tmp_date = $key === 3 ? "" : $date_column.$value;
                        $account_bonus = get_sql($con, "account_bonus"
                                            , "WHERE a_id='".$account["a_id"]."'$tmp_date"
                                            , "COALESCE(SUM(a_value),0)");
                        $data["income"][] = $account_bonus ? $account_bonus[0]["COALESCE(SUM(a_value),0)"] : 0;
                        
                        $date_column = " and a_registration_time";
                        $tmp_date = $key === 3 ? "" : $date_column.$value;
                        $children = get_sql($con, "account"
                                            , "WHERE a_parent='".$account["a_id"]."'$tmp_date"
                                            , "COUNT(*)");
                        $data["partner"][] = $children ? $children[0]["COUNT(*)"] : 0;
                        
                        $date_column = " and a_date";
                        $tmp_date = $key === 3 ? "" : $date_column.$value;
                        $account_bonus = get_sql($con, "account_bonus"
                                            , "WHERE a_event='AV00100' AND a_id='".$account["a_id"]."'$tmp_date"
                                            , "COALESCE(SUM(a_value),0)");
                        $data["direct_income"][] = $account_bonus ? $account_bonus[0]["COALESCE(SUM(a_value),0)"] : 0;
                        
                        if( $account["a_manager"] === "true" ){
                        
                                $date_column = " and a_date";
                                $tmp_date = $key === 3 ? "" : $date_column.$value;
                                $account_bonus = get_sql($con, "account_bonus"
                                                    , "WHERE a_event='AV00200' AND a_id='".$account["a_id"]."'$tmp_date"
                                                    , "COALESCE(SUM(a_value),0)");
                                $data["organize_income"][] = $account_bonus ? $account_bonus[0]["COALESCE(SUM(a_value),0)"] : 0;
                            
                        }
                }
                
                $account_bonus = get_sql($con, "account_bonus"
                                    , "WHERE a_event='AV00300' AND a_id='".$account["a_id"]."'"
                                    , "a_value,a_date");
                $data["first_income"] = $account_bonus ? array( "a_value" => $account_bonus[0]["a_value"] , "a_date" => $account_bonus[0]["a_date"] ) : array( "a_value" => 0 , "a_date" => "" );
                
//                $fn_event = fn_event( $con, "H00001", $account["a_id"], null , $help_money[0]["hm_value"] );
//                if( !$fn_event["success"] ) {
//                        $callback['msg'] = $fn_event["msg"];
//                        $callback['success'] = false;
//                        mysqli_close($con);
//                        return $callback;
//                }
                
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
