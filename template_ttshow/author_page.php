<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>ttshow-會員資料</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">

                <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

                <!-- bootstrap & fontawesome -->
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

        <body class="no-skin" style="overflow-x: hidden;">
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay" style="width: 100%; height: 100%;">
                <div style="position: fixed; margin: auto; right: 0px; left: 0px; bottom: 0px; top: -30px; height: 0px;">
                        <i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i>
                </div>
        </div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">

                <?php include("sidebar.php"); ?>
            
                <div class="main-content" style="background-color: rgb(242, 242, 242); margin-left: 190px;">
                        <div class="main-content-inner">
                          <!-- #section:basics/content.breadcrumbs -->
                                <div class="page-content"> 
                                    <div class="page-content" id="pagecontent" style="display: none;">
                                        <div class="breadcrumbs col-xs-12 col-sm-12 col-md-12 col-lg-12" id="breadcrumbs" style="background: none repeat scroll 0% 0% white; margin: 20px; width: 97%;">
                                            <script type="text/javascript">
                                                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                                            </script>

                                            <ul class="breadcrumb">
                                                <li>
                                                    <i class="ace-icon fa fa-home home-icon"></i>
                                                    <a href="#">首頁</a>
                                                </li>
                                                <li class="active">會員設定</li>
                                                <li class="active">基本資料</li>
                                            </ul>
                                        </div>

                                        <!--AL 0506 edit sample code-->

                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding-left: 21px;">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px; background: none repeat scroll 0% 0% white; border-bottom: 1px solid rgb(229, 229, 229); text-align: center;">
                                                        <div style="left: 0px; right: 0px; border: 1px solid rgb(221, 221, 221); width: 200px; position: relative; margin: 20px auto; height: 200px;">
                                                                    <div id="usericon" class="chessboard-icon bg_top" img="default" style="width: 100%; height: 200px; top: 0px; left: 0px; position: absolute; background-image: url();"></div>
                                                                    <input type="file" id="transient_file" multiple="" target="usericon" style="visibility: hidden;">
                                                                    <div style="background: #1b5489; opacity: 0.8; width: 100%; height: 30px; color: black; font-size: 20pt; position: absolute; top: 140px;"></div>
                                                                    <div id="usericon_upload" style="position: absolute; width: 100%; height: 30px; font-size: 15pt; top: 140px; line-height: 30px; color: white;">變更</div>
                                                                    <div style="opacity: 0.8; width: 100%; height: 30px; color: black; font-size: 20pt; position: absolute; background: #e60012; top: 170px;"></div>
                                                                    <div id="usericon_delete" style="position: absolute; width: 100%; height: 30px; font-size: 15pt; top: 170px; line-height: 30px; color: white;">刪除</div>
                                                                    
                                                                    <!--div style="position: absolute; height: 30px; z-index: 1; top: 168px; width: 400px; left: 163px;">
                                                                        <div id="bar"></div>
                                                                    </div-->
                                                        </div>
                                                    
                                                        <div id="user_name_left" style="font-size: 20pt; height: 70px; line-height: 45px; color: rgb(19, 74, 121);">
                                                                
                                                        </div>
                                                </div>
                                        </div>
                                        <div style="margin-bottom: 100px;" class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: none repeat scroll 0% 0% white; border-bottom: 1px solid rgb(229, 229, 229); padding: 23px 40px;">
                                                <!-- TAB BEGINS -->
                                                        <div class="tabbable">
                                                                <ul class="nav nav-tabs" id="Tab" style="">
                                                                      <li class="col-xs-2 col-sm-2 col-md-2 col-lg-2 active" style="text-align: center; padding: 0px; font-size: 15px;">
                                                                            <a aria-expanded="true" data-toggle="tab" href="#1" style="border-left: 0px none; border-right: 0px none; border-top: 0px none; padding: 15px;">基本資料</a>
                                                                      </li>
                                                                      <!--li class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="text-align: center; padding: 0px; font-size: 15px;">
                                                                            <a aria-expanded="false" data-toggle="tab" href="#2" style="border-left: 0px none; border-right: 0px none; border-top: 0px none; padding: 15px;">合作頻道資料</a>
                                                                      </li-->
                                                                      <li class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="text-align: center; padding: 0px; font-size: 15px;">
                                                                            <a aria-expanded="false" data-toggle="tab" href="#3" style="border-left: 0px none; border-right: 0px none; border-top: 0px none; padding: 15px;">變更密碼</a>
                                                                      </li>
                                                                      <li style="text-align: center; padding: 0px; font-size: 15px;" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                                            <a style="border-left: 0px none; border-right: 0px none; border-top: 0px none; padding: 15px;" href="#4" data-toggle="tab" aria-expanded="false">社群綁定</a>
                                                                      </li>
                                                                </ul>

                                                            <!-- CONTENT BEGINS -->
                                                                <div class="tab-content" style="border: 0px none; padding-left: 7px; margin-top: 20px;">

                                                                        <div class="tab-pane fade  active in" id="1">

                                                                                <div class="col-xs-12" style="padding: 0px; margin-bottom: 30px;">
                                                                                        <form class="form-horizontal" role="form">
                                                                                                <div class="form-group">
                                                                                                        <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">電子信箱</label>
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                                <input type="text" id="email" placeholder="ttshow@gmail.com" class="form-control" disabled>
                                                                                                        </div>
                                                                                                </div>

                                                                                                <div class="form-group" style="margin-bottom: 20px">
                                                                                                        <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">暱稱</label>
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                                <input type="text" id="nickname" class="form-control">
                                                                                                        </div>
                                                                                                </div>

                                                                                                <div class="form-group" style="margin-bottom: 20px">
                                                                                                        <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-2" style="text-align: left; font-size: 15px;">生日</label>
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                            <div style="position: relative;">
                                                                                                            <select type="year" onchange="YearFunction(this);" id="born1" style="width: 30%;"><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option></select>
                                                                                                            <select type="month" onchange="MonthFunction(this);" id="born2" style="width: 30%; position: absolute; margin: auto; right: 0px; left: 0px;">
                                                                                                                    <option value="01">1月</option>
                                                                                                                    <option value="02">2月</option>
                                                                                                                    <option value="03">3月</option>
                                                                                                                    <option value="04">4月</option>
                                                                                                                    <option value="05">5月</option>
                                                                                                                    <option value="06">6月</option>
                                                                                                                    <option value="07">7月</option>
                                                                                                                    <option value="08">8月</option>
                                                                                                                    <option value="09">9月</option>
                                                                                                                    <option value="10">10月</option>
                                                                                                                    <option value="11">11月</option>
                                                                                                                    <option value="12">12月</option>
                                                                                                            </select>
                                                                                                            <select type="day" id="born3" style="width: 30%; right: 0px; position: absolute;"></select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                </div>

                                                                                                <div class="form-group" style="margin-bottom: 20px">
                                                                                                        <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-2" style="text-align: left; font-size: 15px;">性別</label>
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                                <input type="radio" value="man" name="sex" checked="">
                                                                                                                <span class="lbl">男</span>
                                                                                                                <input type="radio" value="woman" name="sex" style="margin-left: 20px">
                                                                                                                <span class="lbl">女</span>
                                                                                                        </div>
                                                                                                </div>

                                                                                                <div class="form-group" style="margin-bottom: 20px">
                                                                                                        <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">居住地</label>
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                                <!--select id="residence_area" style="float: left; margin-right: 10px; margin-top: 5px;">
                                                                                                                        <option value="台灣">台灣</option>
                                                                                                                        <option value="海外">海外</option>
                                                                                                                </select-->
                                                                                                                <div id="twzipcode" style="float: left; padding-top: 5px; width: 100%;">
                                                                                                                    <select name="county" class="county" style="width: 100%;"><option value="">縣市</option><option value="基隆市">基隆市</option><option value="台北市">台北市</option><option value="新北市">新北市</option><option value="宜蘭縣">宜蘭縣</option><option value="新竹市">新竹市</option><option value="新竹縣">新竹縣</option><option value="桃園市">桃園市</option><option value="苗栗縣">苗栗縣</option><option value="台中市">台中市</option><option value="彰化縣">彰化縣</option><option value="南投縣">南投縣</option><option value="嘉義市">嘉義市</option><option value="嘉義縣">嘉義縣</option><option value="雲林縣">雲林縣</option><option value="台南市">台南市</option><option value="高雄市">高雄市</option><option value="屏東縣">屏東縣</option><option value="台東縣">台東縣</option><option value="花蓮縣">花蓮縣</option><option value="金門縣">金門縣</option><option value="連江縣">連江縣</option><option value="澎湖縣">澎湖縣</option><option value="南海諸島">南海諸島</option></select>
                                                                                                                </div>
                                                                                                                <!--input type="text" class="form-control" placeholder="" style="height: 30px; margin-top: 40px; width: 100%;" id="residence"-->
                                                                                                        </div>
                                                                                                </div>

                                                                                                <!--div class="form-group">
                                                                                                        <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">聯絡電話</label>
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                                <input type="text" id="phone" placeholder="不對外公開" class="form-control">
                                                                                                        </div>
                                                                                                </div-->
                                                                                        </form>
                                                                                </div>
                                                                                <div class="col-xs-12" style="padding: 0px;">
                                                                                        <button id="cancel" style="border-radius: 3px; margin-right: 20px; background: none repeat scroll 0% 0% white ! important; border: 1px solid rgb(213, 213, 213); padding: 6px 30px;" class="btn btn-sm  btn-light panel-float-left" type="button">取消</button>
                                                                                        <button id="apply_account_sensible" type="button" class="btn btn-sm  btn-primary panel-float-left" style="border-radius: 3px; padding: 2px 30px; background: none repeat scroll 0% 0% rgb(19, 74, 121) ! important; border-color: rgb(19, 74, 121) ! important;">儲存變更</button>
                                                                                </div>
                                                                        </div>

                                                                        <div id="3" class="tab-pane fade">
                                                                                <div class="col-xs-12" style="padding: 0px; margin-bottom: 30px;">
                                                                                        <form class="form-horizontal" role="form">
                                                                                                <div class="form-group" style="margin-bottom: 20px">
                                                                                                        <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">輸入新密碼</label>
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                                <input type="text" id="ch_psw1" class="form-control">
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="form-group" style="margin-bottom: 20px">
                                                                                                        <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">確認密碼</label>
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                                                                                <input type="text" id="ch_psw2" class="form-control">
                                                                                                        </div>
                                                                                                </div>
                                                                                        </form>
                                                                                </div>
                                                                                <div class="col-xs-12" style="padding: 0px;">
                                                                                        <button id="cancel" style="border-radius: 3px; margin-right: 20px; background: none repeat scroll 0% 0% white ! important; border: 1px solid rgb(213, 213, 213); padding: 6px 30px;" class="btn btn-sm  btn-light panel-float-left" type="button">取消</button>
                                                                                        <button id="btn_ch_psw" type="button" class="btn btn-sm  btn-primary panel-float-left" style="border-radius: 3px; padding: 2px 30px; background: none repeat scroll 0% 0% rgb(19, 74, 121) ! important; border-color: rgb(19, 74, 121) ! important;">儲存變更</button>
                                                                                </div>
                                                                        </div>
                                                                    
                                                                        <div id="4" class="tab-pane fade">
                                                                              <div style="display: block;" id="channel_form_2">

                                                                                    <div id="accordion" class="accordion-style1 panel-group" style="">
                                                                                          <div class="panel panel-default" style="border: 0px">
                                                                                                <div class="panel-heading">
                                                                                                      <h4 class="panel-title">
                                                                                                            <a aria-expanded="true" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                                                                                  <i class="bigger-110 ace-icon fa fa-angle-down" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right">
                                                                                                                  </i>
                                                                                                                  Facebook
                                                                                                            </a>
                                                                                                      </h4>
                                                                                                </div>

                                                                                            <div style="" aria-expanded="true" class="panel-collapse collapse in" id="collapseOne">
                                                                                                  <div class="panel-body">
                                                                                                        <div class="col-xs-12">
                                                                                                              <form class="form-horizontal" role="form">
                                                                                                                <!-- #section:elements.form -->
                                                                                                                    <div class="form-group">
                                                                                                                          <label style="text-align: left; font-size: 15px;" class="col-xs-2 control-label no-padding-right" for="form-field-1">
                                                                                                                            FB粉絲團名稱
                                                                                                                          </label>

                                                                                                                          <div class="col-xs-10">
                                                                                                                                <input type="text" placeholder="請填寫你的粉絲團名稱" class="form-control" id="fb_club_name">
                                                                                                                          </div>
                                                                                                                    </div>

                                                                                                                    <div class="form-group">
                                                                                                                          <label style="text-align: left; font-size: 15px;" class="col-xs-2 control-label no-padding-right" for="form-field-1-1">
                                                                                                                            FB粉絲團連結
                                                                                                                          </label>

                                                                                                                          <div class="col-xs-10">
                                                                                                                                <input type="text" placeholder="http://" class="form-control" id="fb_club_url">
                                                                                                                          </div>
                                                                                                                    </div>

                                                                                                                    <div class="form-group">
                                                                                                                          <label style="text-align: left; font-size: 15px;" class="col-xs-2 control-label no-padding-right" for="form-field-2">
                                                                                                                            粉絲團人數
                                                                                                                          </label>

                                                                                                                          <div class="col-xs-10">
                                                                                                                                <input type="text" placeholder="請填寫你的粉絲團人數" class="form-control" id="fb_club_number">
                                                                                                                          </div>
                                                                                                                    </div>

                                                                                                                    <div class="form-group">
                                                                                                                          <label style="text-align: left; font-size: 15px;" class="col-xs-2 control-label no-padding-right" for="form-field-1-1">
                                                                                                                            個人FB連結
                                                                                                                          </label>

                                                                                                                          <div class="col-xs-10">
                                                                                                                                <input type="text" placeholder="http://" class="form-control" id="fb_user_url">
                                                                                                                          </div>
                                                                                                                    </div>

                                                                                                                    <div class="form-group">
                                                                                                                          <label style="text-align: left; font-size: 15px;" class="col-xs-2 control-label no-padding-right" for="form-field-2">
                                                                                                                            個人追蹤數
                                                                                                                          </label>

                                                                                                                          <div class="col-xs-10">
                                                                                                                                <input type="text" placeholder="請填寫你的粉絲團人數" class="form-control" id="fb_follow_number">
                                                                                                                          </div>
                                                                                                                    </div>
                                                                                                              </form>
                                                                                                        </div>
                                                                                                  </div>
                                                                                            </div>
                                                                                          </div>

                                                                                          <div class="panel panel-default" style="border: 0px">
                                                                                                <div class="panel-heading">
                                                                                                      <h4 class="panel-title">
                                                                                                            <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                                                                                  <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right">
                                                                                                                  </i>
                                                                                                                  Youtube
                                                                                                            </a>
                                                                                                      </h4>
                                                                                                </div>

                                                                                                <div style="height: 0px;" aria-expanded="false" class="panel-collapse collapse" id="collapseTwo">
                                                                                                      <div class="panel-body">
                                                                                                            <div class="col-xs-12">
                                                                                                                  <form class="form-horizontal" role="form">
                                                                                                                    <!-- #section:elements.form -->
                                                                                                                        <div class="form-group">
                                                                                                                              <label class="col-xs-2 control-label no-padding-right" for="form-field-1" style="text-align: left; font-size: 15px;">
                                                                                                                                Youtube頻道名稱
                                                                                                                              </label>

                                                                                                                              <div class="col-xs-10">
                                                                                                                                    <input type="text" placeholder="請填寫你的頻道名稱" class="form-control" id="yt_name">
                                                                                                                              </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group">
                                                                                                                              <label class="col-xs-2 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">
                                                                                                                                Youtube頻道連結
                                                                                                                              </label>

                                                                                                                              <div class="col-xs-10">
                                                                                                                                    <input type="text" placeholder="http://" class="form-control" id="yt_url">
                                                                                                                              </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group">
                                                                                                                              <label class="col-xs-2 control-label no-padding-right" for="form-field-2" style="text-align: left; font-size: 15px;">
                                                                                                                                頻道訂閱數
                                                                                                                              </label>

                                                                                                                              <div class="col-xs-10">
                                                                                                                                    <input type="text" placeholder="請填寫你的頻道訂閱人數" class="form-control" id="yt_subscribe">
                                                                                                                              </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group">
                                                                                                                              <label class="col-xs-2 control-label no-padding-right" for="form-field-tags" style="text-align: left; font-size: 15px;">
                                                                                                                                頻道總觀看數
                                                                                                                              </label>

                                                                                                                              <div class="col-xs-10">
                                                                                                                                    <input type="text" placeholder="此類頻道總觀看數" class="form-control" id="yt_view">
                                                                                                                              </div>
                                                                                                                        </div>
                                                                                                                  </form>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>

                                                                                          <div class="panel panel-default" style="border: 0px">
                                                                                                <div class="panel-heading">
                                                                                                      <h4 class="panel-title">
                                                                                                            <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                                                                                  <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right">
                                                                                                                  </i>
                                                                                                                  Instagram &amp; 其他
                                                                                                            </a>
                                                                                                      </h4>
                                                                                                </div>

                                                                                                <div style="height: 0px;" aria-expanded="false" class="panel-collapse collapse" id="collapseThree">
                                                                                                      <div class="panel-body">
                                                                                                            <div class="col-xs-12">
                                                                                                                  <form class="form-horizontal" role="form">
                                                                                                                    <!-- #section:elements.form -->
                                                                                                                        <div class="form-group">
                                                                                                                              <label class="col-xs-2 control-label no-padding-right" for="form-field-1" style="text-align: left; font-size: 15px;">
                                                                                                                                Instagram帳號
                                                                                                                              </label>

                                                                                                                              <div class="col-xs-10">
                                                                                                                                    <input type="text" placeholder="請輸入帳號" class="form-control" id="ig_id">
                                                                                                                              </div>
                                                                                                                        </div>

                                                                                                                    <div class="form-group">
                                                                                                                          <label class="col-xs-2 control-label no-padding-right" for="form-field-1-1" style="text-align: left; font-size: 15px;">
                                                                                                                            Instagram追隨人數
                                                                                                                          </label>

                                                                                                                          <div class="col-xs-10">
                                                                                                                                <input type="text" placeholder="請輸入追隨人數" class="form-control" id="ig_number">
                                                                                                                          </div>
                                                                                                                    </div>
                                                                                                                  </form>
                                                                                                                  <form class="form-horizontal" role="form">
                                                                                                                        <!-- #section:elements.form -->
                                                                                                                        <div class="form-group">
                                                                                                                              <label class="col-xs-2 control-label no-padding-right" for="form-field-1" style="text-align: left; font-size: 15px;">
                                                                                                                                其他個人網站或社群
                                                                                                                              </label>

                                                                                                                              <div class="col-xs-10">
                                                                                                                                    <textarea class="form-control" placeholder="如有其他個人網站請填寫連結" id="other_association">
                                                                                                                                    </textarea>
                                                                                                                              </div>
                                                                                                                        </div>
                                                                                                                  </form>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                              </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                            <div style="background: white none repeat scroll 0% 0%; color: gray; border: 1px solid rgb(229, 229, 229); margin-top: 40px; padding: 20px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div style="font-size: 15px; margin-bottom: 10px;">登入 / 帳戶資訊</div>
                                                    <div style="font-size: 15px; margin-bottom: 5px;">
                                                            註冊時間
                                                            <sapn id="registration_time" style="margin-left: 50px"></sapn>
                                                    </div>
                                                    <div style="font-size: 15px;">
                                                            最近登入時間
                                                            <sapn id="last_login_time" style="margin-left: 20px;"></sapn>
                                                    </div>
                                            </div>
                                            
                                            <div style="background: none repeat scroll 0% 0% white; border-bottom: 1px solid rgb(229, 229, 229); margin-top: 20px; color: gray; padding: 30px 40px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div style="margin: 15px 0px; height: 30px;">
                                                            <div style="float: left; font-size: 18pt; line-height: 30px; height: 30px; color: black; margin-right: 100px; width: 150px;">Facebook</div>
                                                            <div style="width: 100px; height: 30px; background: #3b579d; float: left;">
                                                                <img src="template/assets/img/fb_logo.png" style="width: 25px; float: left; border-radius: 2px; margin-top: 2px; margin-left: 3px;">
                                                                <div style="color: white; font-weight: bold; font-size: 12pt; line-height: 30px; margin-left: 5px; float: left;">
                                                                    已連結
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div style="margin: 15px 0px; height: 30px;">
                                                            <div style="float: left; font-size: 18pt; line-height: 30px; height: 30px; color: black; margin-right: 100px; width: 150px;">Youtube</div>
                                                            <div style="width: 100px; height: 30px; float: left; background: none repeat scroll 0% 0% rgb(210, 60, 54);">
                                                                <img src="template/assets/img/youtube_logo.png" style="width: 25px; float: left; border-radius: 2px; margin-top: 5px; margin-left: 3px;">
                                                                <div style="color: white; font-weight: bold; font-size: 12pt; line-height: 30px; margin-left: 5px; float: left;">
                                                                    未連結
                                                                </div>
                                                            </div>
                                                    </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                </div>
                </div>
        </div>
        
        <div id="change_img_select_modal" load="false" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                                    <div class="modal-header">
                                                <div style="font-size: 24pt;">選擇圖片</div>
                                                <button style="position: absolute; top: 0px; right: 0px; margin-top: 10px; margin-right: 10px;" type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">
                                                                <span class="glyphicon glyphicon-remove"></span>
                                                        </span>
                                                        <span class="sr-only">Close</span>
                                                </button>
                                    </div>

                                    <div class="modal-body">
                                            <div id="ttshow_img_list_space" style="overflow-y: scroll; margin-bottom: 20px; max-height: 720px; min-height: 250px;" class="col-xs-12 col-sm-7 col-md-9 col-lg-9">
                                            </div>
                                            <div id="ttshow_img_list_example_model" style="background-position: 50% 50%; background-size: cover; display: none; border: 1px solid black; margin: 5px; float: left; height: 170px; width: 170px;"></div>
                                            <img id="ttshow_img_list_example_model_2" style="display: none; border: 1px solid black; margin: 5px; float: left; height: 170px; width: 170px;"></img>
                                            <div style="min-height: 200px;" class="col-xs-12 col-sm-5 col-md-3 col-lg-3">
                                                    <input type="file" style="display: none;" multiple="" id="ttshow_cloud_disk">
                                                    <div style="border: 1px dashed black; width: 100%; float: right; margin: 0px auto; right: 0px; position: relative; height: 200px;" class="col-xs-12" id="upload_cloud_disk">
                                                            <div id="preinstall">
                                                                <img alt="ttshow" src="template/assets/img/uplaod-01.png" style="position: absolute; margin: auto; left: 0px; right: 0px; top: 0px; bottom: 40px;">
                                                                <div style="background-position: 50% 50%; background-size: cover; position: absolute; margin: auto; left: 0px; right: 0px; bottom: 40px; font-size: 12pt; width: 40px; height: 15px; top: 75px; text-align: center;">上傳</div>
                                                            </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div style="text-align: right; margin-top: 10px ">
                                                            <a class="btn btn-info" id="change_img_select_modal_yes" style="margin-right: 10px"> Save </a>
                                                            <a data-dismiss="modal" class="btn btn-default" id="change_img_select_modal_no"> Cancel </a>
                                                            <a class="btn btn-default" id="delete_img" style="display:none;"> Delete Image </a>
                                                    </div>
                                                    <div style="position: relative;" id="bar"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                    </div>

                        </div>
                </div>
        </div>
        
        <?php include( "footer.php"); ?>

        
        <!-- /.main-content -->
        
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
        
        </div>
        <!-- /.main-container -->

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
		<!--script src="template/assets/js/ace/ace.widget-box.js"></script>
		<script src="template/assets/js/ace/ace.settings.js"></script>
		<script src="template/assets/js/ace/ace.settings-rtl.js"></script>
		<script src="template/assets/js/ace/ace.settings-skin.js"></script>
		<script src="template/assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="template/assets/js/ace/ace.searchbox-autocomplete.js"></script-->

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
                            
				//jquery tabs
                                if( $( "#tabs" ).length )
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
        
        <script src="js/jquery.twzipcode.min.js"></script>
        <script src="js/view_upload_img.js"></script>
        <script src="js/fb-login.js"></script>
        
        <style>
                .zipcode { display: none; }
                .county { margin-right: 10px; }
                .district { margin-right: 10px; }
        </style>
        
        <script type="text/javascript">
                
                $("document").ready(function() {
                    
                        /*$('#twzipcode').twzipcode({
                                'css': ['county', 'district', 'zipcode'] ,
                        });*/
                    
                        /////////
                        var tmp = "";
                        var j = new Date().getFullYear();
                        for( i=0 ; i<200 ; i++ )
                        {
                                tmp += '<option value=' + (j-i) + '>' + (j-i) + '</option>';
                        }
                        $("select[type=year]").html(tmp);
                        MonthFunction($("[type=month]"));
                        /////////
                        
                        $("#footer_bar").children().css("left","190px");
                        $("#sidebar").css("z-index","2");
                        $.upload_file = {};
                        $.upload_file.beforeunload = {};
                        $("#usericon_delete").unbind('click').bind( "click" , function(e) {
                                $("#usericon").css("background-image","");
                                $("#usericon").attr("img","");
                        });
                        $("#usericon_upload").unbind('click').bind( "click" , function(e) {
                                //$("#transient_file").click();
                                $( "#change_img_select_modal" ).modal( "show" );
                        });
                        
                        $( "#apply_account_sensible" ).click( function() {
                               $( "#loadingpage" ).show();
                                var usericon = $("#usericon").attr("img");
                                usericon = usericon.substr( usericon.lastIndexOf("/")+1 , usericon.length);
                                
                                var address = "";
                                address = $("#twzipcode select").eq(0).val();
                                
                                var data = {
                                            usericon : usericon,
                                            email    : $.member.email ,
                                            name : $( "#nickname" ).val() ,
                                            birthday : $( "#born1" ).val() + "-" + $( "#born2" ).val() + "-" + $( "#born3" ).val() ,
                                            sex      : $( "input[name=sex]:checked" ).val() ,
                                            residence: address ,
                                            //phone    : $( "#phone" ).val() ,
                                };
                              
                                $.ajax({
                                            type: "POST",
                                            url: "php/signup.php",
                                            data: {
                                                cmd : "modify",
                                                data : data
                                            },
                                            success: function( data )
                                            {
                                                    try {
                                                            var data = JSON.parse(data);
                                                            if( data.success == "true" ) {
                                                                    alert("save success");
                                                                    $( "#loadingpage" ).hide();
                                                            }
                                                            else if( data.success == "false" && data.describe == "email" ) {
                                                                    alert("email 重複");
                                                                    $("#form_email").css("border" , "1px solid red");
                                                                    $( "#loadingpage" ).hide();
                                                            } else {
                                                                    alert("save fail");
                                                                    $( "#loadingpage" ).hide();                                                                
                                                            }
                                                    }catch(e) {
                                                            console.log(e);
                                                    }
                                            }
                                });                         
                        });
                        
                        
                        
                        $( "#btn_ch_psw" ).click( function() {
                                
                                var bool = true;
                                if( !$( "#ch_psw1" ).val() ) {
                                    bool = false;
                                    $( "#ch_psw1" ).parent().addClass( "has-error" );
                                }
                                else {
                                    $( "#ch_psw1" ).parent().removeClass( "has-error" );
                                }
                                if( !$( "#ch_psw2" ).val() || $( "#ch_psw2" ).val() !== $( "#ch_psw1" ).val() ) {
                                    bool = false;
                                    $( "#ch_psw2" ).parent().addClass( "has-error" );
                                }
                                else {
                                    $( "#ch_psw2" ).parent().removeClass( "has-error" );
                                }
                                
                                if( bool ) {
                                    $.ajax({
                                                type: "POST",
                                                url: "php/member.php?func=change_psw",
                                                data: {
                                                    email : $.member.email,
                                                    psw : md5( $( "#ch_psw1" ).val() )
                                                },
                                                success: function( data )
                                                {
                                                        try {
                                                                var data = JSON.parse(data);
                                                                if( data != "false" ) {
                                                                        alert("修改成功");
                                                                }
                                                                else {
                                                                        alert("修改失敗");
                                                                }
                                                        }catch(e) {
                                                                console.log(e);
                                                        }
                                                }
                                    });    
                                }
                                
                        });
                        
                        $( "#cancel" ).click( function() {
                        });
                        
                        /*$( "#residence_area" ).change(function() {
                                var val = $( "#residence_area" ).val();
                                if( val == "台灣" ) {
                                        $("#twzipcode select").removeAttr("disabled");
                                        $("#twzipcode select").css("background","")
                                } else if( val == "海外" ) {
                                        $("#twzipcode select").attr("disabled","");
                                        $("#twzipcode select").css("background","#dddddd")
                                }
                        });*/
                        
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
                        
                        $('#change_img_select_modal')
                        .on('show.bs.modal', function (e) {
                                if( $('#change_img_select_modal').attr("load") == "false" ) {
                                        $('#change_img_select_modal').attr("load","true");
                                        ttshow_get_user_img();
                                }
                        })
                        .on('hidden.bs.modal', function (e) {                
                                    //$.View.view_sidebar().options().click_img = "";
                        });
                        $("#change_img_select_modal_yes").unbind('click').bind( 'click' , function() {
                                var src = $("#ttshow_img_list_space div[target]").css("background-image");
                                console.log(src);
                                var _src = src.replace("url(","").replace(")","").replace("\"","").replace("\"","");
                                _src = _src.split( "/" )[_src.split( "/" ).length-1];
                                console.log(src);
                                if( src != undefined ) {
                                        $( "#usericon" ).css( "background-image" , src );
                                        $( "#usericon" ).attr( "img" , _src );
                                        $("#change_img_select_modal").modal("hide");
                                }
                        });
                        $("#delete_img").unbind('click').bind( 'click' , function() {
                                var pos = $("#ttshow_img_list_space div[target]");
                                var src = pos.css("background-image");
                                console.log(src);
                                src = src.replace("url(","").replace(")","").replace("\"","").replace("\"","");
                                console.log(src);
                                var img = src.split( "/" )[src.split( "/" ).length-1];
                                var img_array = [ img ];
                                $.ajax({
                                        type    : "POST",  
                                        url     : "php/user_delete_image.php" ,
                                        data    : {
                                                    account : JSON.parse( getCookie( "ttshow" ) ).user_id ,
                                                    img    : img_array
                                        },
                                        success: function(data) 
                                        {
                                                if( data === "true" )
                                                {
                                                        pos.remove();
                                                        $( "#delete_img" ).hide();
                                                }

                                        }
                                });
                        });
                        
                });
                function YearFunction(sel)
                {
                        var tmp = "";
                        if( $("[type=month]").val() === "02" )
                        {
                                if( parseInt( $(sel).val() )%4 === 0 )
                                    var days = 29;
                                else
                                    var days = 28;
                                for( i=1 ; i<=days ; i++ )
                                {
                                        if( i < 10 )
                                            tmp += '<option value=0' + i + '>' + i + '日</option>';
                                        else
                                            tmp += '<option value=' + i + '>' + i + '日</option>';
                                }
                                $("[type=day]").html(tmp);
                        }
                }
                function MonthFunction(sel)
                {
                        var tmp = "";
                        switch( $(sel).val() )
                        {
                        case "01":
                        case "03":
                        case "05":
                        case "07":
                        case "08":
                        case "10":
                        case "12":
                          var days = 31;
                          break;

                        case "04":
                        case "06":
                        case "09":
                        case "11":
                          var days = 30;
                          break;

                        case "02":
                          if( parseInt( $("[type=year]").val() )%4 === 0 )
                              var days = 29;
                          else
                              var days = 28;
                          break;
                        }
                        for( i=1 ; i<=days ; i++ )
                        {
                                if( i < 10 )
                                    tmp += '<option value=0' + i + '>' + i + '日</option>';
                                else
                                    tmp += '<option value=' + i + '>' + i + '日</option>';
                        }
                        $("[type=day]").html(tmp);
                }
                function FB_connected_callback_init( response )
                {
                            console.log( '---------------------------' );
                            console.log( response );
                            $.member = response;
                            select_user_data( response );
                            console.log( '---------------------------' );
                }
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            $( "#pagecontent" ).hide();
                            Login_Popup_show();
                };
                
                function unlogin_jump()
                {
                            location.href = "index.php";
                }
                
                function select_user_data( data ) {

                            console.log( data );
                            $("#user_name_left").html( data.user_name );
                            $("#user_name").html( data.user_name );
                            $( "#usericon" ).css("background-image","url(" + data.usericon + ")");
                            $( "#email" ).val( data.email );
                            $( "#nickname" ).val( data.user_name );

                            var birthday = data.birthday.split("-");
                            $( "#born1" ).val( birthday[0] );
                            $( "#born2" ).val( birthday[1] );
                            $( "#born3" ).val( birthday[2] );

                            if( data.sex ) {
                                $( "input[name=sex][value=" + data.sex + "]" ).click();
                            }

                            $("#twzipcode select").eq(0).val( data.residence );
                            /*var residence = data.residence.split("-");
                            if( residence[0] == "台灣" ) {
                                    $("#residence_area").val( residence[0] );
                                    $("#twzipcode select").eq(0).val( residence[1] );
                                    $("#twzipcode select").eq(0).change();
                                    $("#twzipcode select").eq(1).val( residence[2] );
                                    $("#residence").val( residence[3] );
                            } else if( residence[0] == "海外" ) {
                                    $("#residence_area").val( residence[0] );
                                    $("#residence").val( residence[1] );
                            } else { console.log( residence ); }*/

                            //$( "#phone" ).val( data.phone );

                            $( "#registration_time" ).html( data.registration_time );
                            $( "#last_login_time" ).html( data.last_login_time );

                            $( "#pagecontent" ).show();
                            $( "#loadingpage" ).hide();
                }
                

                var ttshow_get_user_img = function() {
                        var data = {
                            cmd : "list",
                            ttshow : getCookie( "ttshow" )
                        };
                        callback = function( data ){
                                try {
                                        var data = JSON.parse( data );
                                        var url = data.url;
                                        $.each( data , function(index, value) {
                                                var clone = $("#ttshow_img_list_example_model_2").clone();
                                                var clone_div = $("#ttshow_img_list_example_model").clone();
                                                clone.removeAttr("id");
                                                clone_div.removeAttr("id");
                                                //clone.attr("src", url + value );
                                                clone.attr("img", url + value);
                                                clone_div.attr("img", url + value);
                                                $("#ttshow_img_list_space").append( clone );
                                                $("#ttshow_img_list_space").append( clone_div );
                                        });
                                        var div = $("#ttshow_img_list_space img[img]").eq(0);
                                        div.attr("src", div.attr("img") );
                                        div.removeAttr("img");

                                        var div2 = $("#ttshow_img_list_space img[img]").eq(0);
                                        div2.css("background-image","url(" + div2.attr("img") + ")");
                                        div2.removeAttr("img");
                                        $.ttshow_change_img_event = function(e) {
                                                $("#ttshow_img_list_space div").css("border" , "1px solid black" );
                                                $("#ttshow_img_list_space div").removeAttr("target");
                                                $( e.target ).css("border" , "5px solid gray" );
                                                $( e.target ).attr("target","");
                                                $( "#delete_img" ).show();
                                        }
                                        var change = function() {
                                                if( $("#ttshow_img_list_space img[img]").length != 0 ) {
                                                        var div = $("#ttshow_img_list_space img[img]").eq(0);
                                                        div.attr("src", div.attr("img") );
                                                        div.removeAttr("img");
                                                        div.load( change );
                                                        div.error( change );

                                                        var div2 = $("#ttshow_img_list_space div[img]").eq(0);
                                                        div2.css("background-image","url(" + div2.attr("img") + ")");
                                                        div2.css("display","block");
                                                        div2.removeAttr("img");
                                                        div2.unbind('click').bind( 'click' , $.ttshow_change_img_event );
                                                }
                                                console.log( $("#ttshow_img_list_space img[img]").length );
                                        };
                                        div.load( change );
                                }catch(e) {
                                        console.log(e);
                                }
                                console.log(data);
                        };
                        errorback = function( data ){
                            console.log(data);
                        };
                        $.Ajax( "POST" , "php/backend_manage_img.php" , data , "" , callback , errorback );
                }

                $("#upload_cloud_disk").unbind('click').bind( 'click' , function() {
                        $("#ttshow_cloud_disk").click();
                        console.log( "ttshow_cloud_disk" );
                });
                
        </script>
        
        
</body>

</html>
