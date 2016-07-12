<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $email = $_REQUEST['user'];
                    $callback = "";
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $user = get_sql( $con , "user", "email='$email'", array( "user_id" ) );
                            
                            $channel = get_sql( $con , "channel_group", "user_id=" . $user[0]["user_id"] , array( "channel_id" ) );
                            
                            if( $channel[0]["channel_id"] )
                            {
                                echo "have";
                            }
                            else
                            {
                                echo "havent";
                            }
                            

                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>
