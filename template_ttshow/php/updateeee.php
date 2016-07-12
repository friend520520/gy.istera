<?php
        include("config.php");

        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $con->query( "SET NAMES utf8" );

        if (mysqli_connect_errno()) {
                echo "false";
        }
        else {
                $result = mysqli_query($con, "SELECT * FROM user");
                
                if ( mysqli_num_rows($result) > 0) {
                            
                    while($row = mysqli_fetch_array($result)) {
                            
                            if( $row['email'] === "" )
                            {
                                    $sql = "UPDATE user SET email='" . $row['facebook_mail'] . "' WHERE user_id=" . $row['user_id'] ;
                                    mysqli_query( $con , $sql );
                            }

                    }
                
                }
                
                mysqli_close($con);
                
        }
        
?>