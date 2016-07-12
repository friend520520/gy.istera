<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>TTshow-合作頻道頁:創作列表</title>
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

        <!--[if lte IE 9]>
			<link rel="stylesheet" href="template/assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

        <!--[if lte IE 9]>
		  <link rel="stylesheet" href="template/assets/css/ace-ie.css" />
		<![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="template/assets/js/jquery.js"></script>
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        <script src="template/assets/js/ace-extra.js"></script>
        <style>
            .top-bar{
                background-color: #dcdcdc; 
                font-size: initial; 
                height: 50px; 
                text-align: center; 
                padding: 15px 0; 
                margin-top: 10px;
                border-right: 1px solid darkgray; 
            }
            .top-bar-right{
                background-color: #dcdcdc; 
                font-size: initial; 
                height: 50px; 
                text-align: center; 
                padding: 15px 0; 
                margin-top: 10px;
            }
            .top-bar-gray{
                background-color: #f2f2f2; 
                font-size: initial; 
                height: 50px; 
                text-align: center; 
                padding-top: 12px; 
                margin-top: 10px;
                border-right: 1px solid darkgray;
                border-top: 4px solid rgb(41, 103, 165);
                color: rgb(41, 103, 165);
                padding: 15px 0; 
                margin-bottom: 20px;
            }
            hr{
                margin: 10px;
            }
            .title{
                font-size: 25px; 
                overflow-y: hidden; 
                margin-left: 30px; 
                margin-top: 0px; 
                line-height: 32px; 
                height: 60px; 
                color: #2967a5;
            }
            .description {
                color: gray; 
                font-size: 15px; 
                margin-left: 30px;
            }
            .description i{
                margin-right: 5px;
            }
            .description span{
                margin-right: 15px;
            }
            .new-btn-group{
                margin-right: 40px;
                text-align: right;
                margin-top: 32px;
                padding: 0px;
                float: right;
            }
            .new-btn-group button{
                font-size: 15px;
                border-radius: 3px;
                margin-left: 1px;
                padding: 2px 6px;
                border: 0 none;
            }
            .blue-button{
                background-color: #3191f2 !important;
                borde-color: #3191f2 !important;
            }
            .red-button{
                background-color: #eb8080 !important;
                borde-color: #eb8080 !important;
            }
            .green-button{
                background-color: #5dc28c !important;
                borde-color: #5dc28c !important;
            }
        </style>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
		<script src="template/assets/js/html5shiv.js"></script>
		<script src="template/assets/js/respond.js"></script>
		<![endif]-->
		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
	</head>

        <body class="no-skin" >
            
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay">
                <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
        </div>
        
        <div id="deletedialog" style="display: none;" class="modal fade" id="myModalDeleteHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-l">
                            <div class="modal-content">
                                    <div style="padding: 50px 25px;" class="modal-body">
                                                    <h1 style="color:red;">請注意刪除就無法還原</h1>
                                                    <div id="deletedialogyes" style="height: 45px; cursor: pointer; text-align: center; border: 2px solid white; border-radius: 6px; float: right; background: rgb(24, 74, 117) none repeat scroll 0px 0px;" class="col-xs-6 col-sm-3">
                                                            <h3 style="color: white; text-align: center; font-size: 17px; margin: 10px;">刪除</h3>
                                                    </div>
                                                    <div id="deletedialogno" class="col-xs-6 col-sm-3" style="height: 45px; float: right; cursor: pointer; border-radius: 6px; border: 2px solid white; text-align: center;">
                                                            <h3 style="text-align: center; color: black; font-size: 17px; margin: 10px;">取消</h3>
                                                    </div>
                                                    <div class="clearfix"></div>
                                    </div>
                            </div>
                    </div>
        </div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
        
                <?php include("sidebar.php"); ?>
            
                <div class="main-content" style="background-color:#f2f2f2; margin-left: 190px;">
                        <div class="main-content-inner"> 
                                <div class="page-content" id="pagecontent" style="margin-top: 40px;">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                                <div class="col-md-1 col-lg-1"></div>
                                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="padding:0px;">
                                                        <!--?php include( "cooperate_tab.php"); ?-->
                                                        <div style="background-color: white; padding: 0px 0px 50px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div style="padding: 30px 0px 0px;">
                                                                            <div class="navbar-form" role="search" style="margin-bottom: 15px;">
                                                                                        
                                                                                        <div class="form-group" style="border: 1px solid rgb(213, 213, 213); margin-right: 5px;">
                                                                                                    <input id="channel_search" type="text" class="form-control" placeholder="" style="height: 30px; width: 300px;" >
                                                                                        </div>
                                                                                        <button id="channel_search_btn" class="btn btn-default" style="border: 1px solid rgb(213, 213, 213); background-color: #eeeeee; color: black; text-shadow: 0px 0px 0px transparent; padding: 5px 14px;" id="page_search_btn">
                                                                                                    搜尋
                                                                                        </button>
                                                                                        <button id="channel_searchclean_btn" class="btn btn-default" style="border: 1px solid rgb(213, 213, 213); background-color: #eeeeee; color: black; text-shadow: 0px 0px 0px transparent; padding: 5px 14px;" id="page_searchclean_btn">
                                                                                                    清除
                                                                                        </button>
                                                                                
                                                                                        <select id="channel_list" type="" style="width: 300px;"></select>
                                                                            </div>
                                                                            <!--button style="border-radius: 3px; background-color: rgb(41, 103, 165); padding: 3px 7px;" class="btn btn-sm btn-primary panel-float-left">
                                                                                        新增文章
                                                                            </button-->

                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div style="">
                                                                        <div style="margin-bottom: 15px;" role="search" class="navbar-form">

                                                                                    <div style="border: 1px solid rgb(213, 213, 213); margin-right: 5px;" class="form-group">
                                                                                                <input id="page_search" type="text" style="height: 30px; width: 300px;" placeholder="" class="form-control">
                                                                                    </div>
                                                                                    <button id="page_search_btn" style="border: 1px solid rgb(213, 213, 213); background-color: #eeeeee; color: black; text-shadow: 0px 0px 0px transparent; padding: 5px 14px;" class="btn btn-default" >
                                                                                                搜尋
                                                                                    </button>
                                                                                    <button id="page_searchclean_btn" style="border: 1px solid rgb(213, 213, 213); background-color: #eeeeee; color: black; text-shadow: 0px 0px 0px transparent; padding: 5px 14px;" class="btn btn-default" >
                                                                                                清除
                                                                                    </button>
                                                                        </div>
                                                                        <!--span style="font-size: 14px; float: right;">
                                                                                154個項目
                                                                        </span>
                                                                        <br>
                                                                        <div style="float: left; margin-top: 15px;">
                                                                                <label style="margin-right: 31px;" class="pos-rel">
                                                                                        <input type="checkbox" class="ace">
                                                                                        <span class="lbl"></span>
                                                                                </label>
                                                                                <div class="btn-group" style="margin-right: 40px">
                                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;">
                                                                                                操作
                                                                                                <i class="ace-icon fa fa-caret-down icon-on-right" style="margin-left: 10px"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>							
                                                                                        </ul>
                                                                                </div>
                                                                                <div style="margin-right: 5px;" class="btn-group">
                                                                                        <button style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;" class="btn btn-primary btn-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                                                所有日期
                                                                                                <i style="margin-left: 10px" class="ace-icon fa fa-caret-down icon-on-right"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>
                                                                                        </ul>
                                                                                </div>
                                                                                <div class="btn-group" style="margin-right: 5px;">
                                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;">
                                                                                                所有分類
                                                                                                <i class="ace-icon fa fa-caret-down icon-on-right" style="margin-left: 10px"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>
                                                                                        </ul>
                                                                                </div>
                                                                                <button style="border: 1px solid rgb(220, 220, 220); background-color: rgb(242, 242, 242); color: black; text-shadow: 0px 0px 0px transparent; padding: 5px 14px; margin-left: 10px;" class="btn btn-default" type="submit">
                                                                                    篩選
                                                                                </button>
                                                                        </div>
                                                                        <div class="btn-group" style="margin-top: 15px;">
                                                                                <button type="button" class="btn btn-default" aria-label="Left Align" style="background-color: rgb(238, 238, 238); border: 0.5px solid rgb(221, 221, 221); margin: 0px; text-shadow: 0px 0px 0px transparent; color: #7c7c7c; padding: 5px 10px;">
                                                                                        <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                                                                                </button>
                                                                                <button type="button" class="btn btn-default" aria-label="Justify" style="background-color: rgb(210, 210, 210); border: 0.5px solid #7c7c7c; padding: 5px 10px; margin: 0px; text-shadow: 0px 0px 0px transparent; color: #7c7c7c;">
                                                                                        <span class="glyphicon glyphicon-list " aria-hidden="true"></span>
                                                                                </button>
                                                                        </div-->
                                                                        <table cellspacing="0" cellpadding="0" border="0" style="table-layout: auto; float: right; position: absolute; margin-top: 27px; right: 5px;" class="ui-pg-table">
                                                                                <tbody>
                                                                                        <tr>
                                                                                                <td class="ui-pg-button ui-corner-all ui-state-disabled" id="prev_grid-pager" style="cursor: default; text-indent: 0px; background: #eeeeee">
                                                                                                        <span class="ui-icon ace-icon fa fa-angle-left bigger-140" style="text-indent: 0px; border: 0px none; background: #eeeeee ;color: #7c7c7c;">
                                                                                                        </span>
                                                                                                </td>
                                                                                                <!--td class="ui-pg-button ui-state-disabled" style="width:10px;">
                                                                                                        <span class="ui-separator"></span>
                                                                                                </td>
                                                                                                <td dir="ltr">
                                                                                                        <input type="text" class="ui-pg-input" size="2" maxlength="7" value="1" role="textbox" style="text-align: center; width: 45px; margin-right: 7px;">
                                                                                                        /
                                                                                                        <span id="sp_1_grid-pager" style="margin-left: 6px; font-size: 15px;">
                                                                                                            5
                                                                                                        </span>
                                                                                                </td>
                                                                                                <td class="ui-pg-button ui-state-disabled" style="width:10px;">
                                                                                                        <span class="ui-separator"></span>
                                                                                                </td-->
                                                                                                <td style="cursor: default; text-indent: 0px; background: #eeeeee" class="ui-pg-button ui-corner-all" id="next_grid-pager">
                                                                                                        <span class="ui-icon ace-icon fa fa-angle-right bigger-140" style="text-indent: 0px; border: 0px none; background: #eeeeee ;color: #7c7c7c;"></span>
                                                                                                </td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                </div>
                                                                
                                                                <div class="clearfix"></div>
                                                                
                                                                <hr>
                                                                
                                                                <div id="start">
                                                                    
                                                                </div>
                                                                
                                                                <div id="start_content">
                                                                    
                                                                </div>
                                                                
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                
                                                                
                                                        </div>
                                                </div>
                                                <div class="col-md-1 col-lg-1"></div>
                                        </div>
                                </div>
                        </div>
                </div>

                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                </a>
        </div>

        <?php include( "footer.php"); ?>

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


        <!-- the following scripts are used in demo only for onpage help and you don't need them -->
        <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
        <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

        <script type="text/javascript">
                ace.vars['base'] = '..';
        </script>
        <!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
                            
				//jquery tabs
                                if( $( "#tabs" ).length )
				$( "#tabs" ).tabs().show();
			});
		</script>
        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>

        <script src="js/create.js"></script>
        <script src="js/fb-login.js"></script>


        
        <script type="text/javascript">
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            
                            
                            $( "#fb-login-button" ).removeClass( "nav-search" );
                            
                            $("#pagecontent").css("display","block");
                    
                            $( "#loadingpage" ).hide();
                            
                            $( "#sidebar" ).show(); // tmp
                            //init();
                };

                function FB_unconnected_callback_init()
                {
                            $.member = "";
                            
                            //use_getbody();
                            $("#subscribe_button").css("display","none");
                            
                            
                            $( "#loadingpage" ).hide();
                            
                            $( "#sidebar" ).show(); // tmp
                            
                            
                            //init();
                };
                
                function FB_connected_callback_select_ttshow_db( data ) {
                }
       </script>
        
        <script type="text/javascript">

                //$.init_channel = getParameterByName( "ch" );
                $.init_channel = "" ;
                console.log( $.init_channel );
            
                $("document").ready(function() {
                            
                            // channel_search_btn
                            
                            channel();
                            $( "#channel_search_btn" ).unbind( "click" ).bind( "click", function(e) {
                                        channel();
                            });
                            
                            $( "#channel_searchclean_btn" ).unbind( "click" ).bind( "click", function(e) {
                                        $( "#channel_search" ).val( "" );
                                        channel();
                            });
                            


                            $.ajax({
                                        type: "POST",
                                        url: "php/json_list_channel_sub_click.php",
                                        data: {
                                                    channel_id    : $.init_channel
                                        },
                                        //dataType: "json",
                                        success: function( data )
                                        {
                                                    if( data !== "false" )
                                                    {
                                                                data = JSON.parse( data );
                                                                $( "#day_click" ).html( data.num_click );
                                                                $( "#all_click" ).html( data.num_click );
                                                                $( "#all_follow" ).html( data.subscribe_num );
                                                                $( "#pagecontent" ).show();
                                                    }
                                        }
                            });
                            
                            $.ajax({
                                        type: "POST",
                                        url: "php/category.php?func=list",
                                        data: {
                                        },
                                        //dataType: "json",
                                        success: function( data ) {

                                                    console.log( data );

                                                    var tmp_html = '' ;
                                                    tmp_html += '<hr style="margin: 0px 0px 8px; border: 0.5px solid #e7e6e7;">' ;
                                                    tmp_html += '<button tab_index="" page_type="common" style="border: 1px solid white; background-color: white ! important; color: blue; padding: 0px; font-size: 16px; width: 5%;" type="button" class="btn btn-sm col-xs-3 btn-primary">全部</button>' ;
                                                    $.each( eval(data) , function( index , value ){

                                                                tmp_html += '<button tab_index="' + value.id + '" style="font-size: 15px; border: 1px solid white; width: 5%; background-color: white ! important; color: gray; padding: 0px;" type="button" class="btn btn-sm col-xs-3 btn-primary">' + value.name + '</button>' ;

                                                    });
                                                    
                                                    tmp_html += '<div class="clearfix"></div>' ;
                                                    tmp_html += '<hr style="margin: 6px 0px 0px; border: 0.5px solid #e7e6e7;">' ;
                                                    $( "#start" ).html( tmp_html );
                                                    
                                                    $.page_type = "common" ;
                                                    $( "[page_type]" ).unbind( "click" ).bind( "click", function(e) {
                                                                    $.page_type = $( this ).attr( "page_type" ) ;
                                                                    
                                                                    if( $( "[tab_index][hasselected=1]" ).length == 0 )
                                                                    $( "[tab_index]" ).eq(0).trigger( "click" );
                                                                    else
                                                                    $( "[tab_index][hasselected=1]" ).trigger( "click" );
                                                    });
                                                    
                                                    

                                                    $( "[tab_index]" ).unbind( "click" ).bind( "click", function(e) {
                                                                    
                                                                    $( "[tab_index]" ).attr( "hasselected" , "0" );
                                                                    $( "[tab_index]" ).css( "color" , "gray" );
                                                                    $( this ).attr( "hasselected" , "1" );
                                                                    $( this ).css( "color" , "blue" );
                                                                    
                                                                    $.nuw_page_num      = 1 ;
                                                                    $.nuw_page_num_c    = 5 ;
                                                                    $.class             = $( this ).attr( "tab_index" ) ;
                                                                    
                                                                    page();
                                                    });
                                                    
                                                    
                                                    //$( "[page_type]" ).eq(0).trigger( "click" );
                                        }
                            });
                            
                            
                            
                });
                function page()
                {

                            $.ajax({
                                        type: "POST",
                                        url: "php/json_list_categorypage_channel.php",
                                        data: {
                                                    user        : $.member.email , //"bala.soho.tw@gmail.com"  ,
                                                    page_num    : $.nuw_page_num_c ,
                                                    page        : $.nuw_page_num ,
                                                    class       : $.class ,
                                                    channel_id  : $.init_channel ,
                                                    page_type   : $.page_type ,
                                                    search      : $( "#page_search" ).val().toString()
                                        },
                                        //dataType: "json",
                                        success: function(data) {

                                                    if( data !== "false" )
                                                    {
                                                                data = JSON.parse( data );
                                                                console.log( data );
                                                                var tmp = "";

                                                                var check_status = "manager" ; // $( "#categorypage [create].active" ).attr( "create" );
                                                                if( check_status === "upright" )
                                                                    var func = function( a , b ){  return create_upright( a , "col-xs-12 col-sm-6 col-md-6 col-lg-6" ); } ;
                                                                else if( check_status === "list" )
                                                                    var func = function( a , b ){  return create_list( a , "col-xs-12 col-sm-12 col-md-12 col-lg-12" , "margin-bottom : 10px;" , false ); } ;
                                                                else if( check_status === "chessboard" )
                                                                    var func = function( a , b ){  return create_chessboard( a , "col-xs-3 col-sm-3 col-md-3 col-lg-3" ); } ;
                                                                else if( check_status === "manager" )
                                                                    var func = function( a , b ){  return create_manager( a , "col-xs-6 col-sm-6 col-md-6 col-lg-8" ); } ;


                                                                $.each( data , function( index , value ){

                                                                        //$.category_data[ $.category_data.length ] = value;
                                                                        tmp += func( value );

                                                                });
                                                                $( "#start_content" ).html( tmp );

                                                                $( "#start_content" ).find( "[id=list_article_icon]" ).unbind( "click" ).bind( "click", function(e) {
                                                                                window.open( "page-inner.php?page_id=" + $( this ).attr( "page" ) );
                                                                                //location.href = "page-inner.php?page_id=" + $( this ).find( "[page]" ).attr( "page" );
                                                                });

                                                                if( $.nuw_page_num == 1 )
                                                                {
                                                                            $( "#prev_grid-pager" ).hide();
                                                                }else{
                                                                            $( "#prev_grid-pager" ).show();
                                                                }
                                                                $( "#prev_grid-pager" ).unbind( "click" ).bind( "click", function(e) {

                                                                            $.nuw_page_num      = $.nuw_page_num - 1 ;
                                                                            page();
                                                                });

                                                                if( $( "#start_content" ).find( "[id=list_article_icon]" ).length < 5 )
                                                                {
                                                                            $( "#next_grid-pager" ).hide();
                                                                }else{
                                                                            $( "#next_grid-pager" ).show();
                                                                }
                                                                $( "#next_grid-pager" ).unbind( "click" ).bind( "click", function(e) {

                                                                            $.nuw_page_num      = $.nuw_page_num + 1 ;
                                                                            page();
                                                                });

                                                                $( "#page_search_btn" ).unbind( "click" ).bind( "click", function(e) {
                                                                            page();
                                                                });
                                                                $( "#page_searchclean_btn" ).unbind( "click" ).bind( "click", function(e) {
                                                                            $( "#page_search" ).val( "" );
                                                                            page();
                                                                });

                                                                $( "#start_content" ).find( "[id=page_display]" ).unbind( "click" ).bind( "click", function(e) {
                                                                    
                                                                                var tmp_page_id = $(this).attr( "page" );
                                                                                
                                                                                if( $(this).attr( "display" ) == "上架中" )
                                                                                {
                                                                                            var pos = $(this);
                                                                                            $.ajax({
                                                                                                        type    : "POST",
                                                                                                        url     : "php/manage_page.php",
                                                                                                        async   : true ,
                                                                                                        data : { 
                                                                                                                    cmd     :   "display" ,
                                                                                                                    obj :   {
                                                                                                                                page_id : tmp_page_id ,
                                                                                                                                display : "none" 
                                                                                                                    }
                                                                                                        },
                                                                                                        success: function( data )
                                                                                                        {
                                                                                                                    console.log( data );
                                                                                                                    if( data === "1" ) {
                                                                                                                        pos.attr( "display" , "下架中" ).html( "下架中" ).removeClass( "red-button" ).addClass( "green-button" );
                                                                                                                    }
                                                                                                        }
                                                                                            });
                                                                                    
                                                                                }else{
                                                                                            var pos = $(this);
                                                                                            
                                                                                            $.ajax({
                                                                                                        type    : "POST",
                                                                                                        url     : "php/manage_page.php",
                                                                                                        async   : true ,
                                                                                                        data : { 
                                                                                                                    cmd     :   "display" ,
                                                                                                                    obj :   {
                                                                                                                                page_id : tmp_page_id ,
                                                                                                                                display : "" 
                                                                                                                    }
                                                                                                        },
                                                                                                        success: function( data )
                                                                                                        {
                                                                                                                    console.log( data );
                                                                                                                    if( data === "1" ) {
                                                                                                                        pos.attr( "display" , "上架中" ).html( "上架中" ).removeClass( "green-button" ).addClass( "red-button" );
                                                                                                                    }
                                                                                                                    else if( data === "channel display none" ) {
                                                                                                                        alert( "頻道未上架" );
                                                                                                                    }
                                                                                                        }
                                                                                            });
                                                                                }
                                                                                
                                                                });
                                                                
                                                                $( "#start_content" ).find( "[id=page_chart]" ).unbind( "click" ).bind( "click", function(e) {
                                                                                alert(123);
                                                                });
                                                                $( "#start_content" ).find( "[id=page_modity]" ).unbind( "click" ).bind( "click", function(e) {
                                                                                window.open( "editor.php?page=" + $( this ).attr( "page" ) );
                                                                });
                                                                $( "#start_content" ).find( "[id=page_delete]" ).unbind( "click" ).bind( "click", function(e) {

                                                                                $( "#deletedialogyes" ).attr( "page" , $(this).attr( "page" ) );
                                                                                            
                                                                                $( "#deletedialogyes" ).unbind( "click" ).bind( "click", function(e) {
                                                                                            
                                                                                            var tmp_page_id = $(this).attr( "page" );
                                                                                            
                                                                                            $.ajax({
                                                                                                        type    : "POST",
                                                                                                        url     : "php/manage_page.php",
                                                                                                        async   : true ,
                                                                                                        data : { 
                                                                                                                    cmd     :   "delete" ,
                                                                                                                    obj :   {
                                                                                                                                page_id : tmp_page_id
                                                                                                                    }
                                                                                                        },
                                                                                                        success: function( data )
                                                                                                        {
                                                                                                                    page();
                                                                                                                    $( "#deletedialog" ).modal( "hide" );
                                                                                                                    
                                                                                                        }
                                                                                            });
                                                                                });
                                                                                
                                                                                $( "#deletedialogno" ).unbind( "click" ).bind( "click", function(e) {
                                                                                            $( "#deletedialog" ).modal( "hide" );
                                                                                });
                                                                                
                                                                                $( "#deletedialog" ).modal( "show" );
                                                                                
                                                                });
                                                                
                                                                
                                                                

                                                    }
                                                    else
                                                    {
                                                                $( "#start_content" ).html( "" );
                                                                //$( "#loading_icon" ).css( "visibility" , "hidden" );
                                                    }
                                        }
                            });

                    
                }
                
                function channel()
                {

                            $.ajax({
                                        type    : "POST",
                                        url     : "php/html_list_channel.php",
                                        async   : true ,
                                        data : { 
                                                    cmd         :   "list" ,
                                                    search      :   $( "#channel_search" ).val()
                                        },
                                        success: function( data )
                                        {
                                                console.log( data );
                                                if( data == null )
                                                {
                                                            alert( 'no result' );

                                                }else{

                                                            var tmp_html = '' ;
                                                            tmp_html += '<option value=""></option>' ;
                                                            $.each( eval(data) , function( index , value ){
                                                                        console.log( value );
                                                                        tmp_html += '<option value="' + value.id + '">' +  value.username + ' - ' + value.channelname + '</option>' ;
                                                            });

                                                            $( "#channel_list" ).html( tmp_html );

                                                            $( "#channel_list" ).unbind( "change" ).bind( "change", function(e) {
                                                                        console.log( e );
                                                                        $.init_channel = $(this).val() ;
                                                                        $( "[page_type]" ).eq(0).trigger( "click" );
                                                            });
                                                }
                                        }
                            });
                }
                
                
        </script>

</body>

</html>
