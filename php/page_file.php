<?php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "file_detail_list":
        $echo = file_detail_list();
        break;
    case "history_detail_list":
        $echo = history_detail_list();
        break;
    case "my_history_detail_list":
        $echo = my_history_detail_list();
        break;
}

echo json_encode($echo);

function file_detail_list(){
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
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $page_file_history = get_sql_array($con
                                            , "page_file as pf join account as a join page as p join channel as ch on p.page_id = pf.pf_page_id AND ch.ch_id=p.p_channel_id AND ch.ch_user_id=a.a_id"
                                            , array( "a_id" , "a_nickname" , "page_id" , "p_title" , "p_channel_id" , "pf_des" , "pf_date" , "pf_id" ));

                    if( $page_file_history ){
                            
                            $callback['data'] = $page_file_history;
                            $callback['success'] = true;
                    }
                    else{
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

function history_detail_list(){
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
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $page_file_history = get_sql_array($con
                                            , "page_file_history as pfh join page_file as pf join account as a join page as p on pfh.pfh_pf_id = pf.pf_id AND a.a_id=pfh.pfh_a_id AND p.page_id = pf.pf_page_id"
                                            , array( "a_id" , "a_nickname" , "pfh_a_id" , "pfh_id" , "pfh_date" , "page_id" , "p_title" , "p_channel_id" ));

                    if( $page_file_history ){
                            foreach ($page_file_history as $key => $value) {
                                    $author = get_sql($con, "account as a join channel as ch on ch.ch_user_id=a.a_id" , "WHERE ch.ch_id='".$value['p_channel_id']."'");
                                    if( $author ){
                                            $page_file_history[$key]["author_id"] = $author[0]["a_id"];
                                            $page_file_history[$key]["author_name"] = $author[0]["a_nickname"];
                                    }
                            }
                            
                            $callback['data'] = $page_file_history;
                            $callback['success'] = true;
                    }
                    else{
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

function my_history_detail_list(){
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
                    
                    $page_file_history = get_sql_array($con
                                            , "page_file_history as pfh join page_file as pf join page as p join channel as ch join account as a on pfh.pfh_pf_id = pf.pf_id AND p.page_id = pf.pf_page_id AND p.p_channel_id=ch.ch_id AND ch.ch_user_id=a.a_id"
                                            , array( "pfh_a_id" , "pfh_id" , "pfh_date" , "page_id" , "p_title" , "p_channel_id" , "pf_id" , "a_id" , "a_nickname" )
                                            , "WHERE pfh.pfh_a_id='".$account[0]["a_id"]."' order by pfh.pfh_date DESC" );
                    
                    if( $page_file_history ){
                            foreach ($page_file_history as $key => $value) {
                                    $page_file_history[$key]["my_id"] = $account[0]["a_id"];
                                    $page_file_history[$key]["my_nickname"] = $account[0]["a_nickname"];
                                    
                                    /*$author = get_sql($con, "account as a join channel as ch on ch.ch_user_id=a.a_id" , "WHERE ch.ch_id='".$value['p_channel_id']."'");
                                    if( $author ){
                                            $page_file_history[$key]["author_id"] = $author[0]["a_id"];
                                            $page_file_history[$key]["author_name"] = $author[0]["a_nickname"];
                                    }*/
                            }
                            
                            $callback['data'] = $page_file_history;
                            $callback['success'] = true;
                    }
                    else{
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

?>
