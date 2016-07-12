$(function(){
        
	$('body').append('<div id="cover"></div> <div id="cover2"></div>');	// add cover
	$('#cover, #cover2').hide(); 	// hide cover
        
	//桌機會員登入hover
        $('.top > ul > li.login').bind({
                mouseenter: pc_login_hover ,
                mouseleave: function(e) {
                    $('.top > ul > li.login').unbind( "mouseenter" ).bind( "mouseenter" , pc_login_hover );
                }
        });
        $('.top > ul > li.login>a').bind({
                click: function(e) {
                    $('#cover2').hide();
                    $('.top > ul > li.login > #logout-block').stop(true, false).animate({top:40, opacity:0}).hide().css( "z-index" , "" );
                    $('.top > ul > li.login > #login-block').stop(true, false).animate({top:40, opacity:0}).hide().css( "z-index" , "" );
                }
        });
        /*$('.top > ul > li.login > a').bind({
                click: function(){
                    var pos = $(this).parent();
                    if(pos.hasClass('active')){
                            pos = pos.find('#logout-block');
                            if( pos.css( "display" ) === "block" ){
                                    pos.stop(true, false).animate({top:40, opacity:0}).hide();
                            }
                            else if( pos.css( "display" ) === "none" ){
                                    pos.show().animate({top:23, opacity:1});
                            }
                    }else{
                            pos = pos.find('#login-block');
                            if( pos.css( "display" ) === "block" ){
                                    pos.stop(true, false).animate({top:40, opacity:0}).hide();
                            }
                            else if( pos.css( "display" ) === "none" ){
                                    pos.show().animate({top:23, opacity:1});
                            }
                            
                    }
                    $('.top > ul > li.login').unbind( "mouseenter" );
                }
        });*/
        $('#cover2').bind({
                click: function(){
                    $('#cover2').hide();
                    $('.top > ul > li.login > #logout-block').stop(true, false).animate({top:40, opacity:0}).hide().css( "z-index" , "" );
                    $('.top > ul > li.login > #login-block').stop(true, false).animate({top:40, opacity:0}).hide().css( "z-index" , "" );
                }
        });
	function pc_login_hover(){
		if($(this).hasClass('active')){
                        $('#cover2').show(); 
                        $(this).find('#logout-block').show().animate({top:35, opacity:1}).css( "z-index" , 10003 );//AL 20160429
                }else{
                        $('#cover2').show();
                        $(this).find('#login-block').show().animate({top:35, opacity:1}).css( "z-index" , 10003 );//AL 20160429
                }
	}
	/*$('.top > ul > li.login').hover( pc_login_hover , function(){
		if($(this).hasClass('active')){
			$(this).find('#logout-block').stop(true, false).animate({top:40, opacity:0}).hide();
		}else{
			$(this).find('#login-block').stop(true, false).animate({top:40, opacity:0}).hide();
		}
	});*/
	
	//主選單
	$('.menu > ul > li').hover(function(){
		$(this).find('ul').show().stop(true, false).animate({top:40, opacity:1},600);
		$(this).find('a').addClass('active');
	}, function(){
		$(this).find('ul').stop(true, false).animate({top:40, opacity:0},600, function(){
			$(this).hide();
		});
		$(this).find('a').removeClass('active');
	});
	
	//menu setup
	var $mobiMenu 	= $('.submenu').html(); //AL 20160429
            $TopLink1	 = $('.top ul').eq(0).html();
        var clone = $('.top ul').eq(1).clone();//bohan++
            clone.children(".login").remove();//bohan++  mobile版的右邊測攔在第二個ul拿掉登入，$mobiLogin已經有了
            $TopLink2	 = clone.html();//$('.top ul').eq(1).html();
            $mobiLogin = $('.top ul:eq(1) li.login').html();
            $3Button 		= $('#header dl.nav dt h2').html();
            $Gsearch		 = $('#header dl.nav dd').html();
            $mobiLogo 	= $('#header dl.nav dt h1').html();
	
	//menu-clone
	$('body #all').prepend('<div id="menu-clone"><a id="mobi-lbtn"></a><a id="mobi-rbtn"></a>' + $mobiLogo + $mobiMenu + '</div>');
	$('#menu-clone').hide();
	
	$(window).scroll(function(){
		var winScrollTop = $(window).scrollTop(),
			doc_height = $(document).height();
			
		if(winScrollTop > 150){
			$('#menu-clone').slideDown();
		}else{
			$('#menu-clone').slideUp();
		}
	});	
	
	$('#menu-clone > ul > li').hover(function(){
		$(this).addClass('active');
		$(this).addClass('active').find('ul').show().end().siblings().removeClass('active').find('ul').hide();
	});
	$('#menu-clone > ul > li').mouseleave(function(){
		$(this).removeClass('active');
		$(this).find('ul').hide();
	});
        
	//mobile menu
	
	$('header .wrapper').append('<a id="mobi-lbtn"></a>');	//add mobi-lbtn AL20160429
	$('body').after('<div id="mobi-menu">' + $mobiMenu + '</div>');	//add mobi-menu AL20160429
	$('#mobi-menu ul li').click(function(e) {
            $(this).find('ul').slideDown().end().siblings().find('ul').slideUp();
        });
	
	$('header .wrapper').append('<a id="mobi-rbtn"></a>');	//add mobi-rbtn AL20160429
	$('body').after('<div id="mobi-member">' + $mobiLogin + '<ul>' + $TopLink1 + '</ul><ul>' + $TopLink2 + '</ul><div id="btn3">' + $3Button + '</div></div>');	//add mobi-member
	$('#mobi-member').hide();
	$('#mobi-member ul:eq(1) li.login').hide();

	
	$('#mobi-lbtn , #header .container #mobi-lbtn').click(function(e) {
                $('#cover').fadeIn();
                $('#mobi-menu').animate({left:0},300);
                $('#all').css('position','fixed').animate({left:200},300);
                //$('body').css('overflow','hidden');
        });
	
	$('#mobi-rbtn , #header .container #mobi-rbtn').bind("click",function(){
                $('#cover').fadeIn();
                $('#mobi-member').show();
                $('#mobi-member').animate({right:0},300);
                $('#all').css('position','fixed').animate({left:-200},300);
                //$('body').css('overflow','hidden');
        });
	
	$('#cover').click(function(e) {
                    $(this).hide();
                    $('#mobi-menu').animate({left:-200},300);
                    $('#mobi-member').animate({right:-200},300);
                    $('#all').css('position','').animate({right:0},300);
                    $('body').css('overflow','');
                    $('#mobi-member, #report, #float-like').hide();
        });
	
        $(window).resize(function(e) {
                if($(window).width() > 768){
                        $('#cover').hide();
                        $('#direction-map').hide();
                        $('#mobi-menu').animate({left:-200},300);
                        $('#mobi-member').animate({right:-200},300);
                        $('#all').css('position','').animate({left:0},300);
                        $('body').css('overflow','');
                }
        });
	
	
	//float ad scroll show
	$('#float-ad').hide();
	$(window).scroll(function(){
		var winScrollTop = $(window).scrollTop();
			
		if(winScrollTop > 200){
			$('#float-ad').fadeIn();
		}else{
			$('#float-ad').fadeOut(800);
		}
	});
});