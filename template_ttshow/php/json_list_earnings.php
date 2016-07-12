<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $email = $_REQUEST['user'];
                    
                    
                    //SELECT * FROM articles 
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $result = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                            
                                            $subscribe_num = get_sql( $con , "subscribe" , "user_id=" . $row['user_id'] , array( "user_id" ) );
                                            $subscribe_num = $subscribe_num[0]["user_id"] === "" ? 0 : count( $subscribe_num );

                                            $subscribed_num = get_sql( $con , "subscribe" , "channel_id=" . $row['user_id'] , array( "user_id" ) );
                                            $subscribed_num = $subscribed_num === "" ? 0 : count( $subscribed_num );
                                            
                                            $page_num = get_sql( $con , "page" , "user_id='" . $row['user_id'] . "'" , array( "page_id" ) );
                                            $page_num = $page_num === "" ? 0 : count( $page_num );
                                            
                                            $author = get_sql( $con , "page" , "user_id='" . $row['user_id'] . "'" , array( "c_num_click" ) );
                                            $c_num_click = 0;

                                            if( $author !== "" )
                                            foreach ($author as $key => $value) {
                                                $c_num_click += (int)$value["c_num_click"];
                                            }
                                            
                                            $callback = array(
                                                        "username" => urlencode( $row['user_name'] ) ,
                                                        "usericon" => $row['usericon'] ,
                                                        "follows" => $subscribe_num ,
                                                        "following" => $subscribed_num ,
                                                        "comments" => $page_num ,
                                                        "pageviews" => $c_num_click
                                                                );
                                            
                                                            
                                    }
                                    // '<ins class="adsbygoogle" style="display:inline-block;width:336px;height:280px" data-ad-client="ca-pub-3288794125825364" data-ad-slot="3503623539" data-ad-region="teepr" data-adsbygoogle-status="done"><ins id="aswift_6_expand" style="display:inline-table;border:none;height:280px;margin:0;padding:0;position:relative;visibility:visible;width:336px;background-color:transparent"><ins id="aswift_6_anchor" style="display:block;border:none;height:280px;margin:0;padding:0;position:relative;visibility:visible;width:336px;background-color:transparent"><iframe width="336" height="280" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" onload="var i=this.id,s=window.google_iframe_oncopy,H=s&amp;&amp;s.handlers,h=H&amp;&amp;H[i],w=this.contentWindow,d;try{d=w.document}catch(e){}if(h&amp;&amp;d&amp;&amp;(!d.body||!d.body.firstChild)){if(h.call){setTimeout(h,0)}else if(h.match){try{h=s.upd(h,i)}catch(e){}w.location.replace(h)}}" id="aswift_6" name="aswift_6" style="left:0;position:absolute;top:0;"></iframe></ins></ins></ins>';
                                    
                                    echo urldecode( json_encode( $callback ) );
                                    
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