<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php


include("config.php");
$func = $_REQUEST["func"];

switch ($func) {
    case "loginbyFB":
        loginbyFB();
        break;
    case "login":
        login();
        break;
    case "login_update":
        login_update();
        break;
    case "setinfo":
        setinfo();
        break;
    case "setinfo2":
        setinfo2();
        break;
    case "forget":
        forget();
        break;
    case "token_change_psw":
        token_change_psw();
        break;
    case "change_psw":
        change_psw();
        break;
}

function loginbyFB()
{
    
        try{
                
                date_default_timezone_set('Asia/Taipei');
                
                $email = $_REQUEST["email"];
                $id = $_REQUEST["id"];
                $name = $_REQUEST["name"];
                $time = date('Y-m-d H:i');
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    /////////////
                    $result = mysqli_query($con, "SELECT * FROM user WHERE facebook_mail='$email'");

                    if (mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {
                                    
                                    $sql = "UPDATE user SET last_login_time='" . $time . "' WHERE facebook_mail='" . $row['facebook_mail'] . "'";
                                    mysqli_query( $con , $sql );
                                    
                                    $cart = array(
                                        "status" => "old",
                                        "user_id" => $row['user_id'],
                                        "user_name" => $row['user_name'],
                                        "usericon" => $row['usericon'],
                                        "cover_photo" => $row['cover_photo'],
                                        "usertype" => $row['usertype'],
                                        "business" => $row['business'],
                                        "usertype_examine" => $row['usertype_examine'],
                                        "facebook_mail" => $row['facebook_mail'],
                                        "google_mail" => $row['google_mail'],
                                        "link_token" => $row['link_token'],
                                        "selfie" => $row['selfie'],
                                        "email" => $row['email'],
                                        "nickname" => $row['nickname'],
                                        "birthday" => $row['birthday'],
                                        "sex" => $row['sex'],
                                        "residence" => $row['residence'],
                                        "phone" => $row['phone'],
                                        "agreemsg" => $row['agreemsg'],
                                        "history_keep" => $row['history_keep'],
                                        "subscribe_newsletter" => $row['subscribe_newsletter'],
                                        "mail_notice" => $row['mail_notice'],
                                        "registration_time" => $row['registration_time'],
                                        "last_login_time" => $time
                                        
                                    );
                                    
                                    echo urldecode( json_encode( $cart ) );
                                
                            }
                            
                    } else {
                            
                            /*mysqli_query($con,"INSERT INTO user( user_name, usertype, usertype_examine, facebook_mail, fb_id, fb_name, registration_time, last_login_time )
                            VALUES ( '$name','editor','none','$email','$id','$name','$time','$time')");
                            
                            $cart = array(
                                    "status" => "new",
                                    "user_name" => $name,
                                    "usertype" => 'editor',
                                    "usertype_examine" => 'none',
                                    "email" => $email,
                                    "fb_id" => $id,
                                    "fb_name" => $name,
                                    "registration_time" => $time,
                                    "last_login_time" => $time

                                );*/
                            
                            echo "first";
                            
                    }

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }

}

function login()
{
    
        try{
                
                date_default_timezone_set('Asia/Taipei');
                
                $email = $_REQUEST["email"];
                $password = $_REQUEST["password"];
                $time = date('Y-m-d H:i');
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    /////////////
                    $result = mysqli_query($con, "SELECT * FROM user WHERE email='$email' AND password='$password' AND email_confirm='1'");

                    if (mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {
                                    
                                    $sql = "UPDATE user SET last_login_time='" . $time . "' WHERE email='" . $row['email'] . "'";
                                    mysqli_query( $con , $sql );
                                    
                                    $cart = array(
                                        "status" => "old",
                                        "user_id" => $row['user_id'],
                                        "user_name" => $row['user_name'],
                                        "usericon" => $row['usericon'],
                                        "cover_photo" => $row['cover_photo'],
                                        "usertype" => $row['usertype'],
                                        "business" => $row['business'],
                                        "facebook_mail" => $row['facebook_mail'],
                                        "link_token" => $row['link_token'],
                                        "selfie" => $row['selfie'],
                                        "email" => $row['email'],
                                        "nickname" => $row['nickname'],
                                        "birthday" => $row['birthday'],
                                        "sex" => $row['sex'],
                                        "residence" => $row['residence'],
                                        "phone" => $row['phone'],
                                        "agreemsg" => $row['agreemsg'],
                                        "history_keep" => $row['history_keep'],
                                        "subscribe_newsletter" => $row['subscribe_newsletter'],
                                        "mail_notice" => $row['mail_notice'],
                                        "registration_time" => $row['registration_time'],
                                        "last_login_time" => $time
                                        
                                    );
                                    
                                    echo urldecode( json_encode( $cart ) );
                                
                            }
                            
                    } else {
                            
                            echo "false";
                            
                    }

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }

}

