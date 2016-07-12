<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $callback = "";
                    $sub = $_REQUEST['sub'];
                    $echo = array();
                    
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            $sub_con = ( $sub === "0" ) ? "" : " AND class=$sub";
                            $page = get_sql( $con , "category" , "id=$sub" , array("page") );
                            $page = json_decode( $page[0]['page'] );
                            $page_con = "";
                            $page_dis_con = "";
                            
                            if( !empty($page) ) {
                                
                                foreach ($page as $key => $value) {
                                    
                                    if( $key === 0 )
                                        $page_con .= " AND ( page_id=$value";
                                    else
                                        $page_con .= " OR page_id=$value";
                                    
                                    $page_dis_con .= " AND page_id!=$value";
                                    
                                }
                                $page_con .= " )";
                                
                                $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'" . $page_con ."");
                                
                                if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {

                                                        $echo[] = array( "page_id" => $row['page_id'] ,
                                                                         "title" => $row['title'] ,
                                                                         "article_icon" => $user_image_path . $row['page_id'] . "/Preview/" . $row['article_icon'] );
                                                        

                                            }

                                }
                                
                            }
                            
                            
                            $count = count( $echo );
                            if( $count < 5 )
                            {
                                    $remain_count = 5 - $count;
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'" . $sub_con . $page_dis_con ." ORDER BY c_num_click DESC LIMIT $remain_count");
                                    
                                    if ( mysqli_num_rows($result) > 0) {

                                                while($row = mysqli_fetch_array($result)) {

                                                            //$echo[] = create_json($con, "", $row);
                                                            $echo[] = array( "page_id" => $row['page_id'] ,
                                                                             "title" => $row['title'] ,
                                                                             "article_icon" => $user_image_path . $row['page_id'] . "/Preview/" . $row['article_icon'] );

                                                }
                                    }
                                    
                            }
                            
                            echo json_encode( $echo );
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>
