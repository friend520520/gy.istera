<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow - 我的圖片</title>
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

        <!-- ace settings handler -->
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

	<body class="no-skin" >
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
           
                <?php include("sidebar.php"); ?>
                
                <div class="main-content" style="margin-left: 190px;">
                <div class="main-content-inner">
                  <!-- #section:basics/content.breadcrumbs -->
                    <div class="page-content">

                        <div class="page-content" id="pagecontent" style="margin-left: 10px; margin-top: 10px;">
                            <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11" style="padding-right: 56px">
                                <div class="page-header">
                                    <h1>
                                        我的圖片
                                     </h1>
                                </div>                            
                                <div id="all_place" class="widget-box col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 7px; padding-top: 11px; padding-right: 10px;padding-bottom:18px ; overflow: hidden; display: none;">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 13px;margin-bottom: 10px">

                                        <button id="upload_btn" class="btn btn-sm  btn-primary panel-float-left" style="margin-top: 4px; border-radius: 3px;" onclick="window.location.href='upload_img.php'">
                                            <i class="fa fa-plus fa-lg"></i></button>
                                        <button id="delete_btn" class="btn btn-sm  btn-primary panel-float-left" style="margin-top: 4px; border-radius: 3px;;margin-left: 10px">
                                            <i class="fa fa-th-large fa-lg"></i>
                                        </button>

                                        <button id="check_delete_btn" class="btn btn-sm  btn-danger panel-float-left" style="margin-top: 4px; border-radius: 3px;;margin-left: 10px;display: none;">
                                            <i class="fa fa-trash-o fa-lg"></i>
                                        </button>



                                        <style>

                                            .choose_img {

                                                background-color: #d15b47;
                                            }

                                        </style>
                                        <div class="clearfix"> </div>
                                        <div id="img_place" style="margin-top: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-lg-1"></div>
                        </div>
                    </div>
                </div>
                </div>
        <!-- /.main-content -->
        </div>
        <!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <!--script type="text/javascript">
        window.jQuery || document.write("<script src='template/assets/js/jquery.js'>" + "<" + "/script>");
    </script-->

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

		<!-- ace scripts-->
		<!--script src="template/assets/js/ace/elements.scroller.js"></script>
		<script src="template/assets/js/ace/elements.colorpicker.js"></script>
		<script src="template/assets/js/ace/elements.fileinput.js"></script>
		<script src="template/assets/js/ace/elements.typeahead.js"></script>
		<script src="template/assets/js/ace/elements.wysiwyg.js"></script>
		<script src="template/assets/js/ace/elements.spinner.js"></script>
		<script src="template/assets/js/ace/elements.treeview.js"></script>
		<script src="template/assets/js/ace/elements.wizard.js"></script>
		<script src="template/assets/js/ace/elements.aside.js"></script-->
		<script src="template/assets/js/ace/ace.js"></script>
		<!--script src="template/assets/js/ace/ace.ajax-content.js"></script>
		<script src="template/assets/js/ace/ace.touch-drag.js"></script-->
		<script src="template/assets/js/ace/ace.sidebar.js"></script>
		<!--script src="template/assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="template/assets/js/ace/ace.submenu-hover.js"></script-->
		<!--script src="template/assets/js/ace/ace.widget-box.js"></script>
		<script src="template/assets/js/ace/ace.settings.js"></script>
		<script src="template/assets/js/ace/ace.settings-rtl.js"></script>
		<script src="template/assets/js/ace/ace.settings-skin.js"></script>
		<script src="template/assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="template/assets/js/ace/ace.searchbox-autocomplete.js"></script>

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
                                
                        $( "#delete_btn" ).unbind( "click" ).bind( "click" , function(){

                                $( "#delete_btn" ).hide();
                                $( "#check_delete_btn" ).show();
                                $( "#img_place" ).children().unbind( "click" ).bind( "click" , function(){

                                        if( $( this ).hasClass( "choose_img" ) )
                                            $( this ).removeClass( "choose_img" );
                                        else
                                            $( this ).addClass( "choose_img" );

                                });

                        });
                        
                        $( "#check_delete_btn" ).unbind( "click" ).bind( "click" , function(){

                                $( "#check_delete_btn" ).hide();
                                $( "#delete_btn" ).show();

                                $( "#img_place" ).children().unbind( "click" );
                                var img_array = [];

                                $.each( $( "#img_place" ).children( ".choose_img" ) , function( index , value ){

                                        img_array[ index ] = $( this ).attr( "index" );

                                });

                                console.log( img_array );

                                $.ajax({
                                        type    : "POST",  
                                        url     : "php/user_delete_image.php" ,
                                        data    : {
                                                    account : $.member.user_id ,
                                                    img    : img_array
                                        },
                                        success: function(data) 
                                        {
                                                console.log( data );
                                                image_list();
                                        }
                                });

                        });
                                                                                
                        
                        $( "#loadingpage" ).hide();

                });
                
                function image_list() {

                        $.ajax({
                                type    : "POST",  
                                url     : "php/user_list_image.php" ,
                                data    : {
                                            account : $.member.user_id ,
                                            size    : "Original"
                                },
                                success: function(data) 
                                {
                                        console.log( data );
                                        var tmp = "";

                                        if( data !== "empty" )
                                        {

                                                data = JSON.parse( data );
                                                console.log( data['url'] );
                                                $.each( data , function( index , value ){
                                                    
                                                    if( index !== "url" )
                                                    tmp = '<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2" style="padding: 10px;" index="' + value + '">' +
                                                            '<img style="width: 100%; height: 180px;" aria-hidden="true" alt="" src="' + data.url + value + '">' +
                                                            '<div style="font-size: 8pt;"><li style="display:inline;color: gray;">' + value + '</li>' +
                                                            '</div>' +
                                                        '</div>' + tmp;

                                                });

                                        }

                                        $( "#img_place" ).html( tmp );

                                }
                        });

                }
        </script>
        
        
        
        <script>
        
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            
                            $( "#all_place" ).show();
                            image_list();
                            
                };
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            
                            $( "#all_place" ).hide();
                            Login_Popup_show();
                            
                };

                function unlogin_jump()
                {
                            location.href = "index.php";
                }
                
        </script>
        <script src="js/fb-login.js"></script>

</body>

</html>
