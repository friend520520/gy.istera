<?php 
        include("config.php");
        include("global.php");
                
        date_default_timezone_set('Asia/Taipei');
        
        $date = date('Y-m-d');
        $w = date('Y-W');
        $m = date('Y-m');
        
        try
        {
                    $callback = array( "day" => array() , "week" => array() , "month" => array() , "whole" => array() );
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $sub = $_REQUEST['sub'];
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $sub_str = ( $sub === "0" ) ? "" : " AND category_id=" . $sub;
                            $class_str = ( $sub === "0" ) ? "" : " AND class=" . $sub;
                            
                            $click_num = get_sql( $con , "click_num" , "date='$date'$sub_str ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                            
                            if( $click_num["0"]["page_id"] !== "" )
                            foreach ($click_num as $key => $value) {
                                    
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE page_id=" . $value['page_id'] );

                                    if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {
                                                    
                                                    $channel = get_sql( $con , "channel" , "channel_id=" . $row['channel_id'] , array( "ch_name" ) );
                                                    
                                                    $callback["day"][] = array( "page_id" => $row['page_id'] , 
                                                                                "title" => $row['title'] , 
                                                                                "article_icon" => $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] ,
                                                                                "channel_id" => $row['channel_id'] ,
                                                                                "channel_name" => $channel["0"]["ch_name"] ,
                                                                                'num_click' => $row["c_num_click"] ,
                                                                                'share_num' => $row['share_num'] );
                                                    
                                            }

                                    } else {
                                            
                                    }

                            }

                            $click_num = get_sql( $con , "click_num_w" , "w='$w'$sub_str ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                            
                            if( $click_num["0"]["page_id"] !== "" )
                            foreach ($click_num as $key => $value) {
                                    
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE page_id=" . $value['page_id'] );

                                    if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {
                                                    
                                                    $channel = get_sql( $con , "channel" , "channel_id=" . $row['channel_id'] , array( "ch_name" ) );
                                                    
                                                    $callback["week"][] = array( "page_id" => $row['page_id'] , 
                                                                                "title" => $row['title'] , 
                                                                                "article_icon" => $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] ,
                                                                                "channel_id" => $row['channel_id'] ,
                                                                                "channel_name" => $channel["0"]["ch_name"] ,
                                                                                'num_click' => $row["c_num_click"] ,
                                                                                'share_num' => $row['share_num'] );

                                            }

                                    } else {
                                            
                                    }

                            }
                            
                            $click_num = get_sql( $con , "click_num_m" , "m='$m'$sub_str ORDER BY c_num_click DESC LIMIT $_page, $page_num" , array( "page_id" ) );
                            
                            if( $click_num["0"]["page_id"] !== "" )
                            foreach ($click_num as $key => $value) {
                                    
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE page_id=" . $value['page_id'] );

                                    if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {
                                                    
                                                    $channel = get_sql( $con , "channel" , "channel_id=" . $row['channel_id'] , array( "ch_name" ) );
                                                    
                                                    $callback["month"][] = array( "page_id" => $row['page_id'] , 
                                                                                "title" => $row['title'] , 
                                                                                "article_icon" => $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] ,
                                                                                "channel_id" => $row['channel_id'] ,
                                                                                "channel_name" => $channel["0"]["ch_name"] ,
                                                                                'num_click' => $row["c_num_click"] ,
                                                                                'share_num' => $row['share_num'] );

                                            }

                                    } else {
                                            
                                    }

                            }
                            
                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'$class_str ORDER BY c_num_click DESC LIMIT $_page, $page_num");
                            
                            if ( mysqli_num_rows($result) > 0) {

                                    while($row = mysqli_fetch_array($result)) {

                                            $channel = get_sql( $con , "channel" , "channel_id=" . $row['channel_id'] , array( "ch_name" ) );

                                            $callback["whole"][] = array( "page_id" => $row['page_id'] ,
                                                                        "title" => $row['title'] , 
                                                                        "article_icon" => $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] ,
                                                                        "channel_id" => $row['channel_id'] ,
                                                                        "channel_name" => $channel["0"]["ch_name"] ,
                                                                        'num_click' => $row["c_num_click"] ,
                                                                        'share_num' => $row['share_num'] );

                                    }

                            } else {

                            }
                            
                            
                            echo json_encode($callback);
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>
