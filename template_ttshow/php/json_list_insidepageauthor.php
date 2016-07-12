<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $email = $_REQUEST['user'];
                    $page = $_REQUEST['page'];
                    $callback = "";
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND page_id='$page'");
                            
                            if ( mysqli_num_rows($result) > 0) {
                            
                                    while($row = mysqli_fetch_array($result)) {
                                                
                                                //$author = get_sql( $con , "user" , "user_id='" . $row['user_id'] . "'" , array( "user_name" , "usericon" , "business" ) );
                                                
                                                $channel = get_sql( $con , "channel" , "channel_id=" . $row['channel_id'] , array( "ch_name" , "ch_icon" , "ch_type" , "ch_introduce" ) );
                                                
                                                if( $email === "" )
                                                {
                                                        //$subscribe = '<button style="padding: 0px 13px;border-radius: 3px" class="btn btn-sm btn-primary subscribe" channel="' . $row['channel_id'] . '">訂閱</button>';
                                                        $subscribe = 0;
                                                        $edit = false;
                                                }
                                                else
                                                {
                                                        
                                                        $user1 = get_sql( $con , "user" , "email='" . $email . "'" , array( "user_id" , "usertype" ) );
                                                        $subscribe = get_sql_array( $con , " subscribe" , "user_id=" . $user1[0]["user_id"] , array( "channel_id" ) );
                                                        
                                                        if( in_array( $row['channel_id'] , $subscribe ) )
                                                                $subscribe = 1;
                                                            //$subscribe = '<button style="padding: 0px 13px;border-radius: 3px" class="btn btn-sm btn-primary subscribe already" channel="' . $row['channel_id'] . '">已訂閱</button>';
                                                        else 
                                                                $subscribe = 2;
                                                            //$subscribe = '<button style="padding: 0px 13px;border-radius: 3px" class="btn btn-sm btn-primary subscribe" channel="' . $row['channel_id'] . '">訂閱</button>';
                                                        if( $user1[0]["usertype"] === "root" || $user1[0]["usertype"] === "boss" )
                                                            $edit = true;
                                                        else {
                                                            $edit = get_sql2($con, "channel_group", "channel_id=" . $row['channel_id'] . " AND user_id=" . $user1[0]["user_id"] , array( "id" ));
                                                            $edit = ( $edit ) ? true : false;
                                                        }
                                                        
                                                        
                                                }
                                                
                                                
                                                $board = get_sql2($con, "board", "page_id=$page", array( "user_id" , "text" , "date" , "id" ) );
                                                if( $board ) {
                                                    foreach ($board as $key => $value) {

                                                            $user_info = get_sql($con, "user", "user_id=" . $value['user_id'], array( "user_name" , "usericon" ) );
                                                            $board[$key]['user_name'] = $user_info[0]['user_name'];
                                                            $board[$key]['usericon'] = $user_info[0]['usericon'];

                                                    }
                                                }
                                                
                                                /////////
                                                $callback = array( "channel_id" => $row['channel_id'] ,
                                                                   "ch_icon" => $channel[0]['ch_icon'] ,
                                                                   "ch_name" => $channel[0]['ch_name'] ,
                                                                   "ch_type" => $channel[0]['ch_type'] ,
                                                                   "subscribe" => $subscribe ,
                                                                   "ch_introduce" => $channel[0]['ch_introduce'] ,
                                                                   "board" => $board ,
                                                                   "edit" => $edit );
                                                
                                                       
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
