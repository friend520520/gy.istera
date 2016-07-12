<?php
        /*
        * @file json_management_account.php
        * @brief TABLE:account

        * detail 

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-18 */

        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "fn_sql_show_full_columns_from_account":
                $echo = fn_sql_show_full_columns_from_account();
                break;
            case "fn_list_account_all":
                $echo = fn_list_account_all();
                break;
            case "fn_btn_search":
                $echo = fn_btn_search();
                break;
            case "fn_list_management_account_single_dialogue":
                $echo = fn_list_management_account_single_dialogue();
                break;
            case "fn_btn_update_management_account_single_profile":
                $echo = fn_btn_update_management_account_single_profile();
                break;
        }
        
    function fn_sql_show_full_columns_from_account(){
        
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
                         $result = mysqli_query($con,"SHOW FULL COLUMNS FROM account");
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
        
    function fn_list_account_all(){
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
                            
                        $res = mysqli_query($con, "SELECT * FROM account");
                        $i=0;
                        //print_r(mysqli_fetch_array($res));
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                $cart[$i] = array();
                                
                                foreach ($row as $key => $value) {
                                    
                                    if( gettype($key) !== "integer" ){
                                        
                                        if(strpos($value, ".jpg") ||
                                           strpos($value, ".jpeg") ||
                                           strpos($value, ".png") ||
                                           strpos($value, ".gif")){
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
    
    function list_btn_search(){
        
        try{
            //$token = md5( $_REQUEST['token'] );
            $select = $_REQUEST['select'];
            $search = $_REQUEST['search'];
            $callback = array();

            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");

            // Check connection
            if (mysqli_connect_errno()) {
                echo "false";
            }
            else {
                    $Condition = "WHERE $select like '%$search%'";
                    $search_list = get_sql($con, "account" , $Condition);

                    if( $search_list ) {

                        $list = array();
                        foreach ($search_list as $key => $value) {

                            $list[] = array( $select => $value[$select] ,
                                             "a_id" => $value['a_id'] ,
                                             "a_icon" => http_account_path.$value['a_id']."/".$value['a_icon'] ,
                                             "a_phone" => $value['a_phone'] ,
                                             "a_email" => $value['a_email'] ,
                                             "a_nickname" => $value['a_nickname'],
                                             "a_state" => $value['a_state']);
                            
                        }

                        $callback['data'] = $list;
                        $callback['success'] = true;
                    }
                    else {
                        $callback['msg'] = "list fail";
                        $callback['success'] = false;
                    }
            }
            
            mysqli_close($con);
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
        echo json_encode($callback);
    }
    
    function list_management_account_single_dialogue(){
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
                                return $callback;
                        }  
                                
                        $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                        if( !$account ) {
                                $callback['msg'] = "Login fail";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        
                        $res = mysqli_query($con, "SELECT * FROM account WHERE a_id='$a_id'");
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                if($row['a_icon']){
                                    $a_icon = "./data/account/". $row['a_id'] ."/". $row["a_icon"];
                                }
                            
                                $cart = array( "a_id"       => $row["a_id"] , 
                                                "a_admin"       => $row["a_admin"] ,
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
                                                "a_vitality" => $row["a_vitality"] ,
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
                        $callback['msg'] = "parameter is error.";
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
    
    function btn_update_management_account_single_profile(){
        try{
                date_default_timezone_set('Asia/Taipei');
                
                $token = md5( $_REQUEST[ "token" ] );
                $a_id = $_REQUEST[ 'a_id' ];

                $a_admin = $_REQUEST[ 'a_admin' ];
                $a_state = $_REQUEST[ 'a_state' ];
                $a_name = $_REQUEST[ 'a_name' ];
                $a_email = $_REQUEST[ 'a_email' ];
                $a_password = $_REQUEST[ 'a_password' ];
                $a_nickname = $_REQUEST[ 'a_nickname' ];
                $a_country = $_REQUEST[ 'a_country' ];
                $a_first_name = $_REQUEST[ 'a_first_name' ];
                $a_last_name = $_REQUEST[ 'a_last_name' ];
                $a_birthday = $_REQUEST[ 'a_birthday' ];
                $a_address = $_REQUEST[ 'a_address' ];
                $a_phone = $_REQUEST[ 'a_phone' ];
                $a_payment_method = $_REQUEST[ 'a_payment_method' ];
                $a_accept_email = $_REQUEST[ 'a_accept_email' ];
                $a_accept_noti = $_REQUEST[ 'a_accept_noti' ];
                $a_points = $_REQUEST[ 'a_points' ];
                $a_vitality = $_REQUEST[ 'a_vitality' ];
                $a_limit_token = $_REQUEST[ 'a_limit_token' ];
                $a_token = $_REQUEST[ 'a_token' ];
                $a_forget_token = $_REQUEST[ 'a_forget_token' ];
                $a_forget_token_time = $_REQUEST[ 'a_forget_token_time' ];
                $a_email_confirm = $_REQUEST[ 'a_email_confirm' ];
                $a_registration_time = $_REQUEST[ 'a_registration_time' ];
                $a_last_login_time = $_REQUEST[ 'a_last_login_time' ];
                $a_lastlogin_device = $_REQUEST[ 'a_lastlogin_device' ];
                $a_lastlogin_browser = $_REQUEST[ 'a_lastlogin_browser' ];
                $a_lastlogin_ip = $_REQUEST[ 'a_lastlogin_ip' ];
                        
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
                    
                        $sql_cmd = "UPDATE account SET 
                                            a_admin='$a_admin',
                                            a_state='$a_state',
                                            a_name='$a_name',
                                            a_email='$a_email',
                                            a_password='$a_password',
                                            a_nickname='$a_nickname',
                                            a_country='$a_country',
                                            a_first_name='$a_first_name',
                                            a_last_name='$a_last_name',
                                            a_birthday='$a_birthday',
                                            a_address='$a_address',
                                            a_phone='$a_phone',
                                            a_payment_method='$a_payment_method',
                                            a_accept_email='$a_accept_email',
                                            a_accept_noti='$a_accept_noti',
                                            a_points=$a_points,
                                            a_vitality=$a_vitality,
                                            a_limit_token=$a_limit_token,
                                            a_token='$a_token',
                                            a_forget_token='$a_forget_token',
                                            a_forget_token_time='$a_forget_token_time',
                                            a_email_confirm='$a_email_confirm',
                                            a_registration_time='$a_registration_time',
                                            a_last_login_time='$a_last_login_time',
                                            a_lastlogin_device='$a_lastlogin_device',
                                            a_lastlogin_browser='$a_lastlogin_browser',
                                            a_lastlogin_ip='$a_lastlogin_ip'
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
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
?>