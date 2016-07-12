<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $fbuser = $_REQUEST['user'];
                    $callback = "";
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $sub = $_REQUEST['sub'];
                    //$subsub = $_REQUEST['subsub'];
                    $page_type = $_REQUEST['page_type'];
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
                            
                            if( !empty($page) ) {
                                
                                foreach ($page as $key => $value) {
                                    
                                    if( $key === 0 )
                                        $page_con .= " AND ( page_id=$value";
                                    else
                                        $page_con .= " OR page_id=$value";
                                    
                                }
                                $page_con .= " )";
                                
                                $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'" . $page_con ."");
                            

                                $i = 0 ;
                                $callback0      = "" ;
                                $callback1      = "" ;
                                $callbackEnd    = "" ;
                                if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {

                                                        $echo[] = create_json($con, "", $row);
                                                        /*$tag_html = "";

                                                        foreach (json_decode($row['tag']) as $key => $value) {
                                                                    if( $key === 0 )
                                                                                $tag_html .= '<span class="panel1-tag">' . $value . '</span>';
                                                                    else
                                                                                $tag_html .= '<span class="panel1-tag">' . $value . '</span>';
                                                        }
                                                        /////////

                                                        $author = get_sql( $con , "user" , "user_id='" . $row['user_id'] . "'" , array( "user_name" , "user_icon" , "business" ) );

                                                        $special_icon_path = get_sql( $con , "specialtag" , "id='" . $row['special_tag_id'] . "'" , array( "img_path" ) );


                                                        $i ++ ;
                                                        if( $i == 1 )
                                                        {

                                                                $callback0 = '<a href="page-inner.php?page_id=' . $row['page_id'] . '" name="responsive_div" header="H_1" style="position: relative ! important; padding: 1px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-6">' .
                                                                                '<div class="bg_top" style="padding:0px; border:0px; cursor: pointer; background-image: url(' . $user_image_path . $row['page_id'] . '/Preview/' . $row['article_icon'] . '); ">' .
                                                                                    '<div style="padding: 0px; margin: 0px; cursor: pointer; height: 100%;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cover-text">' .
                                                                                            '<div class="cover-black"></div>' .
                                                                                            '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' . $row['title'] . '</h3>' .
                                                                                    '</div>' .
                                                                                '</div>' .
                                                                              '</a>';


                                                        }
                                                        else if( $i == 2 )
                                                        {
                                                                $callback1 .=   '<a href="page-inner.php?page_id=' . $row['page_id'] . '" name="responsive_div" header="H_2" style="width: 50%; position: relative ! important; padding: 0px;" class="col-xs-6">' .
                                                                                    '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" style="padding: 0px; margin: 0px; cursor: pointer; margin-top: 0px;  margin-left: 0%; background-image: url(' . $user_image_path . $row['page_id'] . '/ThumbnailM/' . $row['article_icon'] . '); ">' .
                                                                                        '<div class="cover-black"></div>' .
                                                                                        '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' . $row['title'] . '</h3>' .
                                                                                    '</div>' .
                                                                                '</a>';
                                                        }
                                                        else if( $i == 3 )
                                                        {
                                                                $callback1 .= '<a href="page-inner.php?page_id=' . $row['page_id'] . '" name="responsive_div" header="H_3" style="width: 50%; position: relative ! important; padding: 0px;" class="col-xs-6">' .
                                                                                    '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" style="padding: 0px; margin: 0px; cursor: pointer; margin-top: 0px; background-image: url(' . $user_image_path . $row['page_id'] . '/ThumbnailM/' . $row['article_icon'] . '); ">' .
                                                                                        '<div class="cover-black"></div>' .
                                                                                        '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' . $row['title'] . '</h3>' .
                                                                                    '</div>' .
                                                                            '</a>';
                                                        }
                                                        else if( $i == 4 )
                                                        {
                                                                $callback1 .= '<a href="page-inner.php?page_id=' . $row['page_id'] . '" name="responsive_div" header="H_4" style="width: 50%; position: relative ! important; padding: 0px;" class="col-xs-6">' .
                                                                                    '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" ' .
                                                                                        'style="padding: 0px; cursor: pointer; margin-left: 0%; background-image: url(' . $user_image_path . $row['page_id'] . '/ThumbnailM/' . $row['article_icon'] . '); ">' .
                                                                                        '<div class="cover-black"></div>' .
                                                                                        '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' . $row['title'] . '</h3>' .
                                                                                    '</div>' .
                                                                            '</a>';
                                                        }
                                                        else if( $i == 5 )
                                                        {
                                                                $callback1 .= '<a href="page-inner.php?page_id=' . $row['page_id'] . '" name="responsive_div" header="H_5" style="width: 50%; position: relative ! important; padding: 0px;" class="col-xs-6">' .
                                                                                    '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" ' .
                                                                                        'style="padding: 0px; cursor: pointer; background-image: url(' . $user_image_path . $row['page_id'] . '/ThumbnailM/' . $row['article_icon'] . '); ">' .
                                                                                        '<div class="cover-black"></div>' .
                                                                                        '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' . $row['title'] . '</h3>' .
                                                                                    '</div>' .
                                                                            '</a>';
                                                        }*/

                                            }

                                            /*$callbackEnd .= $callback0 .
                                                            '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 homepageheader_small" style="padding: 0px; position: relative; border: 0px none;">'.
                                                                        $callback1 .
                                                            '</div>';


                                            echo $callbackEnd;*/

                                }
                                
                            }
                            
                            
                            $count = count( $echo );
                            if( $count < 5 )
                            {
                                    $remain_count = 5 - $count;
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'" . $sub_con ." ORDER BY c_num_click DESC LIMIT $remain_count");
                                    
                                    if ( mysqli_num_rows($result) > 0) {

                                                while($row = mysqli_fetch_array($result)) {

                                                            $echo[] = create_json($con, "", $row);
                                                            
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
