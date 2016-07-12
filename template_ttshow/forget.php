<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-忘記密碼</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">

                <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

                <!-- bootstrap & fontawesome -->
                <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
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
                <div class="main-content">
                        <div class="main-content-inner">
                                <div class="page-content">
                                        <div style="font-size: 15px; line-height: 30px; letter-spacing: 1px; padding: 6px 100px 0px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <h2 style="font-size: 20px; font-weight: normal; margin: 25px 0px 15px;">
                                                        忘記密碼
                                                </h2>
                                                <div class="input-group" style="width: 100%">
                                                            <span style="text-align: center; font-size: 17px; margin: 10px; color: gray; line-height: 34px;">請輸入E-mail帳號</span>
                                                            <input type="text" placeholder="" class="form-control" style="width: 85%; display: inline; float: right;" id="email">
                                                            
                                                            <div id="send" style="height: 45px; cursor: pointer; text-align: center; border: 2px solid white; border-radius: 6px; float: right; background: rgb(24, 74, 117) none repeat scroll 0px 0px;" class="col-xs-6 col-sm-3">
                                                                    <h3 style="color: white; text-align: center; font-size: 17px; margin: 10px;">寄送認證信</h3>
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
        
        
        <?php include( "footer.php"); ?>


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
        <script src="js/fb-login.js"></script>
        
        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>
        
        <script src="js/view_upload_img.js"></script>
        <script src="js/document_ready.js"></script>
        <script type="text/javascript">
                
                
                $("document").ready(function() {
                        
                        $( "#send" ).unbind( "click" ).bind( "click" , function(){
                            
                                if( $( "#email" ).val() !== "" ) {
                                    
                                    var data = {
                                        func : "forget" ,
                                        email : $( "#email" ).val()
                                    };
                                    var callback = function( data ){
                                        console.log(data);
                                        if( data !== "false" ) {
                                            
                                            data = {
                                                func : "forget" ,
                                                email : $( "#email" ).val() ,
                                                token : data
                                            };
                                            
                                            var callback = function( data ){
                                                
                                                if( data === "true" )
                                                    location.href = "signup_gen_mail.php";
                                                else if( data === "false" )
                                                    alert( "認證信寄送失敗" );
                                                
                                            };
                                            
                                            $.Ajax( "POST" , "http://www.ggyyggy.com/bohan/gmailsystem/confirm_1.php" , data , "" , callback , "" );
                                            
                                        }
                                    };
                                    var errorback = function( data ){
                                        console.log(data);
                                    };
                                    //$.Ajax( "POST" , "http://www.ggyyggy.com/bohan/gmailsystem/confirm_1.php" , data , "" , callback , errorback );
                                    $.Ajax( "POST" , "php/member.php" , data , "" , callback , errorback );
                                    
                                }
                                
                        });
                        
                        $( "#loadingpage" ).hide();
                        
                });
                
                function FB_connected_callback_init( response )
                {
                            
                };
                function FB_connected_callback_select_ttshow_db( data ) {
                        
                }
                function FB_unconnected_callback_init() {
                        
                }
        </script>

</body>

</html>
