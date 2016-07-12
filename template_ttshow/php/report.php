<?php

        include("config.php");
include("global.php");

$email = $_REQUEST['email'];
$page = $_REQUEST['page'];
$report = $_REQUEST['report'];
$text = $_REQUEST['text'];

if( $report !== "8" )
    $text = "";

$con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
$con->query( "SET NAMES utf8" );

if (mysqli_connect_errno()) {
        echo "false";
}
else {
        if( $email === "" )
            $user = 0;
        else {
            $user = get_sql( $con , "user" , "email='" . $email . "'" , array( "user_id" ) );
            $user = $user[0]["user_id"];
        }
        
        $sql = "INSERT INTO report( report_person, page, report_item, report_content )
                            VALUES ( $user , $page , '$report' , '$text' )";
        
        if( mysqli_query($con,$sql) )
            echo "success";
        else
            echo "false";


}

function start_session($expire = 0)
{
    if ($expire == 0) {
        $expire = ini_get('session.gc_maxlifetime');
    } else {
        ini_set('session.gc_maxlifetime', $expire);
    }

    if (empty($_COOKIE['PHPSESSID'])) {
        session_set_cookie_params($expire);
        session_start();
    } else {
        session_start();
        setcookie('PHPSESSID', session_id(), time() + $expire);
    }
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}