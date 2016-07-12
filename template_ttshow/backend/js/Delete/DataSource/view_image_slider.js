/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1
            abin ++ 2014.4.21
            var mmobj = '{"From":"none","URI":"none","value":{"list":[\n\
                                {"seq":0,"title":"Baseball","describe":"Baseballisakindofsticktoplayasthemainfeaturesofthecollective,confrontationalstrongballgamesintheUnitedStates,Japanisparticularlyprevalent.","picture_url":"img/1.jpg","time":"2014.4.16"},\n\
                                {"seq":1,"title":"Surfing","describe":"Surfing the waves are powered, using its own virtuosity and balance, a sport fighting the waves. Athlete standing on a surfboard, or use the web, kneeling boards, inflatable rubber mats, rowing, kayaking and other water sports to control a wave.","picture_url":"img/2.jpg","time":"2014.4.16"},\n\
                                {"seq":2,"title":"Bicycle","describe":"Bicycle riding competition as a tool to speed sport. 1896 was the first Olympic Games as an official event. Tour de France is the most famous World Cycling Championships.","picture_url":"img/3.jpg","time":"2014.4.16"}]}}';
*/
(function($) {
            $.view_image_slider = $.view_image_slider || {version:'0.0.1'};
            var view_image_slider = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destory : function() {
                                        destory();
                                },
                                designer_init_slider :function() {
                                        designer_init_slider();
                                },
                                action_slides: function() {
                                        action_slides();
                                },
                                options: function() {
                                        return opts;
                                },
                                _SetOpts: function( options ) {
                                        $.extend(opts,options);
                                }
                    });
                    
                    function init()
                    {
                                // init web slides
                                tmp_slides();
                    }
                    
                    function destory() 
                    {
                            opts.target.html("");
                            //opts.target.removeClass("carousel slide");
                    }
                    
                    function designer_init_slider() 
                    {
                            var slider_id = opts.target.attr("id");
                            slider_id = "active_" + slider_id;
                            opts.target.append("<div id='"+ slider_id +"'></div>");
                            opts.target = $("#" + slider_id);
                            opts.target.addClass('carousel slide');
                            opts.target.attr("data-ride","carousel");
                            
                            var data = opts.mmobj;
                            data = data.list;
                            
                            var ol = "" , div = "";
                            for(var i=0 ; i< data.length ; i++) {
                                    if(i == 0) {
                                            ol = "<li class='active' data-target='#" + slider_id + "' data-slide-to='0'></li>";
                                            div = "<div class='item active'> \n\
                                                            <img class='bohanModalimg' src='"+ data[0].picture_url +"' alt=''>" +
                                                            "<div contenteditable='false' class='carousel-caption'>" +
                                                                            "<h4>" + data[0].title + "</h4>" +
                                                                            "<p>" + data[0].subtitle + "</p>" +
                                                            "</div>" +
                                                    "</div>"; 
                                    }
                                    else if( i < 6 || i > (data.length -6) ) {
                                            ol = ol + "<li class='' data-target='#" + slider_id + "' data-slide-to='" + i + "'></li>";
                                            div = div + "<div class='item'> \n\
                                                            <img class='bohanModalimg' src='"+ data[i].picture_url +"' alt=''>" +
                                                            "<div contenteditable='false' class='carousel-caption'>" +
                                                                            "<h4>" + data[i].title + "</h4>" +
                                                                            "<p>" + data[i].subtitle + "</p>"  +
                                                            "</div>" +
                                                    "</div>"; 
                                    }
                                    else {
                                            ol = ol + "<li class='' data-target='#" + slider_id + "' data-slide-to='" + i + "'></li>";
                                            div = div + "<div class='item'> \n\
                                                            <img class='bohanModalimg' img_src='"+ data[i].picture_url +"' src='' alt=''>" +
                                                            "<div contenteditable='false' class='carousel-caption'>" +
                                                                            "<h4>" + data[i].title + "</h4>" +
                                                                            "<p>" + data[i].subtitle + "</p>"  +
                                                            "</div>" +
                                                    "</div>"; 
                                    }
                            }
                            ol = "<ol class='carousel-indicators'>" + ol + "</ol>";
                            div = "<div class='carousel-inner'>" + div + "</div>";
                            opts.target.append(
                                                ol + 
                                                div +
                                                "<a class='left carousel-control' href='#" + slider_id + "' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a> \n\
                                                 <a class='right carousel-control' href='#" + slider_id + "' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a>"
                            );
                            opts.target.carousel('reset');
                            opts.target.carousel('cycle');
                    }
                    
                    function action_slides()
                    {
                                opts.params = [ 0.3 , 0.3 , 0.4 ] ;
                                // init web slides
                                tmp_slides();
                                
                    }
                    
                    function tmp_slides()
                    {
                                opts.slides_id++ ;
                                /*
                                var id=""
                                if(opts.slides_id < 10) {
                                        id = "0"+opts.slides_id.toString();
                                }
                                else{
                                        id = opts.slides_id.toString();
                                }
                                */
                                var tmp_id = "slides_" +  opts.slides_id.toString();
                                while(true) {
                                    if($("#"+tmp_id)[0] == undefined) {
                                            break;
                                    }
                                    opts.slides_id++ ;
                                    tmp_id = "slides_" +  opts.slides_id.toString();
                                }
                                $( ".demo #slider_localhost" ).parent().attr( "tmp_id" , tmp_id );
                                
                                $( ".demo #slider_localhost" ).attr( "id" , tmp_id );
                                
                                var mmobj = '{"source"  :"none" , "value" :"" , "skema" : {"image" : "picture_url" , "title": "title" , "subtitle" :"subtitle"} , "display" : [false,true,false,false] , "interval": 5000 }';
                                
                                opts.target = $("#"+tmp_id);
                                destory();
                                opts.mmobj = mmobj;

                                var slider_id = opts.target.attr("id");
                                opts.target.addClass('carousel slide');
                                opts.target.attr("data-ride","carousel");
                                opts.target.attr("mmobj",mmobj);
                                
                                var data = [ { title : "ImageSlider01" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/imageslider/ImageSlider01.jpg" } ,
                                             { title : "ImageSlider02" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/imageslider/ImageSlider02.jpg" } ,
                                             { title : "ImageSlider03" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/imageslider/ImageSlider03.jpg" }];
                                var ol = "" , div = "";
                                for(var i=0 ; i< data.length ; i++) {
                                        if(i == 0) {
                                                ol = "<li class='active' data-target='#" + slider_id + "' data-slide-to='0'></li>";
                                                div = "<div class='item active'> \n\
                                                                <img class='bohanModalimg' src='"+ data[0].picture_url +"' alt=''>" +
                                                                "<div contenteditable='false' class='carousel-caption'>" +
                                                                                "<h4 style='visibility: hidden;'>" + data[0].title + "</h4>" +
                                                                                "<p  style='visibility: hidden;'>" + data[0].subtitle + "</p>" +
                                                                "</div>" +
                                                        "</div>"; 
                                        }
                                        else {
                                                ol = ol + "<li class='' data-target='#" + slider_id + "' data-slide-to='" + i + "'></li>";
                                                div = div + "<div class='item'> \n\
                                                                <img class='bohanModalimg' src='"+ data[i].picture_url +"' alt=''>" +
                                                                "<div contenteditable='false' class='carousel-caption'>" +
                                                                                "<h4 style='visibility: hidden;'>" + data[i].title + "</h4>" +
                                                                                "<p  style='visibility: hidden;'>" + data[i].subtitle + "</p>"  +
                                                                "</div>" +
                                                        "</div>"; 
                                        }
                                }
                                ol = "<ol style='visibility: hidden;' class='carousel-indicators'>" + ol + "</ol>";
                                div = "<div class='carousel-inner'>" + div + "</div>";
                                opts.target.append(
                                                    ol + 
                                                    div +
                                                    "<a class='left carousel-control' href='#" + slider_id + "' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a> \n\
                                                     <a class='right carousel-control' href='#" + slider_id + "' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a>"
                                );
                                opts.target.carousel('reset');
                                opts.target.carousel('cycle');
                    }
                    
            };//--view_image_slider


            // jQuery plugin implementation
            $.fn.view_image_slider = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_image_slider");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                     : "aaa",
                            slides_id               : 0,
                            alarm_data              : "",
                            alarm_state             : "",
                            yAxis                   : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_image_slider(this, opts);
                            $(this).data("view_image_slider", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
