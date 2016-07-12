<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $callback = "";
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $sub = $_REQUEST['sub'];
                    //$subsub = $_REQUEST['subsub'];
                    $page_type = $_REQUEST['page_type'];
                    $_type = $_REQUEST['type'];
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            switch ($page_type) {
                                case "common":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class='$sub' LIMIT $_page, $page_num");
                                    break;
                                case "new":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class='$sub' ORDER BY date DESC LIMIT $_page, $page_num");
                                    break;
                                case "hot":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class='$sub' ORDER BY c_num_click DESC LIMIT $_page, $page_num");
                                    break;
                                case "subscribe":
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class='$sub' LIMIT $_page, $page_num");
                                    break;
                                default:
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND class='$sub' LIMIT $_page, $page_num");
                                    break;
                            }
                            

                            $i = 0 ;
                            $callback0      = "" ;
                            $callback1      = "" ;
                            $callbackEnd    = "" ;
                            if ( mysqli_num_rows($result) > 0) {
                                    
                                        while($row = mysqli_fetch_array($result)) {

                                                    $i ++ ;
                                                    if( $i == 1 )
                                                    {
                                                                $callback21 = '<div style="width:100%;border: 1px solid rgb(221, 221, 221);padding: 0px; height: 111px; background-image: url(' . $user_image_path . $row['page_id'] . '/Preview/' . $row['article_icon'] . '); " class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg_top">
                                                                                <div class="cover-black" style="opacity:0.6"></div>
                                                                                </div>' ;
                                                    }
                                                    
                                                    
                                                    $callback22 .=
                                                    '<h5 style="text-align: left; letter-spacing: 1px; line-height: 20px; margin: 5px 0px; overflow-y: hidden; height: 25px;font-size:13px;color:gray">' .
                                                    '<span class="badge badge-info" style="margin-right: 10px;border-radius: 0px;">'. ( $i ) .'</span>' .
                                                    '<p style="cursor: pointer; display: inline;" dir="ltr" class="yt-uix-sessionlink yt-uix-tile-link  spf-link  yt-ui-ellipsis yt-ui-ellipsis-2 pagebg" page="' . $row['page_id'] . '" backimg="' . $user_image_path . $row['page_id'] . '/Preview/' . $row['article_icon'] . '">' . $row['title'] . '</p>' .
                                                    '</h5>' ;
                                                    
                                        }
                                        

                                        //abin edit 2015.4.13 ++
                                        if( $sub == "1" ) {
                                                $sub_to_name = "好笑";
                                        } else if( $sub == "2" ) {
                                                $sub_to_name = "影片";
                                        } else if( $sub == "3" ) {
                                                $sub_to_name = "休閒";
                                        } else if( $sub == "4" ) {
                                                $sub_to_name = "插畫";
                                        } else if( $sub == "5" ) {
                                                $sub_to_name = "梗圖";
                                        } else if( $sub == "6" ) {
                                                $sub_to_name = "新聞";
                                        }
                                        //abin edit 2015.4.13 --
                                        
                                        $callbackEnd .=     $callback21 .
                                                            '<div class="clearfix" style="margin-top: 130px;" ></div>' .
                                                            $callback22;
                                        
                                        /*
                                        $callbackEnd .= $callback0 .
                                                        '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:0px;">'.
                                                                    $callback1 .
                                                        '</div>';*/

                                        echo $callbackEnd;
                                    
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
