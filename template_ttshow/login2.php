<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                <title>Login Page - Ace Admin</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">

                <meta name="description" content="User login page" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

                <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->
                <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
                <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                
                <script src="template/assets/js/jquery.js"></script>
                <script src="js/device.js"></script>
                <script src="js/create.js"></script>
                <script src="js/md5.js"></script>
                
                <script type="text/javascript">
                        if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
                </script>
                <script src="template/assets/js/bootstrap.js"></script>

                <!-- page specific plugin scripts -->
                <script src="template/assets/js/jquery-ui.js"></script>
                <script src="template/assets/js/jquery.ui.touch-punch.js"></script>
                
                <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
                <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->
        </head>

	<body class="login-layout">
		<div class="modal fade in remodal-overlay" id="myModalLogin" style="" aria-hidden="false">
                    <!--div class="modal-backdrop fade in" style="height: 665px;"></div-->
                        <div class="modal-dialog modal-l remodal">
                                <div class="modal-content">
                                        <div style="padding: 50px 25px;" class="modal-body">

                                                <!--button type="button" class="close" data-dismiss="modal" style="position: absolute; right: 15px; top: 10px; margin: 0px; font-size: 55px;">
                                                            <span aria-hidden="true">×</span>
                                                </button>

                                                <!--h4 style="font-weight: bold; font-size: 18px; margin-top: 10px;" class="modal-title">登入</h4-->
                                                <img class="close" src="images/x-black.png" style="position: absolute; opacity: 1; right: 5px; top: 5px; margin: 0px; height: 20px;" data-dismiss="modal">
                                                <!--button style="position: absolute; right: 10px; top: 0px; margin: 0px; font-size: 55px;" data-dismiss="modal" class="close" type="button">
                                                    <span aria-hidden="true">×</span>
                                                </button-->
                                                <h4 class="modal-title" style="font-size: 25px;">登入</h4>

                                                <div id="FB_login_btn" class="" style="background: rgb(24, 74, 117) none repeat scroll 0% 0%; text-align: center; left: 0px; right: 0px; position: relative; border-radius: 6px; cursor: pointer; margin: 25px 0px; height: 50px;">
                                                            <h3 style="color: white; text-align: center; margin: 0px; line-height: 50px; font-size: 18px;">
                                                                        使用facebook帳號登入
                                                            </h3>
                                                </div>
                                                <div style="text-align: center">
                                                            <span style="position: absolute; right: 0px; left: 0px; background-color: white; margin: 10px auto; font-size: 20px; color: lightgray; width: 50px;">或</span>
                                                            <hr style="float: left; width: 100%;">
                                                </div>

                                                <span style="float: right; font-size: 12px; margin-bottom: 20px;">沒有帳號？<a href="signup_gen.php?signup=general" style="color: #337ab7">立即註冊</a></span>

                                                <div style="width: 100%" class="input-group">
                                                            <span style="text-align: center; font-size: 17px; margin: 10px; color: gray; line-height: 34px;">E-mail</span>
                                                            <input id="general_login_btn1" type="text" style="width: 85%; display: inline; float: right;" class="form-control" placeholder="">
                                                </div>
                                                <br>
                                                <div style="width: 100%" class="input-group">
                                                            <span style="text-align: center; font-size: 17px; margin: 10px; color: gray; line-height: 34px;">密碼</span>
                                                            <input id="general_login_btn2" type="password" style="width: 85%; display: inline; float: right;" class="form-control" placeholder="">
                                                </div>
                                                <br>
                                                <div id="general_login_btn" class="col-xs-6 col-sm-3" style="height: 45px; cursor: pointer; text-align: center; border: 2px solid white; border-radius: 6px; float: right; background: rgb(24, 74, 117) none repeat scroll 0px 0px;">
                                                        <h3 style="color: white; text-align: center; font-size: 17px; margin: 10px;">登入</h3>
                                                </div>
                                                <a href="forget.php">
                                                    <div style="height: 45px; float: right; cursor: pointer; border-radius: 6px; border: 2px solid white; text-align: center;" class="col-xs-6 col-sm-3">
                                                            <h3 style="text-align: center; color: black; font-size: 17px; margin: 10px;">忘記密碼</h3>
                                                    </div>
                                                </a>

                                                <div class="clearfix"></div>

                                                <script>
                                                        $( "#general_login_btn" ).bind( "click" , function(){

                                                                    if( $( "#general_login_btn1" ).val() == "" )
                                                                    {
                                                                                alert( "輸入帳號" );
                                                                    }
                                                                    else if( $( "#general_login_btn2" ).val() == "" )
                                                                    {
                                                                                alert( "輸入密碼" );
                                                                    }
                                                                    else
                                                                    {
                                                                                $.ajax({
                                                                                            type    : "POST",
                                                                                            url     : "php/member.php?func=login",
                                                                                            data: {
                                                                                                        email    : $( "#general_login_btn1" ).val() ,
                                                                                                        password : md5($( "#general_login_btn2" ).val())
                                                                                            },
                                                                                            success: function(data) {
                                                                                                        console.log(data);
                                                                                                        if( data !== "false" )
                                                                                                        {
                                                                                                                    setCookie("ttshow", data);
                                                                                                                    $( "#myModalLogin" ).modal( "hide" );
                                                                                                                    check_login();
                                                                                                        }else{
                                                                                                                    alert( "帳號密碼錯誤" );
                                                                                                        }
                                                                                            }
                                                                                });

                                                                    }

                                                        });

                                                        $('#myModalLogin')
                                                        .on('show.bs.modal', function (e) {
                                                                    console.log(123);

                                                        })
                                                        .on('hidden.bs.modal', function (e) {
                                                                    if( !getCookie("ttshow") && typeof unlogin_jump != "undefined" )
                                                                        unlogin_jump();
                                                        });

                                                </script>
                                        </div>
                                </div>
                        </div>
                </div>

                <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>

		<script type="text/javascript">
                        $("document").ready(function() {
                                
                                $( "#myModalLogin" ).modal("show");
                                $(".modal-backdrop").unbind( "click" );
                                
                        });
                        
                        function FB_connected_callback_init( response )
                        {
                                    location.href = "index.php";
                        };

                        function FB_unconnected_callback_init()
                        {
                                    
                        };
                        
                        
		</script>
                <script src="js/fb-login.js"></script>
	
            </body>
</html>
