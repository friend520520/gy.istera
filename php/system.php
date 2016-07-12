<?php

include 'config.php';
include 'global.php';
include 'sample/check_login.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "set_value":
        $echo = set_value();
        break;
    case "get_system_para":
        $echo = get_system_para();
        break;
    case "get_pepay_para":
        $echo = get_pepay_para();
        break;
    case "put_pepay_SysTrustCode":
        $echo = put_pepay_SysTrustCode();
        break;
    case "put_pepay_ShopTrustCode":
        $echo = put_pepay_ShopTrustCode();
        break;
}

echo json_encode($echo);

function set_value(){
        $callback = array();
        try{
                if( check_empty( array( "token" , "direct_organize_interest" , "direct_organize_max_interest"
                                        , "direct_push_income" , "help_interest" , "help_interest_time" , "money_upper_limit" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $direct_organize_interest = $_REQUEST["direct_organize_interest"];
                    $direct_organize_max_interest = $_REQUEST["direct_organize_max_interest"];
                    $direct_push_income = $_REQUEST["direct_push_income"];
                    $help_interest = $_REQUEST["help_interest"];
                    $help_interest_time = $_REQUEST["help_interest_time"];
                    $money_upper_limit = $_REQUEST["money_upper_limit"];
                    
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
                    
                    $json = array();
                    $json[ "s_direct_organize_interest" ] = $direct_organize_interest;
                    $json[ "s_direct_organize_max_interest" ] = $direct_organize_max_interest;
                    $json[ "s_direct_push_income" ] = $direct_push_income;
                    $json[ "s_help_interest" ] = $help_interest;
                    $json[ "s_help_interest_time" ] = $help_interest_time.":00";
                    $json[ "s_money_upper_limit" ] = $money_upper_limit;
                    
                    if( update_sql($con,"system", $json, array( "s_id" => 1 )) ){
                            $callback['success'] = true;
                    }
                    else{
                            $callback['msg'] = "設定失敗";
                            $callback['success'] = false;
                    }
                    
                    
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "輸入資料不完整";
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

function get_system_para(){
        $callback = array();
        try{
                if( check_empty( array( "token","part" ) ) ) {
//                    ,"part"
                    $part = $_REQUEST[ "part" ];
                    $data = array();
                    
                    if( !in_array($part, array("income","limit")) ){
                            $callback['msg'] = "輸入資料不完整";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];
                    
                    $Check_Admin = Check_Admin( $con );
                    if( !$Check_Admin["success"] ){
                            return $Check_Admin;
                    }
                    $account = $Check_Admin["data"];
                    
                    $system = get_sql( $con , "system" ,"WHERE s_id = 1");
                    if( !$system ){
                            $callback['msg'] = "讀取資料失敗";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    
                    if( $part === "limit" ){
                            $data = array( "s_common_login_num" => $system[0]["s_common_login_num"] ,
                                            "s_admin_login_num" => $system[0]["s_admin_login_num"] );
                    }
                    else if( $part === "income" ){
                    
                            $organize_income = get_sql( $con , "organize_income" , "ORDER BY o_id");
                            if( !$organize_income ){
                                    $callback['msg'] = "讀取資料失敗";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }

                            $first_time_income = get_sql( $con , "first_time_income" , "ORDER BY fti_id");
                            if( !$first_time_income ){
                                    $callback['msg'] = "讀取資料失敗";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $data = array( "s_help_interest_time" => $system[0]["s_help_interest_time"] ,
                                            "s_help_interest" => $system[0]["s_help_interest"] ,
                                            "s_direct_push_income" => $system[0]["s_direct_push_income"] ,
                                            "s_direct_organize_interest" => $system[0]["s_direct_organize_interest"] ,
                                            "s_direct_organize_max_interest" => $system[0]["s_direct_organize_max_interest"] ,
                                            "s_money_upper_limit" => $system[0]["s_money_upper_limit"] ,
                                            "organize_income" => $organize_income ,
                                            "first_time_income" => $first_time_income );
                    }
                    
                    $callback['data'] = $data;
                    $callback['success'] = true;
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "輸入資料不完整";
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

function get_pepay_para(){
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
                    
                    $system = get_sql( $con , "pepay_trust_code" ,"WHERE pts_id = 1");
                    
                    if( $system ){
                            $callback['data'] = array( "pts_cSysTrustCode" => $system[0]["pts_cSysTrustCode"] ,
                                                       "pts_cSysTrustCode_original" => $system[0]["pts_cSysTrustCode_original"] ,
                                                       "pts_cShopTrustCode" => $system[0]["pts_cShopTrustCode"] ,
                                                       "pts_cShopTrustCode_original" => $system[0]["pts_cShopTrustCode_original"]);
                            $callback['success'] = true;
                    }
                    else {
                            $callback['data'] = array();
                            $callback['success'] = true;
                    }
                    
                             
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "輸入資料不完整";
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

function put_pepay_SysTrustCode(){
    try{
            $callback = array();
            $content_arr = array();
            $i = 0;

            if( !check_empty( array( "SysTrustCode" , "token" ) ) ){
                    $callback['msg'] = "輸入資料不完整";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return;
            }

            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");
            date_default_timezone_set('Asia/Taipei');

            if (mysqli_connect_errno()) {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return;
            }

            $SysTrustCode = mysqli_real_escape_string($con,$_REQUEST[ 'SysTrustCode' ]);
            $token = md5($_REQUEST[ 'token' ]);

            $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
            if( !$account ) {
                    $callback['msg'] = "Login fail";
                    $callback['success'] = false;
                    mysqli_close($con);
                    echo json_encode($callback);
                    return;
            }
            if( $account[0]['a_admin'] !== "true" ){
                    $callback['msg'] = "you dont have admin";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }

            $sql = "UPDATE pepay_trust_code SET pts_cSysTrustCode='$SysTrustCode' WHERE pts_id=1";
            if( mysqli_query($con, $sql) ) {
                    $callback['data'] = $SysTrustCode;
                    $callback['success'] = true;
            }
            else {
                    $callback['msg'] = "UPDATE fail";
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

function put_pepay_ShopTrustCode(){
    try{
            $callback = array();
            $content_arr = array();
            $i = 0;

            if( !check_empty( array( "ShopTrustCode" , "token" ) ) ){
                    $callback['msg'] = "輸入資料不完整";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return;
            }

            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");
            date_default_timezone_set('Asia/Taipei');

            if (mysqli_connect_errno()) {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return;
            }

            $ShopTrustCode = mysqli_real_escape_string($con,$_REQUEST[ 'ShopTrustCode' ]);
            $token = md5($_REQUEST[ 'token' ]);

            $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
            if( !$account ) {
                    $callback['msg'] = "Login fail";
                    $callback['success'] = false;
                    mysqli_close($con);
                    echo json_encode($callback);
                    return;
            }
            if( $account[0]['a_admin'] !== "true" ){
                    $callback['msg'] = "you dont have admin";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }

            $sql = "UPDATE pepay_trust_code SET pts_cShopTrustCode='$ShopTrustCode' WHERE pts_id=1";
            if( mysqli_query($con, $sql) ) {
                    $callback['data'] = $ShopTrustCode;
                    $callback['success'] = true;
            }
            else {
                    $callback['msg'] = "UPDATE fail";
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
?>
