<?php 
        include("php_lib/json/Services_JSON.php");
        include("global.php");
        $json = new Services_JSON();
        
        //user account get login session
        $user = "abc@gmai.com";
        
        $path = $server_website_path.$user."\edit";
        
        $data =  ListProject( $project , $html , $edit );
        if( $data == null ) {
                echo "false";
        } else {
                echo $output = $json->encode( YPAjaxJson_init_Children($data) );
        }
                
        function ListProject() {
            global $path;
            $handle = opendir( $path ); 
            while (($file = readdir($handle)) !== false) {
                if ($file == '.' || $file == '..') { 
                    continue;
                } 
                $filepath = $path == '.' ? $file : $path . '/' . $file; 
                if (is_link($filepath)) {
                    continue;
                }
                if (is_file($filepath)) {
                    $filepath = str_replace("/","\\",$filepath);
                    $files[] = array(
                        "type" => "file" ,
                        "path" => $filepath ,
                        "name" => urlencode( iconv("BIG5","UTF-8", substr( $filepath , strrpos($filepath, "\\")+1 , strlen($filepath)+1 - strrpos($filepath, "\\") ) ) )
                    );
                }
                else if (is_dir($filepath)) {
                    $filepath = str_replace("/","\\",$filepath);
                    $files[] = array(
                        "type" => "folder" ,
                        "path" => $filepath ,
                        "name" => urlencode( iconv("BIG5","UTF-8", substr( $filepath , strrpos($filepath, "\\")+1 , strlen($filepath)+1 - strrpos($filepath, "\\") ) ) )
                    );
                } 
            }
            closedir($handle); 
            return $files;
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