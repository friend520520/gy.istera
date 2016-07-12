//////////fb api

window.fbAsyncInit = function() {

    $.check_fb_Init = 1;

    if( window.location.host === "www.ooxxoox.com" ) {
        FB.init({
                appId      : '790908150987982',
                cookie     : true,  // enable cookies to allow the server to access 
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.2' // use version 2.2
        });
    }
    else {
        FB.init({
            //appId      : '825810754167711',
            appId      :'1572469276337336',
            cookie     : true,  // enable cookies to allow the server to access 
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.2' // use version 2.2
        });
    }
        
        

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

        check_login();

};

function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    
    
    if (response.status === 'connected') {
            // Logged into your app and Facebook.
              FB_connected_callback( function(response) {
                            
                            console.log( "123" );
                            console.log( response );
                            
                            if( typeof facebook_data_connected_callback_init != "undefined" )/* jack */
                                    facebook_data_connected_callback_init( response );
                            
                            if( location.search !== "?signup=fb" )
                            {
                                
                                console.log( response + " " + $.click_FB_login );
                                if( $.click_FB_login )
                                {
                                        
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
                                                    
                                                    console.log( data );
                                                    //data = JSON.parse( data );
                                                    if( data !== "false" )
                                                    {
                                                            if( data === "first" )
                                                            {
                                                                location.href = "signup_1.php?signup=fb";
                                                            }
                                                            else
                                                            {
                                                                setCookie("ttshow", data);
                                                                
                                                                if( typeof Login_Popup_hide != "undefined" )
                                                                Login_Popup_hide();
                                                                
                                                                var data2 = JSON.parse( data );
                                                                check_login();

                                                                if( typeof memeber_connected_callback_init != "undefined" )/* jack */
                                                                memeber_connected_callback_init( data2 );
                                                            }
                                                    }

                                                }
                                        });
                                        
                                }
                                
                            
                            }
                            
              } );
    } else if (response.status === 'not_authorized') {
        

    } else {
        
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

            }, {
                scope: 'email', 
                return_scopes: true
            });

};


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
                    
                    //FB_logout();
                    delete_cookie( "ttshow" );
                    check_login();
                    
            });
            
            $( "[id=FB_login_btn]" ).unbind( "click" ).bind( "click" , function(){
                    
                    $.click_FB_login = 1;
                    FB_login();
                    
            });
            
            
            
});

function check_login() {
    
    console.log( getCookie("ttshow") );
    
    if( location.search === "?signup=fb" )
    {
            checkLoginState();
    }
    else if( getCookie("ttshow") )
    {
            console.log( getCookie("ttshow") );
            //document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
            $( ".status_login" ).css( "display" , "" );
            $( ".status_logout" ).hide();
            
            var data = JSON.parse( getCookie("ttshow") );
            
            console.log( data );
            display_sidebar( data );
            
            if( data.facebook_mail ) {
                data = { func : "loginbyFB" , email : data.facebook_mail };
            }
            else {
                data = { func : "login_update" , email : data.email };
            }
            
            $.ajax({
                    type: "POST",
                    url: "php/member.php",
                    data: data,
                    //dataType: "json",
                    success: function(data) {
                        //data = JSON.parse( data );
                        if( data !== "false" )
                        {
                                console.log( data );
                                setCookie("ttshow", data);
                                var data2 = JSON.parse( data );
                                
                                console.log( "data2 = " + data2 );
                                $( "#header_user_icon" ).css( "background-image" , "url('" + data2.usericon + "')" );
                                $( "#header_user_name" ).html( data2.user_name );
                                
                                if( typeof FB_connected_callback_init != "undefined" )
                                    FB_connected_callback_init( data2 );
                                
                                if( typeof memeber_connected_callback_init != "undefined" )/* jack */
                                memeber_connected_callback_init( data2 );
                        }

                    }
            });
            
    }
    else
    {
            $( ".status_logout" ).css( "display" , "" );
            $( ".status_login" ).hide();
            if( typeof FB_unconnected_callback_init != "undefined" )
                FB_unconnected_callback_init();
    }
    
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
   var name = cname + "=";
   var ca = document.cookie.split(';');
   for(var i=0; i<ca.length; i++) {
       var c = ca[i];
       while (c.charAt(0)==' ') c = c.substring(1);
       if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
   }
   return "";
}

function delete_cookie( name, path, domain ) {
   if( getCookie( name ) ) {
     document.cookie = name + "=" +
       ((path) ? ";path="+path:"")+
       ((domain)?";domain="+domain:"") +
       ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
   }
}







function display_sidebar( data ) {
        console.log( data );
        $("#sidebar_usericon").css("background-image","url(" + data.usericon + ")");
        $("#sidebar_name").html( data.user_name );
        console.log( data.usertype );
        if( data.usertype == "root" || data.usertype == "boss" ) {
        }
        else if( data.usertype == "manage") {
              $("[level=root]").remove();
        } else if( data.usertype == "editor") {
              $("[level=root]").remove();
              $("[level=manage]").remove();
        } else if( data.usertype == "uneditor" || data.usertype == "" ) {
              $("[level=root]").remove();
              $("[level=manage]").remove();
              $("[level=editor]").remove();
        }

        $( "#sidebar" ).css( "display" , "" );
}