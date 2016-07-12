<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-特殊標籤管理</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">

        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->

        <!-- ace styles 4/16 AL 更換CSS路徑-->
        <!--link rel="stylesheet" href="assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" /-->
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

            <?php include( "sidebar.php"); ?>
        <!-- /section:basics/sidebar -->
        <div class="main-content" style="margin-left: 190px;">
        <div class="main-content-inner" >
                <div class="page-content">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div style="background: none repeat scroll 0% 0% white; margin: 20px; width: 97%;" id="breadcrumbs" class="breadcrumbs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <script type="text/javascript">
                                                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                                            </script>

                                            <ul class="breadcrumb">
                                                <li>
                                                    <i class="ace-icon fa fa-home home-icon"></i>
                                                    <a href="#">首頁</a>
                                                </li>
                                                <li class="active">特殊標籤管理</li>
                                            </ul>
                                        </div>
                                        <button id="special_add" style="border-radius: 3px; margin-top: 4px; margin-bottom: 5px; margin-left: 20px;" type="button" class="btn btn-sm  btn-primary panel-float-left" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-plus fa-lg">
                                            </i>
                                        </button>
                                      </div>
                                    </div>    
                                    <div class="clearfix"></div>
                                    
                                    <div id="special_list" style="margin-left:10px" class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                    </div>

                                    <div id="special_model_example" style="display: none; padding: 0px; float: left; margin: 10px 0px 10px 20px;" class="panel panel-default ">
                                      <div class="panel-body">
                                        <div class="clearfix">
                                        </div>
                                        <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;" class="col-xs-12">
                                          <img id="special_img" style="margin: auto; left: 0px; right: 0px; position: absolute; height: 50px; width: 50px;" src="template/assets/images/icon-question.png">
                                        </div>
                                        <div style="height: 15px; color: black; letter-spacing: 1px; margin-bottom: 8px; text-align: center; margin-top: 5px; font-size: 13pt;" id="special_name" class="col-xs-12">
                                          熱門
                                        </div>

                                        <div>
                                          <button id="special_modify" style="margin: 10px 10px 0px 5px;" class="btn btn-white btn-success" type="button">
                                            編輯
                                          </button>
                                          <button id="special_delete" type="button" class="btn btn-white btn-success" style="margin: 10px 5px 0px 10px;" id="page_delete">
                                            刪除
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  

        <!--a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
    </i>
        </a-->
    </div>

        <!-- /.main-container -->
    
    
        <!-- Delete Special-->
        <div style="display: none;" class="modal fade" id="myModalDeleteSpecial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div style="height: 986px;" class="modal-backdrop fade in"></div>
                <div class="modal-dialog">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                                        <h3 class="modal-title" id="myModalLabel">刪除文章</h3>
                                </div>

                                <div class="modal-body">
                                        <div style="font-size: 15pt">是否刪除特殊標籤：</div>
                                        <div style="margin-left: 40px; height: 50px; margin-top: 20px;">
                                            <img id="myModalDeleteSpecial_Img" src="" style="float: left; width: 50px; height: 50px;">
                                            <div id="myModalDeleteSpecial_Name" style="font-size: 20pt; float: left; margin: 15px 10px 10px 20px;">test</div>
                                        </div>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalDeleteSpecial_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
                                    <button style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">取 消</button>
                                </div>
                        </div>
                </div>
        </div>
    
        <!-- Edit Special-->
        <div style="display: none;" class="modal fade" id="myModalEditSpecial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 350px;">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                                        <div id="myModalEditSpecial_title">
                                            <h3 state="add" class="modal-title">新增特殊標籤</h3>
                                            <h3 state="modify" class="modal-title">修改特殊標籤</h3>
                                        </div>
                                </div>

                                <div class="modal-body">
                                    
                                        <div class="widget-main">
                                            <div class="form-group">
                                                    <div class="col-xs-12">
                                                            <label class="ace-file-input ace-file-multiple">
                                                                <input id="myModalEditSpecial_uploadIcon" type="file">
                                                                <span class="ace-file-container" data-title="Drop files here or click to choose">
                                                                    <span id="CheckSpecial_drop_img_o" data-title="No File ..." class="ace-file-name">
                                                                        <i class=" ace-icon ace-icon fa fa-cloud-upload"></i>
                                                                    </span>
                                                                    <div style="height: 150px; display: none;">
                                                                        <img id="CheckSpecial_drop_img_c" style="display: block; text-align: center; position: absolute; margin: auto; left: 0px; right: 0px; width: 150px;" src="">
                                                                    </div>
                                                                </span>
                                                                <a href="#" class="remove">
                                                                    <i class=" ace-icon fa fa-times"></i>
                                                                </a>
                                                            </label>
                                                            <!-- /section:custom/file-input -->
                                                    </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    
                                        <form role="form" class="form-horizontal">
                                                    <div style="margin: 0" class="form-group">
                                                                <label style="font-size: 12pt; font-weight: normal; float: left; text-align: left;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">
                                                                    <span style="float: left; margin-top: 3px;">標籤名稱 ： </span>
                                                                    <input data-input="title" style="width: auto; float: left;" class="form-control" type="text">
                                                                </label>
                                                    </div>
                                        </form>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalEditSpecial_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
                                    <button style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">取 消</button>
                                </div>
                        </div>
                </div>
        </div>
                
        <script src="js/ajaxq.js"></script>

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
                    /*AL 0412*/
                    .label-danger.arrowed-in-orange:before {
                      border-color: orange orange orange transparent;
                      -moz-border-right-colors: orange;
                    }
                    .label-danger.arrowed-right:after {
                      border-left-color: #d15b47;
                      -moz-border-left-colors: #d15b47;
                    }
                    .label-danger.arrowed-in-orange-right:after {
                      border-left-color: orange;
                      -moz-border-left-colors: orange;
                    }
                    .label-danger.arrowed-in-right:after {
                      border-color: #d15b47 transparent #d15b47 #d15b47;
                      -moz-border-left-colors: #d15b47;
                    }
                    .label-danger.arrowed-in-orange-right:after{
                      border-color: orange transparent orange orange;
                      -moz-border-left-colors: orange;
                    }
                    
                    
                    
                    
                    .label-danger.arrowed-in-gray:before {
                      border-color: gray gray gray transparent;
                      -moz-border-right-colors: gray;
                    }
                    .label-danger.arrowed-in-gray-right:after {
                      border-left-color: gray;
                      -moz-border-left-colors: gray;
                    }
                    .label-danger.arrowed-in-gray-right:after{
                      border-color: gray transparent gray gray;
                      -moz-border-left-colors: gray;
                    }
                    /*AL 0412*/
        </style>

        <script type="text/javascript">
                
                $("document").ready(function() {
                        
			
                        $( "#loadingpage" ).hide();

                });
                
                function FB_connected_callback_init( response )
                {
                            $.UserMsg = response;
                            $( "#main-container" ).show();
                            
                            
                            
                            $( "#fb-login-button" ).removeClass( "nav-search" );
                            
                            $("#pagecontent").css("display","block");
                            
                };

                function FB_unconnected_callback_init()
                {
                            $.member = "";
                            $( "#main-container" ).hide();
                            Login_Popup_show();
                };
                
                function unlogin_jump()
                {
                            location.href = "index.php";
                }
                
                function FB_connected_callback_select_ttshow_db( data ) {
                }
        </script>

        <!--script src="js/document_ready.js"></script-->
        <script src="js/view_upload_img.js"></script>
    
        <script type="text/javascript">
        $("document").ready(function() {
            
                //add
                $("#special_add").unbind('click').bind( 'click' , function(e) {
                        $("#myModalEditSpecial").attr("state","add");
                        $("#myModalEditSpecial h3").css("display","none");
                        $("#myModalEditSpecial h3[state=add]").css("display","block");
                        $("#myModalEditSpecial").modal("show");
                });
                
                //delete
                $("#myModalDeleteSpecial_Yes").unbind('click').bind( 'click' , function(e) {
                        var callback = function(data) {
                            if( data ) {
                                $( "body" ).trigger( "init_special_tag_list" );
                            } else {
                                console.log(data);
                            }
                        }
                        var data = {
                            cmd : "delete",
                            data : {
                                id : $("#myModalDeleteSpecial").attr( "special_id")
                            }
                        }
                        $.Ajax( "POST" , "php/manage_specialtag.php" , data , {} , callback , "" );
                });
                
                //button
                $("#myModalEditSpecial_Yes").unbind('click').bind( 'click' , function(e) {
                        if( $("#myModalEditSpecial").attr("state") == "add" ) {
                                var callback = function( data ) {
                                        if( data ) {
                                            $( "body" ).trigger( "init_special_tag_list" );
                                        } else {
                                            console.log(data);
                                        }
                                };

                                var data_target = $("#myModalEditSpecial .modal-body");
                                var data = {
                                    name : data_target.find("[data-input=title]").val() ,
                                    img : $("#CheckSpecial_drop_img_c").attr("src"),
                                };
                                $.Ajax( "POST" , "php/manage_specialtag.php" , { cmd : "add" , data : data } , {} , callback , "" );
                        } 
                        else if( $("#myModalEditSpecial").attr("state") == "modify" ) {
                                var callback = function( data ) {
                                        if( data ) {
                                            $( "body" ).trigger( "init_special_tag_list" );
                                        } else {
                                            console.log(data);
                                        }
                                };

                                var data_target = $("#myModalEditSpecial .modal-body");
                                var data = {
                                        id : $("#myModalEditSpecial").attr("special_id"),
                                        name : data_target.find("[data-input=title]").val() ,
                                        img : $("#CheckSpecial_drop_img_c").attr("src"),
                                };
                                $.Ajax( "POST" , "php/manage_specialtag.php" , { cmd : "modify" , data : data } , {} , callback , "" );
                        }
                });
                
                //list
                $( "body" ).bind( 'init_special_tag_list' , function() {
                        var callback = function(data) {
                                var data = eval( data );
                                console.log( data );
                                var html_modal = "html_obj";
                                $("#special_list").html("");
                                for(var i=0; i< data.length; i++) {
                                        html_modal = $("#special_model_example").clone();
                                        html_modal.css("display","block");
                                        html_modal.removeAttr("id");
                                        html_modal.attr( "special_id", data[i].id );
                                        html_modal.find("[id=special_img]").attr("src", data[i].img_path );
                                        html_modal.find("[id=special_name]").html( data[i].name );
                                        $("#special_list").append( html_modal );
                                }
                                $("#special_list [special_id]").unbind('click').bind( 'click' , function(e) {
                                        //modify
                                        if( $(e.target).attr("id") == "special_modify" ) {
                                            var callback = function( data ) {
                                                    if( data ) {
                                                            var data = JSON.parse(data);
                                                            $("#myModalEditSpecial").attr("state","modify");
                                                            $("#myModalEditSpecial").attr("special_id", data.id );
                                                            $("#myModalEditSpecial h3").css("display","none");
                                                            $("#myModalEditSpecial h3[state=modify]").css("display","block");
                                                            
                                                            $("#CheckSpecial_drop_img_c").attr("src",data.img);
                                                            $("#CheckSpecial_drop_img_o").css("display","none");
                                                            $("#CheckSpecial_drop_img_c").parent().css("display","block");
                                                            
                                                            $("#myModalEditSpecial [data-input=title]").val( data.name );
                                                            
                                                            $("#myModalEditSpecial").modal("show");
                                                    } else {
                                                        console.log(data);
                                                    }
                                            };
                                            var data_target = $("#myModalEditSpecial .modal-body");
                                            var data = {
                                                id : $(this).attr("special_id") ,
                                            };
                                            $.Ajax( "POST" , "php/manage_specialtag.php" , { cmd : "select" , data : data } , {} , callback , "" );
                                        }
                                        //delete
                                        else if( $(e.target).attr("id") == "special_delete" ) {
                                            $("#myModalDeleteSpecial").attr( "special_id" , $(this).attr("special_id") );
                                            $("#myModalDeleteSpecial_Name").html( $(this).find("[id=special_name]").html() );
                                            $("#myModalDeleteSpecial_Img").attr( "src" , $(this).find("[id=special_img]").attr("src") );
                                            $("#myModalDeleteSpecial").modal("show");
                                        }
                                });
                        }
                        $.Ajax( "POST" , "php/manage_specialtag.php" , { cmd : "list" } , {} , callback , "" );
                });
                
                $('#myModalEditSpecial')
                .on('show.bs.modal', function (e) {
                })
                .on('hidden.bs.modal', function (e) {
                        $("#myModalEditSpecial").attr("state","");
                        $("#myModalEditSpecial").attr("special_id", "" );
                        $("#CheckSpecial_drop_img_c").attr("src", "" );
                        $("#CheckSpecial_drop_img_o").css("display","block");
                        $("#CheckSpecial_drop_img_c").parent().css("display","none");
                        $("#myModalEditSpecial [data-input=title]").val( "" );
                });
                
                $('#myModalDeleteSpecial')
                .on('show.bs.modal', function (e) {
                })
                .on('hidden.bs.modal', function (e) {
                        $("#myModalDeleteSpecial").attr("special_id" , "");
                });
                
                
                
                $( "body" ).trigger( "init_special_tag_list" );
        });
        </script>
</body>


</html>