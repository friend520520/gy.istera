<html>
        <head>
                <meta charset="utf-8">
                
        </head>
        <body>
                
                <?php

                        include 'config.php';
                        include 'global.php';

                        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        $con->query("SET NAMES utf8");
                        // Check connection
                        if (mysqli_connect_errno()) {
                                $callback['msg'] = "SQL connect fail";
                                $callback['success'] = false;
                                return $callback;
                        }
                        
                        $uid = "09IX0GIHNXH5ZBZFKYNC";
                        echo "uid : " . $uid . "<br><br>";
                        //uid 換發表文章數
                        $page = get_sql($con, "page as p join channel as ch on p.p_channel_id = ch.ch_id", "WHERE ch.ch_user_id='$uid'", "COUNT(p.page_id)");
                        if( $page ){
                            echo "發表文章數 : " . $page[0]['COUNT(p.page_id)'] . "<br>";
                        }
                        //uid 換發表文章數
                        //--------------------------------------------------------------------------------
                        //uid 換上傳附件數
                        $page = get_sql($con, "page as p join channel as ch join page_file as pf on p.p_channel_id = ch.ch_id AND p.page_id=pf.pf_page_id", "WHERE ch.ch_user_id='$uid'", "COUNT(pf.pf_page_id)");
                        if( $page ){
                            echo "上傳附件數 : " . $page[0]['COUNT(pf.pf_page_id)'] . "<br>";
                        }
                        //uid 換上傳附件數
                        //--------------------------------------------------------------------------------
                        //uid 換下線數
                        $account = get_sql($con, "account", "WHERE a_parent='$uid'", "COUNT(a_id)");
                        if( $account ){
                            echo "下線數 : " . $account[0]['COUNT(a_id)'] . "<br>";
                        }
                        //uid 換下線數
                        //--------------------------------------------------------------------------------
                        //uid 換所有文章總點閱數
                        $page = get_sql($con, "page as p join channel as ch on p.p_channel_id = ch.ch_id", "WHERE ch.ch_user_id='$uid'", "sum(p.p_click_num)");
                        if( $page ){
                            echo "所有文章總點閱數 : " . $page[0]["sum(p.p_click_num)"] . "<br>";
                        }
                        //uid 換所有文章總點閱數
                        //--------------------------------------------------------------------------------
                        //echo all uid list
                        $account = get_sql_array($con, "account", array("a_id"));
                        if( $account ){
                            echo "all uid list : ";
                            print_r($account);
                        }
                        //echo all uid list
                ?>

                
        </body>
        
</html>
