<?php

        include("config.php");
$page_id = $_REQUEST['page_id'];
$share_conut = $_REQUEST['share_conut'];

$con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
$con->query( "SET NAMES utf8" );

if (mysqli_connect_errno()) {
        echo "false";
}
else {
        
        $sql = "UPDATE page SET share_num=$share_conut WHERE page_id='$page_id'";
        if( mysqli_query( $con , $sql ) )
            echo $share_conut;
        else
            echo "false";
        
        
}