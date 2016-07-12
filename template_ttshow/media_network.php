<!DOCTYPE html>
<html lang="en">

<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-自媒體聯播網</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">
        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        
        <link href="http://fundesigner.net/wp-content/uploads/2012/07/1_thumb7.png" rel="image_src" type="image/png">
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->
        <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="template/assets/css/owl.carousel.css" />
        <link rel="stylesheet" href="template/assets/css/owl.theme.css" />

        <script src="template/assets/js/jquery.js"></script>
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        
        <!--script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script-->
        
        <script src="template/assets/js/owl.carousel.js"></script>
        
        <script>
                $.init_tab = getParameterByName( "tab" );
                console.log( $.init_tab );
        </script>
        
        <!-- ace settings handler -->
        <script src="template/assets/js/ace-extra.js"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
		<script src="template/assets/js/html5shiv.js"></script>
		<script src="template/assets/js/respond.js"></script>
		<![endif]-->
        <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
        <style>
                
                @media (max-width: 1200px) {
                    #homepageheader > .homepageheader_small {
                        margin-top: 52.3%;
                    }

                    #homepageheader:after {
                            content: ""!important;
                            display: block!important;
                            padding-bottom: 52.3% !important;
                    }
                }
                
                @media (min-width: 1200px) {
                    #homepageheader > .homepageheader_small {
                        margin-left: 50%;
                    }

                    #homepageheader:after {
                            content: ""!important;
                            display: block!important;
                            padding-bottom: 26.15% !important;
                    }
                }
                
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
        <!--div name="responsive_div" class="col-md-6 col-xs-12" style="text-align: center; margin-right: auto; margin-left: auto; position: relative; float: none">
            <div style="margin-left: auto; margin-right: auto; height: 100%; width:100%;"></div>
        </div-->

        <!-- design by al -->
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
                .page-content hr{ /* AL 0420 edit*/
                    margin-top: 30px;
                    margin-bottom: 30px;
                }
        </style>

        <style>
            ._active {
                background-color: rgb(42, 104, 168);
                color: white;
            }
        </style>
        
</head>

