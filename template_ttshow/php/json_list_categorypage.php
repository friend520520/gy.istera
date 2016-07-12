<?php 
        include("config.php");
        include( "global.php" );
                
        date_default_timezone_set('Asia/Taipei');
        
        $date = date('Y-m-d');
        $w = date('Y-W');
        $m = date('Y-m');
        
        try
        {
                    $email = $_REQUEST['user'];
                    $callback = array();
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $sub = $_REQUEST['sub'];
                    //$subsub = $_REQUEST['subsub'];
                    $page_type = $_REQUEST['page_type'];
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            $sub_str = ( $sub === "0" ) ? "" : " AND class='$sub'";
                            switch ($page_type) {
                                case "common":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'$sub_str LIMIT $_page, $page_num");
                                    function_type1( $result );
                                    break;
                                case "new":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'$sub_str ORDER BY date DESC LIMIT $_page, $page_num");
                                    function_type1( $result );
                                    break;
                                case "hot":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'$sub_str ORDER BY c_num_click DESC LIMIT $_page, $page_num");
                                    function_type1( $result );
                                    break;
                                case "hot_daith":
                                    $click_num = get_sql( $con , "click_num" , "date='$date' AND category_id=$sub ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                                    
                                    if( $click_num[0]['page_id'] !== "" )
                                    {
                                            foreach ($click_num as $key => $value) {
                                                $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND page_id=" . $value['page_id'] );
                                                while($row = mysqli_fetch_array($result)) {
                                                            $callback[] = create_json2( $con ,  $email , $row );
                                                }
                                            }
                                            echo json_encode( $callback );
                                    }
                                    else {
                                            echo "false";
                                    }
                                    
                                    break;
                                case "hot_weekly":
                                    
                                    $click_num = get_sql( $con , "click_num_w" , "w='$w' AND category_id=$sub ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                                    
                                    if( $click_num[0]['page_id'] !== "" )
                                    {
                                            foreach ($click_num as $key => $value) {
                                                $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND page_id=" . $value['page_id']);
                                                while($row = mysqli_fetch_array($result)) {
                                                            $callback[] = create_json2( $con ,  $email , $row );
                                                }
                                            }
                                            echo json_encode( $callback );
                                    }
                                    else {
                                            echo "false";
                                    }
                                    
                                    break;
                                case "hot_monthly":
                                    
                                    
                                    $click_num = get_sql( $con , "click_num_m" , "m='$m' AND category_id=$sub ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                                    
                                    if( $click_num[0]['page_id'] !== "" )
                                    {
                                            foreach ($click_num as $key => $value) {
                                                $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND page_id=" . $value['page_id']);
                                                while($row = mysqli_fetch_array($result)) {
                                                            $callback[] = create_json2( $con ,  $email , $row );
                                                }
                                            }
                                            echo json_encode( $callback );
                                    }
                                    else {
                                            echo "false";
                                    }
                                    
                                    break;
                                default:
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'$sub_str LIMIT $_page, $page_num");
                                    break;
                            }
                            
                            

                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
        function function_type1( $result ) {
                
                global $con;
                global $email;
                if ( mysqli_num_rows($result) > 0) {

                        while($row = mysqli_fetch_array($result)) {

                                    $callback[] = create_json2( $con ,  $email , $row );

                                    //$callback .= create_upright( $email , $row , "col-xs-12 col-sm-6 col-md-6 col-lg-6" );

                        }

                        echo json_encode( $callback );

                } else {
                        echo "false";
                }
        }
        
        function function_type2() {
            
        }
        
?>
