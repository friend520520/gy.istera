<?php
        include("config.php");
        include("global.php");

            $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
            $con->query( "SET NAMES utf8" );
            $callback = array( "success" => 0 , "fail" => 0 );
            
            if (mysqli_connect_errno()) {
                    echo "false";
            }
            else {
                
                    $result = mysqli_query($con, "SELECT * FROM channel");
                    if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                    
                                    $ch_icon = str_replace( "www.ooxxoox.com", "ttshow.tw", $row['ch_icon'] );
                                    $ch_cover = str_replace( "www.ooxxoox.com", "ttshow.tw", $row['ch_cover'] );
                                    
                                    $sql = "UPDATE channel SET ch_icon='$ch_icon', ch_cover='$ch_cover' WHERE channel_id=" . $row['channel_id'];
                                    if( mysqli_query( $con , $sql ) )
                                        $callback['success']++;
                                    else
                                        $callback['fail']++;

                            }
                            echo json_encode($callback);
                    }
                    else {
                            
                    }
                    

            }
?>