<?php 
        include("config.php");
        include( "global.php" );
                
        try
        {
                    $email = $_REQUEST['user'];
                    $callback = array();
                    $page_num = $_REQUEST['page_num'];
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' ORDER BY rand() LIMIT $page_num");
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                                
                                                $callback[] = create_json2( $con ,  $email , $row );
                                                
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
