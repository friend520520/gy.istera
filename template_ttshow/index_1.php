<html lang="en">

<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>台灣達人秀 | 最強創作者聯盟</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">
        
        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        
        <meta name="keywords" content="達人秀,ttshow,新媒體創作行銷平台,新媒體人才媒合,新媒體社群行銷,新媒體影音製作,明星,藝人,插畫家,網路紅人,導演,編劇,熱門影片,Youtube排行,facebook排行,喜劇,搞笑,梗圖,音樂,寵物,有趣新聞"/>
        <meta name="og:description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta property="og:image" content="http://ttshow.tw/ttshow/web/images/cover.png"/>
        <script>
                document.write('<meta property="og:url" content="' + location.href + '"/>');
        </script>
        
        <?php
                
                if( $_REQUEST['tab'] && $_REQUEST['tab'] !== "0" && $_REQUEST['tab'] !== "9999" && $_REQUEST['tab'] !== "10000" )
                {

                        include 'php/config.php';
                        include 'php/global.php';
                        
                        
                        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                        $con->query( "SET NAMES utf8" );

                        if (mysqli_connect_errno()) {

                        }
                        else {
                                $result = mysqli_query($con, "SELECT * FROM category WHERE id=" . $_REQUEST['tab'] . "");
                                if ( mysqli_num_rows($result) > 0) {

                                        while($row = mysqli_fetch_array($result)) {
                                                
                                                echo '<meta property="og:title" content="台灣達人秀│' . $row['name'] . '"/>';
                                                
                                        }
                                }

                                mysqli_close($con);

                        }

                }
                else {
                        echo '<meta property="og:title" content="台灣達人秀│最強自媒體聯播網"/>';
                }
                
        ?>
        
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
        
        <script>
                
                $.init_tab = getParameterByName( "tab" );
                console.log( $.init_tab );
        </script>
        
        
        <style>
                
                @media (max-width: 1200px) {
                    /*#homepageheader > .homepageheader_small {
                        margin-top: 52.3%;
                    }

                    #homepageheader:after {
                            content: ""!important;
                            display: block!important;
                            padding-bottom: 52.3% !important;
                    }*/
                    
                    #homepageheader [header=H_1] {
                            border: 1px solid #dddddd;
                    }
                    
                    #homepageheader [header=H_2] , #homepageheader [header=H_4] {
                            border-left: 1px solid #dddddd;
                            border-bottom: 1px solid #dddddd;
                            border-right: 1px solid #dddddd;
                    }
                    
                    #homepageheader [header=H_3] , #homepageheader [header=H_5] {
                            border-bottom: 1px solid #dddddd;
                            border-right: 1px solid #dddddd;
                    }
                    
                }
                
                @media (min-width: 1200px) {
                    /*#homepageheader > .homepageheader_small {
                        margin-left: 50%;
                    }

                    #homepageheader:after {
                            content: ""!important;
                            display: block!important;
                            padding-bottom: 26.15% !important;
                    }*/
                    
                    #homepageheader [header=H_1] {
                            border: 1px solid #dddddd;
                    }
                    
                    #homepageheader [header=H_2] , #homepageheader [header=H_3] {
                            border-top: 1px solid #dddddd;
                            border-bottom: 1px solid #dddddd;
                            border-right: 1px solid #dddddd;
                    }
                    
                    #homepageheader [header=H_4] , #homepageheader [header=H_5] {
                            border-bottom: 1px solid #dddddd;
                            border-right: 1px solid #dddddd;
                    }
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
    
    <?php include( "header_1.php"); ?>
    
    <div class="main-container" id="main-container" style="background-color: white;">

        <div class="main-content" style="margin:0">
            <div class="page-content">
                <div id="homepageheader" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0;margin-top: auto;margin-right: auto;margin-left: auto;right: 0px;left: 0px;position:relative;width: 100%"><!--width: 1280px AL 0420 edit-->

                </div>
                <div id='homepage' class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0 85px; margin-top: 25px;" ><!--AL 0420 edit-->
                    <div id="res" style="position: relative; width: 100%; overflow-y: hidden;"><!-- height: 2150px;-->
                        <div id="homepagecontent" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0;">  
                            
                        </div>
                        
                    </div>
                </div>
                <div id='categorypage' style="display: block; padding: 0px 85px;"><!--AL 0418 edit height: 2500px;  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px 85px; position: relative; width: 100%; display: block; overflow-y: hidden;"-->
                        <!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0;margin-top: auto;margin-right: auto;margin-left: auto;right: 0px;left: 0px;position: absolute;width: 1220px"-->
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 15px;"><!--bohan width:920px-->
                                    
                                    <style>
                                        ._active {
                                            background-color: rgb(42, 104, 168);
                                            color: white;
                                        }
                                    </style>
                                    <!--div class="col-xs-12" style="margin-top: 30px; margin-bottom: 10px;">
                                        <div class="btn-group btn-corner pull-right">
                                                <button class="btn active" create="upright">直立</button>
                                                <button class="btn" create="list">列表</button>
                                                <button class="btn" create="chessboard">棋盤</button>
                                        </div>
                                    </div-->
                                    <div class="col-xs-12 col-sm-12" id="pagecontent" style="margin-top: 10px; padding:0;">
                                    </div>
                                    
                                    <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                            <img src="template/assets/images/loading.gif" name="load_img">
                                    </div>
                                    
                                </div>
                                <div class="clear" style="clear: both;"></div>
                        <!--/div-->
                </div>
            </div>
        </div>
    </div>
        <!--div class="main-content">
                    <div class="main-content-inner" style="margin-top: 45px">
                                <div class="page-content">
                                            <div class="widget-body">
                                                        <div class="widget-main padding-0">
                                                          <div class="tab-content padding-0">
                                                            <div class="tab-pane in active" id="pagecontent">
                                                            </div>

                                                          </div>
                                                        </div>
                                            </div>
                                </div>
                    </div>
        </div-->

    <!-- /.main-content -->
    <?php include( "footer.php"); ?>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>

    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
    </script>
    <script src="template/assets/js/bootstrap.js"></script>

    <!-- page specific plugin scripts -->
    <script src="template/assets/js/jquery-ui.js"></script>
    <script src="template/assets/js/jquery.ui.touch-punch.js"></script>

    
    <!--script src="template/assets/js/ace/elements.scroller.js"></script>
    <script src="template/assets/js/ace/elements.colorpicker.js"></script>
    <script src="template/assets/js/ace/elements.fileinput.js"></script>
    <script src="template/assets/js/ace/elements.typeahead.js"></script>
    <script src="template/assets/js/ace/elements.wysiwyg.js"></script>
    <script src="template/assets/js/ace/elements.spinner.js"></script>
    <script src="template/assets/js/ace/elements.treeview.js"></script>
    <script src="template/assets/js/ace/elements.wizard.js"></script>
    <script src="template/assets/js/ace/elements.aside.js"></script-->
    <script src="template/assets/js/ace/ace.js"></script>
    <!--script src="template/assets/js/ace/ace.ajax-content.js"></script>
    <script src="template/assets/js/ace/ace.touch-drag.js"></script-->
    <script src="template/assets/js/ace/ace.sidebar.js"></script>
    <!--script src="template/assets/js/ace/ace.sidebar-scroll-1.js"></script>
    <script src="template/assets/js/ace/ace.submenu-hover.js"></script-->
    <!--script src="template/assets/js/ace/ace.widget-box.js"></script>
		<script src="template/assets/js/ace/ace.settings.js"></script>
		<script src="template/assets/js/ace/ace.settings-rtl.js"></script>
		<script src="template/assets/js/ace/ace.settings-skin.js"></script>
		<script src="template/assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="template/assets/js/ace/ace.searchbox-autocomplete.js"></script-->

    <!-- inline scripts related to this page -->
    <!--AL 0420 edit
    <script src="template/assets/js/jquery.ui.touch-punch.js"/>
    <script src="template/assets/js/ace/elements.scroller.js"/>
    <script src="template/assets/js/ace/elements.colorpicker.js"/>
    <script src="template/assets/js/ace/elements.fileinput.js"/>
    <script src="template/assets/js/ace/elements.typeahead.js"/>
    <script src="template/assets/js/ace/elements.wysiwyg.js"/>
    <script src="template/assets/js/ace/elements.spinner.js"/>
    <script src="template/assets/js/ace/elements.treeview.js"/>
    <script src="template/assets/js/ace/elements.wizard.js"/>
    <script src="template/assets/js/ace/elements.aside.js"/>
    <script src="template/assets/js/ace/ace.js"/>
    <script src="template/assets/js/ace/ace.ajax-content.js"/>
    <script src="template/assets/js/ace/ace.touch-drag.js"/>
    <script src="template/assets/js/ace/ace.sidebar.js"/>
    <script src="template/assets/js/ace/ace.sidebar-scroll-1.js"/>
    <script src="template/assets/js/ace/ace.submenu-hover.js"/>-->
    
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


    <!-- init       : null -->
    <!-- callback   : $.device = mobile or pc -->

    <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>
    <script src="js/tabs.js"></script>

    <script src="js/ajaxq.js"></script>
    <script type="text/javascript">


            $("document").ready(function() {
                    

                    

            });

            function FB_connected_callback_init( response )
            {
                        $.member = response;
                        
                        //use_getbody();
                        //use_gettab( "1" );
                        $( "#tab2" ).children( ".tab" ).children( "button[tab=1]" ).trigger("click");
                        //use_gettab_author( "recommendation" );
                        $( "#tab3" ).children( ".tab" ).children( "button[type=recommendation]" ).trigger("click");
                        
                        $( "#main-container" ).show();
                        init_scroll();
                        
            };

            function FB_unconnected_callback_init()
            {
                        $.member = { facebook_mail : "" , email : "" };
                        
                        //use_getbody();
                        //use_gettab( "1" );
                        $( "#tab2" ).children( ".tab" ).children( "button[tab=1]" ).trigger("click");
                        //use_gettab_author( "recommendation" );
                        $( "#tab3" ).children( ".tab" ).children( "button[type=recommendation]" ).trigger("click");
                        
                        $( "#main-container" ).show();
                        init_scroll();
                        
            };
                
        </script>
        <script src="js/fb-login.js"></script>
        <script src="https://apis.google.com/js/platform.js"></script>
        
</body>

</html>
