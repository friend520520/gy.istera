<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>ttshow-分類管理</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
        <link rel="stylesheet" href="template/assets/css/font-awesome.css" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="template/assets/css/jquery-ui.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="template/assets/css/ace-fonts.css" />

        <!-- ace styles 4/9 AL 更換CSS路徑-->
        <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="template/assets/css/nestable.css"/>

        
        <script src="template/assets/js/jquery.js"></script>
        <script src="template/assets/js/ace-extra.js"></script>
        <script src="js/jquery.nestable.js"></script>

        
        <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
        <style>
            .youtobe_video > [name=u2_player] {
                position: relative;
            }
            .youtobe_video > [name=u2_player]:before {
                content: "";
                display: block;
                padding-top: 62%;
            }
            .youtobe_video > [name=u2_player] > iframe {
                bottom: 0;
                left: 0;
                position: absolute;
                right: 0;
                top: 0;
            }
        </style>
                
                
    </head>

	<body class="no-skin" >
        <!-- #section:basics/navbar.layout -->
            <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>

            <?php include( "header.php"); ?>


            <!-- #section:basics/sidebar -->
            <?php include("sidebar.php"); ?>
            
            <div class="main-container" id="main-container" style="background-color: white; margin-left: 190px;">

                    <div class="main-content">
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
                                                                    <button id="channel_add" style="border-radius: 3px;" type="button" class="btn btn-sm  btn-primary panel-float-left">
                                                                                <i class="fa fa-plus fa-lg"></i>
                                                                    </button>
                                                            </div>

                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 15px">
                                                                    <form id="channel_list" class="form-inline">
                                                                    </form>
                                                                    
                                                                    <div class="dd" id="nestable3">
                                                                        <ol class="dd-list">
                                                                            <li class="dd-item dd3-item" data-id="13">
                                                                                <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 13</div>
                                                                            </li>
                                                                            <li class="dd-item dd3-item" data-id="14">
                                                                                <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 14</div>
                                                                            </li>
                                                                            <li class="dd-item dd3-item" data-id="15">
                                                                                <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 15</div>
                                                                                <ol class="dd-list">
                                                                                    <li class="dd-item dd3-item" data-id="16">
                                                                                        <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 16</div>
                                                                                    </li>
                                                                                    <li class="dd-item dd3-item" data-id="17">
                                                                                        <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 17</div>
                                                                                    </li>
                                                                                    <li class="dd-item dd3-item" data-id="18">
                                                                                        <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 18</div>
                                                                                    </li>
                                                                                </ol>
                                                                            </li>
                                                                        </ol>
                                                                    </div>

                                                                    <div id="channel_model_example" style="font-size: 15pt; display: none; margin-bottom: 15px;" class="form-group">
                                                                            <label style="font-size: 14pt; margin-right: 10px; margin-bottom: 0px; margin-left: 10px; padding-top: 0px;">
                                                                                <div style="float: left; width: 35px;" id="channel_numbers">1.</div>
                                                                                <div style="float: left; width: 80px;" id="channel_name">好笑</div>
                                                                            </label>
                                                                            <input type="text" style="width: 400px; margin-right: 5px;" disabled="" class="form-control" placeholder="channel-setting.php">
                                                                            <button id="channel_modify" class="btn btn-success" style="border-radius: 5px; padding: 0px 5px; margin-right: 5px;" type="button">編輯</button>
                                                                            <button id="channel_delete" class="btn btn-danger" style="border-radius: 5px; padding: 0px 5px; margin-right: 5px;" type="button">刪除</button>
                                                                   </div>
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

        
        <!-- /.main-content -->
  

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
                        </i>
            </a>

        <!-- Delete Channel-->
        <div style="display: none;" class="modal fade" id="myModalDeleteChannel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div style="height: 986px;" class="modal-backdrop fade in"></div>
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
                                            <div id="myModalDeleteChannel_Name" style="font-size: 20pt; float: left; margin: 15px 10px 10px 20px;">test</div>
                                        </div>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalDeleteChannel_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
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

        <!-- the following scripts are used in demo only for onpage help and you don't need them -->
        <link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" />
        <link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" />

        <script type="text/javascript">
                ace.vars['base'] = '..';
        </script>

        <!-- init       : null -->
        <!-- callback   : $.device = mobile or pc -->
        <script src="js/device.js"></script>
        
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
                //show_list();
                $( "#nestable3" ).nestable();
                
                $.Ajax = function ( type , url , data , data2 , back , error_back)
                {
                           if( error_back == "" ) {
                                   error_back = function(e) { console.log(e); };
                           }
                           $.ajax({
                                       type : type ,
                                       url : url ,
                                       async: true ,
                                       data : data ,
                                       data2 : data2 ,
                                       success : back ,
                                       error : error_back
                           });
                }
                //add
                $("#channel_add").unbind('click').bind( 'click' , function(e) {
                        var callback = function( data ) {
                                try{
                                        if( data ) {
                                                var data = JSON.parse(data);
                                                $("#myModalEditChannel").attr("state","add");
                                                $("#myModalEditChannel h3").css("display","none");
                                                $("#myModalEditChannel h3[state=add]").css("display","block");
                                                $('#myModalEditChannel').find("input[type=checkbox][name=display]")[0].checked = true;

                                                $('#myModalEditChannel select[data-select=user] optgroup').html("");
                                                $('#myModalEditChannel select[data-select=user] optgroup').append( '<option value=""></option>' );
                                                for( var i=0; i<data.people.length; i++ ) {
                                                    if( data.people[i].manage == "" || data.people[i].manage == "null") {
                                                            $('#myModalEditChannel select[data-select=user] optgroup').eq(0).append(
                                                                    '<option value="' + data.people[i].id + '">' + data.people[i].name + " (" + data.people[i].email + ")" +'</option>'
                                                            );
                                                    }
                                                }
                                                $('#myModalEditChannel select[data-select=user]').val( data.manage );

                                                $("#myModalEditChannel").modal("show");
                                        } else {
                                            console.log(data);
                                        }   
                                }
                                catch(e){
                                    console.log(e);
                                }
                                
                        };
                        //$.Ajax( "POST" , "php/manage_tab.php" , { cmd : "people" , data : {} } , {} , callback , "" );
                        $("#myModalEditChannel").attr("state","add");
                        $("#myModalEditChannel h3").css("display","none");
                        $("#myModalEditChannel h3[state=add]").css("display","block");
                        $("#myModalEditChannel").modal("show");
                });
                //delete
                $("#myModalDeleteChannel_Yes").unbind('click').bind( 'click' , function(e) {
                        var callback = function(data) {
                            if( data ) {
                                $( "body" ).trigger( "init_channel_list" );
                            } else {
                                console.log(data);
                            }
                        }
                        var data = {
                            cmd : "delete",
                            data : {
                                id : $("#myModalDeleteChannel").attr( "channel_id")
                            }
                        }
                        $.Ajax( "POST" , "php/manage_tab.php" , data , {} , callback , "" );
                });
                //list
                $( "body" ).bind( 'init_channel_list' , function() {
                        var callback = function(data) {
                                var data = eval( data );
                                console.log( data );
                                var html_modal = "html_obj";
                                $("#channel_list").html("");
                                for(var i=0; i< data.length; i++) {
                                        html_modal = $("#channel_model_example").clone();
                                        html_modal.css("display","block");
                                        html_modal.removeAttr("id");
                                        
                                        html_modal.attr( "channel_id", data[i].id );
                                        html_modal.find("[id=channel_numbers]").html( (i+1) + "." );
                                        html_modal.find("[id=channel_name]").html( data[i].name );
                                        /*
                                        if( data[i].display == "false" ) {
                                                html_modal.css( "opacity" , "0.7" );
                                                html_modal.css( "color" , "gray" );
                                        } 
                                        */
                                        $("#channel_list").append( html_modal );
                                }
                                $("#channel_list [channel_id]").unbind('click').bind( 'click' , function(e) {
                                        //modify
                                        if( $(e.target).attr("id") == "channel_modify" ) {
                                            var callback = function( data ) {
                                                    if( data ) {
                                                            try{
                                                                    var data = JSON.parse(data);
                                                                    $("#myModalEditChannel").attr("state","modify");
                                                                    $("#myModalEditChannel").attr("channel_id", data.id );
                                                                    $("#myModalEditChannel h3").css("display","none");
                                                                    $("#myModalEditChannel h3[state=modify]").css("display","block");

                                                                    $("#myModalEditChannel [data-input=title]").val( data.name );
                                                                    /*
                                                                    if( data.display == "true" || data.display == "" ) {
                                                                            $('#myModalEditChannel').find("input[type=checkbox][name=display]")[0].checked = true;
                                                                    } else {
                                                                            $('#myModalEditChannel').find("input[type=checkbox][name=display]")[0].checked = false;
                                                                    }
                                                                    
                                                                    $('#myModalEditChannel select[data-select=user] optgroup').html("");
                                                                    $('#myModalEditChannel select[data-select=user] optgroup').append( '<option value=""></option>' );
                                                                    for( var i=0; i<data.people.length; i++ ) {
                                                                        if( data.people[i].manage == "" || data.people[i].manage == "null") {
                                                                                $('#myModalEditChannel select[data-select=user] optgroup').eq(0).append(
                                                                                        '<option value="' + data.people[i].id + '">' + data.people[i].name + " (" + data.people[i].email + ")" +'</option>'
                                                                                );
                                                                        } else if( data.people[i].id == data.manage ) {
                                                                                $('#myModalEditChannel select[data-select=user] optgroup').eq(0).append(
                                                                                        '<option style="color: blue;" value="' + data.people[i].id + '">' + data.people[i].name + " (" + data.people[i].email + ")" +'</option>'
                                                                                );
                                                                        }
                                                                        if( data.people[i].usertype == "editor" ) {
                                                                            $('#myModalEditChannel select[data-select=user] optgroup').eq(0).append('<option value="' + data.people[i].id + '">' + data.people[i].name + '</option>');
                                                                        }
                                                                        else if( data.people[i].usertype == "manage" ) {
                                                                            if( data.people[i].manage == "" || data.people[i].manage == "null") {
                                                                                $('#myModalEditChannel select[data-select=user] optgroup').eq(1).append('<option value="' + data.people[i].id + '">' + data.people[i].name + '</option>');
                                                                            } else {
                                                                                $('#myModalEditChannel select[data-select=user] optgroup').eq(1).append('<option manage="' + data.people[i].manage + '" style="color: blue" value="' + data.people[i].id + '">' + data.people[i].name + '</option>');
                                                                            }
                                                                        }
                                                                    }
                                                                    */
                                                                    $('#myModalEditChannel select[data-select=user]').val( data.manage );

                                                                    $("#myModalEditChannel").modal("show");
                                                            }
                                                            catch(e){
                                                                console.log(e);
                                                            }
                                                    } else {
                                                        console.log(data);
                                                    }
                                            };                                            
                                            
                                            var data_target = $("#myModalEditChannel .modal-body");
                                            var data = {
                                                id : $(this).attr("channel_id") ,
                                            };
                                            $.Ajax( "POST" , "php/manage_tab.php" , { cmd : "select" , data : data } , {} , callback , "" );
                                        }
                                        //delete
                                        else if( $(e.target).attr("id") == "channel_delete" ) {
                                            $("#myModalDeleteChannel").attr( "channel_id" , $(this).attr("channel_id") );
                                            $("#myModalDeleteChannel_Name").html( $(this).find("[id=channel_name]").html() );
                                            $("#myModalDeleteChannel_Img").attr( "src" , $(this).find("[id=channel_img]").attr("src") );
                                            $("#myModalDeleteChannel").modal("show");
                                        }
                                });
                                $("#main-container").css("overflow-x","hidden");
                        }
                        $.Ajax( "POST" , "php/manage_tab.php" , { cmd : "list" } , {} , callback , "" );
                });
                //button
                $("#myModalEditChannel_Yes").unbind('click').bind( 'click' , function(e) {
                        if( $("#myModalEditChannel").attr("state") == "add" ) {
                                var callback = function( data ) {
                                        if( data ) {
                                            $( "body" ).trigger( "init_channel_list" );
                                        } else {
                                            console.log(data);
                                        }
                                };

                                var data_target = $("#myModalEditChannel .modal-body");
                                var data = {
                                    name : data_target.find("[data-input=title]").val() ,
                                    //display : data_target.find("input[type=checkbox][name=display]")[0].checked ,
                                    manage : data_target.find("select[data-select=user]").val() ,
                                };
                                $.Ajax( "POST" , "php/manage_tab.php" , { cmd : "add" , data : data } , {} , callback , "" );
                        } 
                        else if( $("#myModalEditChannel").attr("state") == "modify" ) {
                                var callback = function( data ) {
                                        if( data ) {
                                            $( "body" ).trigger( "init_channel_list" );
                                        } else {
                                            console.log(data);
                                        }
                                };

                                var data_target = $("#myModalEditChannel .modal-body");
                                var data = {
                                        id : $("#myModalEditChannel").attr("channel_id"),
                                        name : data_target.find("[data-input=title]").val() ,
                                        //display : data_target.find("input[type=checkbox][name=display]")[0].checked ,
                                        manage : data_target.find("select[data-select=user]").val() ,
                                };
                                $.Ajax( "POST" , "php/manage_tab.php" , { cmd : "modify" , data : data } , {} , callback , "" );
                        }
                });
                
                
                
                $('#myModalEditChannel')
                .on('show.bs.modal', function (e) {
                })
                .on('hidden.bs.modal', function (e) {
                        $("#myModalEditChannel").attr("state","");
                        $("#myModalEditChannel").attr("channel_id", "" );
                        $("#myModalEditChannel [data-input=title]").val( "" );
                });
                
                $('#myModalDeleteChannel')
                .on('show.bs.modal', function (e) {
                })
                .on('hidden.bs.modal', function (e) {
                        $("#myModalDeleteChannel").attr("channel_id" , "");
                });
                
                
                
                
                $( "body" ).trigger( "init_channel_list" );
        });
                
                function show_list() {
                        $.ajax({
                                    type: "POST",
                                    url: "php/category.php?func=list",
                                    data: {
                                    },
                                    //dataType: "json",
                                    success: function( data ) {
                                            
                                            data = JSON.parse( data );
                                            var tmp = "";
                                            $.each( data , function( index , value ){
                                                
                                                tmp += '<div>' +
                                                            '<div class="form-group">' +
                                                                    '<label class="col-xs-3 control-label no-padding-right" for="form-field-1">' + value.id + ". " + value.name + '</label>' +
                                                                    '<div class="col-xs-9">' +
                                                                            '<input type="text" id="form-field-1" placeholder="channel-setting.php" class="form-control" disabled>' +
                                                                    '</div>' +
                                                            '</div>' +
                                                            '<div class="space-4"></div>' +
                                                        '</div>';
                                                
                                            });
                                            $( "#channel_place" ).html( tmp );
                                            console.log( data );

                                    }
                        });
                }
                
                
                
                
                
                
        </script>
        
</body>

</html>
