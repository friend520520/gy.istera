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


                <?php include( "header_1.php"); ?>

                <div class="main-container" id="main-container" style="background-color: white;">

                        <div class="main-content">
                                    <div class="main-content-inner" >
                                                <div class="page-content">

                                                        <style>
                                                            ._active {
                                                                background-color: rgb(42, 104, 168);
                                                                color: white;
                                                            }
                                                        </style>
                                                        <div id="pagecontent" class="page-content col-xs-12 col-sm-12" style="padding: 0px 85px; margin-top: 25px; display:none;">


                                                                <div id="pagecontent_body" class="col-xs-12 col-sm-12" style="margin-top: 10px; padding:0;">
                                                                </div>
                                                                <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                                                        <img src="template/assets/images/loading.gif" name="load_img">
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
                                
                        });
                        
                        function getbody() {

                                $( "#loading_icon" ).css( "visibility" , "visible" );
                                $("#pagecontent").show();
                                $.ajax({
                                            type: "POST",
                                            url: "php/json_list_categorypage.php",
                                            data: {
                                                        user        : $.member.email ,
                                                        page_num    : "16" ,
                                                        page        : $.nuw_page_num.toString() ,
                                                        sub         : $.now_tabs_name.toString() ,
                                                        page_type   : $.page_type
                                                        /*subsub      : "1"*/
                                            },
                                            //dataType: "json",
                                            success: function(data) {

                                                        $( "#loading_icon" ).css( "visibility" , "hidden" );
                                                        
                                                        if( data == "false" )
                                                        {
                                                            $( window ).unbind( "scroll" );
                                                            $( "#loading_icon" ).hide();
                                                        }
                                                        else {
                                                            
                                                            data = JSON.parse( data );
                                                            var tmp = "";
                                                            
                                                            $.each( data , function( index , value ){
                                                                
                                                                tmp += create_upright( value , "col-xs-12 col-sm-6 col-md-4 col-lg-4" , false );
                                                                
                                                            })
                                                            $( "#pagecontent_body" ).append( tmp );
                                                            //$( "#pagecontent_body" ).children(":even").css( "padding" , "0 5px 0 0" );
                                                            //$( "#pagecontent_body" ).children(":odd").css( "padding" , "0 0 0 5px" );
                                                            collect_subscribe_event();
                                                            
                                                            
                                                        }
                                                        $.loading = 0;

                                            }
                                });

                        }
                        
                        function init_scroll() {

                                    $.page_type = "new";
                                    $.now_tabs_name = "0" ;
                                    $.nuw_page_num = 1 ;
                                    
                                    $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                            DisplayCurrentScroll(); 
                                    });
                                    $( "#loading_icon" ).show();
                                    ///////////////////////
                                    $( "#tabs" ).children( "ul" ).children( "li[pagetype=9999]" ).addClass( "ui-tabs-active" ).addClass( "ui-state-active" );
                                    ///////////////////////

                                    getbody();
                                    
                        }
                        
                        function DisplayCurrentScroll() {

                                    if( $( "body" )[0].scrollTop >= $( "html" )[0].scrollTop )
                                        var tmp_div = $( "body" )[0] ;
                                    else
                                        var tmp_div = $( "html" )[0] ;

                                    var tmp_persent = tmp_div.scrollTop / (tmp_div.scrollHeight - tmp_div.clientHeight);
                                    
                                    if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#pagecontent_body").children(":eq(0)").height()*6 )
                                    {
                                            if (!$.loading)
                                            {
                                                $.loading = 1;
                                                $.tpathqueue = setTimeout(function() {
                                                    $.nuw_page_num++;
                                                    scroll();
                                                }, 500);
                                            }
                                    }

                        }

                        function scroll() {

                                    getbody();

                        }
                        
                </script>
                
    </body>

</html>
