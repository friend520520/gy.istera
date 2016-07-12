<?php 
        include("global.php");
        include("SQL_table_control.php");
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        $user_mail = $_POST["user_mail"];
        $path = $server_website_path.$user_mail."\draft\\";

        $project = urldecode($_POST["project"]);
        $project = iconv("UTF-8","BIG5", $project);
        
        $contorl_table->init_DBconnect($SQL_host, $SQL_account, $SQL_password, "ttshow");
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
        
        //cheack user ++
        $data = array(
            "user_id" => $user_id,
            "draft_id" => (int)$project,
        );
        $data = $contorl_table->select_table_column( "draft" , $data );
        if ($data->num_rows > 0) {
            $data = OpenProject( $project , $html , $edit , $path );
            echo $data;
        } else {
            echo "false";
        }
        //cheack user --
        
        function OpenProject( $project , $html , $edit , $path) {
                $filepath = $path.$project."\\index.html.edit";
                if( file_exists($filepath) ) {
                    $fh = fopen( $filepath, 'r');
                    if( filesize($filepath) != 0 ) {
                        $theData = fread($fh, filesize($filepath));
                        fclose($fh);
                    } else {
                        $theData = "";
                    }
                } else {
                    $theData = "false";
                }
                return $theData;
        }
?>