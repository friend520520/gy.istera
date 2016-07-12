<?php 
        include("config.php");
        include("global.php");
                
        date_default_timezone_set('Asia/Taipei');
        
        $date = date('Y-m-d');
        $w = date('Y-W');
        $m = date('Y-m');
        
        try
        {
                    $period = $_REQUEST['period'];
                    $callback1 = array();
                    $callback2 = array();
                    $callback3 = array();
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false1";
                    }
                    else {
                            
                            $click_num = get_sql( $con , "click_num" , "date='$date' ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                            $i = 1;
                            foreach ($click_num as $key => $value) {
                                    
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE page_id=" . $value['page_id'] );

                                    if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {
                                                    
                                                    $callback1[] = create_json2( $con ,  "" , $row );

                                            }

                                    } else {
                                            
                                    }

                            }

                            $click_num = get_sql( $con , "click_num_w" , "w='$w' ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                            $i = 1;
                            foreach ($click_num as $key => $value) {
                                    
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE page_id=" . $value['page_id'] );

                                    if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {

                                                    $callback2[] = create_json2( $con ,  "" , $row );

                                            }

                                    } else {
                                            
                                    }

                            }
                            
                            $click_num = get_sql( $con , "click_num_m" , "m='$m' ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                            $i = 1;
                            foreach ($click_num as $key => $value) {
                                    
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE page_id=" . $value['page_id'] );

                                    if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {

                                                    $callback3[] = create_json2( $con ,  "" , $row );

                                            }

                                    } else {
                                            
                                    }

                            }
                            
                            $callbackend = array( "daith" => $callback1 , "weekly" => $callback2 , "monthly" => $callback3 ); 
                            
                            echo json_encode($callbackend);
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>
