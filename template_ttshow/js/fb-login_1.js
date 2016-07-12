
window.fbAsyncInit = function() {

        $.check_fb_Init = 1;

        if( window.location.host === "ttshow.tw" )
            FB.init({
                //appId      : '825810754167711',
                appId      :'1572469276337336',
                cookie     : true,  // enable cookies to allow the server to access 
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.2' // use version 2.2
            });
        else
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

function statusChangeCallback(response) {
                    console.log('statusChangeCallback');
                    console.log(response);
                    // The response object is returned with a status field that lets the
                    // app know the current login status of the person.
                    // Full docs on the response object can be found in the documentation
                    // for FB.getLoginStatus().
                    if (response.status === 'connected') {
                            // Logged into your app and Facebook.
                            FB_connected_callback( function(response) {
                                          console.log( response );
                                          //document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
                                          $( ".status_login" ).show();
                                          $( "#fa-file-o-icon" ).show();/* jack 20150417 */
                                          
                                          if( typeof FB_connected_callback_init != "undefined" )/* jack */
                                          FB_connected_callback_init( response );
                                          
                                          
                                          $.ajax({
                                                  type: "POST",
                                                  url: "php/member.php?func=loginbyFB",
                                                  data: {
                                                      email : response.email ,
                                                      id    : response.id ,
                                                      name    : response.name
                                                  },
                                                  //dataType: "json",
                                                  success: function(data) {
                                                      //data = JSON.parse( data );
                                                              //usericon  fb_name
                                                      /* ++ abin ++ */
                                                    try {
                                                                var data2 = JSON.parse( data );
                                                                $("#sidebar_usericon").css("background-image","url(" + data2.usericon + ")");
                                                                $("#sidebar_name").html( data2.fb_name );
                                                                if( data2.usertype == "root") {
                                                                }
                                                                else if( data2.usertype == "manage") {
                                                                      //$("#apply_channel").css("display","none");
                                                                      $("[level=root]").remove();
                                                                } else if( data2.usertype == "editor") {
                                                                      //$("#sidebar_1_channel_user_display_none").css("display","none");
                                                                      //$("#apply_channel").css("display","none");
                                                                      $("[level=root]").remove();
                                                                      $("[level=manage]").remove();
                                                                } else if( data2.usertype == "uneditor" || data2.usertype == "" ) {
                                                                      //$("#un_editor").css("display","block");
                                                                      //$("#apply_channel").css("display","none");
                                                                      //$("#modify_account").css("display","none");
                                                                      //$("#sidebar_1_fblogin_display_none").css("display","none");
                                                                      $("[level=root]").remove();
                                                                      $("[level=manage]").remove();
                                                                      $("[level=editor]").remove();
                                                                }
                                                                /*
                                                                else if( data2.usertype == "") {
                                                                        //$("#apply_account a").attr("href" , "apply_account.php?modify_account");
                                                                        //$("#sidebar_setting_icon").css("display","none");
                                                                        //$("#sidebar_1_fblogin_display_none").css("display","none");
                                                                        $("[level=root]").remove();
                                                                        $("[level=manage]").remove();
                                                                        $("[level=editor]").remove();
                                                                }
                                                                */
                                                                if( typeof memeber_connected_callback_init != "undefined" )/* jack */
                                                                memeber_connected_callback_init( data2 );


                                                                console.log(data2);
                                                                var url = window.location.pathname;
                                                                var filename = url.substring(url.lastIndexOf('/')+1);
                                                                /*if( filename.indexOf("index.php") != -1 || filename == "" ) {
                                                                        $("#sidebar").attr("style","margin-top: 0px; position: fixed; z-index: 999; right: 0px; top: 90px;");
                                                                } */
                                                                $( "#sidebar" ).show();
                                                      }
                                                      catch (e) {
                                                              console.log( e );
                                                      }
                                                      if( typeof FB_connected_callback_select_ttshow_db != "undefined" ) {
                                                              FB_connected_callback_select_ttshow_db( data );
                                                      }
                                                      /* -- abin -- */
                                                  }
                                          });
                            } );
                            $( ".status_logout" ).hide();

                    } else if (response.status === 'not_authorized') {
                            // The person is logged into Facebook, but not your app.
                            //document.getElementById('status').innerHTML = 'Please login to this app.';
                            $( ".status_logout" ).show();
                            $( ".status_login" ).hide();
                            $( "#fa-file-o-icon" ).hide();/* jack 20150417 */
                            $( "#sidebar" ).hide();

                            if( typeof FB_unconnected_callback_init != "undefined" ) /* jack */
                            FB_unconnected_callback_init();

                    } else {
                        // The person is not logged into Facebook, so we're not sure if
                        // they are logged into this app or not.
                            //document.getElementById('status').innerHTML = 'Please login to Facebook.';
                            $( ".status_logout" ).show();
                            $( ".status_login" ).hide();
                            $( "#fa-file-o-icon" ).hide();/* jack 20150417 */
                            
                            $( "#sidebar" ).hide();

                            if( typeof FB_unconnected_callback_init != "undefined" ) /* jack */
                            FB_unconnected_callback_init();
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

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/zh_TW/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));


            // Here we run a very simple test of the Graph API after login is
            // successful.  See statusChangeCallback() for when this call is made.
            function FB_connected_callback( cbsuccess ) {
                  console.log('Welcome!  Fetching your information.... ');
                  FB.api('/me', cbsuccess
                  );
            }

            function FB_logout() {

                FB.logout(function(response) {
                        
                        console.log( response );
                        checkLoginState();
                        
                });

            };
            
            function FB_login() {

                FB.login(function(response) {

                        console.log( response );
                        checkLoginState();
                        //http://graph.facebook.com/878626368826404/picture
                }, {
                    scope: 'email', 
                    return_scopes: true
                });

            };


            /*
            function FB_connected_callback_init( cbsuccess , cbfail ) {

                        $.ajax({
                                    type: "POST",
                                    url: "php/html_list_insidepage.php",
                                    data: {
                                                page_num    : "10" ,
                                                page        : $.nuw_page_num ,
                                                sub         : $.now_tabs_name ,
                                                subsub      : "1"
                                    },
                                    //dataType: "json",
                                    success: cbsuccess ,
                                    error: cbfail
                        });

            }*/


$("document").ready(function() {
    
            /*$( "[id=fb-login-button]" ).append(
                        '<fb:login-button class="nav-search" id="FB_login_btn" scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>' + 
                        '<div id="status" style="display: none;"></div>' +
                        //'<button id="FB_logout_btn" class="" type="button" style="display: none;"> 登出 </button>'
			'<button class="navbar-toggle menu-toggler pull-right" type="button" style="display: none; border: 0px none; margin: 9px 0px;" id="FB_logout_btn">' +
                            '<i class="fa fa-sign-out" style="font-size: 13pt;"></i>' +
                        '</button>'
            );*/
            
            $( "body" ).append( '<div id="fb-root" class="fb_reset"></div>' );
    
            // FB login
            $(document).on('click', '.toolbar a[data-target]', function(e) {
                   e.preventDefault();
                   var target = $(this).data('target');
                   $('.widget-box.visible').removeClass('visible');//hide others
                   $(target).addClass('visible');//show target
            });
            
            /*
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
            });*/
            
            $( "#FB_logout_btn" ).unbind( "click" ).bind( "click" , function(){
                    
                    FB_logout();
                    
            });
            
            $( "#FB_login_btn" ).unbind( "click" ).bind( "click" , function(){
                    
                    FB_login();
                    
            });
            
            $( "#fa-file-o-icon" ).unbind( "click" ).bind( "click" , function(){
                    
                    if( $( "#sidebar" ).data( "selected" ) == undefined || $( "#sidebar" ).data( "selected" ) == "0" )
                    {
                                $( "#sidebar" ).data( "selected" , "1" );
                                $( "#sidebar" ).show();
                    }else{
                                $( "#sidebar" ).data( "selected" , "0" );
                                $( "#sidebar" ).hide();
                    }
                    
            });

});



function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}