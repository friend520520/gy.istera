<?php 
        include("config.php");
        include("global.php");
             
        try
        {
                    $email = $_REQUEST['user'];
                    $specialtag = $_REQUEST['specialtag'];
                    $callback = array();
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            switch ($specialtag) {
                                case "1":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND share_num >= 10000 AND share_num < 20000 LIMIT $_page, $page_num");
                                    break;
                                case "20":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND share_num >= 20000 AND share_num < 50000 LIMIT $_page, $page_num");
                                    break;
                                case "50":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND share_num >= 20000 AND share_num < 100000 LIMIT $_page, $page_num");
                                    break;
                                case "100":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND share_num >= 100000 LIMIT $_page, $page_num");
                                    break;
                                default:
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND display!='none'$sub LIMIT $_page, $page_num");
                                    break;
                            }
                            
                            
                            
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
