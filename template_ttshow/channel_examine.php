<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-頻道審核</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">

                <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

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

	<body class="no-skin">
	<!-- #section:basics/navbar.layout -->
	<div id="loadingpage" class="widget-box-overlay" style="display: none;"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
	<?php include( "header_1.php"); ?>

        <div class="main-container" id="main-container" style="background-color: white;">

            <?php include( "sidebar.php"); ?>

                <div class="main-content" style="margin-left: 190px;">
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
                                           <li class="active">頻道審核</li>
                                       </ul>
                                </div>
                        </div>

                        <div id="userdata_list" style="margin-left: 20px" class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
                        </div>

                        
                        <div id="userdata_model_example" style="display: none; padding: 0px; float: left; margin-right: 10px; margin-bottom: 10px;" class="panel panel-default ">
                            <div style="width: 350px; padding: 10px" class="panel-body">
                                <div class="clearfix"></div>

                                <div id="cover" style="border: 1px solid rgb(221, 221, 221); height: 150px; float: left; margin-right: 10px; position: relative; background-size: cover; width: 100%; margin-bottom: 20px;">
                                    <div id="icon" style="float: left; margin-right: 10px; position: relative; background-size: cover; width: 75px; height: 75px; border: 1px solid rgb(221, 221, 221); top: 85px; left: 10px;"></div>
                                </div>

                                        <div style="font-size: 12pt; word-break: break-all; color: black; position: relative;">

                                                <div style="margin-bottom: 5px;">
                                                    <span>頻道名稱：&nbsp;</span>
                                                    <span id="ch_name" style="font-size: 11pt;">Abin Leo</span>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <span>登入身分：&nbsp;</span>
                                                    <span id="ch_usertype" style="font-size: 11pt;">aaa51507@gmail.com</span>
                                                </div>
                                                <div style="margin-bottom: 5px; height: 250px;">
                                                    <div style="margin-bottom: 5px">頻道介紹：&nbsp;</div>
                                                    <div id="ch_introduce" style="overflow: hidden; font-size: 11pt; border: 1px solid rgb(221, 221, 221); height: 235px;"></div>
                                                </div>
                                                
                                                <div class="clearfix"></div>

                                        </div>
                                        <div>
                                            <button id="usertype_modify" type="button" class="btn btn-white btn-success" style="display: none; margin: 10px 10px 0px 0px;">詳細介紹</button>
                                            <button id="usertype_delete" type="button" class="btn btn-white btn-success" style="float: right; margin: 10px 0px 0px;">審核通過</button>
                                        </div>
                            </div>
                        </div>
                        
                        
                </div>
        </div>
        <!-- /.main-container -->
    
    
        <!-- examine Account-->
        <div style="display: none;" class="modal fade" id="myModalExamine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="min-width: 400px">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                                        <h3 class="modal-title" id="myModalLabel">審核頻道</h3>
                                </div>

                                <div class="modal-body">
                                        <div style="font-size: 15pt; margin-bottom: 15px;">審核通過：</div>
                                        <div id="account_message"></div>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalExamine_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
                                    <button style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">取 消</button>
                                </div>
                        </div>
                </div>
        </div>
    
        <!-- Edit Account-->
        <div style="display: none;" class="modal fade" id="myModalEditAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 550px;">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                                        <div id="myModalEditAccount_title">
                                            <h3 state="add" class="modal-title">新增帳戶</h3>
                                            <h3 state="modify" class="modal-title">修改身份</h3>
                                        </div>
                                </div>

                                <div class="modal-body">
                                    <div id="modify_account_layout">
                                        <div id="account_modify_form" style="display: none;">
                                            <div id="account_message"></div>
                                            <div style="font-size: 14pt; margin: 30px 15px 15px;">
                                                修改身份為：
                                                <select id="account_manage_select" style="height: 35px">
                                                    <option value="">會員</option>
                                                    <option value="editor">編輯</option>
                                                    <option value="manage">管理員</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="account_add_form" style="display: none;">
                                                <form role="form" class="form-horizontal">
                                                        <div style="margin: 0" class="form-group">
                                                                <label style="font-size: 12pt; font-weight: normal; float: left; text-align: left;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">
                                                                    <span style="float: left; margin-top: 3px;">姓名 ： </span>
                                                                    <input type="text" data-input="name" style="width: auto; float: left;" class="form-control">
                                                                </label><label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label" style="font-size: 12pt; font-weight: normal; float: left; text-align: left;">
                                                                    <span style="float: left; margin-top: 3px;">信箱 ： </span>
                                                                    <input type="text" data-input="mail" class="form-control" style="width: auto; float: left;">
                                                                </label>
                                                        </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalEditAccount_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
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
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            $( "#main-container" ).show();
                            
                            
                            $( "#fb-login-button" ).removeClass( "nav-search" );
                            
                            $("#pagecontent").css("display","block");
                            $("document").ready(function() {
                                    $( "body" ).trigger( "init_account_list" );
                            });
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
        </script>

    
        <script type="text/javascript">
        $("document").ready(function() {
            
            
                //add
                $("#account_add").unbind('click').bind( 'click' , function(e) {
                        $("#myModalEditAccount").attr("state","add");
                        $("#myModalEditAccount h3").css("display","none");
                        $("#myModalEditAccount h3[state=add]").css("display","block");
                        
                        $("#myModalEditAccount #account_add_form").css("display","block");
                        $("#myModalEditAccount").modal("show");
                });
                
                //Examine
                $("#myModalExamine_Yes").unbind('click').bind( 'click' , function(e) {
                        var callback = function(data) {
                            if( data ) {
                                $( "body" ).trigger( "init_account_list" );
                            } else {
                                console.log(data);
                            }
                        }
                        var data = {
                            cmd : "examine",
                            mail : $.member.email ,
                            data : {
                                id : $("#myModalExamine").attr( "channel_id")
                            }
                        }
                        console.log(data);
                        $.Ajax( "POST" , "php/manage_channel.php" , data , {} , callback , "" );
                });
                
                //button
                $("#myModalEditAccount_Yes").unbind('click').bind( 'click' , function(e) {
                        if( $("#myModalEditAccount").attr("state") == "add" ) {
                                var callback = function( data ) {
                                        if( data ) {
                                            $( "body" ).trigger( "init_account_list" );
                                        } else {
                                            console.log(data);
                                        }
                                };

                                var data_target = $("#myModalEditAccount .modal-body");
                                var data = {
                                    name : data_target.find("[data-input=name]").val() ,
                                    mail : data_target.find("[data-input=mail]").val() ,
                                };
                                $.Ajax( "POST" , "php/manage_channel.php" , { cmd : "add" , data : data } , {} , callback , "" );
                        } 
                        else if( $("#myModalEditAccount").attr("state") == "modify" ) {
                                var callback = function( data ) {
                                        if( data ) {
                                            $( "body" ).trigger( "init_account_list" );
                                        } else {
                                            console.log(data);
                                        }
                                };

                                var data_target = $("#myModalEditAccount .modal-body");
                                var data = {
                                        id : $("#myModalEditAccount").attr("channel_id") ,
                                        manage : $("#account_manage_select").val() ,
                                };
                                $.Ajax( "POST" , "php/manage_channel.php" , { cmd : "modify" , mail : $.member.email , data : data } , {} , callback , "" );
                        }
                });
                
                //list
                $( "body" ).bind( 'init_account_list' , function() {
                        var callback = function(data) {
                                var data = eval( data );
                                console.log( data );
                                var html_modal = "html_obj";
                                $("#userdata_list").html("");
                                for(var i=0; i< data.length; i++) {
                                        html_modal = $("#userdata_model_example").clone();
                                        html_modal.css("display","block");
                                        html_modal.removeAttr("id");
                                        
                                        html_modal.find("[id=icon]").css("background-image","url(" + data[i].icon + ")");
                                        html_modal.find("[id=cover]").css("background-image","url(" + data[i].cover + ")");
                                        html_modal.find("[id=ch_name]").html( data[i].channelname );
                                        html_modal.find("[id=ch_usertype]").html( data[i].type );
                                        html_modal.find("[id=ch_introduce]").html( data[i].introduce );
                                        
                                        html_modal.attr( "channel_id", data[i].id );
                                        $("#userdata_list").append( html_modal );
                                }
                                $("#userdata_list [channel_id]").unbind('click').bind( 'click' , function(e) {
                                        //modify
                                        if( $(e.target).attr("id") == "usertype_modify" ) {
                                            var html_modal = $(this).children().eq(0).clone();
                                            html_modal.attr("style","width: 350px; margin: auto; border: 1px solid gray; border-radius: 10px;");
                                            var callback = function( data ) {
                                                    if( data ) {
                                                            var data = JSON.parse(data);
                                                            
                                                            $("#myModalEditAccount").attr("state","modify");
                                                            $("#myModalEditAccount").attr("channel_id", data.id );
                                                            $("#myModalEditAccount h3").css("display","none");

                                                            $("#myModalEditAccount #account_modify_form").css("display","block");
                                                            $("#myModalEditAccount h3[state=modify]").css("display","block");
                                                            
                                                            html_modal.find("[id=usertype_modify]").remove();
                                                            html_modal.find("[id=usertype_delete]").remove();
                                                            $("#myModalEditAccount #account_message").html("");
                                                            $("#myModalEditAccount #account_message").append(html_modal);
                                                            $("#account_manage_select").val(data.type);
                                                            $("#myModalEditAccount").modal("show");
                                                    } else {
                                                        console.log(data);
                                                    }
                                            };
                                            var data_target = $("#myModalEditAccount .modal-body");
                                            var data = {
                                                id : $(this).attr("channel_id") ,
                                            };
                                            $.Ajax( "POST" , "php/manage_channel.php" , { cmd : "select" , mail : $.member.email , data : data } , {} , callback , "" );
                                        }
                                        //delete
                                        else if( $(e.target).attr("id") == "usertype_delete" ) {
                                            $("#myModalExamine").attr( "channel_id" , $(this).attr("channel_id") );
                                            
                                            var html_modal = $(this).children().eq(0).clone();
                                            html_modal.attr("style","width: 350px; margin: auto; border: 1px solid gray; border-radius: 10px;");
                                            html_modal.find("[id=usertype_modify]").remove();
                                            html_modal.find("[id=usertype_delete]").remove();
                                            $("#myModalExamine #account_message").html("");
                                            $("#myModalExamine #account_message").append(html_modal);
                                            
                                            $("#myModalExamine").modal("show");
                                        }
                                });
                        }
                        $.Ajax( "POST" , "php/manage_channel.php" , { cmd : "list" , mail : $.member.email } , {} , callback , "" );
                });
                
                $('#myModalEditAccount')
                .on('show.bs.modal', function (e) {
                })
                .on('hidden.bs.modal', function (e) {
                        $("#myModalEditAccount").attr("state","");
                        $("#myModalEditAccount").attr("channel_id", "" );
                        $("#myModalEditAccount #account_add_form").css("display","none");
                        $("#myModalEditAccount #account_modify_form").css("display","none");
                        $("#myModalEditAccount [data-input]").val("");
                });
                
                $('#myModalExamine')
                .on('show.bs.modal', function (e) {
                })
                .on('hidden.bs.modal', function (e) {
                        $("#myModalExamine").attr("channel_id" , "");
                });
        });
        </script>
</body>


</html>
