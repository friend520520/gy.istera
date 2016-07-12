<?php
	include 'account_event.php';	
        /*
        * @file json_mg_account.php
        * @brief TABLE:account

        * detail 

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-18 */

        define('TABLE_ACCOUNT', 'account');
        define('TABLE_ACCOUNT_SEARCH', 'account_search');
        
        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "fn_btn_search_regex":
                $echo = fn_btn_search_regex();
                break;
            case "fn_btn_delete":
                $echo = fn_btn_delete();
                break;
            case "fn_list_management_account_single_dialogue":
                $echo = fn_list_management_account_single_dialogue();
                break;
            case "fn_list_account_kind_single_dialogue":
                $echo = fn_list_account_kind_single_dialogue();
                break;
            case "fn_btn_update_management_account_single_profile":
                $echo = fn_btn_update_management_account_single_profile();
                break;
            case "fn_btn_search_condition_query":
                $echo = fn_btn_search_condition_query();
                break;
            case "fn_btn_account_paused":
                $echo = fn_btn_account_paused();
                break;
            case "fn_btn_pause_account":
                $echo = fn_btn_pause_account();
                break;
            case "fn_btn_checkbox_pause_account":
                $echo = fn_btn_checkbox_pause_account();
                break;
            case "fn_btn_checkbox_continue_account":
                $echo = fn_btn_checkbox_continue_account();
                break;
        }
        
    
    function fn_btn_search_regex(){
        
        try{    
                $callback = array();
                $cart = array();
                
                $operation_html_block = empty($_REQUEST[ "operation_html_block" ]) ? "" : $_REQUEST["operation_html_block"];
                $operation_html_blockade = empty($_REQUEST[ "operation_html_blockade" ]) ? "" : $_REQUEST["operation_html_blockade"];
                /*
                if( !check_empty( array("token" ) ) ) {
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $token = md5( $_REQUEST[ "token" ] );*/
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                date_default_timezone_set('Asia/Taipei');
                /*
                $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                if( $account[0]['a_admin'] !== "true" ){
                        $callback['msg'] = "you dont have admin";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }*/
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                        $this_month = date('Y-m', strtotime('this month') );
                        
                        $res = mysqli_query($con, "SELECT a.a_id, a.a_email, a.a_admin, a.a_lastlogin_ip, a.a_nickname `a_nickname1`, a2.a_nickname `a_nickname2`, COUNT(a3.a_id) `count_children`, a4.count_children_this_month, a.a_registration_time, a.a_last_login_time, a.a_state "
                                                . "FROM account as a "
                                                . "left join account as a2 on a.a_parent = a2.a_id "
                                                . "left join account as a3 on a.a_id = a3.a_parent "
                                                . "left join (SELECT COUNT(a_child.a_id) 'count_children_this_month', a_child.a_parent FROM account as a_child LEFT JOIN account as a_parent on a_parent.a_id = a_child.a_parent WHERE DATE_FORMAT(a_child.a_registration_time,'%Y-%m') like '".$this_month."%' AND a_parent.a_id = a_child.a_parent) as a4 on a.a_id = a4.a_parent "
                                                . "GROUP BY a.a_id "
                                                . "ORDER BY a.a_last_login_time DESC");
                        
                        /*
                        $res = mysqli_query($con, "SELECT a.a_delete, a.a_id, a.a_email, a.a_admin, a.a_lastlogin_ip, a.a_nickname `a_nickname1`, ak.a_kind_name, a2.a_nickname `a_nickname2`, COUNT(a3.a_id) `count_children`, a4.count_children_this_month, ap.a_total, a.a_registration_time, a.a_last_login_time, ap.a_franchisee, a.a_state, ch_p_pcnm.sum_click "
                                                        . "FROM account as a "
                                                        . "left join account as a2 on a.a_parent = a2.a_id "
                                                        . "left join account as a3 on a.a_id = a3.a_parent "
                                                        . "left join (SELECT COUNT(a_child.a_id) 'count_children_this_month', a_child.a_parent FROM account as a_child LEFT JOIN account as a_parent on a_parent.a_id = a_child.a_parent WHERE DATE_FORMAT(a_child.a_registration_time,'%Y-%m') like '".$this_month."%' AND a_parent.a_id = a_child.a_parent) as a4 on a.a_id = a4.a_parent "
                                                        . "left join account_profile as ap on a.a_id = ap.a_id "
                                                        . "left join account_kind as ak on ap.a_kind = ak.a_kind "
                                                        . "left join (SELECT SUM(pcnm.clim_click_num) 'sum_click', ch.ch_user_id FROM channel as ch left join page as p on p.p_channel_id = ch.ch_id left join page_click_num_m as pcnm on p.page_id = pcnm.clim_page_id WHERE pcnm.clim_m='$this_month' GROUP BY ch.ch_user_id) as ch_p_pcnm on ch_p_pcnm.ch_user_id = a.a_id "
                                                        . "WHERE a.a_delete='block' "
                                                        . "GROUP BY a.a_id "
                                                        . "ORDER BY a.a_last_login_time DESC");*/
                        
                        if (mysqli_num_rows($res) > 0) {
                                
                                while($row = mysqli_fetch_array($res)) {
                                                $a_state = ($row['a_state'] == 'block') ? '啟用':'停用';
                                                $a_admin = ($row['a_admin'] == 'true') ? '管理者':'一般會員';
                                                
                                                $a_registration_time = date('Y-m-d',  strtotime($row['a_registration_time']));
                                                $a_last_login_time = date('Y-m-d',  strtotime($row['a_last_login_time']));
                                                
                                                $count_children = $row['count_children'];
                                                $count_children_this_month = ((int)$row['count_children_this_month'] > 0)? (int)$row['count_children_this_month']-1: 0 ;
                                                
                                                
                                                $cart[] = array(
                                                    "0" => $row['a_id'],
                                                    "1" => $row['a_email'] . "<br>" . $row['a_nickname1'],
                                                    "2" => $a_admin,
                                                    "3" => $row['a_nickname2'],
                                                    "4" => $count_children . " / " . $count_children_this_month,
                                                    "5" => $a_last_login_time . "<br>" . $a_registration_time,
                                                    "6" => ($row['a_admin']=="true")? "是":"否",
                                                    "7" => $row['a_lastlogin_ip'],
                                                    "8" => $a_state,
                                                    "9" => ($row['a_state']=='block'?$operation_html_block:$operation_html_blockade)
                                                );
                                                /*
                                                $cart[] = array(
                                                    "0" => $row['a_id'],
                                                    "1" => $row['a_email'].'<br>'.$row['a_nickname1'],
                                                    "2" => $a_admin,
                                                    "3" => $row['a_nickname2'],
                                                    "4" => $row['a_id'],
                                                    "5" => $row['a_id'],
                                                    "6" => $row['a_id'],
                                                    "7" => $row['a_id'],
                                                    "8" => $row['a_id'],
                                                    "9" => $row['a_id'],
                                                    "10" => $row['a_id'],
                                                    //"11" => ($row['a_state']=='block'?$operation_html_block:$operation_html_blockade)
                                                );*/
                                        
                                }


                                $callback['data'] =  $cart;

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
        
        echo json_encode($callback);
    }
    
    function fn_btn_delete(){
            $callback = array();
            try{
                    if( check_empty( array( "token","a_id" ) ) ) {

                        $token = md5( $_REQUEST[ "token" ] );
                        $a_id = $_REQUEST[ "a_id" ];

                        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        $con->query("SET NAMES utf8");
                        // Check connection
                        if (mysqli_connect_errno()) {
                                $callback['msg'] = "SQL connect fail";
                                $callback['success'] = false;
                                echo json_encode($callback);
                                return;
                        }

                        $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }
                        if( $account[0]['a_admin'] !== "true" ){
                                $callback['msg'] = "you dont have admin";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }

                        $member = get_sql($con, TABLE_ACCOUNT, "WHERE a_id = '$a_id'");
                        if( !$member ){
                                $callback['msg'] = "member is not exist";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }

                        if(mysqli_query($con, "UPDATE account SET a_delete='blockade', a_state='blockade' WHERE a_id='$a_id'") ){
                                $callback['success'] = true;
                        }
                        else{
                                $callback['msg'] = "修改失敗";
                                $callback['success'] = false;
                        }

                        mysqli_close($con);
                    }
                    else {
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                    }

            }
            catch (Exception $e)
            {
                    $callback['msg'] = $e;
                    $callback['success'] = false;
            }
            echo json_encode($callback);

    }

    function fn_list_management_account_single_dialogue(){
        try{
                if( check_empty( array( "token" , "a_id" ) ) ){
                        $token = md5( $_REQUEST[ "token" ] );
                        $a_id = $_REQUEST[ 'a_id' ];

                        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        $con->query("SET NAMES utf8");

                        $callback = array();
                        $cart = array();
                        
                        if (mysqli_connect_errno()) {
                                $callback['msg'] = "SQL connect fail";
                                $callback['success'] = false;
                                echo json_encode($callback);
                                return;
                        }
                                
                        $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }
                        
                        $res = mysqli_query($con, "SELECT *, a2.a_nickname `a_nickname2` FROM account as a LEFT JOIN account as a2 on a.a_parent=a2.a_id WHERE a.a_id='$a_id'");
                        
                        while($row = mysqli_fetch_array($res)) {
                                $a_state = ($row['a_state'] == 'block') ? '啟用':'停用';
                                $a_admin = ($row['a_admin'] == 'true') ? '管理者':'一般會員';
                                $a_type = ($row['a_manager'] == 'true') ? 'manager':'normal';
                            
                                if($row['a_icon']){
                                    $a_icon = "./data/account/". $row['a_id'] ."/". $row["a_icon"];
                                } else {
                                    $a_icon = "";
                                }
                            
                                $cart = array( "a_id"       => $row["a_id"] ,
                                                "a_admin"       => $a_admin ,
                                                "a_type"       => $a_type ,
                                                "a_parent"       => $row["a_nickname2"] ,
                                                "a_state" => $a_state ,
                                                "a_email" => $row["a_email"] ,
                                                "a_icon" => $a_icon ,
                                                "a_nickname" => $row["a_nickname"] ,
                                                "a_country" => $row["a_country"] ,
                                                "a_eighteen" => $row["a_eighteen"] ,
                                                "a_phone" => $row["a_phone"] ,
                                                "a_skype" => $row["a_skype"] ,
                                                "a_payment_bank" => $row["a_payment_bank"] ,
                                                "a_payment_account" => $row["a_payment_account"] ,
                                                "a_payment_account_name" => $row["a_payment_account_name"] ,
                                                "a_bitcoin_address" => $row["a_bitcoin_address"] ,
                                                "a_url" => $row["a_url"] ,
                                                "a_limit_token" => $row["a_limit_token"] ,
                                                "a_token" => $row["a_token"] ,
                                                "a_forget_token" => $row["a_forget_token"] ,
                                                "a_forget_token_time" => $row["a_forget_token_time"] ,
                                                "a_email_confirm" => $row["a_email_confirm"] ,
                                                "a_registration_time" => $row["a_registration_time"] ,
                                                "a_last_login_time" => $row["a_last_login_time"] ,
                                                "a_lastlogin_device" => $row["a_lastlogin_device"] ,
                                                "a_lastlogin_browser" => $row["a_lastlogin_browser"] ,
                                                "a_lastlogin_ip" => $row["a_lastlogin_ip"] );
                        }

                        $callback['data'] =  $cart;
                        $callback['success'] = true;
                        
                        mysqli_close($con);

                        
                }
                else {
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function fn_list_account_kind_single_dialogue(){
        try{
                if( check_empty( array( "token" , "a_id" ) ) ){
                        $token = md5( $_REQUEST[ "token" ] );
                        $a_id = $_REQUEST[ 'a_id' ];

                        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        $con->query("SET NAMES utf8");

                        $callback = array();
                        $cart_franchisee = array();
                        $cart_kind = array();
                        
                        if (mysqli_connect_errno()) {
                                $callback['msg'] = "SQL connect fail";
                                $callback['success'] = false;
                                echo json_encode($callback);
                                return;
                        }
                                
                        $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }
                        
                        $res_franchisee = mysqli_query($con, "SELECT a_franchisee FROM account_kind GROUP BY a_franchisee");
                        
                        while($row = mysqli_fetch_array($res_franchisee)) {
                                
                                $cart_franchisee[] = array( "a_franchisee"        => $row["a_franchisee"]);
                        }
                        
                        $res_kind = mysqli_query($con, "SELECT a_kind, a_kind_name FROM account_kind WHERE a_kind=6 OR a_kind=7 OR a_kind=8  GROUP BY a_kind");
                        
                        while($row = mysqli_fetch_array($res_kind)) {
                                
                                $cart_kind[] = array( "a_kind"        => $row["a_kind"], 
                                                "a_kind_name"      => $row["a_kind_name"]);
                        }
                        
                        $account_a_kind = get_sql($con, 'account_profile', "WHERE a_id = '$a_id'");
                        $a_kind = $account_a_kind[0]['a_kind'];
                        
                        $callback['data_franchisee']   =  $cart_franchisee;
                        $callback['data_kind']   =  $cart_kind;
                        $callback['a_kind'] =  $a_kind;
                        $callback['success'] = true;
                        
                        mysqli_close($con);

                        
                }
                else {
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function fn_btn_update_management_account_single_profile(){
        try{
                //date_default_timezone_set('Asia/Taipei');
                
                $token = md5( $_REQUEST[ "token" ] );
                $a_id = $_REQUEST[ 'a_id' ];
		
		$a_admin = $_REQUEST[ 'a_admin' ];
		$a_type = $_REQUEST[ 'a_type' ];
                $a_email = $_REQUEST[ 'a_email' ];
                $a_nickname = $_REQUEST[ 'a_nickname' ];
                $a_country = $_REQUEST[ 'a_country' ];
                $a_phone = $_REQUEST[ 'a_phone' ];
                $a_skype = $_REQUEST[ 'a_skype' ];
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                
                $callback = array();
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                                
                $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                
                $a_manager = $a_type=="manager"?"true":"false";
                    
                $sql_cmd = "UPDATE " .TABLE_ACCOUNT. " SET 
                                    a_admin='$a_admin',
                                    a_manager='$a_manager',
                                    a_email='$a_email',
                                    a_nickname='$a_nickname',
                                    a_country='$a_country',
                                    a_phone='$a_phone',
                                    a_skype='$a_skype'
                                    WHERE a_id='$a_id'";

                        if( mysqli_query($con, $sql_cmd) ) {
                                $callback['success'] = true;
                        }
                        else {
                                $callback['msg'] = "UPDATE fail";
                                $callback['success'] = false;
                        }
                        
                        mysqli_close($con);
                     
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function fn_btn_update_account_kind_single_profile(){
        try{
                //date_default_timezone_set('Asia/Taipei');
                
                $token = md5( $_REQUEST[ "token" ] );
                $a_id = $_REQUEST[ 'a_id' ];

                $a_kind = $_REQUEST[ 'a_kind' ];
                
                //$b_date = date('Y-m-d H:i:s');
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                
                $callback = array();
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                                
                $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                    
                $sql_cmd = "UPDATE account_profile SET a_kind=$a_kind WHERE a_id='$a_id'";

                        if( mysqli_query($con, $sql_cmd) ) {
                                $callback['success'] = true;
                        }
                        else {
                                $callback['msg'] = "UPDATE fail";
                                $callback['success'] = false;
                        }
                        
                        mysqli_close($con);
                     
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
    
    function fn_btn_search_condition_query(){
    try
    {       
            $search_cmd = $_REQUEST[ 'search_cmd' ];
            $search_cmd = json_decode($search_cmd,true);
            
            $i = 0;
            $cart = array();
            $callback = array();
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            // Check connection
            if (mysqli_connect_errno()) {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    echo json_encode($callback);
                    return;
            }
            /*點選 搜尋快捷鍵 進入SQL搜尋data*/
            foreach ($search_cmd as $key => $value) {
                    if( $key== 0){
                        foreach ($value as $key2 => $value2) {
                            if( $key2 == 'a_points' || $key2 == 'a_vitality' || $key2 == 'a_limit_token'){
                                $condition = (string)$key2 .' LIKE '. '%'.$value2.'%';
                            } else {
                                $condition = (string)$key2 .' LIKE '. '\'%'.$value2.'%\'';
                            }
                        }
                    } else {
                        foreach ($value as $key2 => $value2) {
                            if( $key2 == 'a_points' || $key2 == 'a_vitality' || $key2 == 'a_limit_token'){
                                $condition .= ' AND ' . (string)$key2 .' LIKE '. '%'.$value2.'%';
                            } else {
                                $condition .= ' AND ' . (string)$key2 .' LIKE '. '\'%'.$value2.'%\'';
                            }
                        }
                    }
            }

            $result = mysqli_query($con, "SELECT * FROM ".TABLE_ACCOUNT." WHERE $condition");
            if ( mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                            $cart[$i] = array();
                            foreach ($row as $key => $value) {

                                    $cart[$i][$key] = $value;

                            }
                            $i++;
                    }
                    $callback['data'] = $cart;
                    $callback['success'] = true;

            } else {
                    $callback['success'] = false;
            }

            mysqli_close($con);

    }
    catch (Exception $e)
    {
            $callback['msg'] = $e;
            $callback['success'] = false;
    }
    
    echo json_encode($callback);
}

    function fn_btn_account_paused(){
        try{
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                $cart = array();
                $callback = array();
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                else {
                            
                        $res = mysqli_query($con, "SELECT * FROM " .TABLE_ACCOUNT. " WHERE a_state='blockade'");
                        $i=0;
                        //print_r(mysqli_fetch_array($res));
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                $cart[$i] = array();
                                
                                foreach ($row as $key => $value) {
                                    
                                    if( gettype($key) !== "integer" )
                                    {

                                            if(
                                                    strpos($value, ".jpg") ||
                                                    strpos($value, ".jpeg") ||
                                                    strpos($value, ".png") ||
                                                    strpos($value, ".gif"))
                                            {
                                                $cart[$i][$key] = "./data/account/". $cart[$i]["a_id"] ."/". $value;
                                            } else {
                                                $cart[$i][$key] = $value;
                                            }
                                        
                                    }
                                    
                                }
                                $i++;
                        }

                        $callback['data'] =  $cart;
                        $callback['success'] = true;
                        
                        mysqli_close($con);
                        
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }

    function fn_btn_pause_account(){
        $callback = array();
        try{
                if( check_empty( array( "token","a_id","display" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $a_id = $_REQUEST[ "a_id" ];
                    $display = $_REQUEST[ "display" ];
                    
                    if( !in_array($display, array("block","blockade")) ){
                            $callback['msg'] = "輸入資料不完整";
                            $callback['success'] = false;
                            echo json_encode($callback);
                            return;
                    }
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            echo json_encode($callback);
                            return;
                    }
                    
                    $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            echo json_encode($callback);
                            return;
                    }
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            echo json_encode($callback);
                            return;
                    }
                    
                    $member = get_sql($con, TABLE_ACCOUNT, "WHERE a_id = '$a_id'");
                    if( !$member ){
                            $callback['msg'] = "member is not exist";
                            $callback['success'] = false;
                            mysqli_close($con);
                            echo json_encode($callback);
                            return;
                    }
                    
                    if( update_sql($con, TABLE_ACCOUNT, array( "a_state" => $display ), array( "a_id" => $member[0]["a_id"] )) ){
                            $callback['data'] = $member[0]["a_id"];
                            $callback['success'] = true;
                    }
                    else{
                            $callback['msg'] = "修改失敗";
                            $callback['success'] = false;
                    }
                    
                    mysqli_close($con);
                }
                else {
                    $callback['msg'] = "輸入資料不完整";
                    $callback['success'] = false;
                }
                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
        
}

    function fn_btn_checkbox_pause_account(){
            $callback = array();
            try{
                    if( check_empty( array( "token","list" ) ) ) {

                        $token = md5( $_REQUEST[ "token" ] );
                        $list = json_decode($_REQUEST[ "list" ],true);

                        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        $con->query("SET NAMES utf8");
                        // Check connection
                        if (mysqli_connect_errno()) {
                                $callback['msg'] = "SQL connect fail";
                                $callback['success'] = false;
                                echo json_encode($callback);
                                return;
                        }

                        $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }
                        if( $account[0]['a_admin'] !== "true" ){
                                $callback['msg'] = "you dont have admin";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }

                        $cond = "";
                        foreach ($list as $key => $value) {
                                $cond .= ( $key === 0 ) ? "a_id='$value'" : " OR a_id='$value'";
                        }

                        if( mysqli_query($con, "UPDATE " .TABLE_ACCOUNT. " SET a_state='blockade' WHERE $cond") ){
                                $callback['data'] = $list;
                                $callback['success'] = true;
                        }
                        else{
                                $callback['msg'] = "修改失敗";
                                $callback['success'] = false;
                        }

                        mysqli_close($con);
                    }
                    else {
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                    }

            }
            catch (Exception $e)
            {
                    $callback['msg'] = $e;
                    $callback['success'] = false;
            }
            echo json_encode($callback);

    }

    function fn_btn_checkbox_continue_account(){
            $callback = array();
            try{
                    if( check_empty( array( "token","list" ) ) ) {

                        $token = md5( $_REQUEST[ "token" ] );
                        $list = json_decode($_REQUEST[ "list" ],true);

                        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        $con->query("SET NAMES utf8");
                        // Check connection
                        if (mysqli_connect_errno()) {
                                $callback['msg'] = "SQL connect fail";
                                $callback['success'] = false;
                                echo json_encode($callback);
                                return;
                        }

                        $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }
                        if( $account[0]['a_admin'] !== "true" ){
                                $callback['msg'] = "you dont have admin";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }

                        $cond = "";
                        foreach ($list as $key => $value) {
                                $cond .= ( $key === 0 ) ? "a_id='$value'" : " OR a_id='$value'";
                        }

                        if( mysqli_query($con, "UPDATE " .TABLE_ACCOUNT. " SET a_state='block' WHERE $cond") ){
                                $callback['data'] = $list;
                                $callback['success'] = true;
                        }
                        else{
                                $callback['msg'] = "修改失敗";
                                $callback['success'] = false;
                        }

                        mysqli_close($con);
                    }
                    else {
                        $callback['msg'] = "輸入資料不完整";
                        $callback['success'] = false;
                    }

            }
            catch (Exception $e)
            {
                    $callback['msg'] = $e;
                    $callback['success'] = false;
            }
            echo json_encode($callback);

    }

    function fn_hichart_click_list_search(){
try
{       
        $i = 0;
        $cart = array();
        $callback = array();
        
        if( !check_empty( array( "timepoint","token" ) ) ) {
                $callback['msg'] = "輸入資料不完整";
                $callback['success'] = false;
                echo json_encode($callback);
                return;
        }
        
        $timepoint = $_REQUEST[ 'timepoint' ] /1000;
        $token = md5( $_REQUEST[ "token" ] );

        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $con->query("SET NAMES utf8");

        // Check connection
        if (mysqli_connect_errno()) {
                $callback['msg'] = "SQL connect fail";
                $callback['success'] = false;
                echo json_encode($callback);
                return;
        }
                                
        $account = get_sql($con, TABLE_ACCOUNT, "WHERE a_token LIKE '%\\\"$token\\\"%'");
        if( !$account ) {
                $callback['msg'] = "Login fail";
                $callback['success'] = false;
                mysqli_close($con);
                echo json_encode($callback);
                return;
        }
        if( $account[0]['a_admin'] !== "true" ){
                $callback['msg'] = "you dont have admin";
                $callback['success'] = false;
                mysqli_close($con);
                echo json_encode($callback);
                return;
        }

        $result = mysqli_query($con, "SELECT * FROM " .TABLE_ACCOUNT. " WHERE DATE_FORMAT(a_registration_time, '%Y-%m-%d') = FROM_UNIXTIME('".$timepoint."')");
        if ( mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                        $cart[$i] = array();
                        foreach ($row as $key => $value) {

                                $cart[$i][$key] = $value;

                        }
                        $i++;
                }
                $callback['data'] = $cart;
                $callback['success'] = true;

        } else {
                $callback['success'] = false;
        }

        mysqli_close($con);

}
catch (Exception $e)
{
        $callback['msg'] = $e;
        $callback['success'] = false;
}

echo json_encode($callback);
}

?>
