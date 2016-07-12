<?php 
        include("config.php");
        include("global.php");
        include("emoji.php");
        
        try
        {
                    $page = $_REQUEST['page'];
                    $channel_page = array();
                    
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND page_id='$page'");
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                        
                                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND channel_id=" . $row['channel_id'] . " LIMIT 8");
                                            if ( mysqli_num_rows($result) > 0) {
                                                    while($row2 = mysqli_fetch_array($result)) {
                                                                $channel_page[] = create_json( $con ,  "" , $row2 );
                                                    }
                                            }
                                            /////////

                                            $author = get_sql( $con , "user" , "user_id='" . $row['user_id'] . "'" , array( "user_name" , "usericon" , "business" , "facebook_mail" ) );

                                            $special_icon_path = get_sql( $con , "specialtag" , "id='" . $row['special_tag_id'] . "'" , array( "img_path" ) );
                                            $category = get_sql( $con , "category" , "id='" . $row['class'] . "'" , array( "name" ) );

                                            $channel = get_sql( $con , "channel" , "channel_id=" . $row['channel_id'] , array( "ch_name" , "facebook_url" , "youtube_url" , "instagram_url" , "line_url" , "pixnet_url" , "other_url" ) );
                                            
                                            //////////////about
                                            $about_str = "WHERE display !='none'";
                                            foreach (json_decode($row['tag']) as $key => $value) {
                                                    if( $key === 0 )
                                                        $about_str .= " AND ( tag LIKE '%\\\"$value\\\"%'";
                                                    else
                                                        $about_str .= " OR tag LIKE '%\\\"$value\\\"%'"; 
                                                    
                                                    if( count( json_decode($row['tag']) ) === $key-1 )
                                                        $about_str .= ")";
                                            }
                                            $about_str .= " LIMIT 8";
                                            $about_page = get_sql_noGet( $con , "page" , $about_str );
                                            $about_page_arr = array();
                                            $about_num = 0;
                                            if( $about_page ) {
                                                $about_num = count( $about_page );
                                                foreach ($about_page as $key => $value) {
                                                        $about_page_arr[] = create_json2( $con ,  "" , $value );
                                                }
                                            }
                                            
                                            if( $about_num !== 8 ) {
                                                
                                                $about_str = "WHERE display !='none' AND class=" . $row['class'] . " ORDER BY rand() LIMIT " . ( 8-$about_num ) ;
                                                
                                                $about_page = get_sql_noGet( $con , "page" , $about_str );
                                                if( $about_page ) {
                                                    foreach ($about_page as $key => $value) {
                                                            $about_page_arr[] = create_json2( $con ,  "" , $value );
                                                    }
                                                }
                                                
                                            }
                                            //////////////about
                                            
                                            $callback = array(  "special_id" => $row['special_tag_id'] ,
                                                                "img_path" => $special_icon_path[0]['img_path'] , 
                                                                "tag" => json_decode($row['tag']) , 
                                                                "title" => $row['title'] , 
                                                                "describe" => $row['describe'] , 
                                                                "category_class" => $row['class'] , 
                                                                "category_name" => $category[0]['name'] , 
                                                                "date" => $row['date'] , 
                                                                "c_num_click" => $row['c_num_click'] , 
                                                                "article_icon" => $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] ,
                                                                "about_page" => $about_page_arr ,
                                                                "author_id" => $row['user_id'] ,
                                                                "author_name" => $author[0]['user_name'] , 
                                                                "author_icon" => $author[0]['usericon'] , 
                                                                "author_business" => $author[0]['business'] ,
                                                                "author_fbemail" => $author[0]['facebook_mail'] ,
                                                                "channel_info" => array( "id" => $row['channel_id'] ,
                                                                                        "name" => $channel[0]['ch_name'] ) ,
                                                                "channel_community" => array( "facebook" => json_decode( $channel[0]['facebook_url'] ) ,
                                                                                            "youtube" => json_decode( $channel[0]['youtube_url'] ) ,
                                                                                            "instagram" => json_decode( $channel[0]['instagram_url'] ) ,
                                                                                            "line" => json_decode( $channel[0]['line_url'] ) ,
                                                                                            "pixnet" => json_decode( $channel[0]['pixnet_url'] ) ,
                                                                                            "other" => json_decode( $channel[0]['other_url'] ) ) ,
                                                                "body" => emoji_html_to_unified( $row["html"] ) ,
                                                                "channel_page" => $channel_page );
                                            /*$callback .=
                                                        '<div class="col-xs-1 page-tag-img">' .
                                                          '<img style="" src="' . $special_icon_path[0]['img_path'] .'" alt="ttshow">' .
                                                        '</div>' .
                                                        $tag_html .
                                                        '<h4 class="page-h4">' . $row['title'] . '</h4>' .
                                                        '<p>' . $row['describe'] . '</p>' .
                                                        '<div>' .
                                                            '<i class="ace-icon glyphicon glyphicon-user page-icon"></i>' .
                                                            '<a style="color: gray;font-size: 9pt; margin-right: 4px;"  style=" font-size: 10pt;">' . $category[0]['name'] . '</a>' .
                                                            '<i style="color: gray;margin-right: 4px;" class="ace-icon glyphicon glyphicon-time "></i>' .
                                                            '<span style="color: gray;font-size: 9pt; margin-right: 4px;" >' . $row['date'] . '</span>' .
                                                            '<i style="color: gray;margin-right: 3pt" class="ace-icon fa fa-eye "></i>' .
                                                            '<span style="color: gray;margin-right: 3px;" >' . $row['c_num_click'] . '</span>' .
                                                            '<i style="color: gray;" class="ace-icon fa fa-gavel "></i>' .
                                                            '<span style="color: gray;margin-right: 3px;" >檢舉</span>' .
                                                            '<i style="margin-right: 2px" class="ace-icon glyphicon glyphicon-edit page-icon-edit "></i>' .
                                                            '<span style="color: #337ab7" >編輯</span>' .
                                                        '</div>';*/
                                            
                                            
                                            /////////
                                            
                                    }
                                    
                                    // '<ins class="adsbygoogle" style="display:inline-block;width:336px;height:280px" data-ad-client="ca-pub-3288794125825364" data-ad-slot="3503623539" data-ad-region="teepr" data-adsbygoogle-status="done"><ins id="aswift_6_expand" style="display:inline-table;border:none;height:280px;margin:0;padding:0;position:relative;visibility:visible;width:336px;background-color:transparent"><ins id="aswift_6_anchor" style="display:block;border:none;height:280px;margin:0;padding:0;position:relative;visibility:visible;width:336px;background-color:transparent"><iframe width="336" height="280" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" onload="var i=this.id,s=window.google_iframe_oncopy,H=s&amp;&amp;s.handlers,h=H&amp;&amp;H[i],w=this.contentWindow,d;try{d=w.document}catch(e){}if(h&amp;&amp;d&amp;&amp;(!d.body||!d.body.firstChild)){if(h.call){setTimeout(h,0)}else if(h.match){try{h=s.upd(h,i)}catch(e){}w.location.replace(h)}}" id="aswift_6" name="aswift_6" style="left:0;position:absolute;top:0;"></iframe></ins></ins></ins>';
                                    
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
