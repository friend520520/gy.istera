<?php 
        include("config.php");
        include( "global.php" );
                
        try
        {
                    $email     = $_REQUEST['user'];
                    $page_num   = $_REQUEST['page_num'];
                    $page       = $_REQUEST['page'];
                    $class      = $_REQUEST['class'];
                    $channel_id = $_REQUEST['channel_id'];
                    $page_type  = $_REQUEST['page_type'];
                    $search     = $_REQUEST['search'];
                    $url        = $_REQUEST['url'];
                    
                    
                    $callback   = array();
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    //abin edit  2015.6.5  ++
                    if( $url == "true" ) {
                        $channel_id = urldecode($channel_id);
                        $result = mysqli_query($con, "SELECT * FROM channel WHERE ch_url='$channel_id'");
                        if ( mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_array($result);
                                $channel_id = $row["channel_id"];
                        }
                    }
                    //abin edit  2015.6.5  --
                    
                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            $tmp = ( $class === "" ) ? "" : " AND class='$class'";
                            switch ($page_type) {
                                case "common":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE title LIKE '%{$search}%' AND channel_id='$channel_id'$tmp LIMIT $_page, $page_num");
                                    break;
                                case "new":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE title LIKE '%{$search}%' AND channel_id='$channel_id'$tmp ORDER BY date DESC LIMIT $_page, $page_num");
                                    break;
                                case "hot":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE title LIKE '%{$search}%' AND channel_id='$channel_id'$tmp ORDER BY c_num_click DESC LIMIT $_page, $page_num");
                                    break;
                                case "subscribe":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE title LIKE '%{$search}%' AND channel_id='$channel_id'$tmp LIMIT $_page, $page_num");
                                    break;
                                default:
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE title LIKE '%{$search}%' AND channel_id='$channel_id'$tmp LIMIT $_page, $page_num");
                                    break;
                            }
                            
                            
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                                
                                                $callback[] = create_json2( $con ,  $email , $row );
                                                
                                                //$callback .= create_upright( $email , $row , "col-xs-12 col-sm-6 col-md-6 col-lg-6" );
                                                
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