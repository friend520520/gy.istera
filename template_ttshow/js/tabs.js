
$("document").ready(function() {
        
        console.log( $( ".subpage span" ).html() );
        console.log( $( "#ol-menu .owl-item a" ) );
        $( "#owl-menu .owl-item a" ).removeAttr("href");
        
        $("#owl-menu .swiper-slide").bind( "click" , function() {
                
                //$("#owl-menu .owl-item.active").removeClass('active');
                //$(this).addClass('active');
                
                var pagetype = $( this ).attr( "pagetype" );
                
                category_open( pagetype );
                
        });
        
});

        $.init_tab = getParameterByName( "tab" );
        console.log( $.init_tab );
        
        function category_open( pagetype ) {
                
                if( pagetype )
                {
                        $.now_tabs_name = pagetype;
                        $.nuw_page_num = 1 ;
                        
                        $( "#loading_icon" ).css( "visibility" , "visible" );

                        console.log( pagetype );
                        console.log( $( ".subpage span" ).html() );
                        
                        if(  pagetype !== "0" ) {
                            $( ".subpage span" ).html( $( this ).children( "a" ).html() );
                        }
                        else {
                            $( ".subpage span" ).html( "" );
                        }

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
                                                        $( ".slider" ).html( '<div class="swiper-container">' +
                                                                                    '<div class="swiper-wrapper">' +
                                                                                    '</div>' +
                                                                                    '<div class="slider-bottom">' +
                                                                                            '<div class="swiper-pagination"></div>' +
                                                                                    '</div>' +
                                                                            '</div>' );
                                                        
                                                        data = JSON.parse( data );
                                                        console.log( data );
                                                        
                                                        var html = "";
                                                        var html_pc1 = "";
                                                        var html_pc2 = "";
                                                        $.each( data , function( index , value ){
                                                                    
                                                                    var title = getStrLength(value.title) <= 59 ? value.title : getInterceptedStr( value.title , 56 ) + "...";
                                                                    html += '<div class="swiper-slide">' +
                                                                                    '<a page="' + value.page_id + '">' +
                                                                                            //'<img src="' + value.article_icon + '">' +
                                                                                            '<div name="responsive_div">' +
                                                                                                '<div style="background-image: url(\'' + value.article_icon + '\'); "></div>' +
                                                                                            '</div>' +
                                                                                            '<h3 class="slide-title" title="' + value.title + '">' + title + '</h3>' +
                                                                                    '</a>' +
                                                                            '</div>';
                                                                    
                                                                    if( index === 0 ) {
                                                                            html_pc1 += '<a href="inner.php?page_id=' + value.page_id + '">' +
                                                                                                //'<img src="images/index/slider/pic1.png">' +
                                                                                                '<div name="responsive_div">' +
                                                                                                    '<div style="background-image: url(\'' + value.article_icon + '\'); "></div>' +
                                                                                                '</div>' +
                                                                                        '</a>' +
                                                                                        '<h3 class="slide-title">' +
                                                                                                '<a href="inner.php?page_id=' + value.page_id + '">' + value.title + '</a>' +
                                                                                        '</h3>';
                                                                    }
                                                                    else {
                                                                            html_pc2 += '<div class="sub-list">' +
                                                                                                '<a href="inner.php?page_id=' + value.page_id + '">' +
                                                                                                        //'<img src="images/index/slider/pic5.png">' +
                                                                                                        '<div name="responsive_div">' +
                                                                                                            '<div style="background-image: url(\'' + value.article_icon + '\'); "></div>' +
                                                                                                        '</div>' +
                                                                                                '</a>' +
                                                                                                '<h3 class="slide-title">' +
                                                                                                        '<a href="inner.php?page_id=' + value.page_id + '">' + value.title + '</a>' +
                                                                                                '</h3>' +
                                                                                        '</div>';
                                                                    }
                                                                    
                                                            
                                                        });
                                                        
                                                        $( ".slider .swiper-wrapper" ).html( html );
                                                        $( ".slider-pc .slider-main" ).html( html_pc1 );
                                                        $( ".slider-pc .slider-sub" ).html( html_pc2 );
                                                        
                                                        var swiper = new Swiper('.swiper-container', {
                                                                    pagination: '.swiper-pagination',
                                                                    slidesPerView: 1,
                                                                    paginationClickable: true,
                                                                    spaceBetween: 0,
                                                                    loop: true,
                                                                    onClick: function(swiper, event) {
                                                                        //$.swiper = swiper;
                                                                        //console.log( swiper );
                                                                        //console.log( $( swiper.clickedSlide ).children().attr( "page" ) );
                                                                        if( $( swiper.clickedSlide )[0] )
                                                                            location.href= "inner.php?page_id=" + $( swiper.clickedSlide ).children().attr( "page" );

                                                                    }
                                                        });
                                                        
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
                
                
        }
        
        function getbody() {
                    
                    $( "#loading_icon" ).css( "visibility" , "visible" );
                    
                    if( $.nuw_page_num === 1 ){
                        $( "#content" ).html( '<div class="list" style="visibility: hidden;">' +
                                                    '<a href="inner.php?page_id=2027">' +
                                                        '<div name="responsive_div">' +
                                                            '<div style="background-image: url(); "></div>' +
                                                        '</div>' +
                                                        '<div class="info">' +
                                                            '<h3>【Onion man】經典插畫(八)：九陰真經的厲害</h3>' +
                                                            '<p class="view">' +
                                                                '<img src="template_new/images/inner/view.png">' +
                                                                '<span>0</span>' +
                                                            '</p>' +
                                                        '</div>' +
                                                        '<div class="list-icon"></div>' +
                                                    '</a>' +
                                                '</div>' );
                        var width = $( "#content > .list" ).width() - 10;
                        $( "#content" ).html("");
                    }
                    else {
                        var width = $( "#content > .list" ).width() - 10;
                    }
                    
                    $.ajaxq( "line" , {
                                type: "POST",
                                url: "php/json_list_categorypage.php",
                                data: {
                                            user        : $.member.email ,
                                            page_num    : "24" ,
                                            page        : $.nuw_page_num ,
                                            sub         : $.now_tabs_name ,
                                            page_type        : "new" ,
                                            /*subsub      : "1"*/
                                },
                                success: function(data) {

                                            $( "#loading_icon" ).css( "visibility" , "hidden" );
                                            
                                            if( data !== "false" )
                                            {
                                                    data = JSON.parse( data );
                                                    var tmp = "";
                                                    var mql = window.matchMedia("(min-width: 1024px)");;
                                                    var low = mql.matches ? 2 : 3;
                                                    console.log( "low = " + low );
                                                    $.each( data , function( index , value ){
                                                            
                                                            tmp += create_chessboard_hot( value , "true" , width , low , 18 );

                                                    });
                                                    $( "#content" ).append( tmp );

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
        
        function init_scroll() {
                    
                    $( window ).unbind( "scroll" ).bind( "scroll" , function(){
                            DisplayCurrentScroll(); 
                    });
                    $( ".loading" ).show();
                    
                    if( $.init_tab )
                    {
                            $("#owl-menu .swiper-slide[pagetype=" + $.init_tab + "]").trigger( "click" );
                            $.init_tab = "" ;
                    }
                    else
                    {
                            category_open( "0" );
                    }

        }
        
        function DisplayCurrentScroll() {
                    
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
                    
                    
                    if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#content").children(":eq(0)").height()*6 )
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
                    use_getbody();

        }
        
        function use_getbody() {
                
                getbody();
                
        }
