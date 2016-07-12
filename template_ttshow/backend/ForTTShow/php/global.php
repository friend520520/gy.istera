<?php 
        /* php version 4.0 */
        $server_website_path 	= "C:\AppServ\www\TTShow\account\\";
        $server_examine_path    = "C:\AppServ\www\TTShow\examine\\";
        $server_page_path       = "C:\AppServ\www\TTShow\web\data\\";
        $server_channel_path    = "C:\AppServ\Www\Ttshow\Channel\\";
        
        $server_specialIcon_path = "C:\AppServ\www\TTShow\Include_file\Img\Special_icon\\";
        
        $server_page_img_path    = "C:\AppServ\www\img\\";
        
        $server_data_path 	= "D://...";
        $server_contribute_path    = "C:\AppServ\www\TTShow\contribute\\";
        
        $website_img_url        = "http://ttshow.tw/TTShow/account";
        $user_image_path        = "http://www.ooxxoox.com/ttshow/web/data/";
        
        
        $upload_transient_file = "C:\AppServ\Www\Ttshow\Transient_file\\";
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
                mkdir($to_dir); // @mkdir($to_dir) << 跟這樣差異在哪!?     
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
         
        function get_sql( $table , $Condition , $Get )
        {
                global $con;
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

        function get_sql_array( $table , $Condition , $Get )
        {
                global $con;
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

        function create_upright( $fbuser , $datarow , $bootstrap_class ) {

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
                                    $tag_html .= '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;" onclick="location.href=\'generaltag.php?tag=' . $value . '\'">' . $value . '</span>';
                    }
                    
                    $channel = get_sql( "channel" , "channel_id=" . $datarow['channel_id'] , array( "ch_name" , "ch_icon" , "ch_type" ) );
                    
                    $author = get_sql( "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" , "usericon" , "business" ) );

                    $special_icon_path = get_sql( "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    if( $special_icon_path[0]['img_path'] === "" )
                        $specialtag = '';
                    else
                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]['img_path'] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'specialtag.php?specialtag=' . $datarow['special_tag_id'] . '\'">';
                    $class = get_sql( "category" , "id='" . $datarow['class'] . "'" , array( "name" ) );
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';

                    if( $fbuser === "" )
                    {
                            $subscribe = '<button class="btn btn-sm btn-primary panel-float-right trigger_fb_login" style="padding: 0px 13px; border-radius: 3px; margin-top:12px;">訂閱</button>';
                    }
                    else
                    {

                            $user1 = get_sql( "user" , "facebook_mail='" . $fbuser . "'" , array( "user_id" ) );
                            $subscribe = get_sql_array( "subscribe" , "user_id=" . $user1[0]["user_id"] , array( "channel_id" ) );
                            
                            if( in_array( $datarow['user_id'] , $subscribe ) )
                                $subscribe = '<button class="btn btn-sm btn-primary panel-float-right subscribe already" style="padding: 0px 13px; border-radius: 3px; margin-top:12px;" author="' . $datarow['user_id'] . '">已訂閱</button>';
                            else
                                $subscribe = '<button class="btn btn-sm btn-primary panel-float-right subscribe" style="padding: 0px 13px; border-radius: 3px; margin-top:12px;" author="' . $datarow['user_id'] . '">訂閱</button>';
                            
                    }
                    
                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    return '<div style="padding: 0 15px 15px 0;" class="' . $bootstrap_class . '" article="' . $datarow['page_id'] . '" user="' . $datarow['user_id'] . '">
                            <div index="1" class="panel panel-default chessboard-box">
                              <div class="panel-body chessboard-body"> '.
                                '<div style="background-image: url(' . $channel[0]["ch_icon"] . '); " class="chessboard-icon bg_center"></div>
                                <div>
                                  <d class="chessboard-id" index="1" onclick="location.href=\'cooperate.php?ch=' . $datarow['channel_id'] . '\'">
                                    ' . $channel[0]["ch_name"] . '
                                  </d>
                                </div>
                                <div class="chessboard-type">' . $channel[0]["ch_type"] . '</div>
                                <div>
                                  ' . $subscribe . '
                                </div>
                                <span class="panel1-identity">
                                  ' . $author[0]['business'] . '
                                </span>
                                <div class="chessboard-time">
                                  <i class="ace-icon glyphicon glyphicon-time chessboard-time-icon">
                                  </i>
                                  <span>
                                    '. $date .'
                                  </span>
                                </div>
                                <div class="clearfix">
                                </div>' .
                                '<div name="responsive_div_level1" style="margin-top: 15px;">' .
                                    '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                        '<div style="background-image: url(' . $user_image_path . $datarow['page_id'] . "/thumbnailM/" . $datarow['article_icon'] . '); " class="chessboard-bgcenter pagebg" page="' . $datarow['page_id'] . '">
                                            <div onclick=\'$( "#tabs" ).children( "ul" ).children( "li[pagetype=' . $datarow['class'] . ']" ).trigger("click");\' tab="' . $datarow['class'] . '" class="chessboard-transparent" href="#">
                                                <i class="ace-icon glyphicon glyphicon-film"></i>
                                                <span>' . $class[0]['name'] . '</span>
                                            </div>' .
                                            $specialtag .
                                        '</div>' .
                                    '</div>' .
                                '</div>' .
                                /*'<div class="pos-rel page-btn-share-tem">' .
                                    $process_bar .
                                '</div>*/
                                '<h4 class="upright-title">
                                    <b class="pagebg" page="' . $datarow['page_id'] . '">
                                         ' . $datarow['title'] . '
                                    </b>
                                </h4>'.
                                '<div class="col-xs-12" style="margin-bottom: 3px; padding: 0px;">'.
                                  '<span class="chessboard-view" style="width: 25%;">
                                    <i class="ace-icon fa fa-eye chessboard-icontext">
                                    </i>' .
                                    $datarow["c_num_click"] .
                                  '</span>
                                  <span class="chessboard-replay" style="width: 25%;">' .
                                    '<i class="ace-icon fa fa-share chessboard-icontext">
                                    </i>' .
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

        function create_list( $datarow , $bootstrap_class ) {

                    global $user_image_path;
                    $tag_html = "";
                    
                    
                    $author = get_sql( "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" ) );

                    //$special_icon_path = get_sql( "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );

                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';
                    

                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    return '<div style="cursor: pointer; padding-left: 0px; margin-top: 22px;" class="' . $bootstrap_class . ' cover-text1">
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="padding: 0px;margin: 0">
                                <div style="width: 100%; cursor: pointer; background-image: url(' . $user_image_path . $datarow['page_id'] . "/thumbnailM/" . $datarow['article_icon'] . '); height: 205px;" class="bg_center pagebg" page="' . $datarow['page_id'] . ' id="List_article_icon">
                                      <div class="cover-black"></div>
                                      <div style="position: absolute; color: white; left: 5%; bottom: 4%; text-shadow: 1px 2px 1px black;">
                                        <i class="ace-icon fa fa-eye panel-icon"></i>' . $datarow["c_num_click"] . '
                                        <i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $datarow['share_num'] . '
                                      </div>
                                </div>' .
                                /*<div class="pos-rel page-btn-share-tem" style="margin-top: 205px;">'
                                     . $process_bar .
                                '</div>*/
                            '</div>
                            <div style="padding: 0px;margin: 0" class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                <p page="' . $datarow['page_id'] . '" class="pagebg" style="color: gray; font-size: 25px; line-height: 35px; margin: 1px 20px;">' . $datarow['title'] . '</p>
                                <br><br><br><br>
                                <h6 style="display: inline; color: gray; font-size: 15px; margin-left: 18px;">
                                    <i class="ace-icon glyphicon glyphicon-user" style="margin-right: 10px"></i>
                                    <span id="List_user_name">' . $author[0]['user_name'] . '</span>
                                </h6>
                                <br><br>
                                <h6 style="display: inline; color: gray; font-size: 15px; margin-left: 18px;">
                                    <i class="ace-icon glyphicon glyphicon-time" style="margin-right: 10px"></i>
                                    <span id="List_date">' . $date . '</span>
                                </h6>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                        </div>';
        }

        function create_chessboard( $datarow , $bootstrap_class , $css ) {
                    
                    global $user_image_path;
                    $tag_html = "";
                    
                    
                    //$author = get_sql( "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" ) );

                    $special_icon_path = get_sql( "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    if( $special_icon_path[0]['img_path'] === "" )
                        $specialtag = '';
                    else
                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]["img_path"] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'specialtag.php?specialtag=' . $datarow['special_tag_id'] . '\'">';
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';


                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    return '<div class="' . $bootstrap_class . ' cover-text1" style="margin: 0px; ' . $css . '">' .
                            '<div style="padding: 0px;margin: 0" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' .
                                '<div name="responsive_div_level1">' .
                                    '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                        '<div style="background-image: url(' . $user_image_path . $datarow['page_id'] . "/thumbnailM/" . $datarow['article_icon'] . '); " class="chessboard-bgcenter pagebg" page="' . $datarow['page_id'] . '">' .
                                            '<div class="cover-black-small_"></div>' .
                                            $specialtag .
                                            '<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                '<i class="ace-icon fa fa-eye panel-icon"></i>' . $datarow["c_num_click"] .
                                                '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $datarow['share_num'] .
                                            '</div>' .
                                        '</div>' .
                                    '</div>' .
                                '</div>' .
                                /*'<div class="pos-rel page-btn-share-tem">' .
                                    //$process_bar .
                                '</div>' .*/
                                '<p class="chessboard-title"><b class="pagebg" page="' . $datarow['page_id'] . '">' . $datarow['title'] . '</b></p>' .
                            '</div>' .
                        '</div>';
                    
        }

        function create_json( $fbuser , $datarow ) {

                    global $user_image_path;
                    
                    if( $datarow['tag'] === "[]" )
                            $tag = array( '超人氣' , '超人氣' , '超人氣' );
                    else
                            $tag = json_decode($datarow['tag']);
                    
                    $author = get_sql( "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" , "usericon" , "business" ) );

                    $special_icon_path = get_sql( "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    $class = get_sql( "category" , "id='" . $datarow['class'] . "'" , array( "name" ) );
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    //$process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';
                    $channel = get_sql( "channel" , "channel_id=" . $datarow['channel_id'] , array( "ch_name" , "ch_icon" , "ch_type" ) );
                    
                    if( $fbuser === "" )
                    {
                            $subscribe = 0;
                    }
                    else
                    {

                            $user1 = get_sql( "user" , "facebook_mail='" . $fbuser . "'" , array( "user_id" ) );
                            $subscribe = get_sql_array( "subscribe" , "user_id=" . $user1[0]["user_id"] , array( "channel_id" ) );

                            if( in_array( $datarow['user_id'] , $subscribe ) )
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
                                       'article_icon' => $user_image_path . $datarow['page_id'] . "/thumbnailM/" . $datarow['article_icon'] ,
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
                                       'channel_type' => $channel[0]["ch_type"] );
                    
                    return $callback;
                    
        }

        function create_chessboard_home( $datarow , $bootstrap_class , $css ) {
                    
                    global $user_image_path;
                    $tag_html = "";
                    
                    
                    //$author = get_sql( "user" , "user_id='" . $datarow['user_id'] . "'" , array( "user_name" ) );

                    $special_icon_path = get_sql( "specialtag" , "id='" . $datarow['special_tag_id'] . "'" , array( "img_path" ) );
                    if( $special_icon_path[0]['img_path'] === "" )
                        $specialtag = '';
                    else
                        $specialtag = '<img width="42px" height="42px" src="' . $special_icon_path[0]["img_path"] . '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'specialtag.php?specialtag=' . $datarow['special_tag_id'] . '\'">';
                    
                    $process_per = ( (int)$datarow['share_num'] / 50 > 100 ) ? 100 : (int)$datarow['share_num'] / 50;
                    $process_bar = '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' . $process_per . '%"></div>';


                    $date = $datarow['date'];
                    $date = explode(":",$date);
                    unset($date[ count($date)-1 ]); // remove item at index 0
                    $date = array_values($date); // 'reindex' array
                    $date = implode(":", $date);
                    
                    /*return '<div style="margin: 0px; padding-left: 0px;" class="' . $bootstrap_class . '">
                            <div id="List_article_icon" page="' . $datarow['page_id'] . '" class="bg_center pagebg" style="width: 100%; cursor: pointer; background-image: url(' . $user_image_path . $datarow['page_id'] . "/thumbnailM/" . $datarow['article_icon'] . '); height: 205px;">
                                <div class="cover-black"></div>
                                <div style="position: absolute; color: white; left: 5%; bottom: 4%; text-shadow: 1px 2px 1px black;">
                                      <i class="ace-icon fa fa-eye panel-icon"></i>' . $datarow["c_num_click"] . '
                                      <i style="margin-left: 5px" class="ace-icon fa fa-share panel-icon"></i>' . $datarow['share_num'] . '
                                </div>
                            </div>
                            <div style="margin-top: 205px;" class="pos-rel page-btn-share-tem">
                                ' . $process_bar . '
                            </div>
                            <p page="' . $datarow['page_id'] . '" style="cursor:pointer; color: gray; font-size: 20px; line-height: 26px; height: 50px; overflow: hidden; margin: 5px 0px;" class="pagebg">
                                ' . $datarow['title'] . '
                            </p>
                        </div>';*/
                    
                    return '<div class="' . $bootstrap_class . ' cover-text1" style="margin: 0px; ' . $css . '">' .
                            '<div style="padding: 0px;margin: 0" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' .
                                '<div name="responsive_div_level1">' .
                                    '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' .
                                        '<div style="background-image: url(' . $user_image_path . $datarow['page_id'] . "/thumbnailM/" . $datarow['article_icon'] . '); " class="chessboard-bgcenter pagebg" page="' . $datarow['page_id'] . '">' .
                                            '<div class="cover-black-small_"></div>' .
                                            $specialtag .
                                            '<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' .
                                                '<i class="ace-icon fa fa-eye panel-icon"></i>' . $datarow["c_num_click"] .
                                                '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' . $datarow['share_num'] .
                                            '</div>' .
                                        '</div>' .
                                    '</div>' .
                                '</div>' .
                                /*'<div class="pos-rel page-btn-share-tem">' .
                                    //$process_bar .
                                '</div>' .*/
                                '<p class="chessboard-title"><b class="pagebg" page="' . $datarow['page_id'] . '">' . $datarow['title'] . '</b></p>' .
                            '</div>' .
                        '</div>';
                    
        }
        
?>
