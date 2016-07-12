<?php 
        include("config.php");
        include( "global.php" );
                
        try
        {
                    $fbuser = $_REQUEST['user'];
                    $callback = "";
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $tag = $_REQUEST['tag'];
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND tag LIKE '%$tag%' LIMIT $_page, $page_num");
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                                
                                                $callback .= create_upright( $fbuser , $row , 'col-xs-12 col-sm-6 col-md-6 col-lg-6' , FALSE , "padding: 0px 7px 14px;" );
                                                
                                    }
                                    
                                    echo $callback;
                                    
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
