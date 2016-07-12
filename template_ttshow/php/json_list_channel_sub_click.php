<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $channel_id = $_REQUEST['channel_id'];
                    
                    //SELECT * FROM articles 
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );
		    
		    $url = $_REQUEST['url'];
		    
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
                            
                            $page1 = get_sql( $con , "page" , "channel_id='" . $channel_id . "'" , array( "c_num_click" ) );
                            
                            if( $page1 !== "" )
                            foreach ($page1 as $key => $value) {
                                        $c_num_click += (int)$value["c_num_click"];
                            }
                            
                            /*
                            $c_num_click = 0;

                            if( $author !== "" )
                            foreach ($author as $key => $value) {
                                        $c_num_click += (int)$value["c_num_click"];
                            }
                            */
                            $subscribe_num = get_sql( $con , "subscribe" , "channel_id='" . $channel_id . "'" , array( "user_id" ) );
                            $subscribe_num = $subscribe_num === "" ? 0 : count( $subscribe_num ) ;
                            
                            $callback = array( "num_click" => $c_num_click , "subscribe_num" => $subscribe_num );
                            echo json_encode($callback);
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>