<?php
        /*
        * @file json_mg_account.php
        * @brief TABLE:account

        * detail 

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-18 */

        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "fn_get_myPartner":
                $echo = fn_get_myPartner();
                break;
            case "fn_get_myPartner_regex":
                $echo = fn_get_myPartner_regex();
                break;
        }
        echo json_encode($echo);
        
        function fn_get_myPartner(){

                $callback = array();
                $arr = array();

                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }

                $token = md5( $_REQUEST[ "token" ] );
                $account = get_sql($con, "account" , "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                $a_id = $account[0]['a_id'];
                
                $arr = fn_get_myPartner_children($con,$a_id,$arr);
                
                return $arr;
        }
        
        //找尋下線
        function fn_get_myPartner_children($con,$a_id,$arr){
            
            try{
                    $res = mysqli_query($con, "SELECT * FROM account WHERE a_parent='$a_id'");
                    
                    if (mysqli_num_rows($res) > 0) {
                            while($row = mysqli_fetch_array($res)) {
                                        $a_state = ($row['a_state'] == 'block') ? '啟用':'停用';
                                        $a_admin = ($row['a_admin'] == 'true') ? '管理者':'一般會員';
                                        
                                        //推薦人數
                                        $res_children = mysqli_query($con, "SELECT * FROM account WHERE a_parent='".$row['a_id']."'");
                                        $children_num = mysqli_num_rows($res_children);
                                        
                                        $arr[] = array(
                                            "a_id" => $row['a_id'],
                                            "a_email" => $row['a_email'],
                                            "a_nickname" => $row['a_nickname'],
                                            "a_phone" => $row['a_phone'],
                                            "a_admin" => $a_admin,
                                            "a_state" => $a_state,
                                            "a_registration_time" => $row['a_registration_time']
                                        );
                                        $arr = fn_get_myPartner_children($con,$row['a_id'],$arr);
                            }

                    } else {
                            return $arr;
                    }
            }
            catch (Exception $e)
            {
                    return $arr;
            }

            return $arr;
        }
        
        function fn_get_myPartner_regex(){

                $callback = array();
                $arr = array();

                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        echo json_encode($callback);
                        return;
                }

                $token = md5( $_REQUEST[ "token" ] );
                $account = get_sql($con, "account" , "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        echo json_encode($callback);
                        return;
                }
                $a_id = $account[0]['a_id'];
                
                $arr = fn_get_myPartner_children_regex($con,$a_id,$arr);
                
                $callback['data'] = $arr;
                return $callback;
        }
        
        //找尋下線_regex
        function fn_get_myPartner_children_regex($con,$a_id,$arr){
            
            try{
                    $res = mysqli_query($con, "SELECT * FROM account WHERE a_parent='$a_id'");
                    
                    if (mysqli_num_rows($res) > 0) {
                            while($row = mysqli_fetch_array($res)) {
                                        $a_state = ($row['a_state'] == 'block') ? '啟用':'停用';
                                        $a_admin = ($row['a_admin'] == 'true') ? '管理者':'一般會員';
                                        
                                        //推薦人數
//                                        $res_children = mysqli_query($con, "SELECT * FROM account WHERE a_parent='".$row['a_id']."'");
//                                        $children_num = mysqli_num_rows($res_children);
                                        
                                        $arr[] = array(
                                            "0" => $row['a_id'],
                                            "1" => $row['a_email'],
                                            "2" => $row['a_nickname'],
                                            "3" => $row['a_phone'],
                                            "4" => $a_admin,
                                            "5" => $a_state,
                                            "6" => $row['a_registration_time']
                                        );
                                        $arr = fn_get_myPartner_children_regex($con,$row['a_id'],$arr);
                            }

                    } else {
                            return $arr;
                    }
            }
            catch (Exception $e)
            {
                    return $arr;
            }

            return $arr;
        }
        
?>