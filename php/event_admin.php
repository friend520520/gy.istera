<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';
include 'account_event.php';
include 'sample/check_login.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "pair":
        $echo = pair();
        break;
}

echo json_encode($echo);

function pair()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token","a_no_help","a_no_ask" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                date_default_timezone_set('Asia/Taipei');
                $token = md5( $_REQUEST[ "token" ] );
                $a_no_help = $_REQUEST[ "a_no_help" ];
                $a_no_ask = $_REQUEST[ "a_no_ask" ];
                $a_no_help_count = count($a_no_help);
                $a_no_ask_count = count($a_no_ask);
                $single_pair = $a_no_help_count === 1 && $a_no_ask_count === 1 ? TRUE : FALSE;
                
                if( !( $a_no_help_count === 1 && $a_no_ask_count >= 1 ) && !( $a_no_help_count >= 1 && $a_no_ask_count === 1 ) ){
                        $callback['msg'] = "請在提供幫助和接受幫助，選取一個配對多個或一個配對一個";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_admin($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $date = date('Y-m-d H:i:s');
                $check_repeat_a_id = array();
                $update_condi = array();
                $insert_array = array();
                if( $a_no_help_count >= $a_no_ask_count ){
                    for ($index = 0; $index < $a_no_help_count; $index++) {
                        $update_condi[$index] = array();
                        $insert_array[$index] = array( "a_time" => $date );
                    }
                }
                else{
                    for ($index = 0; $index < $a_no_ask_count; $index++) {
                        $update_condi[$index] = array();
                        $insert_array[$index] = array( "a_time" => $date );
                    }
                }
                
                if( $a_no_help_count === 1 ){
                        $check_help_pair = get_sql($con, "account_order"
                                                    , "where a_no='".$a_no_help[0]."' AND a_state=1"
                                                    , "*,a_principle as 'total'");
                        if( !$check_help_pair ){
                                $callback['msg'] = "配對幫助單錯誤";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        $check_repeat_a_id[] = $check_help_pair[0]["a_id"];
                        foreach ($insert_array as $key => $value) {
                            $update_condi[$key]["help_a_start"] = $check_help_pair[0]["a_start"];
                            $update_condi[$key]["help_a_type"] = $check_help_pair[0]["a_type"];
                            $update_condi[$key]["help_a_first_income_datetime"] = $check_help_pair[0]["a_first_income_datetime"];
                            $insert_array[$key]["a_id_help"] = $check_help_pair[0]["a_id"];
                            if( $single_pair ){
                                $insert_array[$key]["a_no_help"] = $check_help_pair[0]["a_no"];
                                $insert_array[$key]["ap_value"] = $check_help_pair[0]["total"];
                            }
                            else{
                                $insert_array[$key]["a_no_help"] = $check_help_pair[0]["a_no"]."-".($key+1);
                                $delete_a_no = $check_help_pair[0]["a_no"];
                            }
                        }
                }
                else{
                        foreach ($a_no_help as $key => $value) {
                            $a_no_help[$key] = "'".$value."'";
                        }
                        $tmp = implode(",", $a_no_help);
                        $check_help_pair = get_sql($con, "account_order"
                                                    , "where a_no IN ($tmp) AND a_state=1" 
                                                    , "*,a_principle as 'total'");
                        if( !$check_help_pair ){
                                $callback['msg'] = "配對幫助單錯誤";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                               
                        foreach ($insert_array as $key => $value) {
                            $check_repeat_a_id[] = $check_help_pair[$key]["a_id"];
                            $update_condi[$key]["help_a_start"] = $check_help_pair[$key]["a_start"];
                            $update_condi[$key]["help_a_type"] = $check_help_pair[$key]["a_type"];
                            $update_condi[$key]["help_a_first_income_datetime"] = $check_help_pair[$key]["a_first_income_datetime"];
                            $insert_array[$key]["a_id_help"] = $check_help_pair[$key]["a_id"];
                            $insert_array[$key]["a_no_help"] = $check_help_pair[$key]["a_no"];
                            $insert_array[$key]["ap_value"] = $check_help_pair[$key]["total"];
                        }
                }
                $help_money = 0;
                foreach ($check_help_pair as $value) {
                    $help_money += (int)$value["total"];
                }
                
                if( $a_no_ask_count === 1 ){
                        $check_ask_pair = get_sql($con, "account_order"
                                                    , "where a_no='".$a_no_ask[0]."' AND a_state=6"
                                                    , "*,a_principle+a_interest as 'total'");
                        if( !$check_ask_pair ){
                                $callback['msg'] = "配對被幫助單錯誤";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        if( in_array($check_ask_pair[0]["a_id"], $check_repeat_a_id) ){
                                $callback['msg'] = "提供幫助單與接受幫助單會員相同";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        
                        foreach ($insert_array as $key => $value) {
                            $update_condi[$key]["ask_a_start"] = $check_ask_pair[0]["a_start"];
                            $update_condi[$key]["ask_a_type"] = $check_ask_pair[0]["a_type"];
                            $update_condi[$key]["ask_a_first_income_datetime"] = $check_ask_pair[0]["a_first_income_datetime"];
                            $insert_array[$key]["a_id_ask"] = $check_ask_pair[0]["a_id"];
                            if( $single_pair ){
                                $insert_array[$key]["a_no_ask"] = $check_ask_pair[0]["a_no"];
                                $insert_array[$key]["ap_value"] = $check_ask_pair[0]["total"];
                            }
                            else{
                                $insert_array[$key]["a_no_ask"] = $check_ask_pair[0]["a_no"]."-".($key+1);
                                $delete_a_no = $check_ask_pair[0]["a_no"];
                            }
                        }
                }
                else{
                        foreach ($a_no_ask as $key => $value) {
                            $a_no_ask[$key] = "'".$value."'";
                        }
                        $tmp = implode(",", $a_no_ask);
                        $check_ask_pair = get_sql($con, "account_order"
                                                    , "where a_no IN ($tmp) AND a_state=6" 
                                                    , "*,a_principle+a_interest as 'total'");
                        if( !$check_ask_pair ){
                                $callback['msg'] = "配對被幫助單錯誤";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        foreach ($insert_array as $key => $value) {
                            if( in_array($check_ask_pair[$key]["a_id"], $check_repeat_a_id) ){
                                    $callback['msg'] = "提供幫助單與接受幫助單會員相同";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $update_condi[$key]["ask_a_start"] = $check_ask_pair[$key]["a_start"];
                            $update_condi[$key]["ask_a_type"] = $check_ask_pair[$key]["a_type"];
                            $update_condi[$key]["ask_a_first_income_datetime"] = $check_ask_pair[$key]["a_first_income_datetime"];
                            $insert_array[$key]["a_id_ask"] = $check_ask_pair[$key]["a_id"];
                            $insert_array[$key]["a_no_ask"] = $check_ask_pair[$key]["a_no"];
                            $insert_array[$key]["ap_value"] = $check_ask_pair[$key]["total"];
                        }
                }
                
                $ask_money = 0;
                foreach ($check_ask_pair as $value) {
                    $ask_money += (int)$value["total"];
                }
                
                if( $help_money !== $ask_money ) {
                        $callback['success'] = false;
                        $callback['msg'] = "配對金額不同";
                        mysqli_close($con);
                        return $callback;
                }
                else {
                        foreach ($insert_array as $key => $value) {
                            if( !insert_sql($con, "account_pair", $value) ){
                                $callback['msg'] = "建立配對失敗";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                            }
                            $result = mysqli_query($con,"SHOW TABLE STATUS LIKE 'account_pair'");
                            $row = mysqli_fetch_array($result);
                            $ap_id = (int)$row['Auto_increment'] - 1 ;
                            if( !file_exists(pair_path.$ap_id) ){
                                mkdir(pair_path.$ap_id, 0777, true);
                            }
                            $cmd = "INSERT INTO account_order (a_no,a_id,a_principle,a_state,a_start,a_type,a_first_income_datetime) VALUES"
                                    . " ('".$value["a_no_help"]."','".$value["a_id_help"]."',".$value["ap_value"].",3,'".$update_condi[$key]["help_a_start"]."',".$update_condi[$key]["help_a_type"].",'".$update_condi[$key]["help_a_first_income_datetime"]."')"
                                    . ",('".$value["a_no_ask"]."','".$value["a_id_ask"]."',".$value["ap_value"].",8,'".$update_condi[$key]["ask_a_start"]."',".$update_condi[$key]["ask_a_type"].",'".$update_condi[$key]["ask_a_first_income_datetime"]."')"
                                    . " ON DUPLICATE KEY UPDATE a_state=VALUES(a_state),a_state=VALUES(a_state)";
                            
                            if( !mysqli_query( $con , $cmd ) ){
                                    $callback['success'] = false;
                                    $callback['msg'] = "update state error";
                                    mysqli_close($con);
                                    return $callback;
                            }
                            if( isset($delete_a_no) ){
                                    $cmd = "DELETE FROM account_order WHERE a_no='$delete_a_no'";
                                    if( !mysqli_query( $con , $cmd ) ){
                                            $callback['success'] = false;
                                            $callback['msg'] = "拆單錯誤";
                                            mysqli_close($con);
                                            return $callback;
                                    }
                            }
                        }
                }
                
                
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
