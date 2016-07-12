<?php 
        include("global.php");
        include("SQL_table_control.php");
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        //user account get login session
        $user_mail = $_POST["user_mail"];

        $project = urldecode($_POST["project"]);
        $html = stripslashes($_POST["html"]);
        $edit = stripslashes($_POST["edit"]);
        $content = stripslashes($_POST["content"]);        
        $post_data = json_decode( stripslashes($_POST["data"]) );
        $photo_list = json_encode($post_data->{'img'});
        $movie_list = json_encode($post_data->{'movie'});
        
        //file ++
        $project_path = $server_website_path.$user_mail."\draft\\".iconv("UTF-8","BIG5", $project)."\\";
        $createData = array(
            array(
                path => $project_path,
                name => "index.html",
                content => $html,
            ),
            array(
                path => $project_path,
                name => "index.html.edit",
                content => $edit,
            ),
            array(
                path => $project_path,
                name => "index.html.publish",
                content => $content,
            ),
        );
        $process_file = PublishProject( $createData );
        //file --
        
        //SQL ++
        $contorl_table->init_DBconnect($SQL_host, $SQL_account, $SQL_password, "ttshow");
        $time = date("Y-m-d H:i:s");
        $data = array(
            "photo_list" => $photo_list,
            "movie_list" => $movie_list,
            "date" => $time
        );
        $target = array(
            "draft_id" => $project
        );
        $process_sql = $contorl_table->table_update( "draft",$data,$target );
        //SQL --
        
        if( $process_file == "true" && $process_sql == "true" ) {
            echo "true";
        } else {
            echo "false";
        }

        /* --------------------------------------------*
         * example $data to PublishProject() function  *
         * --------------------------------------------*
        $data = array( 
            array(
                path => "C:\AppServ\www\\ttshow\account\abc@gmail\\test\\",
                name => "hello.html",
                content => "hello",
            ),
        );
        PublishProject( $data );
        */
        function PublishProject( $data ) {
                for( $i=0; $i<count($data); $i++ ) {
                        $filepath = $data[$i]["path"].$data[$i]["name"];
                        if( file_exists($filepath) ) {
                            unlink( $filepath );
                        }
                        $file = fopen( $filepath  ,"x+"); //開啟檔案
                        header("Content-Type:text/html; charset=utf-8");
                        fwrite($file , $data[$i]["content"]);
                        fclose($file);
                }
                return "true";
        }
?>