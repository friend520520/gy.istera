<?php


                include("config.php");
                include("global.php");
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    $user = get_sql( $con , "user" , "facebook_mail='bightp850651@yahoo.com.tw'" , array( "user_id" ) );
                    
                    $channel = get_sql( $con , "channel" , "user_id=" . $user[0]["user_id"] , array( "channel_id" ) );
                    
                    delete_sql( "subscribe" , "user_id=" . $user[0]["user_id"] );
                    delete_sql( "collect" , "user_id=" . $user[0]["user_id"] );
                    
                    delete_sql( "user" , "user_id=" . $user[0]["user_id"] );
                    
                    foreach ($channel as $key => $value) {
                        
                        delete_sql( "subscribe" , "channel_id=" . $value["channel_id"] );
                        delete_sql( "page" , "channel_id=" . $value["channel_id"] );
                        delete_sql( "channel" , "channel_id=" . $value["channel_id"] );
                        
                    }
                    
                    
                    
                    
                    mysqli_close($con);
                
                }
                
                function delete_sql( $table , $Condition )
                {
                        global $con;
                        
                        echo "DELETE FROM $table WHERE $Condition" . " ";
                        
                        $result = mysqli_query($con, "DELETE FROM $table WHERE $Condition");
                        
                        if( $result ) {
                            echo "ture <br>";
                        }
                        else {
                            echo "false <br>";
                        }
                        
                }
?>
