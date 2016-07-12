<html lang="en"  style="z-index:-20;">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-首頁</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">

                <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

                <meta name="keywords" content="達人秀,ttshow,新媒體創作行銷平台,新媒體人才媒合,新媒體社群行銷,新媒體影音製作,明星,藝人,插畫家,網路紅人,導演,編劇,熱門影片,Youtube排行,facebook排行,喜劇,搞笑,梗圖,音樂,寵物,有趣新聞"/>
                <meta name="og:description" content="好作品好人才需要被全世界看見" />
                <meta property="og:image" content="http://ttshow.tw/ttshow/web/images/cover.png"/>
                <meta property="og:title" content="台灣達人秀│最強自媒體聯播網"/>
                <script>
                        document.write('<meta property="og:url" content="' + location.href + '"/>');
                </script>

                <!-- bootstrap & fontawesome -->
                <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->

                <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

                <script src="template/assets/js/ace-extra.js"></script>

		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                
                <script src="template/assets/js/jquery.js"></script>
                <script src="js/device.js"></script>
                <script src="js/create.js"></script>
                <script src="js/ajaxq.js"></script>
                
        </head>

        <body class="no-skin">
                <!-- #section:basics/navbar.layout -->
                <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>


                <?php include( "header_2.php"); ?>


                <div class="main-container" id="main-container2" style="background-color: white;">

                        <div class="main-content">
                                    <div class="main-content-inner" >
                                                <div class="page-content">

                                                        <div class="page-content tabbable ui-tabs ui-widget ui-widget-content ui-corner-all">
                                                                
                                                                <!--0805 AL edit-->
                                                                <div class="col-xs-3 col-sm-3"></div>

                                                                <ul id="Tab" style="background-color: rgb(249, 249, 249); height: 47px; margin: 20px 0 10px;" class="col-xs-6 col-sm-6 ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">

                                                                        <li pagetype="day" style="padding: 0px;position: relative;text-align: center; margin: 0px;" class="col-xs-3 col-sm-3 ui-state-default ui-corner-top ui-tabs-active ui-state-active">
                                                                                    <a style="border-right: 0 none;border-radius: 6px 0 0 6px;width: 100%;" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">本日排行</a>
                                                                        </li>
                                                                        <li pagetype="week" id="new_subscription" style="padding: 0px;position: relative;text-align: center; margin: 0px;" class="col-xs-3 col-sm-3 ui-state-default ui-corner-top">
                                                                                    <a style="border-right: 0 none;width: 100%;" class="ui-tabs-anchor" role="presentation" tabindex="-1">本周排行</a>
                                                                        </li>
                                                                        <li pagetype="month" id="all_subscription" style="padding: 0px;position: relative;text-align: center; margin: 0px;" class="col-xs-3 col-sm-3 ui-state-default ui-corner-top">
                                                                                    <a style="border-right: 0 none;width: 100%;" class="ui-tabs-anchor" role="presentation" tabindex="-1">本月排行</a>
                                                                        </li>
                                                                        <li pagetype="whole" style="padding: 0px;position: relative;text-align: center; margin: 0px;" class="col-xs-3 col-sm-3 ui-state-default ui-corner-top">
                                                                                    <a style="border-radius: 0 6px 6px 0;width: 100%;" class="ui-tabs-anchor" role="presentation" tabindex="-1">總排行</a>
                                                                        </li>
                                                                </ul>
                                                                
                                                                <div class="col-xs-3 col-sm-3"></div>
                                                                
                                                                
                                                                <div class="clearfix"></div>
                                                                
                                                                
                                                                <div class="col-xs-4 col-sm-4"></div>

                                                                <div id="category" class="col-xs-4 col-sm-4 drag_bar" style="border: 0px;"></div>
                                                                
                                                                <div class="col-xs-4 col-sm-4"></div>
                                                                
                                                                
                                                                <div class="clearfix"></div>
                                                                
                                                                
                                                                <div style="padding:0 23px;"><hr style="margin-top: 15px;"></div>
                                                                

                                                                <div id="pagecontent" class="page-content col-xs-12 col-sm-12" style="padding: 0px 10px; display:none; width: 100%;">


                                                                        <div id="pagecontent_day" class="col-xs-12 col-sm-12" style="margin-top: 10px; padding:0;"></div>

                                                                        <div id="pagecontent_week" class="col-xs-12 col-sm-12" style="margin-top: 10px; padding:0; display: none;"></div>

                                                                        <div id="pagecontent_month" class="col-xs-12 col-sm-12" style="margin-top: 10px; padding:0; display: none;"></div>

                                                                        <div id="pagecontent_whole" class="col-xs-12 col-sm-12" style="margin-top: 10px; padding:0; display: none;"></div>
                                                                        <!--div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                                                                <img src="template/assets/images/loading.gif" name="load_img">
                                                                        </div-->
                                                                </div>

                                                        </div>
                                                        
                                                </div>
                                    </div>
                        </div>

                </div>

                <?php include( "footer.php"); ?>

                <script type="text/javascript">
                        if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
                </script>
                <script src="template/assets/js/bootstrap.js"></script>

		<script src="template/assets/js/jquery-ui.js"></script>
		<script src="template/assets/js/jquery.ui.touch-punch.js"></script>

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
       

                <script>


                        function FB_connected_callback_init( response )
                        {
                                    $.member = response;

                                    init_scroll();
                        };

                        function FB_unconnected_callback_init()
                        {
                                    $.member = { facebook_mail : "" , email : "" };

                                    init_scroll();
                        };

                </script>
                <script src="js/fb-login.js"></script>
                <script type="text/javascript">

                        $("document").ready(function() {

                                $( "#loadingpage" ).hide();
                                
                                $( "#Tab > li" ).unbind( "click" ).bind( "click", function(e) {

                                            $( "#Tab > li" ).removeClass( "ui-tabs-active" ).removeClass( "ui-state-active" );
                                            $( this ).addClass( "ui-tabs-active" ).addClass( "ui-state-active" );

                                            $.now_tabs_name = $( this ).attr( "pagetype" );

                                            $( ".tab-content" ).children().removeClass("active").removeClass("in");
                                            $( this ).addClass("active").addClass("in");

                                            $( "#pagecontent" ).children().hide();
                                            $( "#pagecontent_" + $( this ).attr( "pagetype" ) ).show();

                                });
                                
                        });
                        
                        function get_category() {

                            $.ajaxq( "step" ,{
                                        type: "POST",
                                        url: "php/category.php?func=list",
                                        data: {},
                                        success: function(data) {

                                                if( data !== "false" )
                                                {
                                                        data = JSON.parse( data );
                                                        console.log( data );

                                                        //////////////
                                                        $( "#category" ).append( '<span class="_active" value="0">全部</span>' );
                                                        $.each( data , function( index , value ){

                                                                $( "#category" ).append( '<span value="' + value.id + '">' + value.name + '</span>' );

                                                        });
                                                        $( "#category > span" ).unbind( "click" ).bind( "click", function(e) {
                                                            
                                                                var pos = $(this);
                                                                pos.parent().children( "._active" ).removeClass( "_active" );
                                                                pos.addClass( "_active" );
                                                                
                                                                getbody();
                                                                
                                                        });
                                                        //////////////

                                                        $("#pagecontent").show();
                                                        getbody();
                                                        
                                                }

                                        }
                            });

                            
                        }
                        
                        function getbody() {

                                //$( "#loading_icon" ).css( "visibility" , "visible" );
                                $("#pagecontent").children().html( "" );
                                var sub = $( "#category ._active" ).attr( "value" );
                                
                                $.ajaxq( "step" , {
                                            type: "POST",
                                            url: "php/json_list_Hot.php",
                                            data: {
                                                        page_num    : "100" ,
                                                        page        : "1" ,/*$.nuw_page_num.toString() ,*/
                                                        sub         : sub
                                            },
                                            //dataType: "json",
                                            success: function(data) {

                                                        $( "#loading_icon" ).css( "visibility" , "hidden" );
                                                        
                                                        if( data == "false" )
                                                        {
                                                            
                                                        }
                                                        else {
                                                            
                                                            data = JSON.parse( data );
                                                            console.log( data );
                                                            
                                                            var tmp = "";
                                                            $.each( data.day , function( index , value ){
                                                                    
                                                                    tmp += create_chessboard( value , "col-xs-12 col-sm-6 col-md-4 col-lg-4" , "" , index + 1 );
                                                                    
                                                            });
                                                            $( "#pagecontent_day" ).append( tmp );
                                                            
                                                            var tmp = "";
                                                            $.each( data.week , function( index , value ){
                                                                    
                                                                    tmp += create_chessboard( value , "col-xs-12 col-sm-6 col-md-4 col-lg-4" , "" , index + 1 );
                                                                    
                                                            });
                                                            $( "#pagecontent_week" ).append( tmp );
                                                            
                                                            var tmp = "";
                                                            $.each( data.month , function( index , value ){
                                                                    
                                                                    tmp += create_chessboard( value , "col-xs-12 col-sm-6 col-md-4 col-lg-4" , "" , index + 1 );
                                                                    
                                                            });
                                                            $( "#pagecontent_month" ).append( tmp );
                                                            
                                                            var tmp = "";
                                                            $.each( data.whole , function( index , value ){
                                                                    
                                                                    tmp += create_chessboard( value , "col-xs-12 col-sm-6 col-md-4 col-lg-4" , "" , index + 1 );
                                                                    
                                                            });
                                                            $( "#pagecontent_whole" ).append( tmp );
                                                            
                                                        }

                                            }
                                });

                        }
                        
                        function init_scroll() {

                                    $.page_type = "hot";
                                    $.now_tabs_name = "0" ;
                                    $.nuw_page_num = 1 ;
                                    
                                    get_category();
                                    
                        }
                        
                </script>

    </body>

</html>