<body style="padding: 0px;">
    <!-- #section:basics/navbar.layout -->
    <!--div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div-->
    <?php include( "header_1.php"); ?>
    
    <div class="main-container" id="main-container" style="background-color: white;">
        <div style="padding: 0px 85px; background-color: white;">

            <!--div id="channel_type" style="width: 100%;">
                <div id="page_type" style="font-size: 15px; padding: 8px 0px;">
                    <span ch_type="all" style="padding: 5px 10px;" class="_active">全部</span>
                    <span ch_type="導演" style="padding: 5px 10px;">導演</span>
                    <span ch_type="插畫家" style="padding: 5px 10px;">插畫家</span>
                    <span ch_type="編劇" style="padding: 5px 10px;">編劇</span>
                    <span ch_type="官方" style="padding: 5px 10px;">官方</span>
                    <span ch_type="演員" style="padding: 5px 10px;">演員</span>
                </div>
            </div 0730email8-->

            <div id="top_rank">
                <div style="width: 20%; float: left;">
                    <div class="chessboard-bgcenter" style="background-image: url(); height: 100%; padding-top: 100%;">
                    </div>
                </div>
                <div style="width: 20%; float: left;">
                    <div class="chessboard-bgcenter" style="background-image: url(); height: 100%; padding-top: 100%;">
                    </div>
                </div>
                <div style="width: 20%; float: left;">
                    <div class="chessboard-bgcenter" style="background-image: url(); height: 100%; padding-top: 100%;">
                    </div>
                </div>
                <div style="width: 20%; float: left;">
                    <div class="chessboard-bgcenter" style="background-image: url(); height: 100%; padding-top: 100%;">
                    </div>
                </div>
                <div style="width: 20%; float: left;">
                    <div class="chessboard-bgcenter" style="background-image: url(); height: 100%; padding-top: 100%;">
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div id="ch_list" style="width: 100%; margin-top: 30px">
            </div>

            <div class="clearfix"></div>

            <div id="loading_icon" style="visibility: hidden; width: 100%; text-align: center; margin-bottom: 0.79%;">
                    <img style="margin: 30px 0px" name="load_img" src="template/assets/images/loading.gif">
            </div>

            <div id="channel_list_modal_example" style="display: none; width: 16%; float: left; position: relative; margin-bottom: 0.79%;">
                <div>
                    <a id="link" href="#">
                        <div id="bg" class="chessboard-bgcenter" style="height: 100%; padding-top: 100%;"></div>
                    </a>
                    <div class="cover-black-small_" style="position: absolute; bottom: 0px;"></div>
                    <div style="color: white; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px;">
                        <div style="color: white; left: 0px; bottom: 0px; position: absolute; padding-left: 20px;"> 
                            <h5 id="ch_type_below" style="margin-bottom: 5px;">演員</h5>
                            <a id="link" href="#">
                                <h3 id="ch_name_below" style="color: white;">汝汝與杉杉的魔法小舖汝汝與杉杉的魔法小舖</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="top_rank_modal_example" style="display: none; width: 20%; float: left;">
                <a id="link" href="#">
                    <div id="icon" class="chessboard-bgcenter" style="background-image: url(); height: 100%; padding-top: 100%;">
                    </div>
                </a>
            </div>

        </div>
    </div>
    <!--?php include( "footer.php"); ?-->
    
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
    </script>
    <script src="template/assets/js/bootstrap.js"></script>

    <!-- page specific plugin scripts -->
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

    <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
    <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

    <script type="text/javascript">
        ace.vars['base'] = '..';
    </script>


    <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>

    <script src="js/ajaxq.js"></script>
    <script type="text/javascript">

        $("document").ready(function() {
                    
                    $.GetData = true;
                    $.get_list = function() {
                            $.ajax({
                                    type: "POST",
                                    url: "php/manage_channel.php",
                                    data: {
                                            cmd : "media_network_list" ,
                                            data : {
                                                pageNumber : $("#ch_list").children().length ,
                                                ch_type : "all"/*$("#page_type ._active").attr("ch_type")0730email8*/ ,
                                            }
                                    },
                                    success: function(data) {
                                            try {
                                                var data = JSON.parse(data);
                                                if( !data.success ) {
                                                        $.GetData = false;
                                                        $("#loading_icon").css( "visibility" , "hidden" );
                                                        return 0;
                                                } else {
                                                        $.GetData = true;
                                                        var i=0;
                                                        console.log( data );

                                                        var list = data.channel;
                                                        for(i=0;i< list.length;i++) {    
                                                                var clone = $("#channel_list_modal_example").clone();
                                                                clone.removeAttr("id");
                                                                clone.css("display","block");

                                                                //clone.find("[id=link]").attr("href", "cooperate.php?ch=" + list[i].url );BOHAN0717
                                                                clone.find("[id=bg]").css( "background-image" , "url(\"" + list[i].icon + "\")" );
                                                                clone.find("[id=ch_type_below]").html( list[i].type );
                                                                clone.find("[id=ch_name_below]").html( list[i].channelname );
                                                                if( i%6 != 5 ) {
                                                                    clone.css("margin-right" , "0.79%");
                                                                }
                                                                $("#ch_list").append(clone);
                                                        }
                                                        $("#loading_icon").css( "visibility" , "hidden" );
                                                }
                                            }
                                            catch (e) {
                                                    console.log( e );
                                            }
                                    }
                            });
                    }
                    
                    $.get_ch_rank = function() {
                            $.ajax({
                                    type: "POST",
                                    url: "php/manage_channel.php",
                                    data: {
                                        cmd : "media_network_rank" ,
                                    },
                                    success: function(data) {
                                            try {
                                                var data = JSON.parse(data);
                                                console.log( data );
                                                $("#top_rank").html("");
                                                var list = data.rank;
                                                var i = 0;
                                                for(i=0;i< list.length;i++) {    
                                                        var clone = $("#top_rank_modal_example").clone();
                                                        clone.removeAttr("id");
                                                        clone.css("display","block");
                                                        
                                                        //clone.find("[id=link]").attr("href", "cooperate.php?ch=" + list[i].id );BOHAN0717
                                                        clone.find("[id=icon]").css( "background-image" , "url(\"" + list[i].ch_icon + "\")" );
                                                        $("#top_rank").append(clone);
                                                }
                                            }
                                            catch (e) {
                                                    console.log( e );
                                            }
                                    }
                            });
                    }
                    
                    $(window).on("scroll", function() {
                            var scrollHeight = $(document).height();
                            var scrollPosition = $(window).height() + $(window).scrollTop();
                            if ((scrollHeight - scrollPosition) / scrollHeight == 0 && $(window).scrollTop() != 0 && $.GetData == true ) {
                                    $.GetData = false;
                                    $("#loading_icon").css( "visibility" , "visible" );
                                    $.get_list();
                            }
                    });         
                    
                   /* $("#page_type span").unbind( "click" ).bind( "click", function(e) {
                            $("#page_type span").removeClass("_active");
                            $(this).addClass("_active");
                            $("#ch_list").html("");
                            $.GetData = true;
                            $.get_list();
                    });*/
                    $.get_ch_rank();
                    $.get_list();
            });

            function FB_connected_callback_init( response )
            {
                        $.member = response;
                        
                        
            };
            
            function FB_unconnected_callback_init()
            {
                        $.member = { facebook_mail : "" , email : "" };

            };
            
        </script>
        
        <script src="js/fb-login.js"></script>
        <script src="https://apis.google.com/js/platform.js"></script>
        
</body>

</html>
