<?php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_homepage":
        $echo = get_homepage();
        break;
}

echo json_encode($echo);

function get_homepage(){
        $callback = array();
        try{
                
                $data = array();

                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $data = array();
                //最新發表++
                $new_page = get_sql_array( $con ,
                        "page as p join category as c on p.p_category_id = c.cate_id" , 
                        array( "page_id" , "p_title" , "cate_name" , "cate_color" , "p_icon" , "p_pre_html" ) ,
                        "WHERE p.p_display='block' order by p_date desc limit 13" );
                $data["new_page"] = $new_page ? $new_page : array();
                //最新發表--
                //before day hot pages
                date_default_timezone_set('Asia/Taipei');
                $last_day = date('Y-m-d',strtotime("yesterday"));
                $last_hot_page = get_sql_array( $con , "page as p join page_click_num_d as cli join category as c on p.page_id=cli.clid_page_id AND p.p_category_id = c.cate_id"
                                            , array( "page_id" , "p_title" , "cate_name" , "cate_color" )
                                            , "WHERE p.p_display='block' AND cli.clid_date='$last_day' order by cli.clid_click_num DESC limit 13" );
                $data["last_hot_page"] = $last_hot_page ? $last_hot_page : array();
                //before day hot pages
                //本周熱門++
                $w = date('Y-W');
                $this_week_hot_page = get_sql_array( $con , "page as p join page_click_num_w as cli join category as c on p.page_id=cli.cliw_page_id AND p.p_category_id = c.cate_id"
                                            , array( "page_id" , "p_title" , "cate_name" , "cate_color" )
                                            , "WHERE p.p_display='block' AND cli.cliw_w='$w' order by cli.cliw_click_num DESC limit 13" );
                $data["this_week_hot_page"] = $this_week_hot_page ? $this_week_hot_page : array();
                //本周熱門--
                //本周人氣++
                $w = date('Y-W');
                $this_week_hot_ch = get_sql_array( $con , "channel_click_num_w as cc join channel as c on cc.ch_cliw_channel_id=c.ch_id"
                                            , array( "ch_id" , "ch_icon" , "ch_name" , "ch_cliw_click_num" )
                                            , "WHERE cc.ch_cliw_w='$w' order by cc.ch_cliw_click_num DESC limit 10" );
                $data["this_week_hot_ch"] = $this_week_hot_ch ? $this_week_hot_ch : array();
                //本周人氣--
                //本周活耀++
                $this_week_activity_ch = get_sql_array( $con , "channel_post_num_w as cp join channel as c on cp.ch_postw_channel_id=c.ch_id"
                                            , array( "ch_id" , "ch_icon" , "ch_name" , "ch_postw_num" )
                                            , "WHERE cp.ch_postw_w='$w' order by cp.ch_postw_num DESC limit 10" );
                $data["this_week_activity_ch"] = $this_week_activity_ch ? $this_week_activity_ch : array();
                //本周活耀--
                //原創文章++從今天算起一個禮拜內的熱門點擊
                $last_week = date('Y-m-d',strtotime("-6 day"));
                $originality_page = get_sql_array( $con , "page as p join page_click_num_d as pcd on p.page_id = pcd.clid_page_id"
                                            , array( "page_id" , "p_title" , "p_icon" , "SUM(clid_click_num)" )
                                            , "WHERE pcd.clid_date >= '$last_week' AND p.p_display='block' AND p.p_originality=1 group by pcd.clid_page_id order by SUM(pcd.clid_click_num) DESC limit 12" 
                                            , "*,SUM(clid_click_num)");
                $data["originality_page"] = $originality_page ? $originality_page : array();
                //原創文章--
                //所有頻道依頻道分類顯示++
                $channel = array();
                for ($i = 1; $i <= 8; $i++) {
                    $channel_tmp = get_sql_array( $con , "channel"
                                                , array( "ch_id" , "ch_icon" , "ch_name" )
                                                , "WHERE ch_category=$i order by ch_registration_time DESC limit 12" );
                    $channel[] = $channel_tmp ? $channel_tmp : array();
                }
                $data["channel"] = $channel;
                //所有頻道依頻道分類顯示--
                
                
                $callback['data'] = $data;
                $callback['success'] = true;
                
                mysqli_close($con);

                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

?>
