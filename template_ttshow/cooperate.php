<!DOCTYPE html>
<html lang="en">
    <head>
                
                <script src="js/google_analytics.js"></script>
                
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>TTshow-合作頻道頁</title>
        <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">

        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->
        <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
https://apis.google.com/js/platform.js
        <script src="template/assets/js/jquery.js"></script>
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        <script src="template/assets/js/ace-extra.js"></script>

        <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
        
        <?php
                
                include 'php/config.php';
                include 'php/global.php';

                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );

                if (mysqli_connect_errno()) {

                }
                else {
                        
                        $channel = get_sql_noGet( $con , "channel" , "WHERE channel_id=" . $_REQUEST['ch'] );
                        
                        if( $channel ) {
                                $callback = array( "channel_community" => array( "facebook" => json_decode( $channel[0]['facebook_url'] , true ) ,
                                                                                "youtube" => json_decode( $channel[0]['youtube_url'] , true ) ,
                                                                                "instagram" => json_decode( $channel[0]['instagram_url'] , true ) ,
                                                                                "line" => json_decode( $channel[0]['line_url'] , true ) ,
                                                                                "pixnet" => json_decode( $channel[0]['pixnet_url'] , true ) ,
                                                                                "other" => json_decode( $channel[0]['other_url'] , true ) ) );
                        }

                        mysqli_close($con);

                }

        ?>
        
    </head>

    <body class="no-skin">
        
        <div id="loadingpage" class="widget-box-overlay">
                <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
        </div>
        
        <?php include( "header_1.php"); ?>
        
        
        <div class="main-container" id="main-container" style="background-color: white;">
                <div id="title_toolbar" style="display: none;">
                        <?php include( "cooperate_tab.php"); ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0">
                            <div id="cover_photo" style="background-size: cover; border: 1px solid rgb(221, 221, 221); padding: 0px; cursor: pointer; position: relative; width: 100%; height: 300px;">
                            </div>
                                <!--div id="myCarousel" data-ride="carousel" class="carousel slide" >
                                        <div role="listbox" class="carousel-inner">
                                                <div class="item active">
                                                        <div style="/* background-image: url(&quot;&quot;);*/
                                                             background-size: cover; border: 1px solid rgb(221, 221, 221); padding: 0px; margin-right: 1%; cursor: pointer; position: relative; width: 100%; height: 300px;" id="cover_photo"></div>
                                                </div>
                                                <div class="item">
                                                        <div style="/*background-image: url('http://pic.pimg.tw/smilerein12/e3d2ed4a21d26590f011e3d5405a2159.gif');*/
                                                         background-size: cover; border: 1px solid rgb(221, 221, 221); padding: 0px; margin-right: 1%; cursor: pointer; position: relative; width: 100%; height: 300px;" id="cover_photo"></div>
                                                </div>
                                                <div class="item">
                                                        <div style=" /*background-image: url('http://2.blog.xuite.net/2/e/1/d/13209554/blog_66802/txt/36198970/0.jpg');*/
                                                         background-size: cover; border: 1px solid rgb(221, 221, 221); padding: 0px; margin-right: 1%; cursor: pointer; position: relative; width: 100%; height: 300px;" id="cover_photo"></div>
                                                </div>
                                        </div>
                                        <div style="position: absolute; right: 20px; bottom: 30px;">
                                                <button class="btn btn-primary" style="width: 130px; border-radius: 4px; padding: 0px 16px; background-color: rgb(19, 74, 121) ! important; border-color: rgb(19, 74, 121) ! important;">
                                                    編輯頻道
                                                </button>
                                                <button class="btn btn-primary" style="width: 130px; border-radius: 4px; margin-left: 5px; padding: 0px 17px; border-color: rgb(255, 51, 51) ! important; background-color: rgb(255, 51, 51) ! important; color: white ! important;">
                                                    傳送訊息
                                                </button>
                                        </div>
                                </div-->
                                <div id="myContent" class="col-xs-9 col-sm-9 col-md-6 col-lg-6" style="font-size: 14px; margin-left: 164px; color: gray;">
                                        <p></p>
                                </div>
                                <div style="float: right; padding: 0px; margin: 10px 0px 0px;" class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 0px; width: 33.3%; border-right: 1px solid darkgray; height: 43px;">
                                                <div style="text-align: center; font-size: 15px;">頻道排名</div>
                                                <div style="text-align: center; font-size: 27px; font-weight: bold; color: blue; margin-top: 5px;">-</div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 0px; border-right: 1px solid darkgray; width: 33.3%; height: 43px;">
                                                <div style="text-align: center; font-size: 15px;">訂閱數</div>
                                                <div style="text-align: center; font-size: 27px; font-weight: bold; color: blue; margin-top: 5px;" id="all_follow">5</div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 0px; width: 33.3%; height: 43px;">
                                                <div style="text-align: center; font-size: 15px;">總瀏覽數</div>
                                                <div style="text-align: center; font-size: 27px; font-weight: bold; color: blue; margin-top: 5px;" id="all_click" >851</div>
                                        </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="border-radius: 0px; z-index: 100; position: absolute; top: 223px; height: 120px;">
                                        <!--img id="usericon" class="profile-pic" src="" alt="" style="background: none repeat scroll 0% 0% white; max-width: 110px; max-height: 100%; z-index: 10; border-radius: 0px; left: 9px; border: 5px solid white; float: left;"-->
                                        <div style="float: left; background: white none repeat scroll 0% 0%; height: 140px; width: 140px;">
                                                <div class="chessboard-bgcenter pagebg" style="position: absolute; background-size: cover; border: 3px solid white; height: 140px; width: 140px;" id="usericon"></div>
                                        </div>
                                        <!--div class="btn-xs profile-btn" style="position: relative; margin-top: 14px; margin-left: 12px;">

                                                <button author="92" id="subscribe_button" style="display: block; padding: 0px 13px; border-radius: 3px;" class="btn btn-sm btn-primary subscribe already">已訂閱</button>

                                        </div-->
                                        <div style="float: left; margin-left: 15px; margin-top: 10px;">
                                                <div>
                                                        <span style="font-weight: bold; color: white; font-size: 17px; text-shadow: 0px 3px 2px black;" id="channel_name"></span>

                                                        <p style="margin: 4px"></p>
                                                        <span style="color: rgb(255, 255, 255); text-shadow: 0px 3px 2px black; letter-spacing: 1px; font-size: 30px;">
                                                                <span id="ch_name"></span>
                                                        </span>
                                                        <span>
                                                                <img style="width: 25px; margin-top: -5px;" src="template/assets/img/like.png">
                                                        </span>
                                                </div>

                                                <div id="ch_type" style="font-size: 12pt; color: white; margin-top: 7px;">網站</div>
                                        </div>
                                </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr style="margin: 10px 0px 0px;">
                        <div style="margin-top: 3px; padding: 0px;" class="col-xs-12 col-sm-12">
                                <div style="padding: 0" class="col-xs-12" id="tab">
                                        <div id="tab_1" class="tab">
                                                <!--hr style="margin: 0px 0px 8px; border: 0.5px solid #e7e6e7;">
                                                <button tab="1" class="btn btn-sm col-xs-3 btn-primary" type="button" style="border: 1px solid white; background-color: white ! important; color: blue ! important; padding: 0px; font-size: 16px; width: 5%;">
                                                        全部
                                                </button>
                                                <button tab="2" class="btn btn-sm col-xs-3 btn-primary" type="button" style="font-size: 15px; border: 1px solid white; width: 5%; background-color: white ! important; color: gray ! important; padding: 0px;">
                                                        新聞
                                                </button>
                                                <button tab="3" class="btn btn-sm col-xs-3 btn-primary" type="button" style="font-size: 15px; border: 1px solid white; background-color: white ! important; color: gray ! important; width: 5%; padding: 0px;">
                                                        寵物
                                                </button>
                                                <button tab="4" class="btn btn-sm col-xs-3 btn-primary" type="button" style="font-size: 15px; border: 1px solid white; background-color: white ! important; color: gray ! important; width: 5%; padding: 0px;">
                                                        插畫
                                                </button>
                                                <button style="display: block; border: 1px solid white; background-color: white ! important; padding: 0px; font-size: 16px; width: 5%; color: gray ! important; float: right;" class="btn btn-sm  col-xs-3" type="button" tab="5">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                </button>
                                                <div class="clearfix"></div>
                                                <hr style="margin: 6px 0px 0px; border: 0.5px solid #e7e6e7;"-->
                                        </div>
                                        <div class="col-xs-12 col-sm-12" style="padding: 0px; margin: 20px 0px;">
                                                <button page_type="new" class="btn btn-sm col-xs-3 btn-primary" style="font-size: 15px; border: 1px solid white; background-color: rgb(19, 74, 121) ! important; padding: 4px 0px; width: 6%;" type="button">
                                                    最新
                                                </button>
                                                <button page_type="hot" class="btn btn-sm col-xs-3 btn-primary" type="button" style="font-size: 15px; border: 1px solid white; padding: 4px 0px; width: 6%; background-color: rgb(112, 112, 112) ! important;">
                                                    熱門
                                                </button>
                                                <img src="template/assets/img/right.png" style="height: 100%; float: right; margin-top: 3px; margin-left: 10px;">
                                                
                                                <div style="width: 124px; margin-left: 10px; float: right;">
                                                    <?php if( !empty( $callback['channel_community']['youtube'][0] ) ) echo '<div class="g-ytsubscribe" data-channelid="' . $callback['channel_community']['youtube'][0]["url"] . '" data-layout="default" data-count="default"></div>';?>
                                                </div>
                                                <div style="float: right;">
                                                    <?php if( !empty( $callback['channel_community']['facebook'][0] ) ) echo '<div style="padding: 0px; margin-top: 2px;" class="fb-like" data-href="' . $callback['channel_community']['facebook'][0]["url"] . '" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>';?>
                                                </div>
                                                
                                                <p style="float: right; margin: 0px; padding-right: 10px;">
                                                    訂閱作者相關社群，最新創作不漏接
                                                </p>
                                        </div>
                                        <div id="tab_1_content" class="col-xs-12 col-sm-12 tab_content" style="padding: 0">
                                                
                                        </div>
                                        
                                        <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                                <img src="template/assets/images/loading.gif" name="load_img">
                                        </div>
                                </div>
                        </div>
                          
                </div>

                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                </a>
        </div>
        
        <div class="remodal-overlay modal fade in" id="myModalAuthorCommunity" style="" aria-hidden="false">
                <div class="remodal modal-dialog modal-lg">
                        <div class="modal-content">
                                <div class="modal-body" style="padding: 25px; width: 100%; height: 100%;">
                                        
                                        <img class="close" src="images/x-black.png" style="position: absolute; opacity: 1; right: 5px; top: 5px; margin: 0px; height: 20px;" data-dismiss="modal">
                                        <h4 class="modal-title" style="font-weight: bold; font-size: 18px; margin-top: 10px;"><c name='channel_name'></c> 相關社群</h4>
                                        
                                        <div class="col-xs-12 content" style="margin-top: 5px;">
                                            
                                        </div>
                                        
                                        
                                        <div data-dismiss="modal" style="cursor: pointer; border: 2px solid white; text-align: center; left: 0px; right: 0px; position: relative; height: 45px; border-radius: 6px; background: gray none repeat scroll 0px 0px; margin-top: 70px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h3 style="color: white; text-align: center; font-size: 17px; margin: 0px;margin-right: 3px; font-size: 22px; margin-top: 10px;">取消</h3>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                </div>
                        </div>
                </div>
        </div>


        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="template/assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		<script src="template/assets/js/jquery-ui.js"></script>
		<script src="template/assets/js/jquery.ui.touch-punch.js"></script>

		<!-- ace scripts -->
		<script src="template/assets/js/ace/elements.scroller.js"></script>
		<script src="template/assets/js/ace/elements.colorpicker.js"></script>
		<script src="template/assets/js/ace/elements.fileinput.js"></script>
		<script src="template/assets/js/ace/elements.typeahead.js"></script>
		<script src="template/assets/js/ace/elements.wysiwyg.js"></script>
		<script src="template/assets/js/ace/elements.spinner.js"></script>
		<script src="template/assets/js/ace/elements.treeview.js"></script>
		<script src="template/assets/js/ace/elements.wizard.js"></script>
		<script src="template/assets/js/ace/elements.aside.js"></script>
		<script src="template/assets/js/ace/ace.js"></script>
		<script src="template/assets/js/ace/ace.ajax-content.js"></script>
		<script src="template/assets/js/ace/ace.touch-drag.js"></script>
		<script src="template/assets/js/ace/ace.sidebar.js"></script>
		<script src="template/assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="template/assets/js/ace/ace.submenu-hover.js"></script>


        <!-- the following scripts are used in demo only for onpage help and you don't need them -->
        <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
        <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

        <script type="text/javascript">
                ace.vars['base'] = '..';
        </script>
        <!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
                            
				//jquery tabs
                                if( $( "#tabs" ).length )
				$( "#tabs" ).tabs().show();
			});
		</script>

        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>

        <script src="js/create.js"></script>
        <script src="js/fb-login.js"></script>


        
        <script type="text/javascript">
                function FB_connected_callback_init( response )
                {
                            
                            $.member = response;
                            
                            $( "#fb-login-button" ).removeClass( "nav-search" );
                            
                            $("#pagecontent").css("display","block");
                            
                            $( "#main-container" ).show();
                            
                            init_page();
                };

                function FB_unconnected_callback_init()
                {
                            $.member = "";
                            
                            $("#subscribe_button").css("display","none");
                            
                            
                            $( "#loadingpage" ).hide();
                            
                            $( "#main-container" ).show();
                            
                            init_page();
                };
                
                function FB_connected_callback_select_ttshow_db( data ) {
                }
       </script>
        
        <script type="text/javascript">

                $.init_channel = getParameterByName( "ch" );
                
                $.ajax({
                            type: "POST",
                            url: "php/channel.php?func=info_by_ch",
                            data: {
                                        ch        : getParameterByName("ch")
                            },
                            //dataType: "json",
                            success: function(data) {

                                        if( data !== "false" )
                                        {
                                                data = JSON.parse( data );
                                                
                                                $.each( data.channel_community , function( index , value ){
                                                        
                                                        console.log( "index = " + index );
                                                        var tmp_html = "";
                                                        var tmp_html1 = "";
                                                        var tmp_html2 = "";
                                                        switch( index )
                                                        {
                                                            case "facebook":
                                                                tmp_html1 = '<div class="fb-like" data-href="';
                                                                tmp_html2 = '" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>';
                                                                break;
                                                            case "youtube":
                                                                tmp_html1 = '<div class="g-ytsubscribe" data-channelid="';
                                                                tmp_html2 = '" data-layout="default" data-count="default"></div>';
                                                                break;
                                                            case "instagram":
                                                                tmp_html1 = '<span class="ig-follow" data-id="';
                                                                tmp_html2 = '" data-handle="igfbdotcom" data-count="false" data-size="small" data-username="false"></span>';
                                                                break;
                                                            case "line":
                                                                tmp_html1 = '<a class="_line" href="';
                                                                tmp_html2 = '">Line連結</a>'
                                                                break;
                                                            case "pixnet":
                                                                tmp_html1 = '<a class="_pixnet" href="';
                                                                tmp_html2 = '">痞客邦</a>'
                                                                break;
                                                            default:
                                                                tmp_html1 = '<a href="';
                                                                tmp_html2 = '">作品連結</a>'
                                                                break;
                                                        }
                                                        
                                                        $.each( value , function( index2 , value2 ){
                                                                
                                                                tmp_html += "<div class='col-xs-12' style='margin: 5px 0; padding: 0px 24px;'>" +
                                                                                "<div class='col-xs-5' style='padding:0;'>" + value2.name + "</div>" +
                                                                                "<div class='col-xs-7'>" +
                                                                                    tmp_html1 + value2.url + tmp_html2 +
                                                                                "</div>" +
                                                                            "</div>";
                                                                
                                                        });
                                                        
                                                        if( tmp_html !== "" )
                                                        {
                                                            tmp_html += '<hr class="col-xs-12" style="width: 90%;">';
                                                            console.log( tmp_html );
                                                            $( "#myModalAuthorCommunity .content" ).append( tmp_html );
                                                        }
                                                        
                                                });
                                                
                                                if( data.channel_community.facebook[0] )
                                                    $( "#AuthorCommunity [type=facebook]" ).append( '<div style="padding: 0px; margin-top: 2px;" class="fb-like" data-href="' + data.channel_community.facebook[0]["url"] + '" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>' );
                                                
                                                if( data.channel_community.youtube[0] )
                                                    $( "#AuthorCommunity [type=youtube]" ).append( '<div class="g-ytsubscribe" data-channelid="' + data.channel_community.youtube[0]["url"] + '" data-layout="default" data-count="default"></div>' );
                                                
                                        }
                            }
                });
                  
                function init_scroll() {

                            $.page_type = "new" ;
                            $.nuw_page_num = 1 ;
                            $.class = "";
                            
                            $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                    DisplayCurrentScroll(); 
                            });
                            $( "#loading_icon" ).show();
                            
                            getbody();
                            
                }
                        
                function DisplayCurrentScroll() {

                            if( $( "body" )[0].scrollTop >= $( "html" )[0].scrollTop )
                                var tmp_div = $( "body" )[0] ;
                            else
                                var tmp_div = $( "html" )[0] ;

                            var tmp_persent = tmp_div.scrollTop / (tmp_div.scrollHeight - tmp_div.clientHeight);

                            if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#tab_1_content").children(":eq(0)").height()*3 )
                            {
                                    if (!$.loading)
                                    {
                                        $.loading = 1;
                                        $.tpathqueue = setTimeout(function() {
                                            $.nuw_page_num++;
                                            getbody();
                                        }, 500);
                                    }
                            }

                }
                
                function getbody() {
                    
                    var data = {
                                page_num    : "40" ,
                                page        : $.nuw_page_num ,
                                class       : $.class ,
                                channel_id  : $.init_channel ,
                                page_type   : $.page_type ,
                                url         : $.getData.url ,
                    };
                    if( $.init_channel == "" ) {
                            data.channel_id = window.location.toString().split("?")[1]; 
                    }
                    
                    $( "#loading_icon" ).css( "visibility" , "visible" );
                    
                    $.ajax({
                                type: "POST",
                                url: "php/json_list_categorypage_channel.php",
                                data: data,
                                //dataType: "json",
                                success: function(data) {

                                            $( "#loading_icon" ).css( "visibility" , "hidden" );
                                            if( data !== "false" )
                                            {
                                                    data = JSON.parse( data );
                                                    console.log( data );
                                                    var tmp = "";

                                                    var func = function( a , b ){  return create_chessboard( a , "col-xs-3 col-sm-3 col-md-3 col-lg-3" ); } ;
                                                    //var func = function( a , b ){  return create_chessboard( a , "col-xs-12 col-sm-6 col-md-6 col-lg-6" ); } ;


                                                    $.each( data , function( index , value ){

                                                            //$.category_data[ $.category_data.length ] = value;
                                                            tmp += func( value );

                                                    });
                                                    $( "#tab_1_content" ).append( tmp );

                                            }
                                            else
                                            {
                                                    $( window ).unbind( "scroll" );
                                                    $( "#loading_icon" ).hide();
                                                    //$( "#loading_icon" ).css( "visibility" , "hidden" );
                                            }
                                            $.loading = 0;
                                }
                    });
                    
                }
                
                var init_page = function() {
                        var url = window.location.toString();
                        $.getData = {};
                        if( url.search("\\?") != -1 && url.search("=") != -1 ) {
                                var data = url.split("?")[1].split("&");
                                for(var i=0;i<data.length;i++) {
                                        $.getData[data[i].split("=")[0]] = data[i].split("=")[1];
                                }
                                $.getData.url = "false";
                        } else {
                                $.getData.ch  = url.split("?")[1];
                                $.getData.url = "true";
                        }
                        $("document").ready(function() {

                                    $.ajax({
                                                type    : "POST",
                                                url     : "php/html_list_channel.php",
                                                async   : true ,
                                                data : {
                                                            cmd     :   "select" ,
                                                            url     :  $.getData.url ,
                                                            data    :  {
                                                                        id : $.getData.ch ,
                                                            }
                                                },
                                                success: function( data )
                                                {
                                                        console.log( data );
                                                        var tmp_data = JSON.parse( data );
                                                        console.log( tmp_data );
                                                        
                                                        /*
                                                        $( "#myCarousel .carousel-inner" ).html(
                                                                    '<div class="item">' +
                                                                            '<div style="background-size: cover; border: 1px solid rgb(221, 221, 221); padding: 0px; margin-right: 1%; cursor: pointer; position: relative; width: 100%; height: 300px; background-image: url(\"' + tmp_data.ch_cover + '\");" id="cover_photo"></div>' +
                                                                    '</div>' 
                                                                    );*/
                                                        
                                                        $( "#ch_name" ).html( tmp_data.ch_name );
                                                        $( "#ch_type" ).html( tmp_data.ch_type );
                                                        $( "[id=cover_photo]" ).css( "background-image" , "url(\"" + tmp_data.ch_cover + "\")" );

                                                        $( "#myContent p" ).html( tmp_data.ch_introduce );
                                                        $( "#usericon" ).css( "background-image" , "url(\"" + tmp_data.ch_icon + "\")" );

                                                        $( "#loadingpage" ).hide();
                                                }
                                    });


                                    $.ajax({
                                                type: "POST",
                                                url: "php/json_list_channel_sub_click.php",
                                                data: {
                                                            channel_id    : $.getData.ch ,
                                                            url     :  $.getData.url ,
                                                },
                                                //dataType: "json",
                                                success: function( data )
                                                {
                                                            if( data !== "false" )
                                                            {
                                                                        data = JSON.parse( data );
                                                                        $( "#day_click" ).html( data.num_click );
                                                                        $( "#all_click" ).html( data.num_click );
                                                                        $( "#all_follow" ).html( data.subscribe_num );
                                                                        $( "#pagecontent" ).show();
                                                            }
                                                }
                                    });
                                    /*
                                    $.ajax({
                                                type: "POST",
                                                url: "php/json_list_author_sub_click.php",
                                                data: {
                                                            user    : "blithe0407@yahoo.com.tw"
                                                },
                                                //dataType: "json",
                                                success: function( data )
                                                {
                                                        if( data !== "false" )
                                                        {
                                                                data = JSON.parse( data );
                                                                $( "#day_click" ).html( data.num_click );
                                                                $( "#all_click" ).html( data.num_click );
                                                                $( "#all_follow" ).html( data.subscribe_num );
                                                                $( "#pagecontent" ).show();
                                                        }
                                                }
                                    });*/

                                    $.ajax({
                                                type: "POST",
                                                url: "php/category.php?func=list",
                                                data: {
                                                },
                                                //dataType: "json",
                                                success: function( data ) {

                                                            console.log( data );

                                                            var tmp_html = '' ;
                                                            tmp_html += '<hr style="margin: 0px 0px 8px; border: 0.5px solid #e7e6e7;">' ;
                                                            tmp_html += '<button tab_index="" style="border: 1px solid white; background-color: white ! important; color: blue; padding: 0px; font-size: 16px; width: 5%;" type="button" class="btn btn-sm col-xs-3 btn-primary">全部</button>' ;
                                                            $.each( eval(data) , function( index , value ){

                                                                    tmp_html += '<button tab_index="' + value.id + '" style="font-size: 15px; border: 1px solid white; width: 5%; background-color: white ! important; color: gray; padding: 0px;" type="button" class="btn btn-sm col-xs-3 btn-primary">' + value.name + '</button>' ;

                                                            });

                                                            tmp_html += '<div class="clearfix"></div>' ;
                                                            tmp_html += '<hr style="margin: 6px 0px 0px; border: 0.5px solid #e7e6e7;">' ;
                                                            $( "#tab_1" ).html( tmp_html );

                                                            $( "[page_type]" ).unbind( "click" ).bind( "click", function(e) {
                                                                    
                                                                    $( "[page_type]" ).css( "background-color" , "rgb(112, 112, 112)!important" );
                                                                    $( this ).css( "background-color" , "rgb(19, 74, 121)!important" );
                                                                    $.page_type = $( this ).attr( "page_type" ) ;
                                                                    
                                                                    $.nuw_page_num = 1;
                                                                    $( "#tab_1_content" ).html("");
                                                                    $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                                                            DisplayCurrentScroll(); 
                                                                    });
                                                                    $( "#loading_icon" ).show();
                                                                    
                                                                    getbody();
                                                                    /*if( $( "[tab_index][hasselected=1]" ).length == 0 )
                                                                    $( "[tab_index]" ).eq(0).trigger( "click" );
                                                                    else
                                                                    $( "[tab_index][hasselected=1]" ).trigger( "click" );*/
                                                            });

                                                            $( "[tab_index]" ).unbind( "click" ).bind( "click", function(e) {

                                                                    $( "[tab_index]" ).attr( "hasselected" , "0" );
                                                                    $( "[tab_index]" ).css( "color" , "gray" );
                                                                    $( this ).attr( "hasselected" , "1" );
                                                                    $( this ).css( "color" , "blue" );
                                                                    
                                                                    $.nuw_page_num  = 1 ;
                                                                    $.class         = $( this ).attr( "tab_index" ) ;

                                                                    $( "#tab_1_content" ).html("");
                                                                    $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                                                            DisplayCurrentScroll(); 
                                                                    });
                                                                    $( "#loading_icon" ).show();

                                                                    getbody();
                                                            
                                                            });
                                                            
                                                            init_scroll();
                                                            
                                                            //$("button[page_type=new]").click();
                                                            // $( "#tab_1" ).children( "[tab_index]" )
                                                }
                                    });
                                    
                                    
                                    
                                    //abin edit 2015.6.5 ++ 
                                    $.ajax({
                                                type: "POST",
                                                url: "php/cooperate_1.php",
                                                data: {
                                                    cmd : "check_user_identity" ,
                                                    url : $.getData.url ,
                                                    ch  : $.getData.ch ,
                                                    ttshow : getCookie( "ttshow" )
                                                },
                                                //dataType: "json",
                                                success: function( data )
                                                {
                                                        try 
                                                        {
                                                                var data = JSON.parse(data);
                                                                if( data.success ) {                                                                
                                                                        $("#channel_homepage").find("[id=text]").attr("style","border-top: 4px solid #428bca;background: white;color: #428bca;margin-bottom: 3px;");
                                                                        init_subTab_url();
                                                                        $("#title_toolbar").css("display","block");
                                                                } else {
                                                                        $("#title_toolbar").css("display","none");
                                                                }
                                                        }
                                                        catch(e) {
                                                                console.log(e);
                                                        }
                                                }
                                    });
                                    //abin edit 2015.6.5 --
                        });
                }
                //abin edit 2015.6.5 ++
                var init_subTab_url = function() {
                    
                        var href = "";
                        if( $.getData.url == "true" ) {
                            href = "?" + window.location.toString().split("?")[1];
                        } else {
                            if( $.getData.ch != null && $.getData.ch != undefined ) {
                                href = "?ch=" + $.getData.ch;
                            } else {
                                href = "";
                            }
                        }
                        $("#channel_homepage").attr( "href" , $("#channel_homepage").attr("href") + href );
                        $("#channel_publish_page").attr( "href" , $("#channel_publish_page").attr("href") + href );
                        $("#channel_list_page").attr( "href" , $("#channel_list_page").attr("href") + href );
                        $("#channel_setting").attr( "href" , $("#channel_setting").attr("href") + href );
                }
                //abin edit 2015.6.5 --
        </script>
        
        <script src="https://apis.google.com/js/platform.js"></script>
    </body>

</html>
