
$("document").ready(function() {
    
        if( typeof init_connect_callback != "undefined" )
                init_connect_callback();
        
        //check_login();
        check_remember();
	//大版登入登出切換
	$('.top ul li.login #login-block input.button:not(".button-g")').bind( "click" , function(e) {
                
                var bool = true;
                if( !$('.top ul li.login #login-block input[type=email]').val() ){ bool = false;}
                if( !$('.top ul li.login #login-block input[type=password]').val() ){bool = false;}

                if( bool ) 
                {
                    loading_ajax_show();
                    login_func( $('.top ul li.login #login-block input[type=email]').val() , 
                                $('.top ul li.login #login-block input[type=password]').val()  );
                                
                }
                else {
                    show_remind( "請輸入完畢" , "error" );
                }
        });
        
	$('#login-block input.button-g').bind( "click" , function(e) {
                
                var pos = $( this ).parents( "#login-block" );
                pos.find('input[type=email]').val( 'jack' );
                pos.find('input[type=password]').val( 'jack' );
                
                /*
                var pos = $( this ).parents( "#login-block" );
                pos.find('input[type=email]').val( 'help.test@gmail.com' );
                pos.find('input[type=password]').val( 'help' );
                pos.find('[id=remember_account]')[0].checked = true ;
                var data = {};
                var success_back = function( data ) {
                        pos.find('input[type=captcha]').val( data );
                }
                var error_back = function( data ) {
                        console.log(data);
                }
                $.Ajax( "GET" , "php/verification_g.php" , data , "" , success_back , error_back);
                */
        });
        
        $('.top ul li.login #logout-block .logout').click(function(e) {
                logout_func();
        });
	//小版登入登出切換
	$('#mobi-member #login-block input.button:not(".button-g")').click(function(e) {
                var bool = true;
                if( !$('#mobi-member #login-block input[type=email]').val() ){ bool = false;}
                if( !$('#mobi-member #login-block input[type=password]').val() ){bool = false;}
                if( !$('#mobi-member #login-block input[type=captcha]').val() ){bool = false;}
                
                if( bool ) {
                    loading_ajax_show();
                    login_func( $('#mobi-member #login-block input[type=email]').val() , 
                                $('#mobi-member #login-block input[type=password]').val() , 
                                $('#mobi-member #login-block input[type=captcha]').val() ,
                                $('#mobi-member #login-block [id=remember_account]').is( ":checked" ));
                }
                else {
                    show_remind( "請輸入完畢" , "error" );
                }
        });
	
	$('#mobi-member #logout-block .logout').click(function(e) {
                    logout_func();
        });
         
});

function re_captcha() {
        $( ".captcha img" ).attr( "src" , "php/verification.php?" + Math.random() );
}

function check_login() {
    
    if( window.Web2App ) {
            
            window.Web2App.get_cookie( "istera_cookie" );
            
    }
    else if ( getCookie("istera_cookie") ) {
            
            get_cookie_cb( getCookie("istera_cookie") );
            
    }
    else
    {
            logout_layout();
            if( typeof unconnected_callback != "undefined" )
                unconnected_callback();
    }
    
}

function check_remember() {
    
    if ( localStorage.getItem( "funbook19_account" ) ) {
            
            $( "#login-block [type=email]" ).val( localStorage.getItem( "funbook19_account" ) );
            $( "#login-block [type=password]" ).val( localStorage.getItem( "funbook19_password" ) );
            $.each( $( "[id=remember_account]" ) , function( index , value ){
                    if( !$( value ).is( ":checked" ) ) {
                        $( value ).click();
                    }
            });
            
    }
    
}

function get_cookie_cb( callback ) {
    
    $.istera_cookie = callback;
    if( $.istera_cookie !== null && $.istera_cookie !== "" ) {
            
            login_layout();
            
            // $( "[id=sidebar_usericon]" ).css( "background-image" , "url('" + data.data.a_icon + "')" );
            $( "#header .login > a" ).html( $.loginmsg.UserId );

            connected_callback( $.loginmsg );
            
                            /*
            var success_back = function( data ) {
                
                    data = JSON.parse( data );
                    console.log(data);
                    if( data.Success ) {
                            login_layout();

                            $( "[id=sidebar_usericon]" ).css( "background-image" , "url('" + data.data.a_icon + "')" );
                            $( "#header .login > a" ).html( data.data.a_email );

                            if( typeof connected_callback != "undefined" )
                                connected_callback( data.data );
                    }
                    else {

                            show_remind( data.ErrMsg , "error" );
                            delete_cookie( "istera_cookie" , "/" , ".ggyyggy.com" );
                            logout_layout();
                            if( typeof unconnected_callback != "undefined" )
                                unconnected_callback();

                    }
                
            };
            var error_back = function( data ) {
                    console.log( data );
            };

            $.Ajax( "POST" , "php/member.php" , { func : "loginbytoken" , token : $.istera_cookie } , "" , success_back , error_back);
            */
    }
    else {
            delete_cookie( "istera_cookie" , "/" , ".ggyyggy.com" );
            logout_layout();
            if( typeof unconnected_callback != "undefined" )
                unconnected_callback();
    }
    
}

