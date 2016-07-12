<html lang="en">

        <head>
                
                <script src="js/google_analytics.js"></script>
                

                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow - 頻道總攬</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">

                <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


                <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->
                <link rel="stylesheet" href="template/assets/css/ace.css" />
                <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />

                <script src="template/assets/js/jquery.js"></script>
                <script src="js/device.js"></script>
                <script src="js/create.js"></script>
                <script src="template/assets/js/ace-extra.js"></script>

                <style>

                        #homepagecontent p.pagebg:hover {

                                color: rgb(76, 143, 189);

                        }

                        .index-tittle h1 {
                                color: #2679b5;
                                font-size: 24px;
                                font-weight: lighter;
                                margin: 0 8px;
                                padding: 0;
                        }
                        .page-content hr{
                            margin-top: 30px;
                            margin-bottom: 30px;
                        }
                </style>

                <style>
                    @media (max-width: 991px) {
                        .homepage_text {
                            color: rgb(45,45,45);
                            overflow-y: hidden;
                            margin: 6px 0px;
                            font-size: 12pt;
                            line-height: 20px;
                            height: 40px;
                            position: relative;
                            word-break: break-all;
                            margin-top: 5px;
                        }
                    }
                    @media (min-width: 990px) {
                        .homepage_text {
                            color: rgb(45,45,45);
                            overflow-y: hidden;
                            margin: 6px 0px;
                            font-size: 15pt;
                            line-height: 20px;
                            height: 40px;
                            position: relative;
                            word-break: break-all;
                        }
                    }
                </style>
        </head>

        <body class="no-skin">

            <?php include( "header_2.php"); ?>

            <div class="main-container" id="main-container2" style="background-color: white;">

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
                                            <li class="active">頻道管理</li>
                                        </ul>
                                </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-xs-12">
                                <div style="background: none repeat scroll 0% 0% white; width: 100%; padding: 10px; margin-bottom: 20px;">

                                        <table class="table-striped new-btn-group" id="dynamic-table" style="width: 100%">
                                            <thead style="">
                                                <tr role="row" style="background-color: #ABBAC3;">
                                                    <th>頻道</th>
                                                    <th></th>
                                                    <th>身分</th>
                                                    <th>加入日期</th>
                                                    <th>訂閱數</th>
                                                    <th>總瀏覽數</th>
                                                    <th>狀態</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>

                                            <tbody style="top: 10px; position: relative;">

                                            </tbody>
                                        </table>

                                        <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                                <img src="template/assets/images/loading.gif" name="load_img">
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <div style="display: none;" class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                            <div class="modal-content">

                                    <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                    </span>
                                                    <span class="sr-only">Close</span>
                                            </button>
                                            <h3 class="modal-title" id="myModalLabel">刪除頻道資料</h3>
                                    </div>

                                    <div class="modal-body">
                                            <h1 style="color:red;">請注意刪除就無法還原，頻道發布文章也會刪除</h1>
                                            <div style="font-size: 15pt; margin-bottom: 15px;">是否刪除此頻道資料：</div>
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
                                        <button id="myModalDeleteChannal_Yes" style="border-radius: 5px" class="btn btn-primary">確 認</button>
                                        <button style="border-radius: 5px" class="btn btn-primary" data-dismiss="modal">取 消</button>
                                    </div>
                            </div>
                    </div>
            </div>
            
            <?php include( "footer.php"); ?>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>

            <script type="text/javascript">
                if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
            </script>
            <script src="template/assets/js/bootstrap.js"></script>

            <script src="template/assets/js/jquery-ui.js"></script>
            <script src="template/assets/js/jquery.ui.touch-punch.js"></script>

            <script src="template/assets/js/ace/ace.js"></script>
            <script src="template/assets/js/ace/ace.sidebar.js"></script>

            <script type="text/javascript">
                jQuery(function($) {

                        //jquery tabs
                        if ( $("#tabs").length )
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

            <script src="js/ajaxq.js"></script>
            <script type="text/javascript">


                    $("document").ready(function() {




                    });

                    function FB_connected_callback_init( response )
                    {
                                $.member = response;

                                $( "#main-container" ).show();

                                init_scroll();

                    };

                    function FB_unconnected_callback_init()
                    {
                                $.member = { facebook_mail : "" , email : "" };

                                $( "#main-container" ).show();
                                Login_Popup_show();

                    };

                    function unlogin_jump()
                    {
                                location.href = "index.php";
                    }

                    function init_scroll() {

                                getbody();

                    }

                    function getbody(){

                            $( "#loading_icon" ).css( "visibility" , "visible" );

                            $.ajax({
                                    type: "POST",
                                    url: "php/channel.php?func=overview",
                                    data: {
                                        ttshow : getCookie( "ttshow" )
                                    },
                                    success: function(data) {

                                        $( "#loading_icon" ).css( "visibility" , "hidden" );

                                        if( data !== "false" )
                                        {
                                                data = JSON.parse( data );
                                                console.log( data );
                                                var tmp= "";

                                                $.each( data , function( index , value ){
                                                        
                                                        var display = ( value.display === "" ) ? '<button ch="' + value.channel_id + '" display="display" class="btn btn-xs green-button">上架</button>' : '<button ch="' + value.channel_id + '" display="none" class="btn btn-xs red-button">下架</button>';
                                                        
                                                        tmp += '<tr style="height: 120px;" class="odd child-middle" role="row" ch="' + value.channel_id + '">' +
                                                                    '<td class="center">' +
                                                                        '<a href="cooperate.php?ch=' + value.channel_id + '">' +
                                                                                '<div style="background-image: url(\'' + value.ch_icon + '\'); cursor: pointer; width: 100px; height: 100px; margin: 0px; left: 7%;" class="bg_top"></div>' +
                                                                        '</a>' +
                                                                    '</td>' +
                                                                    '<td style="font-size: 15px">' + value.ch_name + '</td>' +
                                                                    '<td style="font-size: 15px">' + value.ch_type + '</td>' +
                                                                    '<td style="font-size: 15px">' + value.registration_time + '</td>' +
                                                                    '<td style="font-size: 15px">' + value.subscribe_count + '</td>' +
                                                                    '<td style="font-size: 15px">' + value.num_click + '</td>' +
                                                                    '<td style="font-size: 15px">' +
                                                                        display +
                                                                    '</td>' +
                                                                    '<td style="font-size: 15px" class="child-inline">' +
                                                                        '<a href="editor.php?ch=' + value.channel_id + '"><button style="margin: 5px;" class="btn btn-xs blue-button">發表創作</button></a>' +
                                                                        '<a href="channel_setting_manager.php?ch=' + value.channel_id + '"><button style="margin: 5px;" class="btn btn-xs blue-button">頻道設定</button></a>' +
                                                                        '<button ch="' + value.channel_id + '" style="margin: 5px;" class="btn btn-xs blue-button delete">刪除頻道</button>' +
                                                                    '</td>' +
                                                                '</tr>';

                                                });

                                                $( "#dynamic-table tbody" ).html(tmp);
                                                delete_event();
                                                display_event();
                                                
                                        }
                                        else
                                        {
                                                $( "#dynamic-table tbody" ).html("");
                                        }

                                    }
                            });

                    }
                    
                    function delete_event(){
                        
                        $( "#dynamic-table tbody .delete" ).unbind( "click" ).bind( "click" , function(){
                                
                                $("#deleteModal").attr( "channel_id" , $( this ).attr( "ch" ) );
                                $("#deleteModal").modal( "show" );
                                
                        });
                        
                    }
                    
                    function display_event(){
                        
                        $( "#dynamic-table tbody [display]" ).unbind( "click" ).bind( "click" , function(){
                                
                                var pos = $( this );
                                var ch = pos.attr( "ch" );
                                var display = pos.attr( "display" );
                                if( display === "display" )
                                    display = "hide";
                                else if( display === "none" )
                                    display = "show";
                                
                                $.ajax({
                                    type: "POST",
                                    url: "php/channel.php?func=display",
                                    data: {
                                        ttshow : getCookie( "ttshow" ) ,
                                        ch : ch ,
                                        display : display
                                    },
                                    success: function(data) {
                                        console.log( data );
                                        if( data !== "false" )
                                        {
                                            if( data === "none" )
                                            {
                                                pos.attr( "display" , "none" );
                                                pos.html( "下架" );
                                                pos.removeClass( "green-button" );
                                                pos.addClass( "red-button" );
                                                
                                            }
                                            else if( data === "display" )
                                            {
                                                pos.attr( "display" , "display" );
                                                pos.html( "上架" );
                                                pos.removeClass( "red-button" );
                                                pos.addClass( "green-button" );
                                                
                                            }
                                        }
                                        
                                    }
                                });
                                
                        });
                        
                    }
                    
                    $('#deleteModal')
                    .on('show.bs.modal', function (e) {
                    })
                    .on('hidden.bs.modal', function (e) {
                            $("#deleteModal").attr("channel_id" , "");
                    });
                    
                    $("#myModalDeleteChannal_Yes").unbind('click').bind( 'click' , function(e) {
                            
                            var channel_id = $("#deleteModal").attr("channel_id");
                            var callback = function(data) {
                                console.log(data);
                                var data = JSON.parse( data );
                                if( data ) {
                                    $( "#deleteModal" ).modal( "hide" );
                                    $( "#dynamic-table tbody tr[ch=" + channel_id + "]" ).remove();
                                } else {
                                    console.log(data);
                                }
                            }
                            var data = {
                                func : "delete",
                                email : $.member.email ,
                                channel_id : channel_id
                            }
                            $.Ajax( "POST" , "php/channel.php" , data , {} , callback , "" );
                    });

                </script>
                <script src="js/fb-login.js"></script>
                <script src="https://apis.google.com/js/platform.js"></script>

        </body>

</html>
