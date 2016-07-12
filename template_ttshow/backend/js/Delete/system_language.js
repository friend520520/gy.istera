/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1
*/
(function($) {
            $.motion_system_language = $.motion_system_language || {version:'0.0.1'};
            var motion_system_language = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destroy: function() {
                                        destroy();
                                },
                                fnchangelang: function() {
                                        fnchangelang();
                                },
                                options: function() {
                                        return opts;
                                },
                                _SetOpts: function( options ) {
                                        $.extend(opts,options);
                                }
                    });
                    
                    function setCookie(cname, cvalue, exdays) {
                                var d = new Date();
                                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                                var expires = "expires="+d.toUTCString();
                                document.cookie = cname + "=" + cvalue + "; " + expires;
                    }
                    
                    function getCookie(cname) {
                                var name = cname + "=";
                                var ca = document.cookie.split(';');
                                for(var i=0; i<ca.length; i++) {
                                            var c = ca[i];
                                            while (c.charAt(0)==' ') c = c.substring(1);
                                            if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
                                }
                                return "";
                    }
                    
                    function init()
                    {   
                                if( getCookie( "appbuilderlanguage" ) == "" )
                                {
                                            setCookie( "appbuilderlanguage"     , "en-us" );
                                            setCookie( "appbuilderlanguageshow" , "English" );
                                            fnchangelang();
                                }
                                else
                                {
                                            fnchangelang();
                                }
                                

                                $( "#dropdownMenu1" ).next().children( "li" )
                                .unbind('click').bind( 'click' , function() {

                                            var tmp  = $( this ).children( "a" ).attr( "tabindex" );
                                            var show = $( this ).children( "a" ).html();

                                            setCookie( "appbuilderlanguage"     , tmp  );
                                            setCookie( "appbuilderlanguageshow" , show );
                                            
                                            fnchangelang();
                                            
                                });
                    }

                    function fnchangelang()
                    {
                                var tmp  = getCookie( "appbuilderlanguage" );
                                var show = getCookie( "appbuilderlanguageshow" );

                                $( "#dropdownMenu1" ).html( show + ' <span class="caret"></span>' );
                                
                                if(
                                            tmp == "UAE-English" 
                                            ||
                                            tmp == "UAE-Arabic" 
                                            ||
                                            tmp == "Iran-Persian" 
                                )
                                {
                                            $( "[changelanguage=1]" ).parent().attr( "dir" , "rtl" );
                                            $( "[changelanguage=1]" ).css( "font-family", "Tahoma" );

                                            $( ".sidebar-nav" ).css( "left"  , "" );
                                            $( ".sidebar-nav" ).css( "right" , "0" );

                                            $( "#main_container" ).css( "margin-left" , "-225px" );
                                            
                                            //$( "#main_container [contenteditable=true]" ).attr( "dir" , "rtl" );
                                            $( "#main_container" ).attr( "dir" , "rtl" );
                                }
                                else
                                {
                                            $( "[changelanguage=1]" ).parent().attr( "dir" , "" );
                                            $( "[changelanguage=1]" ).css( "font-family", "inherit" );

                                            $( ".sidebar-nav" ).css( "left"  , "0" );
                                            $( ".sidebar-nav" ).css( "right" , "" );

                                            $( "#main_container" ).css( "margin-left" , "0px" );
                                            
                                            //$( "#main_container [contenteditable=true]" ).attr( "dir" , "" );
                                            $( "#main_container" ).attr( "dir" , "" );
                                }

                                if( tmp == "en-us" )
                                {
                                            $.each( $( "[changelanguage=1]" ) , function( index , value ) {
                                                        // console.log( $( value ).html() );
                                                        if( $( value ).attr( "haschangelanguage" ) == undefined )
                                                        {
                                                                    $( value ).attr( "haschangelanguage" , "1" );
                                                                    $( value ).attr( "orglanguage" , $( value ).html() );
                                                                    $( value ).html( $( value ).attr( "orglanguage" ) );
                                                        }else{
                                                                    $( value ).html( $( value ).attr( "orglanguage" ) );
                                                        }
                                            });

                                            $.each( $( "[changetitlelanguage=1]" ) , function( index , value ) {

                                                        if( $( value ).attr( "haschangelanguage" ) == undefined )
                                                        {
                                                                    $( value ).attr( "haschangelanguage" , "1" );
                                                                    $( value ).attr( "orglanguage" , $( value ).attr( "title" ) );
                                                                    $( value ).attr( "title" , $( value ).attr( "orglanguage" ) );
                                                        }else{
                                                                    $( value ).attr( "title" , $( value ).attr( "orglanguage" ) );

                                                        }
                                            });
                                }
                                else
                                {

                                            $.ajax({
                                                        type : 'POST',
                                                        url : 'lang/' + tmp + '.lang',
                                                        async: true,
                                                        success : function( xhr, ajaxOptions, thrownError) {
                                                                    console.log( eval( xhr ) );

                                                                    $.lang_main_data = eval( xhr ) ;

                                                                    $.each( $( "[changelanguage=1]" ) , function( index , value ) {
                                                                                // console.log( $( value ).html() );
                                                                                if( $( value ).attr( "haschangelanguage" ) == undefined )
                                                                                {
                                                                                            $( value ).attr( "haschangelanguage" , "1" );
                                                                                            $( value ).attr( "orglanguage" , $( value ).html() );
                                                                                            $( value ).html( $.lang_main_data[0][ $( value ).attr( "orglanguage" ) ] );
                                                                                }else{
                                                                                            $( value ).html( $.lang_main_data[0][ $( value ).attr( "orglanguage" ) ] );
                                                                                }
                                                                    });
                                                                    $.each( $( "[changetitlelanguage=1]" ) , function( index , value ) {

                                                                                if( $( value ).attr( "haschangelanguage" ) == undefined )
                                                                                {
                                                                                            $( value ).attr( "haschangelanguage" , "1" );
                                                                                            $( value ).attr( "orglanguage" , $( value ).attr( "title" ) );
                                                                                            $( value ).attr( "title" , $.lang_main_data[0][ $( value ).attr( "orglanguage" ) ] );
                                                                                }else{
                                                                                            $( value ).attr( "title" , $.lang_main_data[0][ $( value ).attr( "orglanguage" ) ] );

                                                                                }
                                                                    });
                                                        },
                                                        error : function(xhr, ajaxOptions, thrownError) {
                                                                    //console.log( "error" , xhr , ajaxOptions, window.location.href );
                                                        },
                                                        beforeSend: function(xhr, ajaxOptions, thrownError) {
                                                                    //console.log( "beforeSend" , xhr , ajaxOptions.url , window.location.href );
                                                        }
                                            });
                                }
                                
                    }
                    function destroy()
                    {
                    }
                    
            };
            

            // jQuery plugin implementation
            $.fn.motion_system_language = function(conf) {

                        // return existing instance
                        var el = this.eq(typeof conf == 'number' ? conf : 0).data("motion_system_language");
                        if (el) {return el;}

                        // setup options
                        var opts = {
                                    aaa                    : "aaa",
                                    alarm_data              : "",
                                    alarm_state             : "",
                                    create_:function(e,m,o){}
                        };

                        $.extend(opts, conf);

                        // install the plugin for each items in jQuery
                        this.each(function() {
                                el = new motion_system_language(this, opts);
                                $(this).data("motion_system_language", el);
                        });

                        return opts.api ? el: this;
                        
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);