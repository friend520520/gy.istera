<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';
include 'sample/check_login.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get":
        $echo = get();
        break;
}

echo json_encode($echo);

function get()
{
        $callback = array();
        try{
                if( !check_empty( array( "token" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $echo = array();
                $i = 0;
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $check = check_login($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                $account = $check["data"];
                
                $help_money = get_sql($con, "help_money");
                if( $help_money ) {
                    $callback['data'] = $help_money;
                    $callback['success'] = true;
                }
                else {
                    $callback['msg'] = "金額顯示失敗";
                    $callback['success'] = false;
                }
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
