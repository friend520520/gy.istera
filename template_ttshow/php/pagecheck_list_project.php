<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        $user_mail = $_POST["user_mail"];

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        //get user_id ++
        $data = array(
            "facebook_mail" => $user_mail,
        );
        $data = $contorl_table->select_table_column( "user" , $data );
        if ($data->num_rows > 0) {
            $row = $data->fetch_assoc();
            $user_id = (int)$row["user_id"];
        } else {
            $user_id = "undefined";
        }
        //get user_id --
        
        if( $user_id != "undefined" && $row["usertype"] == "manage" || $row["usertype"] == "root") {

                $cmd = "select *,b.user_name author,c.name class_name,a.name draft_name from examine as a join user as b join category as c on a.user_id = b.user_id AND a.class = c.id order by date asc";
                $data = $contorl_table->SQL_cmd( $cmd );

                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $row["name"] = urlencode($row["name"]);
                        $files[] = array(
                            "index" => $row["examine_id"],
                            "user" => $row["author"],
                            "path" => "http://".$_SERVER["SERVER_NAME"]."/ttshow/examine/".$row["examine_id"],
                            //"special_tag" => $row["special_tag_id"],
                            "article_icon" => "http://".$_SERVER["SERVER_NAME"]."/ttshow/examine/".$row["examine_id"]."/".$row["article_icon"] ,
                            "class" => urlencode($row["class_name"]),
                            "tag" => urlencode($row["tag"]),
                            "name" => $row["draft_name"],
                            "describe" => urlencode($row["describe"]),
                            "time" => $row["date"],
                        );
                    }
                    echo json_encode( $files );
                } else {
                    echo "false";
                }
        } else {
                echo "false";
        }
        
?>