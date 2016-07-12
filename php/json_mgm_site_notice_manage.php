<?php
        /*
        * @file json_mg_account.php
        * @brief TABLE:account

        * detail 

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-18 */

        define('TABLE_BOARD', 'board');
        define('TABLE_BOARD_SEARCH', 'board_search');
        
        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "fn_sql_show_full_columns_from_table":
                $echo = fn_sql_show_full_columns_from_table();
                break;
            case "fn_search_all":
                $echo = fn_search_all();
                break;
            case "fn_btn_search":
                $echo = fn_btn_search();
                break;
            case "fn_btn_search_regex":
                $echo = fn_btn_search_regex();
                break;
            case "fn_list_management_account_single_dialogue":
                $echo = fn_list_management_account_single_dialogue();
                break;
            case "fn_btn_update_management_account_single_profile":
                $echo = fn_btn_update_management_account_single_profile();
                break;
            case "fn_btn_set_btn_fast":
                $echo = fn_btn_set_btn_fast();
                break;
            case "fn_get_all_btn_fast":
                $echo = fn_get_all_btn_fast();
                break;
            case "fn_btn_fast_delete":
                $echo = fn_btn_fast_delete();
                break;
            case "fn_btn_fast_list_conditions":
                $echo = fn_btn_fast_list_conditions();
                break;
            case "fn_btn_fast_list_search":
                $echo = fn_btn_fast_list_search();
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
            
            case "fn_list_site_notice_message_single_dialogue":
                $echo = fn_list_site_notice_message_single_dialogue();
                break;
            case "fn_btn_new_post_board":
                $echo = fn_btn_new_post_board();
                break;
            case "fn_btn_update_board":
                $echo = fn_btn_update_board();
                break;
            case "fn_btn_rubbish_delete_board":
                $echo = fn_btn_rubbish_delete_board();
                break;
            
            case "fn_btn_checkbox_delete_board": //批次刪除公告
                $echo = fn_btn_checkbox_delete_board();
                break;
        }
        


    function fn_sql_show_full_columns_from_table(){
        
        try{
                
                //$token = md5( $_REQUEST[ AJAX_ENTER_TOKEN ] );
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                $cart = array();
                $callback = array();
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                        $result = mysqli_query($con,"SHOW FULL COLUMNS FROM " . TABLE_BOARD);
                        if (!$result) {
                            echo 'Could not run query: ' . mysql_error();
                            exit;
                        }
                        if (mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                //print_r($row);
                                $cart[] = array( "field" => $row['Field'],
                                                 "comment" => $row['Comment']);
                            }
                            
                            $callback['data'] = $cart;
                            $callback['success'] = true;
                        }
                        
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
        
    function fn_search_all()
    {
        try{

                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                $cart = array();
                $callback = array();
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                            
                        $res = mysqli_query($con, "SELECT * FROM " . TABLE_BOARD);
                        $i=0;
                        
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
    
    function fn_btn_search(){
        
        try{
                $callback = array();

                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");

                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                        $res = mysqli_query($con, "SELECT * FROM " .TABLE_BOARD);
                        $i=0;

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
                echo "false";
        }
        
        echo json_encode($callback);
    }
    
    function fn_btn_search_regex(){
                
        try{
                $callback = array();
                $cart = array();

                $operation_html = empty($_REQUEST[ "operation_html" ]) ? "" : $_REQUEST["operation_html"];
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");

                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                        $res = mysqli_query($con, "select a.a_id as id, b.b_id as seq, a.a_nickname as sender, b.b_title as title, b.b_content as content, b.b_date as date "
                                                . "from board as b "
                                                . "left join account as a on a.a_id = b.a_id");
                        $i=0;

                        while($row = mysqli_fetch_array($res)) {

                                $cart[$i] = array();

                                foreach ($row as $key => $value) {

                                    if( gettype($key) !== "integer" )
                                    {
                                            //$cart[$i][$key] = $value;
                                            $value_push = (mb_strlen( $value, "utf-8")>30)? mb_substr( $value,0,30, "utf-8")."...":$value;
                                            array_push($cart[$i], $value_push);
                                    }

                                }
                                array_push($cart[$i], $operation_html);
                                $i++;
                        }

                        $callback['data'] =  $cart;
                        $callback['success'] = true;

                        mysqli_close($con);
                }
        }
        catch (Exception $e)
        {
                echo "false";
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
                                
                        $account = get_sql($con, TABLE_BOARD, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                echo json_encode($callback);
                                return;
                        }
                        
                        $res = mysqli_query($con, "SELECT * FROM " .TABLE_BOARD. " WHERE a_id='$a_id'");
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                if($row['a_icon']){
                                    $a_icon = "./data/account/". $row['a_id'] ."/". $row["a_icon"];
                                } else {
                                    $a_icon = "";
                                }
                            
                                $cart = array( "a_id"       => $row["a_id"] , 
                                                "a_admin"       => $row["a_admin"] ,
                                                "a_franchisee"       => $row["a_franchisee"] ,
                                                "a_parent"       => $row["a_parent"] ,
                                                "a_state" => $row["a_state"] ,
                                                "a_name" => $row["a_name"] ,
                                                "a_email" => $row["a_email"] ,
                                                "a_password" => $row["a_password"] ,
                                                "a_icon" => $a_icon ,
                                                "a_nickname" => $row["a_nickname"] ,
                                                "a_country" => $row["a_country"] ,
                                                "a_first_name" => $row["a_first_name"] ,
                                                "a_last_name" => $row["a_last_name"] ,
                                                "a_birthday" => $row["a_birthday"] ,
                                                "a_address" => $row["a_address"] ,
                                                "a_phone" => $row["a_phone"] ,
                                                "a_payment_method" => $row["a_payment_method"] ,
                                                "a_accept_email" => $row["a_accept_email"] ,
                                                "a_accept_noti" => $row["a_accept_noti"] ,
                                                "a_points" => $row["a_points"] ,
                                                "a_178tube_franchisee_url" => $row["a_178tube_franchisee_url"] ,
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
    
    function fn_btn_update_management_account_single_profile(){
        try{
                //date_default_timezone_set('Asia/Taipei');
                
                $token = md5( $_REQUEST[ "token" ] );
                $a_id = $_REQUEST[ 'a_id' ];

                $a_name = $_REQUEST[ 'a_name' ];
                $a_email = $_REQUEST[ 'a_email' ];
                $a_nickname = $_REQUEST[ 'a_nickname' ];
                $a_country = $_REQUEST[ 'a_country' ];
                $a_first_name = $_REQUEST[ 'a_first_name' ];
                $a_last_name = $_REQUEST[ 'a_last_name' ];
                $a_birthday = $_REQUEST[ 'a_birthday' ];
                $a_address = $_REQUEST[ 'a_address' ];
                $a_phone = $_REQUEST[ 'a_phone' ];
                        
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
                                
                $account = get_sql($con, TABLE_BOARD, "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                    
                $sql_cmd = "UPDATE " .TABLE_BOARD. " SET 
                                    a_name='$a_name',
                                    a_email='$a_email',
                                    a_nickname='$a_nickname',
                                    a_country='$a_country',
                                    a_first_name='$a_first_name',
                                    a_last_name='$a_last_name',
                                    a_birthday='$a_birthday',
                                    a_address='$a_address',
                                    a_phone='$a_phone'
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
    
    function fn_btn_set_btn_fast(){
        try{
                $fast_name = $_REQUEST[ 'fast_name' ];
                $sql = $_REQUEST[ 'sql' ];
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                
                $callback = array();
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }
                
                $sql = mysqli_real_escape_string($con,$sql);
                $sql_cmd = "INSERT INTO " .TABLE_BOARD_SEARCH. " ( a_search_name, a_search_table, a_search_cmd ) VALUES ( '$fast_name', '" .TABLE_BOARD. "' ,'$sql' )";
                if( mysqli_query($con, $sql_cmd) ) {
                        $callback['success'] = true;
                        
                        $result = mysqli_query($con,"SHOW TABLE STATUS LIKE '" . TABLE_BOARD_SEARCH . "'" );
                        $row = mysqli_fetch_array($result);
                        $as_id = (int)$row["Auto_increment"] -1;
                        
                        $callback['data'] = array(
                                "as_id" => $as_id,
                                "fast_name" => $fast_name
                        );
                }
                else {
                        $callback['msg'] = "INSERT fail";
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

    function fn_get_all_btn_fast(){
    try
    {           
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
                
                $result = mysqli_query($con, "SELECT * FROM " . TABLE_BOARD_SEARCH . " WHERE a_search_table='".TABLE_BOARD."'");
                if ( mysqli_num_rows($result) > 0) {

                        while($row = mysqli_fetch_array($result)) {

                                    $cart[] = array(
                                            "as_id"          => $row['as_id'],
                                            "a_search_name"  => $row['a_search_name'],
                                            "a_search_table" => $row['a_search_table'],
                                            "a_search_cmd"   => $row['a_search_cmd']
                                    );

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

    function fn_btn_fast_delete(){
    try
    {           
                $as_id = $_REQUEST[ 'as_id' ];
                
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
                
                $result = mysqli_query($con, "SELECT * FROM " .TABLE_BOARD_SEARCH. " WHERE as_id='$as_id'");
                if ( mysqli_num_rows($result) > 0) {

                        $sql = "DELETE FROM " .TABLE_BOARD_SEARCH. " WHERE as_id= $as_id";
                        
                        if( mysqli_query($con,$sql) ){
                                $callback['as_id'] = $as_id;
                                $callback['success'] = true;
                        }
                        else{
                                $callback['msg'] = "SQL DELETE fail";
                                $callback['success'] = false;
                        }
                        
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

    function fn_btn_fast_list_conditions(){
    try
    {           
                $as_id = $_REQUEST[ 'as_id' ];
                
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
                                
                $account_search = get_sql($con, TABLE_BOARD_SEARCH, "WHERE as_id = $as_id");
                if( !$account_search ) {
                        $callback['msg'] = "as_id not existed";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                $a_search_table = $account_search[0]['a_search_table'];
                $a_search_cmd = $account_search[0]['a_search_cmd'];
                $a_search_cmd = json_decode($a_search_cmd,true);
                
                foreach ($a_search_cmd as $key => $value) {
                        $cart[$i] = array();
                        foreach ($value as $key2 => $value2) {
                                $cart[$i] = array(
                                        "table" => $a_search_table,
                                        "column" => $key2,
                                        "value" => $value2
                                );
                        }
                        $i++;
                }
                //$callback['as_id'] = $as_id;
                $callback['data'] = $cart;
                $callback['success'] = true;
                
                /*點選 搜尋快捷鍵 進入SQL搜尋data
                foreach ($a_search_cmd as $key => $value) {
                        if( $key== 0){
                            foreach ($value as $key2 => $value2) {
                                if( gettype($value2) == 'integer' || gettype($value2) == 'boolean'){
                                    $condition = (string)$key2 .' LIKE '. '%'.$value2.'%';
                                } else {
                                    $condition = (string)$key2 .' LIKE '. '\'%'.$value2.'%\'';
                                }
                            }
                        } else {
                            foreach ($value as $key2 => $value2) {
                                if( gettype($value2) == 'integer' || gettype($value2) == 'boolean'){
                                    $condition .= ' AND ' . (string)$key2 .' LIKE '. '%'.$value2.'%';
                                } else {
                                    $condition .= ' AND ' . (string)$key2 .' LIKE '. '\'%'.$value2.'%\'';
                                }
                            }
                        }
                }
                
                $result = mysqli_query($con, "SELECT * FROM $a_search_table WHERE $condition");
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
                }*/

                mysqli_close($con);

    }
    catch (Exception $e)
    {
            $callback['msg'] = $e;
            $callback['success'] = false;
    }
    
    echo json_encode($callback);
}

    function fn_btn_fast_list_search(){
    try
    {           
            $as_id = $_REQUEST[ 'as_id' ];

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

            $account_search = get_sql($con, TABLE_BOARD_SEARCH, "WHERE as_id = $as_id");
            if( !$account_search ) {
                    $callback['msg'] = "as_id not existed";
                    $callback['success'] = false;
                    mysqli_close($con);
                    echo json_encode($callback);
                    return;
            }
            $a_search_table = $account_search[0]['a_search_table'];
            $a_search_cmd = $account_search[0]['a_search_cmd'];
            $a_search_cmd = json_decode($a_search_cmd,true);

            /*點選 搜尋快捷鍵 進入SQL搜尋data*/
            foreach ($a_search_cmd as $key => $value) {
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

            $result = mysqli_query($con, "SELECT * FROM $a_search_table WHERE $condition");
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

            $result = mysqli_query($con, "SELECT * FROM ".TABLE_BOARD." WHERE $condition");
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

    function fn_btn_account_paused()
    {
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
                            
                        $res = mysqli_query($con, "SELECT * FROM " .TABLE_BOARD. " WHERE a_state='blockade'");
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
                    
                    $account = get_sql($con, TABLE_BOARD, "WHERE a_token LIKE '%\\\"$token\\\"%'");
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
                    
                    $member = get_sql($con, TABLE_BOARD, "WHERE a_id = '$a_id'");
                    if( !$member ){
                            $callback['msg'] = "member is not exist";
                            $callback['success'] = false;
                            mysqli_close($con);
                            echo json_encode($callback);
                            return;
                    }
                    
                    if( update_sql($con, TABLE_BOARD, array( "a_state" => $display ), array( "a_id" => $member[0]["a_id"] )) ){
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
                    
                    $account = get_sql($con, TABLE_BOARD, "WHERE a_token LIKE '%\\\"$token\\\"%'");
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
                    
                    if( mysqli_query($con, "UPDATE " .TABLE_BOARD. " SET a_state='blockade' WHERE $cond") ){
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
        
        
        /*專屬管理公告 s*/
        function fn_list_site_notice_message_single_dialogue(){
            try{
                    if( check_empty( array( "token" , "b_id" ) ) ){
                            $token = md5( $_REQUEST[ "token" ] );
                            $b_id = $_REQUEST[ 'b_id' ];

                            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                            $con->query("SET NAMES utf8");

                            $callback = array();
                            $cart = array();

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

                            $res = mysqli_query($con, "SELECT * FROM board WHERE b_id=$b_id");

                            while($row = mysqli_fetch_array($res)) {

                                        $cart = array( "b_id"       => $row["b_id"] , 
                                                        "b_title"   => $row["b_title"] ,
                                                        "b_content" => $row["b_content"] );
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
           

        function fn_btn_new_post_board(){
            try{
                    date_default_timezone_set('Asia/Taipei');

                    $token = md5( $_REQUEST[ "token" ] );
                    //$a_id = $_REQUEST[ 'a_id' ];
                    $b_title = $_REQUEST[ 'title' ];
                    $b_content = $_REQUEST[ 'content' ];
                    //$b_receiver = $_REQUEST[ 'b_receiver' ];
                    $b_date = date('Y-m-d H:i:s');
                    $callback = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");

                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    

                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $a_id = $account[0]['a_id'];

                    $sql_cmd = "INSERT INTO board( a_id, b_title, b_content, b_date ) "
                                        . "VALUES ( '$a_id', '$b_title','$b_content','$b_date')";

                    if( mysqli_query($con, $sql_cmd) ) {
                        $callback['success'] = true;
                    }
                    else {
                        $callback['msg'] = "INSERT fail";
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

        function fn_btn_update_board(){
            try{
                    date_default_timezone_set('Asia/Taipei');

                    $token = md5( $_REQUEST[ "token" ] );
                    $b_id = $_REQUEST[ 'b_id' ];
                    $b_title = $_REQUEST[ 'title' ];
                    $b_content = $_REQUEST[ 'content' ];
                    //$b_date = date('Y-m-d H:i:s');

                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");

                    $callback = array();

                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }

                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                    }
                    else {

                            $sql_cmd = "UPDATE board SET b_title='$b_title', b_content='$b_content' WHERE b_id=$b_id";

                            if( mysqli_query($con, $sql_cmd) ) {
                                    $callback['success'] = true;
                            }
                            else {
                                    $callback['msg'] = "UPDATE fail";
                                    $callback['success'] = false;
                            }

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

        function fn_btn_rubbish_delete_board(){
            try{
                    if( check_empty( array( "token" , "b_id" ) ) ){
                            $token = md5( $_REQUEST[ "token" ] );
                            $b_id = $_REQUEST[ 'b_id' ];

                            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                            $con->query("SET NAMES utf8");

                            $callback = array();

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

                            $sql_cmd = "DELETE FROM board WHERE b_id='$b_id'";

                            if( mysqli_query($con, $sql_cmd) ) {
                                    $callback['success'] = true;
                                    $callback['data'] = $b_id;
                            }
                            else {
                                    $callback['msg'] = "DELETE fail";
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
        /*專屬管理公告 e*/

function fn_btn_checkbox_delete_board(){
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
                    
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
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
                            $cond .= ( $key === 0 ) ? "b_id='$value'" : " OR b_id='$value'";
                    }
                    
                    if( mysqli_query($con, "DELETE FROM " .TABLE_BOARD. " WHERE $cond") ){
                            $callback['data'] = $list;
                            $callback['success'] = true;
                    }
                    else{
                            $callback['msg'] = "刪除失敗";
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


?>
