<?php

include 'config.php';
include 'global.php';
include 'sample/check_login.php';

if (!isset($_SESSION)) { session_start(); }
$func = $_REQUEST["func"];

switch ($func) {
    case "add":
        $echo = add();
        break;
    case "loginbytoken":
        $echo = loginbytoken();
        break;
    case "logout":
        $echo = logout();
        break;
    case "login":
        $echo = login();
        break;
    case "edit_info":
        $echo = edit_info();
        break;
    case "edit_info2":
        $echo = edit_info2();
        break;
    case "edit_email":
        $echo = edit_email();
        break;
    case "edit_phone":
        $echo = edit_phone();
        break;
    case "set_limit":
        $echo = set_limit();
        break;
    case "set_limit_for":
        $echo = set_limit_for();
        break;
    case "change_pwd":
        $echo = change_pwd();
        break;
    case "change_pwd_bytoken":
        $echo = change_pwd_bytoken();
        break;
    case "send_forget":
        $echo = send_forget();
        break;
    case "check_forget_token":
        $echo = check_forget_token();
        break;
    case "authenticate":
        $echo = authenticate();
        break;
    case "send_authenticate":
        $echo = send_authenticate();
        break;
    case "pause_member":
        $echo = pause_member();
        break;
    case "get_more_info":
        $echo = get_more_info();
        break;
    
}

echo json_encode($echo);

