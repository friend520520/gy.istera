<?php

        include("config.php");
include 'global.php';

$email = $_REQUEST['email'];
$user_id = $_REQUEST['user_id'];
$subscribe = $_REQUEST['subscribe'];

$con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
$con->query( "SET NAMES utf8" );

if (mysqli_connect_errno()) {
        echo "false";
}
else {
        
        $user = get_sql( $con , "user" , "email='" . $email . "'" , array( "user_id" ) );
        
        if( $subscribe === "cancel" )
        {
                
                $sql = "DELETE FROM subscribe WHERE user_id=" . $user[0]['user_id'] . " AND channel_id=$user_id";

                if (mysqli_query($con, $sql)) {
                    echo "yet";
                } else {
                    echo "false";
                }
                
        }
        else if( $subscribe === "subscribe" )
        {
                $result = mysqli_query($con, "SELECT * FROM subscribe WHERE user_id=" . $user[0]['user_id'] . " AND channel_id=$user_id");
                            
                if ( mysqli_num_rows($result) > 0) {
                    
                    echo "already";
                    
                }
                else {
                    
                    $sql = "INSERT INTO subscribe( user_id, channel_id ) VALUES ( " . $user[0]['user_id'] . ",$user_id)";
                    
                    if (mysqli_query($con, $sql)) {
                        echo "already";
                    } else {
                        echo "false";
                    }
                }
        }
        
        
        
}