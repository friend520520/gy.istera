<?php
        /*
        * @file json_franchisee_console.php
        * @brief 網站公告資料表

        * detail DB funbook19; TABLE board;

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-21 */

        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "fn_list_board":
                $echo = fn_list_board();
                break;
        }
        
        
    function fn_list_board(){
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
                            
                        $res = mysqli_query($con, "SELECT * FROM board ORDER BY b_date DESC");
                        $i=0;
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                $cart[$i] = array();
                                
                                foreach ($row as $key => $value) {
                                    
                                        if( gettype($key) !== 'integer' ){
                                            
                                                if( $key == 'b_date' ){

                                                        $cart[$i][$key] = substr( $value , 0 , 10 );
                                                        
                                                } else{

                                                        $cart[$i][$key] = $value;
                                                }
                                        }
                                }
                                $i++;
                                /*
                                    $cart[] = array( "a_id" => $row["a_id"] , 
                                        "a_icon" => $row["a_icon"] ,
                                        "a_name" => $row["a_name"] ,
                                        "a_nickname" => $row["a_nickname"] ,
                                        "a_email" => $row["a_email"] ,
                                        "a_country" => $row["a_country"] , );
                                */
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
    
?>