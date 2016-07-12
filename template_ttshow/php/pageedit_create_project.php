<?php 
        include("config.php");
        include("global.php");
        include("SQL_table_control.php");
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        //user account get login session
        $user_mail = $_POST["user_mail"];
        $project = urldecode($_POST["project"]);
        
        
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
        
        $next = $contorl_table->select_AUTO_INCREMENT( "ttshow" , "draft" );
        //get user_id --
        
        
        if( $user_id != "undefined" ) {        
                //File ++
                $path = $server_website_path.$user_mail."\draft\\";
                $filepath = $path.$next."\\";
                $process_data = array( 
                    array(
                        path => $filepath,
                        name => "index.html",
                        content => " ",
                    ),
                    array(
                        path => $filepath,
                        name => "index.html.edit",
                        content => '<div style="display: block;" class="lyrow ui-draggable">
                                            <a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>
                                            <span class="drag label label-default" style="margin-right: -10px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>
                                            <span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>
                                            <div class="preview"><input value="12" class="form-control" type="text"></div>
                                            <div class="view">
                                                <div class="row-fluid clearfix">
                                                    <div class="col-md-12 column ui-sortable"><div style="display: block;" class="box box-element ui-draggable">
                <a href="#close" class="remove label label-danger"><i class="glyphicon glyphicon-remove icon-white"></i></a>
                <span class="drag label label-default"><i class="glyphicon glyphicon-hand-right"></i></span>
                <span class="configuration">         
                 </span>
                <div class="preview drag"><i class="glyphicon glyphicon-font"></i> <b changelanguage="1">Description 1</b> </div>
                <div class="view">
                        <p contenteditable="true">Lorem ipsum dolor sit amet, <b>consectetur adipiscing
 elit.</b> Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus
 eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed
 iaculis posuere diam ut cursus. Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo
 imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui. Proin massa magna, vulputate
 nec bibendum nec, posuere nec lacus. Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla
 euismod ultrices massa, et feugiat ipsum consequat eu.  </p>
                </div>
            </div><div style="display: block;" class="box box-element ui-draggable"> 
                                <a href="#close" class="remove label label-danger">
                                                <i class="glyphicon glyphicon-remove icon-white"></i>
                                </a>
                                <span class="drag label label-default"><i class="glyphicon glyphicon-hand-right"></i></span> 
                                <span class="configuration"> 

                                <span class="btn-group">
                                <button type="button" class="btn btn-default btn-xs" data-target="#myModalforiframe" role="button" data-toggle="modal"> URL </button>
                                </span>
                                </span>
                                <div class="preview drag"><i class="glyphicon glyphicon-picture"></i> <b changelanguage="1">Image</b> </div>
                                <div class="view">
                                        <center> <img mmid="1" key="img" style="width: 300px;" class="" src="http://cdn.ypcall.com/Builder/PD/image/image01.jpg"> </center>
                                </div>
                     </div></div>
                                                </div>
                                            </div>
                                        </div>',
                    ),
                    array(
                        path => $filepath,
                        name => "index.html.publish",
                        content => " ",
                    ),
                );
                $process_file = PublishProject( $process_data );
                //File --

                //SQL ++ 
                $time = date("Y-m-d H:i:s");
                $data = array(
                    "user_id" => $user_id,
                    "photo_list" => "{}",
                    "movie_list" => "{}",
                    "name" => $contorl_table->Check_mysqli_real_escape_string($project),
                    "state" => "uncheck",
                    "date" => $time
                );
                //SQL --

                if( $process_file == "true" ) {
                    $process_DB = $contorl_table->table_add_insert("draft", $data);
                }

                if( $process_DB == "true" && $process_file == "true" ) {
                    echo "true";
                } else {
                    echo "false";
                }
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
                if( !file_exists($data[0]["path"]) ) {
                        $old = umask(0); 
                        mkdir( $data[0]["path"] , 0777 );
                        umask($old);
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
                } else {
                        return "false";
                }
        }
?>
