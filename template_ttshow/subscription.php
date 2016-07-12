<!DOCTYPE html>
<html lang="en">
    <head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-訂閱頻道</title>
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
           
            <?php include("sidebar.php"); ?>
            
            <div class="main-content" style="background-color: rgb(242, 242, 242); margin-left: 190px;">
                <div class="main-content-inner">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 20px 30px 0px 20px">
                                <div style="background: none repeat scroll 0% 0% white; width: 100%; padding: 10px; margin-bottom: 20px;">
                                        <ul style="margin: 0px; padding: 0px;" class="breadcrumb">
                                            <li>
                                                <i class="ace-icon fa fa-home home-icon"></i>
                                                <a href="#">首頁</a>
                                            </li>
                                            <li class="active">訂閱頻道</li>
                                        </ul>
                                </div>

                                <div style="width: 100%;">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="width: 99%;">
                                                
                                                <div class="tabbable">
                                                  <ul class="nav nav-tabs" id="Tab">
                                                    <li id="all_subscription" class="" style="float: right;">
                                                      <a aria-expanded="false" data-toggle="tab" href="#1" style="background-color: rgb(242, 242, 242); border-top: 0px none; border-left: 0px none; border-right: 0px none;">訂閱列表</a>
                                                    </li>
                                                    <li id="new_subscription" class="active" style="float: right;">
                                                      <a aria-expanded="true" data-toggle="tab" href="#2" style="background-color: rgb(242, 242, 242); border-top: 0px none; border-left: 0px none; border-right: 0px none;">最新動態</a>
                                                    </li>


                                                  </ul>

                                                  <div class="tab-content" style="border: 0px none; padding-left: 7px;">
                                                          <div class="tab-pane fade" id="1">
                                                                <button title="Nothing selected" data-toggle="dropdown" class="" type="button" style="margin-bottom: 20px; background-color: Transparent; border: 1px solid rgb(221, 221, 221); padding: 5px 10px; border-radius: 7px; color: gray; position: absolute; top: -39px; left: 0px;">
                                                                        <span class="filter-option pull-left">訂閱時間</span>&nbsp;
                                                                        <span style="" class="caret"></span>
                                                                </button>
                                                                <div id="subscribe_list"></div>
                                                          </div>

                                                          <div id="2" class="tab-pane fade active in">
                                                              
                                                                <button style="border: 1px solid rgb(221, 221, 221); padding: 5px 10px; border-radius: 7px; color: gray; background-color: Transparent; margin-bottom: 20px; position: absolute; left: 0px; top: -39px;" type="button" class="" data-toggle="dropdown" title="Nothing selected" aria-expanded="false">
                                                                            <span class="filter-option pull-left">全部清除</span>
                                                                </button>
                                                                
                                                                <div id="new_subscribe_list">
                                                                </div>
                                                                <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                                                        <img src="template/assets/images/loading.gif" name="load_img">
                                                                </div>
                                                          </div>
                                                  </div>
                                                </div>

                                        </div>
                                </div>
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
		<!--script src="template/assets/js/ace/ace.widget-box.js"></script>
		<script src="template/assets/js/ace/ace.settings.js"></script>
		<script src="template/assets/js/ace/ace.settings-rtl.js"></script>
		<script src="template/assets/js/ace/ace.settings-skin.js"></script>
		<script src="template/assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="template/assets/js/ace/ace.searchbox-autocomplete.js"></script-->

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
                            
				//jquery tabs
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

                        $( "#loadingpage" ).hide();

                });
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            
                            $( "#main-container" ).show();
                            
                            init_scroll();
                }
                
                function FB_unconnected_callback_init()
                {
                            $.member = { email : "" };
                            $( "#main-container" ).hide();
                            
                            $( "#subscription_place" ).html( "" );
                            Login_Popup_show();
                            
                };
                
                function unlogin_jump()
                {
                            location.href = "index.php";
                }

                function init_scroll() {

                            $.nuw_page_num = 1 ;

                            $( "#place" ).html("");

                            $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                    if( $("#Tab > .active").attr( "id" ) === "new_subscription" )
                                        DisplayCurrentScroll();
                            });
                            $( "#loading_icon" ).show();
                            
                            get_subscription_list();
                            get_news_subscription_list();

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
                                            get_news_subscription_list();
                                        }, 500);
                                    }
                            }

                }
                
        </script>
        
        <script src="js/fb-login.js"></script>

        <script type="text/javascript">
                
                function get_subscription_list() {
                        $.ajax({
                                    type: "POST",
                                    url: "php/html_list_get_subscribe.php",
                                    data: {
                                                user        : $.member.email ,
                                                page_num    : 50 ,
                                                page        : 1
                                    },
                                    //dataType: "json",
                                    success: function( data ) {

                                            if( data !== "false" )
                                            {
                                                    $("#subscribe_list").append( data );

                                                    collect_subscribe_event();
                                            }

                                    }
                        }); 
                }
                
                function get_news_subscription_list() {
                        
                        $( "#loading_icon" ).css( "visibility" , "visible" );
                        
                        $.ajax({
                                    type: "POST",
                                    url: "php/json_list_get_subscribe_page.php",
                                    data: {
                                                user        : $.member.email ,
                                                page_num    : "16",
                                                page        : $.nuw_page_num
                                    },
                                    success: function( data ) {

                                            $( "#loading_icon" ).css( "visibility" , "hidden" );
                                            
                                            if( data !== "false" )
                                            {
                                                    data = JSON.parse( data );
                                                    var tmp = "";

                                                    $.each( data , function( index , value ){

                                                        tmp += create_upright( value , "col-xs-12 col-sm-12 col-md-6 col-lg-4" , false );

                                                    })
                                                    $( "#new_subscribe_list" ).append( tmp );
                                                    collect_subscribe_event();

                                                    $( window ).trigger( "scroll" );
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
        
    </body>

</html>
