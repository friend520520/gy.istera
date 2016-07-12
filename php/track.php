<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_my_channel":
        $echo = get_my_channel();
        break;
    case "track":
        $echo = track();
        break;
}

echo json_encode($echo);

function get_my_channel(){
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $data = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $channel = get_sql( $con ,
                            "channel as ch join track as t on t.t_ch_id = ch.ch_id" , 
                            "where t.t_a_id='".$account[0]['a_id']."' Order by t.t_id DESC" );
                    if( $channel ){
                            foreach ($channel as $key => $value) {
                                    switch ($value["ch_category"]) {
                                        case "1":
                                            $cate_name = "時事熱議";
                                        break;
                                        case "2":
                                            $cate_name = "正妹美女";
                                        break;
                                        case "3":
                                            $cate_name = "五花八門";
                                        break;
                                        case "4":
                                            $cate_name = "新奇搞笑";
                                        break;
                                        case "5":
                                            $cate_name = "娛樂八卦";
                                        break;
                                        case "6":
                                            $cate_name = "運動體育";
                                        break;
                                        case "7":
                                            $cate_name = "電影情報";
                                        break;
                                        case "8":
                                            $cate_name = "寵物聯盟";
                                        break;
                                        default:
                                            $cate_name = "無";
                                        break;
                                    }
                                    $data[] = array(  "ch_id" => $value["ch_id"] ,
                                                      "ch_name" => $value["ch_name"] ,
                                                      "ch_icon" => http_channel_path.$value["ch_id"]."/".$value["ch_icon"] ,
                                                      "ch_introduce" => $value["ch_introduce"] ,
                                                      "ch_category" => $value["ch_category"] ,
                                                      "cate_name" => $cate_name );
                            }
                            
                            $callback['data'] = $data;
                            $callback['success'] = true;
                    }
                    else {
                            $callback['data'] = array();
                            $callback['success'] = true;
                    }
                    
                             
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                }
                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function track(){
        $callback = array();
        try{
                if( check_empty( array( "token","ch","action" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $ch_id = $_REQUEST[ "ch" ];
                    $action = $_REQUEST[ "action" ];
                    $data = array();
                    if( !in_array($action, array("track","cancel")) ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $channel = get_sql( $con , "channel" ,"where ch_id=$ch_id" );
                    if( !$channel ) {
                            $callback['msg'] = "頻道不存在";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $track = get_sql( $con , "track" ,"where t_a_id='".$account[0]['a_id']."' AND t_ch_id=$ch_id" );
                    
                    if( $track ){
                            if( $action === "track" ){
                                    $callback['data'] = "already";
                                    $callback['success'] = true;
                            }
                            else if( $action === "cancel" ){
                                    $cmd = "DELETE FROM track WHERE t_id=" . $track[0]["t_id"];
                                    if( mysqli_query($con, $cmd) ){
                                            $callback['data'] = "yet";
                                            $callback['success'] = true;
                                    }
                                    else{
                                            $callback['msg'] = "取消收藏錯誤";
                                            $callback['success'] = false;
                                    }
                            }
                    }
                    else {
                            if( $action === "track" ){
                                    if( insert_sql($con, "track", array( "t_a_id" => $account[0]['a_id'] , "t_ch_id" => (int)$ch_id )) ){
                                            $callback['data'] = "already";
                                            $callback['success'] = true;
                                    }
                                    else{
                                            $callback['msg'] = "收藏失敗";
                                            $callback['success'] = false;
                                    }
                                        
                            }
                            else if( $action === "cancel" ){
                                    $callback['data'] = "yet";
                                    $callback['success'] = true;
                            }
                    }
                             
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                }
                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

?>
