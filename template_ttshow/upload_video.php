<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ttshow-上傳影片</title>

        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->

        <!-- ace styles -->
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

</head>

<body class="no-skin">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
        <?php include( "header_1.php"); ?>
            
    <div class="main-container" id="main-container" style="background-color: white;">
        <script type="text/javascript">
            try {
                ace.settings.check('main-container', 'fixed')
            } catch (e) {}
        </script>
        
        <div class="main-content" style="margin-top: 46px; padding-top: 100px;">

            <?php include( "sidebar.php"); ?>
            <div class="" style="margin-left: 190px;">
                <!-- #section:basics/content.breadcrumbs -->
                <div class="col-xs-0 col-sm-2 col-md-3 col-lg-3"></div>
                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6" id="upload_place" style="display: none;">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Custom File Input</h4>

                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>

                                <a href="#" data-action="close">
                                    <i class="ace-icon fa fa-times"></i>
                                </a>
                            </div>
                        </div>

                        <div style="display: block;" class="widget-body">
                            <div class="widget-main">
                                <!--div class="form-group">
                                    <div class="col-xs-12">
                                        <label class="ace-file-input">
                                            <input type="file" id="id-input-file-2">
                                            <span class="ace-file-container" data-title="Choose">
                                                <span class="ace-file-name" data-title="No File ...">
                                                    <i class=" ace-icon fa fa-upload"></i>
                                                </span>
                                            </span>
                                            <a class="remove" href="#">
                                                <i class=" ace-icon fa fa-times"></i>
                                            </a>
                                        </label>
                                    </div>
                                </div-->

                                <div class="form-group">
                                        <div class="col-xs-12">
                                                <input multiple="" type="file" id="file" />

                                                <!-- /section:custom/file-input -->
                                        </div>
                                </div>
                                
                                <!-- #section:custom/file-input.filter -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Title</label>
                                    <div class="col-sm-9">
                                        <input id="title_input" type="text" class="col-xs-10 col-sm-5" placeholder="…">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tag</label>
                                    <div class="col-sm-9">
                                        <input id="tag_input" type="text" class="col-xs-10 col-sm-5" placeholder="…">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description</label>
                                    <div class="col-sm-9">
                                        <textarea id="description_input" placeholder="Description" class="form-control m-b-10 "></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description</label>
                                    <div class="col-sm-9">
                                        <select id="pub_select" class="select">
                                            <option value="public">Public</option>
                                            <option value="private">Private</option>
                                            <option value="unlisted">Unlisted</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                <!-- /section:custom/file-input.filter -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-0 col-sm-2 col-md-3 col-lg-3"></div>

                <!-- /section:basics/content.breadcrumbs -->

                <!-- /.main-content -->



            </div>
        </div>


    </div>
    <!-- /.main-container -->
                <script src="js/view_upload_video.js"></script>
                <script src="js/ajaxq_upload.js"></script>
                
                

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
		<script src="template/assets/js/ace/ace.widget-box.js"></script>
		<script src="template/assets/js/ace/ace.settings.js"></script>
		<script src="template/assets/js/ace/ace.settings-rtl.js"></script>
		<script src="template/assets/js/ace/ace.settings-skin.js"></script>
		<script src="template/assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="template/assets/js/ace/ace.searchbox-autocomplete.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
                            
				$('#file').ace_file_input({
				     style:'well',
				     btn_choose:'Drop files here or click to choose',
				     btn_change:null,
				     no_icon:'ace-icon fa fa-cloud-upload',
				     droppable:true,
				     thumbnail:'small'//large | fit
				     //,icon_remove:null//set null, to hide remove/reset button
				     /**,before_change:function(files, dropped) {
				      //Check an example below
				      //or examples/file-upload.html
				      return true;
				     }*/
				     /**,before_remove : function() {
				      return true;
				     }*/
				     ,
				     preview_error : function(filename, error_code) {
				      //name of the file that failed
				      //error_code values
				      //1 = 'FILE_LOAD_FAILED',
				      //2 = 'IMAGE_LOAD_FAILED',
				      //3 = 'THUMBNAIL_FAILED'
				      //alert(error_code);
				     }
   
				    }).on('change', function(){
				     //console.log($(this).data('ace_input_files'));
				     //console.log($(this).data('ace_input_method'));
				    });

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
        
        <script type="text/javascript">
                
                function Google_connected_callback_init( response )
                {
                        console.log( response );
                }
        
                
                $.member = { facebook_mail : "" , email : "" };
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            
                            
                            $.ajax({
                                        type : "POST" ,
                                        url : "php/ttshow_checktoken.php" ,
                                        data : {cmd:"check"} ,
                                        success : function(data){
                                            console.log( data );
                                            if( data == "true" ) {
                                                    
                                                    $( "#upload_place" ).show();
                                                    
                                            } else {
                                                
                                                if( window.location.host === "ttshow.tw" )
                                                    location.href = "http://ttshow.tw/mobile/php/ttshow_get.php";
                                                else if( window.location.host === "www.ooxxoox.com" )
                                                    location.href = "http://www.ooxxoox.com/ttshow/mobile/php/ttshow_get.php";
                                            }
                                        } ,
                                        error : function(data){console.log(data);} ,
                            });
                };
                
                function FB_unconnected_callback_init()
                {
                            $( "#upload_place" ).hide();
                            $.member = { facebook_mail : "" , email : "" };
                            Login_Popup_show();
                };

                function unlogin_jump()
                {
                            location.href = "index.php";
                }
                
                $( "#loadingpage" ).hide();
                
        </script>

        <script src="js/fb-login.js"></script>
        <!--script src="js/google-login.js"></script-->
</body>

</html>
