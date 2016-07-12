<?php 
        include("config.php");
        include( "global.php" );
                
        try
        {
                    $user = $_REQUEST['user'];
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
                            
                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'");
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                                
                                                if( $user === "" )
                                                {
                                                        $collect = '';
                                                }
                                                else
                                                {
                                                        //echo $row['page_id'] . " ";
                                                    
                                                        $user1 = get_sql( $con , "user" , "email='" . $user . "'" , array( "user_id" ) );
                                                        $collect = get_sql_array( $con , " collect" , "user_id='" . $user1[0]["user_id"] . "' LIMIT $_page, $page_num" , array( "page_id" ) );
                                                        
                                                        
                                                        if( in_array( $row['page_id'] , $collect ) )
                                                        {
                                                                
                                                                $callback[] = create_json2( $con , $user , $row );
                                                                
                                                        }
                                                        
                                                }
                                                          
                                    }
                                    // '<ins class="adsbygoogle" style="display:inline-block;width:336px;height:280px" data-ad-client="ca-pub-3288794125825364" data-ad-slot="3503623539" data-ad-region="teepr" data-adsbygoogle-status="done"><ins id="aswift_6_expand" style="display:inline-table;border:none;height:280px;margin:0;padding:0;position:relative;visibility:visible;width:336px;background-color:transparent"><ins id="aswift_6_anchor" style="display:block;border:none;height:280px;margin:0;padding:0;position:relative;visibility:visible;width:336px;background-color:transparent"><iframe width="336" height="280" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" onload="var i=this.id,s=window.google_iframe_oncopy,H=s&amp;&amp;s.handlers,h=H&amp;&amp;H[i],w=this.contentWindow,d;try{d=w.document}catch(e){}if(h&amp;&amp;d&amp;&amp;(!d.body||!d.body.firstChild)){if(h.call){setTimeout(h,0)}else if(h.match){try{h=s.upd(h,i)}catch(e){}w.location.replace(h)}}" id="aswift_6" name="aswift_6" style="left:0;position:absolute;top:0;"></iframe></ins></ins></ins>';
                                    $callback = ( empty( $callback ) ) ? "false" : json_encode( $callback );
                                    
                                    echo $callback;
                                    
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