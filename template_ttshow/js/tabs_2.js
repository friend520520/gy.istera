
$("document").ready(function() {
        
        $( "#tabs" ).children( "ul" ).children( "a" ).removeAttr("href");
        
        $( "#tabs" ).children( "ul" ).find( "li" ).unbind( "click" ).bind( "click", function(e) {
                    
                var pagetype = $( this ).attr( "pagetype" );
                
                if( pagetype )
                {
                        $( "#tabs" ).children( "ul" ).find( "li" ).removeClass( "ui-tabs-active" ).removeClass( "ui-state-active" );
                        $( this ).addClass( "ui-tabs-active" ).addClass( "ui-state-active" );
                        /*if( pagetype === "9999" || pagetype === "10000" )
                            $.now_tabs_name = "0" ;
                        else*/
                            $.now_tabs_name = pagetype;

                        $.nuw_page_num = 1 ;

                        $( "#pagecontent" ).html("");

                        $( "#loading_icon" ).css( "visibility" , "visible" );
                        console.log( $.now_tabs_name );

                        $.category_data = [];

                        $.ajaxq(
                                'test', {
                                        type    : "POST",
                                        url     : "php/json_list_categorypage_homepage_H.php",
                                        data: {
                                                sub         : $.now_tabs_name ,
                                        },
                                        //dataType: "json",
                                        success: function(data) {
                                                //console.log(data);
                                                if( data != "false" )
                                                {
                                                        data = JSON.parse( data );
                                                        console.log( data );
                                                        
                                                        var html0 = "";
                                                        var html1 = "";
                                                        var html2 = "";
                                                        $.each( data , function( index , value ){
                                                            
                                                            if( index === 0 )
                                                            {

                                                                    html0 = '<a href="page-inner.php?page_id=' + value.page_id + '" name="responsive_div" header="H_1" style="position: relative ! important; padding: 1px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-6">' +
                                                                                    '<div class="bg_top" style="padding:0px; border:0px; cursor: pointer; background-image: url(' + value.article_icon + '); ">' +
                                                                                        '<div style="padding: 0px; margin: 0px; cursor: pointer; height: 100%;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cover-text">' +
                                                                                                '<div class="cover-black"></div>' +
                                                                                                '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' + value.title + '</h3>' +
                                                                                        '</div>' +
                                                                                    '</div>' +
                                                                                  '</a>';


                                                            }
                                                            else if( index === 1 )
                                                            {
                                                                    html1 +=   '<a href="page-inner.php?page_id=' + value.page_id + '" name="responsive_div" header="H_2" style="width: 50%; position: relative ! important; padding: 0px;" class="col-xs-6">' +
                                                                                        '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" style="padding: 0px; margin: 0px; cursor: pointer; margin-top: 0px;  margin-left: 0%; background-image: url(' + value.article_icon + '); ">' +
                                                                                            '<div class="cover-black"></div>' +
                                                                                            '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' + value.title + '</h3>' +
                                                                                        '</div>' +
                                                                                    '</a>';
                                                            }
                                                            else if( index === 2 )
                                                            {
                                                                    html1 += '<a href="page-inner.php?page_id=' + value.page_id + '" name="responsive_div" header="H_3" style="width: 50%; position: relative ! important; padding: 0px;" class="col-xs-6">' +
                                                                                        '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" style="padding: 0px; margin: 0px; cursor: pointer; margin-top: 0px; background-image: url(' + value.article_icon + '); ">' +
                                                                                            '<div class="cover-black"></div>' +
                                                                                            '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' + value.title + '</h3>' +
                                                                                        '</div>' +
                                                                                '</a>';
                                                            }
                                                            else if( index === 3 )
                                                            {
                                                                    html1 += '<a href="page-inner.php?page_id=' + value.page_id + '" name="responsive_div" header="H_4" style="width: 50%; position: relative ! important; padding: 0px;" class="col-xs-6">' +
                                                                                        '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" ' +
                                                                                            'style="padding: 0px; cursor: pointer; margin-left: 0%; background-image: url(' + value.article_icon + '); ">' +
                                                                                            '<div class="cover-black"></div>' +
                                                                                            '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' + value.title + '</h3>' +
                                                                                        '</div>' +
                                                                                '</a>';
                                                            }
                                                            else if( index === 4 )
                                                            {
                                                                    html1 += '<a href="page-inner.php?page_id=' + value.page_id + '" name="responsive_div" header="H_5" style="width: 50%; position: relative ! important; padding: 0px;" class="col-xs-6">' +
                                                                                        '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" ' +
                                                                                            'style="padding: 0px; cursor: pointer; background-image: url(' + value.article_icon + '); ">' +
                                                                                            '<div class="cover-black"></div>' +
                                                                                            '<h3 style="text-shadow: 1px 2px 1px black; text-align: left;">' + value.title + '</h3>' +
                                                                                        '</div>' +
                                                                                '</a>';
                                                            }
                                                            
                                                            
                                                        });
                                                        
                                                        
                                                        
                                                        html2 += html0 +
                                                            '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 homepageheader_small" style="padding: 0px; position: relative; border: 0px none;">'+
                                                                        html1 +
                                                            '</div>' +
                                                            '<div class="clearfix"></div>';
                                                        
                                                        $( "#homepageheader" ).html( html2 );
                                                        
                                                }
                                        }
                                }
                        );

                        if ($.tpathqueue)
                            clearTimeout($.tpathqueue);

                        $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                DisplayCurrentScroll(); 
                        });
                        $( "#loading_icon" ).show();

                        use_getbody();

                }
                    
        });

        $( "#sub_category > span" ).unbind( "click" ).bind( "click", function(e) {
                active_event( $(this) );
        });
        
});

        function mouseover_event() {
            
            $( "#homepagecontent" ).find( "p.pagebg" ).unbind( "mouseover" ).bind( "mouseover" , function(){
                    
                    var backimg = $( this ).attr( "backimg" );
                    console.log( $( this ).parent().parent().children(".bg_top") );
                    $( this ).parent().parent().children(".bg_top").css( "background-image" , "url('" + backimg + "')" );
                    
            });
            
        }
        
        function more_event() {
            
            $(".more").unbind( "click" ).bind( "click", function(e) {
                
                    $( "#tabs" ).children( "ul" ).find( "li[pagetype=" + $( this ).attr( "sub" )  + "]" ).trigger("click");
                
            });
            
            $( "#homepagecontent" ).find( "._list" ).unbind( "click" ).bind( "click" , function(){
                    
                    var type = $( this ).attr( "type" );
                    var sub = $( this ).attr( "sub" );
                    var pos = $( this ).parents( "._list_top" );
                    $.ajaxq(
                        'test', {
                            type: "POST",
                            url: "php/html_list_categorypage_homepage_L2.php",
                            data: {
                                page_num: "5",
                                page: "1",
                                sub: sub,
                                page_type: "common",
                                type: type
                            },
                            //dataType: "json",
                            success: function(data) {
                                //console.log(data);
                                if( data !== "false" )
                                {
                                        pos.children(":not(h3)").remove();
                                        pos.append(data);
                                        
                                        mouseover_event();
                                }

                            }
                        }
                    );
            
            });
            
        }

        


        function getbody() {
                
                if( $.now_tabs_name === "0" )
                {
                        //////////////0730email
                        /*$( "#main_tab" ).height( 45 );
                        $( "#sub_category" ).parent().hide();
                        $( "#main-container" ).css( "margin-top" , "95px" );*/
                        //////////////0730email
                        
                        $("#categorypage").hide();
                        $("#homepage").show();
                        homepage();
                }
                else
                {
                        //////////////0730email
                        /*$( "#main_tab" ).height( 80 );
                        $( "#sub_category" ).parent().show();
                        $( "#main-container" ).css( "margin-top" , "130px" );
                        
                        $( "#sub_category" ).html( "" );
                        var bohan_sub_category = ["全部"];

                        var left = 0;
                        $.each( bohan_sub_category , function( index , value ){

                               if( index === 0 )
                                {
                                    $( "#sub_category" ).append( '<span class="_active" value="' + value + '" style="white-space: nowrap; left: 0px; position: absolute; padding: 2px 10px;">' + value + '</span>' );
                                }
                                else
                                {
                                    left += $( "#sub_category" ).children(":last").width() + 20;
                                    $( "#sub_category" ).append( '<span value="' + value + '" style="white-space: nowrap; left: ' + left + 'px; position: absolute; padding: 2px 10px;">' + value + '</span>' );
                                }
                                
                        });
                        $( "#sub_category > span" ).unbind( "click" ).bind( "click", function(e) {
                                active_event( $(this) );
                        });*/
                        //////////////0730email
                    
                        $( "#loading_icon" ).css( "visibility" , "visible" );
                        $("#homepage").hide();
                        $("#categorypage").show();

                        $.ajax({
                                    type: "POST",
                                    url: "php/json_list_categorypage.php",
                                    data: {
                                                user        : $.member.email ,
                                                page_num    : "24" ,
                                                page        : $.nuw_page_num ,
                                                sub         : $.now_tabs_name ,
                                                page_type        : "hot" ,
                                                /*subsub      : "1"*/
                                    },
                                    success: function(data) {

                                                $( "#loading_icon" ).css( "visibility" , "hidden" );

                                                if( data !== "false" )
                                                {
                                                        data = JSON.parse( data );
                                                        var tmp = "";

                                                        var func = function( a ){  return create_chessboard( a , "col-xs-12 col-sm-6 col-md-4 col-lg-4" , "padding:6px;" ); } ;

                                                        $.each( data , function( index , value ){

                                                                $.category_data[ $.category_data.length ] = value;
                                                                tmp += func( value );

                                                        });
                                                        $( "#pagecontent" ).append( tmp );



                                                        
                                                        collect_subscribe_event();

                                                }
                                                else
                                                {
                                                        $( window ).unbind( "scroll" );
                                                        $( "#loading_icon" ).hide();
                                                }
                                                $.loading = 0;

                                    }
                        });
                }
        }
        
        function homepage() {
                
                $( "#homepagecontent" ).html("");
                
                $.ajaxq( "test" , {
                            type: "POST",
                            url: "php/html_list_homepage_bysub.php",
                            data: {
                                        page_num    : "7" ,
                                        page        : "1" ,
                                        page_type   : "hot" ,
                                        sub         : ""
                            },
                            //dataType: "json",
                            success: function( data )
                            {
                                    $.homepage_data = "";
                                    if( data !== "false" )
                                    {
                                        $.homepage_data += data;
                                    }
                                    
                            }
                });
                
                $.ajaxq( "test" , {
                            type: "POST",
                            url: "php/html_list_homepage_bysub.php",
                            data: {
                                        page_num    : "7" ,
                                        page        : "1" ,
                                        page_type   : "new" ,
                                        sub         : ""
                            },
                            //dataType: "json",
                            success: function( data )
                            {
                                    if( data !== "false" )
                                    {
                                        $.homepage_data += data;
                                    }
                                    
                            }
                });
                
                $.ajaxq( "test" , {
                            type: "POST",
                            url: "php/html_list_homepage.php",
                            data: {
                                        page_num    : "7" ,
                                        page        : "1" ,
                                        page_type        : "common"
                                        /*subsub      : "1"*/
                            },
                            //dataType: "json",
                            success: function( data )
                            {
                                    if( data !== "false" )
                                    {
                                        $.homepage_data += data;
                                        $( "#homepagecontent" ).html( $.homepage_data );
                                        
                                        /*$( "#homepagebody > div > div" ).children(":even").css( "padding" , "0 5px 0 0" );
                                        $( "#homepagebody > div > div" ).children(":odd").css( "padding" , "0 0 0 5px" );*/
                                        
                                        
                                        more_event();
                                        
                                    }
                            }
                });
                
                /*$.ajaxq(
                    'test', {
                        type: "POST",
                        url: "php/html_list_categorypage_homepage_L1.php",
                        data: {
                            page_num: "5",
                            page: "1",
                            page_type: "common"
                        },
                        //dataType: "json",
                        success: function(data) {
                            //console.log(data);
                            if( data !== "false" )
                            {
                                    //data += '<div class="clearfix"></div><hr>';
                                    $( "#homepagecontent" ).prepend(data);
                                    
                                    more_event();
                                    mouseover_event();
                            }
                            
                        }
                    }
                );
                
                $.ajaxq(
                    'test', {
                        type: "POST",
                        url: "php/html_list_homepage_author.php",
                        data: {
                            user: $.member.facebook_mail,
                            page_num: "9",
                            page: "1"
                        },
                        //dataType: "json",
                        success: function(data) {
                            //console.log(data);
                            if( data !== "false" )
                            {
                                    //data += '<div class="clearfix"></div><hr>';
                                    //$("#homepage").prepend(data);
                                    $( "#homepagecontent > div" ).eq( parseInt( $( "#homepagecontent > div" ).length / 2 ) - 1 )
                                                            .after( '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 5px;">' +
                                                                        '<h3 class="homepage_author" style="color: rgb(76, 143, 189); font-size: 22px; margin-bottom: 14px;">' +
                                                                          '<i style="font-size: 25px" class="fa fa-minus fa-rotate-90"></i>' +
                                                                          '<span style="margin-left: -5px;">本週推薦社群</span>' +
                                                                        '</h3>' +
                                                                        '<div id="homepage_author">' +
                                                                            data +
                                                                        '</div>' +
                                                                    '</div>' );
                                    
                                    collect_subscribe_event();
                            }

                        }
                    }
                );*/
        
        }

        function init_scroll() {
                    
                    $( window ).unbind( "scroll" ).bind( "scroll" , function(){
                            DisplayCurrentScroll(); 
                    });
                    $( "#loading_icon" ).show();
                    
                    if( $.init_tab )
                    {
                            $( "#tabs" ).children( "ul" ).find( "li[pagetype=" + $.init_tab + "]" ).trigger( "click" );
                            $.init_tab = "" ;
                    }
                    else
                    {
                            $( "#tabs" ).children( "ul" ).find( "li[pagetype=0]" ).trigger( "click" );
                            
                    }

        }
        
        function DisplayCurrentScroll() {
                    
                    /*if ($.device != "pc")
                        var tmp_div = $("body")[0];
                    else
                        var tmp_div = $("html")[0];*/
                    
                    //var tmp_div = $("html")[0];
                    
                    if( $( "body" )[0].scrollTop >= $( "html" )[0].scrollTop )
                        var tmp_div = $( "body" )[0] ;
                    else
                        var tmp_div = $( "html" )[0] ;
                    
                    /**var length = $('#web_sidebar1').height() - $('#web_sidebar').height() + $('#web_sidebar1').offset().top;
                    var scroll1 = $(window).scrollTop();
                    var height = $('#web_sidebar').height() + 'px';
                    
                    console.log( "length = " + length );
                    console.log( "scroll = " + scroll1 );
                    console.log( "height = " + height );
                    
                    if (scroll1 < $('#web_sidebar1').offset().top) {
                        console.log("1");
                        $('#web_sidebar').css({
                            'position': 'absolute',
                            'top': '0',
                            'height': 'auto'
                        });

                    } else if (scroll1 > length) {
                        console.log("2");
                        $('#web_sidebar').css({
                            'position': 'relative',
                            'bottom': '0',
                            'top': 'auto',
                            'height': 'auto'
                        });

                    } else {
                        console.log("3");
                        $('#web_sidebar').css({
                            'position': 'fixed',
                            'top': '0',
                            'height': height
                        });
                    }*/

                    
                    
                    //console.log( tmp_div.scrollHeight - tmp_div.clientHeight );
                    //console.log( tmp_div.scrollLeft , tmp_div.scrollTop );

                    var tmp_persent = tmp_div.scrollTop / (tmp_div.scrollHeight - tmp_div.clientHeight);

                    console.log( "body = " + $( "body" )[0].scrollTop + " , html = " + $( "html" )[0].scrollTop + " , final = " + tmp_div.scrollTop );
                    
                    
                    if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#pagecontent_body").children(":eq(0)").height()*6 )
                    {
                            /*if ($.tpathqueue)
                                clearTimeout($.tpathqueue);
                            $.tpathqueue = setTimeout(function() {
                                $.nuw_page_num++;
                                scroll();
                            }, 500);*/
                            if (!$.loading)
                            {
                                $.loading = 1;
                                $.tpathqueue = setTimeout(function() {
                                    $.nuw_page_num++;
                                    scroll();
                                }, 500);
                            }
                    }
                    
                    
        }

        function scroll() {
                    
                    console.log( "$.now_tabs_name = " + $.now_tabs_name );
                    if( $.now_tabs_name !== "0" )
                            use_getbody();

        }
        
        function use_getbody() {
                
                getbody();
                
        }
