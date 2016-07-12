<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $fbuser = $_REQUEST['user'];
                    $callback = "";
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

                            if( $fbuser === "" )
                            {
                                    echo "false";
                            }
                            else
                            {

                                    $user1 = get_sql( $con , "user" , "facebook_mail='" . $fbuser . "'" , array( "user_id" ) );
                                    $subscribe = get_sql_array( $con , " subscribe" , "user_id=" . $user1[0]["user_id"] . " LIMIT $_page, $page_num" , array( "channel_id" ) );
                                    
                                    if( empty( $subscribe ) )
                                    {
                                            echo "false";
                                    }
                                    else
                                    {
                                            foreach ($subscribe as $key => $value) {
                                                    
                                                    $channel = get_sql( $con , "channel" , "channel_id=" . $value , array( "ch_icon" , "ch_type" , "ch_name" ) );
                                                    
                                                    $page = get_sql( $con , "page" , "channel_id=" . $value , array( "c_num_click" ) );
                                                    $c_num_click = 0;

                                                    if( $page !== "" )
                                                    foreach ($page as $key2 => $value2) {
                                                        $c_num_click += (int)$value2["c_num_click"];
                                                    }
                                                    
                                                    $subscribe_num = get_sql( $con , "subscribe" , "channel_id=" . $value , array( "user_id" ) );
                                                    $subscribe_num = $subscribe_num[0]["user_id"] === "" ? 0 : count( $subscribe_num );
                                                    
                                                    /////////
                                                    $callback .= '<div class="panel-body1 col-xs-12 col-sm-12 col-md-6 col-lg-4" style="padding: 10px 20px;">' .
                                                                        '<div class="clearfix" style="margin-bottom: 10px"></div>' .
                                                                        '<div class="panel-float-left">' .
                                                                          '<img src="' . $channel[0]["ch_icon"] . '" style="width: 50px; height: 50px;">' .
                                                                          '<br>' .
                                                                        '</div>' .
                                                                        '<div class="panel-float-left">' .
                                                                          '<a style="margin-left: 12px; font-size: 11pt;">' . $channel[0]["ch_name"] . '</a>' .// href="cooperate.php?ch=' . $value . '"BOHAN0717
                                                                        '</div>' .
                                                                        '<span class="panel-title panel-float-left" style="font-size: 10pt">' . $channel[0]["ch_type"] . '</span>' .
                                                                        '<button style="padding: 0px 13px; border-radius: 3px; margin-top: 18px;" class="btn btn-sm btn-primary panel-float-right subscribe already" channel="' . $value . '">已訂閱</button>' .
                                                                        '<br>' .
                                                                        '<div class="panel-float-left" style="color: gray; position: absolute; left: 80px; top: 38px;">訂閱數</div>' .
                                                                        '<div style="position: absolute; color: gray; top: 38px; left: 140px;">' . $subscribe_num . '</div>' .
                                                                        '<div class="panel-float-left" style="position: absolute; color: gray; left: 80px; top: 55px;">總瀏覽數</div>' .
                                                                        '<div class="panel-float-left" style="position: absolute; color: gray; left: 140px; top: 55px;">' . $c_num_click . '</div>' .
                                                                        '<div class="clearfix"></div>' .
                                                                        '<hr style="margin-top: 25px;margin-bottom: 0">' .
                                                                '</div>';
                                            }
                                            
                                            echo $callback;
                                            
                                    }
                                    
                            }
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>