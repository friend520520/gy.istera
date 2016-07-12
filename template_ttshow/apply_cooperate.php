<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                
                <title>ttshow-申請合作頻道</title>
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
                
                <script src="js/view_upload_img.js"></script>
                
                <script type="text/javascript">
                        jQuery(function($) {
                                //jquery tabs
                                if( $( "#tabs" ).length )
                                $( "#tabs" ).tabs().show();
                        });
                </script>
                <script src="js/fb-login.js"></script>

                <script type="text/javascript">

                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            $.user_mail = $.member.email;
                            $( "#main-container" ).show();
                            $( "#loadingpage" ).hide();
                }
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            $( "#pagecontent" ).hide();
                            $( "#main-container" ).hide();
                            Login_Popup_show();
                };
                
                function unlogin_jump()
                {
                            location.href = "index.php";
                }
                </script>
                
                
                
	</head>

	<body class="no-skin" style="background-color: #DDDDDD;">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay" style="width: 100%; height: 100%;">
                <div style="position: fixed; margin: auto; right: 0px; left: 0px; bottom: 0px; top: -30px; height: 0px;">
                        <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
                </div>
        </div>
        
        <?php include( "header_1.php"); ?>
         
        <div class="main-container" id="main-container" style="background-color: white;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div style="max-width: 800px; margin: auto; right: 0px; left: 0px; ">
                            
                                <div style="position: relative; text-align: center; font-weight: bold; padding: 30px; margin-bottom: 40px;">
                                        <div style="margin-bottom: 30px;">
                                            <span style="font-size: 18pt;">申請合作頻道</span>
                                            <span style="color: red; font-size: 8pt; margin-left: 10px;">審核制</span>
                                        </div>
                                    
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                                            
                                            <div id="title_icon_1" style="border-radius: 100%; height: 25px; width: 25px; background-color: rgb(30, 89, 144); position: absolute;">
                                                <div id="text" style="position: absolute; font-size: 14pt; color: white; top: 4px; left: 7px;">1</div>
                                                <div id="text2" style="height: 25px; position: absolute; top: 30px; width: 70px; left: -23px; color: rgb(30, 89, 144);">頻道資料</div>
                                            </div>
                                            
                                            <div id="title_icon_2" style="border-radius: 100%; height: 25px; width: 25px; position: absolute; left: 48%; background-color: gray;">
                                                <div id="text" style="position: absolute; font-size: 14pt; top: 4px; left: 7px; color: white;">2</div>
                                                <div id="text2" style="height: 25px; position: absolute; top: 30px; width: 70px; left: -23px;">社群資訊</div>
                                            </div>
                                            
                                            <div id="title_icon_3" style="border-radius: 100%; height: 25px; width: 25px; position: absolute; right: 0px; background-color: gray;">
                                                <div id="text" style="position: absolute; font-size: 14pt; color: white; top: 4px; left: 7px;">3</div>
                                                <div id="text2" style="height: 25px; position: absolute; top: 30px; width: 70px; left: -23px;">完成</div>
                                            </div>
                                            
                                            <div style="position: absolute; z-index: -1; left: 15px; background-color: gray; width: 96%; height: 5px; top: 10px;"></div>
                                        </div>
                                </div>

                                <div id="cooperate_form1" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 30px; background: white;">
                                        <div id="upload_place" style="margin: 0px 0px 30px; padding: 0px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 30px; margin-left: 0px; margin-right: 0px; padding: 0px;">
                                                        <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(30, 89, 144); padding: 15px 0px;">
                                                                <div id="cooperate_cover" class="chessboard-icon bg_top" img="" style="position: absolute; margin: 0px auto; left: 0px; right: 0px; background-image: url('template/assets/img/flat.png'); height: 50px; width: 40px; top: 15px;"></div>
                                                                <div style="margin-bottom: 5px" class="clearfix"></div>
                                                                <p style="font-size: 13px; letter-spacing: 1px; color: white; margin: 55px 0px 0px;">頻道封面</p>
                                                        </label>
                                                        <label class="ace-file-input ace-file-multiple col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(229, 229, 229); padding: 15px 0px; cursor: pointer;">
                                                                <input id="transient_file" type="file" multiple="" target="cooperate_cover">
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
                                            
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-left: 0px; margin-right: 0px; padding: 0px;">
                                                        <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(30, 89, 144); padding: 15px 0px;">
                                                                <div id="cooperate_icon" class="chessboard-icon bg_top" img="" style="position: absolute; margin: 0px auto; left: 0px; right: 0px; background-image: url('template/assets/img/flat.png'); height: 50px; width: 40px; top: 15px;"></div>
                                                                <div style="margin-bottom: 5px" class="clearfix"></div>
                                                                <p style="font-size: 13px; letter-spacing: 1px; color: white; margin: 55px 0px 0px;">頻道大頭貼照</p>
                                                        </label>
                                                        <label class="ace-file-input ace-file-multiple col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-radius: 0px; display: inline-block; position: relative; text-align: center; background-color: rgb(229, 229, 229); padding: 15px 0px; cursor: pointer;">
                                                                <input id="transient_file" type="file" multiple="" target="cooperate_icon">
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
                                        </div>
                                    
                                        <div style="width : 100%; font-size: 12pt;">
                                            
                                                <div style="margin-bottom: 20px;">
                                                        <div>
                                                            頻道名稱
                                                            <span style="margin-left: 5px; color: red;">*</span>
                                                        </div>
                                                    
                                                        <input id="cooperate_name" style="margin: 5px 0;" type="text" placeholder="" class="form-control">
                                                </div>
                                            
                                                <!--div style="margin-bottom: 20px;">
                                                        <div>
                                                            登入身分
                                                            <span style="margin-left: 5px; color: red;">*</span>
                                                        </div>
                                                    
                                                        <select id="cooperate_usertype" style="width: 100%; margin-right: 5px;">
                                                            <option value=""></option>
                                                            <option value="導演">導演</option>
                                                            <option value="插畫家">插畫家</option>
                                                            <option value="編劇">編劇</option>
                                                            <option value="官方">官方</option>
                                                            <option value="演員">演員</option>
                                                        </select>
                                                </div 0730email8-->
                                            
                                                <div style="margin-bottom: 20px;">
                                                        <div>
                                                            頻道介紹
                                                            <span style="margin-left: 5px; color: red;">*</span>
                                                        </div>
                                                    
                                                        <textarea id="cooperate_introduce" style="resize: none; height: 200px; width: 100%;"></textarea>
                                                        <small style="color: #ABBAC3; font-size: 8pt;">
                                                            100字內頻道簡介敘述
                                                        </small>
                                                </div>
                                            
                                                <div style="margin-bottom: 20px; position: relative;">
                                                        <div>
                                                            自定義頻道網址
                                                            <span style="margin-left: 5px; color: red;">*</span>
                                                        </div>
                                                        <input id="cooperate_url_1" type="text" class="form-control" placeholder="" style="margin: 5px 0px; padding-left: 215px;">
                                                        <input id="cooperate_url_2" type="text" style="margin: 5px 0px; position: absolute; top: 18px; width: 210px;" placeholder="" class="form-control" disabled="" value="http://ttshow.tw/cooperate.php?ch=">
                                                        <small style="color: #ABBAC3; font-size: 8pt;">
                                                            自定義設定後無法更改，請輸入3至25字元的英文及數字
                                                        </small>
                                                </div>
                                            
                                        </div>
                                    
                                        <div class="wizard-actions col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: none repeat scroll 0% 0% white; padding-bottom: 30px;margin-top: -10px">
                                                <div class="" style="margin: 50px 0px 100px; text-align: center;">
                                                        <button id="cancel" class="btn btn-prev" style="font-weight: bold; background-color: white ! important; border: 1px solid gray; width: 215px; color: gray ! important; padding: 10px 0px;">
                                                                取消
                                                        </button>

                                                        <button id="next" class="btn btn-success btn-next" style="width: 215px; font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important;">
                                                                繼續
                                                        </button>
                                                </div>
                                        </div>
                                </div>
                            
                                <div id="cooperate_form2" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 30px; background: white; display: none;">
                                    
                                        <div style="width : 100%; font-size: 12pt;">
                                            
                                                <div style="text-align: center;">
                                                        想要聯播的社群
                                                </div>
                                            
                                                <div style="margin-bottom: 20px;">
                                                        <div>
                                                            facebook粉絲團連結
                                                        </div>

                                                        <div id="facebook" style="position: relative" >
                                                            <div style="position: relative">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 33%;" placeholder="名稱" id="form_email">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 66%;" placeholder="http://facebook.com/xxxxxx" id="form_email">
                                                                <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div id="add" target="facebook" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                +增加
                                                        </div>
                                                </div>
                                            
                                                <div style="margin-bottom: 20px;">
                                                        <div>
                                                            Youtube頻道連結
                                                        </div>
                                                    
                                                        <div id="youtube" style="position: relative" >
                                                            <div style="position: relative">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 33%;" placeholder="名稱" id="form_email">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 66%;" placeholder="channel" id="form_email">
                                                                <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div id="add" target="youtube" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                +增加
                                                        </div>
                                                </div>
                                            
                                                <div style="margin-bottom: 20px;">
                                                        <div>
                                                            Instagram帳號
                                                        </div>
                                                    
                                                        <div id="instagram" style="position: relative" >
                                                            <div style="position: relative">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 33%;" placeholder="名稱" id="form_email">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 66%;" placeholder="instagram_id" id="form_email">
                                                                <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div id="add" target="instagram" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                +增加
                                                        </div>
                                                </div>
                                            
                                                <div style="margin-bottom: 20px;">
                                                        <div>Line官方帳號ID</div>
                                                    
                                                        <div id="line" style="position: relative" >
                                                            <div style="position: relative">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 33%;" placeholder="名稱" id="form_email">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 66%;" placeholder="http://line.naver.jp/ti/p/" id="form_email">
                                                                <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div id="add" target="line" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                +增加
                                                        </div>
                                                </div>
                                            
                                                <div style="margin-bottom: 20px;">
                                                        <div>痞客邦</div>
                                                    
                                                        <div id="pixnet" style="position: relative" >
                                                            <div style="position: relative">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 33%;" placeholder="名稱" id="form_email">
                                                                <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 66%;" placeholder="" id="form_email">
                                                                <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div id="add" target="pixnet" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                +增加
                                                        </div>
                                                </div>
                                            
                                                <div style="height: 100px; position: relative;">
                                                        <div>
                                                            代表作品
                                                            <span style="margin-left: 5px; color: red;">*</span>
                                                        </div>
                                                    
                                                        <input id="link_input" type="text" style="margin: 5px 0;" placeholder="" class="form-control">
                                                        <div id="add_link" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204); float: left;" target="instagram" >
                                                                +增加
                                                        </div>
                                                        <small style="color: rgb(171, 186, 195); font-size: 8pt; float: left; position: absolute; top: 70px; left: 80px;">
                                                            請輸入代表作品連結，不限數量
                                                        </small>
                                                </div>
                                            
                                                <div id="link_place" style="position: relative;">
                                                </div>
                                            
                                                <!-- addinput example -->
                                                <div id="input_example_model" style="position: relative; display: none;">
                                                        <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 33%;" placeholder="名稱" id="form_email">
                                                        <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width:66%;" placeholder="" id="form_email">
                                                        <img id="delete" style="position: absolute; right: 10px; width: 20px; height: 20px; top: 12px;" src="template/assets/img/delete.png">
                                                </div>
                                                <!-- link example -->
                                                <div id="link_example_model" style="display: none; float: left; margin-right: 5px; height: auto; margin-bottom: 12px;">
                                                    <div style="border-radius: 6px; padding: 3px 5px; background: none repeat scroll 0% 0% rgb(204, 204, 204);">
                                                        <div style="font-size: 8pt; float: left; margin: 1px 10px 1px 2px;" id="delete">X</div>
                                                        <u><a href="a">a</a></u>
                                                    </div>
                                                </div>

                                        </div>
                                    
                                        <div class="wizard-actions col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: none repeat scroll 0% 0% white; padding-bottom: 30px;margin-top: -10px">
                                                <div class="" style="margin: 50px 0px 100px; text-align: center;">
                                                        <button id="back" class="btn btn-prev" style="font-weight: bold; background-color: white ! important; border: 1px solid gray; width: 215px; color: gray ! important; padding: 10px 0px;">
                                                                取消
                                                        </button>

                                                        <button id="accept" class="btn btn-success btn-next" style="width: 215px; font-weight: bold; border-color: rgb(21, 77, 125); background-color: rgb(21, 77, 125) ! important;">
                                                                儲存
                                                        </button>
                                                </div>
                                        </div>
                                </div>
                            
                                <div id="cooperate_form3" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 30px; background: white; display: none;">
                                    
                                        <div style="width : 100%; font-size: 12pt;text-align: center; margin-bottom: 50px;">
                                            
                                                <img style="height: 200px; margin: 30px auto 50px; left: 0px; right: 0px; border: 1px solid orange; width: 200px; border-radius: 100%;" src="template/assets/img/loading.png">
                                            
                                            
                                                <div style="font-size: 20pt; margin-bottom: 20px;">
                                                        完成申請
                                                </div>
                                            
                                                <div style="font-size: 12pt; margin-bottom: 50px;">
                                                        合作頻道已完成申請，請靜候申請結束
                                                </div>
                                            
                                                <a href="index.php">
                                                    <u>返回首頁</u>
                                                </a>
                                            
                                        </div>
                                </div>
                        </div>
                </div>
        </div>

        <?php include("footer.php"); ?>


        </body>

        <script type="text/javascript">
                var title_icon_view = function( target ) {
                        $("div[id^='title_icon_']").css("background-color","gray");
                        $("div[id^='title_icon_']").find("div[id=text]").css("color","white");
                        $("div[id^='title_icon_']").find("div[id=text2]").css("color","");
                        $("div[id^='cooperate_form']").css("display","none");
                        $("#title_icon_" + target ).css("background-color","rgb(30, 89, 144)");
                        $("#title_icon_" + target ).children().eq(1).css("color","rgb(30, 89, 144)");
                        $("#cooperate_form" + target ).css("display","block");
                }
                $("document").ready(function() {
                        $.upload_file = {};
                        $.upload_file.beforeunload = {};
                        
                        //init web ++
                        $(window).scrollTop( 0 );
                        $( "#loadingpage" ).css("height", $(document).height() + 50 + "px");
                        $("input[type=text][id!=cooperate_url_2]").val("");
                        $("textarea").val("");
                        $("select").val("");
                        //init web --
                        
                        $( "#cancel" ).unbind('click').bind( "click" , function(e) {
                        });
                        $( "#next" ).unbind('click').bind( "click" , function(e) {
                                if( cheack_form1() ) {
                                        title_icon_view(2);
                                }
                        });
                        $( "#back" ).unbind('click').bind( "click" , function(e) {
                                title_icon_view(1);
                        });
                        $( "#accept" ).unbind('click').bind( "click" , function(e) {
                                var data = process_inputdata();
                                console.log( data );
                                data.cmd = "add";
                                data.ttshow = getCookie( "ttshow" );
                                $.ajax({
                                            type: "POST",
                                            url: "php/cooperate_1.php",
                                            data: data,
                                            success: function( data ) {
                                                    var data = JSON.parse(data);
                                                    if( data.success == "true" ) {
                                                            title_icon_view(3);
                                                            $( "#loadingpage" ).hide();
                                                    }
                                                    else if( data.success == "false" && data.describe == "url" ) {
                                                            alert("自定義網址重複 重複");
                                                            $("#cooperate_url_1").css("border" , "1px solid red");
                                                            $("#cooperate_url_2").css("border-right" , "1px solid red");
                                                            title_icon_view(1);
                                                            $(window).scrollTop( $(document).height() );
                                                            $( "#loadingpage" ).hide();
                                                    }
                                            } ,
                                            error: function( data ) { console.log( data ); }
                                });
                                $( "#loadingpage" ).show();
                        });
                        
                        $( "div[id=add]" ).unbind('click').bind( "click" , function(e) {
                                var html_input = $("#input_example_model").clone();
                                html_input.removeAttr("id");
                                html_input.css("display","block");
                                var target = $(e.target).attr("target");
                                //bohan++
                                var placeholder = "";
                                if( target === "facebook" )
                                    placeholder = "http://facebook.com/xxxxxx";
                                else if( target === "youtube" )
                                    placeholder = "channel";
                                else if( target === "instagram" )
                                    placeholder = "instagram_id";
                                else if( target === "line" )
                                    placeholder = "http://line.naver.jp/ti/p/";
                                
                                html_input.find("input:eq(1)").attr("placeholder",placeholder);
                                //bohan--
                                
                                html_input.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                                        $(e.target).parent().remove();
                                });
                                $("#"+target).append(html_input);
                        });
                        
                        $("#add_link").unbind('click').bind( "click" , function(e) {
                                var val = $("#link_input").val();
                                if( val != "" ) {
                                        var html_input = $("#link_example_model").clone();
                                        html_input.removeAttr("id");
                                        html_input.css("display","block");
                                        html_input.find("a").html( val );
                                        html_input.find("a").attr("href", val );
                                        html_input.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                                                $(e.target).parent().parent().remove();
                                        });
                                        $("#link_place").append(html_input);
                                }
                        });
              
                        var delete_transient_file = function( filename ) {
                                
                                console.log( "filename = " + filename );
                                $.ajax({
                                            type: "POST",
                                            url: "php/signup.php",
                                            data: {
                                                cmd            : "transient_file" ,
                                                transient_file : filename ,
                                            },
                                            success: function( data ) { return null; } ,
                                            error: function( data ) { console.log( data ); }
                                });
                        }
                        $(window).on('beforeunload', function(){
                                $.each( $.upload_file.beforeunload , function(index, value) {
                                        delete_transient_file( value );
                                });
                        });
                        $(window).unload( function(){
                                $.each( $.upload_file.beforeunload , function(index, value) {
                                        delete_transient_file( value );
                                });
                        });
                });
                
                var cheack_form1 = function() {
                        var bool = true;
                        $("#cooperate_name").css("border" , "");
                        //$("#cooperate_usertype").css("border" , "");0730email8
                        $("#cooperate_introduce").css("border" , "");
                        $("[id^=cooperate_url]").css("border" , "");
                        if( $("#cooperate_name").val() == "" ) {
                            bool = false;
                            $("#cooperate_name").css("border" , "1px solid red");
                        }
                        /*if( $("#cooperate_usertype").val() == "" ) {
                            bool = false;
                            $("#cooperate_usertype").css("border" , "1px solid red");
                        }0730email8*/
                        if( $("#cooperate_introduce").val() == "" ) {
                            bool = false;
                            $("#cooperate_introduce").css("border" , "1px solid red");
                        }
                        if( $("#cooperate_url_1").val() == "" ) {
                            bool = false;
                            $("#cooperate_url_1").css("border" , "1px solid red");
                            $("#cooperate_url_2").css("border-right" , "1px solid red");
                        }
                        return bool;
                }
                
                var process_inputdata = function() {
                        var icon = $("#cooperate_icon").attr("img");
                        icon = icon.substr( icon.lastIndexOf("/")+1 , icon.length);
                        var cover = $("#cooperate_cover").attr("img");
                        cover = cover.substr( cover.lastIndexOf("/")+1 , cover.length);
                        var data = {
                                email : $.user_mail,
                                cover : cover,
                                icon : icon,
                                name : $("#cooperate_name").val(),
                                usertype : ""/*$("#cooperate_usertype").val()0730email8*/,
                                introduce : $("#cooperate_introduce").val(),
                                url : $("#cooperate_url_1").val(),
                        }
                        
                        
                        var array = ["facebook","youtube","instagram","line","pixnet","link_place"];
                        for( var i=0; i<array.length;i++ ) {
                                if( array[i] == "link_place" ) {
                                        var target = $("#"+ array[i] ).find("a");
                                        data[array[i]] = [];
                                        for( var j=0 ; j < target.length ; j++ ) {
                                                if( target.eq(j).attr("href") != "" ) {
                                                        data[array[i]][data[array[i]].length] = target.eq(j).attr("href");
                                                }
                                        }
                                } else {
                                        var target = $("#"+ array[i] ).children();
                                        data[array[i]] = [];
                                        for( var j=0 ; j < target.length ; j++ ) {
                                                if( target.eq(j).find("input:eq(0)").val() != "" && target.eq(j).find("input:eq(1)").val() != "" ) {
                                                        data[array[i]][data[array[i]].length] = { "name" : target.eq(j).find("input:eq(0)").val() ,
                                                                                                  "url" : target.eq(j).find("input:eq(1)").val() };
                                                }
                                        }
                                }
                                data[array[i]] = JSON.stringify( data[array[i]] );
                        }
                        console.log( data );
                        return data;
                }
                
        </script>
</html>
