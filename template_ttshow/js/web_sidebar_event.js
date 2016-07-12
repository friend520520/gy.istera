
$("document").ready(function() {
    
        $( "#tab2" ).children( ".tab" ).children( "button" ).unbind( "click" ).bind( "click" , function(){
                
                $( "#tab2" ).children( ".tab" ).children( "button" ).removeClass("btn-danger");
                $( "#tab2" ).children( ".tab" ).children( "button" ).addClass("btn-light");
                $( this ).addClass("btn-danger");
                $( this ).removeClass("btn-light");
                
                $( "#tab2" ).children( ".tab_content" ).children().hide();
                $( "#tab2" ).children( ".tab_content" ).children("[tab=" + $( this ).attr("tab") + "]").show();
                
                //use_gettab( $( this ).attr("tab") );
                
        });
        
        web_sidebar_get_random_page();
        
        /*$( "#tab3" ).children( ".tab" ).children( "button" ).unbind( "click" ).bind( "click" , function(){
                
                $( "#tab3" ).children( ".tab" ).children( "button" ).removeClass("btn-primary");
                $( "#tab3" ).children( ".tab" ).children( "button" ).addClass("btn-light");
                $( this ).addClass("btn-primary");
                $( this ).removeClass("btn-light");
                
                $( "#tab3" ).children( ".tab_content" ).children().hide();
                $( "#tab3" ).children( ".tab_content" ).children("[tab=" + $( this ).attr("tab") + "]").show();
                
                use_gettab_author( $( this ).attr("type") );
                
        });*/
        
        if( !getCookie( "ttshow_hot_show" ) ) {

                use_gettab( "1" );
                $( "#tab2" ).children( ".tab" ).children( "button[tab=1]" ).trigger("click");
                
                $( "#tab2" ).show();
                
                var d = new Date();
                d.setTime(d.getTime() + (1 * 60 * 60 * 1000));
                var expires = "expires=" + d.toGMTString();
                document.cookie = "ttshow_hot_show=ttshow_hot_show; " + expires + "; path=/";

        }
        
        
});
        
        
        console.log( typeof adsbygoogle );
        if ( typeof adsbygoogle !== "undefined" )
        {
            document.write("<script src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'>" + "<" + "/script>");
        }
        
        (adsbygoogle = window.adsbygoogle || []).push({});
        (adsbygoogle = window.adsbygoogle || []).push({});
        
        function web_sidebar_get_random_page() {
            
            $.ajax({
                    type: "POST",
                    url: "php/json_list_get_random.php",
                    data: {
                        user : "",
                        page_num: "12"
                    },
                    //dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        if( data !== "false" )
                        {
                                var tmp = "";
                                data = JSON.parse( data );

                                $.each( data , function( index , value ){
                                        
                                        tmp += create_chessboard( value , "col-xs-12" );
                                        
                                });

                                $( "#random_page" ).append( tmp );
                                $.loading_web_sidebar = 0;
                                $( "[name=load_img_web_sidebar]" ).css( "visibility" , "hidden" );
                        }

                    }
            });
            
            
            
        }

        function web_sidebar_collect_subscribe_event() {
            
            $( ".collect" ).unbind( "click" ).bind( "click", function(e) {

                        //$( this ).css( "background"     , "none repeat scroll 0px 0px lightblue" );
                        if( $( this ).hasClass( "already" ) )
                        {
                                var tmp_location = $( this );
                                var page_id = $( this ).attr("article");
                                console.log( page_id );

                                $.ajax({
                                            type: "POST",
                                            url: "php/collect.php?func=action",
                                            data: {
                                                        email    : $.member.email ,
                                                        page_id   : page_id ,
                                                        collect   : "cancel"
                                            },
                                            //dataType: "json",
                                            success: function(data) {

                                                    if( data === "already" )
                                                    {
                                                        tmp_location.addClass("already");
                                                        tmp_location.html("已收藏");
                                                    }
                                                    else if( data === "yet" )
                                                    {
                                                        tmp_location.removeClass("already");
                                                        tmp_location.html("收藏");
                                                    }

                                            }
                                });
                        }
                        else
                        {
                                var tmp_location = $( this );
                                var page_id = $( this ).attr("article");
                                console.log( page_id );

                                $.ajax({
                                            type: "POST",
                                            url: "php/collect.php?func=action",
                                            data: {
                                                        email    : $.member.email ,
                                                        page_id   : page_id ,
                                                        collect   : "collect"
                                            },
                                            //dataType: "json",
                                            success: function(data) {

                                                    if( data === "already" )
                                                    {
                                                        tmp_location.addClass("already");
                                                        tmp_location.html("已收藏");
                                                    }
                                                    else if( data === "yet" )
                                                    {
                                                        tmp_location.removeClass("already");
                                                        tmp_location.html("收藏");
                                                    }
                                            }
                                });
                        }

            });
            
            $( ".subscribe" ).unbind( "click" ).bind( "click", function(e) {
                                
                        if( $( this ).hasClass( "already" ) )
                        {
                                console.log( "already" );
                                var tmp_location = $( this );
                                var channel_id = $( this ).attr("channel");

                                $.ajax({
                                            type: "POST",
                                            url: "php/subscribe.php",
                                            data: {
                                                        email    : $.member.email ,
                                                        user_id   : channel_id ,
                                                        subscribe : "cancel"
                                            },
                                            //dataType: "json",
                                            success: function(data) {

                                                    if( data === "already" )
                                                    {
                                                        $( "[channel=" + channel_id + "].subscribe" ).addClass("already");
                                                        $( "[channel=" + channel_id + "].subscribe" ).html("已訂閱");
                                                    }
                                                    else if( data === "yet" )
                                                    {
                                                        $( "[channel=" + channel_id + "].subscribe" ).removeClass("already");
                                                        $( "[channel=" + channel_id + "].subscribe" ).html("訂閱");
                                                    }

                                            }
                                });
                        }
                        else
                        {
                                console.log( "yet" );
                                var tmp_location = $( this );
                                var channel_id = $( this ).attr("channel");
                                $.ajax({
                                            type: "POST",
                                            url: "php/subscribe.php",
                                            data: {
                                                        email    : $.member.email ,
                                                        user_id   : channel_id ,
                                                        subscribe : "subscribe"
                                            },
                                            //dataType: "json",
                                            success: function(data) {

                                                    if( data === "already" )
                                                    {
                                                        $( "[channel=" + channel_id + "].subscribe" ).addClass("already");
                                                        $( "[channel=" + channel_id + "].subscribe" ).html("已訂閱");
                                                    }
                                                    else if( data === "yet" )
                                                    {
                                                        $( "[channel=" + channel_id + "].subscribe" ).removeClass("already");
                                                        $( "[channel=" + channel_id + "].subscribe" ).html("訂閱");
                                                    }

                                            }
                                });
                        }
            });
            
        }
        
        function gettab( period , success6 , fail6 ) {
                
                $.ajax({
                            type: "POST",
                            url: "php/json_list_insidepageHot.php",
                            data: {
                                        period      : period ,
                                        user        : "" ,
                                        page_num    : "10" ,
                                        page        : "1"
                                        /*subsub      : "1"*/
                            },
                            //dataType: "json",
                            success: success6 ,
                            error: fail6
                });
                
        }
        
        function use_gettab( period ) {
                
                gettab( period , function(data) {

                            if( data == "false" )
                            {
                                        $( "#tab2" ).children( ".tab_content" ).children("[tab=" + period + "]").html("");
                            }
                            else
                            {
                                        
                                        data = JSON.parse( data );
                                        
                                        
                                        $( "#tab2" ).children( ".tab_content" ).children("[tab=1]").html( data.daith );
                                        $( "#tab2" ).children( ".tab_content" ).children("[tab=2]").html( data.weekly );
                                        $( "#tab2" ).children( ".tab_content" ).children("[tab=3]").html( data.monthly );
                                        
                                        web_sidebar_collect_subscribe_event();

                            }

                } , function(data) {

                            $( "#tab2" ).children( ".tab_content" ).children("[tab=" + period + "]").html("");
                            
                } );
        }
        
        /*function gettab_author( type , success6 , fail6 ) {
            
                $.ajax({
                            type: "POST",
                            url: "php/html_list_insidepageAuthorList.php",
                            data: {
                                        user        : $.member.facebook_mail ,
                                        page_type   : type ,
                                        page_num    : 5 ,
                                        page        : 1
                            },
                            //dataType: "json",
                            success: success6 ,
                            error: fail6
                });
                
        }
        
        function use_gettab_author( type ) {
                
                gettab_author( type , function(data) {

                            //console.log(data);
                            $( "#tab3" ).children( ".tab_content" ).children("[type=" + type + "]").html( data );

                            if( data == "false" )
                            {
                                        $( "#tab3" ).children( ".tab_content" ).children("[type=" + type + "]").html("");
                            }
                            web_sidebar_collect_subscribe_event();
                            
                } , function(data) {

                            $( "#tab3" ).children( ".tab_content" ).children("[type=" + type + "]").html("");
                            
                } );
        }*/
