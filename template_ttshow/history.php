<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow - 瀏覽紀錄</title>
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

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
		<script src="template/assets/js/html5shiv.js"></script>
		<script src="template/assets/js/respond.js"></script>
		<![endif]-->
		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                
                
                <!-- design by al -->
                    <style>
                        .panel-body1{
                           padding-left: 10px; 
                           padding-right: 10px;
                        }
                        .panel1{
                           float: left;
                           width: 100%; 
                           margin-bottom: 15px;
                        }
                        .panel1-btn{
                           float: right;
                           padding: 0px 13px; 
                           border-radius: 3px; 
                           background-color: rgb(19, 74, 121) !important;
                           border-color: rgb(19, 74, 121) !important;
                        }
                        .panel1-id{
                           margin-left: 9px; 
                           font-size: 11pt;
                        }
                        .panel1-identity{
                           margin-left: 8px;
                        }
                        .panel1-time{
                           position: absolute; 
                           margin-top: 10px; 
                           left: 70px;
                        }
                        .panel1-time-icon{
                           color: gray; 
                           padding-right: 5px;
                        }
                        .panel1-time span{
                           color: gray;
                        }
                        .panel1-title{
                           font-size: 14pt;
                           letter-spacing: 1px; 
                           margin-top: 5px; 
                           margin-bottom: 0px;
                        }
                        .panel1-time-description{
                           letter-spacing: 1px; 
                           color: gray; 
                           margin-top: 5px; 
                           margin-bottom: 10px;
                        }
                        .panel1-like{
                           float: left;
                            margin-right: 5px
                        }
                        .panel1-view{
                           float: left; 
                           color: gray;
                        }
                        .panel1-icontext{
                           margin-right: 3px;
                        }
                        .panel1-replay{
                           float: left; 
                           margin-left: 5px;
                           color: gray;
                        }
                        .panel1-tag{
                           background-color: gray;
                           color: white;
                           float: right;
                           font-size: 9pt;
                           margin-right: 5px;
                           padding: 1px 2px;
                        }
                        .panel1-firetag{
                           position: absolute; 
                           right: 12px;
                        }
                        
                        
                        
                        .semi-transparent-button {
                            background: none repeat scroll 0 0 rgba(30, 52, 142, 0.6);
                            border-radius: 8px;
                            box-sizing: border-box;
                            color: #fff;
                            display: block;
                            letter-spacing: 1px;
                            margin: 0 auto;
                            max-width: 100px;
                            padding: 8px;
                            text-align: center;
                            text-decoration: none;
                            transition: all 0.3s ease-out 0s;
                            width: 80%;
                        }
                    </style>
	</head>

	<body class="no-skin">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
        
                <?php include("sidebar.php"); ?>
            
                <div class="main-content" style="margin-left: 190px;">
                <div class="main-content-inner">
                  <!-- #section:basics/content.breadcrumbs -->
                                                <div class="page-content">

                                                    <div class="page-content" id="pagecontent">

                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 5px;">
                                                            <div class="page-header">
                                                                <h1>
                                                                    <button style="float: right; margin-left: 10px;" class="btn btn-white btn-success" type="button">
                                                                      更新時間
                                                                    </button>
                                                                    <button type="button" class="btn btn-white btn-success" style="float: right">
                                                                      訂閱時間
                                                                    </button>
                                                                    瀏覽紀錄
                                                                 </h1>
                                                            </div>

                                                            <div id="collect_place">

                                                            </div>
                                                        </div>
                                                      </div>

                                                </div>
                                    </div>
                </div>
                <!--div class="main-content">
                            <div class="main-content-inner" style="margin-top: 45px">
                                        <div class="page-content">
                                                    <div class="widget-body">
                                                                <div class="widget-main padding-0">
                                                                  <div class="tab-content padding-0">
                                                                    <div class="tab-pane in active" id="pagecontent">
                                                                    </div>

                                                                  </div>
                                                                </div>
                                                    </div>
                                        </div>
                            </div>
                </div-->
        </div>

        
        <!-- /.main-content -->
  
  
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
                    </i>
        </a>
        
        </div>
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
        
        
        <!-- init       : null -->
        <!-- callback   : FB_connected_callback_init( response ) -->
        
        <style>
                    
                    /* <div style="background-image:url('img/global/folder.png');"></div> */
                    .pagebg {
                                background-position: 50% 0%;
                                background-size: cover;
                                height: 94%;
                                margin-left: 0%;
                                margin-top: 3%;
                                /*position: absolute;*/
                                width: 94%;
                    }
            
        </style>

        <script type="text/javascript">
                
                $("document").ready(function() {
                    
                        $( "#loadingpage" ).hide();
                        
                });
                
                function FB_connected_callback_init( response )
                {
                            console.log( '---------------------------' );
                            console.log( response );
                            $.member = response;
                            $( "#user-profile" ).hide().html( 'Dear ' + response.name );
                            
                            $( "#user-profile-join" ).hide(); // show
                            
                            $( "#user-profile-join" ).unbind( "click" ).bind( "click", function(e) {
                                        alert(123);
                            });
                            console.log( '---------------------------' );
                            
                            getbody( function(data) {
                                

                                        if( data == "false" )
                                        {
                                                $( "#collect_place" ).append( "" );
                                        }
                                        else
                                        {
                                                var tmp = "";
                                                data = JSON.parse( data );
                                                
                                                $.each( data , function( index , value ){
                                                        
                                                        tmp += create_upright( value , "col-xs-12 col-sm-12 col-md-6 col-lg-4" , true );
                                                        
                                                });
                                                
                                                $( "#collect_place" ).append( tmp );
                                                collect_subscribe_event();
                                                
                                        }

                            } , function(data) {



                            } );
			    
                            
                            $( "#fb-login-button" ).removeClass( "nav-search" );
                }
                
                function FB_unconnected_callback_init()
                {
                            console.log( '---------------------------' );
                            $.member = { facebook_mail : "" , email : "" };
                            $( "#user-profile" ).hide();
                            
                            $( "#user-profile-join" ).hide();
                            
                            $( "#user-profile-join" ).unbind( "click" );
                            
                            console.log( '---------------------------' );
                            
                            $( "#collect_place" ).html( "" );
                            
                };
                
                function getbody( success , fail ) {
                    
                    $.ajax({
                                type: "POST",
                                url: "php/json_list_get_collect.php",
                                data: {
                                            user        : $.member.email ,
                                            page_num    : 5 ,
                                            page        : 1
                                            /*subsub      : "1"*/
                                },
                                //dataType: "json",
                                success: success ,
                                error: fail
                    });
                    
                }
                
        </script>
        
        <script src="js/fb-login.js"></script>

</body>

</html>
