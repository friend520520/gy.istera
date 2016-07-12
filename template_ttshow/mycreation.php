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
        
        
		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                
                
                
	</head>

        <body class="no-skin" style="background-color: #DDDDDD;">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay">
                <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
        </div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: rgb(242, 242, 242); padding-bottom: 40px;">
            
            <div style="text-align: center; padding: 40px 0px;">
                    <div style="font-size: 23pt; font-weight: bold;">發表創作</div>
            </div>

            <div id="page1" style="right: 0px; left: 0px; background: white none repeat scroll 0% 0%; margin: auto; max-width: 800px; position: relative; padding: 40px;">
                    <div style="float: right;">
                            <img src="template/assets/img/x2.png" onclick="location.href='index.php'">
                    </div>
                    <div style="margin: 100px 0px 30px;">
                        <div name="illustration" style="border-radius: 100px; background-color: #154d7d; height: 170px; width: 170px;left: 0px; right: 0px; margin-right: auto; margin-left: auto;cursor: pointer;">
                                <div style="text-align: center; line-height: 50px; position: relative; color: white; font-size: 23pt; top: 64px; font-weight: 100;">
                                        插畫
                                </div>
                        </div>
                    </div>
                    <div style="margin: 20px 0px 100px;">
                        <div name="video" style="border-radius: 100px; background-color: #154d7d; height: 170px; width: 170px;left: 0px; right: 0px; margin-right: auto; margin-left: auto;cursor: pointer;">
                                <div style="text-align: center; line-height: 50px; position: relative; color: white; font-size: 23pt; top: 64px; font-weight: 100;">
                                        影片
                                </div>
                        </div>
                    </div>
            </div>

            <div id="page2" style="display: none; right: 0px; left: 0px; background: white none repeat scroll 0% 0%; margin: 40px auto auto; max-width: 800px; position: relative; padding: 40px;">

                    <!--div style="text-align: center;">
                        <img src="images/cover.png" img="" width="80%" id="illustration">
                    </div>

                    <div style="position: relative; height: 30px; margin-top: 50px; text-align: center; width: 100%;">
                        <div id="bar"></div>
                    </div>

                    <div class="" style="text-align: center; margin: 50px 0px 50px;">
                            <label style="width: 215px; font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important;" class="btn btn-success btn-next">
                                <input type="file" id="transient_file" multiple="" target="illustration" style="opacity: 0; position: absolute; z-index: -999;">選擇檔案
                            </label>
                            <button id="illustration_cancel" class="btn btn-prev" style="font-weight: bold; background-color: white ! important; border: 1px solid gray; width: 215px; color: gray ! important; padding: 10px 0px;">取消</button>
                    </div-->
                
                    
                    
                    <div style="padding: 0px 40px; font-size: 16px;">
                            
                            <ul class="ace-nav col-xs-12" style="padding: 0px 0px 20px;">
                                    <li style="display: block;height: 50px;" class="">
                                            <b data-toggle="dropdown" href="#" class="dropdown-toggle" aria-expanded="false" style="height: 50px; padding: 0px;">
                                                    <div id="header_user_icon" style="position: relative; vertical-align: middle; display: inline-block; background-image: url(&quot;http://graph.facebook.com/1097906286893244/picture&quot;); height: 50px; width: 50px;" class="bg_top"></div>
                                                    <span id="header_user_name" style="top: 0px; vertical-align: middle; color: black; font-size: 17px; margin: 0px 5px;">狗與鹿</span>
                                                    <i class="ace-icon fa fa-caret-down" style="color: black"></i>
                                            </b>
                                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                                    <li>
                                                            <a>
                                                                    <i class="ace-icon fa fa-user"></i>這群人
                                                            </a>
                                                    </li>
                                                    <li>
                                                            <a style="cursor: pointer;">
                                                                    <i class="ace-icon fa fa-power-off"></i>狗與鹿
                                                            </a>
                                                    </li>
                                            </ul>
                                    </li>
                            </ul>
                            
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                            內文圖片 & 封面縮圖<span style="margin-left: 5px; color: red;">*</span>
                                    </div>
                                    <img src="" img="" width="100%" id="illustration" style="display: none;">
                                    <label style="float: left; border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(229, 229, 229); cursor: pointer; width: 100%; border: 3px dashed gray; height: 170px; padding: 20px 0px;" class="ace-file-input ace-file-multiple">
                                            <div style="position: absolute; margin: auto; right: 0px; left: 0px; width: auto; bottom: 0px; height: 0px; top: -50%;">
                                                    <input type="file" id="transient_file" multiple="" target="illustration">
                                                    <img style="" src="template/assets/img/uplaod-01.png" alt="ttshow">
                                                    <div style="margin-bottom: 5px" class="clearfix"></div>
                                                    <span style="font-size: 13px; letter-spacing: 1px; color: black;">選擇圖片</span>
                                                    <a href="#" class="remove">
                                                            <i class=" ace-icon fa fa-times"></i>
                                                    </a>

                                                    <div style="position: absolute; height: 30px; width: 100%; top: 85px;">
                                                        <div id="bar"></div>
                                                    </div>
                                            </div>
                                    </label>
                                    <div class="clearfix"></div>
                            </div>
                            
                            <!--div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                            封面縮圖<span style="margin-left: 5px; color: red;">*</span>
                                    </div>
                                    <img src="" img="" width="100%" id="illustration" style="display: none;">
                                    <label style="float: left; border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(229, 229, 229); cursor: pointer; width: 100%; border: 3px dashed gray; height: 170px; padding: 20px 0px;" class="ace-file-input ace-file-multiple">
                                            <div style="position: absolute; margin: auto; right: 0px; left: 0px; width: auto; bottom: 0px; height: 0px; top: -50%;">
                                                    <input type="file" id="transient_file" multiple="" target="illustration">
                                                    <img style="" src="template/assets/img/uplaod-01.png" alt="ttshow">
                                                    <div style="margin-bottom: 5px" class="clearfix"></div>
                                                    <span style="font-size: 13px; letter-spacing: 1px; color: black;">選擇圖片</span>
                                                    <a href="#" class="remove">
                                                            <i class=" ace-icon fa fa-times"></i>
                                                    </a>

                                                    <div style="position: absolute; height: 30px; width: 100%; top: 85px;">
                                                        <div id="bar"></div>
                                                    </div>
                                            </div>
                                    </label>
                                    <div class="clearfix"></div>
                            </div-->
                            
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">創作類型<span style="margin-left: 5px; color: red;">*</span>

                                    </div>
                                    <select style="width: 100%;" class="county" name="county">
                                        <option value="">請選擇</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Youtube">Youtube</option>
                                    </select>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                            作品標題
                                            <span style="margin-left: 5px; color: red;">*</span>
                                    </div>
                                    <input type="text_import" id="illustration_name" style="margin: 5px 0;" placeholder="" class="form-control">
                            </div>
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                            作品簡介
                                            <span style="margin-left: 5px; color: red;">*</span>
                                            <span style="color: gray;font-size: 13px;margin-left: 10px">
                                                限50字內敘述
                                            </span>
                                    </div>
                                    <textarea type="text_import" class="form-control" placeholder="" style="margin: 5px 0px; height: 100px; resize: none;" id="illustration_des"></textarea>
                            </div>
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                        標籤
                                        <span style="margin-left: 5px; color: red;">*</span>
                                        <span style="color: gray;font-size: 13px;margin-left: 10px">
                                            最多設定5筆
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="" style="margin: 5px 0;" id="illustration_tag">
                                    <button style="font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important; float: right; width: 87px; padding: 0px; top: -37px;" class="btn btn-success btn-next" id="add_illustration_tag">增加</button>
                            </div>
                            <div style="height: 40px; margin: 10px 20px;" id="illustration_tag_modal_space"></div>
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                        想曝光的連結 
                                        <span style="color: gray; font-size: 13px; margin-left: 4px;">
                                            可填入個人臉書、粉絲團（非必填）
                                        </span>
                                    </div>
                                    <textarea type="text" id="illustration_link" style="margin: 5px 0px; height: 100px; resize: none;" placeholder="" class="form-control"></textarea>
                            </div>
                            <p style="color: red;">
                                    注意：
                            </p>
                            <p style="color: red; margin-left: 1em; text-indent: -0.8em;line-height: 23px;">
                                    1.投稿作品限本人創作，嚴禁上傳侵權內容，如因侵權衍伸法律問題投稿者自負，本站將配合主管機關處理
                            </p>
                            <p style="color: red; margin-left: 1em; text-indent: -0.8em;line-height: 23px;">
                                    2.嚴禁上傳誹謗、侮辱、具威脅攻擊性、猥褻、違反公序良俗及中華民國法律的文字、圖片及任何形式檔案，台灣達人秀有權逕自刪除
                            </p>
                            <p style="color: red; margin-left: 1em; text-indent: -0.8em;line-height: 23px;">
                                    3.上傳創作即同意本站有權宣傳、調整版面配置及顯示位置
                            </p>
                            <div class="control-group col-xs-12">
                                    <div class="radio">
                                            <label style="margin-left: -31px">
                                                    <input type="checkbox" class="ace" name="law">
                                                    <span class="lbl">
                                                            我已閱讀並同意
                                                            <a style="color:#4c8fbd;" href="terms_of_service.php" target="apple">
                                                                    服務條款
                                                            </a>
                                                   </span>
                                            </label>
                                    </div>
                            </div>
                    </div>
                    <div class="" style="text-align: center; margin: 80px 0px 50px;">
                            <button id="cancel" onclick="location.href='index.php'" class="btn btn-prev" style="font-weight: bold; background-color: white ! important; border: 1px solid gray; width: 215px; color: gray ! important; padding: 10px 0px;">
                                    取消
                            </button>

                            <button id="illustration_next" class="btn btn-success btn-next" style="width: 215px; font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important;">
                                完成
                            </button>
                    </div>

            </div>

            <div id="page3" style="display: none; max-width: 800px; right: 0px; left: 0px; margin: 40px auto auto; background: white none repeat scroll 0px 0px; padding-bottom: 100px; position: relative;">

                    <div style="font-size: 16px; padding: 35px 40px 0px;">
                            
                            <ul class="ace-nav col-xs-12" style="padding: 0px 0px 20px;">
                                    <li style="display: block;height: 50px;" class="">
                                            <b data-toggle="dropdown" href="#" class="dropdown-toggle" aria-expanded="false" style="height: 50px; padding: 0px;">
                                                    <div id="header_user_icon" style="position: relative; vertical-align: middle; display: inline-block; background-image: url(&quot;http://graph.facebook.com/1097906286893244/picture&quot;); height: 50px; width: 50px;" class="bg_top"></div>
                                                    <span id="header_user_name" style="top: 0px; vertical-align: middle; color: black; font-size: 17px; margin: 0px 5px;">狗與鹿</span>
                                                    <i class="ace-icon fa fa-caret-down" style="color: black"></i>
                                            </b>
                                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                                    <li>
                                                            <a>
                                                                    <i class="ace-icon fa fa-user"></i>這群人
                                                            </a>
                                                    </li>
                                                    <li>
                                                            <a style="cursor: pointer;">
                                                                    <i class="ace-icon fa fa-power-off"></i>狗與鹿
                                                            </a>
                                                    </li>
                                            </ul>
                                    </li>
                            </ul>
                            
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                            封面縮圖<span style="margin-left: 5px; color: red;">*</span>
                                    </div>
                                    <img src="" img="" width="100%" id="video" style="display: none;">
                                    <label style="float: left; border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(229, 229, 229); cursor: pointer; width: 100%; border: 3px dashed gray; height: 170px; padding: 20px 0px;" class="ace-file-input ace-file-multiple">
                                            <div style="position: absolute; margin: auto; right: 0px; left: 0px; width: auto; bottom: 0px; height: 0px; top: -50%;">
                                                    <input type="file" id="transient_file" multiple="" target="video">
                                                    <img style="" src="template/assets/img/uplaod-01.png" alt="ttshow">
                                                    <div style="margin-bottom: 5px" class="clearfix"></div>
                                                    <span style="font-size: 13px; letter-spacing: 1px; color: black;">選擇圖片</span>
                                                    <a href="#" class="remove">
                                                            <i class=" ace-icon fa fa-times"></i>
                                                    </a>

                                                    <div style="position: absolute; height: 30px; width: 100%; top: 85px;">
                                                        <div id="bar"></div>
                                                    </div>
                                            </div>
                                    </label>
                                    <div class="clearfix"></div>
                                    縮圖尺寸480x251px
                            </div>
                            
                            <div style="margin: 35px 0 20px;">
                                    <div style="margin-bottom: 10px">
                                            影片連結
                                            <span style="margin-left: 5px; color: red;">*</span>
                                            <span style="color: gray;font-size: 13px;margin-left: 10px">
                                                請填入facebook或youtube影片連結
                                            </span>
                                    </div>
                                    <input type="text_import" id="video_videolink" style="margin: 5px 0;" placeholder="" class="form-control">
                            </div>
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                            作品標題
                                            <span style="margin-left: 5px; color: red;">*</span>
                                    </div>
                                    <input type="text_import" id="video_name" style="margin: 5px 0;" placeholder="" class="form-control">
                            </div>
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                            作品簡介
                                            <span style="margin-left: 5px; color: red;">*</span>
                                            <span style="color: gray;font-size: 13px;margin-left: 10px">
                                                限50字內敘述
                                            </span>
                                    </div>
                                <textarea type="text_import" class="form-control" placeholder="" style="margin: 5px 0px; height: 100px; resize: none;" id="video_des"></textarea>
                            </div>
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                        標籤
                                        <span style="margin-left: 5px; color: red;">*</span>
                                        <span style="color: gray;font-size: 13px;margin-left: 10px">
                                            最多設定5筆
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="" style="margin: 5px 0;" id="video_tag">
                                    <button style="font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important; float: right; width: 87px; padding: 0px; top: -37px;" class="btn btn-success btn-next" id="add_video_tag">增加</button>
                            </div>
                            <div style="height: 40px; margin: 10px 20px;" id="video_tag_modal_space"></div>
                            <div style="margin-bottom: 20px;">
                                    <div style="margin-bottom: 10px">
                                        想曝光的連結 
                                        <span style="color: gray; font-size: 13px; margin-left: 4px;">
                                            可填入個人臉書、粉絲團（非必填）
                                        </span>
                                    </div>
                                    <textarea type="text" id="video_link" style="margin: 5px 0px; height: 100px; resize: none;" placeholder="" class="form-control"></textarea>
                            </div>
                            <p style="color: red;">
                                    注意：
                            </p>
                            <p style="color: red; margin-left: 1em; text-indent: -0.8em;line-height: 23px;">
                                    1.投稿作品限本人創作，嚴禁上傳侵權內容，如因侵權衍伸法律問題投稿者自負，本站將配合主管機關處理
                            </p>
                            <p style="color: red; margin-left: 1em; text-indent: -0.8em;line-height: 23px;">
                                    2.嚴禁上傳誹謗、侮辱、具威脅攻擊性、猥褻、違反公序良俗及中華民國法律的文字、圖片及任何形式檔案，台灣達人秀有權逕自刪除
                            </p>
                            <p style="color: red; margin-left: 1em; text-indent: -0.8em;line-height: 23px;">
                                    3.上傳創作即同意本站有權宣傳、調整版面配置及顯示位置
                            </p>
                            <div class="control-group col-xs-12">
                                    <div class="radio">
                                            <label style="margin-left: -31px">
                                                    <input type="checkbox" class="ace" name="law">
                                                    <span class="lbl">
                                                            我已閱讀並同意
                                                            <a style="color:#4c8fbd;" href="terms_of_service.php" target="apple">
                                                                    服務條款
                                                            </a>
                                                   </span>
                                            </label>
                                    </div>
                            </div>
                    </div>
                    <div class="" style="text-align: center; margin: 80px 0px 50px;">
                            <button id="cancel" onclick="location.href='index.php'" class="btn btn-prev" style="font-weight: bold; background-color: white ! important; border: 1px solid gray; width: 215px; color: gray ! important; padding: 10px 0px;">
                                    取消
                            </button>

                            <button id="video_next" class="btn btn-success btn-next" style="width: 215px; font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important;">
                                完成
                            </button>
                    </div>

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
        
        
        <script type="text/javascript">

                
                $("document").ready(function() {
                        $.upload_file = {};
                        $.upload_file.beforeunload = {};
			
                       
                        $( "#loadingpage" ).hide();
                        
                        $( "#illustration_cancel" ).click( function(){
                            
                                $.each( $.upload_file.beforeunload , function(index, value) {
                                        delete_transient_file( value );
                                });
                            
                        });
                        
                        $(window).on('beforeunload', function(){
                                $.each( $.upload_file.beforeunload , function(index, value) {
                                        delete_transient_file( value );
                                });
                        });
                        $(window).unload( function(){
                                $.each( $.upload_file.beforeunload , function(index, value) {
                                        delete_transient_file( value );
                                });
                        });
                        
                });
                
                var delete_transient_file = function( filename ) {
                        
                        $.ajax({
                                    type: "POST",
                                    url: "php/signup.php",
                                    data: {
                                        cmd            : "transient_file" ,
                                        transient_file : filename ,
                                    },
                                    success: function( data ) { 
                                        
                                        console.log( data );
                                        if( data === "true" )
                                        {
                                            console.log( data );
                                            $( "#illustration" ).attr( "src" , "images/cover.png" ).attr( "img" , "" );
                                            $.upload_file = {};
                                            $.upload_file.beforeunload = {};
                                        }
                                    } ,
                                    error: function( data ) { console.log( data ); }
                        });
                
                }
                
                $( "#illustration_next" ).click( function(){
                    
                        var check = 1;
                        if( $( "#illustration" ).attr("img") )
                        {
                                $.each( $( "#page2" ).find( "input[type=text_import]" ) , function( index , value ){
                                    
                                        if( $( value ).val() === "" )
                                        {
                                                check = 0;
                                                $( value ).parent().addClass( "has-error" );
                                        }
                                        else
                                        {
                                                $( value ).parent().removeClass( "has-error" );
                                        }
                                    
                                });
                                
                                if( !$("#page2 input[name=law]").is(":checked") )
                                {
                                        check = 0;
                                        alert( "請閱讀服務條款" );
                                }
                                
                                if( check )
                                {
                                        var tag_space = $("#illustration_tag_modal_space").children();
                                        var tag = [];
                                        for(var i=0; i< tag_space.length ; i ++ ) {
                                            tag[i] = tag_space.eq(i).find("[id=tag_name]").html();
                                        }
                                        tag = JSON.stringify( tag );
                                        var data = {
                                            user_id : $.member.user_id ,
                                            icon : $.upload_file.transient_file,
                                            content : $("#illustration_des").val() ,
                                            tag : tag ,
                                            title : $("#illustration_name").val() ,
                                            link : $("#illustration_link").val() ,
                                            con_type : "illustration"
                                        };
                                        console.log( data );
                                        
                                        $( "#loadingpage" ).show();
                                        
                                        $.ajax({
                                                type : "POST",
                                                url : "php/contribute.php" ,
                                                async: true ,
                                                data : data ,

                                                success : function(data) { 
                                                        
                                                        $("#loadingpage").css("display","none");
                                                        if( data === "true" )
                                                            location.href = "mycreation_3.php";
                                                        else
                                                            alert( "投稿失敗" );
                                                        
                                                } ,
                                                error : function(data) { console.log(data); }
                                        });
                                        $(window).scrollTop( 0 );
                                        
                                }

                        }
                        else
                            alert( "please upload image" );
                    
                });
                
                $( "#video_next" ).click( function(){
                    
                        var check = 1;
                        
                        $.each( $( "#page3" ).find( "input[type=text_import]" ) , function( index , value ){

                                if( $( value ).val() === "" )
                                {
                                        check = 0;
                                        $( value ).parent().addClass( "has-error" );
                                }
                                else
                                {
                                        $( value ).parent().removeClass( "has-error" );
                                }

                        });

                        if( !$("#page3 input[name=law]").is(":checked") )
                        {
                                check = 0;
                                alert( "請閱讀服務條款" );
                        }

                        if( check )
                        {
                                var video_html = $("#video_videolink").val();
                                if( video_html.search("https://www.youtube.com/watch") !== -1 )
                                {
                                    var v = video_html.split("?v=")[1];
                                    video_html = '<div style="" class="youtobe_video">' +
                                                    '<div name="u2_player" class="col-md-12 col-xs-12 col-lg-12 col-md-12" style="text-align: center; margin-right: auto; margin-left: auto; position: relative; float: none">' +
                                                        '<iframe src="//www.youtube.com/embed/' + v + '" mmtype="[\'youtube\']" key="video" mmid="1" style="border: none; margin-left: auto; margin-right: auto; height: 100%; width:100%;"></iframe>' +
                                                    '</div>' +
                                                '</div>';
                                    var icon = "https://i.ytimg.com/vi/" + v + "/default.jpg";
                                }
                                else if( video_html.search("https://youtu.be/") !== -1 )
                                {
                                    var v = video_html.split("https://youtu.be/")[1];
                                    video_html = '<div style="" class="youtobe_video">' +
                                                    '<div name="u2_player" class="col-md-12 col-xs-12 col-lg-12 col-md-12" style="text-align: center; margin-right: auto; margin-left: auto; position: relative; float: none">' +
                                                        '<iframe src="//www.youtube.com/embed/' + v + '" mmtype="[\'youtube\']" key="video" mmid="1" style="border: none; margin-left: auto; margin-right: auto; height: 100%; width:100%;"></iframe>' +
                                                    '</div>' +
                                                '</div>';
                                    var icon = "https://i.ytimg.com/vi/" + v + "/default.jpg";
                                }
                                else if( video_html.search("https://www.youtube.com/embed/") !== -1 )
                                {
                                    var v = video_html.split("https://www.youtube.com/embed/")[1].split("\"")[0];
                                    video_html = '<div style="" class="youtobe_video">' +
                                                    '<div name="u2_player" class="col-md-12 col-xs-12 col-lg-12 col-md-12" style="text-align: center; margin-right: auto; margin-left: auto; position: relative; float: none">' +
                                                        '<iframe src="//www.youtube.com/embed/' + v + '" mmtype="[\'youtube\']" key="video" mmid="1" style="border: none; margin-left: auto; margin-right: auto; height: 100%; width:100%;"></iframe>' +
                                                    '</div>' +
                                                '</div>';
                                    var icon = "https://i.ytimg.com/vi/" + v + "/default.jpg";
                                }
                                else if( video_html.search("fb-video") !== -1 )
                                {
                                    video_html = video_html.split("/script>")[1];
                                    var icon = "";
                                }
                                
                                console.log( video_html );
                                
                                var tag_space = $("#video_tag_modal_space").children();
                                var tag = [];
                                for(var i=0; i< tag_space.length ; i ++ ) {
                                    tag[i] = tag_space.eq(i).find("[id=tag_name]").html();
                                }
                                tag = JSON.stringify( tag );
                                var data = {
                                    user_id : $.member.user_id ,
                                    icon : icon ,
                                    content : $("#video_des").val() ,
                                    html : video_html ,
                                    tag : tag ,
                                    title : $("#video_name").val() ,
                                    link : $("#video_link").val() ,
                                    con_type : "video"
                                };
                                console.log( data );

                                $( "#loadingpage" ).show();

                                $.ajax({
                                        type : "POST",
                                        url : "php/contribute.php" ,
                                        async: true ,
                                        data : data ,

                                        success : function(data) {
                                                
                                                console.log( data );
                                                $("#loadingpage").css("display","none");
                                                if( data === "true" )
                                                    location.href = "mycreation_3.php";
                                                else
                                                    alert( "投稿失敗" );
                                        } ,
                                        error : function(data) { console.log(data); }
                                });
                                $(window).scrollTop( 0 );

                        }

                    
                });
                
                $( "#page1 [name=illustration]" ).click( function(){
                    
                        $( "#page1" ).hide();
                        $( "#page2" ).show();
                    
                });
                
                $( "#page1 [name=video]" ).click( function(){
                    
                        $( "#page1" ).hide();
                        $( "#page3" ).show();
                    
                });
                
                $("#add_illustration_tag").unbind('click').bind( 'click' , function() {
                        var html_input = '<div style="display: block; margin-bottom: 5px; margin-right: 10px; float: left; height: 25px; background: rgb(221, 221, 221) none repeat scroll 0% 0%; line-height: 25px; font-size: 11pt; padding: 0px 7px; border-radius: 5px;">' +
                                                '<div style="background: rgb(204, 204, 204) none repeat scroll 0% 0%; border-radius: 6px;">' +
                                                    '<div style="float: left; margin-right: 10px; border-radius: 100%; border: 1px solid black; text-align: center; width: 17px; height: 17px; line-height: 17px; font-size: 9pt; margin-top: 4px;" id="delete">X</div>' +
                                                    '<div style="float: left;" id="tag_name">' + $("#illustration_tag").val() + '</div>' +
                                                '</div>' +
                                            '</div>';
                        $("#illustration_tag_modal_space").append(html_input);
                        $("#illustration_tag_modal_space").find("[id=delete]").unbind('click').bind( "click" , function(e) {
                                $(e.target).parent().parent().remove();
                        });
                });
                
                $("#add_video_tag").unbind('click').bind( 'click' , function() {
                        var html_input = '<div style="display: block; margin-bottom: 5px; margin-right: 10px; float: left; height: 25px; background: rgb(221, 221, 221) none repeat scroll 0% 0%; line-height: 25px; font-size: 11pt; padding: 0px 7px; border-radius: 5px;">' +
                                                '<div style="background: rgb(204, 204, 204) none repeat scroll 0% 0%; border-radius: 6px;">' +
                                                    '<div style="float: left; margin-right: 10px; border-radius: 100%; border: 1px solid black; text-align: center; width: 17px; height: 17px; line-height: 17px; font-size: 9pt; margin-top: 4px;" id="delete">X</div>' +
                                                    '<div style="float: left;" id="tag_name">' + $("#video_tag").val() + '</div>' +
                                                '</div>' +
                                            '</div>';
                        $("#video_tag_modal_space").append(html_input);
                        $("#video_tag_modal_space").find("[id=delete]").unbind('click').bind( "click" , function(e) {
                                $(e.target).parent().parent().remove();
                        });
                });
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            
                            $( "[id=header_user_icon]" ).css( "background-image" , "url('" + $.member.usericon + "')" );
                            $( "[id=header_user_name]" ).html( $.member.user_name );
                            
                            $.ajax({
                                type    : "GET",
                                url     : "php/check_channel.php" ,
                                data    : {
                                  "user" : $.member.email ,
                                },
                                success: function(data) {

                                        if( data === "have" )
                                            location.href = "editor.php";
                                }
                            });
                };
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            
                            $("#upload_img_place").hide();
                            Login_Popup_show();
                };

                function unlogin_jump()
                {
                            location.href = "index.php";
                }

        </script>

        <script src="js/fb-login.js"></script>
        <script src="js/view_upload_img_subscribe.js"></script>
        
</body>

</html>
