<?php 
        include("config.php");
        include( "global.php" );
                
        try
        {
                    $email = $_REQUEST['user'];
                    $sub = $_REQUEST['sub'];
                    $callback = array();
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $keyword = $_REQUEST['keyword'];
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $sub_str = ( $sub === "0" || !isset($sub) ) ? "" : " AND class='$sub'";
                            
                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND ( title LIKE '%$keyword%' OR tag LIKE '%$keyword%')$sub_str");
                            $length = mysqli_num_rows($result);
                            
                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND ( title LIKE '%$keyword%' OR tag LIKE '%$keyword%')$sub_str LIMIT $_page, $page_num");
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                                
                                                $callback[] = create_json2( $con ,  $email , $row );
                                                //$callback .= create_upright( $email , $row , "col-xs-12 col-sm-6 col-md-6 col-lg-6" );
                                                $callback[ count($callback)-1 ]['length'] = $length;
                                                
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
