<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        $specialtag_id = (int)$_POST["specialtag_id"];
        //$specialtag_id = 1;

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        if( isset($specialtag_id) && !empty($specialtag_id) )  {
                $data = array(
                    "id" => $specialtag_id,
                );
                $data = $contorl_table->select_table_column( "specialtag" , $data );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{"name"} = $row["name"];
                        $files{"img_path"} = $row["img_path"];
                        $files{"page"} = "";
                    }
                } else {
                    echo "false";
                }
                
                //$cmd = "select * from page as a , user as b where a.user_id = b.user_id AND a.special_tag_id = ".$specialtag_id;
                $cmd = "select * from page as a , user as b , category as c where a.class = c.id AND a.user_id = b.user_id AND a.special_tag_id = ".$specialtag_id;
                $data = $contorl_table->SQL_cmd( $cmd );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{"page"}[] = array(
                            "user_name" => $row["user_name"],
                            //"usericon" => "http://".$_SERVER["SERVER_NAME"]."/ttshow/account/".$row["facebook_mail"]."/Profile/".$row["usericon"],
                            "usericon" => $row["usericon"],
                            "article_icon" => "http://".$_SERVER["SERVER_NAME"]."/web/data/".$row["page_id"]."/".$row["article_icon"],
                            "c_num_click" => $row["c_num_click"],
                            "class" => $row["name"],
                            "title" => $row["title"],
                            "describe" => $row["describe"],
                            "appraisal" => $row["appraisal"],
                            "date" => $row["date"],
                        );
                    }
                } else {
                    echo "false";
                }
                
                echo json_encode( $files );
        } else {
                echo "false";
        }
        
?>