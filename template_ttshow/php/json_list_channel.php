<?php 
        include("config.php");
        include( "global.php" );
                
        try
        {
                    $callback = array();
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $channel_type = $_REQUEST['channel_type'];
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            switch ($channel_type) {
                                case "common":
                                    $result = mysqli_query($con, "SELECT * FROM channel WHERE channel_id=37 OR channel_id=36 OR channel_id=35 OR channel_id=34 OR channel_id=51 OR channel_id=86 OR channel_id=113 LIMIT $_page, $page_num");
                                    break;
                                case "new":
                                    $result = mysqli_query($con, "SELECT * FROM channel ORDER BY registration_time DESC LIMIT $_page, $page_num");
                                    break;
                                /*case "hot":
                                    $result = mysqli_query($con, "SELECT * FROM channel ORDER BY c_num_click DESC LIMIT $_page, $page_num");
                                    break;
                                case "subscribe":
                                    $result = mysqli_query($con, "SELECT * FROM channel LIMIT $_page, $page_num");
                                    break;*/
                                default:
                                    $result = mysqli_query($con, "SELECT * FROM channel LIMIT $_page, $page_num");
                                    break;
                            }
                            
                            
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                                
                                                $callback[] = array( "id"            => $row["channel_id"],
                                                                    "username"      => $row["user_name"],
                                                                    "channelname"   => $row["ch_name"],
                                                                    "icon"          => $row["ch_icon"],
                                                                    "cover"         => $row["ch_cover"],
                                                                    "type"          => $row["ch_type"],
                                                                    "introduce"     => $row["ch_introduce"],
                                                                    "url"           => $row["ch_url"],
                                                                    "facebook"      => $row["facebook_url"],
                                                                    "youtube"       => $row["youtube_url"],
                                                                    "instagram"     => $row["instagram_url"],
                                                                    "other"         => $row["other_url"] );
                                                
                                    }
                                    
                                    echo json_encode( $callback );
                                    
                            } else {
                                    echo "false";
                            }

                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
        
?>