function login_func( account , password  ) {
        
        
        $.ajax({
                type: 'POST',
                url: website_ws_url + 'api/login',
                dataType: "json",
                data: {
                        UserId:      account ,
                        Password:   password // md5( password ) 
                },
                async: false,
                success: function(data) {

                        // data = JSON.parse( data );
                        console.log(data);
                        loading_ajax_hide();
                        if( data.Success ) {
                                    $.loginmsg = data.Data ;
                                    setCookie("istera_cookie", data.Data.Token , "", "/", ".ggyyggy.com");
                                    check_login();
                        }
                        else {
                                    show_remind( data.ErrMsg , "error" );
                                    $( ".captcha img" ).attr( "src" , "php/verification.php?" + Math.random() );
                                    if( data.action ){
                                        console.log( $( "#alert-msg" ) );
                                        $( "#alert-msg" ).show();
                                    }
                        }
                        
                }
        });
        
        
        /*
        var data = {
                    account:      account ,
                    password:   md5( password ) ,
                    authentication: authentication ,
                    login_time: login_time
        };
        var success_back = function( data ) {

                data = JSON.parse( data );
                console.log(data);
                loading_ajax_hide();
                if( data.Success ) {
                    setCookie("istera_cookie", data.data, "", "/", ".ggyyggy.com");
                    check_login();
                }
                else {
                    show_remind( data.ErrMsg , "error" );
                    $( ".captcha img" ).attr( "src" , "php/verification.php?" + Math.random() );
                    if( data.action ){
                        console.log( $( "#alert-msg" ) );
                        $( "#alert-msg" ).show();
                    }
                }

        }
        var error_back = function( data ) {
                console.log(data);
        }
        $.Ajax( "GET" , "php/member.php?func=login" , data , "" , success_back , error_back);
        */
}

function logout_func() {
        
        alert( '尚未串接' );

        $( "#controller_login" ).show();
        $( "#controller_istera" ).hide();
        
        /*
        var data = {
                token:   getCookie( "istera_cookie" )
        };
        var success_back = function( data ) {
        
                data = JSON.parse( data );
                console.log(data);
                if( data.Success ) {
                    delete_cookie( "istera_cookie" , "/" , ".ggyyggy.com" );
                    logout_layout();
                    if( typeof unconnected_callback != "undefined" )
                        unconnected_callback();
                }
                else {
                    show_remind( data.ErrMsg , "error" );
                }

        }
        var error_back = function( data ) {
                console.log(data);
        }
        $.Ajax( "GET" , "php/member.php?func=logout" , data , "" , success_back , error_back);
        */
}

function login_layout() {
    
        //有登入
        $( ".login-block" ).hide();
        $( ".logout-block" ).show();
        
        $('.top ul li.login').addClass('active');
        // mobile and PC hide 登入box
        $('[id=login-block]').stop(true, false).animate({top:40, opacity:0}).hide().css( "z-index" , "" );
        // mobile show 已登入操作box
        $( "#mobi-member [id=logout-block]" ).show().css( "opacity" , "1" ).css( "z-index" , "" );
        // PC hide 已登入操作box
        $('.top > ul > li.login [id=logout-block]').stop(true, false).animate({top:40, opacity:0}).hide().css( "z-index" , "" );
        $('#cover2').hide();
        
        
        
}
function logout_layout() {
        //未登入
        $( ".logout-block" ).hide();
        $( ".login-block" ).show();
        
        $( "#header .login > a" ).html( "" );
        $('.top ul li.login.active').removeClass('active');
        
        // mobile show 登入box
        $( "#mobi-member [id=login-block]" ).show().css( "opacity" , "1" ).css( "z-index" , "" );
        // mobile and PC hide 已登入操作box
        $('[id=logout-block]').stop(true, false).animate({top:40, opacity:0}).hide().css( "z-index" , "" );
        $('#cover2').hide();
}
function remind_login() {
        //check header現在要trigger哪個
        show_remind( "請先登入" );
        if (window.matchMedia('(max-width: 768px)').matches) {
            $('#mobi-rbtn , #header .container #mobi-rbtn').trigger( "click" );
        } else {
            $('.top > ul > li.login').trigger( "mouseenter" );
        }
        
}