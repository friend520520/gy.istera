<!DOCTYPE html>
<html lang="en">
	<head>
            
            <script src="js/google_analytics.js"></script>

            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta charset="utf-8" />
            <title>ttshow-瀏覽紀錄</title>
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

        <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                
</head>

        <body class="no-skin" style="overflow-x: hidden;" >
	<!-- #section:basics/navbar.layout -->
	<div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
	<?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
	
                <?php include( "sidebar.php"); ?>
                
                <div class="main-content" style="background-color: rgb(242, 242, 242); margin-left: 190px;">
                          
                                <div class="page-content">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 20px 30px 0px 20px">
                                            <div style="background: none repeat scroll 0% 0% white; width: 100%; padding: 10px; margin-bottom: 20px;">
                                                    <ul style="margin: 0px; padding: 0px;" class="breadcrumb">
                                                        <li>
                                                            <i class="ace-icon fa fa-home home-icon"></i>
                                                            <a href="#">首頁</a>
                                                        </li>
                                                        <li class="active">瀏覽紀錄</li>
                                                    </ul>
                                            </div>

                                            <div style="width: 100%;">
                                                    
                                                    <button id="history_add" data-target="#myModal" data-toggle="modal" style="border: 1px solid rgb(221, 221, 221); padding: 5px 10px; border-radius: 7px; color: gray; background-color: Transparent;" type="button" class="panel-float-left">
                                                                <span class="filter-option pull-left">全部清除</span>
                                                    </button>
                                                    
                                                    <div style="visibility : hidden;" class="btn-group btn-corner pull-right" id="tab_sort">
                                                            <button class="btn active" tab="1">直立</button>
                                                            <button class="btn" tab="2">列表</button>
                                                            <button class="btn" tab="3">棋盤</button>
                                                    </div>                        
                                            </div>
                                        
                                            <div class="clearfix"></div>
                                            <div style="width: 100%; border-bottom: 1px solid gray; margin-top: 5px;"></div>
                                    </div>


                                </div>
                                
                                <div id="place" style="margin: 18px;">
                                </div>

                                <!--直立 sample code-->
                                <div id="model_example_1" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-left: 0px; display: none; margin-bottom: 12px;">
                                        <div class="panel panel-default chessboard-box">
                                                <div class="panel-body chessboard-body">
                                                        <div id="author_icon" href="#" class="chessboard-icon bg_top" style="background-image: url('http://ttshow.tw/ttshow/account/aaaa51507@yahoo.com.tw/Original/20150421125402.gif'); "></div>

                                                        <a id="author" index="1" class="chessboard-id">
                                                            Abin
                                                        </a>
                                                        <div id="ch_type" style="float: left; font-size: 11pt; line-height: 21px; padding-top: 1px; margin-left: 10px;">作家</div>
                                                        
                                                        <img id="delete" src="template/assets/images/apply/x1.png" class="" style="position: absolute; right: 22px; top: 10px; width: 20px;">

                                                        <button id="subscribe_button" style="padding: 0px 13px; border-radius: 3px; top: 20px;" class="btn btn-sm btn-primary panel-float-right subscribe">訂閱</button>

                                                        <span class="panel1-identity"></span>

                                                        <div class="chessboard-time">
                                                            <i class="ace-icon glyphicon glyphicon-time chessboard-time-icon"></i>
                                                            <span id="date">
                                                                2015-04-16 13:11:28
                                                            </span>
                                                        </div>
                                                        <div class="clearfix"></div>

                                                        <div id="icon" class="chessboard-bgcenter pagebg" style="margin-top:15px; ">
                                                            <img id="specialtag_icon" width="42px" height="42px" src="" style="position: absolute; right: -7px; top: -10px;">
                                                            <div class="cover-black"></div>
                                                            <a id="class_link" href="index.php" class="chessboard-transparent">
                                                                <i class="ace-icon glyphicon glyphicon-film"></i>
                                                                <span id="class">電影</span>
                                                            </a>
                                                        </div>

                                                        <div class="pos-rel page-btn-share-tem">
                                                            <div style="width:0%" class="progress-bar progress-bar-warning page-btn-share-tem-progress"></div>
                                                        </div>

                                                        <h4 id="title" class="upright-title">
                                                          MiLB／王維中遭大都會頂級新秀砲轟&#12288;單局狂失8分吞敗
                                                        </h4>

                                                        <!--span class="chessboard-view">
                                                            <i class="ace-icon fa fa-eye chessboard-icontext"></i>
                                                            <span id="click"></span>
                                                        </span>

                                                        <span class="chessboard-replay">
                                                            <i class="ace-icon fa fa-share chessboard-icontext"></i>
                                                            <span id="share"></span>
                                                        </span-->
                                                        
                                                        <div id="tag" style="overflow-y: hidden; height: 46px; padding: 0px;" class="col-xs-12">
                                                            <a href="search_results.php?search=value">
                                                                <span style="margin-right: 6px; margin-bottom: 6px;" class="label label-inverse chessboard-tag">value</span>
                                                            </a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <!--列表 sample code-->

                                <div id="model_example_2" style="display: none; cursor: pointer; padding-left: 0px; margin-top: 22px;" class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cover-text1">

                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="padding: 0px;margin: 0">
                                                <div id="icon" style="width: 100%; cursor: pointer; background-image: url(&quot;http://www.ooxxoox.com/ttshow/web/data/7/ThumbnailM/20150416130427.jpg&quot;); height: 205px;" class="bg_top pagebg">
                                                        <div class="cover-black"></div>
                                                        <div style="position: absolute; color: white; left: 5%; bottom: 4%; text-shadow: 1px 2px 1px black;">
                                                          <i class="ace-icon fa fa-eye panel-icon"></i>
                                                          <span id="click">208</span>
                                                          <i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>
                                                          <span id="share">7</span>
                                                        </div>
                                                </div>
                                                <div class="pos-rel page-btn-share-tem" style="margin-top: 205px;">
                                                        <div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:0.14%"></div>
                                                </div>
                                        </div>

                                        <div style="padding: 0px;margin: 0; height: 205px;" class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                <p id="title" style="color: gray; font-size: 25px; line-height: 35px; margin: 1px 20px;">MiLB／王維中遭大都會頂級新秀砲轟&#12288;單局狂失8分吞敗</p>

                                                <div style="position: absolute; bottom: 0px; padding-left: 18px; ">
                                                        <h6 style="display: inline; color: gray; font-size: 15px;">
                                                                <i class="ace-icon glyphicon glyphicon-user" style="margin-right: 10px"></i>
                                                                <span id="author">Abin</span>
                                                        </h6>

                                                        <h6 style="display: inline; color: gray; font-size: 15px; margin-left: 18px;">
                                                                <i class="ace-icon glyphicon glyphicon-time" style="margin-right: 10px"></i>
                                                                <span id="date">2015-04-16 13:11:28</span>
                                                        </h6>
                                                </div>
                                        </div>
                                        <div class="clearfix"></div>
                                </div>

                                <!--棋盤 sample code-->
                                <div id="model_example_3" style="display: none; margin: 0px; padding-left: 0px;" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div id="icon" style="width: 95%; cursor: pointer; background-image: url(&quot;http://www.ooxxoox.com/ttshow/web/data/7/ThumbnailM/20150416130427.jpg&quot;); height: 205px;" class="bg_top pagebg" page="7" id="List_article_icon">
                                          <div class="cover-black">
                                          </div>
                                          <div style="position: absolute; color: white; left: 10px; bottom: 5px;">
                                            <i class="ace-icon fa fa-eye panel-icon"></i>
                                            <span id="click">0</span>
                                            <i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>
                                            <span id="share">0</span>
                                          </div>
                                        </div>
                                        <div class="pos-rel page-btn-share-tem" style="margin-top: 205px;"></div>
                                        <p id="title" style="color: gray; font-size: 20px; line-height: 26px; height: 50px; overflow: hidden; margin: 5px 0px;">
                                          MiLB／王維中遭大都會頂級新秀砲轟&#12288;單局狂失8分吞敗
                                        </p>
                                </div>

                                <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                        <img src="template/assets/images/loading.gif" name="load_img">
                                </div>

                </div>
        </div>
                   
    </div>

        <!-- /.main-container -->
    
    
        <!-- Delete History-->
        <div style="display: none;" class="modal fade" id="myModalDeleteHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                                        <h3 class="modal-title" id="myModalLabel">刪除瀏覽資料</h3>
                                </div>

                                <div class="modal-body">
                                        <div style="font-size: 15pt; margin-bottom: 15px;">是否刪除此瀏覽資料：</div>
                                        <div id="history_message"></div>
                                        <form role="form" class="form-horizontal" style="visibility: hidden;">
                                                <div style="margin: 0" class="form-group">
                                                            <label style="font-size: 12pt; font-weight: normal; float: left; text-align: left; height: 7px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label">
                                                                <span style="float: left; margin-top: 3px;"></span>
                                                            </label>
                                                </div>
                                        </form>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalDeleteHistory_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
                                    <button style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">取 消</button>
                                </div>
                        </div>
                </div>
        </div>
    
        <!-- Edit History-->
        <div style="display: none;" class="modal fade" id="myModalEditHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 550px;">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                </span>
                                                <span class="sr-only">Close</span>
                                        </button>
                                        <div id="myModalEditHistory_title">
                                            <h3 state="add" class="modal-title">刪除全部瀏覽紀錄</h3>
                                        </div>
                                </div>

                                <div class="modal-body">
                                    <div style="font-size: 20pt;">是否刪除全部瀏覽紀錄</div>
                                </div>

                                <div class="modal-footer">
                                    <button id="myModalEditHistory_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
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

        <!--script src="js/document_ready.js"></script-->
        <script src="js/view_upload_img.js"></script>
    
        
        <script type="text/javascript">
        
        $("document").ready(function() {
            
                //add
                $("#history_add").unbind('click').bind( 'click' , function(e) {
                        $("#myModalEditHistory").attr("state","delete_all");
                        $("#myModalEditHistory").modal("show");
                });
                
                //delete
                $("#myModalDeleteHistory_Yes").unbind('click').bind( 'click' , function(e) {
                        var callback = function(data) {
                            var data = JSON.parse( data );
                            if( data.success ) {
                                $("#place [date='" + data.collect_id + "']").remove();
                            } else {
                                console.log(data);
                            }
                        }
                        var data = {
                            cmd : "delete",
                            email : $.member.email ,
                            date : $("#myModalDeleteHistory").attr( "history_date") ,
                            ttshow : getCookie( "ttshow" )
                        }
                        $.Ajax( "POST" , "php/manage_history.php" , data , {} , callback , "" );
                });
                
                //button
                $("#myModalEditHistory_Yes").unbind('click').bind( 'click' , function(e) {
                        if( $("#myModalEditHistory").attr("state") == "delete_all" ) {
                                var callback = function( data ) {
                                        if( data ) {
                                            $( "#place" ).html( "" );
                                            $( "body" ).trigger( "init_history_list" );
                                        } else {
                                            console.log(data);
                                        }
                                };

                                var data_target = $("#myModalEditHistory .modal-body");
                                var data = {
                                    cmd : "delete_all" ,
                                    email : $.member.email ,
                                    ttshow : getCookie( "ttshow" )
                                };
                                $.Ajax( "POST" , "php/manage_history.php" , data , {} , callback , "" );
                        } 
                });
                
                //list
                $( "body" ).bind( 'init_history_list' , function() {
                        var callback = function(data) {
                                var data = JSON.parse( data );
                                var page_data = data.history;
                                var subscribe_data = data.subscribe;
                                console.log( data );
                                var html_modal = "html_obj";
                                $("#loading_icon").css( "visibility" , "hidden" );
                                $("#place").css("display","none");
                                if( page_data != null ) {
                                        var target = $("#place");
                                        var content = $(document.createElement("div"));
                                        for(var i=0; i< page_data.length; i++) {
                                                Append_model_1( content , data , page_data[i] );
                                                Append_model_2( content , data , page_data[i] );
                                                Append_model_3( content , data , page_data[i] );                                        
                                        }
                                        
                                        var sort = $("#tab_sort .active").attr("tab");
                                        content.find("[model]").css("display","none");
                                        content.find("[model=" + sort + "]").css("display","block");
                                        
                                        target.append( content.children() );
                                        
                                        $("#place [model]").unbind('click').bind( 'click' , function(e) {
                                                //delete
                                                if( $(e.target).attr("id") == "delete" ) {
                                                    $("#myModalDeleteHistory").attr( "history_date" , $(this).attr("date") );

                                                    var html_modal = $(this).children().eq(0).clone();
                                                    html_modal.find("[id=delete]").remove();
                                                    $("#myModalDeleteHistory #history_message").html("");
                                                    $("#myModalDeleteHistory #history_message").append(html_modal);

                                                    $("#myModalDeleteHistory").modal("show");
                                                }
                                        });
                                }
                                
                                //process subscribe button ++
                                if( subscribe_data != null ) {
                                        for(var i=0; i< subscribe_data.length; i++) {
                                                var target = $("#place").find("[id=subscribe_button][channel=" + subscribe_data[i] + "]");
                                                target.addClass("already");
                                                target.html("已訂閱");
                                        }
                                }
                                collect_subscribe_event();
                                $("#place").css("display","block");
                                if( data.length != 0 ) {
                                    $.GetData = true;
                                }
                                //process subscribe button --
                        }
                        var pageNumber = $("#place [model=1]").length;
                        console.log( pageNumber );
                        $.Ajax( "POST" , "php/manage_history.php" , { cmd : "list" , pageNumber  : pageNumber , ttshow : getCookie("ttshow") } , {} , callback , "" );
                });
                
                $('#myModalEditHistory')
                .on('show.bs.modal', function (e) {
                })
                .on('hidden.bs.modal', function (e) {
                        $("#myModalEditHistory").attr("state","");
                });
                
                $('#myModalDeleteHistory')
                .on('show.bs.modal', function (e) {
                })
                .on('hidden.bs.modal', function (e) {
                        $("#myModalDeleteHistory").attr("history_date" , "");
                });
                
                function Append_model_1( target , data , value ) {

                        var html_modal = $("#model_example_1").clone();
                        html_modal.removeAttr("id");
                        html_modal.attr("model","1");                        
                        html_modal.attr("date", value.history_date );

                        html_modal.find("[id=icon]").css("background-image","url(" + value.article_icon + ")");
                        html_modal.find("[id=icon]").attr("page_id",value.page_id);

                        html_modal.find("[id=title]").html( value.title );
                        html_modal.find("[id=author]").html( value.channel_name );
                        //html_modal.find("[id=author]").attr( "href" , "cooperate.php?ch=" + value.channel_id );BOHAN0717
                        
                        html_modal.find("[id=ch_type]").html( value.channel_type );
                        
                        html_modal.find("[id=subscribe_button]").attr( "channel" , value.channel_id );
                        html_modal.find("[id=date]").html( value.page_date );
                        html_modal.find("[id=class]").html( value.class );

                        html_modal.find("[id=author_icon]").css("background-image","url(" + value.author_icon + ")");
                        html_modal.find("[id=click]").html( value.click );
                        html_modal.find("[id=share]").html( value.share );
                        //html_modal.find("[id=specialtag_icon]").attr("src", value.specialtag_icon );

                        console.log( parseInt(value.share) );
                        if( parseInt(value.share) > 100000 ) {
                            html_modal.find("[id=specialtag_icon]").attr("src", "images/100k.png" );
                        }
                        else if( parseInt(value.share) > 50000 ) {
                            html_modal.find("[id=specialtag_icon]").attr("src", "images/50k.png" );
                        }
                        else if( parseInt(value.share) > 20000 ) {
                            html_modal.find("[id=specialtag_icon]").attr("src", "images/20k.png" );
                        }
                        else if( parseInt(value.share) > 10000 ) {
                            html_modal.find("[id=specialtag_icon]").attr("src", "images/10k.png" );
                        } else {
                            html_modal.find("[id=specialtag_icon]").css("display","none");
                        }
                        
                        
                        $("#specialtag_icon_title").attr("src", value.specialtag_icon );
                        //process tag ++
                        var tag = eval(value.tag);
                        var tag_html = "";
                        for( var j=0;j<tag.length;j++ ) {
                                tag_html += '<a href="search_results.php?search=' + tag[j] + '">' +
                                                '<span style="margin-right: 6px; margin-bottom: 6px;" class="label label-inverse chessboard-tag">' + tag[j] + '</span>' +
                                            '</a>';
                        }
                        html_modal.find("[id=tag]").html( tag_html );
                        //process tag --
                        target.append(html_modal);
                }
                
                function Append_model_2( target , data , value ) {
                                var html_modal = $("#model_example_2").clone();
                                html_modal.removeAttr("id");
                                html_modal.attr("model","2");
                                html_modal.attr("date", value.history_date );
                                html_modal.attr("class_name", value.class );
                                html_modal.find("[id=author]").html( value.author );
                                //html_modal.find("[id=author_icon]").css("background-image","url(" + data.usericon + ")");
                                html_modal.find("[id=icon]").css("background-image","url(" + value.icon + ")");
                                html_modal.find("[id=icon]").attr("page_id",value.page_id);
                                
                                html_modal.find("[id=title]").html( value.title );
                                //html_modal.find("[id=author]").attr( "href" , "cooperate.php?ch=" + value.author_id );BOHAN0717
                                html_modal.find("[id=subscribe_button]").attr( "author" , value.author_id );
                                html_modal.find("[id=date]").html( value.page_date );
                                html_modal.find("[id=class]").html( value.class );
                                html_modal.find("[id=click]").html( value.click );
                                html_modal.find("[id=share]").html( value.share );

                                if( value.specialtag_icon != "" && value.specialtag_icon != undefined ) {
                                        html_modal.find("[id=specialtag_icon]").attr("src", value.specialtag_icon );
                                } else {
                                        html_modal.find("[id=specialtag_icon]").css( "display" , "none" );
                                }

                                target.append(html_modal);
                        }
                
                function Append_model_3( target , data , value ) {
                                var html_modal = $("#model_example_3").clone();
                                html_modal.removeAttr("id");
                                html_modal.attr("model","3");
                                html_modal.attr("date", value.history_date );

                                html_modal.find("[id=author]").html( data.user_name );
                                html_modal.find("[id=author_icon]").css("background-image","url(" + data.usericon + ")");
                                html_modal.find("[id=icon]").css("background-image","url(" + value.icon + ")");
                                html_modal.find("[id=icon]").attr("page_id",value.page_id);
                                
                                html_modal.find("[id=title]").html( value.title );
                                //html_modal.find("[id=author]").attr( "href" , "cooperate.php?ch=" + value.author_id );BOHAN0717
                                html_modal.find("[id=subscribe_button]").attr( "author" , value.author_id );
                                html_modal.find("[id=date]").html( value.page_date );
                                html_modal.find("[id=class]").html( value.class );
                                html_modal.find("[id=click]").html( value.click );
                                html_modal.find("[id=share]").html( value.share );

                                if( value.specialtag_icon != "" && value.specialtag_icon != undefined ) {
                                        html_modal.find("[id=specialtag_icon]").attr("src", value.specialtag_icon );
                                } else {
                                        html_modal.find("[id=specialtag_icon]").css( "display" , "none" );
                                }
                                
                                target.append(html_modal);
                }
                
                function display_tab_content() {                                
                        var sort = $("#tab_sort .active").attr("tab");
                        $("#place [model]").css("display","none");
                        setTimeout(function(){ $("#place [model=" + sort + "]").css("display","block"); }, 200);
                }
                
                //sort ++
                $( "#tab_sort" ).unbind('click').bind( "click" , function(e) {
                            if( $(e.target).attr("tab") != undefined ) {
                                    $("#tab_sort [tab]").removeClass("active");
                                    $("#tab_sort [tab=" + $(e.target).attr("tab") + "]").addClass("active");
                                    display_tab_content();
                            }
                });          
                //sort --
                
        });
                
        $.GetData = true;
        function sys_init() {
            //scroll end ++
            $(window).on("scroll", function() {
                    var scrollHeight = $(document).height();
                    var scrollPosition = $(window).height() + $(window).scrollTop();
                    if ((scrollHeight - scrollPosition) / scrollHeight == 0 && $(window).scrollTop() != 0 && $.GetData == true ) {
                            $.GetData = false;
                            $("#loading_icon").css( "visibility" , "visible" );
                            $( "body" ).trigger( "init_history_list" );
                    }
            });
            $( "body" ).trigger( "init_history_list" );
            //scroll end --
        }
                
        $("document").ready(function() {


                $( "#loadingpage" ).hide();

        });

        function FB_connected_callback_init( response )
        {
                    $.member = response;
                    $( "#main-container" ).show();

                    $( "#fb-login-button" ).removeClass( "nav-search" );

                    $("#pagecontent").css("display","block");

                    sys_init();
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
</body>


</html>
