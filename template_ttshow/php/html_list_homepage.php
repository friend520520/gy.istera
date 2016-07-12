<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $callbackEnd = "";
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
                            
                            $category = get_sql( $con , "category" , "display='true' ORDER BY _order" , array( "id" , "name" , "image_blue" ) );
                            
                            foreach ( $category as $categorykey => $categoryvalue) {
                            
                                    $callback = "";
                                    
                                    switch ($page_type) {
                                        case "common":
                                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class=" . $categoryvalue['id'] . " LIMIT $_page, $page_num");
                                            break;
                                        case "new":
                                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class=" . $categoryvalue['id'] . " ORDER BY date DESC LIMIT $_page, $page_num");
                                            break;
                                        case "hot":
                                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class=" . $categoryvalue['id'] . " ORDER BY c_num_click DESC LIMIT $_page, $page_num");
                                            break;
                                        case "subscribe":
                                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class=" . $categoryvalue['id'] . " LIMIT $_page, $page_num");
                                            break;
                                        default:
                                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class=" . $categoryvalue['id'] . " LIMIT $_page, $page_num");
                                            break;
                                    }



                                    if ( mysqli_num_rows($result) > 0) {
                                            
                                            $i=1;
                                            
                                            $callback2 = '<div style="float: left; width: 50%; height: auto; position: relative;"><div style="padding-top: 50%; padding-left: 10px;"></div>';
                                            while($row = mysqli_fetch_array($result)) {
                                                        if( $i%7 === 1 )
                                                            $callback .= create_chessboard_home( $row , "col-xs-6 col-sm-6 col-md-6 col-lg-6" , "width: 50%; padding-right: 10px;" );
                                                        else {
                                                            if( $i === 2 ) {
                                                                $callback2 .= create_chessboard_home2( $row , "" , "left: 0px; top: 0px; padding: 0px 5px;" );
                                                            }
                                                            else if( $i === 3 ) {
                                                                $callback2 .= create_chessboard_home2( $row , "" , "left: 33.33%; top: 0px; padding: 0px 5px;" );
                                                            }
                                                            else if( $i === 4 ) {
                                                                $callback2 .= create_chessboard_home2( $row , "" , "right: 0px; top: 0px; padding: 0px 5px;" );
                                                            }   
                                                            else if( $i === 5 ) {
                                                                $callback2 .= create_chessboard_home2( $row , "" , "left: 0px; bottom: -48px; padding: 0px 5px;" );
                                                            }
                                                            else if( $i === 6 ) {
                                                                $callback2 .= create_chessboard_home2( $row , "" , "left: 33.33%; bottom: -48px; padding: 0px 5px;" );
                                                            }
                                                            else if( $i === 7 ) {
                                                                $callback2 .= create_chessboard_home2( $row , "" , "right: 0px; bottom: -48px; padding: 0px 5px;" );
                                                            }                                                         
                                                        }
                                                        $i++;
                                            }
                                            $callback2 = $callback2."</div>";
                                            $callback = $callback.$callback2;
                                            
                                            $callbackEnd .= '<div>' .
                                                                '<h3 style="color: rgb(76, 143, 189); margin-bottom: 0px; font-weight: bold; height: 30px; line-height: 30px;">' .
                                                                    '<img src="' . $categoryvalue['image_blue'] . '" style="vertical-align: middle; height: 28px; width: 28px;">' .
                                                                    '<span style="vertical-align: middle; font-size: 26px; margin-left: 4px;">' . $categoryvalue['name'] . '</span>' .
                                                                    '<p class="more" sub="' . $categoryvalue['id'] . '" style="cursor: pointer; float: right; margin: 0px;">
                                                                      <i class="fa fa-chevron-right" style="float: right; color: rgb(76, 143, 189); margin-top: 4px; font-size: 26px; margin-right: 10px;"></i>
                                                                    </p>
                                                                </h3>' .
                                                                //<hr style="border: 1px solid rgb(76, 143, 189); margin: 2px 0 9px;">
                                                                '<div style="margin-top: 10px;">' .
                                                                $callback .
                                                                '</div>'.
                                                                '<div class="clearfix"></div>'.
                                                            '</div>';

                                    } else {
                                            
                                    }
                            }
                            
                            echo $callbackEnd;
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>
