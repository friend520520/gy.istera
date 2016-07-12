<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-創作投稿</title>
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
        
         <script src="js/view_upload_contribute.js"></script>
        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
		<script src="template/assets/js/html5shiv.js"></script>
		<script src="template/assets/js/respond.js"></script>
		<![endif]-->
		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                
                
	</head>

        <body class="no-skin" style="background-color: #DDDDDD;">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay">
                <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
        </div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
        
            <div style="text-align: center; margin: 84px auto auto;">        
                    <div style="padding-left: 5px; font-weight: bold; font-size: 17pt; height: 30px;">
                            <div style="position: relative; top: 6px;font-size: 23pt">創作投稿</div>
                    </div>
            </div>

            <div style="right: 0px; left: 0px; background: white none repeat scroll 0% 0%; margin: 40px auto auto; max-width: 800px; padding: 40px; position: relative;">
                    <!--div style="float: right; margin-right: 48px; margin-top: 35px;">
                            <img src="template/assets/img/x2.png">
                    </div-->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: white none repeat scroll 0% 0%; padding: 10px 30px 30px;">
                            <div style="width : 100%; font-size: 12pt;text-align: center; margin-bottom: 50px;">
                                    <img src="template/assets/img/loading_black.png" style="height: 200px; margin: 30px auto 50px; left: 0px; right: 0px; border: 1px solid orange; width: 200px; border-radius: 100%;">
                                    <div style="font-size: 20pt; margin-bottom: 20px;">
                                            投稿已送出，請靜候結果 
                                    </div>
                                    <button id="" class="btn btn-success btn-next" style="width: 215px; font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important; margin: 15px 0px;">
                                            查看我的創作
                                    </button>
                                    <div class="clearfix"></div>
                                    <a href="index.php">
                                            <u>回首頁</u>
                                    </a>
                            </div>
                    </div>
                    <div class="clearfix"></div>
            </div>
            
        </div>

        <?php include("footer.php"); ?>
        
        
        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="template/assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		<script src="template/assets/js/jquery-ui.js"></script>
		<script src="template/assets/js/jquery.ui.touch-punch.js"></script>

                <script src="template/assets/js/fuelux/fuelux.wizard.js"></script>
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
        <script src="js/fb-login.js"></script>
        <script type="text/javascript">

                
                $("document").ready(function() {
			
                        $('#fuelux-wizard-container')
                        .ace_wizard({
                                //step: 2 //optional argument. wizard will jump to step "2" at first
                                //buttons: '.wizard-actions:eq(0)'
                        })
                        .on('actionclicked.fu.wizard' , function(e, info){
                                console.log( info );
                                if( info.step === 1 && info.direction === "next" ) {
                                        console.log( next1_event() );
                                        return next1_event();
                                }
                                else if( info.step === 2 && info.direction === "next" ) {
                                        console.log( next2_event() );
                                        return next2_event();
                                }
                                else if( info.step === 3 && info.direction === "previous" ) {
                                        if( $( "#upload_place .ace-file-container.selected" )[0] )
                                            return true;
                                        else
                                            return false;
                                }
                                
                        })
                        .on('finished.fu.wizard', function(e) {
                                
                                clear_input();
                                $( "#fuelux-wizard-container .steps [data-step=1]" ).trigger("click");
                                
                        }).on('stepclick.fu.wizard', function(e){
                                //e.preventDefault();//this will prevent clicking and selecting steps
                                console.log( 'stepclick.fu.wizard' );
                                
                        });
                        /*
                        $('#file_upload_img').ace_file_input({
                                style:'well',
                                btn_choose:'秀圖片',
                                btn_change:null,
                                no_icon:'ace-icon fa fa-cloud-upload',
                                droppable:true,
                                thumbnail:'small',
                                preview_error : function(filename, error_code) {
                                        console.log( filename );
                                        console.log( error_code );
                                },
                                before_remove : function() {
                                        
                                        $( "#upload_place" ).children().show();
                                        return true;
                                },
                                before_change : function( file ) {
                                        
                                        var JudgeFilesType = file[0]['type'];
                                        console.log( JudgeFilesType );
                                        if( JudgeFilesType === "image/jpg" || JudgeFilesType === "image/png" || JudgeFilesType === "image/gif" || JudgeFilesType === "image/jpeg"  )
                                                return true;
                                        else
                                                return false;
                                        
                                }

                       }).on('change', function(){
                        //console.log($(this).data('ace_input_files'));
                        //console.log($(this).data('ace_input_method'));
                       });
                        
                        
                        $('#file_upload_video').ace_file_input({
                                style:'well',
                                btn_choose:'秀影片',
                                btn_change:null,
                                no_icon:'ace-icon fa fa-camera',
                                droppable:true,
                                thumbnail:'small',
                                preview_error : function(filename, error_code) {
                                        console.log( filename );
                                        console.log( error_code );
                                },
                                before_remove : function() {
                                        
                                        $( "#upload_place" ).children().show();
                                        return true;
                                },
                                before_change : function( file ) {
                                    
                                        var JudgeFilesType = file[0]['type'];
                                        console.log( JudgeFilesType );
                                        if( JudgeFilesType === "video/mp4" || JudgeFilesType === "video/avi" )
                                                return true;
                                        else
                                                return false;
                                            
                                }

                       }).on('change', function(){
                        //console.log($(this).data('ace_input_files'));
                        //console.log($(this).data('ace_input_method'));
                       });
                        
                        $('#file_upload_img').parent("label")
                               .css("width","130px")
                               //.css("height","130px")
                               .css("position","relative")
                               .css("border-radius","0px")
                               .css("border","4px solid rgba(0, 0, 0, 0.2)")
                               //.css("margin-top","10px")
                               //.css("margin-left","100px")
                               .css("display","inline-block");
                       
                       $('#file_upload_video').parent("label")
                               .css("width","130px")
                               //.css("height","130px")
                               .css("position","relative")
                               .css("border-radius","0px")
                               .css("border","4px solid rgba(0, 0, 0, 0.2)")
                               //.css("top","10px")
                               //.css("left","245px")
                               .css("display","inline-block");
                        */
                       
                        $( "#loadingpage" ).hide();
                        
                });
                
                function next1_event() {

                        if( $( "input[name=law][type=checkbox]" ).is(":checked") )
                        {
                                return true;
                        }
                        else
                        {
                                return false;
                        }
                        
                }
                
                function next2_event() {
                        
                        $.each( $( "#pagecontent input[type=text]" ) , function( index , value ){

                                if( $( value ).val() === "" )
                                {
                                        $( value ).parent().addClass("has-error");
                                        check = 0;
                                }
                                else
                                {
                                        $( value ).parent().removeClass("has-error");
                                }

                        });
                        
                        if( $( "input[name=law][type=checkbox]" ).is(":checked") )
                        {
                                return true;
                        }
                        else
                        {
                                return false;
                        }
                        
                }
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                }
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            $( "#pagecontent" ).hide();
                            
                };
                
                function memeber_connected_callback_init( data )
                {
                            console.log( data );
                            $( "#usericon" ).css( "background-image" , "url('" + data.usericon + "')" );
                            
                            $( "#form_email" ).val( data.facebook_mail );
                            $( "#form_email" ).attr( "disabled" , "true" );
                            
                            $( "#user_name" ).html( data.user_name );
                            $( "#form_nickname" ).val( data.nickname );
                            
                            var birthday = data.birthday.split("-");
                            $( "#born1" ).val( birthday[0] );
                            $( "#born2" ).val( birthday[1] );
                            $( "#born3" ).val( birthday[2] );
                            if( data.sex )
                                $( "input[name=form_sex][value=" + data.sex + "]" ).click();
                            //$( "input[name=sex]:checked" ).val()
                            $( "#form_address" ).val( data.residence );
                            $( "#form_phone" ).val( data.phone );
                            
                            $( "#pagecontent" ).show();
                            
                }

        </script>

</body>

</html>
