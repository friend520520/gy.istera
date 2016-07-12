<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $fbuser = $_REQUEST['user'];
                    
                    //SELECT * FROM articles 
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $user1 = get_sql( $con , "user" , "facebook_mail='" . $fbuser . "'" , array( "user_id" ) );
                            
                            $author = get_sql( $con , "page" , "user_id='" . $user1[0]['user_id'] . "'" , array( "c_num_click" ) );
                            $c_num_click = 0;

                            if( $author !== "" )
                            foreach ($author as $key => $value) {
                                $c_num_click += (int)$value["c_num_click"];
                            }

                            $subscribe_num = get_sql( $con , "subscribe" , "channel_id=" . $user1[0]['user_id'] , array( "user_id" ) );
                            $subscribe_num = $subscribe_num[0]["user_id"] === "" ? 0 : count( $subscribe_num );

                            
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