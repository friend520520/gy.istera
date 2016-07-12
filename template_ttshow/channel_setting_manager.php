<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-頻道設定</title>
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
                <script src="template/assets/js/ace-extra.js"></script>

		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
               
	</head>

        <body class="no-skin" style="overflow-x: hidden; background-color: rgb(242, 242, 242);">
            
        <div id="loadingpage" class="widget-box-overlay" style="width: 100%; height: 100%;">
                <div style="position: fixed; margin: auto; right: 0px; left: 0px; bottom: 0px; top: -30px; height: 0px;">
                        <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
                </div>
        </div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
            <?php include( "cooperate_tab.php"); ?>

            <div class="clearfix"></div>
                
            <div style="margin-top: 10px;">
                    <div style="padding: 0px;" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <div id="leftbar" class="channel-leftbar" style="background-color: rgb(140, 140, 140); font-size: 12pt; line-height: 12pt; ">
                            <div id="normal" style="padding: 10px 10px 10px 30px; border-bottom: 1px solid white;color: #428bca;background: white;border-left: 3px solid #428bca;">基本設定</div>
                            <div id="advanced" style="padding: 10px 10px 10px 30px; border-bottom: 1px solid white;">進階設定</div>
                            <div id="inform" style="padding: 10px 10px 10px 30px; border-bottom: 1px solid white;">通知設定</div>
                            <div id="authority" state="false" style="display: none; padding: 10px 10px 10px 30px; border-bottom: 1px solid white;">管理角色</div>
                        </div>
                    </div>

                    <div style="margin-bottom: 100px; padding: 0px;" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <div style="margin-left: 35px;">
                                    <div id="form_normal" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: none repeat scroll 0% 0% white; border-bottom: 1px solid rgb(229, 229, 229); padding: 23px 40px;">

                                                    <div class="form-group">
                                                            <label class="col-xs-11 control-label no-padding-right" style="text-align: left; font-size: 20px; font-weight: bold; margin-left: -18px;">基本資料<div class="nav nav-tabs" style="top: -10px; left: 82px;"></div></label>
                                                            <div class="col-xs-1"></div>
                                                    </div>

                                                    <div class="col-xs-12" style="padding: 0px; margin-bottom: 30px; margin-top: 30px;">
                                                            <form class="form-horizontal" role="form" style="margin-left: 20px;">
                                                                    <div class="form-group" style="margin-bottom: 25px;">
                                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">頻道名稱<span style="color: red;">*</span></label>
                                                                            <div class="col-xs-6">
                                                                                    <input type="text" id="ch_name" placeholder="台灣達人秀" class="form-control">
                                                                            </div>
                                                                            <div class="col-xs-3"></div>
                                                                    </div>

                                                                    <!--div class="form-group" style="margin-bottom: 25px">
                                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">頻道身分<span style="color: red;">*</span></label>
                                                                            <div class="col-xs-6">
                                                                                <select id="ch_type" class="col-xs-12" type="">
                                                                                        <option value="導演">導演</option>
                                                                                        <option value="插畫家">插畫家</option>
                                                                                        <option value="編劇">編劇</option>
                                                                                        <option value="講師">講師</option>
                                                                                        <option value="舞者">舞者</option>
                                                                                        <option value="畫家">畫家</option>
                                                                                        <option value="演員">演員</option>
                                                                                        <option value="官方">官方</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-xs-3"></div>
                                                                    </div 0730email8-->

                                                                    <div class="form-group" style="margin-bottom: 25px;">
                                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1" style="text-align: left; font-size: 15px;">頻道介紹<span style="color: red;">*</span></label>

                                                                            <div class="col-xs-6">
                                                                                    <textarea id="ch_introduce" class="form-control" style="height: 100px"></textarea>
                                                                                    <h6 style="color: #ABBAC3; font-size: 8pt;">100字內頻道簡介敘述</h6>
                                                                            </div>
                                                                            <div class="col-xs-3"></div>
                                                                    </div>


                                                                    <div class="form-group" style="margin-bottom: 25px;">
                                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">自定義頻道網址<span style="color: red;">*</span></label>
                                                                            <div class="col-xs-6">
                                                                                <input id="ch_url" type="text" placeholder="http://ttshow.tw/ttshow" class="form-control" disabled="">
                                                                                    <h6 style="color: #ABBAC3; font-size: 8pt;">自定義設定後無法更改，請輸入3至25字元的英文及字。</h6>
                                                                            </div>
                                                                            <div class="col-xs-3"></div>
                                                                    </div>
                                                            </form>
                                                    </div>


                                                    <div class="form-group">
                                                            <label class="col-xs-11 control-label no-padding-right" style="text-align: left; font-size: 20px; font-weight: bold; margin-left: -18px;">
                                                                社群資料
                                                                <div class="nav nav-tabs" style="top: -10px; left: 82px;"></div>
                                                            </label>
                                                            <div class="col-xs-1"></div>
                                                    </div>

                                                    <div class="col-xs-12" style="padding: 0px; margin-bottom: 30px; margin-top: 30px;">
                                                            <div class="form-group col-xs-12" style="margin-bottom: 25px;">
                                                                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px; padding-top: 1%;">facebook</label>
                                                                    <div class="col-xs-6">
                                                                            <div id="facebook_url" style="position: relative" >
                                                                                <div style="position: relative">
                                                                                    <input type="text" class="form-control" style="width: 33%; margin: 5px 0px; display: inline-block;" placeholder="名稱" id="form_email">
                                                                                    <input type="text" class="form-control" style="margin: 5px 0px; display: inline-block; width: 66%;" placeholder="http://facebook.com/xxxxxx" id="form_email">
                                                                                    <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                                                </div>
                                                                            </div>

                                                                            <div id="add" target="facebook_url" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                                    +增加
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-xs-3"></div>
                                                            </div>


                                                            <div class="form-group col-xs-12" style="margin-bottom: 25px;">
                                                                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px; padding-top: 1%;">
                                                                        Youtube
                                                                    </label>
                                                                    <div class="col-xs-6">
                                                                            <div id="youtube_url" style="position: relative" >
                                                                                <div style="position: relative">
                                                                                    <input type="text" id="form_email" placeholder="名稱" style="margin: 5px 0px; display: inline-block; width: 33%;" class="form-control">
                                                                                    <input type="text" id="form_email" placeholder="channel" style="margin: 5px 0px; display: inline-block; width: 66%;" class="form-control">
                                                                                    <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                                                </div>
                                                                            </div>

                                                                            <div id="add" target="youtube_url" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                                    +增加
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-xs-3"></div>
                                                            </div>


                                                            <div class="form-group col-xs-12" style="margin-bottom: 25px;">
                                                                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px; padding-top: 1%;">Instagram</label>
                                                                    <div class="col-xs-6">
                                                                            <div id="instagram_url" style="position: relative" >
                                                                                <div style="position: relative">
                                                                                    <input type="text" id="form_email" placeholder="名稱" style="margin: 5px 0px; display: inline-block; width: 33%;" class="form-control">
                                                                                    <input type="text" id="form_email" placeholder="instagram_id" style="margin: 5px 0px; display: inline-block; width: 66%;" class="form-control">
                                                                                    <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                                                </div>
                                                                            </div>

                                                                            <div id="add" target="instagram_url" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                                    +增加
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-xs-3"></div>
                                                            </div>


                                                            <div class="form-group col-xs-12" style="margin-bottom: 25px;">
                                                                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px; padding-top: 1%;">Line官方帳號ID</label>
                                                                    <div class="col-xs-6">
                                                                            <div id="line_url" style="position: relative" >
                                                                                <div style="position: relative">
                                                                                    <input type="text" id="form_email" placeholder="名稱" style="margin: 5px 0px; display: inline-block; width: 33%;" class="form-control">
                                                                                    <input type="text" id="form_email" placeholder="http://line.naver.jp/ti/p/" style="margin: 5px 0px; display: inline-block; width: 66%;" class="form-control">
                                                                                    <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                                                </div>
                                                                            </div>

                                                                            <div id="add" target="line_url" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                                    +增加
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-xs-3"></div>
                                                            </div>


                                                            <div class="form-group col-xs-12" style="margin-bottom: 25px;">
                                                                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px; padding-top: 1%;">痞客邦</label>
                                                                    <div class="col-xs-6">
                                                                            <div id="pixnet_url" style="position: relative" >
                                                                                <div style="position: relative">
                                                                                    <input type="text" id="form_email" placeholder="名稱" style="margin: 5px 0px; display: inline-block; width: 33%;" class="form-control">
                                                                                    <input type="text" id="form_email" placeholder="" style="margin: 5px 0px; display: inline-block; width: 66%;" class="form-control">
                                                                                    <div style="position: absolute; right: 10px; top: 13px;">主要</div>
                                                                                </div>
                                                                            </div>

                                                                            <div id="add" target="pixnet_url" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204);">
                                                                                    +增加
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-xs-3"></div>
                                                            </div>
                                                            

                                                            <div class="form-group col-xs-12" style="margin-bottom: 25px;">
                                                                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px; padding-top: 1%;">代表作品</label>
                                                                    <div class="col-xs-6">
                                                                            <input id="link_input" type="text" style="margin: 5px 0;" placeholder="" class="form-control">
                                                                            <div id="add_link" style="text-align: center; width: 70px; padding: 2px 0px; background: none repeat scroll 0% 0% rgb(221, 221, 221); border: 1px solid rgb(204, 204, 204); float: left;" target="instagram" >
                                                                                    +增加
                                                                            </div>
                                                                            <small style="color: rgb(171, 186, 195); font-size: 8pt; position: absolute; top: 45px; left: 90px;">
                                                                                請輸入代表作品連結，不限數量
                                                                            </small>
                                                                            <div class="clearfix"></div>
                                                                            <div id="link_place" style="position: relative; margin-top: 10px;">
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-xs-3"></div>
                                                            </div>
                                                    </div>


                                                    <div class="form-group">
                                                            <label class="col-xs-11 control-label no-padding-right" style="text-align: left; font-size: 20px; font-weight: bold; margin-left: -18px;">風格設定<div class="nav nav-tabs" style="top: -10px; left: 82px;"></div></label>
                                                            <div class="col-xs-1"></div>
                                                    </div>

                                                    <div class="col-xs-12" style="padding: 0px; margin-bottom: 30px; margin-top: 30px;">
                                                            <div class="form-group col-xs-12" style="margin-bottom: 25px;">
                                                                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px; padding-top: 11%;">
                                                                        頻道照片
                                                                        <span style="color: red;">*</span>
                                                                    </label>
                                                                    <div class="col-xs-3" style="border: 1px solid rgb(221, 221, 221); width: 200px; position: relative; margin: 20px auto 20px 10px; height: 200px;">
                                                                            <input id="transient_file" style="visibility: hidden;" type="file" multiple="" target="cooperate_icon">
                                                                            <div id="cooperate_icon" img="" style="width: 100%; height: 200px; top: 0px; left: 0px; position: absolute; background-image: url(&quot;&quot;);" img="default" class="chessboard-icon bg_top"></div>
                                                                            <!--img style="position: absolute; height: 20px; bottom: 5px; right: 5px; width: 20px;" src="template/assets/img/pen.ico"-->
                                                                    </div>
                                                                    <div class="col-xs-6"></div>
                                                                    <div class="clearfix"></div>
                                                            </div>


                                                            <div class="form-group col-xs-12" style="margin-bottom: 25px;">
                                                                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px; padding-top: 10%;">
                                                                        頻道封面<span style="color: red;">*</span>
                                                                    </label>
                                                                    <div class="col-xs-8" style="margin: 20px auto; height: 200px;">
                                                                            <input id="transient_file" style="visibility: hidden;" type="file" multiple="" target="cooperate_cover">
                                                                            <div id="cooperate_cover" img="" class="chessboard-bgcenter pagebg" style="border: 1px solid rgb(221, 221, 221); background-image: url(''); height: 175%;"></div>
                                                                            <!--img style="position: absolute; right: 10px; width: 20px; height: 20px; bottom: 0px;" src="template/assets/img/pen.ico"-->
                                                                    </div>
                                                                    <div class="col-xs-1"></div>
                                                                    <div class="clearfix"></div>
                                                            </div>

                                                    </div>

                                                    <div class="col-xs-12" style="padding-top: 98px; margin-left: 10px;">
                                                            <button id="cancel" style="border-radius: 3px; margin-right: 20px; background: none repeat scroll 0% 0% white ! important; border: 1px solid rgb(213, 213, 213); padding: 6px 30px;" class="btn btn-sm  btn-light panel-float-left" type="button">取消</button>
                                                            <button id="apply" type="button" class="btn btn-sm  btn-primary panel-float-left" style="border-radius: 3px; padding: 2px 30px; background: none repeat scroll 0% 0% rgb(19, 74, 121) ! important; border-color: rgb(19, 74, 121) ! important;">儲存變更</button>
                                                    </div>

                                                    <!-- input example -->
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

                                    <div id="form_advanced" style="display: none; background: none repeat scroll 0% 0% white; border-bottom: 1px solid rgb(229, 229, 229); padding: 23px 40px; height: auto;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                    <label class="col-xs-11 control-label no-padding-right" style="text-align: left; font-size: 20px; font-weight: bold; margin-left: -18px;">進階設定<div class="nav nav-tabs" style="top: -10px; left: 82px;"></div></label>
                                                    <div class="col-xs-1"></div>
                                            </div>

                                            <div class="col-xs-12" style="padding: 0px; margin-bottom: 10px; margin-top: 30px; margin-left: 15px;">
                                                    <div class="form-group" style="margin-bottom: 25px;">
                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">誰可以訪問此頻道</label>
                                                            <div class="col-xs-6">
                                                                    <input type="radio" checked="" name="browser" value="all">
                                                                    <span class="lbl" style="margin-left: 4px;">所有人</span>
                                                                    <input type="radio" style="margin-left: 20px" name="browser" value="member">
                                                                    <span class="lbl" style="margin-left: 4px;">登入會員</span>
                                                                    <input type="radio" style="margin-left: 20px" name="browser" value="only">
                                                                    <span class="lbl" style="margin-left: 4px;">只有我</span>
                                                            </div>
                                                            <div class="col-xs-3"></div>
                                                            <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 25px;">
                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">允許使用者發訊息給此頻道</label>
                                                            <div class="col-xs-6">
                                                                    <input type="radio" checked="" name="allow_message" value="true">
                                                                    <span class="lbl" style="margin-left: 4px;">開放</span>
                                                                    <input type="radio" style="margin-left: 20px" name="allow_message" value="false">
                                                                    <span class="lbl" style="margin-left: 4px;">不開放</span>
                                                            </div>
                                                            <div class="col-xs-3"></div>
                                                            <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 25px;">
                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">允許使用者訂閱</label>
                                                            <div class="col-xs-6">
                                                                    <input type="radio" checked="" name="allow_subscribe" value="true">
                                                                    <span class="lbl" style="margin-left: 4px;">開放</span>
                                                                    <input type="radio" style="margin-left: 20px" name="allow_subscribe" value="false">
                                                                    <span class="lbl" style="margin-left: 4px;">不開放</span>
                                                            </div>
                                                            <div class="col-xs-3"></div>
                                                            <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 25px;">
                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">允許站內搜尋到此頻道</label>
                                                            <div class="col-xs-6">
                                                                    <input type="radio" checked="" name="allow_search" value="true">
                                                                    <span class="lbl" style="margin-left: 4px;">是</span>
                                                                    <input type="radio" style="margin-left: 33px;" name="allow_search" value="false">
                                                                    <span class="lbl" style="margin-left: 4px;">否</span>
                                                            </div>
                                                            <div class="col-xs-3"></div>
                                                            <div class="clearfix"></div>
                                                    </div>

                                                    <div class="col-xs-12">
                                                            <button id="cancel" style="border-radius: 3px; margin-right: 20px; background: none repeat scroll 0% 0% white ! important; border: 1px solid rgb(213, 213, 213); padding: 6px 30px;" class="btn btn-sm  btn-light panel-float-left" type="button">取消</button>
                                                            <button id="apply" type="button" class="btn btn-sm  btn-primary panel-float-left" style="border-radius: 3px; padding: 2px 30px; background: none repeat scroll 0% 0% rgb(19, 74, 121) ! important; border-color: rgb(19, 74, 121) ! important;">儲存變更</button>
                                                    </div>

                                            </div>
                                    </div>

                                    <div id="form_inform" style="display: none; background: none repeat scroll 0% 0% white; border-bottom: 1px solid rgb(229, 229, 229); color: gray; padding: 30px 40px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                    <label class="col-xs-11 control-label no-padding-right" style="text-align: left; font-size: 20px; font-weight: bold; margin-left: -18px;">通知設定<div class="nav nav-tabs" style="top: -10px; left: 82px;"></div></label>
                                                    <div class="col-xs-1"></div>
                                            </div>

                                            <div class="col-xs-12" style="padding: 0px; margin-bottom: 10px; margin-top: 30px; margin-left: 15px;">
                                                    <div id="get_message" class="form-group" style="margin-bottom: 25px;">
                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">當使用者發訊息給頻道時</label>
                                                            <div class="col-xs-6">
                                                                    <input type="checkbox" checked="" name="message" value="email">
                                                                    <span class="lbl" style="margin-left: 4px;">電子郵件通知</span>
                                                                    <input type="checkbox" checked="" style="margin-left: 20px" name="message" value="website">
                                                                    <span class="lbl" style="margin-left: 4px;">站內通知</span>
                                                            </div>
                                                            <div class="col-xs-3"></div>
                                                            <div class="clearfix"></div>
                                                    </div>

                                                    <div id="get_statistics" class="form-group" style="margin-bottom: 25px;">
                                                            <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">每日頻道數據報表</label>
                                                            <div class="col-xs-6">
                                                                    <input type="checkbox" checked="" name="report" value="email">
                                                                    <span class="lbl" style="margin-left: 4px;">電子郵件通知</span>
                                                                    <input type="checkbox" checked="" style="margin-left: 20px" name="report" value="website">
                                                                    <span class="lbl" style="margin-left: 4px;">站內通知</span>
                                                            </div>
                                                            <div class="col-xs-3"></div>
                                                            <div class="clearfix"></div>
                                                    </div> 

                                                    <div class="col-xs-12">
                                                            <button id="cancel" style="border-radius: 3px; margin-right: 20px; background: none repeat scroll 0% 0% white ! important; border: 1px solid rgb(213, 213, 213); padding: 6px 30px;" class="btn btn-sm  btn-light panel-float-left" type="button">取消</button>
                                                            <button id="apply" type="button" class="btn btn-sm  btn-primary panel-float-left" style="border-radius: 3px; padding: 2px 30px; background: none repeat scroll 0% 0% rgb(19, 74, 121) ! important; border-color: rgb(19, 74, 121) ! important;">儲存變更</button>
                                                    </div>
                                            </div>
                                    </div>

                                    <div id="form_authority" style="display: none; background: none repeat scroll 0% 0% white; border-bottom: 1px solid rgb(229, 229, 229); padding: 23px 40px; height: auto;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                        <label class="col-xs-11 control-label no-padding-right" style="text-align: left; font-size: 20px; font-weight: bold; margin-left: -18px;">管理角色<div class="nav nav-tabs" style="top: -10px; left: 82px;"></div></label>
                                                        <div class="col-xs-1"></div>
                                                </div>

                                                <div class="clearfix"></div>

                                                <div style="margin-top: 30px; padding-left: 25px; padding-right: 30px;">
                                                    <table class="table table-striped table-bordered table-hover dataTable no-footer DTTT_selectable" id="dynamic-table" role="grid" aria-describedby="dynamic-table_info">
                                                            <thead class="">
                                                                <tr role="row" style="background-color: #ABBAC3;">
                                                                    <th class="center sorting_disabled col-xs-2" rowspan="1" colspan="1" aria-label=""></th>
                                                                    <th class="col-xs-2" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending">使用者名稱</th>
                                                                    <th class="col-xs-2" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">電子信箱</th>
                                                                    <th class="hidden-480 col-xs-2" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Clicks: activate to sort column ascending">角色</th>
                                                                    <th class="col-xs-2" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Update: activate to sort column ascending">最後登入時間</th>
                                                                    <th class="hidden-480 col-xs-2" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">操作</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="authority_space">
                                                                <tr id="authority_tool" role="row" class="even" style="height: 120px;">
                                                                    <td class="center">
                                                                            <div class="bg_top" style="border: 1px solid rgb(221, 221, 221); cursor: pointer; width: 100px; height: 100px; margin: 0px; left: 7%;"></div>
                                                                    </td>

                                                                    <td style="vertical-align: middle; font-size: 15px"></td>

                                                                    <td style="vertical-align: middle; font-size: 15px">
                                                                            <input id="authority_mail" type="text" class="form-control" placeholder="" style="margin: 5px 0;">
                                                                    </td>

                                                                    <td class="hidden-480" style="vertical-align: middle; font-size: 15px">
                                                                            <select id="authority_type" type="">
                                                                                    <option value="editor">編輯</option>
                                                                                    <option value="manage">管理員</option>
                                                                            </select>
                                                                    </td>

                                                                    <td style="vertical-align: middle; font-size: 15px"></td>

                                                                    <td class="hidden-480" style="vertical-align: middle; font-size: 15px">
                                                                        <button id="add_authority" class="btn btn-success" style="border-radius: 12px; padding: 0;">新增</button>
                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                            <tr id="authority_example_model" role="row" class="even" style="height: 120px; display: none;">
                                                                    <td class="center">
                                                                            <div id="authority_icon" class="bg_top" style="background-image: url('http://ttshow.tw/TTShow/account/bightp85065@yahoo.com.tw/Original/20150510144745.png'); cursor: pointer; width: 100px; height: 100px; margin: 0px; left: 7%;"></div>
                                                                    </td>

                                                                    <td id="authority_name" style="vertical-align: middle; font-size: 15px">使用者名稱</td>

                                                                    <td id="authority_mail" style="vertical-align: middle; font-size: 15px">name@email.com</td>

                                                                    <td class="hidden-480" style="vertical-align: middle; font-size: 15px">
                                                                            <select id="authority_type" type="">
                                                                                    <option value="editor">編輯</option>
                                                                                    <option value="manage">管理員</option>
                                                                            </select>
                                                                    </td>

                                                                    <td id="authority_lastlogin" style="vertical-align: middle; font-size: 15px">2015-05-28 12:46</td>

                                                                    <td class="hidden-480" style="vertical-align: middle; font-size: 15px">
                                                                            <button id="authority_delete" class="btn btn-success" style="border-radius: 12px; padding: 0;">移除</button>
                                                                    </td>
                                                            </tr>
                                                        </table>

                                                    <div class="col-xs-12" style="padding-bottom: 20px; padding-top: 30px; padding-left: 0px;">
                                                            <button id="cancel" style="border-radius: 3px; margin-right: 20px; background: none repeat scroll 0% 0% white ! important; border: 1px solid rgb(213, 213, 213); padding: 6px 30px;" class="btn btn-sm  btn-light panel-float-left" type="button">取消</button>
                                                            <button id="update_authority" type="button" class="btn btn-sm  btn-primary panel-float-left" style="border-radius: 3px; padding: 2px 30px; background: none repeat scroll 0% 0% rgb(19, 74, 121) ! important; border-color: rgb(19, 74, 121) ! important;">儲存變更</button>
                                                    </div>
                                                </div>
                                    </div>
                            </div>
                    </div>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <?php include( "footer.php"); ?>

        
        <!-- /.main-content -->
        
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
        
        </div>

        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="template/assets/js/bootstrap.js"></script>

		<script src="template/assets/js/jquery-ui.js"></script>
		<!--script src="template/assets/js/jquery.ui.touch-punch.js"></script-->

		<!-- ace scripts -->
                
		<!--script src="template/assets/js/ace/elements.scroller.js"></script>
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
		<script src="template/assets/js/ace/ace.submenu-hover.js"></script-->
                
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
                            
				//jquery tabs
                                if( $( "#tabs" ).length )
				$( "#tabs" ).tabs().show();

			});
		</script>
        
        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>
        
        <script src="js/view_upload_img.js"></script>
        <script src="js/fb-login.js"></script>
        
        <style>
                .zipcode { display: none; }
                .county { margin-right: 10px; }
                .district { margin-right: 10px; }
        </style>
        
        <script type="text/javascript">
            $("document").ready(function() {
                    $.upload_file = {};
                    $.upload_file.transient_file = "";
                    $.upload_file.beforeunload = {};
                    
                    $("#leftbar").unbind('click').bind( 'click' , function(e) {
                            var id= $(e.target).attr("id");
                            $("div[id^='form_']").css("display","none");
                            $("#form_" + id ).css("display","block");
                            
                            $("#leftbar").children().css("color", "").css("background", "").css("border-left","");
                            $(e.target).css("color", "#428bca").css("background", "white").css("border-left","3px solid #428bca");
                                //normal  //advanced   //inform  //authority
                            if( id == "authority" && $(e.target).attr("state") == "false" ) {
                                    $(e.target).attr("state","true");
                                    select_authority();
                            }
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
                    $("#cooperate_icon").unbind('click').bind( "click" , function(e) {
                            $("[id=transient_file][target=cooperate_icon]").click();
                    });
                    $("#cooperate_cover").unbind('click').bind( "click" , function(e) {
                            $("[id=transient_file][target=cooperate_cover]").click();
                    });
                    
                    var delete_transient_file = function( filename ) {
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
                    
                    
                    $("[id=apply]").unbind('click').bind( "click" , function(e) {
                                $( "#loadingpage" ).show();
                                var data = process_inputdata();
                                data.cmd = "modify";
                                data.url = $.getData.url;
                                data.ch = $.getData.ch;
                                data.ttshow = getCookie( "ttshow" );
                                var callback = function( data ) {
                                        
                                        var data_json = JSON.parse( data );
                                        console.log( data_json );
                                        if( data_json.success ) {
                                            alert( "儲存成功" );
                                            input_data( data );
                                        }
                                }
                                $.Ajax( "POST" , "php/cooperate_1.php" , data , {} , callback , "" );
                                $( "#loadingpage" ).show();
                    });
                    $("#channel_setting").find("[id=text]").attr("style","border-top: 4px solid rgb(66, 139, 202); background: white; color: rgb(66, 139, 202); height: 45px; margin-left: -1px;");
                    update_authority();
            });
            
            var cheack_form1 = function() {
                    var bool = true;
                    $("#ch_name").css("border" , "");
                    //$("#ch_type").css("border" , "");0730email8
                    $("#ch_introduce").css("border" , "");
                    if( $("#ch_name").val() == "" ) {
                        bool = false;
                        $("#ch_name").css("border" , "1px solid red");
                    }
                    /*if( $("#ch_type").val() == "" ) {
                        bool = false;
                        $("#ch_type").css("border" , "1px solid red");
                    }0730email8*/
                    if( $("#ch_introduce").val() == "" ) {
                        bool = false;
                        $("#ch_introduce").css("border" , "1px solid red");
                    }
                    return bool;
            }

            var process_inputdata = function() {
                    var icon = $("#cooperate_icon").attr("img");
                    if( icon.lastIndexOf("profile") == -1 ) {
                        icon = icon.substr( icon.lastIndexOf("/")+1 , icon.length);
                    }

                    var cover = $("#cooperate_cover").attr("img");
                    if( cover.lastIndexOf("cover") == -1 ) {
                        cover = cover.substr( cover.lastIndexOf("/")+1 , cover.length);
                    }

                    var get_message = "";
                    if( $("#get_message input[value='email']")[0].checked && $("#get_message input[value='website']")[0].checked ) {
                            get_message = "all";
                    } else if( $("#get_message input[value='email']")[0].checked ) {
                            get_message = "email";
                    } else if( $("#get_message input[value='website']")[0].checked ) {
                            get_message = "website";
                    } else {
                            get_message = "no";
                    }

                    var get_statistics = "";
                    if( $("#get_statistics input[value='email']")[0].checked && $("#get_statistics input[value='website']")[0].checked ) {
                            get_statistics = "all";
                    } else if( $("#get_statistics input[value='email']")[0].checked ) {
                            get_statistics = "email";
                    } else if( $("#get_statistics input[value='website']")[0].checked ) {
                            get_statistics = "website";
                    } else {
                            get_statistics = "no";
                    }

                    var data = {
                            email : $.user_mail,
                            cover : cover,
                            icon : icon,
                            name : $("#ch_name").val(),
                            usertype : ""/*$("#ch_type").val()0730email8*/,
                            introduce : $("#ch_introduce").val(),

                            browser : $("input[name=browser]:checked").val(),
                            allow_message : $("input[name=allow_message]:checked").val(),
                            allow_search : $("input[name=allow_search]:checked").val(),
                            allow_subscribe : $("input[name=allow_subscribe]:checked").val(),
                            get_message : get_message ,
                            get_statistics : get_statistics ,
                    }


                    var array = ["facebook_url","youtube_url","instagram_url","line_url","pixnet_url","link_place"];
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

                    return data;
            }

            var input_data = function(data) {
                    console.log( data );
                    try 
                    {
                            var data = JSON.parse( data );
                            if( data.success ) {
                                    if( data.manage_authority == undefined || !data.manage_authority ) {
                                            $("#leftbar").find("[id=authority]").remove();
                                    } else {
                                            $("#leftbar").find("[id=authority]").css("display","block");
                                    }
                                    console.log( data );
                                    $("#ch_name").val( data.name );
                                    //$("#ch_type").val( data.type );0730email8
                                    $("#ch_introduce").val( data.introduce );
                                    $("#ch_url").val( data.url );
                                    //link ++
                                    var i=0,j=0;
                                    var array = ["facebook_url","youtube_url","instagram_url","line_url","pixnet_url","other_url"];
                                    var url = {};
                                    $("#link_place").html("");
                                    for( i=0; i<array.length;i++ ) {
                                            url[array[i]] = eval(data[array[i]]);
                                            var clone = $("#"+array[i]).find("div:first-child");
                                            $("#"+array[i]).html("");
                                            $("#"+array[i]).append( clone );
                                            for( j=0; j<url[array[i]].length;j++ ) {
                                                    if( array[i] == "other_url" ) {
                                                            var html_input = $("#link_example_model").clone();
                                                            html_input.removeAttr("id");
                                                            html_input.css("display","block");
                                                            html_input.find("a").html( url[array[i]][j].url );
                                                            html_input.find("a").attr("href", url[array[i]][j].url );
                                                            html_input.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                                                                    $(e.target).parent().parent().remove();
                                                            });
                                                            $("#link_place").append(html_input);
                                                    } else {
                                                            if( j == 0 ) {
                                                                    $("#"+array[i]).find("input:eq(0)").val( url[array[i]][j].name );
                                                                    $("#"+array[i]).find("input:eq(1)").val( url[array[i]][j].url );
                                                            }
                                                            else if( j > 0 ) {
                                                                    var html_input = $("#input_example_model").clone();
                                                                    html_input.removeAttr("id");
                                                                    html_input.css("display","block");
                                                                    html_input.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                                                                            $(e.target).parent().remove();
                                                                    });
                                                                    html_input.find("input").val( url[array[i]][j].url );
                                                                    $("#"+array[i]).append(html_input);
                                                            }   
                                                    }
                                            }
                                    }
                                    //link --
                                    var time = new Date();
                                    time = time.getTime();
                                    $( "#cooperate_icon" ).css("background-image","url(" + data.icon + "?" + time + ")");
                                    $("#cooperate_icon").attr("img",data.icon);
                                    $( "#cooperate_cover" ).css("background-image","url(" + data.cover + "?" + time + ")");
                                    $( "#cooperate_cover" ).attr("img",data.cover);
                                    if( data.browser != "" ) {
                                            $("input[name=browser][value=" + data.browser + "]")[0].checked = true;
                                    }
                                    if( data.allow_subscribe != "" ) {
                                            $("input[name=allow_subscribe][value=" + data.allow_subscribe + "]")[0].checked = true;
                                    }
                                    if( data.allow_search != "" ) {
                                            $("input[name=allow_search][value=" + data.allow_search + "]")[0].checked = true;
                                    }
                                    if( data.allow_message != "" ) {
                                            $("input[name=allow_message][value=" + data.allow_message + "]")[0].checked = true;
                                    }
                                    
                
                                    if( data.get_message == "all" || data.get_message == "" ) {
                                            $("#get_message input").eq(0)[0].checked = true;
                                            $("#get_message input").eq(1)[0].checked = true;
                                    } else if( data.get_message == "no" ) {
                                            $("#get_message input").eq(0)[0].checked = false;
                                            $("#get_message input").eq(1)[0].checked = false;
                                    } else {
                                            $("#get_message input").eq(0)[0].checked = false;
                                            $("#get_message input").eq(1)[0].checked = false;
                                            $("#get_message input[value='" + data.get_message + "']")[0].checked = true;
                                    }

                                    if( data.get_statistics == "all" || data.get_statistics == "" ) {
                                            $("#get_statistics input").eq(0)[0].checked = true;
                                            $("#get_statistics input").eq(1)[0].checked = true;
                                    } else if( data.get_statistics == "no" ) {
                                            $("#get_statistics input").eq(0)[0].checked = false;
                                            $("#get_statistics input").eq(1)[0].checked = false;
                                    } else {
                                            $("#get_statistics input").eq(0)[0].checked = false;
                                            $("#get_statistics input").eq(1)[0].checked = false;
                                            $("#get_statistics input[value='" + data.get_statistics + "']")[0].checked = true;
                                    }
                                    init_subTab_url();
                                    $( "#loadingpage" ).hide();
                            } else {
                                    console.log( data.success );
                                    console.log( "error msg: " + data.msg );
                            }
                    }
                    catch(e) {
                            console.log(e);
                    }
            };
            
            var select_authority = function() {
                    $( "#loadingpage" ).show();
                    var data ={};
                    data.cmd = "select_authority";
                    data.url = $.getData.url;
                    data.ch = $.getData.ch;
                    data.ttshow = getCookie( "ttshow" );
                    var callback = function( data ) {
                            try 
                            {
                                    var data = JSON.parse(data);
                                    if( data.success ) {
                                            var authority = $("#authority_example_model").clone();
                                            var i = 0;
                                            var clone = $("#authority_tool");
                                            $("#authority_space").html("");
                                            $("#authority_space").append( clone );
                                            for(i=0;i<data.data.length;i++) {                                        
                                                    var s = '<tr id="authority_example_model" role="row" class="even" style="height: 120px;">\n\
                                                                        <td class="center">\n\
                                                                                <div id="authority_icon" class="bg_top" style="background-image: url(\'' + data.data[i].usericon + '\'); cursor: pointer; width: 100px; height: 100px; margin: 0px; left: 7%;"></div>\n\
                                                                        </td>\n\
                                                                        <td id="authority_name" style="vertical-align: middle; font-size: 15px">' + data.data[i].user_name + '</td>\n\
                                                                        <td id="authority_mail" style="vertical-align: middle; font-size: 15px">' + data.data[i].mail + '</td>\n\
                                                                        <td class="hidden-480" style="vertical-align: middle; font-size: 15px">\n\
                                                                                <select id="authority_type" type="">\n\
                                                                                        <option value="editor">編輯</option>\n\
                                                                                        <option value="manage">管理員</option>\n\
                                                                                </select>\n\
                                                                        </td>\n\
                                                                        <td id="authority_lastlogin" style="vertical-align: middle; font-size: 15px">' + data.data[i].last_login_time + '</td>\n\
                                                                        <td class="hidden-480" style="vertical-align: middle; font-size: 15px">\n\
                                                                                <button id="authority_delete" class="btn btn-success" style="border-radius: 12px; padding: 0;">移除</button>\n\
                                                                        </td>\n\
                                                                </tr>';
                                                    $("#authority_space").append( s );
                                                    var children = $("#authority_space").find("[id=authority_example_model]");
                                                    children.removeAttr("id");
                                                    children.find("[id=authority_type]").val( data.data[i].type);
                                                    children.attr("user_id", data.data[i].user_id );
                                                    $("#authority_space").append( $("#authority_tool") );
                                            }
                                            //add delete ++
                                            $("#authority_space").find("[id=authority_delete]").unbind('click').bind( 'click' , function(e) {
                                                    var q = confirm("移除使用者: " + $(e.target).parent().parent().find("[id=authority_name]").html() );
                                                    if( q ) {                                            
                                                            var data ={};
                                                            data.cmd = "delete_authority";
                                                            data.url = $.getData.url;
                                                            data.ch = $.getData.ch;
                                                            data.id = $(e.target).parent().parent().attr("user_id");
                                                            data.ttshow = getCookie( "ttshow" );
                                                            var callback = function(data) {
                                                                    try 
                                                                    {
                                                                            var data = JSON.parse(data);
                                                                            console.log( data );
                                                                            if( data.success ) {
                                                                                    select_authority();
                                                                            }
                                                                    }
                                                                    catch(e) {
                                                                            console.log(e);
                                                                    }
                                                            }
                                                            $.Ajax( "POST" , "php/cooperate_1.php" , data , {} , callback , "" );
                                                    }
                                            });
                                            //add delete --
                                            add_authority();
                                    } else {
                                            $("#leftbar").find("[id=authority]").remove();
                                            $("#form_authority").remove();
                                    }
                            }
                            catch(e) {
                                    console.log(e);
                            }
                            $( "#loadingpage" ).hide();
                    }
                    $.Ajax( "POST" , "php/cooperate_1.php" , data , {} , callback , "" );
            }
            
            var add_authority = function() {
                    $("#add_authority").unbind('click').bind( "click" , function(e) {
                            $( "#loadingpage" ).show();
                            var data ={};
                            data.cmd = "add_authority";
                            data.url = $.getData.url;
                            data.ch = $.getData.ch;
                            data.mail = $("#authority_tool").find("[id=authority_mail]").val();
                            data.type = $("#authority_tool").find("[id=authority_type]").val();
                            data.ttshow = getCookie( "ttshow" );
                            var callback = function(data) {
                                    console.log( data );
                                    try 
                                    {
                                            var data = JSON.parse(data);
                                            console.log( data );
                                            if( data.success ) {
                                                    select_authority();
                                            } else {
                                                    alert( data.msg );
                                            }
                                    }
                                    catch(e) {
                                            console.log(e);
                                    }
                                    $( "#loadingpage" ).hide();
                            }
                            $.Ajax( "POST" , "php/cooperate_1.php" , data , {} , callback , "" );
                    });
            }
            
            var update_authority = function() {
                    $("#update_authority").unbind('click').bind( "click" , function(e) {
                            $( "#loadingpage" ).show();
                            var data ={};
                            data.cmd = "update_authority";
                            data.url = $.getData.url;
                            data.ch = $.getData.ch;
                            data.people = [];
                            data.ttshow = getCookie( "ttshow" );
                            var children = $("#authority_space tr");
                            var i=0;
                            for(i=0;i<children.length;i++) {
                                    if( children.eq(i).attr("id") != "authority_tool") {
                                            data.people[i] = {};
                                            data.people[i].id = children.eq(i).attr("user_id");
                                            data.people[i].type = children.eq(i).find("[id=authority_type]").val();
                                    }
                            }

                            var callback = function(data) {
                                    console.log( data );
                                    try 
                                    {
                                            var data = JSON.parse(data);
                                            console.log( data );
                                            if( data.success ) {
                                                    select_authority();
                                            }
                                    }
                                    catch(e) {
                                            console.log(e);
                                    }
                                    $( "#loadingpage" ).hide();
                            }
                            $.Ajax( "POST" , "php/cooperate_1.php" , data , {} , callback , "" );
                    });
            }
            
            var init_subTab_url = function() {
                    var href = "";
                    if( $.getData.url == "true" ) {
                        href = "?" + window.location.toString().split("?")[1];
                    } else {
                        if( $.getData.ch != null && $.getData.ch != undefined ) {
                            href = "?ch=" + $.getData.ch;
                        } else {
                            href = "";
                        }
                    }
                    $("#channel_homepage").attr( "href" , $("#channel_homepage").attr("href") + href );
                    $("#channel_publish_page").attr( "href" , $("#channel_publish_page").attr("href") + href );
                    $("#channel_list_page").attr( "href" , $("#channel_list_page").attr("href") + href );
                    $("#channel_setting").attr( "href" , $("#channel_setting").attr("href") + href );
            }
        </script>
        <script type="text/javascript">
                function FB_connected_callback_init( response )
                {
                            console.log( '---------------------------' );
                            console.log( response );
                            $.member = response;
                            
                            //get message ++
                            try 
                            {
                                    var url = window.location.toString();
                                    $.getData = {};
                                    if( url.search("\\?") != -1 && url.search("=") != -1 ) {
                                            var data = url.split("?")[1].split("&");
                                            for(var i=0;i<data.length;i++) {
                                                    $.getData[data[i].split("=")[0]] = data[i].split("=")[1];
                                            }
                                            $.getData.url = "false";
                                    } else {
                                            $.getData.ch  = url.split("?")[1];
                                            $.getData.url = "true";
                                    }
                                    console.log( $.getData );
                                    var data = {
                                            cmd  : "select" ,
                                            //user : $.member.mail ,
                                            url  : $.getData.url ,
                                            ch   : $.getData.ch ,
                                            ttshow : getCookie( "ttshow" )
                                    }
                                    $.Ajax( "POST" , "php/cooperate_1.php" , data , {} , input_data , "" );
                            }
                            catch(e) {
                                    console.log(e);
                            }
                            //get message ++
                            
                            console.log( '---------------------------' );
                }
                
                function FB_unconnected_callback_init()
                {
                            $( "#pagecontent" ).hide();
                            
                };
        </script>
        
        
</body>

</html>
