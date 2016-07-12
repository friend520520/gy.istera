<!DOCTYPE html>
<html lang="en">
    <head>
        
        <script src="js/google_analytics.js"></script>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>ttshow-分類管理</title>
        <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">
        
        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
        <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
        <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="template/assets/css/nestable.css"/>
        
        <script src="template/assets/js/jquery.js"></script>
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        <script src="template/assets/js/ace-extra.js"></script>
        <script src="js/jquery.nestable.js"></script>

        
        <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
        
    </head>
	<body class="no-skin" >
            <div id="loadingpage" class="widget-box-overlay">
                <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
            </div>
            
            <?php include( "header_1.php"); ?>
            
            <div class="main-container" id="main-container" style="background-color: white;">

                    <?php include("sidebar.php"); ?>

                    <div class="main-content" style="margin-left: 190px;">
                            <div class="main-content-inner">
                                    <div class="page-content">
                                        <!--AL 0415 edit--> 
                                        <div class="page-content" id="pagecontent">

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <!-- 頻道資料 -->
                                                <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
                                                    <div style="background: none repeat scroll 0% 0% white; margin: 20px; width: 97%;" id="breadcrumbs" class="breadcrumbs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <script type="text/javascript">
                                                                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                                                        </script>

                                                        <ul class="breadcrumb">
                                                            <li>
                                                                <i class="ace-icon fa fa-home home-icon"></i>
                                                                <a href="#">首頁</a>
                                                            </li>
                                                            <li class="active">分類管理</li>
                                                        </ul>
                                                    </div>
                                                    <div style="padding-left: 10px;" class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                    <button id="category_add" style="border-radius: 3px;" type="button" class="btn btn-sm  btn-primary panel-float-left">
                                                                                <i class="fa fa-plus fa-lg"></i>
                                                                    </button>
                                                            </div>

                                                            <div class="col-xs-6" style="margin-top: 15px">

                                                                    <div class="dd" id="channel_list" style="width:100%;">
                                                                        <ol class="dd-list">

                                                                        </ol>
                                                                    </div>
                                                                    
                                                                    <button class="btn btn-sm  btn-primary panel-float-right" type="button" style="border-radius: 3px; right: 15px;" id="category_save_order">
                                                                                儲存排序
                                                                    </button>
                                                                    
                                                            </div>
                                                            <div class="col-xs-6" style="margin-top: 15px">
                                                                    
                                                                <form class="form-horizontal" id="form_info" style="display:none;">
                                                                    
                                                                    <div class="form-group">
                                                                            <label style="text-align: left; font-size: 15px;" for="form-field-1-1" class="col-xs-12 control-label no-padding-right">名稱</label>
                                                                            <div class="col-xs-12">
                                                                                    <input type="text" class="form-control" placeholder="" id="form_name">
                                                                            </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-xs-12">
                                                                            <input id="form_display" type="checkbox">
                                                                            顯示
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                            <label style="text-align: left; font-size: 15px;" for="form-field-1-1" class="col-xs-12 control-label no-padding-right">顏色</label>
                                                                            <div class="col-xs-12">
                                                                                    <input type="text" class="form-control" placeholder="" id="form_color">
                                                                            </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                            <label style="text-align: left; font-size: 15px;" for="form-field-1-1" class="col-xs-12 control-label no-padding-right">Slogon</label>
                                                                            <div class="col-xs-12">
                                                                                    <input type="text" class="form-control" placeholder="" id="form_slogon">
                                                                            </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                            <label style="text-align: left; font-size: 15px;" for="form-field-1-1" class="col-xs-12 control-label no-padding-right">置頂頁面</label>
                                                                            <div class="col-xs-2" style="padding-right:0px;">
                                                                                    <input type="text" class="form-control" placeholder="" id="form_page">
                                                                            </div>
                                                                            <div class="col-xs-2" style="padding:0px;">
                                                                                    <input type="text" class="form-control" placeholder="" id="form_page">
                                                                            </div>
                                                                            <div class="col-xs-2" style="padding:0px;">
                                                                                    <input type="text" class="form-control" placeholder="" id="form_page">
                                                                            </div>
                                                                            <div class="col-xs-2" style="padding:0px;">
                                                                                    <input type="text" class="form-control" placeholder="" id="form_page">
                                                                            </div>
                                                                            <div class="col-xs-2" style="padding:0px;">
                                                                                    <input type="text" class="form-control" placeholder="" id="form_page">
                                                                            </div>
                                                                    </div>
                                                                    
                                                                    <button class="btn btn-sm  btn-primary panel-float-right" type="button" style="border-radius: 3px;" id="category_del">
                                                                                刪除
                                                                    </button>
                                                                    <button class="btn btn-sm  btn-primary panel-float-right" type="button" style="border-radius: 3px; right: 15px;" id="category_save">
                                                                                儲存
                                                                    </button>
                                                                    
                                                                </form>
                                                                    
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-lg-1"></div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
            </div>
            
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
                        </i>
            </a>

        <div style="display: none;" class="modal fade" id="myModalDeleteCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div style="height: 986px;" class="modal-backdrop fade in"></div>
                <div class="modal-dialog">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                                        <h3 class="modal-title" id="myModalLabel">刪除分類</h3>
                                </div>

                                <div class="modal-body">
                                        <div style="font-size: 15pt">是否刪除分類：</div>
                                        <div style="margin-left: 40px; height: 50px; margin-top: 20px;">
                                            <div id="myModalDeleteCategory_Name" style="font-size: 20pt; float: left; margin: 15px 10px 10px 20px;"></div>
                                        </div>
                                        <h1 style="color:red;">請注意刪除就無法還原</h1>
                                        
                                        <div style="font-size: 15pt">所屬文章轉移至分類：</div>
                                        <select style="width: 30%;" id="transfer_category" type="year">
                                        </select>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalDeleteCategory_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
                                    <button style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">取 消</button>
                                </div>
                        </div>
                </div>
        </div>
    
        <!-- Edit Channel-->
        <div style="display: none;" class="modal fade" id="myModalEditChannel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 350px;">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                                        <div id="myModalEditChannel_title">
                                            <h3 state="add" class="modal-title">新增分類</h3>
                                            <h3 state="modify" class="modal-title">修改分類</h3>
                                        </div>
                                </div>

                                <div class="modal-body">
                                    
                                        <!--div class="widget-main">
                                            <div class="form-group">
                                                    <div class="col-xs-12">
                                                            <label class="ace-file-input ace-file-multiple">
                                                                <input id="myModalEditChannel_uploadIcon" type="file">
                                                                <span class="ace-file-container" data-title="Drop files here or click to choose">
                                                                    <span id="CheckChannel_drop_img_o" data-title="No File ..." class="ace-file-name">
                                                                        <i class=" ace-icon ace-icon fa fa-cloud-upload"></i>
                                                                    </span>
                                                                    <div style="height: 150px; display: none;">
                                                                        <img id="CheckChannel_drop_img_c" style="display: block; text-align: center; position: absolute; margin: auto; left: 0px; right: 0px; width: 150px;" src="">
                                                                    </div>
                                                                </span>
                                                                <a href="#" class="remove">
                                                                    <i class=" ace-icon fa fa-times"></i>
                                                                </a>
                                                            </label>
                                                    </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div-->
                                    
                                        <form role="form" class="form-horizontal">
                                                    <div style="margin: 0" class="form-group">
                                                                <label style="font-size: 12pt; font-weight: normal; float: left; text-align: left;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">
                                                                    <span style="float: left; margin-top: 3px;">分類名稱 ： </span>
                                                                    <input data-input="title" style="width: auto; float: left;" class="form-control" type="text">
                                                                </label>
                                                        
                                                                <!--label style="font-size: 12pt; font-weight: normal; float: left; text-align: left;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">
                                                                    <span style="float: left; margin-top: 3px;">頻道主編 ： </span>
                                                                        <select data-select="user">
                                                                            <optgroup label="主編">
                                                                            </optgroup>
                                                                        </select>
                                                                </label-->
                                                        
                                                                <!--label style="font-size: 12pt; font-weight: normal; float: left; text-align: left;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">
                                                                    <input type="checkbox" name="display" style="float: left; margin-right: 5px; margin-top: 2px;">
                                                                    <div>是否顯示</div>
                                                                </label-->
                                                    </div>
                                        </form>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalEditChannel_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
                                    <button style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">取 消</button>
                                </div>
                        </div>
                </div>
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

        <script type="text/javascript">
                ace.vars['base'] = '..';
        </script>
        
        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>
        
        
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
                
                function FB_connected_callback_init( response )
                {
                            $( "#main-container" ).show();
                };
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            $( "#main-container" ).hide();
                            Login_Popup_show();
                            
                };
                
                function unlogin_jump()
                {
                            location.href = "index.php";
                }
                
        </script>
        
        <script src="js/fb-login.js"></script>
        
        <script type="text/javascript">
        $("document").ready(function() {
                $( "#loadingpage" ).hide();
                $( "#nestable3" ).nestable();
                show_list();
                
        });
        
        function show_list() {
            
                $( "#channel_list ol" ).html("");
                $.ajax({
                            type: "POST",
                            url: "php/category.php?func=detail_list",
                            data: {
                            },
                            //dataType: "json",
                            success: function( data ) {
                                    
                                    if( data !== "false" )
                                    {
                                        data = JSON.parse( data );
                                        console.log( data );
                                        var tmp = "";
                                        var sel_html = "";
                                        $.each( data , function( index , value ){
                                            
                                            var bk_color = ( value.display === "true" ) ? "white" : "#ddd";
                                            var bk_image = ( value.display === "true" ) ? "none" : "none";
                                            tmp = '<li class="dd-item dd3-item" data-id="' + value.id + '">' +
                                                        '<div class="dd-handle dd3-handle" style="background-color:' + bk_color + '; background-image:' + bk_image + ';"></div><div class="dd3-content">' + value.name + '</div>' +
                                                    '</li>';
                                            $( "#channel_list .dd-list" ).append( tmp );
                                            $( "#channel_list .dd-list .dd3-content:last" ).data( "data" , value );
                                            
                                            if( index !== 0 )
                                                sel_html += '<option value="' + value.id + '">' + value.name + '</option>';
                                            
                                        });
                                        
                                        $( "#transfer_category" ).html( sel_html );
                                        
                                        $( "#channel_list" ).nestable();
                                        $( "#channel_list .dd-list .dd3-content" ).unbind( "click" ).bind( "click" , function(){

                                                var data = $( this ).data("data");
                                                $( "#form_info" ).attr( "info_id" , data.id ).show();
                                                $( "#form_name" ).val( data.name );
                                                if( $( "#form_display" ).is( ":checked" ) !== JSON.parse( data.display ) )
                                                    $( "#form_display" ).click();
                                                $( "#form_color" ).val( data.color );
                                                $( "#form_slogon" ).val( data.slogon );
                                                
                                                console.log( data.page );
                                                
                                                $( "[id=form_page]" ).val( "" );
                                                
                                                $.each( data.page , function( index , value ){

                                                    $( "[id=form_page]" ).eq( index ).val( value );

                                                });

                                        });
                                        
                                    }
                            }
                });
        }
        
        $( "#form_display" ).unbind( "change" ).bind( "change" , function(){

                var info_id = $( "#form_info" ).attr( "info_id" );
                var bk_color = $( this ).is( ":checked" ) ? "white" : "#ddd";
                var bk_image = $( this ).is( ":checked" ) ? "none" : "none";
                $( "#channel_list [data-id=" + info_id + "] .dd3-handle" ).css( "background-color" , bk_color ).css( "background-image" , bk_image );

        });
        $( "#category_add" ).unbind( "click" ).bind( "click" , function(){
                
                var callback = function( data ) {
                        console.log(data);
                        if( data !== "false" ) {
                            
                                show_list();
                                
                        } else {
                            alert( "fail" );
                        }
                };
                
                var data = { func : "add" ,
                            name : "新增" };
                
                $.Ajax( "POST" , "php/category.php" , data , {} , callback , "" );
                
        });
        $( "#category_save_order" ).unbind( "click" ).bind( "click" , function(){

                var callback = function( data ) {
                        if( data !== "false" ) {
                            
                                console.log(data);
                                alert( "儲存成功" );
                                
                        } else {
                            alert( "fail" );
                            console.log(data);
                        }
                };
                
                var data = { func : "save_order" ,
                            order : $( "#channel_list" ).nestable('serialize') };
                
                $.Ajax( "POST" , "php/category.php" , data , {} , callback , "" );

        });
        $( "#category_save" ).unbind( "click" ).bind( "click" , function(){

                var info_id = $( "#form_info" ).attr( "info_id" );
                var callback = function( data ) {
                        if( data !== "false" ) {
                                //var data = JSON.parse(data);
                                alert( "儲存成功" );
                                
                        } else {
                            alert( "fail" );
                            console.log(data);
                        }
                };
                var display = $( "#form_display" ).is( ":checked" ) ? "true" : "false";
                var page = [];
                $.each( $( "[id=form_page]" ) , function( index , value ){
                    
                    if( $( value ).val() !== "" )
                        page[page.length] = $( value ).val();
                    
                });
                
                var data = { func : "save" ,
                            cate_id : info_id ,
                            name : $( "#form_name" ).val() , 
                            display : display , 
                            color : $( "#form_color" ).val() , 
                            slogon : $( "#form_slogon" ).val() ,
                            page : page };
                
                $.Ajax( "POST" , "php/category.php" , data , {} , callback , "" );
                
        });
        $( "#category_del" ).unbind( "click" ).bind( "click" , function(){

                var info_id = $( "#form_info" ).attr( "info_id" );

                $( "#myModalDeleteCategory_Name" ).html( $( "#form_name" ).val() );
                
                $( "#transfer_category" ).children().show();
                $( "#transfer_category" ).children( "[value=" + info_id + "]" ).hide();
                $( "#myModalDeleteCategory" ).modal( "show" );

        });

        $( "#myModalDeleteCategory_Yes" ).unbind( "click" ).bind( "click" , function(){

                var info_id = $( "#form_info" ).attr( "info_id" );
                var callback = function( data ) {
                        if( data !== "false" ) {
                                //var data = JSON.parse(data);
                                $( "#form_info" ).removeAttr( "info_id" ).hide();
                                $( "#channel_list [data-id=" + info_id + "]" ).remove();
                                $( "#transfer_category [value=" + info_id + "]" ).remove();
                                
                        } else {
                                alert( "fail" );
                                console.log(data);
                        }
                };
                $.Ajax( "POST" , "php/category.php" , { func : "delete" , cate_id : info_id , transfer : $( "#transfer_category" ).val() } , {} , callback , "" );

        });
        
        /*$('#myModalDeleteCategory')
        .on('show.bs.modal', function (e) {
        })
        .on('hidden.bs.modal', function (e) {
                $("#myModalDeleteCategory").attr("cate_id" , "");
        });*/
                
                
        </script>
        
    </body>

</html>
