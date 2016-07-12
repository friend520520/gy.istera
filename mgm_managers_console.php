<?php header("X-Frame-Options: DENY");?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale = 1.0, user-scalable = 0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="app-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="apple-touch-fullscreen" content="yes" />
        <link rel='shortcut icon' href='template/images/favicon.ico' type='x-icon'>
                    <title>管理者控制台首頁 | Funbook19.com</title>
                    <meta name="description" content="What you see what you get Enjoy to Interactive with living objects">
	
        <link rel='shortcut icon' href='favicon.ico' type='x-icon'>
        <!--link href="template/css/style.css" rel="stylesheet" type="text/css">
        <link href="template/css/owl.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="template_ttshow/template/assets/css/bootstrap.css">
        <link rel="stylesheet" href="template_ttshow/template/assets/css/font-awesome.css">
        <link rel="stylesheet" href="template_ttshow/template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style"-->

        <link rel="stylesheet" href="template_help_j/css/all.css">
        <link href="template_help_j/template/css/mian.css" rel="stylesheet" type="text/css">
        <link href="template_help_j/template/css/info.css" rel="stylesheet" type="text/css">
        <link href="template_help_j/css/login.css" rel="stylesheet" type="text/css">
        <link href="template_help_j/css/bootstrap_al.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="http://www.ggyyggy.com/funbook19/template_ttshow/template/assets/css/font-awesome.css">

        <!-- jquery.dataTables -->
        <link rel="stylesheet" type="text/css" href="template_help_j/css/jquery.dataTables.css">

        <!--?php include( "js/all_js_h.php"); ?-->
        <?php include( "js/all_js.php"); ?>

        <script>
                $("document").ready(function() {

                        $("#mc").css({
                                color: "#2F8DCD"
                        });

                });
        </script>
                <script src="js/jquery.pagination.js"></script>
                <script src="js/arod/management_account.jquery.pagination.js"></script>
        <!--script src="js/search.js"></script-->
        <script src="js/batch.js"></script>

        <!-- include HIGHCHARTS-->
        <script src="js/highstock.js"></script>
        <script src="js/mgm_highchart_jack.js"></script>
        <script src="js/mgm_hichart_click_jack.js"></script>
        <!-- for arod edit function (點擊折線圖的點會呼叫的fun)-->

        <!-- datePicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!-- jquery.dataTables -->
        <!--link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"-->
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="js/dataTablesPlugin.js"></script>

        <script>
                    $("document").ready(function() {
                            init();
                    });

                    function init(){
                            vm_vacant();
                            fn_count_vip_normal_account();
                            fn_count_vip_total_revenue();
                    }

                    $(function () {
                       $("#mc").css({  
                          color: "#0de1eb"
                        });  
                       $("#bk_hide").hide();  
                    });

                    function vm_vacant(){

                            var success_callback = function(data) {
                                console.log(data);
                                $("#used_rate").html(data.used_rate);
                                $("#useful").html(data.useful);
                            }

                            $.ajax({
                                    type : "POST" ,
                                    dataType: "json",
                                    url : "php/hd.php",
                                    async: true ,
                                    data : {
                                    } ,
                                    success : success_callback ,
                                    error : function(e) {console.log(e)}
                            });

                    }

                    function fn_count_vip_normal_account() {

                            var data = {
                                    token: getCookie("funbook_cookie")
                            };
                            var success_back = function(data) {

                                    console.log(data);
                                    var tmp = "";
                                    data = JSON.parse(data);
                                    console.log(data);
                                    if (data.success) {
                                            $("#vip_account").html(data.data_vip_account);
                                            $("#account").html(data.data_account);
                                    } else {
                                            show_remind( data.msg , "error" );
                                    }

                            };
                            var error_back = function(data) {
                                    console.log(data);
                            };
                            $.Ajax("POST", "php/json_mgm_managers_console.php?func=fn_count_vip_normal_account", data, "", success_back, error_back);

                    }

                    function fn_count_vip_total_revenue() {

                            var data = {
                                    token: getCookie("funbook_cookie")
                            };
                            var success_back = function(data) {

                                    console.log(data);
                                    var tmp = "";
                                    data = JSON.parse(data);
                                    console.log(data);
                                    if (data.success) {
                                            $("#revenue").html(data.data);
                                    } else {
                                            show_remind( data.msg , "error" );
                                    }

                            };
                            var error_back = function(data) {
                                    console.log(data);
                            };
                            $.Ajax("POST", "php/json_mgm_managers_console.php?func=fn_count_vip_total_revenue", data, "", success_back, error_back);

                    }
                </script>

        </head>

    <body>

        <?php include( "template_help_j/html/loading.php"); ?>
        <?php include( "html/header.php"); ?>

        <div id="container" class="container_bk">
                    <?php include( "template_help_j/html/sidebar_setting.php"); ?>

                        <div class="main-content">                        
				<div class="path">
	                                <a href="#">首頁</a> &gt; <a href="#">管理者控制台首頁</a>
                        </div>

                                <!--sample code-->
                                <div class="padding-content">

                                        <div class="col-lg-12 infobox-container" style="margin-top: 20px;">

                                                <div class="infobox infobox-blue">

                                                        <div class="infobox-data">
                                                                <div class="infobox-content">目前金流總金額</div>
                                                                <span class="infobox-data-number" id="revenue"></span>
                                                        </div>

                                                        <!--div class="badge badge-success">
                                                                +32%
                                                                <i class="ace-icon fa fa-arrow-up"></i>
                                                        </div-->
                                                </div>

                                                <div class="infobox infobox-blue">

                                                        <div class="infobox-data">
                                                                <div class="infobox-content">一般會員總數</div>
                                                                <span class="infobox-data-number" id="account"></span>
                                                        </div>

                                                        <!--div class="badge badge-success">
                                                                +32%
                                                                <i class="ace-icon fa fa-arrow-up"></i>
                                                        </div-->
                                                </div>

                                                <div class="infobox infobox-pink">

                                                        <div class="infobox-data">
                                                                <div class="infobox-content">VIP 會員總數</div>
                                                                <span class="infobox-data-number" id="vip_account"></span>
                                                        </div>
                                                        <!--div class="stat stat-success">8%</div-->
                                                </div>

                                                <div class="infobox infobox-blue2">

                                                        <div class="infobox-data">
                                                                <span class="infobox-text">空間使用率</span>

                                                                <div class="infobox-content">
                                                                        <span class="percent" id="used_rate"></span>%
                                                                        ~
                                                                        <span class="bigger-110" id="useful"></span>
                                                                        GB remaining
                                                                </div>
                                                        </div>
                                                </div>

                                                <!-- /section:pages/dashboard.infobox -->
                                                <div class="space-6"></div>

                                        </div>


                                </div>
                        </div>
        </div>
        <!-- footer -->
        <?php include( "template_help_j/html/footer.php"); ?>
        
    </body>

</html>
