<!DOCTYPE html>
<html lang="en" style="background-color: white">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
                
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
                <script src="js/apps.js"></script>

                <?php
                        
                        include("php/config.php");
                        include 'php/global.php';
                        
                        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                        $con->query( "SET NAMES utf8" );

                        if (mysqli_connect_errno()) {

                        }
                        else {
                                
                                $page = get_sql( $con , "page" , "page_id=" . $_REQUEST['page_id'] , array( 'title' , 'page_id' , 'article_icon' , 'describe' , "channel_id" ) );
                                
                                echo '<title>' . $page[0]['title'] . '</title>';
                                echo '<meta property="og:title" content="' . $page[0]['title'] . '"/>';
                                echo '<meta property="og:type" content="article"/>';
                                echo '<meta property="og:image" content="' . $user_image_path . $_REQUEST['page_id'] . "/ThumbnailM/" . $page[0]['article_icon'] . '"/>';
                                echo '<meta property="og:description" content="' . $page[0]['describe'] . '"/>';

                                $channel = get_sql( $con , "channel" , "channel_id=" . $page[0]['channel_id'] , array( "ch_name" , "facebook_url" , "youtube_url" , "instagram_url" , "line_url" , "pixnet_url" , "other_url" ) );

                                $callback = array(  "channel_info" => array( "id" => $ch ,
                                                                            "name" => $channel[0]['ch_name'] ) ,
                                                    "channel_community" => array( "facebook" => json_decode( $channel[0]['facebook_url'] , true ) ,
                                                                                "youtube" => json_decode( $channel[0]['youtube_url'] , true ) ,
                                                                                "instagram" => json_decode( $channel[0]['instagram_url'] , true ) ,
                                                                                "line" => json_decode( $channel[0]['line_url'] , true ) ,
                                                                                "pixnet" => json_decode( $channel[0]['pixnet_url'] , true ) ,
                                                                                "other" => json_decode( $channel[0]['other_url'] , true ) ) );
                                
                                mysqli_close($con);

                        }

                ?>
                
                <script>
                        function CopyToClipboard(text) {
                                if (window.clipboardData) {
                                    window.clipboardData.clearData();
                                    window.clipboardData.setData("Text", text);
                                } 
                                else if (navigator.userAgent.indexOf("Opera") != -1) {
                                    window.location = text;
                                } 
                                else if (window.netscape) {
                                    try {
                                        netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                                    } catch (e) {
                                        alert("被瀏覽器拒絕！\n請在瀏覽器地址欄輸入'about:config'並按上一頁\n然後將'signed.applets.codebase_principal_support'設置為'true'");
                                        return false;
                                    }
                                    var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
                                    if (!clip)
                                        return false;
                                        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
                                    if (!trans)
                                        return false;
                                        trans.addDataFlavor('text/unicode');
                                        var str = new Object();
                                        var len = new Object();
                                        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
                                        var copytext = text;
                                        str.data = copytext;
                                        trans.setTransferData("text/unicode", str, copytext.length*2);
                                        var clipid = Components.interfaces.nsIClipboard;
                                    if (!clip)
                                        return false;
                                    clip.setData(trans,null,clipid.kGlobalClipboard);
                                }
                                return true;
                        }
                        //document.write("<link href='http://fundesigner.net/wp-content/uploads/2012/07/1_thumb7.png' rel='image_src' type='image/png'>");

                        $.init_tab = getParameterByName( "tab" );
                        console.log( $.init_tab );
                </script>

                <script src="template/assets/js/ace-extra.js"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
		<script src="template/assets/js/html5shiv.js"></script>
		<script src="template/assets/js/respond.js"></script>
		<![endif]-->
		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                <!--AL 0410-->
                <style>
                    
                    #pagecontent * {
                        font-size: 16px;
                        max-width: 100%;
                        line-height: 1.5;
                    }
                    
                    #pagecontent .row {
                        margin-left: 0!important;
                        margin-right: 0!important;
                    }
                    
                    #pagecontent .col-xs-1, #pagecontent .col-sm-1, #pagecontent .col-md-1, #pagecontent .col-lg-1, #pagecontent .col-xs-2, #pagecontent .col-sm-2, #pagecontent .col-md-2, #pagecontent .col-lg-2, #pagecontent .col-xs-3, #pagecontent .col-sm-3, #pagecontent .col-md-3, #pagecontent .col-lg-3, #pagecontent .col-xs-4, #pagecontent .col-sm-4, #pagecontent .col-md-4, #pagecontent .col-lg-4, #pagecontent .col-xs-5, #pagecontent .col-sm-5, #pagecontent .col-md-5, #pagecontent .col-lg-5, #pagecontent .col-xs-6, #pagecontent .col-sm-6, #pagecontent .col-md-6, #pagecontent .col-lg-6, #pagecontent .col-xs-7, #pagecontent .col-sm-7, #pagecontent .col-md-7, #pagecontent .col-lg-7, #pagecontent .col-xs-8, #pagecontent .col-sm-8, #pagecontent .col-md-8, #pagecontent .col-lg-8, #pagecontent .col-xs-9, #pagecontent .col-sm-9, #pagecontent .col-md-9, #pagecontent .col-lg-9, #pagecontent .col-xs-10, #pagecontent .col-sm-10, #pagecontent .col-md-10, #pagecontent .col-lg-10, #pagecontent .col-xs-11, #pagecontent .col-sm-11, #pagecontent .col-md-11, #pagecontent .col-lg-11, #pagecontent .col-xs-12, #pagecontent .col-sm-12, #pagecontent .col-md-12, #pagecontent .col-lg-12 {
                        padding-left: 0!important;
                        padding-right: 0!important;
                    }
                    
                </style>
                
	</head>

	<body class="no-skin" style="display: none; background-color: white;">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
        <div id="popop" class="remodal-overlay widget-box-overlay" style="background-color: white; bottom: 0px; top: 0px; left: 0px; right: 0px; text-align: center; position: fixed; z-index: -50; width: 100%; overflow-y: auto; overflow-x: hidden;">
            <div class="remodal" style="width: 335px; text-align: center; display: inline-block; font-size: 20px; line-height: 20px; font-weight: bold; color: rgb(238, 238, 238); padding: 17px; border-radius: 4px; background: transparent linear-gradient(to bottom, rgb(5, 35, 61) 0%, rgb(14, 44, 70) 48%, rgb(25, 56, 82) 100%) repeat scroll 0px 0px;">
                    <img style="position: absolute; opacity: 1; right: 5px; top: 5px; margin: 0px; height: 20px;" src="images/x-white.png" class="close">
                    <h3 style="color: white; font-size: 15px; margin: 0px; height: 19px;">好作品好人才需要被全世界看見</h3>
                    <h3 style="color: white; font-size: 15px; margin: 0px;">分享是對創作者最棒的支持</h3>
                    <div type="fbshare" onclick="share_event()" style="cursor: pointer; width: 100%; margin-top: 8px; border-radius: 3px; border: 2px solid white; background: rgb(24, 74, 117) none repeat scroll 0% 0%; height: 50px;">
                        <img style="float: left; margin-left: 1px; width: 57px;" src="template/assets/images/like.png">
                        <i style="float: left; margin-left: 23px; margin-top: 8px; font-size: 30px;" class="fa fa-facebook"></i>
                        <h3 style="color: white; padding-right: 46px; font-size: 18pt; margin: 0px; line-height: 50px;">喜歡立即分享</h3>
                    </div>
                    
                    <hr style="opacity: 0.15;">
                    <h3 style="color: white; margin: 28px 0px 0px; font-size: 15px;">讓好作品免費獲得宣傳</h3>
                    <div style="cursor: pointer; width: 100%; border-radius: 3px; border: 2px solid white; margin-top: 12px; background: rgb(255, 0, 0) none repeat scroll 0% 0%; text-align: center; height: 50px;">
                        <h3 style="color: white; letter-spacing: 2px; text-shadow: 1px 2px 1px black; font-size: 18pt; line-height: 50px; margin: 0px;">立即申請</h3>
                    </div>
                    <hr style="opacity: 0.15; margin: 28px 0px 21px;">
                    <h3 style="color: white; font-size: 15px; margin: 0px; height: 19px;">訂閱台灣達人秀相關社群</h3>
                    <h3 style="color: white; font-size: 15px; height: 19px;">有趣內容不漏接</h3>
                    <div class="col-xs-5" style="margin-top: 5px; padding-right: 0px; margin-bottom: 18px;">
                        <!--div class="fb-like" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="standard" data-action="like" data-show-faces="true"></div-->
                        <div class="fb-like" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                    </div>
                    <div style="margin-top: 5px; padding-right: 0px; margin-bottom: 18px;" class="col-xs-6">
                        <div class="g-ytsubscribe" data-channel="TaiwanTalentShow" data-layout="default" data-count="default"></div>
                    </div>
                    <div class="col-xs-1" style="padding: 0; margin: 0;">
                        <div class="col-xs-3">
                            <i id="popop_more" style="color: gray; font-size: 15px; cursor: pointer; height: 24px; width: 24px; margin-top: 3px; border: 1px solid gainsboro; padding: 2px;" class="fa fa-plus"></i>
                        </div>
                    </div>
                    <script>
                            
                            $( "#popop_more" ).click( function(){
                                
                                    $( "#popop" ).css( "z-index" , "-50" ).css( "background-color" , "white" );
                                    $( "body" ).removeClass( "modal-open" );
                                    $( "#myModalCommunity" ).modal("show");
                                    
                            });
                            
                    </script>
            </div>
        </div>
        
        <style>
                
            /*#popop > div:before {
                    
                    content:'';
                    width:0;
                    height:100%;
                    display:inline-block;
                    position:relative;
                    vertical-align:middle;
                    background:#f00;
                
            }
                
            #popop:before {
                    
                    content:'';
                    width:0;
                    height:100%;
                    display:inline-block;
                    position:relative;
                    vertical-align:middle;
                    background:#f00;
                
            }*/
                
        </style>
        
        <script>
                
                $( "#popop .close" ).unbind( "click" ).bind( "click" , function(){
                        
                        $( "#popop" ).css( "z-index" , "-50" ).css( "background-color" , "white" );
                        $( "body" ).removeClass( "modal-open" );
                        
                });
                
        </script>
        
        <?php include( "header_1.php"); ?>

        <!-- /section:basics/navbar.layout -->
        
        <script>
            var fbhtml_url = "http://ttshow.tw/page-inner" + location.search;
        </script>
        
        <div class="main-container" id="main-container" style="background-color: white;">
         
            <div class="main-content">
            <!--AL 0409-->

                <div style="margin-left: -5px; background-color: white;" class="main-content">
                    <div class="main-content-inner">
                        <div class="page-content" id="">

                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 wholepage web_sidebar_parent" style="position: absolute; left: 0px; right: 0px; background-color: white; padding: 0px;">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 web_sidebar_left" style="padding: 0px;">
                                    <div class="widget-body col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px 35px;">
                                        <div class="widget-main padding-0">
                                                <div id="hot" class="tab-pane active">
                                                    
                                                    <div style='padding: 8px 0px;'>
                                                        <span style="font-size: 15px; vertical-align: middle;">點閱</span>
                                                        <span name="c_num_click" style="color: red; font-weight: bold; font-size: 25px; vertical-align: middle;"></span>
                                                        <img name="special_img" style="vertical-align: middle; " onclick="" src="" width="32" height="32">
                                                    </div>
                                                    
                                                    <div id="pagehead"></div>

                                                    <div class="clearfix"></div>
                                                    <style>
                                                            .sharebox > * {
                                                                width: 14.285%!important;
                                                                padding: 0px!important;
                                                                margin: 0px!important;
                                                            }
                                                    </style>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0">
                                                        <div class="sharebox col-xs-12" style="padding: 0px; left: 0px; right: 0px; position: relative; width: 100%;">
                                                                <div style="text-align: center; margin-bottom: 15px; padding: 0px 1px; height: 40px;" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                    <a class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="width: 100%; background-color: rgb(69, 97, 175); cursor: pointer; padding: 0px; height: 40px;" onclick="share_event()">
                                                                        <i style="font-size: 23px; color: white; margin-top: 9px;" class="fa fa-facebook"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                                                    <a onclick="window.open('https://plus.google.com/share?url='+fbhtml_url);return false;" style="width: 100%; background-color: #e42c27; cursor: pointer; height: 40px; padding: 0;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <i class="fa fa-google-plus" style="font-size: 23px; color: white; margin-top: 9px;"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                                                    <a onclick="window.open('http://tumblr.com/widgets/share/tool?canonicalUrl='+fbhtml_url);return false;" style="width: 100%; background-color: #34465d; cursor: pointer; height: 40px; padding: 0;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <i class="fa fa-tumblr" style="font-size: 23px; color: white; margin-top: 9px;"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                                                    <a onclick="window.open('https://twitter.com/intent/tweet?source=webclient&amp;text='+fbhtml_url);return false;" style="width: 100%; background-color: #33ccff; cursor: pointer; height: 40px; padding: 0;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <i class="fa fa-twitter" style="font-size: 23px; color: white; margin-top: 9px;"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                                                    <a onclick="window.open('http://www.plurk.com/?qualifier=shares&amp;status='+fbhtml_url);return false;" style="width: 100%; cursor: pointer; height: 40px; padding: 0; background-color: #e95613;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <img style="cursor: pointer; padding: 0px; margin-top: 11px; width: 17px; height: 18px;" src="images/plurkbutton.png">
                                                                    </a>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                                                    <a onclick="window.open('http://v.t.sina.com.cn/share/share.php?title=' + fbhtml_url + '&url='+fbhtml_url);return false;" style="width: 100%; cursor: pointer; height: 40px; padding: 0; border: gray solid 1px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <img style="width: 23px; cursor: pointer; padding: 0px; margin-top: 10px; height: 21px;" src="images/Sina_Weibo.png">
                                                                    </a>
                                                                </div>
                                                                
                                                                <div id="get_collect" class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding:0px; height: 40px;">

                                                                </div>
                                                        </div>
                                                        
                                                        <!------------------ad------------------>
                                                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                                        
                                                        <!--div class="col-xs-12" style="text-align: center; padding: 6px 0px;">
                                                            <ins class="adsbygoogle"
                                                                style="display:block"
                                                                data-ad-client="ca-pub-6993208558764142"
                                                                data-ad-slot="2045305003"
                                                                data-ad-format="auto"></ins>
                                                        </div-->
                                                        <!------------------ad------------------>
                                                        <div id="pagecontent" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0; word-break:break-all;"></div>
                                                        
                                                        <script>
                                                            
                                                            if( getParameterByName( "page_id" ) === "1806" )
                                                            {
                                                                    $( "#pagecontent" ).after( '<div class="fb-comments" data-href="http://ttshow.tw/page-inner.php?page_id=1806" data-width="100%" data-numposts="5"></div>' );
                                                            }
                                                            
                                                        </script>
                                                        <style>

                                                            .fb-comments * {
                                                                max-width : 100%;
                                                                min-width : 100%;
                                                            }    

                                                        </style>
                                                        
                                                        <!------------------ad------------------>
                                                        <div class="col-xs-12" style="text-align: center; padding: 10px 0 6px;">
                                                            <a href="http://www.spp.com.tw/event/live/2015-mydeerdog/index.htm">
                                                                <img src="images/mddad728.gif" style="padding:5px 0; max-width: 100%;">
                                                            </a>
                                                        </div>
                                                        <!------------------ad------------------>
                                                        
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;">

                                                            <div name="gettag" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px; float: left; max-height: 46px; overflow-y: hidden;">
                                                              
                                                            </div>
                                                            <!--div id="get_collect2" class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding:0px;">

                                                            </div-->
                                                        </div>
                                                        
                                                        <hr class="col-xs-12">
                                                        <!--div style="background-color: rgb(19, 74, 121); padding: 20px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                            <h4 style="color: white; text-align: center; letter-spacing: 0.5px; font-size: 16px;">
                                                              好作品好人才需要被全世界看見，分享是對創作者最棒的支持
                                                            </h4>
                                                                <div style="cursor: pointer; border-radius: 3px; border: 2px solid white; background: none repeat scroll 0% 0% rgb(24, 74, 117); text-align: center; margin: auto auto 20px; left: 0px; right: 0px; position: relative; height: 51px; max-width: 500px;" 
                                                                onclick="share_event()" type="fbshare">

                                                        <h3 style="color: white; font-size: 17px; text-align: center; margin: 0px;">
                                                          <img src="template/assets/images/like.png" style="width: 45px; margin-top: -7px; margin-right: 13px;"><i class="fa fa-facebook" style="font-size: 18px; margin-right: 9px; margin-top: 15px;">
                                                          </i>
                                                          喜歡立即分享
                                                        </h3>
                                                        </div>
                                                         <div style="max-width: 500px; padding: 0px; left: 0px; right: 0px; position: relative; margin: auto;">
                                                            <a class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding: 0px; text-align: center; cursor: pointer; height: 31px; background-color: rgb(69, 97, 175);" target="_blank" onclick="share_event()">
                                                              <i style="font-size: 18px; color: white; margin-top: 7px;" class="fa fa-facebook">
                                                              </i>
                                                            </a>
                                                            <a class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding: 0px; text-align: center; cursor: pointer; height: 31px; background-color: rgb(228, 44, 39);" target="_blank" href="javascript:void(0);" onclick="window.open('https://plus.google.com/share?url='+fbhtml_url);return false;">
                                                              <i style="font-size: 18px; color: white; margin-top: 7px;" class="fa fa-google">
                                                              </i>
                                                            </a>
                                                            <a onclick="window.open('http://tumblr.com/widgets/share/tool?canonicalUrl='+fbhtml_url);return false;" target="_blank" style="padding: 0px; text-align: center; cursor: pointer; height: 31px; background-color: rgb(52, 70, 93);" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                              <i class="fa fa-tumblr" style="font-size: 18px; color: white; margin-top: 7px;">
                                                              </i>
                                                            </a>
                                                            <div data-target="#myModalShare" data-toggle="modal" class="btn-group col-xs-2 col-sm-2 col-md-2 col-lg-2" style="cursor: pointer; text-align: center; height: 31px; background-color: rgb(98, 98, 98);">
                                                              
                                                                <i style="font-size: 18px; color: white; margin-top: 7px;" class="fa fa-plus">
                                                                </i>
                                                            </div>
                                                            <a onclick="share_event()" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 0px; text-align: center; cursor: pointer; height: 31px; background-color: rgb(238, 238, 238);">
                                                              <span style="float: left; margin-left: 48px;">
                                                                <h4 now="share_count" style="color: blue; font-size: 20px; font-weight: bold; margin: 0px;">
                                                                </h4>
                                                              </span>
                                                              <span style="float: left; margin-left: 10px;">
                                                                <h4 style="color: black; font-size: 15px; margin: 0px;">
                                                                  分享
                                                                </h4>
                                                              </span>
                                                              <div class="pos-rel page-btn-share-tem" style="">
                                                                <div now="progress-bar" class="progress-bar progress-bar-warning index-btn-share-tem-progress" style="height: 7px;">
                                                                </div>
                                                              </div>
                                                            </a>
                                                          </div>


                                                        <div class="pos-rel col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 20px;">
                                                            <div style="padding: 0px; border-radius: 66px; height: 35px; border: 3px solid darkgray; background: none repeat scroll 0% 0% rgb(181, 181, 181);" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div now="progress-bar" style="border-radius: 65px; width: 100%;" class="progress-bar page-btn-share-tem-progress page-btn-share-tem1">
                                                                </div>
                                                                <div style="height: 100%; background-color: lightgray; position: absolute; margin: 0px; border-radius: 0px; right: 0px; width: 0%;" class="page-btn-share-tem1" now="progress-bar-cover">
                                                                </div>
                                                            </div>
                                                            <div style="margin: auto; position: absolute; left: 43%; top: 6px;">
                                                                <i onclick="share_event()" style="color: white; font-size: 18px; float: left; margin-top: 4px; cursor: pointer;" class="ace-icon fa fa-share">
                                                                </i>
                                                                <h4 style="color: white; font-size: 17px; margin-left: 10px; float: left; letter-spacing: 1px; font-weight: bolder;">
                                                                    集氣分享力
                                                                </h4>
                                                                <h4 now="share_count" style="color: white; font-size: 17px; margin-left: 10px; float: left; letter-spacing: 1px; font-weight: normal;">
                                                                </h4>
                                                            </div>
                                                        </div>
                                                      </div-->
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px;" id="sharebox">
                                                            <div style="cursor: pointer; border: 2px solid white; background: rgb(24, 74, 117) none repeat scroll 0% 0%; text-align: center; left: 0px; right: 0px; position: relative; height: 60px; border-radius: 6px;" onclick="share_event()" class="col-xs-12">
                                                                <h3 style="color: white; text-align: center; font-size: 17px; margin: 0px; height: 56px; padding: 16px;">
                                                                    <b class="col-xs-0 col-md-0" style="vertical-align: middle; margin-right: 5%;">好作品好人才需要被全世界看見 分享是對創作者最棒的支持</b>
                                                                    <span style="vertical-align: middle; font-size: 28px; margin-right: 4px;" class="fa fa-facebook"></span>
                                                                    <b style="vertical-align: middle; font-size: 30px;">立即分享</b>
                                                                </h3>
                                                            </div>
                                                            
                                                            <style>
                                                                
                                                                @media (max-width: 767px) {
                                                                
                                                                    .col-xs-0 {
                                                                        display: none;
                                                                    }
                                                                    
                                                                }
                                                                
                                                                @media (min-width: 1012px) AND (max-width: 1220px) {
                                                                    
                                                                    .col-md-0 {
                                                                        display: none;
                                                                    }
                                                                    
                                                                }
                                                                
                                                            </style>
                                                            
                                                            <div class="col-xs-12" style="padding: 0px; left: 0px; right: 0px; position: relative; width: 100%; margin: 15px 0px 0px;">
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 0px; text-align: center;">
                                                                    <a href="search_results.php?specialtag=1">
                                                                        <img width="37" height="37" style="vertical-align: middle;" src="images/10k.png">
                                                                    </a>
                                                                    <span style="font-size: 17px; vertical-align: middle;">10k</span>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 0px; text-align: center;">
                                                                    <a href="search_results.php?specialtag=20">
                                                                        <img width="37" height="37" style="vertical-align: middle;" src="images/20k.png">
                                                                    </a>
                                                                    <span style="font-size: 17px; vertical-align: middle;">20k</span>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 0px; text-align: center;">
                                                                    <a href="search_results.php?specialtag=50">
                                                                        <img width="37" height="37" style="vertical-align: middle;" src="images/50k.png">
                                                                    </a>
                                                                    <span style="font-size: 17px; vertical-align: middle;">50k</span>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 0px; text-align: center;">
                                                                    <a href="search_results.php?specialtag=100">
                                                                        <img width="37" height="37" style="vertical-align: middle;" src="images/100k.png">
                                                                    </a>
                                                                    <span style="font-size: 17px; vertical-align: middle;">100k</span>
                                                                </div>
                                                            </div>

                                                            <div style="margin: 15px 0 20px; padding: 0px;" class="pos-rel col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px; background: darkgray none repeat scroll 0% 0%; height: 55px; border-radius: 5px; border: 5px solid lightgray; position: relative;">
                                                                    <div now="progress-bar" class="progress-bar page-btn-share-tem-progress page-btn-share-tem1" style="margin: 0px; height: 100%; border-radius: 5px; width: 100%;">
                                                                    </div>
                                                                    <div now="progress-bar-cover" class="page-btn-share-tem1" style="height: 100%; background-color: lightgray; position: absolute; margin: 0px; border-radius: 0px; right: 0px; width: 100%;">
                                                                    </div>
                                                                    <div style="position: absolute; left: 0px; right: 0px; text-align: center;">
                                                                        <h4 style="color: white; font-weight: bolder; letter-spacing: 1px; height: 100%; margin: 0px; font-size: 21px; line-height: 45px; text-shadow: 1px 2px 1px black;">讚力指數 <p style="color: white; display: inline;" now="share_count">0</p></h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <h4 class="col-xs-12" style="text-align: center; margin: 0px; font-size: 14px; color: gray; font-weight: bold;">分享可累積讚力指數，就有機會登上熱門</h4>
                                                        </div>
                                                </div>
                                                <div class="clearfix">
                                                </div>
                                                <hr>
                                                <div id="author_info" style="padding: 0px;" class="panel-body1 col-xs-12">

                                                    <div id="pageauthor" style="padding: 0px;" class="col-xs-7">
                                                        
                                                        
                                                        
                                                    </div>

                                                    <!--div id="fb-comments" style="margin: 35px 0 20px;"></div--><!--AL 0423 edit-->
                                                    
                                                    <div class="col-xs-5" style="padding: 0px;">
                                                        <div style="float: right;">訂閱作者相關社群</div>
                                                        <div id="AuthorCommunity" class="col-xs-12" style="margin-top: 15px; margin-bottom: 15px;">
                                                            <div class="col-xs-3" style="padding: 0px;" type="facebook">
                                                                <?php if( !empty( $callback['channel_community']['facebook'][0] ) ) echo '<div style="padding: 0px; margin-top: 2px;" class="fb-like" data-href="' . $callback['channel_community']['facebook'][0]["url"] . '" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>';?>
                                                            </div>
                                                            <div class="col-xs-6" style="padding: 0px; text-align: center;" type="youtube">
                                                                <?php if( !empty( $callback['channel_community']['youtube'][0] ) ) echo '<div class="g-ytsubscribe" data-channelid="' . $callback['channel_community']['youtube'][0]["url"] . '" data-layout="default" data-count="default"></div>';?>
                                                            </div>
                                                               
                                                            <div data-target="#myModalAuthorCommunity" data-toggle="modal" class="btn-group col-xs-3" style="cursor: pointer; text-align: center; border: 1px solid gainsboro; float: right; height: 24px; padding: 0px;">
                                                                  <h4 style="text-align: center; font-size: 14px;">更多 
                                                                      <i class="fa fa-plus" style="color: gray; font-size: 15px; margin-top: 3px;"></i>
                                                                  </h4>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <p class="col-xs-12" style="font-size: 11pt; line-height: 24px; padding: 0px;"></p>
                                                    <!--img width="100%" src="http://img.sc115.com/uploads/allimg/100824/2010082416524641.jpg" class="page-AD" style="margin: 15px 0"--><!--AL 0423 edit-->
                                                    

                                                </div>
                                                
                                                <div id="board" class="widget-box col-xs-12" style="display:none;">
                                                    <div class="widget-header">
                                                        <h4 class="widget-title lighter smaller">
                                                                <i class="ace-icon fa fa-comment blue"></i>
                                                                Conversation
                                                        </h4>
                                                    </div>

                                                    <div class="widget-body">
                                                        <div class="widget-main no-padding">
                                                            <div class="dialogs">

                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="input-group">
                                                                    <input id="board_text" type="text" placeholder="Type your message here ..." class="form-control" name="message">
                                                                    <span class="input-group-btn">
                                                                            <button id="board_send" class="btn btn-sm btn-info no-radius" type="button">
                                                                                    <i class="ace-icon fa fa-share"></i>
                                                                                    Send
                                                                            </button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12" style="padding: 0px 35px;">
                                        <div class="col-xs-12 index-blue title_bar">作者其他文章</div>
                                    </div>
                                    
                                    <div id="pageauthorother" style="padding: 0px 29px;"></div>
                                    
                                    <!--div class="col-xs-12 index-blue title_bar">
                                        相關文章
                                    </div>
                                    <div id="pageinteresting_small"></div>

                                    <hr>
                                    <div class="clearfix"></div-->

                                    <div id="featured_channel" class="col-xs-12" style="margin: 0px; padding: 0px 35px; display: none;">

                                            <div class="col-xs-12 index-blue title_bar">
                                                    <button onclick="location.href=''" style="margin-top: 2px; border-radius: 3px; padding: 0px 7px; margin-right: 9px; border: 1px solid rgb(255, 255, 255); background-color: transparent;" class="btn-sm panel-float-right">
                                                        更多
                                                    </button>推薦作者
                                            </div>

                                            <div class="col-xs-12" style="display: inline; padding: 0px; width: 100%; text-align: center; overflow-x: hidden;" id="featured_channel_slider">
                                                    <div id="suggest_channel" style="display: inline-block; height: 160px; overflow-y: hidden;">
                                                            <span style="left: 0px; text-align: center; display: inline; float: left; margin: 15px 8px 0px; position: relative;">
                                                                <div class="bg_top" style="background-image: url('http://ttshow.tw/TTShow/account/bightp85065@yahoo.com.tw/Original/20150510144745.png'); cursor: pointer; width: 100px; height: 100px; margin: 0px; border: 1px solid #dddddd;"></div>
                                                                <div style="width: 100px; margin-top: 8px; font-size: 19px;">作者名稱</div>
                                                            </span>

                                                    </div>
                                                    <!--a data-slide="prev" role="button" class="left carousel-control">
                                                        <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a data-slide="next" role="button" class="right carousel-control">
                                                        <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a-->
                                            </div>

                                    </div>

                                    <script>

                                        $(window).resize(function(){
                                                    resize_function();
                                        });

                                        function resize_function() {

                                                var num = parseInt( $( "#featured_channel_slider" ).width() / 116 );
                                                $( "#suggest_channel" ).children().hide();
                                                $( "#suggest_channel" ).children(":lt(" + num + ")").show();

                                        }

                                    </script>
                                    
                                    <div class="col-xs-12" style="padding: 0px 35px;">
                                        <div id="pageinteresting_title" class="col-xs-12 index-blue title_bar">你可能有興趣的文章</div>
                                    </div>
                                    
                                    
                                    <div id="pageinteresting" class="col-xs-12" style="padding: 0px 29px; margin-top: 10px;">
                                    
                                    </div>
                                    
                                    <hr>
                                    <div class="clearfix">
                                    </div>
                                    
                                    <div id="loading_icon" class="col-xs-12 col-sm-12" style="visibility: hidden; width: 100%; text-align: center;">
                                            <img src="template/assets/images/loading.gif" name="load_img">
                                    </div>
                                    
                                </div>
                                <?php include 'web_sidebar.php'; ?>
                                <script src="js/web_sidebar_event.js"></script>
                            </div>
                      </div>
                    </div>
                </div>


                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse display">
                  <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
                  </i>
                </a>
          </div>
        </div>
        
        
        <div class="remodal-overlay modal fade in" id="myModalReport" style="" aria-hidden="false">
            <!--div class="modal-backdrop fade in" style="height: 665px;"></div-->
                <div class="remodal modal-dialog" style='width: 400px;'>
                        <div class="modal-content">
                                <div class="modal-header">
                                        <img class="close" src="images/x-black.png" style="position: absolute; opacity: 1; right: 5px; top: 5px; margin: 0px; height: 20px;" data-dismiss="modal">
                                        <h4 class="modal-title" style="font-size: 25px">檢舉這則內容</h4>
                                </div>
                                <div class="modal-body" style="padding: 25px">
                                        
                                        <div style="margin: 0 0 15px">
                                                <input type="radio" style="width: 100%; margin: 0px; vertical-align: middle;" checked="" class="ace" name="report" value="1">
                                                <span class="lbl" style="vertical-align: middle;">
                                                    <c style=" margin-left: 15px;">內容不當、令人討厭或很無聊</c>
                                                </span>
                                        </div>
                                        <div style="margin: 0 0 15px">
                                                <input type="radio" style="width: 100%; margin: 0px; vertical-align: middle;" checked="" class="ace" name="report" value="2">
                                                <span class="lbl" style="vertical-align: middle;">
                                                    <c style=" margin-left: 15px;">廣告、垃圾訊息</c>
                                                </span>
                                        </div>
                                        <div style="margin: 0 0 15px">
                                                <input type="radio" style="width: 100%; margin: 0px; vertical-align: middle;" checked="" class="ace" name="report" value="3">
                                                <span class="lbl" style="vertical-align: middle;">
                                                    <c style=" margin-left: 15px;">侵犯隱私權及人身攻擊</c>
                                                </span>
                                        </div>
                                        <div style="margin: 0 0 15px">
                                                <input type="radio" style="width: 100%; margin: 0px; vertical-align: middle;" checked="" class="ace" name="report" value="4">
                                                <span class="lbl" style="vertical-align: middle;">
                                                    <c style=" margin-left: 15px;">涉及暴力、色情、犯罪</c>
                                                </span>
                                        </div>
                                        <div style="margin: 0 0 15px">
                                                <input type="radio" style="width: 100%; margin: 0px; vertical-align: middle;" checked="" class="ace" name="report" value="5">
                                                <span class="lbl" style="vertical-align: middle;">
                                                    <c style=" margin-left: 15px;">散播不實資訊、詐騙內容</c>
                                                </span>
                                        </div>
                                        <div style="margin: 0 0 15px">
                                                <input type="radio" style="width: 100%; margin: 0px; vertical-align: middle;" checked="" class="ace" name="report" value="6">
                                                <span class="lbl" style="vertical-align: middle;">
                                                    <c style=" margin-left: 15px;">侵犯版權</c>
                                                </span>
                                        </div>
                                        <div style="margin: 0 0 15px">
                                                <input type="radio" style="width: 100%; margin: 0px; vertical-align: middle;" checked="" class="ace" name="report" value="7">
                                                <span class="lbl" style="vertical-align: middle;">
                                                    <c style=" margin-left: 15px;">違反發文規範</c>
                                                </span>
                                        </div>
                                        <div style="margin: 0 0 15px">
                                                <input type="radio" style="width: 100%; margin: 0px; vertical-align: middle;" checked="" class="ace" name="report" value="8">
                                                <span class="lbl" style="vertical-align: middle;">
                                                    <c style=" margin-left: 15px;">其他</c>
                                                </span>
                                        </div>
                                        <textarea id="report_text" style="resize: none; width: 100%; height: 100px;"></textarea>
                                        <div class="send btn-sm btn" style="margin-top: 15px; background-color: rgb(19, 74, 121) ! important; float: right; padding: 0px 11px; height: 30px; border-color: rgb(19, 74, 121); border-radius: 5px;">
                                                <span style="">送出</span>
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
                        </div>
                </div>
        </div>
        
        <div class="remodal-overlay modal fade in" id="myModalShare" style="" aria-hidden="false">
            <!--div class="modal-backdrop fade in" style="height: 665px;"></div-->
                <div class="remodal modal-dialog modal-lg">
                        <div class="modal-content">
                                <div class="modal-body" style="padding: 25px">
                                        
                                        <button style="position: absolute; right: 10px; top: 0px; margin: 0px; font-size: 55px;" data-dismiss="modal" class="close" type="button">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" style="font-weight: bold; font-size: 18px; margin-top: 10px;">分享這則創作</h4>
                                        
                                        <div style="text-align: center; margin-bottom: 15px; padding: 0px 1px; height: 40px;" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <a class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="width: 100%; background-color: rgb(69, 97, 175); cursor: pointer; padding: 0px; height: 40px;" onclick="share_event()">
                                                <i style="font-size: 23px; color: white; margin-top: 9px;" class="fa fa-facebook"></i>
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                            <a onclick="window.open('https://plus.google.com/share?url='+fbhtml_url);return false;" style="width: 100%; background-color: #e42c27; cursor: pointer; height: 40px; padding: 0;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <i class="fa fa-google-plus" style="font-size: 23px; color: white; margin-top: 9px;"></i>
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                            <a onclick="window.open('http://tumblr.com/widgets/share/tool?canonicalUrl='+fbhtml_url);return false;" style="width: 100%; background-color: #34465d; cursor: pointer; height: 40px; padding: 0;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <i class="fa fa-tumblr" style="font-size: 23px; color: white; margin-top: 9px;"></i>
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                            <a onclick="window.open('https://twitter.com/intent/tweet?source=webclient&amp;text='+fbhtml_url);return false;" style="width: 100%; background-color: #33ccff; cursor: pointer; height: 40px; padding: 0;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <i class="fa fa-twitter" style="font-size: 23px; color: white; margin-top: 9px;"></i>
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                            <a onclick="window.open('http://www.plurk.com/?qualifier=shares&amp;status='+fbhtml_url);return false;" style="width: 100%; cursor: pointer; height: 40px; padding: 0; background-color: #e95613;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <img style="cursor: pointer; padding: 0px; margin-top: 11px; width: 17px; height: 18px;" src="images/plurkbutton.png">
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                            <a onclick="window.open('http://v.t.sina.com.cn/share/share.php?title=' + fbhtml_url + '&url='+fbhtml_url);return false;" style="width: 100%; cursor: pointer; height: 40px; padding: 0; border: gray solid 1px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <img style="width: 23px; cursor: pointer; padding: 0px; margin-top: 10px; height: 21px;" src="images/Sina_Weibo.png">
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="height: 40px; text-align: center; padding: 0px 1px; margin-bottom: 15px;">
                                            <a target="_blank" onclick="location.href = 'mailto:?body=' + $.page_data.title + '%0D%0A' + fbhtml_url " style="width: 100%; background-color: #e5e5e5; cursor: pointer; height: 40px; padding: 0;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <img style="width: 23px; cursor: pointer; padding: 0px; height: 17px; margin-top: 12px;" src="images/mailbutton.png">
                                            </a>
                                        </div>
                                    
                                        <!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height: 35px; text-align: center; padding: 0px; margin-bottom: 15px;">
                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding: 0">
                                                <input onclick="select_all(this)"  style="border: 1px solid black; border-radius: 2px; width: 100%;">
                                            </div>
                                            <script>
                                                    
                                                    function select_all(obj){
                                                        var text_val= $(obj) ;
                                                        text_val.focus();
                                                        text_val.select();
                                                    }
                                                    
                                            </script>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 0">
                                                <div id="share_modal_copy_btn" class="btn-sm" style="cursor: pointer; float: right; color: black; border: 1px solid black; height: 22px; line-height: 11px;">
                                                        <span style="font-size: 16px;">複製</span>
                                                </div>
                                            </div>
                                        </div-->
                                        
                                        <div data-dismiss="modal" style="cursor: pointer; border: 2px solid white; text-align: center; left: 0px; right: 0px; position: relative; height: 45px; border-radius: 6px; background: gray none repeat scroll 0px 0px; margin-top: 70px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h3 style="color: white; text-align: center; font-size: 17px; margin: 0px;margin-right: 3px; font-size: 22px; margin-top: 10px;">取消</h3>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                </div>
                        </div>
                </div>
        </div>
        
        <div class="remodal-overlay modal fade in" id="myModalAuthorCommunity" style="" aria-hidden="false">
                <div class="remodal modal-dialog modal-lg">
                        <div class="modal-content">
                                <div class="modal-body" style="padding: 25px; width: 100%; height: 100%;">
                                        
                                        <img class="close" src="images/x-black.png" style="position: absolute; opacity: 1; right: 5px; top: 5px; margin: 0px; height: 20px;" data-dismiss="modal">
                                        <h4 class="modal-title" style="font-weight: bold; font-size: 18px; margin-top: 10px;"><c name='channel_name'><?php echo $callback['channel_info']['name'];?></c> 相關社群</h4>
                                        
                                        <div class="col-xs-12 content" style="margin-top: 5px;">
                                            <?php
                                                foreach ($callback['channel_community'] as $key => $value) {
                                                    
                                                        $tmp_html = "";
                                                        $tmp_html1 = "";
                                                        $tmp_html2 = "";
                                                        switch( $key )
                                                        {
                                                            case "facebook":
                                                                $tmp_html1 = '<div class="fb-like" data-href="';
                                                                $tmp_html2 = '" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>';
                                                                break;
                                                            case "youtube":
                                                                $tmp_html1 = '<div class="g-ytsubscribe" data-channelid="';
                                                                $tmp_html2 = '" data-layout="default" data-count="default"></div>';
                                                                break;
                                                            case "instagram":
                                                                $tmp_html1 = '<span class="ig-follow" data-id="';
                                                                $tmp_html2 = '" data-handle="igfbdotcom" data-count="false" data-size="small" data-username="false"></span>';
                                                                break;
                                                            case "line":
                                                                $tmp_html1 = '<a class="_line" href="';
                                                                $tmp_html2 = '">Line連結</a>';
                                                                break;
                                                            case "pixnet":
                                                                $tmp_html1 = '<a class="_pixnet" href="';
                                                                $tmp_html2 = '">痞客邦</a>';
                                                                break;
                                                            default:
                                                                $tmp_html1 = '<a href="';
                                                                $tmp_html2 = '">作品連結</a>';
                                                                break;
                                                        }
                                                        
                                                        foreach ( $value as $key2 => $value2 ) {

                                                                $tmp_html .= "<div class='col-xs-12' style='margin: 5px 0; padding: 0px 24px;'>" .
                                                                                "<div class='col-xs-5' style='padding:0;'>" . $value2['name'] . "</div>" .
                                                                                "<div class='col-xs-7'>" .
                                                                                    $tmp_html1 . $value2['url'] . $tmp_html2 .
                                                                                "</div>" .
                                                                            "</div>";

                                                        };

                                                        if( $tmp_html !== "" )
                                                        {
                                                            $tmp_html .= '<hr class="col-xs-12" style="width: 90%;">';
                                                            echo $tmp_html;
                                                        }
                                                        
                                                }
                                                
                                            ?>
                                        </div>
                                        
                                        
                                        <div data-dismiss="modal" style="cursor: pointer; border: 2px solid white; text-align: center; left: 0px; right: 0px; position: relative; height: 45px; border-radius: 6px; background: gray none repeat scroll 0px 0px; margin-top: 70px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h3 style="color: white; text-align: center; font-size: 17px; margin: 0px;margin-right: 3px; font-size: 22px; margin-top: 10px;">取消</h3>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                </div>
                        </div>
                </div>
        </div>
        
        <script>
                
                $( "#myModalShare input" ).val( location.href );
                
                $( "#myModalReport .send" ).bind( "click" , function(){
                        
                        $.ajax({
                                    type: "POST",
                                    url: "php/report.php",
                                    data: {
                                            email       : $.member.email ,
                                            page        : getParameterByName("page_id") ,
                                            report      : $( "[name=report]:checked" ).val() ,
                                            text        : $( "#report_text" ).val()
                                    },
                                    success: function( data ) {
                                            
                                            console.log( data );
                                            if( data === "success" )
                                                alert( "success" );
                                            else if( data === "false" )
                                                alert( "false" );
                                            
                                            $( "#myModalReport" ).modal("toggle");
                                    }
                        });
                });
        </script>
        
        <!--script>!function(d,s,id){var js,ajs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://secure.assets.tumblr.com/share-button.js";ajs.parentNode.insertBefore(js,ajs);}}(document, "script", "tumblr-js");</script-->
        
        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="template/assets/js/bootstrap.js"></script>

        <script src="template/assets/js/jquery-ui.js"></script>
        <script src="template/assets/js/jquery.ui.touch-punch.js"></script>

        <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
        <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

        <script type="text/javascript">
                ace.vars['base'] = '..';
        </script>
        
        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>
        <script src="js/inner.js"></script>
        
        <script src="js/ajaxq.js"></script>

        <script type="text/javascript">
                jQuery(function($) {

                        //jquery tabs
                        $( "#tabs" ).tabs().show();
                });
        </script>
        
        <script type="text/javascript">
                
                $.ajax({
                            type: "POST",
                            url: "php/addone.php",
                            data: {
                                        article_id    : getParameterByName("page_id")
                            },
                            //dataType: "json",
                            success: function(data) {
                                    
                                    console.log( data );
                                    
                            }
                });
                
                $("document").ready(function() {
                    
                        $( "#loadingpage" ).hide();
                        getbody();
                        
                });
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            
                            $.Scroll_Event = [];
                            
                            user_getbody();
                            
                            //use_gettab_author( "recommendation" );
                            $( "#tab3" ).children( ".tab" ).children( "button[type=recommendation]" ).trigger("click");
                            
                            console.log( $(".fb-share-button") );
                            
                            //abin edit 2015.4.27 ++ 
                            Add_History();
                            //abin edit 2015.4.27 --
                };
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            
                            $.Scroll_Event = [];
                            
                            user_getbody();
                            
                            //use_gettab_author( "recommendation" );
                            $( "#tab3" ).children( ".tab" ).children( "button[type=recommendation]" ).trigger("click");
                            
                            console.log( $(".fb-share-button") );
                            
                            
                };

        </script>
        <script src="js/fb-login.js"></script>
        
        <script type="text/javascript">
            function Add_History() {
                    if( $.member.email != "" ) {
                            var callback = function( data ) {
                                console.log( data );
                            };
                            $.ajax({
                                        type: "POST",
                                        url: "php/manage_history.php",
                                        data: {
                                                cmd         : "add" ,
                                                data : {
                                                    email        : $.member.email ,
                                                    page        : getParameterByName("page_id") ,
                                                }
                                        },
                                        success: callback ,
                                        error: callback
                            });
                    }
            }
        </script>
        </body>

</html>
