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
                    
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="breadcrumbs col-xs-12 col-sm-12 col-md-12 col-lg-12" id="breadcrumbs" style="background: none repeat scroll 0% 0% white; margin: 20px; width: 97%;">
                                       <script type="text/javascript">
                                               try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                                       </script>
                                       <ul class="breadcrumb">
                                           <li>
                                               <i class="ace-icon fa fa-home home-icon"></i>
                                               <a href="#">首頁</a>
                                           </li>
                                           <li class="active">投稿管理</li>
                                       </ul>
                                </div>
                        </div>
                        
                        <div class="col-xs-12">
                                <div class="col-xs-12" style="background: white none repeat scroll 0% 0%; width: 100%; padding: 10px; margin: 20px;">
                                    <table style="width: 100%" id="place" class="table-striped">
                                        <thead style="">
                                            <tr style="background-color: #ABBAC3;" role="row">
                                                <th>投稿人</th>
                                                <th>投稿人名字</th>
                                                <th>投稿人信箱</th>
                                                <th>標題</th>
                                                <th>投稿封面</th>
                                                <th>投稿時間</th>
                                            </tr>
                                        </thead>
                                        <tbody style="top: 10px; position: relative;">

                                        </tbody>

                                    </table>
                                </div>
                        </div>
                </div>

                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                </a>
        </div>
        
        <div class="remodal-overlay modal fade in" id="myModalCreation" style="" aria-hidden="false">
                <div class="remodal modal-dialog modal-lg">
                        <div class="modal-content">
                                <div class="modal-body" style="padding: 25px; width: 100%; height: 100%;">
                                        
                                        <img class="close" src="images/x-black.png" style="position: absolute; opacity: 1; right: 5px; top: 5px; margin: 0px; height: 20px;" data-dismiss="modal">
                                        <h4 class="modal-title" style="font-weight: bold; font-size: 18px; margin-top: 10px;"><c name='channel_name'></c> 投稿資訊</h4>
                                        
                                        <div class="col-xs-12 content" style="margin-top: 5px;">
                                            
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                </div>
                        </div>
                </div>
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
                            
                            $("#pagecontent").css("display","block");
                    
                            $( "#loadingpage" ).hide();
                            
                            $( "#sidebar" ).show(); // tmp
                            init();
                };

                function FB_unconnected_callback_init()
                {
                            $.member = "";
                            
                            
                            
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
            
                $("document").ready(function() {
                            
                            
                            
                });
                
                function init(){
                    
                        
                        
                        $.ajax({
                                        type: "POST",
                                        url: "php/contribute_list.php",
                                        data: {
                                                    user        : $.member.email
                                        },
                                        //dataType: "json",
                                        success: function(data) {
                                                
                                                if( data !== "false" ) {
                                                    
                                                    data = JSON.parse( data );
                                                    console.log( data );
                                                    $( "#place tbody" ).html( "" );
                                                    var html = "";
                                                    $.each( data , function( index , value ){
                                                            
                                                            if( value.article_icon.search( "http" ) === -1 )
                                                                value.article_icon = "http://ttshow.tw/ttshow/contribute/" + value.contribute_id + "/ThumbnailS/" + value.article_icon;
                                                            
                                                            html = '<tr style="height: 120px;" class="odd child-middle" role="row" con="' + value.contribute_id + '">' +
                                                                        '<td class="center">' +
                                                                            '<div style="background-image: url(\'' + value.usericon + '\'); cursor: pointer; width: 100px; height: 100px; margin: 0px; left: 7%;" class="bg_top"></div>' +
                                                                        '</td>' +
                                                                        '<td style="font-size: 15px">' + value.user_name + '</td>' +
                                                                        '<td style="font-size: 15px">' + value.user_email + '</td>' +
                                                                        '<td style="font-size: 15px">' + value.title + '</td>' +
                                                                        '<td style="font-size: 15px">' +
                                                                            '<div style="background-image: url(\'' + value.article_icon + '\'); cursor: pointer; width: 100px; height: 100px; margin: 0px; left: 7%;" class="bg_top"></div>' +
                                                                        '</td>' +
                                                                        '<td style="font-size: 15px">' + value.date + '</td>' +
                                                                    '</tr>';
                                                            $( "#place tbody" ).append( html );
                                                            $( "#place tbody tr:last" ).data( "html" , value.html );
                                                    });
                                                    
                                                    
                                                    $( "#place tbody tr" ).unbind( "click" ).bind( "click" , function(){
                                                            
                                                            var con = $( this ).attr( "con" );
                                                            var html = $( this ).data( "html" );
                                                            $( "#myModalCreation .content" ).html( html );
                                                            $( "#myModalCreation" ).modal( "show" );
                                                            
                                                    });
                                                    
                                                }
                                                
                                        }
                        });
                }
                
        </script>

</body>

</html>