function login_update()
{
    
        try{
                
                date_default_timezone_set('Asia/Taipei');
                
                $email = $_REQUEST["email"];
                $time = date('Y-m-d H:i');
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    /////////////
                    $result = mysqli_query($con, "SELECT * FROM user WHERE email='$email' AND email_confirm='1'");

                    if (mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {
                                    
                                    $sql = "UPDATE user SET last_login_time='" . $time . "' WHERE email='" . $row['email'] . "'";
                                    mysqli_query( $con , $sql );
                                    
                                    $cart = array(
                                        "status" => "old",
                                        "user_id" => $row['user_id'],
                                        "user_name" => $row['user_name'],
                                        "usericon" => $row['usericon'],
                                        "cover_photo" => $row['cover_photo'],
                                        "usertype" => $row['usertype'],
                                        "business" => $row['business'],
                                        "facebook_mail" => $row['facebook_mail'],
                                        "google_mail" => $row['google_mail'],
                                        "link_token" => $row['link_token'],
                                        "selfie" => $row['selfie'],
                                        "email" => $row['email'],
                                        "nickname" => $row['nickname'],
                                        "birthday" => $row['birthday'],
                                        "sex" => $row['sex'],
                                        "residence" => $row['residence'],
                                        "phone" => $row['phone'],
                                        "agreemsg" => $row['agreemsg'],
                                        "history_keep" => $row['history_keep'],
                                        "subscribe_newsletter" => $row['subscribe_newsletter'],
                                        "mail_notice" => $row['mail_notice'],
                                        "registration_time" => $row['registration_time'],
                                        "last_login_time" => $time
                                        
                                    );
                                    
                                    echo urldecode( json_encode( $cart ) );
                                
                            }
                            
                    } else {
                            
                            echo "false";
                            
                    }

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }

}

function setinfo()
{
    
        try{
                
                $email = $_REQUEST["email"];
                $nickname = $_REQUEST["nickname"];
                $birthday = $_REQUEST["birthday"];
                $sex = $_REQUEST["sex"];
                $residence = $_REQUEST["residence"];
                $phone = $_REQUEST["phone"];
                $subscribe_newsletter = $_REQUEST["subscribe_newsletter"];
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    /////////////
                    $result = mysqli_query($con, "SELECT * FROM user WHERE facebook_mail='$email'");

                    if (mysqli_num_rows($result) > 0) {
                            
                            $sql = "UPDATE user SET nickname='$nickname' , birthday='$birthday' , sex='$sex' , residence='$residence' , phone='$phone' , subscribe_newsletter=$subscribe_newsletter WHERE facebook_mail='" . $email . "'";
                            
                            if( mysqli_query( $con , $sql ) )
                                    echo "true";
                            else {
                                    echo "false";
                            }
                            
                    } else {
                            echo "false";
                    }

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }

}

function setinfo2()
{
    
        try{
                
                $email = $_REQUEST["email"];
                $agreemsg = $_REQUEST["agreemsg"];
                $subscribe_newsletter = $_REQUEST["subscribe_newsletter"];
                $mail_notice = $_REQUEST["mail_notice"];
                $history_keep = $_REQUEST["history_keep"];
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    /////////////
                    $result = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");

                    if (mysqli_num_rows($result) > 0) {
                            
                            $sql = "UPDATE user SET agreemsg=$agreemsg , subscribe_newsletter=$subscribe_newsletter , mail_notice=$mail_notice , history_keep=$history_keep WHERE email='" . $email . "'";
                            
                            if( mysqli_query( $con , $sql ) )
                                    echo "true";
                            else {
                                    echo "false";
                            }
                            
                    } else {
                            echo "false";
                    }

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }

}

