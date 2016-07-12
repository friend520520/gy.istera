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
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
            
                <div class="main-content" style="background-color:#f2f2f2">
                        <div class="main-content-inner"> 
                                <div class="page-content" id="pagecontent" style="margin-top: 40px;">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                                <div class="col-md-1 col-lg-1"></div>
                                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="padding:0px;">
                                                        <?php include( "cooperate_tab.php"); ?>
                                                        <div style="background-color: white; padding: 0px 0px 50px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div style="padding: 30px 40px 49px;">
                                                                        <button style="border-radius: 3px; background-color: rgb(41, 103, 165); padding: 3px 7px;" class="btn btn-sm btn-primary panel-float-left">
                                                                                新增文章
                                                                        </button>
                                                                    <form style="margin: 0px; padding: 0px;" role="search" class="navbar-form navbar-right">
                                                                            <div style="border: 1px solid rgb(213, 213, 213); margin-right: 5px;" class="form-group">
                                                                                    <input type="text" style="height: 30px; width: 200px;" placeholder="" class="form-control">
                                                                            </div>
                                                                            <button style="border: 1px solid rgb(213, 213, 213); background-color: #eeeeee; color: black; text-shadow: 0px 0px 0px transparent; padding: 5px 14px;" class="btn btn-default" type="submit">
                                                                                    搜尋
                                                                            </button>
                                                                    </form>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div style="margin: 0px 40px;">
                                                                        <span style="font-size: 14px; float: right;">
                                                                                154個項目
                                                                        </span>
                                                                        <br>
                                                                        <div style="float: left; margin-top: 15px;">
                                                                                <label style="margin-right: 31px;" class="pos-rel">
                                                                                        <input type="checkbox" class="ace">
                                                                                        <span class="lbl"></span>
                                                                                </label>
                                                                                <div class="btn-group" style="margin-right: 40px">
                                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;">
                                                                                                操作
                                                                                                <i class="ace-icon fa fa-caret-down icon-on-right" style="margin-left: 10px"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>							
                                                                                        </ul>
                                                                                </div>
                                                                                <div style="margin-right: 5px;" class="btn-group">
                                                                                        <button style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;" class="btn btn-primary btn-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                                                所有日期
                                                                                                <i style="margin-left: 10px" class="ace-icon fa fa-caret-down icon-on-right"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>
                                                                                        </ul>
                                                                                </div>
                                                                                <div class="btn-group" style="margin-right: 5px;">
                                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;">
                                                                                                所有分類
                                                                                                <i class="ace-icon fa fa-caret-down icon-on-right" style="margin-left: 10px"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>
                                                                                        </ul>
                                                                                </div>
                                                                                <button style="border: 1px solid rgb(220, 220, 220); background-color: rgb(242, 242, 242); color: black; text-shadow: 0px 0px 0px transparent; padding: 5px 14px; margin-left: 10px;" class="btn btn-default" type="submit">
                                                                                    篩選
                                                                                </button>
                                                                        </div>
                                                                        <div class="btn-group" style="margin-top: 15px; float: right;">
                                                                                <button type="button" class="btn btn-default" aria-label="Left Align" style="background-color: rgb(238, 238, 238); border: 0.5px solid rgb(221, 221, 221); margin: 0px; text-shadow: 0px 0px 0px transparent; color: #7c7c7c; padding: 5px 10px;">
                                                                                        <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                                                                                </button>
                                                                                <button type="button" class="btn btn-default" aria-label="Justify" style="background-color: rgb(210, 210, 210); border: 0.5px solid #7c7c7c; padding: 5px 10px; margin: 0px; text-shadow: 0px 0px 0px transparent; color: #7c7c7c;">
                                                                                        <span class="glyphicon glyphicon-list " aria-hidden="true"></span>
                                                                                </button>
                                                                        </div>
                                                                        <table cellspacing="0" cellpadding="0" border="0" style="table-layout: auto; float: right; margin-top: 15px; margin-right: 45px;" class="ui-pg-table">
                                                                                <tbody>
                                                                                        <tr>
                                                                                                <td class="ui-pg-button ui-corner-all ui-state-disabled" id="prev_grid-pager" style="cursor: default; text-indent: 0px; background: #eeeeee">
                                                                                                        <span class="ui-icon ace-icon fa fa-angle-left bigger-140" style="text-indent: 0px; border: 0px none; background: #eeeeee ;color: #7c7c7c;">
                                                                                                        </span>
                                                                                                </td>
                                                                                                <td class="ui-pg-button ui-state-disabled" style="width:10px;">
                                                                                                        <span class="ui-separator"></span>
                                                                                                </td>
                                                                                                <td dir="ltr">
                                                                                                        <input type="text" class="ui-pg-input" size="2" maxlength="7" value="1" role="textbox" style="text-align: center; width: 45px; margin-right: 7px;">
                                                                                                        /
                                                                                                        <span id="sp_1_grid-pager" style="margin-left: 6px; font-size: 15px;">
                                                                                                            5
                                                                                                        </span>
                                                                                                </td>
                                                                                                <td class="ui-pg-button ui-state-disabled" style="width:10px;">
                                                                                                        <span class="ui-separator"></span>
                                                                                                </td>
                                                                                                <td style="cursor: default; text-indent: 0px; background: #eeeeee" class="ui-pg-button ui-corner-all" id="next_grid-pager">
                                                                                                        <span class="ui-icon ace-icon fa fa-angle-right bigger-140" style="text-indent: 0px; border: 0px none; background: #eeeeee ;color: #7c7c7c;"></span>
                                                                                                </td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <label class="pos-rel" style="float: left; margin-left: 40px; margin-top: 40px;">
                                                                        <input type="checkbox" class="ace">
                                                                        <span class="lbl"></span>
                                                                </label>
                                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 cover-text1" style="padding-right: 0px; padding-left: 35px;">
                                                                        <div style="padding: 0px;margin: 0" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                                                                <div id="list_article_icon" page="135"  class="bg_top pagebg" style="cursor: pointer; background-image: url(); width: 105%; height: 105px;"></div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9" style="padding: 0px; margin: 0px;">
                                                                                <p class="pagebg title" page="135">打《英雄聯盟LOL》都不想碰到的事【頑Game】</p>
                                                                                <br>
                                                                                <div class="description">
                                                                                        <i class="ace-icon fa fa-tag panel-icon fa-flip-horizontal"></i>
                                                                                        <span>影片</span>
                                                                                        <i class="ace-icon glyphicon glyphicon-time"></i>
                                                                                        <span id="List_date">2015-05-21 17:40</span>
                                                                                        <i class="ace-icon fa fa-eye panel-icon"></i>
                                                                                        <span>21</span>
                                                                                        <i class="ace-icon fa fa-share panel-icon"></i>
                                                                                        <span>5</span>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 new-btn-group">
                                                                        <div class="hidden-xs">
                                                                                <button class="btn btn-xs btn-success green-button">
                                                                                        <span>上架</span>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                                </button>
                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-line-chart bigger-120"></i>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </button>
                                                                        </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <label class="pos-rel" style="float: left; margin-left: 40px; margin-top: 40px;">
                                                                        <input type="checkbox" class="ace">
                                                                        <span class="lbl"></span>
                                                                </label>
                                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 cover-text1" style="padding-right: 0px; padding-left: 35px;">
                                                                        <div style="padding: 0px;margin: 0" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                                                                <div id="list_article_icon" page="135"  class="bg_top pagebg" style="cursor: pointer; background-image: url(); width: 105%; height: 105px;"></div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9" style="padding: 0px; margin: 0px;">
                                                                                <p class="pagebg title" page="135">《頑game到你家》【頑GAME】</p>
                                                                                <br>
                                                                                <div class="description">
                                                                                        <i class="ace-icon fa fa-tag panel-icon fa-flip-horizontal"></i>
                                                                                        <span>影片</span>
                                                                                        <i class="ace-icon glyphicon glyphicon-time"></i>
                                                                                        <span id="List_date">2015-05-21 17:40</span>
                                                                                        <i class="ace-icon fa fa-eye panel-icon"></i>
                                                                                        <span>21</span>
                                                                                        <i class="ace-icon fa fa-share panel-icon"></i>
                                                                                        <span>5</span>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 new-btn-group">
                                                                        <div class="hidden-xs">
                                                                                <button class="btn btn-xs btn-danger red-button">
                                                                                        <span>下架</span>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                                </button>
                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-line-chart bigger-120"></i>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </button>
                                                                        </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <!--sample code start-->
                                                                <label class="pos-rel" style="float: left; margin-left: 40px; margin-top: 40px;">
                                                                        <input type="checkbox" class="ace">
                                                                        <span class="lbl"></span>
                                                                </label>
                                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 cover-text1" style="padding-right: 0px; padding-left: 35px;">
                                                                        <div style="padding: 0px;margin: 0" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                                                                <div id="list_article_icon" page="135"  class="bg_top pagebg" style="cursor: pointer; background-image: url(&quot;http://www.ooxxoox.com/ttshow/web/data/135/ThumbnailM/pagicon.jpg&quot;); width: 105%; height: 105px;"></div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9" style="padding: 0px; margin: 0px;">
                                                                                <p class="pagebg title" page="135">打《英雄聯盟LOL》都不想碰到的事【頑Game】</p>
                                                                                <br>
                                                                                <div class="description">
                                                                                        <i class="ace-icon fa fa-tag panel-icon fa-flip-horizontal"></i>
                                                                                        <span>影片</span>
                                                                                        <i class="ace-icon glyphicon glyphicon-time"></i>
                                                                                        <span id="List_date">2015-05-21 17:40</span>
                                                                                        <i class="ace-icon fa fa-eye panel-icon"></i>
                                                                                        <span>21</span>
                                                                                        <i class="ace-icon fa fa-share panel-icon"></i>
                                                                                        <span>5</span>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 new-btn-group">
                                                                        <div class="hidden-xs">
                                                                                <button class="btn btn-xs btn-success green-button">
                                                                                        <span>上架</span>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                                </button>
                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-line-chart bigger-120"></i>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </button>
                                                                        </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <label class="pos-rel" style="float: left; margin-left: 40px; margin-top: 40px;">
                                                                        <input type="checkbox" class="ace">
                                                                        <span class="lbl"></span>
                                                                </label>
                                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 cover-text1" style="padding-right: 0px; padding-left: 35px;">
                                                                        <div style="padding: 0px;margin: 0" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                                                                <div id="list_article_icon" page="135"  class="bg_top pagebg" style="cursor: pointer; background-image: url(&quot;http://www.ooxxoox.com/ttshow/web/data/135/ThumbnailM/pagicon.jpg&quot;); width: 105%; height: 105px;"></div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9" style="padding: 0px; margin: 0px;">
                                                                                <p class="pagebg title" page="135">打《英雄聯盟LOL》都不想碰到的事【頑Game】</p>
                                                                                <br>
                                                                                <div class="description">
                                                                                        <i class="ace-icon fa fa-tag panel-icon fa-flip-horizontal"></i>
                                                                                        <span>影片</span>
                                                                                        <i class="ace-icon glyphicon glyphicon-time"></i>
                                                                                        <span id="List_date">2015-05-21 17:40</span>
                                                                                        <i class="ace-icon fa fa-eye panel-icon"></i>
                                                                                        <span>21</span>
                                                                                        <i class="ace-icon fa fa-share panel-icon"></i>
                                                                                        <span>5</span>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 new-btn-group">
                                                                        <div class="hidden-xs">
                                                                                <button class="btn btn-xs btn-success green-button">
                                                                                        <span>上架</span>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                                </button>
                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-line-chart bigger-120"></i>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </button>
                                                                        </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <label class="pos-rel" style="float: left; margin-left: 40px; margin-top: 40px;">
                                                                        <input type="checkbox" class="ace">
                                                                        <span class="lbl"></span>
                                                                </label>
                                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 cover-text1" style="padding-right: 0px; padding-left: 35px;">
                                                                        <div style="padding: 0px;margin: 0" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                                                                <div id="list_article_icon" page="135"  class="bg_top pagebg" style="cursor: pointer; background-image: url(); width: 105%; height: 105px;"></div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9" style="padding: 0px; margin: 0px;">
                                                                                <p class="pagebg title" page="135">《頑game到你家》【頑GAME】</p>
                                                                                <br>
                                                                                <div class="description">
                                                                                        <i class="ace-icon fa fa-tag panel-icon fa-flip-horizontal"></i>
                                                                                        <span>影片</span>
                                                                                        <i class="ace-icon glyphicon glyphicon-time"></i>
                                                                                        <span id="List_date">2015-05-21 17:40</span>
                                                                                        <i class="ace-icon fa fa-eye panel-icon"></i>
                                                                                        <span>21</span>
                                                                                        <i class="ace-icon fa fa-share panel-icon"></i>
                                                                                        <span>5</span>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 new-btn-group">
                                                                        <div class="hidden-xs">
                                                                                <button class="btn btn-xs btn-danger red-button">
                                                                                        <span>下架</span>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                                </button>
                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-line-chart bigger-120"></i>
                                                                                </button>

                                                                                <button class="btn btn-xs btn-info blue-button">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                </button>
                                                                        </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <!--sample code end-->
                                                                <div style="margin: 0px 40px;">
                                                                        <div style="float: left; margin-top: 5px;">
                                                                                <label style="margin-right: 31px;" class="pos-rel">
                                                                                        <input type="checkbox" class="ace">
                                                                                        <span class="lbl"></span>
                                                                                </label>
                                                                                <div class="btn-group" style="margin-right: 40px">
                                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;">
                                                                                                操作
                                                                                                <i class="ace-icon fa fa-caret-down icon-on-right" style="margin-left: 10px"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>							
                                                                                        </ul>
                                                                                </div>
                                                                                <div style="margin-right: 5px;" class="btn-group">
                                                                                        <button style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;" class="btn btn-primary btn-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                                                所有日期
                                                                                                <i style="margin-left: 10px" class="ace-icon fa fa-caret-down icon-on-right"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>
                                                                                        </ul>
                                                                                </div>
                                                                                <div class="btn-group" style="margin-right: 5px;">
                                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" style="border: 1px solid rgb(213, 213, 213); color: black ! important; padding: 5px 15px;">
                                                                                                所有分類
                                                                                                <i class="ace-icon fa fa-caret-down icon-on-right" style="margin-left: 10px"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                                <li>
                                                                                                        <a href="#">Action</a>
                                                                                                </li>
                                                                                        </ul>
                                                                                </div>
                                                                                <button style="border: 1px solid rgb(220, 220, 220); background-color: rgb(242, 242, 242); color: #7c7c7c; text-shadow: 0px 0px 0px transparent; padding: 5px 14px; margin-left: 10px;" class="btn btn-default" type="submit">
                                                                                    篩選
                                                                                </button>
                                                                        </div>
                                                                        <div class="btn-group" style="float: right; margin-top: 5px;">
                                                                                <button type="button" class="btn btn-default" aria-label="Left Align" style="background-color: rgb(238, 238, 238); border: 0.5px solid rgb(221, 221, 221); margin: 0px; text-shadow: 0px 0px 0px transparent; color: #7c7c7c; padding: 5px 10px;">
                                                                                        <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                                                                                </button>
                                                                                <button type="button" class="btn btn-default" aria-label="Justify" style="background-color: rgb(210, 210, 210); border: 0.5px solid #7c7c7c; padding: 5px 10px; margin: 0px; text-shadow: 0px 0px 0px transparent; color: #7c7c7c;">
                                                                                        <span class="glyphicon glyphicon-list " aria-hidden="true"></span>
                                                                                </button>
                                                                        </div>
                                                                        <table cellspacing="0" cellpadding="0" border="0" style="table-layout: auto; float: right; margin-right: 45px; margin-top: 5px;" class="ui-pg-table">
                                                                                <tbody>
                                                                                        <tr>
                                                                                                <td class="ui-pg-button ui-corner-all ui-state-disabled" id="prev_grid-pager" style="cursor: default; text-indent: 0px; background: #eeeeee">
                                                                                                        <span class="ui-icon ace-icon fa fa-angle-left bigger-140" style="text-indent: 0px; border: 0px none; background: #eeeeee ;color: #7c7c7c;">
                                                                                                        </span>
                                                                                                </td>
                                                                                                <td class="ui-pg-button ui-state-disabled" style="width:10px;">
                                                                                                        <span class="ui-separator"></span>
                                                                                                </td>
                                                                                                <td dir="ltr">
                                                                                                        <input type="text" class="ui-pg-input" size="2" maxlength="7" value="1" role="textbox" style="text-align: center; width: 45px; margin-right: 7px;">
                                                                                                        /
                                                                                                        <span id="sp_1_grid-pager" style="margin-left: 6px; font-size: 15px;">
                                                                                                            5
                                                                                                        </span>
                                                                                                </td>
                                                                                                <td class="ui-pg-button ui-state-disabled" style="width:10px;">
                                                                                                        <span class="ui-separator"></span>
                                                                                                </td>
                                                                                                <td style="cursor: default; text-indent: 0px; background: #eeeeee" class="ui-pg-button ui-corner-all" id="next_grid-pager">
                                                                                                        <span class="ui-icon ace-icon fa fa-angle-right bigger-140" style="text-indent: 0px; border: 0px none; background: #eeeeee ;color: #7c7c7c;"></span>
                                                                                                </td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                        <div class="clearfix"></div>
                                                                        <span style="font-size: 14px; float: right; margin-top: 15px;">
                                                                                154個項目
                                                                        </span>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-1 col-lg-1"></div>
                                        </div>
                                </div>
                        </div>
                </div>

                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                </a>
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


        <!-- the following scripts are used in demo only for onpage help and you don't need them -->
        <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
        <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

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
                            console.log( '---------------------------' );
                            console.log( response );
                            
                            $.member = response;
                            
                            $( "#user-profile" ).hide().html( 'Dear ' + response.name );
                            
                            $( "#user-profile-join" ).hide(); // show
                            
                            $( "#user-profile-join" ).unbind( "click" ).bind( "click", function(e) {
                                        alert(123);
                            });
                            console.log( '---------------------------' );
                            
                            
                            $( "#fb-login-button" ).removeClass( "nav-search" );
                            
                            $("#pagecontent").css("display","block");
                            //init();
                };

                function FB_unconnected_callback_init()
                {
                            console.log( '---------------------------' );
                            $.member = "";
                            $( "#user-profile" ).hide();
                            
                            $( "#user-profile-join" ).hide();
                            
                            $( "#user-profile-join" ).unbind( "click" );
                            
                            console.log( '---------------------------' );
                            
                            //use_getbody();
                            $("#subscribe_button").css("display","none");
                            
                            
                            $( "#loadingpage" ).hide();
                            
                            //init();
                };
                
                function FB_connected_callback_select_ttshow_db( data ) {
                }
       </script>
        
        <script type="text/javascript">

                $.init_channel = getParameterByName( "ch" );
                console.log( $.init_channel );
            
                $("document").ready(function() {
                            
                            /*
                            $.ajax({
                                        type    : "POST",
                                        url     : "php/html_list_channel.php",
                                        async   : true ,
                                        data : { 
                                                    cmd :   "list" 
                                        },
                                        data2: {
                                        },
                                        success: function( data )
                                        {
                                                console.log( data );
                                        }
                            });*/

                            $.ajax({
                                        type    : "POST",
                                        url     : "php/html_list_channel.php",
                                        async   : true ,
                                        data : { 
                                                    cmd     :   "select" ,
                                                    data    :  {
                                                                id : $.init_channel
                                                    }
                                        },
                                        success: function( data )
                                        {
                                                console.log( data );
                                                var tmp_data = JSON.parse( data );
                                                console.log( tmp_data );
                                                
                                                /*
                                                $( "#myCarousel .carousel-inner" ).html(
                                                            '<div class="item">' +
                                                                    '<div style="background-size: cover; border: 1px solid rgb(221, 221, 221); padding: 0px; margin-right: 1%; cursor: pointer; position: relative; width: 100%; height: 300px; background-image: url(\"' + tmp_data.ch_cover + '\");" id="cover_photo"></div>' +
                                                            '</div>' 
                                                            );*/
        
                                                $( "#ch_name" ).html( tmp_data.ch_name );
                                                $( "#ch_type" ).html( tmp_data.ch_type );
                                                $( "[id=cover_photo]" ).css( "background-image" , "url(\"" + tmp_data.ch_cover + "\")" );
                                                
                                                $( "#myContent p" ).html( tmp_data.ch_introduce );
                                                $( "#usericon" ).css( "background-image" , "url(\"" + tmp_data.ch_icon + "\")" );
                                                
                                        }
                            });


                            $.ajax({
                                        type: "POST",
                                        url: "php/json_list_channel_sub_click.php",
                                        data: {
                                                    channel_id    : $.init_channel
                                        },
                                        //dataType: "json",
                                        success: function( data )
                                        {
                                                    if( data !== "false" )
                                                    {
                                                                data = JSON.parse( data );
                                                                $( "#day_click" ).html( data.num_click );
                                                                $( "#all_click" ).html( data.num_click );
                                                                $( "#all_follow" ).html( data.subscribe_num );
                                                                $( "#pagecontent" ).show();
                                                    }
                                        }
                            });
                            /*
                            $.ajax({
                                        type: "POST",
                                        url: "php/json_list_author_sub_click.php",
                                        data: {
                                                    user    : "blithe0407@yahoo.com.tw"
                                        },
                                        //dataType: "json",
                                        success: function( data )
                                        {
                                                if( data !== "false" )
                                                {
                                                        data = JSON.parse( data );
                                                        $( "#day_click" ).html( data.num_click );
                                                        $( "#all_click" ).html( data.num_click );
                                                        $( "#all_follow" ).html( data.subscribe_num );
                                                        $( "#pagecontent" ).show();
                                                }
                                        }
                            });*/

                            $.ajax({
                                        type: "POST",
                                        url: "php/category.php?func=list",
                                        data: {
                                        },
                                        //dataType: "json",
                                        success: function( data ) {

                                                    console.log( data );

                                                    var tmp_html = '' ;
                                                    tmp_html += '<hr style="margin: 0px 0px 8px; border: 0.5px solid #e7e6e7;">' ;
                                                    tmp_html += '<button tab_index="" page_type="common" style="border: 1px solid white; background-color: white ! important; color: blue; padding: 0px; font-size: 16px; width: 5%;" type="button" class="btn btn-sm col-xs-3 btn-primary">全部</button>' ;
                                                    $.each( eval(data) , function( index , value ){

                                                                tmp_html += '<button tab_index="' + value.id + '" style="font-size: 15px; border: 1px solid white; width: 5%; background-color: white ! important; color: gray; padding: 0px;" type="button" class="btn btn-sm col-xs-3 btn-primary">' + value.name + '</button>' ;

                                                    });
                                                    
                                                    tmp_html += '<div class="clearfix"></div>' ;
                                                    tmp_html += '<hr style="margin: 6px 0px 0px; border: 0.5px solid #e7e6e7;">' ;
                                                    $( "#tab_1" ).html( tmp_html );
                                                    
                                                    $.page_type = "common" ;
                                                    $( "[page_type]" ).unbind( "click" ).bind( "click", function(e) {
                                                                    $.page_type = $( this ).attr( "page_type" ) ;
                                                                    
                                                                    if( $( "[tab_index][hasselected=1]" ).length == 0 )
                                                                    $( "[tab_index]" ).eq(0).trigger( "click" );
                                                                    else
                                                                    $( "[tab_index][hasselected=1]" ).trigger( "click" );
                                                    });
                                                    
                                                    $( "[tab_index]" ).unbind( "click" ).bind( "click", function(e) {
                                                                    
                                                                    $( "[tab_index]" ).attr( "hasselected" , "0" );
                                                                    $( "[tab_index]" ).css( "color" , "gray" );
                                                                    $( this ).attr( "hasselected" , "1" );
                                                                    $( this ).css( "color" , "blue" );
                                                                    
                                                                    
                                                                    $.nuw_page_num  = 1 ;
                                                                                $.class         = $( this ).attr( "tab_index" ) ;

                                                                    $.ajax({
                                                                                type: "POST",
                                                                                url: "php/json_list_categorypage_channel.php",
                                                                                data: {
                                                                                            user        : "bala.soho.tw@gmail.com" ,
                                                                                            page_num    : "40" ,
                                                                                            page        : $.nuw_page_num ,
                                                                                            class       : $.class ,
                                                                                            channel_id  : $.init_channel ,
                                                                                            page_type   : $.page_type
                                                                                },
                                                                                //dataType: "json",
                                                                                success: function(data) {

                                                                                            if( data !== "false" )
                                                                                            {
                                                                                                    data = JSON.parse( data );
                                                                                                    console.log( data );
                                                                                                    var tmp = "";

                                                                                                    var check_status = "chessboard" ; // $( "#categorypage [create].active" ).attr( "create" );
                                                                                                    if( check_status === "upright" )
                                                                                                        var func = function( a , b ){  return create_upright( a , "col-xs-12 col-sm-6 col-md-6 col-lg-6" ); } ;
                                                                                                    else if( check_status === "list" )
                                                                                                        var func = function( a , b ){  return create_list( a , "col-xs-12 col-sm-12 col-md-12 col-lg-12" , "margin-bottom : 10px;" , false ); } ;
                                                                                                    if( check_status === "chessboard" )
                                                                                                        var func = function( a , b ){  return create_chessboard( a , "col-xs-3 col-sm-3 col-md-3 col-lg-3" ); } ;
                                                                                                        //var func = function( a , b ){  return create_chessboard( a , "col-xs-12 col-sm-6 col-md-6 col-lg-6" ); } ;



                                                                                                    $.each( data , function( index , value ){

                                                                                                            //$.category_data[ $.category_data.length ] = value;
                                                                                                            tmp += func( value );

                                                                                                    });
                                                                                                    $( "#tab_1_content" ).html( tmp );
                                                                                                    
                                                                                                    
                                                                                                    $( "#tab_1_content" ).children( "div" ).unbind( "click" ).bind( "click", function(e) {
                                                                                                                    location.href = "page-inner.php?page_id=" + $( this ).find( "[page]" ).attr( "page" );
                                                                                                    });
                                                                                                    

                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                    $( "#tab_1_content" ).html( "" );
                                                                                                    //$( "#loading_icon" ).css( "visibility" , "hidden" );
                                                                                            }
                                                                                }
                                                                    });
                                                                    
                                                    });
                                                    
                                                    $( "[page_type]" ).eq(0).trigger( "click" );
                                                    // $( "#tab_1" ).children( "[tab_index]" )
                                        }
                            });
                            
                            
                            
                });
                
        </script>

</body>

</html>
