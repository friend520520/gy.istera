<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>ttshow-收益報表</title>
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

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
		<script src="template/assets/js/html5shiv.js"></script>
		<script src="template/assets/js/respond.js"></script>
		<![endif]-->
		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
               
                
                <!-- design by al -->
                    <style>
                        .panel-body1{
                           padding-left: 10px; 
                           padding-right: 10px;
                        }
                        .panel1{
                           float: left;
                           width: 100%; 
                           margin-bottom: 15px;
                        }
                        .panel1-btn{
                           float: right;
                           padding: 0px 13px; 
                           border-radius: 3px; 
                           background-color: rgb(19, 74, 121) !important;
                           border-color: rgb(19, 74, 121) !important;
                        }
                        .panel1-id{
                           margin-left: 9px; 
                           font-size: 11pt;
                        }
                        .panel1-identity{
                           margin-left: 8px;
                        }
                        .panel1-time{
                           position: absolute; 
                           margin-top: 10px; 
                           left: 70px;
                        }
                        .panel1-time-icon{
                           color: gray; 
                           padding-right: 5px;
                        }
                        .panel1-time span{
                           color: gray;
                        }
                        .panel1-title{
                           font-size: 14pt;
                           letter-spacing: 1px; 
                           margin-top: 5px; 
                           margin-bottom: 0px;
                        }
                        .panel1-time-description{
                           letter-spacing: 1px; 
                           color: gray; 
                           margin-top: 5px; 
                           margin-bottom: 10px;
                        }
                        .panel1-like{
                           float: left;
                            margin-right: 5px
                        }
                        .panel1-view{
                           float: left; 
                           color: gray;
                        }
                        .panel1-icontext{
                           margin-right: 3px;
                        }
                        .panel1-replay{
                           float: left; 
                           margin-left: 5px;
                           color: gray;
                        }
                        .panel1-tag{
                           background-color: gray;
                           color: white;
                           float: right;
                           font-size: 9pt;
                           margin-right: 5px;
                           padding: 1px 2px;
                        }
                        .panel1-firetag{
                           position: absolute; 
                           right: 12px;
                        }
                        
                        
                        
                        .semi-transparent-button {
                            background: none repeat scroll 0 0 rgba(30, 52, 142, 0.6);
                            border-radius: 8px;
                            box-sizing: border-box;
                            color: #fff;
                            display: block;
                            letter-spacing: 1px;
                            margin: 0 auto;
                            max-width: 100px;
                            padding: 8px;
                            text-align: center;
                            text-decoration: none;
                            transition: all 0.3s ease-out 0s;
                            width: 80%;
                        }
                    </style>
	</head>

	<body class="no-skin" >
        <!-- #section:basics/navbar.layout -->
        <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">

            <?php include("sidebar.php"); ?>

            <div class="main-content" style="margin-left: 190px;">

            <div class="main-content-inner" style="background-color: white;">
                <!-- #section:basics/content.breadcrumbs -->
                <div class="page-content">
                  <div class="page-content" id="pagecontent" style="margin-left: 10px; margin-top: 10px;">
                    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11" style="padding-right: 56px">
                      <div class="page-header">
                        <h1>
                          收益報表
                        </h1>
                      </div>
                    </div>
                    <div class="col-md-1 col-lg-1"></div>
                  </div>
                  <div class="col-xs-12 col-sm-3 center">
                    <div>
                      <!-- #section:pages/profile.picture -->
                      <span class="profile-picture">
                        <img id="usericon" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" src="template/assets/avatars/profile-pic.jpg">
                        Empty
                      </span>

                      <!-- /section:pages/profile.picture -->
                      <div class="space-4">
                      </div>

                      <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                        <div class="inline position-relative">
                          <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                            <i class="ace-icon fa fa-circle light-green">
                            </i>
                            &nbsp;
                            <span class="white" id="username">
                              Alex M. Doe
                            </span>
                          </a>

                          <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                            <li class="dropdown-header">
                              Change Status 
                            </li>

                            <li>
                              <a href="#">
                                <i class="ace-icon fa fa-circle green">
                                </i>
                                &nbsp;
                                <span class="green">
                                  Available
                                </span>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <i class="ace-icon fa fa-circle red">
                                </i>
                                &nbsp;
                                <span class="red">
                                  Busy
                                </span>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <i class="ace-icon fa fa-circle grey">
                                </i>
                                &nbsp;
                                <span class="grey">
                                  Invisible
                                </span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="space-6">
                    </div>

                    <!-- #section:pages/profile.contact -->
                    <div class="profile-contact-info">
                      <div class="profile-contact-links align-left">
                        <a href="#" class="btn btn-link">
                          <i class="ace-icon fa fa-plus-circle bigger-120 green">
                          </i>
                          Add as a friend
                        </a>

                        <a href="#" class="btn btn-link">
                          <i class="ace-icon fa fa-envelope bigger-120 pink">
                          </i>
                          Send a message
                        </a>

                        <a href="#" class="btn btn-link">
                          <i class="ace-icon fa fa-globe bigger-125 blue">
                          </i>
                          www.alexdoe.com
                        </a>
                      </div>

                      <div class="space-6">
                      </div>

                      <div class="profile-social-links align-center">
                        <a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
                          <i class="middle ace-icon fa fa-facebook-square fa-2x blue">
                          </i>
                        </a>

                        <a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
                          <i class="middle ace-icon fa fa-twitter-square fa-2x light-blue">
                          </i>
                        </a>

                        <a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
                          <i class="middle ace-icon fa fa-pinterest-square fa-2x red">
                          </i>
                        </a>
                      </div>
                    </div>

                    <!-- /section:pages/profile.contact -->
                    <div class="hr hr12 dotted">
                    </div>

                    <!-- #section:custom/extra.grid -->
                    <div class="clearfix">
                      <div class="grid2">
                        <span id="follows" class="bigger-175 blue">
                          25
                        </span>

                        <br>
                        Followers
                      </div>

                      <div class="grid2">
                        <span id="following" class="bigger-175 blue">
                          12
                        </span>

                        <br>
                        Following
                      </div>
                    </div>

                    <!-- /section:custom/extra.grid -->
                    <div class="hr hr16 dotted">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-9">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="alert alert-block alert-success">
                      <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times">
                        </i>
                      </button>

                      <i class="ace-icon fa fa-check green">
                      </i>

                      Welcome to
                      <strong class="green">
                        Ace
                        <small>
                          (v1.3.3)
                        </small>
                      </strong>
                      ,
                      the lightweight, feature-rich and easy to use admin template.
                    </div>

                    <div class="row">
                      <div class="space-6">
                      </div>

                      <div class="col-sm-7 infobox-container">
                        <!-- #section:pages/dashboard.infobox -->
                        <div class="infobox infobox-green">
                          <div class="infobox-icon">
                            <i class="ace-icon fa fa-comments">
                            </i>
                          </div>

                          <div class="infobox-data">
                            <span class="infobox-data-number" id="comments">
                              32
                            </span>
                            <div class="infobox-content">
                              comments + 2 reviews
                            </div>
                          </div>

                          <!-- #section:pages/dashboard.infobox.stat -->
                          <div class="stat stat-success">
                            8%
                          </div>

                          <!-- /section:pages/dashboard.infobox.stat -->
                        </div>

                        <div class="infobox infobox-blue">
                          <div class="infobox-icon">
                            <i class="ace-icon fa fa-twitter">
                            </i>
                          </div>

                          <div class="infobox-data">
                            <span class="infobox-data-number">
                              11
                            </span>
                            <div class="infobox-content">
                              new followers
                            </div>
                          </div>

                          <div class="badge badge-success">
                            +32%
                            <i class="ace-icon fa fa-arrow-up">
                            </i>
                          </div>
                        </div>

                        <div class="infobox infobox-pink">
                          <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart">
                            </i>
                          </div>

                          <div class="infobox-data">
                            <span class="infobox-data-number">
                              8
                            </span>
                            <div class="infobox-content">
                              new orders
                            </div>
                          </div>
                          <div class="stat stat-important">
                            4%
                          </div>
                        </div>

                        <div class="infobox infobox-red">
                          <div class="infobox-icon">
                            <i class="ace-icon fa fa-flask">
                            </i>
                          </div>

                          <div class="infobox-data">
                            <span class="infobox-data-number">
                              7
                            </span>
                            <div class="infobox-content">
                              experiments
                            </div>
                          </div>
                        </div>

                        <div class="infobox infobox-orange2">
                          <!-- #section:pages/dashboard.infobox.sparkline -->
                          <div class="infobox-chart">
                            <span class="sparkline" data-values="196,128,202,177,154,94,100,170,224">
                              <canvas height="33" width="44" style="display: inline-block; width: 44px; height: 33px; vertical-align: top;">
                              </canvas>
                            </span>
                          </div>

                          <!-- /section:pages/dashboard.infobox.sparkline -->
                          <div class="infobox-data">
                            <span id="pageviews" class="infobox-data-number">
                              6,251
                            </span>
                            <div class="infobox-content">
                              pageviews
                            </div>
                          </div>

                          <div class="badge badge-success">
                            7.2%
                            <i class="ace-icon fa fa-arrow-up">
                            </i>
                          </div>
                        </div>

                        <div class="infobox infobox-blue2">
                          <div class="infobox-progress">
                            <!-- #section:pages/dashboard.infobox.easypiechart -->
                            <div style="height: 46px; width: 46px; line-height: 45px;" class="easy-pie-chart percentage" data-percent="42" data-size="46">
                              <span class="percent">
                                42
                              </span>
                              %
                              <canvas style="height: 46px; width: 46px;" width="110" height="110">
                              </canvas>
                            </div>

                            <!-- /section:pages/dashboard.infobox.easypiechart -->
                          </div>

                          <div class="infobox-data">
                            <span class="infobox-text">
                              traffic used
                            </span>

                            <div class="infobox-content">
                              <span class="bigger-110">
                                ~
                              </span>
                              58GB remaining
                            </div>
                          </div>
                        </div>

                        <!-- /section:pages/dashboard.infobox -->
                        <div class="space-6">
                        </div>

                        <!-- #section:pages/dashboard.infobox.dark -->
                        <div class="infobox infobox-green infobox-small infobox-dark">
                          <div class="infobox-progress">
                            <!-- #section:pages/dashboard.infobox.easypiechart -->
                            <div style="height: 39px; width: 39px; line-height: 38px;" class="easy-pie-chart percentage" data-percent="61" data-size="39">
                              <span class="percent">
                                61
                              </span>
                              %
                              <canvas style="height: 39px; width: 39px;" width="93" height="93">
                              </canvas>
                            </div>

                            <!-- /section:pages/dashboard.infobox.easypiechart -->
                          </div>

                          <div class="infobox-data">
                            <div class="infobox-content">
                              Task
                            </div>
                            <div class="infobox-content">
                              Completion
                            </div>
                          </div>
                        </div>

                        <div class="infobox infobox-blue infobox-small infobox-dark">
                          <!-- #section:pages/dashboard.infobox.sparkline -->
                          <div class="infobox-chart">
                            <span class="sparkline" data-values="3,4,2,3,4,4,2,2">
                              <canvas height="19" width="39" style="display: inline-block; width: 39px; height: 19px; vertical-align: top;">
                              </canvas>
                            </span>
                          </div>

                          <!-- /section:pages/dashboard.infobox.sparkline -->
                          <div class="infobox-data">
                            <div class="infobox-content">
                              Earnings
                            </div>
                            <div class="infobox-content">
                              $32,000
                            </div>
                          </div>
                        </div>

                        <div class="infobox infobox-grey infobox-small infobox-dark">
                          <div class="infobox-icon">
                            <i class="ace-icon fa fa-download">
                            </i>
                          </div>

                          <div class="infobox-data">
                            <div class="infobox-content">
                              Downloads
                            </div>
                            <div class="infobox-content">
                              1,205
                            </div>
                          </div>
                        </div>

                        <!-- /section:pages/dashboard.infobox.dark -->
                      </div>

                      <div class="vspace-12-sm">
                      </div>

                      <div class="col-sm-5">
                        <div class="widget-box">
                          <div class="widget-header widget-header-flat widget-header-small">
                            <h5 class="widget-title">
                              <i class="ace-icon fa fa-signal">
                              </i>
                              Traffic Sources
                            </h5>

                            <div class="widget-toolbar no-border">
                              <div class="inline dropdown-hover">
                                <button class="btn btn-minier btn-primary">
                                  This Week
                                  <i class="ace-icon fa fa-angle-down icon-on-right bigger-110">
                                  </i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                  <li class="active">
                                    <a href="#" class="blue">
                                      <i class="ace-icon fa fa-caret-right bigger-110">
                                        &nbsp;
                                      </i>
                                      This Week
                                    </a>
                                  </li>

                                  <li>
                                    <a href="#">
                                      <i class="ace-icon fa fa-caret-right bigger-110 invisible">
                                        &nbsp;
                                      </i>
                                      Last Week
                                    </a>
                                  </li>

                                  <li>
                                    <a href="#">
                                      <i class="ace-icon fa fa-caret-right bigger-110 invisible">
                                        &nbsp;
                                      </i>
                                      This Month
                                    </a>
                                  </li>

                                  <li>
                                    <a href="#">
                                      <i class="ace-icon fa fa-caret-right bigger-110 invisible">
                                        &nbsp;
                                      </i>
                                      Last Month
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main">
                              <!-- #section:plugins/charts.flotchart -->
                              <div style="width: 90%; min-height: 150px; padding: 0px; position: relative;" id="piechart-placeholder">
                                <canvas height="360" width="655" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 273px; height: 150px;" class="flot-base">
                                </canvas>
                                <div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);" class="flot-text">
                                  <div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;" class="flot-x-axis flot-x1-axis xAxis x1Axis">
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 54px; top: 133px; left: 16px; text-align: center;">
                                      -1.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 54px; top: 133px; left: 76px; text-align: center;">
                                      -0.5
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 54px; top: 133px; left: 137px; text-align: center;">
                                      0.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 54px; top: 133px; left: 197px; text-align: center;">
                                      0.5
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 54px; top: 133px; left: 257px; text-align: center;">
                                      1.0
                                    </div>
                                  </div>
                                  <div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;" class="flot-y-axis flot-y1-axis yAxis y1Axis">
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 121px; left: 2px; text-align: right;">
                                      -1.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 91px; left: 2px; text-align: right;">
                                      -0.5
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 61px; left: 5px; text-align: right;">
                                      0.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 31px; left: 5px; text-align: right;">
                                      0.5
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 5px; text-align: right;">
                                      1.0
                                    </div>
                                  </div>
                                </div>
                                <canvas height="360" width="655" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 273px; height: 150px;" class="flot-overlay">
                                </canvas>
                                <div class="legend">
                                  <div style="position: absolute; width: 90px; height: 110px; top: 23px; right: -21px; background-color: rgb(255, 255, 255); opacity: 0.85;">

                                  </div>
                                  <table style="position:absolute;top:23px;right:-21px;;font-size:smaller;color:#545454">
                                    <tbody>
                                      <tr>
                                        <td class="legendColorBox">
                                          <div style="border:1px solid null;padding:1px">
                                            <div style="width:4px;height:0;border:5px solid #68BC31;overflow:hidden">
                                            </div>
                                          </div>
                                        </td>
                                        <td class="legendLabel">
                                          social networks
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="legendColorBox">
                                          <div style="border:1px solid null;padding:1px">
                                            <div style="width:4px;height:0;border:5px solid #2091CF;overflow:hidden">
                                            </div>
                                          </div>
                                        </td>
                                        <td class="legendLabel">
                                          search engines
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="legendColorBox">
                                          <div style="border:1px solid null;padding:1px">
                                            <div style="width:4px;height:0;border:5px solid #AF4E96;overflow:hidden">
                                            </div>
                                          </div>
                                        </td>
                                        <td class="legendLabel">
                                          ad campaigns
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="legendColorBox">
                                          <div style="border:1px solid null;padding:1px">
                                            <div style="width:4px;height:0;border:5px solid #DA5430;overflow:hidden">
                                            </div>
                                          </div>
                                        </td>
                                        <td class="legendLabel">
                                          direct traffic
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="legendColorBox">
                                          <div style="border:1px solid null;padding:1px">
                                            <div style="width:4px;height:0;border:5px solid #FEE074;overflow:hidden">
                                            </div>
                                          </div>
                                        </td>
                                        <td class="legendLabel">
                                          other
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>

                              <!-- /section:plugins/charts.flotchart -->
                              <div class="hr hr8 hr-double">
                              </div>

                              <div class="clearfix">
                                <!-- #section:custom/extra.grid -->
                                <div class="grid3">
                                  <span class="grey">
                                    <i class="ace-icon fa fa-facebook-square fa-2x blue">
                                    </i>
                                    &nbsp; likes
                                  </span>
                                  <h4 class="bigger pull-right">
                                    1,255
                                  </h4>
                                </div>

                                <div class="grid3">
                                  <span class="grey">
                                    <i class="ace-icon fa fa-twitter-square fa-2x purple">
                                    </i>
                                    &nbsp; tweets
                                  </span>
                                  <h4 class="bigger pull-right">
                                    941
                                  </h4>
                                </div>

                                <div class="grid3">
                                  <span class="grey">
                                    <i class="ace-icon fa fa-pinterest-square fa-2x red">
                                    </i>
                                    &nbsp; pins
                                  </span>
                                  <h4 class="bigger pull-right">
                                    1,050
                                  </h4>
                                </div>

                                <!-- /section:custom/extra.grid -->
                              </div>
                            </div>
                            <!-- /.widget-main -->
                          </div>
                          <!-- /.widget-body -->
                        </div>
                        <!-- /.widget-box -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- #section:custom/extra.hr -->
                    <div class="hr hr32 hr-dotted">
                    </div>

                    <!-- /section:custom/extra.hr -->
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="widget-box transparent">
                          <div class="widget-header widget-header-flat">
                            <h4 class="widget-title lighter">
                              <i class="ace-icon fa fa-star orange">
                              </i>
                              Popular Domains
                            </h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up">
                                </i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main no-padding">
                              <table class="table table-bordered table-striped">
                                <thead class="thin-border-bottom">
                                  <tr>
                                    <th>
                                      <i class="ace-icon fa fa-caret-right blue">
                                      </i>
                                      name
                                    </th>

                                    <th>
                                      <i class="ace-icon fa fa-caret-right blue">
                                      </i>
                                      price
                                    </th>

                                    <th class="hidden-480">
                                      <i class="ace-icon fa fa-caret-right blue">
                                      </i>
                                      status
                                    </th>
                                  </tr>
                                </thead>

                                <tbody>
                                  <tr>
                                    <td>
                                      ttshow.com
                                    </td>

                                    <td>
                                      <small>
                                        <s class="red">
                                          $29.99
                                        </s>
                                      </small>
                                      <b class="green">
                                        $19.99
                                      </b>
                                    </td>

                                    <td class="hidden-480">
                                      <span class="label label-info arrowed-right arrowed-in">
                                        on sale
                                      </span>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      online.com
                                    </td>

                                    <td>
                                      <b class="blue">
                                        $16.45
                                      </b>
                                    </td>

                                    <td class="hidden-480">
                                      <span class="label label-success arrowed-in arrowed-in-right">
                                        approved
                                      </span>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      newnet.com
                                    </td>

                                    <td>
                                      <b class="blue">
                                        $15.00
                                      </b>
                                    </td>

                                    <td class="hidden-480">
                                      <span class="label label-danger arrowed">
                                        pending
                                      </span>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      web.com
                                    </td>

                                    <td>
                                      <small>
                                        <s class="red">
                                          $24.99
                                        </s>
                                      </small>
                                      <b class="green">
                                        $19.95
                                      </b>
                                    </td>

                                    <td class="hidden-480">
                                      <span class="label arrowed">
                                        <s>
                                          out of stock
                                        </s>
                                      </span>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      domain.com
                                    </td>

                                    <td>
                                      <b class="blue">
                                        $12.00
                                      </b>
                                    </td>

                                    <td class="hidden-480">
                                      <span class="label label-warning arrowed arrowed-right">
                                        SOLD
                                      </span>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <!-- /.widget-main -->
                          </div>
                          <!-- /.widget-body -->
                        </div>
                        <!-- /.widget-box -->
                      </div>
                      <!-- /.col -->

                      <div class="col-sm-7">
                        <div class="widget-box transparent">
                          <div class="widget-header widget-header-flat">
                            <h4 class="widget-title lighter">
                              <i class="ace-icon fa fa-signal">
                              </i>
                              Sale Stats
                            </h4>

                            <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up">
                                </i>
                              </a>
                            </div>
                          </div>

                          <div class="widget-body">
                            <div class="widget-main padding-4">
                                <div id="sales-charts">

                                </div>
                              <!--div style="width: 100%; height: 220px; padding: 0px; position: relative;" id="sales-charts">
                                <canvas height="528" width="1111" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 463px; height: 220px;" class="flot-base">
                                </canvas>
                                <div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);" class="flot-text">
                                  <div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;" class="flot-x-axis flot-x1-axis xAxis x1Axis">
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 204px; left: 28px; text-align: center;">
                                      0.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 204px; left: 96px; text-align: center;">
                                      1.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 204px; left: 163px; text-align: center;">
                                      2.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 204px; left: 231px; text-align: center;">
                                      3.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 204px; left: 299px; text-align: center;">
                                      4.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 204px; left: 367px; text-align: center;">
                                      5.0
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 204px; left: 434px; text-align: center;">
                                      6.0
                                    </div>
                                  </div>
                                  <div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;" class="flot-y-axis flot-y1-axis yAxis y1Axis">
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 192px; left: 1px; text-align: right;">
                                      -2.000
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 168px; left: 1px; text-align: right;">
                                      -1.500
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 144px; left: 1px; text-align: right;">
                                      -1.000
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 120px; left: 1px; text-align: right;">
                                      -0.500
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 96px; left: 4px; text-align: right;">
                                      0.000
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 72px; left: 4px; text-align: right;">
                                      0.500
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 48px; left: 4px; text-align: right;">
                                      1.000
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 24px; left: 4px; text-align: right;">
                                      1.500
                                    </div>
                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 4px; text-align: right;">
                                      2.000
                                    </div>
                                  </div>
                                </div>
                                <canvas height="528" width="1111" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 463px; height: 220px;" class="flot-overlay">
                                </canvas>
                                <div class="legend">
                                  <div style="position: absolute; width: 61px; height: 66px; top: 13px; right: 13px; background-color: rgb(255, 255, 255); opacity: 0.85;">

                                  </div>
                                  <table style="position:absolute;top:13px;right:13px;;font-size:smaller;color:#545454">
                                    <tbody>
                                      <tr>
                                        <td class="legendColorBox">
                                          <div style="border:1px solid #ccc;padding:1px">
                                            <div style="width:4px;height:0;border:5px solid rgb(237,194,64);overflow:hidden">
                                            </div>
                                          </div>
                                        </td>
                                        <td class="legendLabel">
                                          Domains
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="legendColorBox">
                                          <div style="border:1px solid #ccc;padding:1px">
                                            <div style="width:4px;height:0;border:5px solid rgb(175,216,248);overflow:hidden">
                                            </div>
                                          </div>
                                        </td>
                                        <td class="legendLabel">
                                          Hosting
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="legendColorBox">
                                          <div style="border:1px solid #ccc;padding:1px">
                                            <div style="width:4px;height:0;border:5px solid rgb(203,75,75);overflow:hidden">
                                            </div>
                                          </div>
                                        </td>
                                        <td class="legendLabel">
                                          Services
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div-->
                            </div>
                            <!-- /.widget-main -->
                          </div>
                          <!-- /.widget-body -->
                        </div>
                        <!-- /.widget-box -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="hr hr32 hr-dotted">
                    </div>

                    <!-- /.row -->

                    <!-- PAGE CONTENT ENDS -->
                  </div>
                </div>
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
        </div>

        
        <!-- /.main-content -->
  
  
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
                    </i>
        </a>
        
        </div>

        
        <script src="js/highcharts.js"></script>

        <script src="js/V_line.js"></script>
        
        <!-- <![endif]-->

        <!--[if IE]>
    <script type="text/javascript">
     window.jQuery || document.write("<script src='template/assets/js/jquery1x.js'>"+"<"+"/script>");
    </script>
    <![endif]-->
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
        
        
        <!-- init       : null -->
        <!-- callback   : FB_connected_callback_init( response ) -->
        <script src="js/fb-login.js"></script>
        
        <style>
                    
                    /* <div style="background-image:url('img/global/folder.png');"></div> */
                    .pagebg {
                                background-position: 50% 0%;
                                background-size: cover;
                                height: 94%;
                                margin-left: 0%;
                                margin-top: 3%;
                                /*position: absolute;*/
                                width: 94%;
                    }
            
        </style>

        <script type="text/javascript">


                
                $("document").ready(function() {
                        
                        $( "#loadingpage" ).hide();
                        
                        $.cash = $( "body" );
                        $.cash.V_line();
                        $.cash.V_line().init();
                        
                });
                
                function getbody( success , fail ) {
                    
                    $.ajax({
                                type: "POST",
                                url: "php/json_list_earnings.php",
                                data: {
                                            user        : $.member.email
                                            /*subsub      : "1"*/
                                },
                                //dataType: "json",
                                success: success ,
                                error: fail
                    });
                    
                }
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            $( "#main-container" ).show();
                            
                            getbody( function(data) {
                                        
                                        if( data == "false" )
                                        {
                                                $( "#pagecontent" ).hide();
                                        }
                                        else
                                        {
                                                data = JSON.parse( data );
                                                
                                                $( "#username" ).html( data.username );
                                                $( "#usericon" ).html( data.usericon );
                                                $( "#follows" ).html( data.follows );
                                                $( "#following" ).html( data.following );
                                                $( "#comments" ).html( data.comments );
                                                $( "#pageviews" ).html( data.pageviews );
                                                
                                                $( "#pagecontent" ).show();
                                                
                                        }
                                        
                            } , function(data) {



                            } );
                            
                };
                
                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };
                            
                            $( "#main-container" ).hide();
                            Login_Popup_show();
                            
                };

                function unlogin_jump()
                {
                            location.href = "index.php";
                }

        </script>

</body>

</html>