function forget()
{
    
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    while( true )
                    {
                        $token = getRandom( 20 );
                        $result = mysqli_query($con, "SELECT * FROM user WHERE forget_token='$token'");

                        if (mysqli_num_rows($result) > 0) {
                            
                        }
                        else {
                            
                            mysqli_query($con, "UPDATE user SET forget_token='$token' WHERE email='" . $_REQUEST["email"] . "'");
                            break;
                        }
                    }
                    
                    echo $token;

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }

}

function token_change_psw()
{
    
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                $token = $_REQUEST["token"];
                $psw = $_REQUEST["psw"];
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    $result = mysqli_query($con, "SELECT * FROM user WHERE forget_token='$token'");

                    if (mysqli_num_rows($result) > 0) {
                        
                        if( mysqli_query($con, "UPDATE user SET password='" . $psw . "' WHERE forget_token='$token'") ) {
                            
                            $result = mysqli_query($con, "SELECT * FROM user WHERE forget_token='$token'");
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_array($result)) {
                                    
                                    $cart = array(
                                        "status" => "old",
                                        "user_id" => $row['user_id'],
                                        "user_name" => $row['user_name'],
                                        "usericon" => $row['usericon'],
                                        "cover_photo" => $row['cover_photo'],
                                        "usertype" => $row['usertype'],
                                        "business" => $row['business'],
                                        "facebook_mail" => $row['facebook_mail'],
                                        "link_token" => $row['link_token'],
                                        "selfie" => $row['selfie'],
                                        "email" => $row['email'],
                                        "nickname" => $row['nickname'],
                                        "birthday" => $row['birthday'],
                                        "sex" => $row['sex'],
                                        "residence" => $row['residence'],
                                        "phone" => $row['phone'],
                                        "agreemsg" => $row['agreemsg'],
                                        "history_keep" => $row['history_keep'],
                                        "subscribe_newsletter" => $row['subscribe_newsletter'],
                                        "mail_notice" => $row['mail_notice'],
                                        "registration_time" => $row['registration_time'],
                                        "last_login_time" => $row['last_login_time']
                                        
                                    );
                                    
                                    echo urldecode( json_encode( $cart ) );
                                }
                            }
                            
                            
                        }
                        else {
                            echo 'false';
                        }
                        
                    }
                    else {

                        echo "false";

                    }
                    
                    

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }

}

function change_psw()
{
    
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                $email = $_REQUEST["email"];
                $psw = $_REQUEST["psw"];
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    $result = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");

                    if (mysqli_num_rows($result) > 0) {
                        
                        if( mysqli_query($con, "UPDATE user SET password='" . $psw . "' WHERE email='$email'") ) {
                            
                            echo 'true';
                            
                            /*$result = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_array($result)) {
                                    
                                    $cart = array(
                                        "status" => "old",
                                        "user_id" => $row['user_id'],
                                        "user_name" => $row['user_name'],
                                        "usericon" => $row['usericon'],
                                        "cover_photo" => $row['cover_photo'],
                                        "usertype" => $row['usertype'],
                                        "business" => $row['business'],
                                        "facebook_mail" => $row['facebook_mail'],
                                        "link_token" => $row['link_token'],
                                        "selfie" => $row['selfie'],
                                        "email" => $row['email'],
                                        "nickname" => $row['nickname'],
                                        "birthday" => $row['birthday'],
                                        "sex" => $row['sex'],
                                        "residence" => $row['residence'],
                                        "phone" => $row['phone'],
                                        "agreemsg" => $row['agreemsg'],
                                        "history_keep" => $row['history_keep'],
                                        "subscribe_newsletter" => $row['subscribe_newsletter'],
                                        "mail_notice" => $row['mail_notice'],
                                        "registration_time" => $row['registration_time'],
                                        "last_login_time" => $row['last_login_time']
                                        
                                    );
                                    
                                    echo urldecode( json_encode( $cart ) );
                                }
                            }*/
                            
                            
                        }
                        else {
                            echo 'false';
                        }
                        
                    }
                    else {

                        echo "false";

                    }
                    
                    

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }

}

function getRandom( $count )
{
    $var = "";
    for( $i=1 ; $i<=$count ; $i++ )
    {
        $ASCII = getASCII();
        $var .= $ASCII;
    }
    return $var;
}

function getASCII()
{//48~57,65~90 //48~83 65-58=7
    $count = ceil(lcg_randf(47, 83));
    if( $count >= 58 )
    {
        $count += 7;
    }
    return chr( $count );
}

function lcg_randf($min, $max)
{
    return $min + lcg_value() * abs($max - $min);
}

?>
