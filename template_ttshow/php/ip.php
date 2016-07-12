<?php
        
        include("config.php");
        date_default_timezone_set('Asia/Taipei');
        
        $date = date('Y-m-d H:i:s');

        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $con->query( "SET NAMES utf8" );

        if (mysqli_connect_errno()) {
                echo "false";
        }
        else {
                $result = mysqli_query($con, "SELECT * FROM ip WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "'");
                if (mysqli_num_rows($result) > 0) {
                        $sql = "UPDATE ip SET times=times+1, last_time='$date' WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "'";
                        mysqli_query( $con , $sql );
                }
                else {
                        mysqli_query($con,"INSERT INTO ip( ip, times, last_time ) VALUES ( '" . $_SERVER['REMOTE_ADDR'] . "', 1, '$date')");
                }
                
                mysqli_close($con);
                
        }
        
        $ip = explode(".", $_SERVER['REMOTE_ADDR']);
        
        if( $_SERVER['REMOTE_ADDR'] == "162.213.251.237" )
        {
            exit();
        }
        
?>