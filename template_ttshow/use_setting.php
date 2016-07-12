<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>ttshow-使用設定</title>
        
        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->
        <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

        
        <script src="template/assets/js/jquery.js"></script>
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        <script src="template/assets/js/ace-extra.js"></script>

		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
               
	</head>

        <body class="no-skin" style="overflow-x: hidden;">
        <div id="loadingpage" class="widget-box-overlay" style="width: 100%; height: 100%;">
                <div style="position: fixed; margin: auto; right: 0px; left: 0px; bottom: 0px; top: -30px; height: 0px;">
                        <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
                </div>
        </div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
        
                <?php include("sidebar.php"); ?>

                <div class="main-content" style="background-color: rgb(242, 242, 242); margin-left: 190px;">
                  <!-- #section:basics/content.breadcrumbs -->
                        <div class="page-content"> 
                            <div class="page-content" id="pagecontent" style="display: none;">
                                <div class="breadcrumbs col-xs-12 col-sm-12 col-md-12 col-lg-12" id="breadcrumbs" style="background: none repeat scroll 0% 0% white; margin: 20px; width: 97%;">
                                    <script type="text/javascript">
                                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                                    </script>

                                    <ul class="breadcrumb">
                                        <li>
                                            <i class="ace-icon fa fa-home home-icon"></i>
                                            <a href="#">首頁</a>
                                        </li>
                                        <li class="active">個人設定</li>
                                        <li class="active">基本資料</li>
                                    </ul>
                                </div>
                                <!--AL 0506 edit sample code-->
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 21px; margin-bottom: 30px;">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: none repeat scroll 0% 0% white; border-bottom: 1px solid rgb(229, 229, 229); padding: 23px 40px;">
                                        <!-- TAB BEGINS -->
                                                <div class="tabbable">
                                                        <ul class="nav nav-tabs" id="Tab" style="">
                                                              <li class="active" style="text-align: center; padding: 0px; width: 155px; font-size: 17px;">
                                                                    <a aria-expanded="true" data-toggle="tab" href="#1" style="border-left: 0px none; border-right: 0px none; border-top: 0px none; padding: 15px;">使用設定</a>
                                                              </li>
                                                        </ul>

                                                    <!-- CONTENT BEGINS -->
                                                        <div class="tab-content col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: 0px none; padding-left: 7px; margin-top: 20px;">
                                                                <form class="form-horizontal" role="form">
                                                                        <div class="form-group" style="margin-bottom: 40px;">
                                                                                <label class="col-xs-12 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 16px; font-weight: bold; margin-bottom: 15px;">隱私設定</label>
                                                                                <div class="col-xs-12" style="margin-bottom: 15px;">
                                                                                    <input type="checkbox" name="agreemsg" >
                                                                                    <span style="margin-left: 4px; font-size: 15px;" class="lbl">允許使用者發訊息給我</span>
                                                                                </div>
                                                                                <div class="col-xs-12" style="margin-bottom: 15px;">
                                                                                    <input type="checkbox" disabled="">
                                                                                    <span style="margin-left: 4px; font-size: 15px;" class="lbl">瀏覽紀錄保持時間</span>
                                                                                    <select id="history_keep" type="">
                                                                                            <option value="0">手動清除</option>
                                                                                            <option value="3">三天</option>
                                                                                            <option value="7">一週</option>
                                                                                            <option value="14">二週</option>
                                                                                            <option value="30">一月</option>
                                                                                    </select>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form-group" style="margin-bottom: 40px;">
                                                                                <label class="col-xs-12 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 16px; font-weight: bold; margin-bottom: 15px;">電子郵件通知</label>
                                                                                <div class="col-xs-12" style="margin-bottom: 15px;">
                                                                                    <input type="checkbox" name="subscribe_newsletter">
                                                                                    <span style="margin-left: 4px; font-size: 15px;" class="lbl">訂閱台灣台人秀電子報</span>
                                                                                </div>
                                                                                <div class="col-xs-12" style="margin-bottom: 15px;">
                                                                                    <input type="checkbox" name="mail_notice">
                                                                                    <span style="margin-left: 4px; font-size: 15px;" class="lbl">當我收到站內訊息時，發電子郵件通知我。</span>
                                                                                </div>
                                                                        </div>
                                                                </form>

                                                                <div class="col-xs-12" style="padding: 0px;">
                                                                        <button id="cancel" style="border-radius: 3px; margin-right: 20px; background: none repeat scroll 0% 0% white ! important; border: 1px solid rgb(213, 213, 213); padding: 6px 30px;" class="btn btn-sm  btn-light panel-float-left" type="button">取消</button>
                                                                        <button id="apply_account_sensible" type="button" class="btn btn-sm  btn-primary panel-float-left" style="border-radius: 3px; padding: 2px 30px; background: none repeat scroll 0% 0% rgb(19, 74, 121) ! important; border-color: rgb(19, 74, 121) ! important;">儲存變更</button>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        </div>
        </div>
        
        <?php include( "footer.php"); ?>


        <!-- /.main-container -->

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
        
        <script src="js/jquery.twzipcode.min.js"></script>
        <script src="js/view_upload_img.js"></script>
        <script src="js/fb-login.js"></script>
        
        <style>
                .zipcode { display: none; }
                .county { margin-right: 10px; }
                .district { margin-right: 10px; }
        </style>
        
        <script type="text/javascript">
                
                $("document").ready(function() {
                        
                        $( "#apply_account_sensible" ).unbind( "click" ).bind( "click" , function(){
                                
                                var agreemsg = $( "input[name=agreemsg]" ).is( ":checked" ) ? "1" : "0";
                                var subscribe_newsletter = $( "input[name=subscribe_newsletter]" ).is( ":checked" ) ? "1" : "0";
                                var mail_notice = $( "input[name=mail_notice]" ).is( ":checked" ) ? "1" : "0";
                                
                                var data = { agreemsg : agreemsg ,
                                            subscribe_newsletter : subscribe_newsletter ,
                                            mail_notice : mail_notice ,
                                            history_keep : $( "#history_keep" ).val() ,
                                            email : $.member.email };
                                var callback = function( data ) {
                                    
                                    console.log( data );
                                    if( data === "true" )
                                        alert( "儲存成功" );
                                    else if( data === "false" )
                                        alert( "儲存失敗" );
                                    
                                }
                                var error_back = function( data ) {
                                    console.log( data );
                                }
                                $.Ajax("POST", "php/member.php?func=setinfo2", data, "", callback, error_back);
                                
                        });
                        
                });
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            select_user_data( response );


                            $( "#sidebar" ).show();
                            $( "#pagecontent" ).show();
                            $( "#loadingpage" ).hide();
                }
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            
                            
                            $( "#sidebar" ).show();
                            $( "#pagecontent" ).show();
                            $( "#loadingpage" ).hide();
                            
                };
                
                function select_user_data( data ) {
                        
                        console.log( data );
                        if( $( "input[name=agreemsg]" ).is( ":checked" ) != JSON.parse( data.agreemsg ) )
                            $( "input[name=agreemsg]" ).click();
                        
                        $( "#history_keep" ).val( data.history_keep );
                        
                        if( $( "input[name=subscribe_newsletter]" ).is( ":checked" ) != JSON.parse( data.subscribe_newsletter ) )
                            $( "input[name=subscribe_newsletter]" ).click();
                        if( $( "input[name=mail_notice]" ).is( ":checked" ) != JSON.parse( data.mail_notice ) )
                            $( "input[name=mail_notice]" ).click();
                        
                        $( "#pagecontent" ).show();
                        $( "#loadingpage" ).hide();
                        
                }
        </script>
        
        
</body>

</html>
