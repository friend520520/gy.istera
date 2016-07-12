<!DOCTYPE html>
<html lang="en">
        <head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow - 我的收藏</title>
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

	<body class="no-skin">
        <!-- #section:basics/navbar.layout -->
            <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>

            <?php include( "header_1.php"); ?>

            <div class="main-container" id="main-container" style="background-color: white;">

                    <?php include("sidebar.php"); ?>
                
                    <div class="main-content" style="background-color: rgb(242, 242, 242); margin-left: 190px;">
                            <div class="main-content-inner" style="padding: 20px 20px 0px 10px;">
                                    
                                    <div class="col-xs-12">
                                            <div style="background: none repeat scroll 0% 0% white; width: 100%; padding: 10px; margin-bottom: 20px;">
                                                    <ul style="margin: 0px; padding: 0px;" class="breadcrumb">
                                                        <li>
                                                            <i class="ace-icon fa fa-home home-icon"></i>
                                                            <a href="#">首頁</a>
                                                        </li>
                                                        <li class="active">我的收藏</li>
                                                    </ul>
                                            </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    
                                    <div class="col-xs-12">
                                            <div style="background: none repeat scroll 0% 0% white; width: 100%; padding: 10px; margin-bottom: 20px;">
                                                    
                                                    <button aria-expanded="false" title="Nothing selected" data-toggle="dropdown" class="" type="button" style="background-color: Transparent; border: 1px solid rgb(221, 221, 221); padding: 5px 10px; border-radius: 7px; color: gray; margin-left: 20px;">
                                                        <span class="filter-option pull-left">全部清除</span>
                                                    </button>

                                                    <hr style="margin: 18px;">

                                                    <div id="place" style="margin: 18px;">
                                                    </div>

                                                    <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                                            <img src="template/assets/images/loading.gif" name="load_img">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>

            <div style="display: none;" class="modal fade" id="myModalDeleteCollect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                            <div class="modal-content">

                                    <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                    </span>
                                                    <span class="sr-only">Close</span>
                                            </button>
                                            <h3 class="modal-title" id="myModalLabel">刪除收藏資料</h3>
                                    </div>

                                    <div class="modal-body">
                                            <div style="font-size: 15pt; margin-bottom: 15px;">是否刪除此收藏資料：</div>
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
                                        <button id="myModalDeleteCollect_Yes" style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">確 認</button>
                                        <button style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">取 消</button>
                                    </div>
                            </div>
                    </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
                        </i>
            </a>

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


            <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
            <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

            <script type="text/javascript">
                    ace.vars['base'] = '..';
            </script>

            <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>


            <script type="text/javascript">
                    $("document").ready(function() {

                            $( "#loadingpage" ).hide();

                    });

                    function FB_connected_callback_init( response )
                    {
                                $.member = response;

                                $( "#main-container" ).show();
                                $( "#place" ).html( "" );

                                init_scroll();
                    }

                    function FB_unconnected_callback_init()
                    {
                                $.member = { email : "" };
                                $( "#main-container" ).hide();

                                $( "#place" ).html( "" );
                                Login_Popup_show();

                    };

                    function unlogin_jump()
                    {
                                location.href = "index.php";
                    }
                    
                    function init_scroll() {

                                $.nuw_page_num = 1 ;

                                $( "#place" ).html("");

                                $( window ).unbind( "scroll" ).bind( "scroll" , function(){
                                        DisplayCurrentScroll(); 
                                });
                                $( "#loading_icon" ).show();
                                

                                getbody();

                    }

                    function DisplayCurrentScroll() {

                                if( $( "body" )[0].scrollTop >= $( "html" )[0].scrollTop )
                                    var tmp_div = $( "body" )[0] ;
                                else
                                    var tmp_div = $( "html" )[0] ;

                                var tmp_persent = tmp_div.scrollTop / (tmp_div.scrollHeight - tmp_div.clientHeight);

                                if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#pagecontent_body").children(":eq(0)").height()*6 )
                                {
                                        if (!$.loading)
                                        {
                                            $( "#loading_icon" ).css( "visibility" , "visible" );
                                            $.loading = 1;
                                            $.tpathqueue = setTimeout(function() {
                                                $.nuw_page_num++;
                                                getbody();
                                            }, 500);
                                        }
                                }

                    }

                    function getbody(){
                            
                            $( "#loading_icon" ).css( "visibility" , "visible" );
                            
                            $.ajax({
                                    type: "POST",
                                    url: "php/json_list_get_collect.php",
                                    data: {
                                        user : $.member.email ,
                                        page_num: "16" ,
                                        page: $.nuw_page_num ,
                                    },
                                    //dataType: "json",
                                    success: function(data) {
                                        
                                        $( "#loading_icon" ).css( "visibility" , "hidden" );
                                        
                                        if( data !== "false" )
                                        {
                                                var tmp = "";
                                                data = JSON.parse( data );
                                                
                                                $.each( data , function( index , value ){
                                                        
                                                        tmp += create_upright( value , "col-xs-12 col-sm-12 col-md-6 col-lg-4" , true );
                                                        
                                                });
                                                
                                                $( "#place" ).append( tmp );

                                                collect_subscribe_event();
                                                delete_event();
                                                
                                                $( "#loading_icon" ).css( "visibility" , "hidden" );
                                                DisplayCurrentScroll ();
                                        }
                                        else
                                        {
                                                $( window ).unbind( "scroll" );
                                                $( "#loading_icon" ).hide();
                                        }
                                        $.loading = 0;

                                    }
                            });

                    }
                    
                    function delete_event(){
                        
                        $( "#place .delete" ).unbind( "click" ).bind( "click" , function(){
                                
                                $("#myModalDeleteCollect").attr( "collect_id" , $( this ).parents( "[article]" ).attr( "article" ) );
                                $("#myModalDeleteCollect").modal( "show" );
                                
                        });
                        
                    }
                    
                    $('#myModalDeleteCollect')
                    .on('show.bs.modal', function (e) {
                    })
                    .on('hidden.bs.modal', function (e) {
                            $("#myModalDeleteCollect").attr("collect_id" , "");
                    });
                    
                    $("#myModalDeleteCollect_Yes").unbind('click').bind( 'click' , function(e) {
                            var callback = function(data) {
                                var data = JSON.parse( data );
                                if( data.success ) {
                                    $("#place [article='" + data.collect_id + "']").remove();
                                } else {
                                    console.log(data);
                                }
                            }
                            var data = {
                                cmd : "delete",
                                data : {
                                    email : $.member.email ,
                                    collect_id : $("#myModalDeleteCollect").attr( "collect_id")
                                }
                            }
                            $.Ajax( "POST" , "php/manage_collect.php" , data , {} , callback , "" );
                    });
                    
            </script>

            <script src="js/fb-login.js"></script>

</body>

</html>
