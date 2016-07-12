<?php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "init":
        $echo = init();
        break;
    case "manage_img":
        $echo = manage_img();
        break;
    case "publish":
        $echo = publish();
        break;
}

echo json_encode($echo);

function init(){
        $callback = array();
        try{
                if( check_empty( array( "token" , "cmd" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $cmd = $_REQUEST["cmd"];
                    $json = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    if( $cmd === "init_modify" ){
                            if( check_empty( array( "page" ) ) ) {
                                    $page_id = $_REQUEST["page"];
                                    //check page owner++
                                    $page = get_sql( $con , 
                                            "account as a join channel as b join page as c on b.ch_id = c.p_channel_id AND a.a_id = b.ch_user_id" , 
                                            "where c.page_id=$page_id" );
                                    
                                    if( !$page ){
                                            $callback['msg'] = "page isnt exist.";
                                            $callback['success'] = false;
                                            mysqli_close($con);
                                            return $callback;
                                    }
                                    
                                    if( $account[0]['a_admin'] !== "true" && $page[0]['a_id'] !== $account[0]['a_id'] ){
                                            $callback['msg'] = "you dont have admin";
                                            $callback['success'] = false;
                                            mysqli_close($con);
                                            return $callback;
                                    }
                                    else{
                                            $json["page"] = array();
                                            $json["page"]["page_id"] = $page[0]["page_id"];
                                            $json["page"]["p_channel_id"] = $page[0]["p_channel_id"];
                                            $json["page"]["p_display"] = $page[0]["p_display"];
                                            $json["page"]["p_photo_list"] = $page[0]["p_photo_list"];
                                            $json["page"]["p_icon"] = http_page_path.$page_id."/"."Original/".$page[0]["p_icon"];
                                            $json["page"]["p_category_id"] = $page[0]["p_category_id"];
                                            $json["page"]["p_tag"] = $page[0]["p_tag"];
                                            $json["page"]["p_title"] = $page[0]["p_title"];	
                                            $json["page"]["p_originality"] = $page[0]["p_originality"];
                                            $json["page"]["p_edit_html"] = $page[0]["p_edit_html"];
                                            $json["page"]["p_pre_html"] = $page[0]["p_pre_html"];
                                            $json["page"]["p_date"] = $page[0]["p_date"];
                                            $json["page"]["p_img_path"] = http_page_path.$page_id."/";
                                            //attach
                                            $page_file = get_sql_array($con, "page_file", array( "pf_id","pf_des","pf_name","pf_original_name","pf_download_num" ),"WHERE pf_page_id=$page_id");
                                            $json["page"]["page_file"] = $page_file ? $page_file : array();
                                    }
                                    //check page owner--
                            }
                            else{
                                    $callback['msg'] = "parameter is error.";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                    }
                    else if( $cmd === "init_edit" ){
                            
                    }
                    else{
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    //管理者可以看到所有頻道，使用所有頻道發文
                    /*if( $account[0]["a_admin"] === "true" ){
                        $channel = get_sql($con, "channel");
                        if( $channel ){
                                $channel_arr = array();
                                foreach ($channel as $key => $value) {
                                        $channel_arr[] = array( "ch_id" => $value["ch_id"] , "ch_name" => $value["ch_name"] );
                                }
                                $json["channel"] = $channel_arr;
                        }
                        else{
                                $callback['msg'] = "Dont have channel";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                    }
                    else{*/
                    $channel = get_sql($con, "channel", "WHERE ch_user_id='" . $account[0]["a_id"] ."'");
                    if( $channel ){
                            $channel_arr = array();
                            foreach ($channel as $key => $value) {
                                    $channel_arr[] = array( "ch_id" => $value["ch_id"] , "ch_name" => $value["ch_name"] );
                            }
                            $json["channel"] = $channel_arr;
                    }
                    else{
                            $callback['msg'] = "Dont have channel";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    //}
                    
                    $category = get_sql($con, "category" );
                    if( $category ) {
                            $category_arr = array();
                            foreach ($category as $key => $value) {
                                    $category_arr[] = array( "cate_id" => $value["cate_id"] , "cate_name" => $value["cate_name"] , "cate_display" => $value["cate_display"] );
                            }
                            $json["category"] = $category_arr;
                    }
                    else {
                            $callback['msg'] = "get category fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $callback['data'] = $json;
                    $callback['success'] = true;
                            
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                }
                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function manage_img(){
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                    
                    $token = md5( $_REQUEST[ "token" ] );
                    $json = array();
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $callback['data'] = list_user_img( $account[0]["a_id"] );
                    $callback['success'] = true;
                            
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                }
                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function publish(){
        
        include("emoji.php");
        ini_set( "memory_limit", "512M");
        
        $callback = array();
        try{
                if( check_empty( array( "token","cmd","p_category_id","p_channel_id"
                                        ,"p_data","p_pre_html","p_edit_html","p_html","p_tag","p_title","p_annex","p_originality" ) ) ) {
                    
                    date_default_timezone_set('Asia/Taipei');
                    $token = md5( $_REQUEST[ "token" ] );
                    $cmd = $_REQUEST[ "cmd" ];
                    $p_category_id = $_REQUEST[ "p_category_id" ];//
                    $p_channel_id = $_REQUEST[ "p_channel_id" ];//
                    //$p_content = $_REQUEST[ "p_content" ];
                    $p_data = $_REQUEST[ "p_data" ];
                    $p_pre_html = $_REQUEST[ "p_pre_html" ];
                    $p_edit_html = $_REQUEST[ "p_edit_html" ];
                    $p_html = $_REQUEST[ "p_html" ];
                    $p_tag = $_REQUEST[ "p_tag" ];//
                    $p_title = $_REQUEST[ "p_title" ];//
                    $p_annex = $_REQUEST[ "p_annex" ];//
                    $p_originality = $_REQUEST[ "p_originality" ];//
                    
                    if( !in_array($p_originality, array("true","false")) ){
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $json = array();
                    $json["p_tag"] = $p_tag;
                    $json["p_title"] = $p_title;
                    $json["p_originality"] = $p_originality === "true" ? 1 : 0;
                    //$json["p_content"] = stripslashes($p_content);
                    
                    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $con->query("SET NAMES utf8");
                    // Check connection
                    if (mysqli_connect_errno()) {
                            $callback['msg'] = "SQL connect fail";
                            $callback['success'] = false;
                            return $callback;
                    }
                    
                    $json["p_pre_html"] = mysqli_real_escape_string($con,stripslashes($p_pre_html));
                    $json["p_edit_html"] = mysqli_real_escape_string($con,stripslashes($p_edit_html));
                    $json["p_html"] = mysqli_real_escape_string($con,stripslashes($p_html));
                    
                    $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                    if( !$account ) {
                            $callback['msg'] = "Login fail";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    //check channel admin++
                    if( $account[0]["a_admin"] === "true" ){
                        $channel = get_sql($con, "channel", "WHERE ch_id=$p_channel_id");
                        if( !$channel ) {
                                $callback['msg'] = "channel is not exist";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        $json["p_channel_id"] = (int)$p_channel_id;
                    }
                    else{
                        $channel = get_sql($con, "channel", "WHERE ch_user_id='".$account[0]["a_id"]."' AND ch_id=$p_channel_id");
                        if( !$channel ) {
                                $callback['msg'] = "you dont have admin of channel";
                                $callback['success'] = false;
                                mysqli_close($con);
                                return $callback;
                        }
                        $json["p_channel_id"] = (int)$p_channel_id;
                    }
                    //check channel admin--
                    
                    //check category exist++
                    $category = get_sql($con, "category", "WHERE cate_id=$p_category_id");
                    if( !$category ) {
                            $callback['msg'] = "category is not exist";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    $json["p_category_id"] = (int)$p_category_id;
                    //check category exist--
                    
                    if( $cmd === "edit" ){
                            
                            if( !check_empty( array( "p_icon" ) ) ){
                                    $callback['msg'] = "parameter is error.";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $p_icon = $_REQUEST[ "p_icon" ];
                            
                            //mkdir ++
                            $result = mysqli_query($con,"SHOW TABLE STATUS LIKE 'page'");
                            $row = mysqli_fetch_array($result);
                            $page_id = $row['Auto_increment'];
                            $page_path = page_path.$page_id."\\";
                            $dirName = array(
                                    $page_path ,
                                    $page_path."Original" ,
                                    $page_path."Preview" ,
                                    $page_path."ThumbnailM" ,
                                    $page_path."ThumbnailS" ,
                                    $page_path."Attachment"
                            );
                            for( $i=0 ; $i<count($dirName) ; $i++ ) {
                                if( !file_exists( $dirName[$i] ) ) {
                                    $old = umask(0); 
                                    mkdir( $dirName[$i] , 0777 );
                                    umask($old);
                                }
                            }
                            //mkdir -- 
                            $json["page_id"] = (int)$page_id;
                            
                            if( !$json["p_icon"] = move_page_icon( $account , $p_icon , $page_path ) ){
                                    $callback['msg'] = "page icon not exist";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                    }
                    else if( $cmd === "modify" ){
                            
                            if( !check_empty( array( "page_id" ) ) ){
                                    $callback['msg'] = "parameter is error.";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $page_id = $_REQUEST[ "page_id" ];
                            
                            //check page owner++
                            $page = get_sql( $con , 
                                    "account as a join channel as b join page as c on b.ch_id = c.p_channel_id AND a.a_id = b.ch_user_id" , 
                                    "where c.page_id=$page_id" );
                            
                            if( !$page ){
                                    $callback['msg'] = "page is not exist";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            if( $account[0]["a_admin"] !== "true" && $account[0]['a_id'] !== $page[0]["a_id"] ){
                                    $callback['msg'] = "you dont have admin";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            //check page owner--
                            $update_json = array( "page_id" => $page_id );
                            
                            $page_path = page_path.$page_id."\\";
                            
                            if( check_empty( array( "p_icon" ) ) ){
                                    $p_icon = $_REQUEST[ "p_icon" ];
                                    if( !$json["p_icon"] = move_page_icon( $account , $p_icon , $page_path ) ){
                                            $callback['msg'] = "page icon not exist";
                                            $callback['success'] = false;
                                            mysqli_close($con);
                                            return $callback;
                                    }
                            }
                            //update attach description++
                            if( check_empty( array( "update_attach_des" ) ) ){
                                    $update_attach_des = $_REQUEST[ "update_attach_des" ];
                                    foreach ($update_attach_des as $key => $value) {
                                            if( !update_sql($con, "page_file", array( "pf_des" => $value["pf_des"] ), array( "pf_id" => $value["pf_id"] , "pf_page_id" => (int)$page_id )) ){
                                                    $callback['msg'] = "更新附件資料失敗";
                                                    $callback['success'] = false;
                                                    mysqli_close($con);
                                                    return $callback;
                                            }
                                    }
                            }
                            //update attach description--
                    }
                    else{
                            $callback['msg'] = "parameter is error.";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    //process img  ++
                    $sql_photo_list = array();
                    $content_data = json_decode( stripslashes($p_data) );
                    foreach ( $content_data as $key => $value) {
                        if( $key == "img" ) {
                            foreach ( $value as $key => $value) {
                                $subname = substr( $value , strrpos( $value , ".")+1 , strlen( $value )+1-strrpos($value, ".") );
                                $sql_photo_list[] = "image_".$key.".".$subname;
                                copy( $value , $page_path."image_".$key.".".$subname );
                            }
                        } else if( $key == "movie" ){
                            $sql_movie_list = json_encode($value);
                        }
                    }
                    $sql_photo_list = json_encode( $sql_photo_list );
                    if( $sql_photo_list == "null" ) {
                        $sql_photo_list = "{}";
                    }
                    $json["p_photo_list"] = $sql_photo_list;
                    $json["p_movie_list"] = $sql_movie_list;
                    //process img  --
                    //process annex ++
                    $p_annex = json_decode( $p_annex , true );
                    if( !empty( $p_annex ) ){
                        foreach ($p_annex as $key => $value) {
                            $file_from = upload_transient_file.$value['filename'];
                            if( !file_exists($file_from) ){
                                    $callback['msg'] = "附件有錯誤，找不到附件檔案";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            $i = 0;
                            $filefinalname = $value['filename'];
                            $file_to = $page_path."Attachment/".$filefinalname;
                            WHILE(TRUE){
                                    if( file_exists($file_to) ){
                                            if( $i === 0 ){
                                                $filename = substr( $value['filename'] , 0 , strrpos( $value['filename'] , ".") );
                                                $subname = substr( $value['filename'] , strrpos( $value['filename'] , ".")+1 , strlen( $value['filename'] )-strrpos($value['filename'],".")-1 );
                                            }
                                            $i++;
                                            $filefinalname = $filename."_".(string)$i.".".$subname;
                                            $file_to = $page_path."Attachment/".$filefinalname;
                                    }
                                    else{
                                            break;
                                    }
                            }
                            if( !copy( $file_from , $file_to ) ){
                                    $callback['msg'] = "附件有錯誤，上傳失敗";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                            while( 1 ){
                                $pf_id = getRandom( 20 );
                                $result = mysqli_query($con, "SELECT * FROM page_file WHERE pf_id='$pf_id'");
                                if (mysqli_num_rows($result) == 0) {
                                        break;
                                }
                            }
                            $insert_array = array( "pf_id" => $pf_id ,
                                                   "pf_page_id" => (int)$page_id ,
                                                   "pf_name" => $filefinalname ,
                                                   "pf_des" => $value["des"] ,
                                                   "pf_original_name" => $value["fileOriname"] ,
                                                   "pf_size" => filesize($file_to) ,
                                                   "pf_date" => date("Y-m-d H:i:s") );
                            
                            if( !insert_sql($con, "page_file", $insert_array) ){
                                    $callback['msg'] = "附件資料有錯誤，上傳失敗";
                                    $callback['success'] = false;
                                    mysqli_close($con);
                                    return $callback;
                            }
                        }
                    }
                    //process annex --
                    if( $cmd === "edit" ){
                            
                            $json["p_date"] = date("Y-m-d H:i:s");
                            $json["p_display"] = "block";
                            
                            if( insert_sql($con, "page", $json) ){
                                
                                database_add_post_num( $con , $p_channel_id );
                                $callback['data'] = $page_id;
                                $callback['success'] = true;
                            }
                            else {
                                $callback['msg'] = "發佈失敗";
                                $callback['success'] = false;
                            }
                            
                    }
                    else if( $cmd === "modify" ){
                            
                            if( update_sql($con, "page", $json, $update_json) ){
                                $callback['data'] = $page_id;
                                $callback['success'] = true;
                            }
                            else {
                                $callback['msg'] = "儲存失敗";
                                $callback['success'] = false;
                            }
                            //update_sql($con, "page", $json, $keyword)
                    }
                    
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                }
                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function database_add_post_num( $con , $ch ){
        
        $w = date('Y-W');
        
        $channel_post_num_w = get_sql($con, "channel_post_num_w" , "WHERE ch_postw_channel_id=$ch AND ch_postw_w='$w'");
        if( $channel_post_num_w ){
                $sql = "UPDATE channel_post_num_w SET ch_postw_num=ch_postw_num+1 WHERE ch_postw_id=" . $channel_post_num_w[0]['ch_postw_id'];
                mysqli_query( $con , $sql );
        }
        else {
                mysqli_query($con,"INSERT INTO channel_post_num_w( ch_postw_channel_id, ch_postw_num, ch_postw_w ) VALUES ( $ch, 1, '$w')");
        }
        
}

function move_page_icon( $account , $p_icon , $page_path ){
        
        $filepath_from = account_path.$account[0]["a_id"]."\\Original\\".mb_convert_encoding($p_icon,"big5","UTF-8");
        //process pageicon  ++
        if( file_exists( $filepath_from ) ) {
                $subname = substr( $p_icon , strrpos( $p_icon , ".")+1 , strlen( $p_icon )+1-strrpos($p_icon, ".") );
                $filepath_to = $page_path."Original\\pagicon.".$subname;
                copy( $filepath_from , $filepath_to );
                mkdir_trun_picture( $filepath_to , $page_path , "pagicon.".$subname );
                return "pagicon.".$subname;
        }
        else{
                return false;
        }
        //process pageicon  -- 
}



function mkdir_trun_picture( $src , $to , $fileName ) {
        $data = array(
            array(
                "path"  => $to."ThumbnailS",
                "width" => 240,
                "height" => 180
            ),
            array(
                "path"  => $to."ThumbnailM",
                "width" => 480,
                "height" => 360
            ),
            array(
                "path"  => $to."Preview",
                "width" => 1920,
                "height" => 1080
            ),
        );

        $filetype = substr( $fileName , strrpos($fileName, ".")+1 , strlen($fileName)+1-strrpos($fileName, ".") );
        for( $i=0; $i<count($data); $i++ ) {
                //mkdir( $data[$i]["path"], 0777);
                list($width, $height) = getimagesize( $src );   

                if( $data[$i]["width"]/$width > $data[$i]["height"]/$height )
                    $data[$i]["width"] = $width*$data[$i]["height"]/$height;
                else if( $data[$i]["height"]/$height > $data[$i]["width"]/$width )
                    $data[$i]["height"] = $height*$data[$i]["width"]/$width;

                $process_img = imagecreatetruecolor($data[$i]["width"], $data[$i]["height"]);
                imagealphablending($process_img,false);                     
                imagesavealpha($process_img,true);

                if( strtolower($filetype) === "gif" ) {
                    $source = imagecreatefromgif( $src );
                    imagesavealpha($source,true);
                    imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);
                    imagegif ( $process_img , $data[$i]["path"]."/".$fileName );
                }
                else if( strtolower($filetype) === "jpeg" || strtolower($filetype) === "jpg") {
                    $source = imagecreatefromjpeg( $src );
                    imagesavealpha($source,true);
                    imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);

                    imagejpeg( $process_img , $data[$i]["path"]."/".$fileName );
                }
                else if( strtolower($filetype) === "png" ) {
                    $source = imagecreatefrompng( $src );
                    imagesavealpha($source,true);
                    imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);

                    imagepng ( $process_img , $data[$i]["path"]."/".$fileName );
                }
        }

}

function list_user_img( $account ) {
        $img_floder = account_path.$account."\\Original\\";
        $files = scandir( $img_floder );
        foreach($files as $key => $value) {
            $files[$key] = mb_convert_encoding($value, "UTF-8", "big5");
        }
        unset($files[0]);
        unset($files[1]);
        $files = array_values($files);
        $files["url"] = http_account_path.$account."/Original/";
        return $files;
}
?>
