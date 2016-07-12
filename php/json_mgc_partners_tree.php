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
            case "fn_get_zNodes_json":
            $echo = fn_get_zNodes_json_myself();
            break;
        }
        
        echo json_encode($echo);
        
        
        function fn_get_zNodes_json_myself(){

                $callback = array();

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
                $a_state = ($account[0]['a_state'] == 'block') ? '【啟用】':'【停用】';
                $a_admin = ($account[0]['a_admin'] == 'true') ? '【管理者】':'【一般會員】';
                
                //推薦人數
                $res_children = mysqli_query($con, "SELECT * FROM account WHERE a_parent='$a_id'");
                $children_num = mysqli_num_rows($res_children);
                
                $arr = array( array( "id" => $a_id,
                                    "pId" => '0',
                                    "name" => $account[0]['a_nickname'] . $a_state . $a_admin . '【推薦人數】：'.$children_num.'【團隊排單】：1000.00',
                                    "open" => true)
                        );
                
                $arr = fn_get_zNodes_json_children($con,$a_id,$arr);
                
                return $arr;
        }
        
        //找尋下線
        function fn_get_zNodes_json_children($con,$a_id,$arr){
            
            try{
                    $res = mysqli_query($con, "SELECT * FROM account WHERE a_parent='$a_id'");
                    
                    if (mysqli_num_rows($res) > 0) {
                            while($row = mysqli_fetch_array($res)) {
                                        $a_state = ($row['a_state'] == 'block') ? '【啟用】':'【停用】';
                                        $a_admin = ($row['a_admin'] == 'true') ? '【管理者】':'【一般會員】';
                                        
                                        //推薦人數
                                        $res_children = mysqli_query($con, "SELECT * FROM account WHERE a_parent='".$row['a_id']."'");
                                        $children_num = mysqli_num_rows($res_children);
                                        
                                        $arr[] = array(
                                            "id" => $row['a_id'],
                                            "pId" => $a_id,
                                            "name" => $row['a_nickname'] . $a_state . $a_admin . '【推薦人數】：'.$children_num.'【團隊排單】：1000.00',
                                            "open" => true
                                        );
                                        $arr = fn_get_zNodes_json_children($con,$row['a_id'],$arr);
                            }

                    } else {
                            $arr[count($arr)-1]['open'] = false;
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