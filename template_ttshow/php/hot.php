<?php 
        include("config.php");
        include("global.php");
                
        date_default_timezone_set('Asia/Taipei');
        
        $time = time();
        
        try
        {
                    $callback = array();
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $result = mysqli_query($con, "SELECT * FROM click_everytime");
                            
                            if ( mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)) {
                                        $datetime = json_decode($row['datetime']);
                                        foreach ( $datetime as $key => $value) {
                                            if( $time - $value > 60*60 ){
                                                unset( $datetime[$key] );
                                            }
                                        }
                                        $datetime = array_values($datetime);
                                        $datetime = json_encode($datetime);
                                        //echo $datetime . " " . $row['page_id'] . " ";
                                        $sql = "UPDATE click_everytime SET datetime='$datetime' WHERE page_id=" . $row['page_id'];
                                        mysqli_query( $con , $sql );
                                    }
                                    $result = mysqli_query($con, "select * "
                                                                ."from click_everytime as a join page as b "
                                                                ."on a.page_id = b.page_id "
                                                                ."where b.display != 'none' order by LENGTH(a.datetime) desc LIMIT $_page, $page_num");
                                    //"select * from click_everytime order by LENGTH(datetime) desc LIMIT $_page, $page_num"
                                    
                                    if ( mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_array($result)) {
                                                $page = get_sql_noGet($con, "page", "WHERE page_id=" . $row['page_id']);
                                                if( $page ) {
                                                    $callback[] = create_json2($con, "", $page[0]);
                                                }
                                            }
                                            echo json_encode($callback);

                                    }
                                    else {
                                            echo "false";
                                    }
                                    
                                    
                                    
                            }
                            else {
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
