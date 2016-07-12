<?php 
        include("php_lib/json/Services_JSON.php");
        include("FileManage.php");

        $json = new Services_JSON();
        $FileManage = new FileManage();
        $RootPath = "C:\\AppServ\\www\\ttshow\\account\\";
        
        if (isset($_POST["cmd"]) && !empty($_POST["cmd"])) { //Checks if action value exists
                $cmd = $_POST["cmd"];
                switch($cmd) { //Switch case for value of action
                    case "list_dir": 
                        $Receive_Data = array( "cmd" , "user" , "path" );
                        $Receive_Data = Check_Ajax_Data("POST" , $Receive_Data);
                        if( gettype($Receive_Data) != "string" ){
                            $array = $FileManage->listdir( $RootPath.$Receive_Data["user"]."\\edit\\".$Receive_Data["path"]."\\" );
                            if( $array != false ) {
                                $data = YPAjaxJson_init_Children( $array );
                                $output = $json->encode( $data );
                                echo $output;
                            } else {
                                echo "false";
                            }
                        }
                        break;
                    case "mk_dir": 
                        $Receive_Data = array( "cmd" , "user" , "path" );
                        $Receive_Data = Check_Ajax_Data("POST" , $Receive_Data);
                        if( gettype($Receive_Data) != "string" ){
                            $array = $FileManage->mkDir( $RootPath.$Receive_Data["user"]."\\edit\\".$Receive_Data["path"]."\\" , "0777" );
                            $output = $json->encode( $array );
                            echo $output;
                        }
                        break;
                    case "delete_dir": 
                        $Receive_Data = array( "cmd" , "user" , "path" );
                        $Receive_Data = Check_Ajax_Data("POST" , $Receive_Data);
                        if( gettype($Receive_Data) != "string" ){
                            $array = $FileManage->DeleteFolder( $RootPath.$Receive_Data["user"]."\\edit\\".$Receive_Data["path"]."\\" );
                            $output = $json->encode( $array );
                            echo $output;
                        }
                        break;
                    case "mk_file":
                        $Receive_Data = array( "cmd" , "user" , "path" , "src");
                        $Receive_Data = Check_Ajax_Data("POST" , $Receive_Data);
                        if( gettype($Receive_Data) != "string" ){
                            $array = $FileManage->mkFile( $RootPath.$Receive_Data["user"]."\\edit\\".$Receive_Data["path"] , $src );
                            //$data = YPAjaxJson_init_Children( $array );
                            $output = $json->encode( $array );
                            echo $output;
                        }
                        break;
                    case "delete_file":
                        $Receive_Data = array( "cmd" , "user" , "path" );
                        $Receive_Data = Check_Ajax_Data("POST" , $Receive_Data);
                        if( gettype($Receive_Data) != "string" ){
                            $array = $FileManage->DeleteFile( $RootPath.$Receive_Data["user"]."\\edit\\".$Receive_Data["path"]."\\".$Receive_Data["path"].".html" );
                            if( $array ) {
                                $array = $FileManage->DeleteFile( $RootPath.$Receive_Data["user"]."\\edit\\".$Receive_Data["path"]."\\".$Receive_Data["path"].".html.edit" );
                            } else { }
                            //$data = YPAjaxJson_init_Children( $array );
                            $output = $json->encode( $array );
                            echo $output;
                        }
                        break;
                    case "move_file":
                        $Receive_Data = array( "cmd" , "user" , "srcPath" , "movePath" );
                        $Receive_Data = Check_Ajax_Data("POST" , $Receive_Data);
                        if( gettype($Receive_Data) != "string" ){
                            $array = $FileManage->MoveFile( $RootPath.$Receive_Data["user"]."\\".$Receive_Data["srcPath"] , $RootPath.$Receive_Data["user"]."\\".$Receive_Data["movePath"]."\\".$Receive_Data["srcPath"] );
                            //$data = YPAjaxJson_init_Children( $array );
                            $output = $json->encode( $array );
                            echo $output;
                        }
                        break;
                    case "read_file" :
                        $Receive_Data = array( "cmd" , "user" , "path" );
                        $Receive_Data = Check_Ajax_Data("POST" , $Receive_Data);
                        if( gettype($Receive_Data) != "string" ) {
                            $array = $FileManage->ReadFile( $RootPath.$Receive_Data["user"]."\\edit\\".$Receive_Data["path"] );
                            //$data = YPAjaxJson_init_Children( $array );
                            //$output = $json->encode( $array );
                            echo $array;
                        }                         
                        break;
                }
        }
        
        function Check_Ajax_Data( $type , $data ) {
                $newData = array();
                if( $type == "GET" ) {
                        foreach ($data as $value) {
                                if( isset($_GET[$value]) && !empty($_GET[$value]) ) {
                                        $newData[$value] = $_GET[$value];
                                } else {
                                        return "\$_GET['".$value."'] is undefined!! ";
                                }
                        }
                } else if( $type == "POST" ) {
                        foreach ($data as $value) {
                                if( isset($_POST[$value]) && !empty($_POST[$value]) ) {
                                        $newData[$value] = $_POST[$value];
                                } else {
                                        return "\$_POST['".$value."'] is undefined!! ";
                                }
                        }                    
                }
                return $newData;
        }
        
        function YPAjaxJson_init_Children( $files ) {
                $yp_data = array(
                            "ErrCode" => 0 , 
                            "ErrMsg" => "OK",
                            "MsgCount"=>1,
                            "Msg"=> array(
                                array(
                                    "MsgFrom"=>"shell@ypdrive",
                                    "Data"=> array(
                                            "body" => array(
                                                    "response"=>"ls",
                                                    "mpath"=>"/(myapps)/builder",
                                                    "ErrCode"=>0,
                                                    "ErrMsg"=>"OK",
                                                    "pagesize"=>500,
                                                    "fs"=> array(
                                                            "name"=>"/(myapps)/builder",
                                                            "url"=>"http=>//myapps.ypcloud.com/f0666f71-83c2-4693-9f70-6b4034ac0223/builder/",
                                                            "upload"=>"http=>//cd3.ypcall.com/upload/jsk/upload.jsk",
                                                            "totalfolder"=>138,
                                                            "totalfile"=>0,
                                                            "totalsize"=>0,
                                                            "totalpage"=>1,
                                                            "folderno"=>138,
                                                            "fileno"=>0,
                                                            "filesize"=>0,
                                                            "pageno"=>1,
                                                            "children"=>$files
                                                    )
                                            )
                                    )
                                ),
                            )
                        );
                return $yp_data;
        }
?>