<!DOCTYPE html>
<html lang="en">
    <head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow - 特殊標籤結果頁</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">
        
        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->

        <!-- ace styles 4/9 AL 更換CSS路徑-->
        <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

        <script src="template/assets/js/jquery.js"></script>
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        <script src="template/assets/js/ace-extra.js"></script>

        <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                
    </head>

    <body class="no-skin">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
            <!-- /section:basics/sidebar -->
            <div class="main-content">
                <div class="main-content-inner web_sidebar_parent">
                    <div class="page-content web_sidebar_left col-xs-12">
                        
                        <img id="specialtag_icon_title" width="42px" height="42px" style="position: relative; margin: 10px 15px;" src="">
                        
                        <div id="place" style="padding-left:  15px;" class="col-xs-12">

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
        </div>

        
        <!-- /.main-content -->
  
  
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
                    </i>
        </a>
        
        </div>
        

        <!-- <![endif]-->

        <!--[if IE]>
    <script type="text/javascript">
     window.jQuery || document.write("<script src='template/assets/js/jquery1x.js'>"+"<"+"/script>");
    </script>
    <![endif]-->
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

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
                                
                                if( $( "#tabs" ).length )
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
        
        
        <script type="text/javascript">

                $("document").ready(function() {
                    
                        switch( getParameterByName( "specialtag" ) )
                        {
                            case "1":
                                $( "#specialtag_icon_title" ).attr( "src" , "images/10k.png" );
                                break;
                            case "20":
                                $( "#specialtag_icon_title" ).attr( "src" , "images/20k.png" );
                                break;
                            case "50":
                                $( "#specialtag_icon_title" ).attr( "src" , "images/50k.png" );
                                break;
                            case "100":
                                $( "#specialtag_icon_title" ).attr( "src" , "images/100k.png" );
                                break;
                        }
                        
                        $( "#loadingpage" ).hide();
                        
                });
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            
                            $( "#place" ).html( "" );
                            
                            init_scroll();
                }
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            
                            $( "#place" ).html( "" );
                            
                            init_scroll();
                };
                        
                function init_scroll() {

                            $.nuw_page_num = 1 ;
                            
                            $( "#place" ).html("");

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

                            if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#pagecontent_body").children(":eq(0)").height()*6 )
                            {
                                    if (!$.loading)
                                    {
                                        $( "#loading_icon" ).css( "visibility" , "visible" );
                                        $.loading = 1;
                                        $.tpathqueue = setTimeout(function() {
                                            $.nuw_page_num++;
                                            getbody();
                                        }, 500);
                                    }
                            }

                }
                
                function getbody(){
                        
                        $( "#loading_icon" ).css( "visibility" , "visible" );
                        
                        $.ajax({
                                type: "POST",
                                url: "php/html_list_specialtag.php",
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
                                            $( "#place" ).append( data );
                                            
                                            collect_subscribe_event();
                                            
                                            
                                            $( "#loading_icon" ).css( "visibility" , "hidden" );
                                            DisplayCurrentScroll ();
                                    }
                                    else
                                    {
                                            $( window ).unbind( "scroll" );
                                            $( "#loading_icon" ).hide();
                                    }
                                    $.loading = 0;

                                }
                        });
                        
                }
        </script>
        
        <script src="js/fb-login.js"></script>
        <script src="https://apis.google.com/js/platform.js"></script>

    </body>

</html>
