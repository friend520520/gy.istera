<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ttshow-搜尋結果標籤頁</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">
                
                <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

                <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->
                <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />


                <script src="template/assets/js/jquery.js"></script>
                <script src="js/device.js"></script>
                <script src="js/create.js"></script>
                <script src="js/ajaxq.js"></script>

                <script src="template/assets/js/ace-extra.js"></script>

		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                <!--AL 0410-->
                <style>
                    .mwt_border{
                            background:#fff;
                            position:relative;
                            border: solid 1px #dddddd;
                            margin-top: 10px; 
                            border-bottom-style: none; 
                            border-bottom-width: 0px;
                    }
                    
                    .mwt_border .arrow_t_int{
                            border-color: transparent transparent #dddddd;
                            border-style: solid;
                            border-width: 6px;
                            height: 0;
                            left: 24%;
                            position: absolute;
                            top: -13px;
                            width: 0;
                    }
                    /*箭頭上-邊框*/
                    .mwt_border .arrow_t_out{
                            border-color: transparent transparent #fff;
                            border-style: solid;
                            border-width: 6px;
                            height: 0;
                            left: 24%;
                            position: absolute;
                            top: -12px;
                            width: 0;
                    }
                </style>
                
	</head>

	<body class="no-skin">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
        <?php include( "header_1.php"); ?>

        <!-- /section:basics/navbar.layout -->

        <div class="main-container" id="main-container" style="background-color: white;">
            <div class="main-content">
         
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wholepage web_sidebar_parent" style="left:0; right: 0; position: absolute;">
                           
                            <div style="padding: 0 35px 0 0;" class="web_sidebar_left col-xs-12 col-sm-12 col-md-12 col-lg-8"><!--bohan width:920px-->
                                    <!--div class="col-xs-12">
                                            <div id="nav-search" class="nav-search" style="width: 100%; margin-top: 10px;">
                                                    <a class="fa fa-angle-left" style="font-size: 30px; color: darkgray;"></a>
                                                    <span style="float: right; width: 90%; margin-right: 10px;" class="input-icon" id="search">
                                                            <input type="text" style="border-radius: 3px ! important; width: 100%; height: 32px; padding: 0px 6px;" autocomplete="off" onkeypress="keypress( event )">
                                                            <i class="ace-icon fa fa-search nav-search-icon" style="position: absolute; color: darkgray ! important; cursor: pointer; left: auto; right: 5px; vertical-align: middle; top: 3px;"></i>
                                                    </span>
                                            </div>
                                    </div-->

                                    <div class="col-xs-12" style="margin: 5px 0 0;padding: 0px;">
                                            <div style="text-align: center; width: 49%; display: inline-block; font-weight: bold; font-size: 14px;">
                                                    內容
                                            </div>
                                            <div style="text-align: center; width: 49%; display: inline-block; font-weight: bold; font-size: 14px;">
                                                    頻道
                                            </div>
                                            <!--AL 0623 三角形tab-->
                                            <div class="mwt_border">
                                                    <div>
                                                            <span class="arrow_t_int"></span>
                                                            <span class="arrow_t_out"></span>
                                                    </div>
                                                    <div style="display: none;">
                                                            <span class="arrow_t_int" style="right:24%; left: auto;"></span>
                                                            <span class="arrow_t_out" style="right:24%; left: auto;"></span>
                                                    </div>
                                            </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12" style="padding:0;">
                                        <div id="category" style="font-size: 15px; border-bottom: 1px solid rgb(221, 221, 221); position: relative; height: 42px; padding: 6px 0px; overflow-x: auto; overflow-y: hidden; word-break:keep-all;"></div>

                                        <!--div id="hot_tag" style="font-size: 15px; border-bottom: 1px solid #dddddd; position: relative; height: 42px; padding: 6px 0px; overflow-x: auto; overflow-y: hidden; word-break:keep-all;"></div-->

                                        <div id="special_tag" style="font-size: 15px; border-bottom: 1px solid #dddddd; position: relative; height: 42px; padding: 6px 0px; overflow-x: auto; overflow-y: hidden;">
                                            <span style="padding: 0px; text-align: center; margin: 0px 10px;" specialtag="1">
                                                <img width="25" height="25" style="vertical-align: middle;" src="images/10k.png">
                                                <span style="font-size: 17px; vertical-align: middle;">10k</span>
                                            </span>
                                            <span style="padding: 0px; text-align: center; margin: 0px 10px;" specialtag="20">
                                                <img width="25" height="25" style="vertical-align: middle;" src="images/20k.png">
                                                <span style="font-size: 17px; vertical-align: middle;">20k</span>
                                            </span>
                                            <span style="padding: 0px; text-align: center; margin: 0px 10px;" specialtag="50">
                                                <img width="25" height="25" style="vertical-align: middle;" src="images/50k.png">
                                                <span style="font-size: 17px; vertical-align: middle;">50k</span>
                                            </span>
                                            <span style="padding: 0px; text-align: center; margin: 0px 10px;" specialtag="100">
                                                <img width="25" height="25" style="vertical-align: middle;" src="images/100k.png">
                                                <span style="font-size: 17px; vertical-align: middle;">100k</span>
                                            </span>
                                        </div>
                                    </div>

                                    <div style="margin: 15px 0px 0px;" class="col-xs-12">
                                            <span id="search_num" style="font-size: 14px; color: gray; margin-left: 5px;" class="upright-title">
                                                0個結果
                                            </span>
                                            <hr style="margin: 5px 0;">
                                    </div>
                                    <!--直立 sample code-->
                                    <div id="pagecontent" style="">

                                    </div>

                                    <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                            <img src="template/assets/images/loading.gif" name="load_img">
                                    </div>

                            </div>
                            <?php include 'web_sidebar.php'; ?>
                            <script src="js/web_sidebar_event.js"></script>
                    </div>
                
            </div>
        </div>
        
        
        <script>!function(d,s,id){var js,ajs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://secure.assets.tumblr.com/share-button.js";ajs.parentNode.insertBefore(js,ajs);}}(document, "script", "tumblr-js");</script>
        
        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="template/assets/js/bootstrap.js"></script>

        <!-- page specific plugin scripts -->
        <script src="template/assets/js/jquery-ui.js"></script>
        <script src="template/assets/js/jquery.ui.touch-punch.js"></script>

        <!-- ace scripts --
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
        <script src="template/assets/js/ace/ace.widget-box.js"></script>
        <script src="template/assets/js/ace/ace.settings.js"></script>
        <script src="template/assets/js/ace/ace.settings-rtl.js"></script>
        <script src="template/assets/js/ace/ace.settings-skin.js"></script>
        <script src="template/assets/js/ace/ace.widget-on-reload.js"></script>
        <script src="template/assets/js/ace/ace.searchbox-autocomplete.js"></script-->

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
                
                jQuery(function($) {

                        //jquery tabs
                        $( "#tabs" ).tabs().show();
                });
        </script>

        <!-- the following scripts are used in demo only for onpage help and you don't need them -->
        <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
        <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

        <script type="text/javascript">
                ace.vars['base'] = '..';
        </script>

        
        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>
        
        <script src="js/ajaxq.js"></script>

        <script type="text/javascript">
                
                $("document").ready(function() {
                        
                        get_category();
                        //get_hot_tag();
                        
                        //$( "#nav-search" ).remove();
                        //$( "#header_search i" ).unbind( "click" );
                        
                        $( "#loadingpage" ).hide();
                        
                        $( "#header_search i" ).unbind( "click" ).bind( "click", function(e) {
                                
                                if( $( "#nav-search-input" ).val() !== "" )
                                {
                                        $( "#pagecontent" ).html("");
                                        $.page_data = [];
                                        $.nuw_page_num = 1;
                                        $.search_keyword = $( "#nav-search-input" ).val();
                                
                                        $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                                DisplayCurrentScroll(); 
                                        });
                                        $( "#loading_icon" ).show();
                                
                                        getcontent();
                                        window.scrollTo( 0 , 0 );
                                }
                                
                        });
                        
                        if( getParameterByName("search") )
                        {
                                if( $.member === undefined )
                                    $.member = { facebook_mail : "" , email : "" };
                                
                                $( "#nav-search-input" ).val( getParameterByName("search") );
                                $( "#header_search i" ).trigger( "click" );
                        }
                        else if( getParameterByName("specialtag") )
                        {
                                if( $.member === undefined )
                                    $.member = { facebook_mail : "" , email : "" };
                                
                                $.nuw_page_num = 1;
                                
                                get_spe_content();
                        }
                        
                });
                
                function active_event( pos ) {

                        pos.parent().children( "._active" ).removeClass( "_active" );
                        pos.addClass( "_active" );
                        if( $( "#nav-search-input" ).val() !== "" )
                        {
                                $( "#pagecontent" ).html("");
                                $.page_data = [];
                                $.nuw_page_num = 1;
                                $.search_keyword = $( "#nav-search-input" ).val();

                                $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                        DisplayCurrentScroll(); 
                                });
                                $( "#loading_icon" ).show();

                                getcontent();
                                window.scrollTo( 0 , 0 );
                        }
                }
                
                function get_category() {
                    
                    $.ajaxq( "step" , {
                                type: "POST",
                                url: "php/category.php?func=list",
                                data: {},
                                success: function(data) {
                                        
                                        if( data !== "false" )
                                        {
                                                data = JSON.parse( data );
                                                console.log( data );
                                                
                                                //////////////
                                                var left = 10;
                                                $( "#category" ).append( '<span class="_active" value="0" style="left: ' + left + 'px; position: absolute; padding: 6px 10px;">全站</span>' );
                                                $.each( data , function( index , value ){

                                                        left += $( "#category" ).children(":last").width() + 20;
                                                        $( "#category" ).append( '<span value="' + value.id + '" style="left: ' + left + 'px; position: absolute; padding: 6px 10px;">' + value.name + '</span>' );

                                                });
                                                $( "#category > span" ).unbind( "click" ).bind( "click", function(e) {
                                                        active_event( $(this) );
                                                });
                                                //////////////
                                                
                                        }

                                }
                    });
                    
                }
                
                function get_hot_tag() {
                    
                    var data = [ "這群人" , "彎彎" , "九把刀" , "胖虎黨" , "阿帕契" , "頑頑頑" , "頑頑頑" ];
                    var left = -10;
                    $.each( data , function( index , value ){
                            
                            left += $( "#hot_tag" ).children(":last").width() + 20;
                            $( "#hot_tag" ).append( '<span value="' + value + '" style="left: ' + left + 'px; position: absolute; padding: 6px 10px;">' + value + '</span>' );

                    });
                    $( "#hot_tag > span" ).unbind( "click" ).bind( "click", function(e) {
                            active_event( $(this) );
                    });
                    //////////////

                    $( "#hot_tag" ).html();
                    
                }
                
                function getcontent() {
                    
                    $( "#loading_icon" ).css( "visibility" , "visible" );
                    
                    $.ajaxq( "step" , {
                                type: "POST",
                                url: "php/json_list_page_search.php",
                                data: {
                                            user    : $.member.email ,
                                            sub     : $( "#category ._active" ).attr( "value" ) ,
                                            page_num  : "16" ,
                                            page   : $.nuw_page_num ,
                                            keyword : $.search_keyword
                                },
                                //dataType: "json",
                                success: function(data) {
                                        
                                        $( "#loading_icon" ).css( "visibility" , "hidden" );
                                        
                                        if( data !== "false" )
                                        {
                                                data = JSON.parse( data );
                                                console.log( data );
                                                
                                                $( "#search_num" ).html( data[0]['length'] + "個結果" );
                                                var tmp = "";
                                                /*var check_status = $( "#typesetting [create].active" ).attr( "create" );
                                                if( check_status === "upright" )
                                                    var func = function( a ){  return create_upright( a , "col-xs-12 col-sm-6 col-md-6 col-lg-6" ); } ;
                                                else if( check_status === "list" )*/
                                                    var func = function( a ){  return create_list( a , "col-xs-12 col-sm-12 col-md-12 col-lg-12" , "margin-bottom : 10px;" , false ); } ;
                                                /*else if( check_status === "chessboard" )
                                                    var func = function( a ){  return create_chessboard( a , "col-xs-12 col-sm-6 col-md-6 col-lg-6" ); } ;*/

                                                $.each( data , function( index , value ){

                                                        $.page_data[ $.page_data.length ] = value;
                                                        tmp += func( value );

                                                });
                                                $( "#pagecontent" ).append( tmp );

                                                
                                                collect_subscribe_event();

                                        }
                                        else
                                        {
                                                if( $.nuw_page_num === 1 )
                                                    $( "#search_num" ).html( "0個結果" );
                                                
                                                $( window ).unbind( "scroll" );
                                                $( "#loading_icon" ).hide();
                                        }

                                }
                    });
                    
                }
                
                function get_spe_content() {
                        
                        $( "#loading_icon" ).css( "visibility" , "visible" );
                        
                        $.ajax({
                                type: "POST",
                                url: "php/json_list_specialtag.php",
                                data: {
                                    user : $.member.email ,
                                    specialtag: getParameterByName("specialtag") ,
                                    page_num: "16" ,
                                    page: $.nuw_page_num ,
                                },
                                //dataType: "json",
                                success: function(data) {

                                    $( "#loading_icon" ).css( "visibility" , "hidden" );

                                    if( data !== "false" )
                                    {
                                            data = JSON.parse( data );

                                            $( "#search_num" ).html( data[0]['length'] + "個結果" );
                                            var tmp = "";

                                            $.each( data , function( index , value ){

                                                    tmp += create_list( value , "col-xs-12 col-sm-12 col-md-12 col-lg-12" , "margin-bottom : 10px;" , false );

                                            });
                                            $( "#pagecontent" ).append( tmp );
                                    }
                                    else
                                    {
                                            if( $.nuw_page_num === 1 )
                                                    $( "#search_num" ).html( "0個結果" );

                                            $( "body" ).unbind( "scroll_event" );
                                            $( "#loading_icon" ).hide();
                                    }

                                }
                        });
                    
                }
                
                function DisplayCurrentScroll() {
                    
                            if ($.device != "pc")
                                var tmp_div = $("body")[0];
                            else
                                var tmp_div = $("html")[0];

                            var tmp_persent = tmp_div.scrollTop / (tmp_div.scrollHeight - tmp_div.clientHeight);
                            
                            if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() )
                            {
                                if ($.tpathqueue)
                                        clearTimeout($.tpathqueue);
                                $.tpathqueue = setTimeout(function() {
                                        $.nuw_page_num++;
                                        getcontent();
                                }, 500);
                                
                                return false;
                            }
                            
                                

                }
                
                function FB_connected_callback_init( response )
                {
                            console.log( '-------------connect--------------' );
                            console.log( response );
                            $.member = response;
                            console.log( '---------------------------' );
                            $( "#search i" ).trigger( "click" );
                };
                
                function FB_unconnected_callback_init()
                {
                            console.log( '---------------un connect------------' );
                            $.member = { facebook_mail : "" , email : "" };
                            console.log( '---------------------------' );
                            $( "#search i" ).trigger( "click" );
                };
                
                function keypress( event ) {
                    
                    console.log( event.which );
                    if( event.which === 13 )
                        $( "#search i" ).trigger( "click" );
                    
                }

        </script>
        <script src="js/fb-login.js"></script>
        <script src="https://apis.google.com/js/platform.js"></script>
        
        </body>

</html>
