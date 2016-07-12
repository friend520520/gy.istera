<?php


        include("global.php");
        include("php_lib/JSON/Services_JSON.php");
        $json = new Services_JSON();
        
        
        $path = $server_website_path;
        $url_path = $website_img_url;
        $id = $_REQUEST['account'];
        $size = $_REQUEST['size'];
        $output = array();
        
        if( $id === "" )
            $id = "default";
        
        $path = $path . $id . "/" . $size;
        
        $files = scandir( $path );
        unset($files[0]);
        unset($files[1]);
        $files["url"] = "http://".$_SERVER["SERVER_NAME"]."/ttshow/account/".$id."/$size/";
        //array_push($output, $files);
        
        //echo json_encode( ListProject( $path ) );
        //$output = $json->encode( ListProject( $path ) );
        
        if( $output === "null" )
            echo "empty";
        else
            echo json_encode ( $files );
        /*
        
        
        
        $result = array(); 
        
        
        $cdir = scandir( "upload" );
        echo $cdir;
        
        
        foreach ($cdir as $key => $value)
        {
            if (!in_array($value,array(".","..")))
            {
                    
                    $value = urlencode( mb_convert_encoding($value, "UTF-8", "big5") );
                    $result[] = array( "name" => "" ,
                                         "path" => $url . DIRECTORY_SEPARATOR . $value );
                    
            }
        }
        
        echo urldecode( json_encode( $result ) );
        */
        
// Open a known directory, and proceed to read its contents
function ListProject( $RootPath ) {
    //global $RootPath;
    global $url_path;
    global $id;
    global $size;
    
    $handle = opendir( $RootPath ); 
    while (($file = readdir($handle)) !== false) {
        if ($file == '.' || $file == '..') { 
            continue;
        } 
        $filepath = $RootPath == '.' ? $file : $RootPath . '/' . $file; 
        if (is_link($filepath)) {
            continue;
        }
        if (is_file($filepath)) {
            //$filepath = str_replace("/","\\",$filepath);
            $filepath_url = str_replace($RootPath, $url_path . "/" . $id . "/" . $size, $filepath);
            $files[] = array(
                "type" => "file" ,
                "path" => $filepath_url ,
                "name" => substr( $filepath , strrpos($filepath, "/")+1 , strlen($filepath)+1 - strrpos($filepath, "/") )
            );
        }
        else if (is_dir($filepath)) {
            //$filepath = str_replace("/","\\",$filepath);
            $files[] = array(
                "type" => "folder" ,
                "path" => $filepath ,
                "name" => substr( $filepath , strrpos($filepath, "/")+1 , strlen($filepath)+1 - strrpos($filepath, "/") )
            );
        }
    }
    closedir($handle); 
    return $files;
}

?>