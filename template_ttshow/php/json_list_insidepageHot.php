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
                    $callback1 = "";
                    $callback2 = "";
                    $callback3 = "";
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
                            
                            $click_num = get_sql( $con , "click_num" , "date='$date' ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                            $i = 1;
                            foreach ($click_num as $key => $value) {
                                    
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE page_id=" . $value['page_id'] );

                                    if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {
                                                    
                                                    $tag_html = "";

                                                    /*$special_icon_path = get_sql( $con , "specialtag" , "id='" . $row['special_tag_id'] . "'" , array( "img_path" ) );
                                                    if( $special_icon_path[0]['img_path'] === "" )
                                                        $specialtag = '';
                                                    else
                                                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]["img_path"] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' . $row['special_tag_id'] . '\'">';*/
                                                    if( (int)$datarow['share_num'] > 100000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                                                    else if( (int)$datarow['share_num'] > 50000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                                                    else if( (int)$datarow['share_num'] > 20000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                                                    else if( (int)$datarow['share_num'] > 10000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                                                    else
                                                        $specialtag = '';

                                                    $process_per = ( (int)$row['share_num'] / 50 > 100 ) ? 100 : (int)$row['share_num'] / 50;
                                                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';


                                                    $date = $row['date'];
                                                    $date = explode(":",$date);
                                                    unset($date[ count($date)-1 ]); // remove item at index 0
                                                    $date = array_values($date); // 'reindex' array
                                                    $date = implode(":", $date);

                                                    $callback1 .= '<div class="col-xs-12 cover-text1" style="margin: 0px; padding: 1px;">' .
                                                                '<div style="padding: 0px;margin: 0" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' .
                                                                    '<div name="responsive_div_level1">' .
                                                                        '<a href="page-inner.php?page_id=' . $row['page_id'] . '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                                                            '<div style="background-image: url(' . $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] . '); " class="chessboard-bgcenter">' .
                                                                                '<div class="cover-black-small_"></div>' .
                                                                                '<div class="triangle">
                                                                                    <p>' . $i . '</p>
                                                                                </div>'.
                                                                                '<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                                                    '<i class="ace-icon fa fa-eye panel-icon"></i>' . $row["c_num_click"] .
                                                                                    '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $row['share_num'] .
                                                                                '</div>' .
                                                                            '</div>' .
                                                                        '</a>' .
                                                                        $specialtag .
                                                                    '</div>' .
                                                                    '<p class="chessboard-title"><a href="page-inner.php?page_id=' . $row['page_id'] . '" title="' . $row['title'] . '">' . $row['title'] . '</a></p>' .
                                                                '</div>' .
                                                            '</div>';

                                                    $i++;

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

                                                    $tag_html = "";

                                                    /*$special_icon_path = get_sql( $con , "specialtag" , "id='" . $row['special_tag_id'] . "'" , array( "img_path" ) );
                                                    if( $special_icon_path[0]['img_path'] === "" )
                                                        $specialtag = '';
                                                    else
                                                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]["img_path"] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' . $row['special_tag_id'] . '\'">';*/
                                                    if( (int)$datarow['share_num'] > 100000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                                                    else if( (int)$datarow['share_num'] > 50000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                                                    else if( (int)$datarow['share_num'] > 20000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                                                    else if( (int)$datarow['share_num'] > 10000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                                                    else
                                                        $specialtag = '';

                                                    $process_per = ( (int)$row['share_num'] / 50 > 100 ) ? 100 : (int)$row['share_num'] / 50;
                                                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';


                                                    $date = $row['date'];
                                                    $date = explode(":",$date);
                                                    unset($date[ count($date)-1 ]); // remove item at index 0
                                                    $date = array_values($date); // 'reindex' array
                                                    $date = implode(":", $date);

                                                    $callback2 .= '<div class="col-xs-12 cover-text1" style="margin: 0px; padding: 1px;">' .
                                                                '<div style="padding: 0px;margin: 0" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' .
                                                                    '<div name="responsive_div_level1">' .
                                                                        '<a href="page-inner.php?page_id=' . $row['page_id'] . '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                                                            '<div style="background-image: url(' . $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] . '); " class="chessboard-bgcenter">' .
                                                                                '<div class="cover-black-small_"></div>' .
                                                                                '<div class="triangle">
                                                                                    <p>' . $i . '</p>
                                                                                </div>'.
                                                                                '<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                                                    '<i class="ace-icon fa fa-eye panel-icon"></i>' . $row["c_num_click"] .
                                                                                    '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $row['share_num'] .
                                                                                '</div>' .
                                                                            '</div>' .
                                                                        '</a>' .
                                                                        $specialtag .
                                                                    '</div>' .
                                                                    '<p class="chessboard-title"><a href="page-inner.php?page_id=' . $row['page_id'] . '" title="' . $row['title'] . '">' . $row['title'] . '</a></p>' .
                                                                '</div>' .
                                                            '</div>';

                                                    $i++;

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

                                                    $tag_html = "";

                                                    /*$special_icon_path = get_sql( $con , "specialtag" , "id='" . $row['special_tag_id'] . "'" , array( "img_path" ) );
                                                    if( $special_icon_path[0]['img_path'] === "" )
                                                        $specialtag = '';
                                                    else
                                                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]["img_path"] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' . $row['special_tag_id'] . '\'">';*/
                                                    if( (int)$datarow['share_num'] > 100000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                                                    else if( (int)$datarow['share_num'] > 50000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                                                    else if( (int)$datarow['share_num'] > 20000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                                                    else if( (int)$datarow['share_num'] > 10000 )
                                                        $specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                                                    else
                                                        $specialtag = '';

                                                    $process_per = ( (int)$row['share_num'] / 50 > 100 ) ? 100 : (int)$row['share_num'] / 50;
                                                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';


                                                    $date = $row['date'];
                                                    $date = explode(":",$date);
                                                    unset($date[ count($date)-1 ]); // remove item at index 0
                                                    $date = array_values($date); // 'reindex' array
                                                    $date = implode(":", $date);

                                                    $callback3 .= '<div class="col-xs-12 cover-text1" style="margin: 0px; padding: 1px;">' .
                                                                '<div style="padding: 0px;margin: 0" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' .
                                                                    '<div name="responsive_div_level1">' .
                                                                        '<a href="page-inner.php?page_id=' . $row['page_id'] . '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                                                            '<div style="background-image: url(' . $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] . '); " class="chessboard-bgcenter">' .
                                                                                '<div class="cover-black-small_"></div>' .
                                                                                '<div class="triangle">
                                                                                    <p>' . $i . '</p>
                                                                                </div>'.
                                                                                '<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                                                    '<i class="ace-icon fa fa-eye panel-icon"></i>' . $row["c_num_click"] .
                                                                                    '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $row['share_num'] .
                                                                                '</div>' .
                                                                            '</div>' .
                                                                        '</a>' .
                                                                        $specialtag .
                                                                    '</div>' .
                                                                    '<p class="chessboard-title"><a href="page-inner.php?page_id=' . $row['page_id'] . '" title="' . $row['title'] . '">' . $row['title'] . '</a></p>' .
                                                                '</div>' .
                                                            '</div>';

                                                    $i++;

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
