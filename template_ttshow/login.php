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

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->

        <!-- ace styles -->
        <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

        <script src="template/assets/js/jquery.js"></script>
        <script src="template/assets/js/ace-extra.js"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
		<script src="template/assets/js/html5shiv.js"></script>
		<script src="template/assets/js/respond.js"></script>
		<![endif]-->

        <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />

</head>

	<body class="login-layout">
	        <!-- #section:basics/navbar.layout -->
	        <div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>
		
        	<?php include( "header_1.php"); ?>
        

		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">Ace</span>
									<span class="white" id="id-text2">Application</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; Company Name</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Remember Me</span>
														</label>

														<button type="button" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												<span class="bigger-110">Or Login Using</span>
											</div>

											<div class="space-6"></div>
                                                                                        
                                                                                        <fb:login-button id="FB_login_btn" scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
                                                                                        <div id="status"></div>
                                                                                        
											<div class="social-login center">
												<a class="btn btn-primary">
													<i class="ace-icon fa fa-facebook"></i>
												</a>

												<a class="btn btn-info">
													<i class="ace-icon fa fa-twitter"></i>
												</a>

												<a class="btn btn-danger">
													<i class="ace-icon fa fa-google-plus"></i>
												</a>
											</div>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													I want to register
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>

											<div class="space-6"></div>
											<p> Enter your details to begin: </p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Repeat password" />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" class="ace" />
														<span class="lbl">
															I accept the
															<a href="#">User Agreement</a>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Reset</span>
														</button>

														<button type="button" class="width-65 pull-right btn btn-sm btn-success">
															<span class="bigger-110">Register</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->

							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
                </div>
		

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

		<!-- ace scripts --
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
		<script src="template/assets/js/ace/ace.widget-box.js"></script>
		<script src="template/assets/js/ace/ace.settings.js"></script>
		<script src="template/assets/js/ace/ace.settings-rtl.js"></script>
		<script src="template/assets/js/ace/ace.settings-skin.js"></script>
		<script src="template/assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="template/assets/js/ace/ace.searchbox-autocomplete.js"></script-->

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
                            
				//jquery tabs
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

		<script type="text/javascript">
                $("document").ready(function() {
			
                        $( "#loadingpage" ).hide();
                        

                        // FB login
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
                         
			//you don't need this, just used for changing background
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 

                });

                        //////////fb api
                        
                        function statusChangeCallback(response) {
                            console.log('statusChangeCallback');
                            console.log(response);
                            // The response object is returned with a status field that lets the
                            // app know the current login status of the person.
                            // Full docs on the response object can be found in the documentation
                            // for FB.getLoginStatus().
                            if (response.status === 'connected') {
                              // Logged into your app and Facebook.
                                testAPI();
                                $( "#FB_login_btn" ).hide();
                            } else if (response.status === 'not_authorized') {
                              // The person is logged into Facebook, but not your app.
                                document.getElementById('status').innerHTML = 'Please login to this app.';
                                $( "#FB_login_btn" ).show();
                            } else {
                              // The person is not logged into Facebook, so we're not sure if
                              // they are logged into this app or not.
                                document.getElementById('status').innerHTML = 'Please login to Facebook.';
                                $( "#FB_login_btn" ).show();
                            }
                        }

                        // This function is called when someone finishes with the Login
                        // Button.  See the onlogin handler attached to it in the sample
                        // code below.
                        function checkLoginState() {
                            FB.getLoginStatus(function(response) {
                              statusChangeCallback(response);
                            });
                        }

                        window.fbAsyncInit = function() {
                            
                            FB.init({
                                appId      : '790908150987982',
                                cookie     : true,  // enable cookies to allow the server to access 
                                                    // the session
                                xfbml      : true,  // parse social plugins on this page
                                version    : 'v2.2' // use version 2.2
                            });

                              // Now that we've initialized the JavaScript SDK, we call 
                              // FB.getLoginStatus().  This function gets the state of the
                              // person visiting this page and can return one of three states to
                              // the callback you provide.  They can be:
                              //
                              // 1. Logged into your app ('connected')
                              // 2. Logged into Facebook, but not your app ('not_authorized')
                              // 3. Not logged into Facebook and can't tell if they are logged into
                              //    your app or not.
                              //
                              // These three cases are handled in the callback function.

                              FB.getLoginStatus(function(response) {
                                statusChangeCallback(response);
                              });

                        };
                        
                        (function(d, s, id){
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) {return;}
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/en_US/sdk.js";
                            fjs.parentNode.insertBefore(js, fjs);
                          }(document, 'script', 'facebook-jssdk'));
                        

                        // Here we run a very simple test of the Graph API after login is
                        // successful.  See statusChangeCallback() for when this call is made.
                        function testAPI() {
                              console.log('Welcome!  Fetching your information.... ');
                              FB.api('/me', function(response) {
                                    console.log( response );
                                    document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
                                    $.ajax({
                                            type: "POST",
                                            url: "php/member.php?func=loginbyFB",
                                            data: {
                                                email : response.email ,
                                                id    : response.id ,
                                                name    : response.name ,
                                                updated_time    : response.updated_time
                                            },
                                            //dataType: "json",
                                            success: function(data) {
                                                        //data = JSON.parse( data );
                                                        console.log(data);
                                                        if (data !== "false") {
                                                                    setCookie("SocialStreaming", data);
                                                                    location.href = "socialstreaming/api-samples-master/php/login.php";
                                                        }
                                                        else
                                                        {

                                                        }
                                            }
                                    });
                              });
                        }

                        function FB_logout() {

                            FB.logout(function(response) {
                                // Person is now logged out
                            });

                        };
                        
                        
		</script>
	
                </body>
</html>
