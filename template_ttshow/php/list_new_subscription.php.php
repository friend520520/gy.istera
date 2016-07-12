<?php 
        include("config.php");
        //abin edit ++ 2015.4.30
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        //abin edit -- 2015.4.30
        
        try
        {
                    $fbuser = $_REQUEST['user'];
                    $callback = "";
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    
                    //SELECT * FROM articles 
                    $jsonData{'email'} = $fbuser;
                    $json = list_new_subscription( $contorl_table , $jsonData );
                    echo json_encode( $json );
        }
        catch (Exception $e)
        {
                echo "false";
        }
        

        function list_new_subscription( $contorl_table , $jsonData ) {
                    //get user_id ++
                    $data = array(
                        "facebook_mail" => $jsonData{'email'},
                    );
                    $data = $contorl_table->select_table_column( "user" , $data );
                    if ($data->num_rows > 0) {
                        $row = $data->fetch_assoc();
                        $user_id = (int)$row["user_id"];
                    } else {
                        $user_id = "undefined";
                    }
                    //get user_id --

                    $user_id = 92;
                    
                    if( $user_id != "undefined" ) {

                        $cmd = "select * from subscribe where user_id = ".$user_id;
                        
                        $data = $contorl_table->SQL_cmd( $cmd );
                        if ($data->num_rows > 0) {
                            while($row = $data->fetch_assoc()) {
                                    //select 5 page
                                    $cmd = "select *,a.name specialtag_name,b.date page_date,c.user_name author,d.name class_name,b.date history_date "
                                          ."from specialtag as a join page as b join user as c join category as d "
                                          ."on a.id = b.special_tag_id AND b.user_id = c.user_id AND b.class = d.id "
                                          ."where b.user_id = ".$row["author_id"]." order by history_date desc LIMIT 0, 5 ";
                                    $data2 = $contorl_table->SQL_cmd( $cmd );
                                    if ($data2->num_rows > 0) {
                                            while($row2 = $data2->fetch_assoc()) {
                                                    $files{"new"}[] = array(
                                                        "specialtag_name" => $row2["specialtag_name"],
                                                        "specialtag_icon" => $row2["img_path"],
                                                        "page_id" => $row2["page_id"],
                                                        "icon" => "http://".$_SERVER["SERVER_NAME"]."/ttshow/web/data/".$row2["page_id"]."/".$row2["article_icon"],
                                                        "title" => $row2["title"],
                                                        "author" => $row2["author"],
                                                        "author_id" => $row2["user_id"],
                                                        "author_icon" => $row2["usericon"],
                                                        "class" => $row2["class_name"],
                                                        "tag" => $row2["tag"],
                                                        "page_date" => $row2["page_date"],
                                                        "click" => $row2["c_num_click"],
                                                        "share" => $row2["share_num"],
                                                    );
                                            }
                                    }
                            }
                        }
                    }
                    
                    //add subscribe message ++
                    $data = array(
                        "user_id" => $user_id,
                    );
                    $data = $contorl_table->select_table_column( "subscribe" , $data );

                    if ($data->num_rows > 0) {
                        $i = 0;
                        $files{'subscribe'} = array();
                        while($row = $data->fetch_assoc()) {
                            $files{'subscribe'}[$i] = $row["author_id"];
                            $i++;
                        }
                        unset($files{'subscribe'}[$i-1]);
                    }
                    //add subscribe message --
                
                    $contorl_table->dis_DBconnect();
                    return $files;
                }
?>