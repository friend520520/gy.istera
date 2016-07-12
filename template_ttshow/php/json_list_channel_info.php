<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $ch = $_REQUEST['ch'];
                    //$callback = array();
                    
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {

                            $channel = get_sql( $con , "channel" , "channel_id=" . $ch , array( "ch_name" , "facebook_url" , "youtube_url" , "instagram_url" , "line_url" , "pixnet_url" , "other_url" ) );

                            $callback = array(  "channel_info" => array( "id" => $ch ,
                                                                        "name" => $channel[0]['ch_name'] ) ,
                                                "channel_community" => array( "facebook" => json_decode( $channel[0]['facebook_url'] ) ,
                                                                            "youtube" => json_decode( $channel[0]['youtube_url'] ) ,
                                                                            "instagram" => json_decode( $channel[0]['instagram_url'] ) ,
                                                                            "line" => json_decode( $channel[0]['line_url'] ) ,
                                                                            "pixnet" => json_decode( $channel[0]['pixnet_url'] ) ,
                                                                            "other" => json_decode( $channel[0]['other_url'] ) ) );


                            echo json_encode( $callback );
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>
