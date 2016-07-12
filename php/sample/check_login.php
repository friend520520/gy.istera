<?php


function check_login( $con ){
        
        date_default_timezone_set('Asia/Taipei');
        $callback = array();
        if (!isset($_SESSION)) { session_start(); }
        
        if( isset($_REQUEST["token"]) && !empty($_REQUEST["token"]) ) {
                
                $token = md5( $_REQUEST[ "token" ] );
//                if( !isset($_SESSION["help_token"]) || ( $_SESSION["help_token"] !== $_REQUEST[ "token" ] ) ){
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if ( !$account ) {
                        $callback['msg'] = "Login fail";//帳號已從其他地方登入
                        $callback['success'] = false;
                        return $callback;
                    }
                    $a_token = json_decode($account[0]["a_token"],true);
                    foreach ($a_token as $key => $value) {
                        if( $value["token"] === $token ){
                            if( (int)$value["time"] < (int)strtotime("now") ){
                                unset($a_token[$key]);
                                $a_token = json_encode($a_token);
                                update_sql($con, "account", array( "a_token" => $a_token ), array("a_id"=>$account[0]["a_id"]));
                                $callback['msg'] = "自動登入到期";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                            }
                            else{
                                break;
                            }
                        }
                    }
                    $account = $account[0];
                    $_SESSION["help_token"] = $_REQUEST[ "token" ];
                    $_SESSION["help_member_info"] = json_encode( $account );
//                }
//                else{
//                    $account = json_decode( $_SESSION["help_member_info"] , true );
//                }
                $callback['data'] = $account;
                $callback['success'] = true;
                return $callback;
        }
        else{
                $callback['msg'] = "沒有token傳入";
                $callback['success'] = false;
                return $callback;
        }
        
}

function check_admin( $con ){
        
        date_default_timezone_set('Asia/Taipei');
        $callback = array();
        if (!isset($_SESSION)) { session_start(); }
        
        if( isset($_REQUEST["token"]) && !empty($_REQUEST["token"]) ) {
                
                $token = md5( $_REQUEST[ "token" ] );
//                if( !isset($_SESSION["help_token"]) || ( $_SESSION["help_token"] !== $_REQUEST[ "token" ] ) ){
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if ( !$account ) {
                        $callback['msg'] = "Login fail";//帳號已從其他地方登入
                        $callback['success'] = false;
                        return $callback;
                    }
                    $a_token = json_decode($account[0]["a_token"],true);
                    foreach ($a_token as $key => $value) {
                        if( $value["token"] === $token ){
                            if( (int)$value["time"] < (int)strtotime("now") ){
                                unset($a_token[$key]);
                                $a_token = json_encode($a_token);
                                update_sql($con, "account", array( "a_token" => $a_token ), array("a_id"=>$account[0]["a_id"]));
                                $callback['msg'] = "自動登入到期";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                            }
                            else{
                                break;
                            }
                        }
                    }
                    $account = $account[0];
                    $_SESSION["help_token"] = $_REQUEST[ "token" ];
                    $_SESSION["help_member_info"] = json_encode( $account );
//                }
//                else{
//                    $account = json_decode( $_SESSION["help_member_info"] , true );
//                }
                if ( $account["a_admin"] === "false" ) {
                    $callback['msg'] = "Not admin";//帳號已從其他地方登入
                    $callback['success'] = false;
                    return $callback;
                }
                $callback['data'] = $account;
                $callback['success'] = true;
                return $callback;
        }
        else{
                $callback['msg'] = "沒有token傳入";
                $callback['success'] = false;
                return $callback;
        }
        
}