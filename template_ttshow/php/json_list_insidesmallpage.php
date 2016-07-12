<?php 
        include("config.php");
        include 'global.php';
        try
        {
                    $callback = array();
                    
                    $article = $_REQUEST['article'];
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $page_type = $_REQUEST['page_type'];
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            switch ($page_type) {
                                case "author":
                                    $author = get_sql( $con , "page" , "page_id=$article AND display!='none'" , array( "channel_id" ) );
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND channel_id=" . $author[0]['channel_id'] . " LIMIT $_page, $page_num");
                                    break;
                                case "interesting":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' ORDER BY c_num_click DESC LIMIT $_page, $page_num");
                                    break;
                                default:
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' LIMIT $_page, $page_num");
                                    break;
                            }
                            
                            
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                                
                                                $callback[] = create_json( $con , "" , $row );
                                                
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
