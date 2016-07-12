<?php
        include("config.php");
        include("global.php");

        date_default_timezone_set('Asia/Taipei');
        
        $time = time();
        $date = date('Y-m-d');
        $w = date('Y-W');
        $m = date('Y-m');
        
        $page_id = $_REQUEST['article_id'];
        /*start_session( 3600 );
        
        if( $_SESSION[ "_" . (string)$page_id ] )
        {
            echo "success";
        }
        else{

            $_SESSION[ "_" . (string)$page_id ] = true;
            */

            $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
            $con->query( "SET NAMES utf8" );

            if (mysqli_connect_errno()) {
                    echo "false";
            }
            else {
                
                    $result = mysqli_query($con, "SELECT * FROM click_everytime WHERE page_id=$page_id");
                    if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                if( $row['datetime'] !== "" ) {
                                    $datetime_arr = json_decode($row['datetime']);
                                    $datetime_arr[] = $time;
                                }
                                else {
                                    $datetime_arr = array();
                                }
                            }
                            $sql = "UPDATE click_everytime SET datetime='" . json_encode($datetime_arr) . "' WHERE page_id=$page_id";
                            mysqli_query( $con , $sql );
                    }
                    else {
                            mysqli_query($con, "INSERT INTO click_everytime( page_id, datetime) VALUES ( $page_id, '[$time]')");
                    }
                    
                    
                    $result = mysqli_query($con, "SELECT * FROM click_num WHERE page_id=$page_id AND date='$date'");
                    if (mysqli_num_rows($result) > 0) {
                            $sql = "UPDATE click_num SET c_num_click=c_num_click+1 WHERE page_id=$page_id AND date='$date'";
                            mysqli_query( $con , $sql );
                    }
                    else {
                            $category = get_sql( $con , "page", "page_id=" . $page_id , array( "class" ) );
                            mysqli_query($con,"INSERT INTO click_num( page_id, c_num_click, date, category_id ) VALUES ( $page_id, 1, '$date', " . $category[0]['class'] . ")");
                    }
                    
                    $result = mysqli_query($con, "SELECT * FROM click_num_w WHERE page_id=$page_id AND w='$w'");
                    if (mysqli_num_rows($result) > 0) {
                            $sql = "UPDATE click_num_w SET c_num_click=c_num_click+1 WHERE page_id=$page_id AND w='$w'";
                            mysqli_query( $con , $sql );
                    }
                    else {
                            $category = get_sql( $con , "page", "page_id=" . $page_id , array( "class" ) );
                            mysqli_query($con,"INSERT INTO click_num_w( page_id, c_num_click, w, category_id ) VALUES ( $page_id, 1, '$w', " . $category[0]['class'] . ")");
                    }
                    
                    $result = mysqli_query($con, "SELECT * FROM click_num_m WHERE page_id=$page_id AND m='$m'");
                    if (mysqli_num_rows($result) > 0) {
                            $sql = "UPDATE click_num_m SET c_num_click=c_num_click+1 WHERE page_id=$page_id AND m='$m'";
                            mysqli_query( $con , $sql );
                    }
                    else {
                            $category = get_sql( $con , "page", "page_id=" . $page_id , array( "class" ) );
                            mysqli_query($con,"INSERT INTO click_num_m( page_id, c_num_click, m, category_id ) VALUES ( $page_id, 1, '$m', " . $category[0]['class'] . ")");
                    }
                    
                    
                    $sql = "UPDATE page SET c_num_click=c_num_click+1 WHERE page_id=$page_id";
                    if( mysqli_query( $con , $sql ) )
                        echo "success";
                    else
                        echo "false";

            }
        //}

        function start_session($expire = 0)
        {
            if ($expire == 0) {
                $expire = ini_get('session.gc_maxlifetime');
            } else {
                ini_set('session.gc_maxlifetime', $expire);
            }

            if (empty($_COOKIE['PHPSESSID'])) {
                session_set_cookie_params($expire);
                session_start();
            } else {
                session_start();
                setcookie('PHPSESSID', session_id(), time() + $expire);
            }
        }
        
?>