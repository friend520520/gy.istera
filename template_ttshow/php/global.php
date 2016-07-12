<?php 
        /* php version 4.0 */
        $server_website_path 	= "/var/www/html/ttshow/account/";
        $server_examine_path    = "/var/www/html/ttshow/examine/";
        $server_page_path       = "/var/www/html/ttshow/web/data/";
        $server_channel_path    = "/var/www/html/ttshow/channel/";
        $server_contribute_path = "/var/www/html/ttshow/contribute/";
        
        $server_specialIcon_path = "/var/www/html/ttshow/Include_file/Img/Special_icon/";
        
        $server_page_img_path    = "/var/www/html/img/";
        
        $server_data_path 	= "D://...";
        
        $website_img_url        = "ttshow/account";
        $user_image_path        = "ttshow/web/data/";

        
        $upload_transient_file = "/var/www/html/ttshow/transient_file/";
	/* SQL  */
        $SQL_host     = "localhost";
        $SQL_account  = "root";
        $SQL_password = "ggyyggy";

	//
	// delete http://203.66.57.146/ttshow/account

	/* bohan */
	/* upload.php */
	//$user_upload_image_path


	/* abin */
        function settingUTCtime() {
                //GET UTC +8 time    ++
                $timezone = '+8:00';
                $timezone = preg_replace('/[^0-9]/', '', $timezone) * 36;
                $timezone_name = timezone_name_from_abbr(null, $timezone, true);
                date_default_timezone_set($timezone_name);
                //GET UTC +8 time    --
        }
        
        function DeleteFolder( $path ) {
                if ($handle = opendir($path)) {
                    $array = array();

                        while (false !== ($file = readdir($handle))) {
                            if ($file != "." && $file != "..") {

                                if(is_dir($path.$file))
                                {
                                    if(!@rmdir($path.$file)) // Empty directory? Remove it
                                    {
                                        $this->delete_directory($path.$file.'\\'); // Not empty? Delete the files inside it
                                    }
                                }
                                else
                                {
                                   @unlink($path.$file);
                                }
                            }
                        }
                        closedir($handle);

                        @rmdir($path);
                   return "true";
                }
                return "false";
        }
        
        function Copy_folder( $path , $pathTo) {
            if( file_exists( $pathTo )) {
                //DeleteFolder( $pathTo );
                rrmdir( $pathTo );
            }
            $bool = "true";
            copy_dir( $path, $pathTo );
            return $bool;
        }
        
        function copy_dir($from_dir,$to_dir){  
            if(!is_dir($from_dir)){  
                return false ;  
            } 

            $from_files = scandir($from_dir);  

            if(!file_exists($to_dir)){  
                $old = umask(0); 
                mkdir($to_dir,0777);
                umask($old);
            }  
            if( ! empty($from_files)){  
                foreach ($from_files as $file){  
                    if($file == '.' || $file == '..' ){  
                        continue;  
                    }  

                    if(is_dir($from_dir.'/'.$file)){
                        copy_dir($from_dir.'/'.$file,$to_dir.'/'.$file);  
                    }else{
                        copy($from_dir.'/'.$file,$to_dir.'/'.$file);  
                    }  
                }  
            }
            return true ;
        }
        
        
        function rrmdir($dir) {
            if (is_dir($dir)) {
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
                    }
                }
                reset($objects);
                rmdir($dir);
                return "true";
            }
            return "false";
         }
         
        function get_sql( $con , $table , $Condition , $Get )
        {
                $return = array();
                $i = 0;

                $result = mysqli_query($con, "SELECT * FROM $table WHERE $Condition");

                if ( mysqli_num_rows($result) > 0) {

                        $return[$i] = array();
                        while($row = mysqli_fetch_array($result)) {

                                    foreach ($Get as $key => $value) {
                                            $return[$i][$value] = $row[$value];
                                    }
                                    $i ++;

                        }
                        return $return;

                }
                else {
                        
                        $return[$i] = array();
                        foreach ($Get as $key => $value) {
                                $return[$i][$value] = "";
                        }
                        return $return;
                        
                }

        }

        function get_sql_array( $con , $table , $Condition , $Get )
        {
                $return = array();
                
                $result = mysqli_query($con, "SELECT * FROM $table WHERE $Condition");

                if ( mysqli_num_rows($result) > 0) {

                        while($row = mysqli_fetch_array($result)) {

                                    foreach ($Get as $key => $value) {
                                            $return[] = $row[$value];
                                    }

                        }

                        return $return;

                }
                else {
                        return $return;
                }

        }
         
        function get_sql2( $con , $table , $Condition , $Get )
        {
                $return = array();
                $i = 0;

                $result = mysqli_query($con, "SELECT * FROM $table WHERE $Condition");

                if ( mysqli_num_rows($result) > 0) {

                        $return[$i] = array();
                        while($row = mysqli_fetch_array($result)) {

                                    foreach ($Get as $key => $value) {
                                            $return[$i][$value] = $row[$value];
                                    }
                                    $i ++;

                        }
                        return $return;

                }
                else {
                    
                        return FALSE;
                        
                }

        }
        
        function get_sql_noGet( $con , $table , $Condition = "" )
        {
                $return = array();
                $i = 0;
                
                $result = mysqli_query($con, "SELECT * FROM $table $Condition");

                if ( mysqli_num_rows($result) > 0) {

                        //$return[$i] = array();
                        while($row = mysqli_fetch_array($result)) {

                                    $return[$i] = $row;
                                    $i ++;

                        }
                        return $return;

                }
                else {
                    
                        return FALSE;
                        
                }

        }

        function create_upright( $fbuser , $datarow , $bootstrap_class , $delete_icon = FALSE , $css = "padding: 0 15px 15px 0;" ) {
                    
                    if( $delete_icon )
                    {
                        $delete_icon_html = '<img src="template/assets/images/apply/x1.png" class="delete" style="cursor: pointer; width: 20px; position: absolute; right: 22px; top: 10px;">';
                        
                    }
                    else
                    {
                        $delete_icon_html = "";
                    }
                        
                    
                    global $user_image_path;
                    $tag_html = "";
                    
                    if( $datarow['tag'] === "[]" ) {
                            $tag_html .= '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">
                              超人氣
                            </span>
                            <span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">
                              超人氣
                            </span>
                            <span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;" >
                              超人氣
                            </span>';
                    }
                    else
                    foreach (json_decode($datarow['tag']) as $key => $value) {
                                    $tag_html .= '<a href="search_results.php?search=' . $value . '"><span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">' . $value . '</span></a>';
                    }
                    
                    $channel = get_sql( $con , "channel" , "channel_id=" . $datarow['channel_id'] , array( "ch_name" , "ch_icon" , "ch_type" ) );
                    
                    $author = get_sql( $con , "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" , "usericon" , "business" ) );

                    /*$special_icon_path = get_sql( $con , "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    if( $special_icon_path[0]['img_path'] === "" )
                        $specialtag = '';
                    else
                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]['img_path'] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' . $datarow['special_tag_id'] . '\'">';*/
                    if( (int)$datarow['share_num'] > 100000 )
                        $specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                    else if( (int)$datarow['share_num'] > 50000 )
                        $specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                    else if( (int)$datarow['share_num'] > 20000 )
                        $specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                    else if( (int)$datarow['share_num'] > 10000 )
                        $specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                    else
                        $specialtag = '';
                    
                    $class = get_sql( $con , "category" , "id='" . $datarow['class'] . "'" , array( "name" ) );
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';

                    if( $fbuser === "" )
                    {
                            $subscribe = '<button class="btn btn-sm btn-primary panel-float-right subscribe" style="padding: 0px 13px; border-radius: 3px; position: absolute; margin-top: 25px; top: auto; right: 17px;" channel="' . $datarow['channel_id'] . '">訂閱</button>';
                    }
                    else
                    {

                            $user1 = get_sql( $con , "user" , "facebook_mail='" . $fbuser . "'" , array( "user_id" ) );
                            $subscribe = get_sql_array( $con , " subscribe" , "user_id=" . $user1[0]["user_id"] , array( "channel_id" ) );
                            
                            if( in_array( $datarow['channel_id'] , $subscribe ) )
                                $subscribe = '<button class="btn btn-sm btn-primary panel-float-right subscribe already" style="padding: 0px 13px; border-radius: 3px; position: absolute; margin-top: 25px; top: auto; right: 17px;" channel="' . $datarow['channel_id'] . '">已訂閱</button>';
                            else
                                $subscribe = '<button class="btn btn-sm btn-primary panel-float-right subscribe" style="padding: 0px 13px; border-radius: 3px; position: absolute; margin-top: 25px; top: auto; right: 17px;" channel="' . $datarow['channel_id'] . '">訂閱</button>';
                            
                    }
                    
                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    $title = mb_strwidth($datarow['title'], "utf-8") <= 65 ? $datarow['title'] : mb_strimwidth( $datarow['title'] , 0 , 62, "", "utf-8") . "...";
                    
                    return '<div style="' . $css . '" class="' . $bootstrap_class . '" article="' . $datarow['page_id'] . '" user="' . $datarow['user_id'] . '">
                            <div index="1" class="panel panel-default chessboard-box">
                                <div class="panel-body chessboard-body"> ' .
                                    '<a>' .// href="cooperate.php?ch=' . $datarow['channel_id'] . '"BOHAN0717
                                        '<div style="background-image: url(' . $channel[0]["ch_icon"] . '); " class="chessboard-icon bg_top"></div>' .
                                    '</a>' .
                                    '<a class="chessboard-id" index="1">' . $channel[0]["ch_name"] . '</a>' .// href="cooperate.php?ch=' . $datarow['channel_id'] . '"BOHAN0717
                                    //'<div class="chessboard-type">' . $channel[0]["ch_type"] . '</div>' .0730email8
                                    $delete_icon_html .
                                    '<div>' . $subscribe . '</div>
                                    <span class="panel1-identity">' . $author[0]['business'] . '</span>
                                    <div class="chessboard-time">
                                      <i class="ace-icon glyphicon glyphicon-time chessboard-time-icon"></i>
                                      <span>'. $date .'</span>
                                    </div>
                                    <div class="clearfix"></div>' .
                                    '<div name="responsive_div_level1" style="margin-top: 15px;">' .
                                        '<a href="page-inner.php?page_id=' . $datarow['page_id'] . '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                            '<div style="background-image: url(' . $user_image_path . $datarow['page_id'] . "/ThumbnailM/" . $datarow['article_icon'] . '); " class="chessboard-bgcenter">' .
                                            '</div>' .
                                        '</a>' .
                                        /*'<div onclick=\'$( "#tabs" ).children( "ul" ).children( "li[pagetype=' . $datarow['class'] . ']" ).trigger("click");\' tab="' . $datarow['class'] . '" class="chessboard-transparent">
                                            <i class="ace-icon glyphicon glyphicon-film"></i>
                                            <span>' . $class[0]['name'] . '</span>
                                        </div>' .*/
                                        $specialtag .
                                    '</div>' .
                                    '<h4 class="upright-title">
                                        <a href="page-inner.php?page_id=' . $datarow['page_id'] . '" title="' . $datarow['title'] . '">' . $title . '</a>
                                    </h4>'.
                                    '<div class="col-xs-12" style="margin-bottom: 3px; padding: 0px;">'.
                                        '<span class="chessboard-view" style="width: 25%;">
                                              <i class="ace-icon fa fa-eye chessboard-icontext"></i>' .
                                              $datarow["c_num_click"] .
                                        '</span>
                                        <span class="chessboard-replay" style="width: 25%;">' .
                                              '<i class="ace-icon fa fa-share chessboard-icontext"></i>' .
                                              $datarow['share_num'] .
                                        '</span>
                                    </div>' .
                                    '<div class="col-xs-12" style="overflow-y: hidden; height: 46px; padding: 0px;">' .
                                            $tag_html .
                                    '</div>' .
                                '</div>
                            </div>
                        </div>';
        }
        
        function create_list( $datarow , $bootstrap_class , $css = "margin-bottom: 10px" , $delete_icon = FALSE ) {
                    
                    if( $delete_icon )
                    {
                        $delete_icon_html = '<img src="template/assets/images/apply/x1.png" class="delete" style="cursor: pointer; width: 20px; position: absolute; right: 5px; margin: auto 0px; top: 0px; bottom: 0px;">';
                    }
                    else
                    {
                        $delete_icon_html = "";
                    }
                    
                    global $user_image_path;
                    $tag_html = "";
                    
                    if( (int)$datarow['share_num'] > 100000 )
                        $specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                    else if( (int)$datarow['share_num'] > 50000 )
                        $specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                    else if( (int)$datarow['share_num'] > 20000 )
                        $specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                    else if( (int)$datarow['share_num'] > 10000 )
                        $specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                    else
                        $specialtag = '';
                    
                    $channel = get_sql( $con , "channel" , "channel_id=" . $datarow['channel_id'] , array( "ch_name" , "ch_icon" , "ch_type" ) );
                    
                    $author = get_sql( $con , "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" ) );

                    //$special_icon_path = get_sql( $con , "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );

                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';
                    

                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    return '<div style="' . $css . '" class="' . $bootstrap_class . '" article="' . $datarow['page_id'] . '">' .
                                    '<div class="col-xs-6" name="responsive_div_level1" style="padding: 1px; cursor: pointer;">' .
                                        '<a href="page-inner.php?page_id=' . $datarow['page_id'] . '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                            '<div style="background-image: url(' . $user_image_path . $datarow['page_id'] . "/ThumbnailM/" . $datarow['article_icon'] . '); " class="chessboard-bgcenter">' .
                                                //'<div class="cover-black-small_"></div>' .
                                                /*'<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                    '<i class="ace-icon fa fa-eye panel-icon"></i>' . $datarow["c_num_click"] .
                                                    '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $datarow['share_num'] .
                                                '</div>' .*/
                                            '</div>' .
                                        '</a>' .
                                    '</div>' .
                                    '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1" name="responsive_div_level1" style="margin: 0px; padding: 1px;">' .
                                        '<div  name="responsive_div" style="width: 100%;">' .
                                            '<a href="page-inner.php?page_id=' . $datarow['page_id'] . '">' .
                                                '<p style="color: gray; overflow-y: hidden; font-size: 14px; line-height: 19px; text-align: left; position: absolute; top: 0px; margin: 2px 0px 2px 9px;">' . data.title . '</p>' .
                                            '</a>' .
                                            '<c style="bottom: 0px; position: absolute; left: 0px; text-align: left; padding-left: 9px;">' .
                                                '<h6 style="color: gray; position: relative; margin-bottom: 5px; overflow: hidden; font-size: 2.8vw; height: 3.8vw;">' .
                                                    '<i class="ace-icon glyphicon glyphicon-user" style="margin-right: 10px"></i>' .
                                                    '<a>' .// href="cooperate.php?ch=' . $datarow['channel_id'] . '"BOHAN0717
                                                        '<span>' . $channel[0]["ch_name"] . '</span>' .
                                                    '</a>' .
                                                '</h6>' .
                                                '<div class="col-xs-12" style="margin-bottom: 3px; padding: 0px;">' .
                                                    '<span class="chessboard-view">' .
                                                      '<i class="ace-icon fa fa-eye chessboard-icontext">' .
                                                      '</i>' .
                                                      $channel[0]["num_click"] .
                                                    '</span>' .
                                                    '<span class="chessboard-replay">' .
                                                      '<i class="ace-icon fa fa-share chessboard-icontext">' .
                                                      '</i>' .
                                                      $channel[0]["share_num"] .
                                                    '</span>' .
                                                '</div>' .
                                            '</c>' .
                                        '</div>' .
                                        $delete_icon_html .
                                    '</div>' .
                            '</div>';
                    
        }

        function create_chessboard( $datarow , $bootstrap_class , $css ) {
                    
                    global $user_image_path;
                    $tag_html = "";
                    
                    
                    //$author = get_sql( $con , "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" ) );

                    /*$special_icon_path = get_sql( $con , "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    if( $special_icon_path[0]['img_path'] === "" )
                        $specialtag = '';
                    else
                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]["img_path"] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' . $datarow['special_tag_id'] . '\'">';*/
                    if( (int)$datarow['share_num'] > 100000 )
                        $specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                    else if( (int)$datarow['share_num'] > 50000 )
                        $specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                    else if( (int)$datarow['share_num'] > 20000 )
                        $specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                    else if( (int)$datarow['share_num'] > 10000 )
                        $specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                    else
                        $specialtag = '';
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';


                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    $title = mb_strwidth($datarow['title'], "utf-8") <= 65 ? $datarow['title'] : mb_strimwidth( $datarow['title'] , 0 , 62, "", "utf-8") . "...";
                    
                    return '<div class="' . $bootstrap_class . ' cover-text1" style="margin: 0px; ' . $css . '">' .
                            '<div style="padding: 0px;margin: 0" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' .
                                '<div name="responsive_div_level1">' .
                                    '<a href="page-inner.php?page_id=' . $datarow['page_id'] . '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                        '<div style="background-image: url(' . $user_image_path . $datarow['page_id'] . "/ThumbnailM/" . $datarow['article_icon'] . '); " class="chessboard-bgcenter">' .
                                            //'<div class="cover-black-small_"></div>' .
                                            /*'<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                '<i class="ace-icon fa fa-eye panel-icon"></i>' . $datarow["c_num_click"] .
                                                '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $datarow['share_num'] .
                                            '</div>' .*/
                                        '</div>' .
                                    '</a>' .
                                    $specialtag .
                                '</div>' .
                                /*'<div class="pos-rel page-btn-share-tem">' .
                                    //$process_bar .
                                '</div>' .*/
                                '<p class="chessboard-title"><a href="page-inner.php?page_id=' . $datarow['page_id'] . '" title="' . $datarow['title'] . '">' . $title . '</a></p>' .
                            '</div>' .
                        '</div>';
                    
        }

        function create_json( $con ,  $fbuser , $datarow ) {
                    
                    global $user_image_path;
                    
                    /*if( $datarow['tag'] === "[]" )
                            $tag = array( '超人氣' , '超人氣' , '超人氣' );
                    else*/
                            $tag = json_decode($datarow['tag']);
                    
                    $author = get_sql( $con , "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" , "usericon" , "business" ) );

                    $special_icon_path = get_sql( $con , "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    $class = get_sql( $con , "category" , "id='" . $datarow['class'] . "'" , array( "name" ) );
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    //$process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';
                    $channel = get_sql( $con , "channel" , "channel_id=" . $datarow['channel_id'] , array( "ch_name" , "ch_icon" , "ch_type" ) );
                    
                    if( $fbuser === "" )
                    {
                            $subscribe = 0;
                    }
                    else
                    {

                            $user1 = get_sql( $con , "user" , "facebook_mail='" . $fbuser . "'" , array( "user_id" ) );
                            $subscribe = get_sql_array( $con , " subscribe" , "user_id=" . $user1[0]["user_id"] , array( "channel_id" ) );

                            if( in_array( $datarow['channel_id'] , $subscribe ) )
                                $subscribe = 1;
                            else 
                                $subscribe = 2;

                    }

                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    
                    $callback = array( 'tag' => $tag ,
                                       'author_name' => $author[0]['user_name'] ,
                                       'author_icon' => $author[0]['usericon'] ,
                                       'author_business' => $author[0]['business'] ,
                                       'page_id' => $datarow['page_id'] ,
                                       'user_id' => $datarow['user_id'] ,
                                       'subscribe' => $subscribe ,
                                       'date' => $date ,
                                       'article_icon' => $user_image_path . $datarow['page_id'] . "/ThumbnailM/" . $datarow['article_icon'] ,
                                       'special_icon_path' => $special_icon_path[0]['img_path'] ,
                                       'process_per' => $process_per ,
                                       'title' => $datarow['title'] ,
                                       'num_click' => $datarow["c_num_click"] ,
                                       'share_num' => $datarow['share_num'] ,
                                       'class_name' => $class[0]['name'] ,
                                       'class_id' => $datarow['class'] ,
                                       'channel_id' => $datarow['channel_id'] ,
                                       'channel_name' => $channel[0]["ch_name"] ,
                                       'channel_icon' => $channel[0]["ch_icon"] ,
                                       'channel_type' => $channel[0]["ch_type"] ,
                                       'display' => $datarow["display"] );
                    
                    return $callback;
                    
        }

        function create_json2( $con ,  $user , $datarow ) {
                    
                    global $user_image_path;
                    
                    /*if( $datarow['tag'] === "[]" )
                            $tag = array( '超人氣' , '超人氣' , '超人氣' );
                    else*/
                            $tag = json_decode($datarow['tag']);
                    
                    $author = get_sql( $con , "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" , "usericon" , "business" ) );

                    $special_icon_path = get_sql( $con , "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    $class = get_sql( $con , "category" , "id='" . $datarow['class'] . "'" , array( "name" ) );
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    //$process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';
                    $channel = get_sql( $con , "channel" , "channel_id=" . $datarow['channel_id'] , array( "ch_name" , "ch_icon" , "ch_type" ) );
                    
                    if( $fbuser === "" )
                    {
                            $subscribe = 0;
                    }
                    else
                    {

                            $user1 = get_sql( $con , "user" , "email='" . $user . "'" , array( "user_id" ) );
                            $subscribe = get_sql_array( $con , " subscribe" , "user_id=" . $user1[0]["user_id"] , array( "channel_id" ) );

                            if( in_array( $datarow['channel_id'] , $subscribe ) )
                                $subscribe = 1;
                            else 
                                $subscribe = 2;

                    }

                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    
                    $callback = array( 'tag' => $tag ,
                                       'author_name' => $author[0]['user_name'] ,
                                       'author_icon' => $author[0]['usericon'] ,
                                       'author_business' => $author[0]['business'] ,
                                       'page_id' => $datarow['page_id'] ,
                                       'user_id' => $datarow['user_id'] ,
                                       'subscribe' => $subscribe ,
                                       'date' => $date ,
                                       'article_icon' => $user_image_path . $datarow['page_id'] . "/ThumbnailM/" . $datarow['article_icon'] ,
                                       'special_icon_path' => $special_icon_path[0]['img_path'] ,
                                       'process_per' => $process_per ,
                                       'title' => $datarow['title'] ,
                                       'num_click' => $datarow["c_num_click"] ,
                                       'share_num' => $datarow['share_num'] ,
                                       'class_name' => $class[0]['name'] ,
                                       'class_id' => $datarow['class'] ,
                                       'channel_id' => $datarow['channel_id'] ,
                                       'channel_name' => $channel[0]["ch_name"] ,
                                       'channel_icon' => $channel[0]["ch_icon"] ,
                                       'channel_type' => $channel[0]["ch_type"] ,
                                       'display' => $datarow["display"] );
                    
                    return $callback;
                    
        }

        function create_chessboard_home( $datarow , $bootstrap_class , $css ) {
                    
                    global $user_image_path;
                    $tag_html = "";
                    
                    
                    //$author = get_sql( $con , "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" ) );

                    /*$special_icon_path = get_sql( $con , "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    if( $special_icon_path[0]['img_path'] === "" )
                        $specialtag = '';
                    else
                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]["img_path"] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' . $datarow['special_tag_id'] . '\'">';*/
                    if( (int)$datarow['share_num'] > 100000 )
                        $specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                    else if( (int)$datarow['share_num'] > 50000 )
                        $specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                    else if( (int)$datarow['share_num'] > 20000 )
                        $specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                    else if( (int)$datarow['share_num'] > 10000 )
                        $specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                    else
                        $specialtag = '';
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';


                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    $title = mb_strwidth($datarow['title'], "utf-8") <= 65 ? $datarow['title'] : mb_strimwidth( $datarow['title'] , 0 , 62, "", "utf-8") . "...";
                    
                    return '<div style="float: left;' . $css . '">' .
                                    '<a href="page-inner.php?page_id=' . $datarow['page_id'] . '">' .
                                        '<div id="icon" class="chessboard-bgcenter" style="height: auto; padding-top: 50%; background-image: url('. $user_image_path . $datarow['page_id'] . "/ThumbnailM/" . $datarow['article_icon'] .');">'.
                                            //'<div class="cover-black-small_"></div>' .
                                            /*'<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                '<i class="ace-icon fa fa-eye panel-icon"></i>' . $datarow["c_num_click"] .
                                                '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $datarow['share_num'] .
                                            '</div>' .*/
                                        '</div>'.
                                    '</a>' .
                                    $specialtag .
                                /*'<div class="pos-rel page-btn-share-tem">' .
                                    //$process_bar .
                                '</div>' .*/
                                '<p class="chessboard-title"><a href="page-inner.php?page_id=' . $datarow['page_id'] . '" title="' . $datarow['title'] . '">' . $title . '</a></p>' .
                          '</div>';
                    
        }
        
        function create_chessboard_home2( $datarow , $bootstrap_class , $css ) {
                    
                    global $user_image_path;
                    $tag_html = "";
                    
                    
                    //$author = get_sql( $con , "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" ) );

                    /*$special_icon_path = get_sql( $con , "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    if( $special_icon_path[0]['img_path'] === "" )
                        $specialtag = '';
                    else
                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]["img_path"] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' . $datarow['special_tag_id'] . '\'">';*/
                    if( (int)$datarow['share_num'] > 100000 )
                        $specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                    else if( (int)$datarow['share_num'] > 50000 )
                        $specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                    else if( (int)$datarow['share_num'] > 20000 )
                        $specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                    else if( (int)$datarow['share_num'] > 10000 )
                        $specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                    else
                        $specialtag = '';
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';


                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    $title = mb_strwidth($datarow['title'], "utf-8") <= 65 ? $datarow['title'] : mb_strimwidth( $datarow['title'] , 0 , 62, "", "utf-8") . "...";
                    
                    return '<div style="position: absolute; width: 33.33%;' . $css . '">' .
                                    '<a href="page-inner.php?page_id=' . $datarow['page_id'] . '">' .
                                        '<div id="icon" class="chessboard-bgcenter" style="height: auto; padding-top: 60%; background-image: url('. $user_image_path . $datarow['page_id'] . "/ThumbnailM/" . $datarow['article_icon'] .');">'.
                                            //'<div class="cover-black-small_"></div>' .
                                            /*'<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                '<i class="ace-icon fa fa-eye panel-icon"></i>' . $datarow["c_num_click"] .
                                                '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $datarow['share_num'] .
                                            '</div>' .*/
                                        '</div>'.
                                    '</a>' .
                                    $specialtag .
                                /*'<div class="pos-rel page-btn-share-tem">' .
                                    //$process_bar .
                                '</div>' .*/
                                '<p class="homepage_text"><a href="page-inner.php?page_id=' . $datarow['page_id'] . '" title="' . $datarow['title'] . '">' . $title . '</a></p>' .
                          '</div>';
                    
        }
?>
