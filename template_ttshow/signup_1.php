<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                
                <title>ttshow-註冊表格</title>
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

                <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />

        
                <script src="template/assets/js/jquery.js"></script>
                <script src="js/device.js"></script>
                <script src="js/create.js"></script>
                <script src="template/assets/js/jquery-ui.js"></script>
                <script src="template/assets/js/bootstrap.js"></script>
                
                <script type="text/javascript">
                        jQuery(function($) {

                                //jquery tabs
                                if( $( "#tabs" ).length )
                                $( "#tabs" ).tabs().show();



                        });
                </script>
                
                <script type="text/javascript">
                function FB_connected_callback_init() {
                    
                }
                function facebook_data_connected_callback_init( response )
                {
                            $.fbcallback = response;
                            
                            $( "#fb-login-button" ).removeClass( "nav-search" );
                            
                            $.getData = {};
                            var url = window.location.toString();
                            if( url.search("\\?") != -1 ) {
                                    var data = url.split("?")[1].split("&");
                                    for(var i=0;i<data.length;i++) {
                                            $.getData[data[i].split("=")[0]] = data[i].split("=")[1];
                                    }
                            }
                            insert_fbdata();
                }
                
                function FB_unconnected_callback_init()
                {
                            $( "#user-profile" ).hide();
                            
                            $( "#user-profile-join" ).hide();
                            
                            $( "#user-profile-join" ).unbind( "click" );
                };
                </script>
                
                
                
	</head>

	<body class="no-skin" style="background-color: #DDDDDD;">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay" style="width: 100%; height: 100%; z-index: 10;">
                <div style="position: fixed; margin: auto; right: 0px; left: 0px; bottom: 0px; top: -30px; height: 0px;">
                        <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
                </div>
        </div>
        
        <div id="TTShowAD" style="text-align: left; z-index: 5; position: absolute; top: 0px; height: 100%; width: 100%; display: block;" class="widget-box-overlay">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="right: 0px; color: rgb(238, 238, 238); position: absolute; border-radius: 4px; top: 100px; text-align: center; width: 90%; max-width: 350px; min-width: 300px; margin: 0px auto auto; left: 0px; font-size: 20px; font-weight: bold; background: linear-gradient(to bottom, rgb(5, 35, 61) 0%, rgb(14, 44, 70) 48%, rgb(25, 56, 82) 100%) repeat scroll 0px 0px transparent;">
                        <ol class="carousel-indicators" style="position: absolute; bottom: 0px;">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                        </ol>

                        <div class="carousel-inner" role="listbox" style="margin-bottom: 35px;">
                                <div class="item active">
                                        <div id="AD_1" style="padding: 0px 5px">
                                                <img id="closeAD" class="close" src="images/x-white.png" style="position: absolute; height: 25px; right: 8px; top: 8px; opacity: 0.6;">
                                                <img src="template/assets/img/ad_01.png" style="opacity: 1; top: 0px; margin: auto; left: 0px; right: 0px; width: 100%;">
                                        </div>

                                        <div style="padding: 0px 10px;">
                                            <div style="width: 100%; height: 40px; border-radius: 5px; background: rgb(232, 24, 24);">
                                                <div style="position: absolute; right: 0px; left: 20px; margin: auto; width: 240px; line-height: 40px;">
                                                    <div style="font-size: 20pt; float: left;">立即申請</div>
                                                    <div>免費獲得宣傳</div>  
                                                </div>
                                            </div>
                                        </div>

                                        <h3 style="color: white; font-size: 15px; height: 19px; margin: 10px;">加入台灣達人秀相關社群</h3>

                                        <div style="margin-top: 5px; padding-right: 0px; margin-bottom: 18px; height: 20px;" class="col-xs-12">
                                                <div style="position: absolute; width: 260px; margin: auto; right: 0px; left: 0px;">
                                                        <div class="fb-like" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" style="height: 30px; float: left; position: relative; width: 80px; top: 3px; left: -5px;"></div>
                                                        <div id="___ytsubscribe_0" style="vertical-align: baseline; width: 140px; float: left; margin-left: 10px;">
                                                            <iframe width="100%" frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 450px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 24px;" tabindex="0" vspace="0" id="I0_1431292523668" name="I0_1431292523668" src="https://www.youtube.com/subscribe_embed?usegapi=1&amp;count=default&amp;layout=default&amp;channel=TaiwanTalentShow&amp;origin=http%3A%2F%2Fwww.ooxxoox.com&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.zh_TW.RzDm2vP6L2U.O%2Fm%3D__features__%2Fam%3DMQ%2Frt%3Dj%2Fd%3D1%2Ft%3Dzcms%2Frs%3DAGLTcCNXyRIKTytHqefPXguk563-bgK3sw#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh%2Conload&amp;id=I0_1431292523668&amp;parent=http%3A%2F%2Fwww.ooxxoox.com&amp;pfname=&amp;rpctoken=29766853" data-gapiattached="true"></iframe>
                                                        </div>
                                                        <div style="position: relative; float: left; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid gray; height: 25px; width: 25px;">
                                                            <div style="line-height: 25px; color: gray;">
                                                                +
                                                            </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <div class="item">
                                        <div id="AD_2" style="">
                                                <img id="closeAD" style="position: absolute; height: 25px; right: 8px; top: 8px; opacity: 0.6;" src="template/assets/img/x1.png" class="close">
                                                <img style="opacity: 1; top: 0px; left: 0px; right: 0px; width: 100%; margin: auto auto 15px;" src="template/assets/img/ad_02.png">
                                        </div>

                                        <div style="padding: 0px 10px;">
                                            <div style="width: 100%; height: 40px; border-radius: 5px; background: rgb(232, 24, 24);">
                                                <div style="position: absolute; right: 0px; left: 20px; margin: auto; width: 240px; line-height: 40px;">
                                                    <div style="font-size: 20pt; float: left;">立即申請</div>
                                                    <div>免費獲得宣傳</div>  
                                                </div>
                                            </div>
                                        </div>

                                        <h3 style="color: white; font-size: 15px; height: 19px; margin: 10px;">加入台灣達人秀相關社群</h3>

                                        <div style="margin-top: 5px; padding-right: 0px; margin-bottom: 18px; height: 20px;" class="col-xs-12">
                                                <div style="position: absolute; width: 260px; margin: auto; right: 0px; left: 0px;">
                                                        <div class="fb-like" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" style="height: 30px; float: left; position: relative; width: 80px; top: 3px; left: -5px;"></div>
                                                        <div id="___ytsubscribe_0" style="vertical-align: baseline; width: 140px; float: left; margin-left: 10px;">
                                                            <iframe width="100%" frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 450px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 24px;" tabindex="0" vspace="0" id="I0_1431292523668" name="I0_1431292523668" src="https://www.youtube.com/subscribe_embed?usegapi=1&amp;count=default&amp;layout=default&amp;channel=TaiwanTalentShow&amp;origin=http%3A%2F%2Fwww.ooxxoox.com&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.zh_TW.RzDm2vP6L2U.O%2Fm%3D__features__%2Fam%3DMQ%2Frt%3Dj%2Fd%3D1%2Ft%3Dzcms%2Frs%3DAGLTcCNXyRIKTytHqefPXguk563-bgK3sw#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh%2Conload&amp;id=I0_1431292523668&amp;parent=http%3A%2F%2Fwww.ooxxoox.com&amp;pfname=&amp;rpctoken=29766853" data-gapiattached="true"></iframe>
                                                        </div>
                                                        <div style="position: relative; float: left; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid gray; height: 25px; width: 25px;">
                                                            <div style="line-height: 25px; color: gray;">
                                                                +
                                                            </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        
        <?php include( "header_1.php"); ?>
         
        <div class="main-container" id="main-container" style="background-color: white;">
            <div style="max-width: 800px; position: absolute; margin: auto; right: 0px; left: 0px;">

                    <div style="margin-top: 20px; margin-bottom: 15px;">        
                            <div style="border-left: 3px solid rgb(30, 89, 144); padding-left: 5px; font-weight: bold; font-size: 17pt; height: 30px;">
                                    <div style="position: relative; top: 6px;">
                                        註冊台灣達人秀
                                    </div>
                            </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 30px; background: white;">
                            <div id="upload_place" style="margin: 0px 0px 30px; padding: 0px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                    <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(30, 89, 144); padding: 15px 0px;">
                                            <div id="usericon" class="chessboard-icon bg_top" img="" style="position: absolute; margin: 0px auto; left: 0px; right: 0px; background-image: url(&quot;template/assets/img/icon_uplaod-02.png&quot;); height: 49px; width: 60px; top: 15px;"></div>
                                            <div style="margin-bottom: 5px" class="clearfix"></div>
                                            <p style="font-size: 13px; letter-spacing: 1px; color: white; margin: 55px 0px 0px;">大頭貼照</p>
                                    </label>
                                    <label class="ace-file-input ace-file-multiple col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(229, 229, 229); padding: 15px 0px; cursor: pointer;">
                                            <input id="transient_file" type="file" multiple="" target="usericon">
                                            <img style="" src="template/assets/img/uplaod-01.png" alt="ttshow">
                                            <div style="margin-bottom: 5px" class="clearfix"></div>
                                            <span style="font-size: 13px; letter-spacing: 1px; color: black;">上傳</span>
                                            <a href="#" class="remove">
                                                    <i class=" ace-icon fa fa-times"></i>
                                            </a>

                                            <div style="position: absolute; width: 120%; height: 30px; bottom: -30px; left: -30px;">
                                                <div id="bar"></div>
                                            </div>
                                    </label>                                        
                            </div>

                            <div style="width : 70%; font-size: 12pt;">

                                    <div style="margin-bottom: 20px;">
                                            <div>
                                                電子信箱<span style="margin-left: 5px; color: red;">*</span>
                                            </div>

                                            <input id="form_email" style="margin: 5px 0;" type="text" placeholder="" class="form-control" disabled>
                                            <small style="color: #ABBAC3; font-size: 8pt;">
                                                不對外公開
                                            </small>
                                    </div>

                                    <div id="form_password" style="margin-bottom: 20px; display: none;">
                                            <div>
                                                密碼<span style="margin-left: 5px; color: red;">*</span>
                                            </div>
                                            <input style="margin: 5px 0;" type="password" placeholder="" class="form-control">
                                    </div>

                                    <div id="form_password" style="margin-bottom: 20px; display: none;">
                                            <div>
                                                再次確認<span style="margin-left: 5px; color: red;">*</span>
                                            </div>
                                            <input style="margin: 5px 0;" type="password" placeholder="" class="form-control">
                                            <small style="color: #ABBAC3; font-size: 8pt;">
                                                再次確認
                                            </small>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                            <div>
                                                暱稱<span style="margin-left: 5px; color: red;">*</span>
                                            </div>
                                            <input id="form_nickname" style="margin: 5px 0;" type="text" placeholder="" class="form-control">
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                            <div style="margin-bottom: 5px;">生日</div>
                                            <script type="text/javascript">
                                                    $("document").ready(function() {
                                                            var now = new Date();
                                                            var year = now.getFullYear();
                                                            for(var i=0;i<200;i++) {
                                                                $("#birthday_y").append('<option value="' + (year-i) + '">' + (year-i) + '年</option>');
                                                            }
                                                            var Chinese = ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"];
                                                            for(var i=1;i<13;i++) {
                                                                $("#birthday_m").append( '<option value="' + i + '" titile="' + Chinese[i-1] + '">' + Chinese[i-1] + '</option>');
                                                            }
                                                            $( "#birthday_y" ).change(function() {
                                                                    var val = $( "#birthday_y" ).val();
                                                                    if( $( "#birthday_m" ).val() == 2 ) {
                                                                            if( val %4 == 0 ) {
                                                                                    var day = 29;
                                                                            } else {
                                                                                    var day = 28;
                                                                            }
                                                                            $("#birthday_d").html("");
                                                                            $("#birthday_d").append('<option value="0">日</option>');
                                                                            for(var i=1;i<day+1;i++) {
                                                                                    $("#birthday_d").append("<option value=" + i + ">" + i + "日</option>");
                                                                            }
                                                                    }
                                                            });
                                                            $( "#birthday_m" ).change(function() {
                                                                    var val = $( "#birthday_m" ).val();
                                                                    var day = 0;
                                                                    if( val == 2 ) {
                                                                            if( $("#birthday_y").val() %4 == 0 ) {
                                                                                    day = 29;
                                                                            }
                                                                            else {
                                                                                    day = 28;
                                                                            }
                                                                    }
                                                                    else if( (val%2 == 1 && val < 8 ) || (val%2 == 0 && val > 7 ) ) {
                                                                        day = 31;
                                                                    } else if( (val%2 == 0 & val < 7 ) || (val%2 == 1 & val > 8 ) ) {
                                                                        day = 30;
                                                                    }
                                                                    $("#birthday_d").html("");
                                                                    $("#birthday_d").append('<option value="0">日</option>');
                                                                    for(var i=1;i<day+1;i++) {
                                                                            $("#birthday_d").append("<option value=" + i + ">" + i + "日</option>");
                                                                    }
                                                            });
                                                    });
                                            </script>
                                            <select id="birthday_y" style="width: 30%; margin-right: 5px;">
                                                <option value="">年</option>
                                            </select>

                                            <select id="birthday_m" style="width: 30%; margin-right: 5px;">
                                                <option value="">月</option>
                                            </select>

                                            <select id="birthday_d" style="width: 30%; margin-right: 5px;">
                                                <option value="">日</option>
                                            </select>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                            <div style="margin-bottom: 5px;">性別</div>
                                            <input type="radio" checked="" name="form_sex" value="man">
                                            <span class="lbl">男</span>
                                            <input type="radio" name="form_sex" value="woman" style="margin-left: 20px">
                                            <span class="lbl">女</span>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                            <div>居住地</div>
                                            <div id="twzipcode" style="padding-top: 5px; width: 100%;">
                                                <select name="county" class="county" style="width: 100%;"><option value="">縣市</option><option value="基隆市">基隆市</option><option value="台北市">台北市</option><option value="新北市">新北市</option><option value="宜蘭縣">宜蘭縣</option><option value="新竹市">新竹市</option><option value="新竹縣">新竹縣</option><option value="桃園市">桃園市</option><option value="苗栗縣">苗栗縣</option><option value="台中市">台中市</option><option value="彰化縣">彰化縣</option><option value="南投縣">南投縣</option><option value="嘉義市">嘉義市</option><option value="嘉義縣">嘉義縣</option><option value="雲林縣">雲林縣</option><option value="台南市">台南市</option><option value="高雄市">高雄市</option><option value="屏東縣">屏東縣</option><option value="台東縣">台東縣</option><option value="花蓮縣">花蓮縣</option><option value="金門縣">金門縣</option><option value="連江縣">連江縣</option><option value="澎湖縣">澎湖縣</option><option value="南海諸島">南海諸島</option></select>
                                            </div>
                                            <!--input type="text" class="form-control" placeholder="" style="height: 30px; margin-top: 40px; width: 100%;" id="residence"-->
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                            <div>聯絡電話</div>
                                            <input id="form_phone" style="margin: 5px 0px;" type="text" placeholder="" class="form-control">
                                            <small style="color: #ABBAC3; font-size: 8pt;">
                                              不對外公開
                                            </small>
                                    </div>

                                    <div style="margin-bottom: 40px;">
                                            <input id="check" type="checkbox">
                                            我已經閱讀並同意
                                            <a style="color: blue;" href="termofuse.php" target="apple">
                                                    &nbsp;使用條款&nbsp;
                                            </a>
                                            和
                                            <a style="color: blue;" href="privacy.php" target="apple">
                                                    &nbsp;隱私權聲明。
                                            </a>
                                    </div>
                            </div>

                            <div style="background: none repeat scroll 0% 0% white; padding-bottom: 30px;margin-top: -10px" class="wizard-actions col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div style="text-align: center; margin-bottom: 100px;" class="">
                                            <button id="cancel" style="font-weight: bold; background-color: white ! important; border: 1px solid gray; width: 215px; color: gray ! important; padding: 10px 0px;" class="btn btn-prev">
                                                    取消
                                            </button>

                                            <button id="accept" style="width: 215px; font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important;" class="btn btn-success btn-next">
                                                    完成
                                            </button>
                                    </div>
                            </div>
                    </div>
            </div>
        </div>
        
        
        <div class="widget-box-overlay" style="position: fixed; text-align: left; z-index: 1500; display: none;" id="TTShowAD">
                <div style="margin-top: 3%; margin-right: auto; position: fixed; margin-left: auto; left: 0px; right: 0px; text-align: center; font-size: 20px; line-height: 20px; font-weight: bold; color: rgb(238, 238, 238); border-radius: 4px; background: linear-gradient(to bottom, rgb(5, 35, 61) 0%, rgb(14, 44, 70) 48%, rgb(25, 56, 82) 100%) repeat scroll 0px 0px transparent; width: 25%; padding: 5px 5px 14px;">
                        <img style="position: absolute; height: 25px; right: 8px; top: 8px; opacity: 0.6;" src="images/x-white.png" class="close">
                        <img style="opacity: 1; top: 0px; margin: auto; left: 0px; right: 0px; width: 100%;" src="http://www.ooxxoox.com/al/mobile/template/assets/images/apply/ad_01.png">
                        <img src="http://www.ooxxoox.com/al/mobile/template/assets/images/apply/ad_btn.png" style="opacity: 1; margin: auto; left: 0px; right: 0px; top: 0px; width: 95%;">

                        <h3 style="color: white; font-size: 15px; height: 19px; margin: 10px;">加入台灣達人秀相關社群</h3>

                        <div class="col-xs-5" style="margin-top: 5px; padding-right: 0px; margin-bottom: 18px;">
                                <!--div class="fb-like" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="standard" data-action="like" data-show-faces="true"></div-->
                                <div fb-iframe-plugin-query="action=like&amp;app_id=790908150987982&amp;container_width=0&amp;href=https%3A%2F%2Fwww.facebook.com%2FTaiwanTalentShow&amp;layout=button&amp;locale=en_US&amp;sdk=joey&amp;share=false&amp;show_faces=false" fb-xfbml-state="rendered" class="fb-like fb_iframe_widget" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="button" data-action="like" data-show-faces="false" data-share="false"><span style="vertical-align: bottom; width: 47px; height: 20px;"><iframe width="1000px" height="1000px" frameborder="0" class="" src="http://www.facebook.com/v2.2/plugins/like.php?action=like&amp;app_id=790908150987982&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FKTWTb9MY5lw.js%3Fversion%3D41%23cb%3Dfff7e29fb38792%26domain%3Dwww.ooxxoox.com%26origin%3Dhttp%253A%252F%252Fwww.ooxxoox.com%252Ff366168fef5e6b6%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fwww.facebook.com%2FTaiwanTalentShow&amp;layout=button&amp;locale=en_US&amp;sdk=joey&amp;share=false&amp;show_faces=false" style="border: medium none; visibility: visible; width: 47px; height: 20px;" title="fb:like Facebook Social Plugin" scrolling="no" allowfullscreen="true" allowtransparency="true" name="f2cc2dd9e0e259e"></iframe></span></div>
                        </div>
                        <div style="margin-top: 5px; padding-right: 0px; margin-bottom: 18px;" class="col-xs-6">
                                <div id="___ytsubscribe_0" style="text-indent: 0px; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 450px; height: 24px;"><iframe width="100%" frameborder="0" data-gapiattached="true" src="https://www.youtube.com/subscribe_embed?usegapi=1&amp;count=default&amp;layout=default&amp;channel=TaiwanTalentShow&amp;origin=http%3A%2F%2Fwww.ooxxoox.com&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.zh_TW.RzDm2vP6L2U.O%2Fm%3D__features__%2Fam%3DMQ%2Frt%3Dj%2Fd%3D1%2Ft%3Dzcms%2Frs%3DAGLTcCNXyRIKTytHqefPXguk563-bgK3sw#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh%2Conload&amp;id=I0_1431292523668&amp;parent=http%3A%2F%2Fwww.ooxxoox.com&amp;pfname=&amp;rpctoken=29766853" name="I0_1431292523668" id="I0_1431292523668" vspace="0" tabindex="0" style="position: static; top: 0px; width: 450px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 24px;" scrolling="no" marginwidth="0" marginheight="0" hspace="0"></iframe></div>
                        </div>
                                <ol class="index-slidershow carousel-indicators" style="margin-right: auto; margin-bottom: auto; margin-left: auto; left: 0px; right: 0px;">
                                        <li class="active" data-slide-to="1" data-target="#carousel-example-generic" style="margin-left: 7px;"></li>
                                        <li class="" data-slide-to="2" data-target="#carousel-example-generic" style="margin-left: 7px;"></li>
                                </ol>
                </div>
        </div>
        
        <div class="widget-box-overlay" style="position: fixed; text-align: left; z-index: 1500; display: none;" id="TTShowAD">
                <div style="margin-top: 3%; margin-right: auto; position: fixed; margin-left: auto; left: 0px; right: 0px; text-align: center; font-size: 20px; line-height: 20px; font-weight: bold; color: rgb(238, 238, 238); border-radius: 4px; background: linear-gradient(to bottom, rgb(5, 35, 61) 0%, rgb(14, 44, 70) 48%, rgb(25, 56, 82) 100%) repeat scroll 0px 0px transparent; width: 25%; padding: 0px 0px 14px;">
                        <img style="position: absolute; height: 25px; right: 8px; top: 8px; opacity: 0.6;" src="http://www.ooxxoox.com/al/mobile/template/assets/images/apply/x1.png" class="close">
                        <img style="opacity: 1; top: 0px; left: 0px; right: 0px; width: 100%; margin: auto auto 15px;" src="http://www.ooxxoox.com/al/mobile/template/assets/images/apply/ad_02.png">
                        <img src="http://www.ooxxoox.com/al/mobile/template/assets/images/apply/ad_btn.png" style="opacity: 1; margin: auto; left: 0px; right: 0px; top: 0px; width: 95%; padding: 0px 5px;">

                        <h3 style="color: white; font-size: 15px; height: 19px; margin: 8px 0px 5px;">加入台灣達人秀相關社群</h3>

                        <div class="col-xs-5" style="margin-top: 5px; padding-right: 0px; margin-bottom: 18px;">
                                <!--div class="fb-like" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="standard" data-action="like" data-show-faces="true"></div-->
                                <div fb-iframe-plugin-query="action=like&amp;app_id=790908150987982&amp;container_width=0&amp;href=https%3A%2F%2Fwww.facebook.com%2FTaiwanTalentShow&amp;layout=button&amp;locale=en_US&amp;sdk=joey&amp;share=false&amp;show_faces=false" fb-xfbml-state="rendered" class="fb-like fb_iframe_widget" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="button" data-action="like" data-show-faces="false" data-share="false"><span style="vertical-align: bottom; width: 47px; height: 20px;"><iframe width="1000px" height="1000px" frameborder="0" class="" src="http://www.facebook.com/v2.2/plugins/like.php?action=like&amp;app_id=790908150987982&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FKTWTb9MY5lw.js%3Fversion%3D41%23cb%3Dfff7e29fb38792%26domain%3Dwww.ooxxoox.com%26origin%3Dhttp%253A%252F%252Fwww.ooxxoox.com%252Ff366168fef5e6b6%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fwww.facebook.com%2FTaiwanTalentShow&amp;layout=button&amp;locale=en_US&amp;sdk=joey&amp;share=false&amp;show_faces=false" style="border: medium none; visibility: visible; width: 47px; height: 20px;" title="fb:like Facebook Social Plugin" scrolling="no" allowfullscreen="true" allowtransparency="true" name="f2cc2dd9e0e259e"></iframe></span></div>
                        </div>
                        <div style="margin-top: 5px; padding-right: 0px; margin-bottom: 18px;" class="col-xs-6">
                                <div id="___ytsubscribe_0" style="text-indent: 0px; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 450px; height: 24px;"><iframe width="100%" frameborder="0" data-gapiattached="true" src="https://www.youtube.com/subscribe_embed?usegapi=1&amp;count=default&amp;layout=default&amp;channel=TaiwanTalentShow&amp;origin=http%3A%2F%2Fwww.ooxxoox.com&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.zh_TW.RzDm2vP6L2U.O%2Fm%3D__features__%2Fam%3DMQ%2Frt%3Dj%2Fd%3D1%2Ft%3Dzcms%2Frs%3DAGLTcCNXyRIKTytHqefPXguk563-bgK3sw#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh%2Conload&amp;id=I0_1431292523668&amp;parent=http%3A%2F%2Fwww.ooxxoox.com&amp;pfname=&amp;rpctoken=29766853" name="I0_1431292523668" id="I0_1431292523668" vspace="0" tabindex="0" style="position: static; top: 0px; width: 450px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 24px;" scrolling="no" marginwidth="0" marginheight="0" hspace="0"></iframe></div>
                        </div>
                                <ol class="index-slidershow carousel-indicators" style="margin-right: auto; margin-bottom: auto; margin-left: auto; left: 0px; right: 0px;">
                                        <li class="active" data-slide-to="1" data-target="#carousel-example-generic" style="margin-left: 7px;"></li>
                                        <li class="" data-slide-to="2" data-target="#carousel-example-generic" style="margin-left: 7px;"></li>
                                </ol>
                </div>
        </div>


        </body>

        <script src="js/apps.js"></script>
        <script src="js/view_upload_img.js"></script>
        <script src="js/jquery.twzipcode.min.js"></script>
        <script src="js/fb-login.js"></script>
        
        <style>
                .zipcode { display: none; }
                .county { margin-right: 10px !important; }
                .district { margin-right: 10px !important; }
        </style>
        
        <script type="text/javascript">

                $("document").ready(function() {
                    
                        //init web ++
                        $(window).scrollTop( 0 );
                        var height = $(document).height();
                        $( "#loadingpage" ).css("height", height + 190 + "px");
                        $( "#TTShowAD" ).css("height", height + 190 + "px");
                        $("input[type=text]").val("");
                        $("input[type=password]").val("");
                        $("input[type=radio]").eq(0)[0].checked = false;
                        $("input[type=radio]").eq(1)[0].checked = false;
                        $("input[type=checkbox]")[0].checked = false;
                        $("[id^='birthday_']").val("");
                        
                        $("#header_draft").remove();
                        $("#header_login").remove();
                        
                        //init web --
                        
                        $.getData = {};
                        var url = window.location.toString();
                        if( url.search("\\?") != -1 ) {
                                var data = url.split("?")[1].split("&");
                                for(var i=0;i<data.length;i++) {
                                        $.getData[data[i].split("=")[0]] = data[i].split("=")[1];
                                }
                        }
                        
                        if( $.getData["signup"] == "fb" ) {
                                /*
                                $.getScript("js/fb-login.js", function(){
                                });
                                */
                        } else if( $.getData["signup"] == "general" ) {
                                $("[id=form_password]").css("display","block");
                                $( "#loadingpage" ).hide();
                        } 
                        
                        $.upload_file = {};
                        $.upload_file.beforeunload = {};
                        $( "#cancel" ).unbind('click').bind( "click" , function(e) {
                        });
                        $( "[id=closeAD]" ).unbind('click').bind( "click" , function(e) {
                                $("#TTShowAD").css("display","none");
                        });
                        $( "#TTShowAD" ).unbind('click').bind( "click" , function(e) {
                                $("#TTShowAD").css("display","none");
                        });
                        $( "#accept" ).unbind('click').bind( "click" , function(e) {
                                //input data ++
                                var data = process_inputdata();
                                //input data --
                                
                                //cheack input ++
                                if( !cheack_data(data) ) {
                                    return 0;
                                }
                                //cheack input --
                                
                                
                                $( "#loadingpage" ).show();
                                if( $.getData["signup"] == "fb" ) {
                                        data.cmd = "addbyfb";
                                        data.facebook_mail = $.fbcallback.email;
                                        facebook_apply( data );
                                        console.log( data );
                                } else if( $.getData["signup"] == "general" ) {
                                        data.cmd = "add";
                                        data.facebook_mail = data.email;
                                        data.paw = md5($("[id=form_password] input").eq(0).val());
                                        general_apply( data );
                                        console.log( data );
                                }
                        });
                        
                        var delete_transient_file = function() {
                                $.ajax({
                                            type: "POST",
                                            url: "php/signup.php",
                                            data: {
                                                cmd            : "transient_file" ,
                                                transient_file : $.upload_file.transient_file ,
                                            },
                                            success: function( data ) { return null; } ,
                                            error: function( data ) { console.log( data ); }
                                });
                        }
                        $(window).on('beforeunload', delete_transient_file );
                        $(window).unload( delete_transient_file );
                });
                
                var process_inputdata = function() {
                        var bir = $("#birthday_y").val() + "/" + $("#birthday_m").val() + "/" + $("#birthday_d").val();
                        if( bir != "//") {
                            var time = new Date(bir);
                            bir = time.getTime();
                        } else {
                            bir = "null";
                        }
                        var usericon = "";
                        if( $("#usericon").attr("img").lastIndexOf("facebook") == -1 ) {
                                usericon = $("#usericon").attr("img");
                                usericon = usericon.substr( usericon.lastIndexOf("/")+1 , usericon.length);
                        } else {
                                usericon = $("#usericon").attr("img");
                        }
                        
                        var address = "";
                        address = $("#twzipcode select").eq(0).val();
                        
                        var data = {
                                usericon       : usericon,
                                email          : $("#form_email").val() ,
                                nickname       : $("#form_nickname").val() ,
                                birthday       : bir ,
                                sex            : $("input[name=form_sex]:checked").val() ,
                                address        : address ,
                                phone          : $("#form_phone").val()
                        }
                        return data;
                }
             
                var cheack_data = function(data) {
                        var bool = true;
                        $("input").css("border" , "");
                        if( data.email == "" || data.email.indexOf("@") == -1 || data.email.indexOf(".") == -1 ) {
                            bool = false;
                            $("#form_email").css("border" , "1px solid red");
                            $(window).scrollTop( 150 );
                        }
                        if( $.getData["signup"] == "general" ) {
                                if( $("[id=form_password] input").eq(0).val() == "" ) {
                                        bool = false;
                                        $("[id=form_password] input").eq(0).css("border" , "1px solid red");
                                        $(window).scrollTop( 150 );
                                }
                                else if( $("[id=form_password] input").eq(0).val() != $("[id=form_password] input").eq(1).val() ) {
                                        bool = false;
                                        $("[id=form_password] input").css("border" , "1px solid red");
                                        $(window).scrollTop( 150 );
                                }
                        }
                        if( data.nickname == "" ) {
                            bool = false;
                            $("#form_nickname").css("border" , "1px solid red");
                            $(window).scrollTop( 150 );
                        }
                        
                        if( !$("#check")[0].checked && bool ) {
                            bool = false;
                            alert("合約尚未閱讀");
                        }
                        
                        return bool;
                }
             
                var facebook_apply = function( data ) {
                        $.ajax({
                                    type: "POST",
                                    url: "php/signup.php",
                                    data: data,
                                    success: function( data ) {
                                            try {
                                                    var data = JSON.parse(data);
                                                    console.log( data );
                                                    if( data.success == "true" ) {
                                                        
                                                        $.ajax({
                                                                type: "POST",
                                                                url: "php/member.php?func=loginbyFB",
                                                                data: {
                                                                    email : $.fbcallback.email
                                                                },
                                                                //dataType: "json",
                                                                success: function(data) {
                                                                    //data = JSON.parse( data );
                                                                    if( data !== "false" && data !== "first" )
                                                                    {
                                                                            
                                                                            setCookie("ttshow", data);
                                                                            location.href = "signup_2.php";
                                                                    }

                                                                }
                                                        });
                                                        
                                                    }
                                                    else if( data.success == "false" && data.describe == "email" ) {
                                                            alert("email 重複");
                                                            $("#form_email").css("border" , "1px solid red");
                                                            $( "#loadingpage" ).hide();
                                                    }
                                            }catch(e) {
                                                    console.log(e);
                                            }
                                    } ,
                                    error: function( data ) { console.log( data ); }
                        }); 
                }
                
                var general_apply = function( data ) {
                        $.ajax({
                                    type: "POST",
                                    url: "php/signup.php",
                                    data: data,
                                    success: function( data ) { 
                                            try {
                                                    var data = JSON.parse(data);
                                                    if( data.success == "true" ) {
                                                        location.href = "signup_2.php";
                                                    }
                                                    else if( data.success == "false" && data.describe == "email" ) {
                                                            alert("email 重複");
                                                            $("#form_email").css("border" , "1px solid red");
                                                            $( "#loadingpage" ).hide();
                                                    }
                                            }catch(e) {
                                                    console.log(e);
                                            }
                                    } ,
                                    error: function( data ) { console.log( data ); }
                        });                     
                }
                
                
                
                var insert_fbdata = function() {
                        if( $.getData["signup"] == "fb" ) {
                        /*
                        var bir = $("#birthday_y").val() + "/" + $("#birthday_m").val() + "/" + $("#birthday_d").val();
                        if( bir != "//") {
                            var time = new Date(bir);
                            bir = time.getTime();
                        } else {
                            bir = "null";
                        }
                        var usericon = $("#usericon").attr("img");
                        */
                        $("#usericon").css( "background-image" , "url('http://graph.facebook.com/" + $.fbcallback.id + "/picture')" );
                        $("#usericon").attr( "img" , "http://graph.facebook.com/" + $.fbcallback.id + "/picture" );
                        $("#form_email").val( $.fbcallback.email );
                        $("#form_nickname").val( $.fbcallback.name );
                        $( "#loadingpage" ).hide();
                        //birthday       : bir ,
                        //sex            : $("input[name=form_sex]:checked").val() ,
                        //address        : $("#form_address").val(),
                        //.phone          : $("#form_phone").val()
                        }
                }
        </script>
</html>