function add(){
        
        $callback = array();
        try{
                if( check_empty( array('a_email','a_password','a_nickname','a_country','captcha','a_eighteen') ) ) {
                    
                    date_default_timezone_set('Asia/Taipei');
                    $a_email = $_REQUEST['a_email'];
                    $a_password = $_REQUEST['a_password'];
                    $a_nickname = $_REQUEST['a_nickname'];
                    $a_country = $_REQUEST['a_country'];
                    $a_eighteen = $_REQUEST['a_eighteen'];
                    $captcha = $_REQUEST['captcha'];
                    $insert_array = array();
                    
                    if( $captcha !== $_SESSION["verification__session"] ) {
                            $callback['msg'] = "認證碼錯誤錯誤";
                            $callback['success'] = false;
                            return $callback;
                    }
                    if( !in_array($a_eighteen, array("true","false")) ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    if( !in_array($a_country, array("Taiwan","Japan")) ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];
                    
                    $account = get_sql($con, "account", "WHERE a_email='$a_email'");
                    if ($account) {
                        $callback['msg'] = "email exist";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                    }
                    
                    while( 1 )
                    {
                        $id = getRandom( 10 );
                        $check = get_sql($con, "account", "WHERE a_id='$id'");
                        if (!$check) {
                                break;
                        }
                    }
                    
                    if( !file_exists(account_path.$id) ){
                        mkdir(account_path.$id, 0777, true);
                        mkdir(account_path.$id."\\Original", 0777, true);
                        mkdir(account_path.$id."\\Preview", 0777, true);
                        mkdir(account_path.$id."\\ThumbnailM", 0777, true);
                        mkdir(account_path.$id."\\ThumbnailS", 0777, true);
                    }
                    
//                    if( $a_icon !== "" ) {
//                        if( !file_exists(upload_transient_file.$a_icon) ){
//                            $callback['msg'] = "icon not exist";
//                            $callback['success'] = false;
//                            mysqli_close($con);
//                            return $callback;
//                        }
//                        $a_icon_sub = explode( "." , $a_icon );
//                        $a_icon_sub = $a_icon_sub[count($a_icon_sub)-1];
//                        if( !copy( upload_transient_file.$a_icon , account_path.$id."\\icon.".$a_icon_sub ) ){
//                            $callback['success'] = false;
//                            $callback['msg'] = "Upload icon fail";
//                            mysqli_close($con);
//                            return $callback;
//                        }
//                        $insert_array["a_icon"] = "icon." . $a_icon_sub;
//                    }
                    
                    //set token
                    while( 1 ) {
                        $token = getRandom(20);
                        $set_token = md5($token);
                        $result = mysqli_query($con, "SELECT * FROM account WHERE a_token LIKE '%\\\"$set_token\\\"%'");
                        if (mysqli_num_rows($result) == 0) {break;}
                    }
                    $set_token = array( array( "token" => $set_token , "time" => strtotime("+1 month") ) );
                    $set_token = json_encode( $set_token );
                    $insert_array['a_token'] = $set_token;
                    
                    
                    $insert_array['a_id'] = $id;
                    $insert_array['a_registration_time'] = date('Y-m-d H:i:s');
                    $insert_array['a_admin'] = "false";
                    $insert_array['a_state'] = "block";
                    
                    $insert_array['a_email'] = $a_email;
                    $insert_array['a_nickname'] = $a_nickname;
                    $insert_array['a_country'] = $a_country;
                    $insert_array['a_eighteen'] = $a_eighteen;
                    //$insert_array['phone_captcha'] = $phone_captcha;
                    $insert_array['a_password'] = $a_password;
                    
                    if( check_empty("a_id") ){
                        $parent = get_sql($con, "account", "WHERE a_id='".$_REQUEST["a_id"]."'");
                        if( $parent ){
                                $insert_array["a_parent"] = $parent[0]["a_id"];
                        }
                    }
                    
                    
                    $callback = send_authenticate_letter( $con , $a_email , $a_nickname );
                    
                    if( !$callback['success'] ){
                        mysqli_close($con);
                        return $callback;
                    }
                    $insert_array["a_email_confirm"] = $callback["a_email_confirm"];
                    
                    if( insert_sql($con, "account", $insert_array) ) {
                        $callback['data'] = $token;
                        $callback['success'] = true;
                    }
                    else {
                        $callback['success'] = false;
                        $callback['msg'] = "add fail";
                    }
                    
                    mysqli_close($con);

                }
                else {
                    
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    
                }
                return $callback;
                
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

function loginbytoken(){
        
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            echo json_encode($DB_CON);
                            return;
                    }
                    $con = $DB_CON["data"];
                    $cart = array();
                    
                    $check = check_login($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    date_default_timezone_set('Asia/Taipei');
                    
                    if( $account["a_state"] === "block" ){
                            
                            $authenticate = $account["a_email_confirm"] === "1" ? true : false;
                            $cart = array( "a_id" => $account["a_id"] , 
                                "a_admin" => $account["a_admin"] , 
                                "a_manager" => $account["a_manager"] ,
                                "a_email" => $account["a_email"] ,
                                "a_nickname" => $account["a_nickname"] ,
                                "a_country" => $account["a_country"] ,
                                "a_phone" => $account["a_phone"] ,
                                "a_skype" => $account["a_skype"] ,
                                "a_limit_token" => $account["a_limit_token"] , 
                                "a_last_login_time" => $account["a_last_login_time"] , 
                                "a_lastlogin_ip" => $account["a_lastlogin_ip"] , 
                                "authenticate" => $authenticate );

                            $callback['data'] = $cart;
                            $callback['success'] = true;
                            
                            $_SESSION["help_member_info"] = json_encode($account);
                            
                    }
                    else if( $account["a_state"] === "blockade" ){

                            $callback['msg'] = "帳號被停權，無法登入。";
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

function logout(){
    
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                    
                    $token = md5( $_REQUEST['token'] );
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];
                    
                    $check = check_login($con);
                    
                    unset($_SESSION["help_token"]);
                    unset($_SESSION["help_member_info"]);
                    
                    if( $check["success"] ) {
                        
                        $account = $check["data"];
                        $user_rememberme_token = $account['a_token'];
                        $user_rememberme_token = json_decode( $user_rememberme_token , true );
//                        echo $user_rememberme_token;
//                        print_r($user_rememberme_token);
                        foreach ($user_rememberme_token as $key => $value) {
                            if( $value["token"] === $token ) {
                                array_splice($user_rememberme_token, $key, 1);
                                break;
                            }
                        }
//                        print_r($user_rememberme_token);
                        $user_rememberme_token = json_encode( $user_rememberme_token );

                        $cmd = "UPDATE account SET a_token='$user_rememberme_token' WHERE a_id='" . $account["a_id"] . "'";
                        if( mysqli_query( $con , $cmd ) ) {

                                $callback['success'] = true;

                        }
                        else {
                                $callback['msg'] = "delete token error";
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

function login(){
        
        $callback = array();
        try{
                if( check_empty( array( "account" , "password" , "authentication" , "login_time" ) ) ) {
                    
                    date_default_timezone_set('Asia/Taipei');
                    $email = $_REQUEST["account"];
                    $password = $_REQUEST["password"];
                    $authentication = $_REQUEST["authentication"];
                    $login_time = $_REQUEST["login_time"];
                    
                    if( $authentication !== $_SESSION["verification__session"] ) {
                            $callback['msg'] = "認證碼錯誤錯誤";
                            $callback['success'] = false;
                            return $callback;
                    }
                    if( !in_array($login_time, array("one_hour","one_day","one_week","two_week","one_month")) ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    switch ($login_time) {
                        case "one_hour":
                            $set_time = strtotime("+1 hour");
                            break;
                        case "one_day":
                            $set_time = strtotime("+1 day");
                            break;
                        case "one_week":
                            $set_time = strtotime("+1 week");
                            break;
                        case "two_week":
                            $set_time = strtotime("+1 week");
                            break;
                        case "one_month":
                            $set_time = strtotime("+1 month");
                            break;
                    }
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];
                    
                    $account = get_sql($con, "account", "WHERE a_email='$email' AND a_password='$password'");
                    if (!$account) {
                            $callback['msg'] = "帳號密碼錯誤";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    if( $account[0]["a_state"] === "block" ){
                            
                            $callback = set_random_token( $con , $account[0] , $set_time );
                            
                    }
                    else if( $account[0]["a_state"] === "blockade" ){

                            $callback['msg'] = "帳號被停權，無法登入。";
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

function edit_info(){
        $callback = array();
        try{
                if( check_empty( array( "token" ,
                                        "a_nickname" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $a_nickname = $_REQUEST["a_nickname"];
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
                    
                    $update_json["a_nickname"] = $a_nickname;
                    
                    if (update_sql( $con , "account" , $update_json , array( "a_id" => $account["a_id"] ) )) {
                        $callback['success'] = true;
                        //update session++
                        $help_member_info = json_decode( $_SESSION["help_member_info"] , true );
                        $help_member_info["a_nickname"] = $update_json["a_nickname"];
                        $_SESSION["help_member_info"] = json_encode( $help_member_info );
                        //update session--
                    }
                    else {
                        $callback['msg'] = "update fail";
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

function edit_info2(){
        $callback = array();
        try{
                if( check_empty( array( "token" ,
                                        "a_payment_account" , 
                                        "a_payment_account_name" , 
                                        "a_payment_bank" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $a_payment_account = $_REQUEST["a_payment_account"];
                    $a_payment_account_name = $_REQUEST["a_payment_account_name"];
                    $a_payment_bank = $_REQUEST["a_payment_bank"];
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
                    
                    $update_json["a_payment_account"] = $a_payment_account;
                    $update_json["a_payment_account_name"] = $a_payment_account_name;
                    $update_json["a_payment_bank"] = $a_payment_bank;
                    
                    if (update_sql( $con , "account" , $update_json , array( "a_id" => $account["a_id"] ) )) {
                        $callback['success'] = true;
                        //update session++
                        $help_member_info = json_decode( $_SESSION["help_member_info"] , true );
                        $help_member_info["a_payment_account"] = $a_payment_account;
                        $help_member_info["a_payment_account_name"] = $a_payment_account_name;
                        $help_member_info["a_payment_bank"] = $a_payment_bank;
                        $_SESSION["help_member_info"] = json_encode( $help_member_info );
                        //update session--
                    }
                    else {
                        $callback['msg'] = "update fail";
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

function edit_email(){
        $callback = array();
        try{
                if( check_empty( array( "token" ,
                                        "a_email" , 
                                        "a_password" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $a_email = $_REQUEST["a_email"];
                    $a_password = $_REQUEST["a_password"];
                    $update_json = array();
                    
                    $DB_CON = DB_CON( DB_NAME );
                    if( !$DB_CON["success"] ){
                            return $DB_CON;
                    }
                    $con = $DB_CON["data"];
                    
                    $account = get_sql($con, "account", "WHERE a_password = '$a_password' AND a_token like '%\\\"$token\\\"%'");
                    if( !$account ){
                            $callback['msg'] = "密碼失敗";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $account[0];
                    
                    $a_email_confirm = $account["a_email_confirm"] === "1" ? true : false;
                    if( $account["a_email"] !== $a_email ) {
                            if( get_sql($con, "account", "WHERE a_email='$a_email'") ){
                                    $callback['msg'] = "信箱已有人使用";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $callback = send_authenticate_letter( $con , $a_email , $account["a_nickname"] );
                            if( !$callback['success'] ){
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $update_json["a_email_confirm"] = $callback["a_email_confirm"];
                            $a_email_confirm = false;
                    }
                    
                    $update_json["a_email"] = $a_email;
                    
                    if (update_sql( $con , "account" , $update_json , array( "a_id" => $account["a_id"] ) )) {
                        $callback["data"] = array( "a_email_confirm" => $a_email_confirm , "a_email" => $a_email );
                        $callback['success'] = true;
                        //update session++
                        $help_member_info = json_decode( $_SESSION["help_member_info"] , true );
                        $help_member_info["a_email_confirm"] = $a_email_confirm;
                        $help_member_info["a_email"] = $update_json["a_email"];
                        $_SESSION["help_member_info"] = json_encode( $help_member_info );
                        //update session--
                    }
                    else {
                        $callback['msg'] = "update fail";
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

function edit_phone(){
        $callback = array();
        try{
                if( check_empty( array( "token" ,
                                        "phone_captcha" ) ) ) {
                    
                    date_default_timezone_set('Asia/Taipei');
                    $token = md5( $_REQUEST[ "token" ] );
                    $phone_captcha = $_REQUEST["phone_captcha"];
                    $update_json = array();
                    $date = strtotime( date('Y-m-d H:i:s') );
                    
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
                    
                    if( $account["a_phone_confirm"] !== $phone_captcha ){
                            $callback['msg'] = "認證碼錯誤";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    if( $date >= strtotime( $account["a_phone_send_time"]." +30 minute" ) ){
                            $callback['msg'] = "認證碼時間到期，請重新寄送";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $sql = "UPDATE `account` SET a_phone=a_phone_tmp,a_phone_confirm='1',a_phone_tmp='' WHERE a_id='".$account["a_id"]."'";
                    if ( mysqli_query($con, $sql) ) {
                        $callback['data'] = $account["a_phone_tmp"];
                        $callback['success'] = true;
                        //update session++
                        $help_member_info = json_decode( $_SESSION["help_member_info"] , true );
                        $help_member_info["a_phone"] = $account["a_phone_tmp"];
                        $_SESSION["help_member_info"] = json_encode( $help_member_info );
                        //update session--
                    } else {
                        $callback['msg'] = "修改失敗";
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

function set_limit(){
        $callback = array();
        try{
                if( check_empty( array( "token" ,
                                        "a_limit" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $a_limit = $_REQUEST["a_limit"];
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $check = check_login($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    if( $account['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $update_json = array();
                    $update_json["a_limit_token"] = $a_limit;
                    
                    if (update_sql( $con , "account" , $update_json , array( "a_id" => $account["a_id"] ) )) {
                        $callback['success'] = true;
                        //update session++
                        $help_member_info = json_decode( $_SESSION["help_member_info"] , true );
                        $help_member_info["a_limit_token"] = $update_json["a_limit_token"];
                        $_SESSION["help_member_info"] = json_encode( $help_member_info );
                        //update session--
                    }
                    else {
                        $callback['msg'] = "update fail";
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

function set_limit_for(){
        $callback = array();
        try{
                if( check_empty( array( "token" , "a_limit" , "to" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $a_limit = $_REQUEST["a_limit"];
                    $to = $_REQUEST["to"];
                    
                    if( (int)$a_limit <= 0 ){
                            $callback['msg'] = "人數設定錯誤";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    if( !in_array($to, array("common","admin")) ){
                            $callback['msg'] = "輸入資料不完整";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
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
                    
                    $a_admin = $to === "common" ? "false" : "true";
                    $system_column = $to === "common" ? "s_common_login_num" : "s_admin_login_num";
                    $update_json = array();
                    $update_json["a_limit_token"] = (int)$a_limit;
                    $update_json2 = array();
                    $update_json2[$system_column] = (int)$a_limit;
                    
                    
                    if (update_2table_sql($con, "account", $update_json, array( "a_admin" => $a_admin ), "system", $update_json2, array( "s_id" => 1 ))) {
                        $callback['success'] = true;
                    }
                    else {
                        $callback['msg'] = "update fail";
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

function change_pwd(){
        $callback = array();
        try{
                if( check_empty( array( "token" ,
                                        "account_oldpassword" , 
                                        "account_newpassword" ,
                                        "a_bitcoin_address" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $account_oldpassword = $_REQUEST["account_oldpassword"];
                    $account_newpassword = $_REQUEST["account_newpassword"];
                    $a_bitcoin_address = $_REQUEST["a_bitcoin_address"];
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $check = check_login($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    if( $account_oldpassword === $account_newpassword ) {
                            $callback['msg'] = "舊密碼與新密碼相同";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    if( $account["a_password"] !== $account_oldpassword ) {
                            $callback['msg'] = "舊密碼錯誤";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $update_json = array();
                    $update_json["a_password"] = $account_newpassword;
                    $update_json["a_token"] = "[]";
                    $update_json["a_bitcoin_address"] = $a_bitcoin_address;
                    
                    if (update_sql( $con , "account" , $update_json , array( "a_id" => $account["a_id"] ) )) {
                        $callback['success'] = true;
                        //update session++
                        $help_member_info = json_decode( $_SESSION["help_member_info"] , true );
                        $help_member_info["a_password"] = $update_json["a_password"];
                        $help_member_info["a_token"] = $update_json["a_token"];
                        $_SESSION["help_member_info"] = json_encode( $help_member_info );
                        //update session--
                    }
                    else {
                        $callback['msg'] = "update fail";
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

function change_pwd_bytoken(){
        $callback = array();
        try{
                if( check_empty( array( "token" , "password" ) ) ) {
                    
                    $token = $_REQUEST[ "token" ];
                    $password = $_REQUEST["password"];
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    date_default_timezone_set('Asia/Taipei');
                    $account = get_sql($con, "account", "WHERE a_forget_token='$token' AND a_forget_token_time >= '" . date('Y-m-d H:i:s') . "'");
                    if( !$account ){
                            $callback['msg'] = "此認證信可能過期或不存在，請重新寄送一次認證信。";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $update_json = array();
                    $update_json["a_password"] = $password;
                    $update_json["a_token"] = "[]";
                    
                    if (update_sql( $con , "account" , $update_json , array( "a_id" => $account[0]["a_id"] ) )) {
                        $callback['success'] = true;
                    }
                    else {
                        $callback['msg'] = "update fail";
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

function send_forget(){
        $callback = array();
        try{
                if( check_empty( array( "email","authentication" ) ) ) {
                    
                    header("Access-Control-Allow-Origin:*");
                    header('Access-Control-Allow-Credentials:true');
                    header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE, OPTIONS');
                    header('Access-Control-Allow-Headers:Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With');
                    header('Content-Type:text/html; charset=utf-8');
                    require 'gmailsystem/gmail.php';
                    mb_internal_encoding('UTF-8');
                    
                    $email = $_REQUEST["email"];
                    $authentication = $_REQUEST["authentication"];
                    
                    if( $authentication !== $_SESSION["verification__session"] ) {
                            $callback['msg'] = "認證碼錯誤錯誤";
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
                    
                    $account = get_sql($con, "account", "WHERE a_email='$email' OR a_phone='$email'");
                    if( !$account ){
                            $callback['msg'] = "此信箱或手機沒有註冊過";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    if( $account[0]["a_email"] === $email ){
                            
                            while( true ) {
                                    $token = getRandom( 20 );
                                    $result = mysqli_query($con, "SELECT * FROM account WHERE a_forget_token='$token'");
                                    if (mysqli_num_rows($result) === 0) {
                                            break;
                                    }
                            }

                            date_default_timezone_set('Asia/Taipei');
                            $sql_cmd = "UPDATE account SET a_forget_token='$token',a_forget_token_time='" . date('Y-m-d H:i:s',(time()+24*3600)) . "' WHERE a_id='" . $account[0]["a_id"] . "'";
                            if( !mysqli_query($con, $sql_cmd) ){
                                    $callback['msg'] = "寄送失敗";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }

                            $html = '<div dir="ltr">
                                        <div>
                                            <p class="MsoNormal"> <span style="font-size:10.5pt;font-family:新細明體,serif;background-image:initial;background-repeat:initial">取回密碼說明</span> <span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"><br><br></span> <span lang="EN-US" style="font-family:新細明體,serif"></span> </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"> <span style="font-size:10.5pt;font-family:新細明體,serif;color:rgb(55,96,146)">'.$account[0]['a_nickname'].'</span> <span style="font-size:10.5pt;font-family:新細明體,serif">，</span><span style="font-size:10.5pt;font-family:Arial,sans-serif"> </span><span style="font-size:10.5pt;font-family:新細明體,serif">這封信是由</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif;color:rgb(55,96,146)">Help</span><span style="font-size:10.5pt;font-family:新細明體,serif">發送的。</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"></span> </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10.5pt;font-family:新細明體,serif">您收到這封郵件，是由於這個郵箱地址在</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif;color:rgb(55,96,146)">Help</span><span style="font-size:10.5pt;font-family:新細明體,serif">被登記為用<wbr>戶</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif">Email</span><span style="font-size:10.5pt;font-family:新細明體,serif">，</span><span style="font-size:10.5pt;font-family:Arial,sans-serif"> </span><span style="font-size:10.5pt;font-family:新細明體,serif">且該用戶請求使用</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif">Email</span><span style="font-size:10.5pt;font-family:新細明體,serif">密碼重置功能所致。</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"></span> </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif">------------------------------<wbr>------------------------------<wbr>----------<br>
                                             </span><b><span style="font-size:10.5pt;font-family:新細明體,serif">重要！</span></b><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"><br>
                                             ------------------------------<wbr>------------------------------<wbr>----------</span> </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10.5pt;font-family:新細明體,serif">如果您沒有提交密碼重置的請求或不是</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif;color:rgb(55,96,146)">Help</span><span style="font-size:10.5pt;font-family:新細明體,serif">的註冊用戶，<wbr>請立即忽略</span><span style="font-size:10.5pt;font-family:Arial,sans-serif"> </span><span style="font-size:10.5pt;font-family:新細明體,serif">並刪除這封郵件。只有在您確認需要重置密碼的情況下，<wbr>才需要繼續閱讀下面的內容。</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"></span> </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif">------------------------------<wbr>------------------------------<wbr>----------<br>
                                             </span><b><span style="font-size:10.5pt;font-family:新細明體,serif">密碼重置說明</span></b><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"><br>
                                             ------------------------------<wbr>------------------------------<wbr>----------</span> </p>
                                            <p class="MsoNormal"><span style="font-size:10.5pt;font-family:新細明體,serif;background-image:initial;background-repeat:initial">您只需在提交請求後的一天內，通過點擊下面的鏈接重置您的密碼：</span><span lang="EN-US" style="font-family:新細明體,serif"></span> </p>
                                            <p class="MsoNormal"><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif;background-image:initial;background-repeat:initial"><a href="' . http_email_send . '?t=' . $token . '" target="_blank">' . http_email_send . '?t=' . $token . '</a></span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"><br>
                                             <span style="background-image:initial;background-repeat:initial">(</span></span><span style="font-size:10.5pt;font-family:新細明體,serif;background-image:initial;background-repeat:initial">如果上面不是鏈接形式，<wbr>請將該地址手工粘貼到瀏覽器地址欄再訪問</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif;background-image:initial;background-repeat:initial">)</span><span lang="EN-US" style="font-family:新細明體,serif"></span> </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10.5pt;font-family:新細明體,serif">在上面的鏈接所打開的頁面中輸入新的密碼後提交，<wbr>您即可使用新的密碼登入網站了。<wbr>您可以在用戶控制面板中隨時修改您的密碼。</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"></span> </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10.5pt;font-family:新細明體,serif">本請求提交者的</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"> IP </span><span style="font-size:10.5pt;font-family:新細明體,serif">為</span><span style="font-size:10.5pt;font-family:Arial,sans-serif"> <span lang="EN-US">'.$_SERVER['REMOTE_ADDR'].'</span></span>
                                            </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10.5pt;font-family:新細明體,serif">此致</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"></span> </p>
                                            <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif;color:rgb(55,96,146)">Help</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif"> </span><span style="font-size:10.5pt;font-family:新細明體,serif">管理團隊</span><span lang="EN-US" style="font-size:10.5pt;font-family:Arial,sans-serif">.&nbsp;</span><u><span style="font-size:10.5pt;font-family:新細明體,serif;color:rgb(17,85,204)">'.http_default_path.'</span></u> </p>
                                        </div>
                                    </div>';
                            $title = '[Help] 取回密碼說明';

                            $callback = mstart( $_REQUEST["email"] , $html , $title );
                            
                    }
                    else if( $account[0]["a_phone"] === $email ){
                            $callback['msg'] = "手機認證還未開放";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
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

function check_forget_token(){
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                    
                    $token = $_REQUEST["token"];
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    date_default_timezone_set('Asia/Taipei');
                    $account = get_sql($con, "account", "WHERE a_forget_token='$token' AND a_forget_token_time >= '" . date('Y-m-d H:i:s') . "'");
                    if( !$account ){
                            $callback['msg'] = "此認證信可能過期或不存在，請重新寄送一次認證信。";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
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

function authenticate()
{
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                    
                    $token = $_REQUEST["token"];
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $account = get_sql($con, "account", "WHERE a_email_confirm='$token'");
                    if( !$account )
                    {
                            $callback['msg'] = "此認證信可能過期或不存在，請重新寄送一次認證信。";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    if( update_sql($con, "account", array( "a_email_confirm" => "1" ), array( "a_id" => $account[0]["a_id"] )) ){
                            
                            $ran_callback = set_random_token( $con , $account[0] , strtotime("+1 month"));
                            if( $ran_callback["success"] ){
                                    
                                    include 'account_event.php';
                                    //Email認證 事件
                                    try {
                                        $fn_count = fn_count( $con, "AV00004", $account[0]["a_id"] );
                                    } catch (Exception $exc) {}
                                    //Email認證 事件
                                    $callback['data'] = array( "a_nickname" => $account[0]["a_nickname"] , "token" => $ran_callback["data"] );
                                    $callback['success'] = true;
                            }
                            else{
                                    $callback = $ran_callback;
                            }
                    }
                    else{
                            $callback['msg'] = "認證失敗";
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

function send_authenticate(){
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
                    
                    $check = check_login($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    if( !$account["a_email_confirm"] === "1" ) {
                            $callback['msg'] = "原信箱已經認證過";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $callback = send_authenticate_letter( $con , $account["a_email"] , $account["a_nickname"] );
                    
                    if( !$callback['success'] ){
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $update_json = array();
                    $update_json["a_email_confirm"] = $callback["a_email_confirm"];
                    
                    if( update_sql($con, "account", $update_json, array( "a_id" => $account["a_id"] )) ){
                            $callback['data'] = $account["a_email"];
                            $callback['success'] = true;
                            //update session++
                            $help_member_info = json_decode( $_SESSION["help_member_info"] , true );
                            $help_member_info["a_email_confirm"] = $update_json["a_email_confirm"];
                            $_SESSION["help_member_info"] = json_encode( $help_member_info );
                            //update session--
                    }
                    else{
                            $callback['msg'] = "寄送認證信失敗";
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

function pause_member(){
        $callback = array();
        try{
                if( check_empty( array( "token","a_id","display" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $a_id = $_REQUEST[ "a_id" ];
                    $display = $_REQUEST[ "display" ];
                    
                    if( !in_array($display, array("block","blockade")) ){
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
                    
                    $check = check_login($con);
                    if( !$check["success"] ){
                            $callback['msg'] = $check['msg'];
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $account = $check["data"];
                    
                    if( $account['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $member = get_sql($con, "account", "WHERE a_id = '$a_id'");
                    if( !$member ){
                            $callback['msg'] = "member is not exist";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    if( update_sql($con, "account", array( "a_state" => $display ), array( "a_id" => $member[0]["a_id"] )) ){
                            $callback['data'] = $member[0]["a_id"];
                            $callback['success'] = true;
                            //update session++
                            if( $a_id === $account["id"] ){
                                    $help_member_info = json_decode( $_SESSION["help_member_info"] , true );
                                    $help_member_info["a_state"] = $display;
                                    $_SESSION["help_member_info"] = json_encode( $help_member_info );
                            }
                            //update session--
                    }
                    else{
                            $callback['msg'] = "修改失敗";
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

function get_more_info(){
        $callback = array();
        try{
                if( check_empty( array( "token","part" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $part = $_REQUEST[ "part" ];
                    $data = array();
                    
                    
                    if( !in_array($part, array("common","payment")) ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
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
                    
//                    if( $account['a_admin'] !== "true" ){
//                            $callback['msg'] = "you dont have admin";
//                            $callback['success'] = false;
//                            mysqli_close($con);
//                            return $callback;
//                    }
                    
                    
                    if( $part === "common" ){
                            if( $account["a_parent"] !== "" ){
                                    $parent = get_sql($con, "account", "WHERE a_id='".$account["a_parent"]."'");
                                    $data["a_parent"] = $parent ? $parent[0]["a_nickname"] : "無";
//                                    $data["a_parent_phone"] = $parent ? $parent[0]["a_phone"] : "無";
                            }
                            else{
                                    $data["a_parent"] = "無";
//                                    $data["a_parent_phone"] = "無";
                            }


                            $data["a_registration_time"] = $account["a_registration_time"];
                            $data["a_last_login_time"] = $account["a_last_login_time"];
                            $data["a_lastlogin_ip"] = $account["a_lastlogin_ip"];
                    }
                    else if( $part === "payment" ){
                            $data["a_payment_bank"] = $account["a_payment_bank"];
                            $data["a_payment_account"] = $account["a_payment_account"];
                            $data["a_payment_account_name"] = $account["a_payment_account_name"];
                    }

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

function set_random_token( $con , $account , $set_time ) {
        
        $callback = array();
        $user_rememberme_token = $account["a_token"];
        while( 1 ) {
            $token = getRandom(20);
            $set_token = md5($token);
            $result = mysqli_query($con, "SELECT * FROM account WHERE a_token LIKE '%\\\"$set_token\\\"%'");
            if (mysqli_num_rows($result) == 0) {break;}
        }

        if( $user_rememberme_token === '' || $user_rememberme_token === '[]' ) {
            $set_token = array( array( "token" => $set_token , "time" => $set_time ) );
            $set_token = json_encode( $set_token );
        }
        else {
            $user_rememberme_token = json_decode( $user_rememberme_token );
            if( count( $user_rememberme_token ) >= (int)$account["a_limit_token"] )//MAX_NUM
            {
                $splice_num = count( $user_rememberme_token ) - (int)$account["a_limit_token"] + 1;
                array_splice($user_rememberme_token, 0, $splice_num);
            }
            
            $user_rememberme_token[] = array( "token" => $set_token , "time" => $set_time ) ;
            $set_token = $user_rememberme_token;
            $set_token = json_encode( $set_token );
        }
        
        //update 一些資料
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
                $device = "Mobile";
        }
        else {
                $device = "PC";
        }
        $json = array( "a_last_login_time" => date('Y-m-d H:i:s') ,
                       "a_lastlogin_device" => $device ,
                       "a_lastlogin_browser" => $useragent ,
                       "a_lastlogin_ip" => $_SERVER['REMOTE_ADDR'] ,
                       "a_token" => $set_token );
        
        if( update_sql($con, "account", $json , array( "a_id" => $account["a_id"] )) ) {
            $callback['data'] = $token;
            $callback['success'] = true;
            //update session
            $account["a_token"] = $set_token;
            $account["a_last_login_time"] = $json["a_last_login_time"];
            $account["a_lastlogin_device"] = $json["a_lastlogin_device"];
            $account["a_lastlogin_browser"] = $json["a_lastlogin_browser"];
            $account["a_lastlogin_ip"] = $json["a_lastlogin_ip"];
            $_SESSION["help_token"] = $token;
            $_SESSION["help_member_info"] = json_encode($account);
        }
        else {
            $callback['msg'] = "save token error";
            $callback['success'] = false;
        }
        return $callback;
}

function send_authenticate_letter( $con , $a_email , $a_nickname ){
        
        while( true ) {
                $email_token = getRandom( 20 );
                $result = mysqli_query($con, "SELECT * FROM account WHERE a_email_confirm='$email_token'");
                if (mysqli_num_rows($result) === 0) {
                        break;
                }
        }

        $html = '<p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10pt;font-family:新細明體,serif;color:black">'.$a_nickname.'，</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"><br>
         </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">這封信是由</span><span lang="EN-US" style="color:rgb(55,96,146)">Help</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">發送的。</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"></span> </p>
        <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10pt;font-family:新細明體,serif;color:black">您收到這封郵件，是由於在</span><span style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> </span><span lang="EN-US" style="color:rgb(55,96,146)">Help</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">進行了新用戶註冊，或用戶修改</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> Email </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">使用</span><span style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">了這個郵箱地址。如果您並沒有訪問過</span><span style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">卡提諾論壇，或沒有進行上述操作，請忽略這封郵件。<wbr>您不需要退訂或進行其他進一步的操作。</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"></span> </p>
        <p class="MsoNormal"><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"><br>
         <span style="background-image:initial;background-repeat:initial">------------------------------<wbr>------------------------------<wbr>----------</span>
            <br> </span><b><span style="font-size:10pt;font-family:新細明體,serif;color:black;background-image:initial;background-repeat:initial">帳號激活說明</span></b><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"><br>
         <span style="background-image:initial;background-repeat:initial">------------------------------<wbr>------------------------------<wbr>----------</span>
            <br>
            <br> </span><span lang="EN-US" style="font-family:新細明體,serif"></span> </p>
        <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10pt;font-family:新細明體,serif;color:black">如果您是</span><span lang="EN-US" style="color:rgb(55,96,146)">Help</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">的新用戶，或在修改您的註冊</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> Email </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">時使用了本地址，<wbr>我們需要對您的地址有效性進行驗證以避免垃圾郵件或地址被濫用。</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"></span> </p>
        <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10pt;font-family:新細明體,serif;color:black">您只需點擊下面的鏈接即可激活您的帳號：</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"><br>
        <a href="'.http_authenticate_path.'?t='.$email_token.'" target="_blank">'.http_authenticate_path.'?t='.$email_token.'</a>
        <br>
         (</span><span style="font-size:10pt;font-family:新細明體,serif;color:black">如果上面不是鏈接形式，請將該地址複製到瀏覽器地址欄再訪問</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black">)</span> </p>
        <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10pt;font-family:新細明體,serif;color:black">感謝您的訪問，祝您使用愉快！</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"></span> </p>
        <p class="MsoNormal" style="background-image:initial;background-repeat:initial"><span style="font-size:10pt;font-family:新細明體,serif;color:black">此致</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"><br>
         </span><span lang="EN-US" style="color:rgb(55,96,146)">Help</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"> </span><span style="font-size:10pt;font-family:新細明體,serif;color:black">管理團隊</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black">.&nbsp;
         </span><span style="font-family:新細明體,serif;color:rgb(55,96,146)">'.http_default_path.'</span><span lang="EN-US" style="font-size:10pt;font-family:\'Segoe UI\',sans-serif;color:black"></span> </p>
        <p class="MsoNormal"><span lang="EN-US">&nbsp;</span> </p>
        <p class="MsoNormal"><span lang="EN-US">&nbsp;</span> </p>';

        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers:Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With');
        header('Content-Type:text/html; charset=utf-8');
        require 'gmailsystem/gmail.php';
        mb_internal_encoding('UTF-8');
        $title = '[Help] Email 地址驗證';
        $callback = mstart( $a_email , $html , $title );
        
        
        if( $callback['success'] ){
            $callback["a_email_confirm"] = $email_token;
        }
        return $callback;
        
}

?>
