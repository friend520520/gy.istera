<?php

include 'config.php';
include 'global.php';

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$con->query("SET NAMES utf8");
// Check connection
if (mysqli_connect_errno()) {
        exit;
}


    $channel = get_sql_array( $con ,
            "channel" , array( "ch_id" ) , "WHERE ch_url='jack'" );
    echo $channel[0]["ch_id"];

    mysqli_close($con);


?>
