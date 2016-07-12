/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1

                                mmobj = [ { title : "Thumbnails01" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails01.jpg" } ,
                                             { title : "Thumbnails02" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails02.jpg" } ,
                                             { title : "Thumbnails03" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails03.jpg" }];

            abin ++ 2014.5.4
 **/
(function($) {
            $.view_thumbnails = $.view_thumbnails || {version:'0.0.1'};
            var view_thumbnails = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destory : function() {
                                        destory();
                                },
                                designer_init_thumbnails :function() {
                                        designer_init_thumbnails();
                                },
                                action_slides: function() {
                                        action_slides();
                                },
                                add_thumbnails : function() {
                                        add_thumbnails();
                                },
                                delete_thumbnails : function() {
                                        delete_thumbnails();
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
                            create();
                    }
                    
                    function destory() 
                    {
                            opts.target.html("");
                    }
                    
                    function designer_init_thumbnails() 
                    {       
                                var data = opts.mmobj;
                                data = data.list;
                                var div = '<div class="row"></div>';
                                opts.target.append(div);
                                var thumbnail = "";
                                for(var i = 0; i < data.length ; i++) {
                                    thumbnail = thumbnail + '<div class="col-sm-6 col-md-3" hassortable="false">\n\
                                                                    <div class="img-thumbnail">\n\
                                                                            <div class="photo img-responsive" index_num="247" index_pic="' + data[i].picture_url +  '" \n\
                                                                                    style="background-image: url(' + data[i].picture_url + '"></div>\n\
                                                                            <div class="caption">\n\
                                                                                    <h3>' + data[i].title    + '</h3>\n\
                                                                                    <p data-text="subtitle">'  + data[i].subtitle + '</p>\n\
                                                                            </div>\n\
                                                                    </div>\n\
                                                                    <br>\n\
                                                            </div>';
                                }
                                opts.target.find("div").append(thumbnail);    
                    }
                    
                    function create()
                    {
                                opts.thumbnails_id++ ;

                                var tmp_id = "media_thumbnails" + opts.thumbnails_id.toString();
                                while(true) {
                                    if($("#"+tmp_id)[0] == undefined) {
                                            break;
                                    }
                                    opts.thumbnails_id++ ;
                                    tmp_id = "media_thumbnails" + opts.thumbnails_id.toString();
                                }
                                
                                $( ".demo #thumbnails_localhost" ).parent().attr( "tmp_id" , tmp_id );
                                $( ".demo #thumbnails_localhost" ).attr( "id" , tmp_id );
                        
                                opts.target = $("#"+tmp_id);
                                //var mmobj = '{"source"  :"none" , "value" :"" , "skema" : {"image" : "" , "title": "" , "subtitle" :""} , "display" : [true,true,true,true] , "titlealign" : "center" , "subtitlealign" : "right" }';
                                var mmobj = { source : "none" ,
                                               value  : ""  ,
                                               display: [true,true,true,true] ,
                                               titlealign : "center" ,
                                               subtitlealign : "right" ,
                                               dropme : true };  
                                mmobj = JSON.stringify(mmobj);
                                
                                opts.target.attr("mmobj",mmobj);
                                var data = [ { title : "Thumbnails1" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails01.jpg" } ,
                                             { title : "Thumbnails2" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails02.jpg" } ,
                                             { title : "Thumbnails3" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails03.jpg" }];
                                var div = '<div class="row"></div>';
                                opts.target.append(div);
                                var thumbnail = "";

                                for(var i = 0; i < 3 ; i++) {
                                        thumbnail = thumbnail + '<div class="col-sm-6 col-md-3" hassortable="false">\n\
                                                                        <div class="img-thumbnail">\n\
                                                                                <div class="photo img-responsive" index_num="247" index_pic="' + data[i].picture_url +  '" \n\
                                                                                        style="background-image: url(' + data[i].picture_url + '"></div>\n\
                                                                                <div class="caption" contenteditable="true">\n\
                                                                                        <h3 style="text-align:center;">' + data[i].title    + '</h3>\n\
                                                                                        <p style="text-align:right;" data-text="subtitle">'  + data[i].subtitle + '</p>\n\
                                                                                </div>\n\
                                                                        </div>\n\
                                                                        <br>\n\
                                                                </div>';
                                }
                                opts.target.find("div").append(thumbnail);
                    }
                    /*
                    function add_thumbnails()
                    {
                            var number = opts.target.find("div.col-sm-6").length  %  3 + 1;
                            var number2 = opts.target.find("div.col-sm-6").length + 1;

                            opts.target.append('<div class="col-sm-6 col-md-3" hassortable="false">\n\
                                                        <div class="img-thumbnail">\n\
                                                                <div class="photo img-responsive" index_num="247" index_pic="http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails0' + number + '.jpg" \n\
                                                                        style="background-image: url(http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails0' + number + '.jpg"></div>' +
                                                                "<div class='caption' contenteditable=true>" +
                                                                        "<h3 style='text-align:center;' >Thumbnails" + number2 + "</h3>" +
                                                                        "<p style='text-align:right;' >2014.5.30</p>" +
                                                                "</div>" +
                                                        '</div>\n\
                                                        <br>\n\
                                                </div>' );
                    }
                   
                    function delete_thumbnails()
                    {
                            var children = opts.target.find("div.col-sm-6").length;
                            if(children > 0) {
                                    opts.target.find("div.col-sm-6")[children-1].remove();
                            }
                    }
                    */
            };//--view_thumbnails


            // jQuery plugin implementation
            $.fn.view_thumbnails = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_thumbnails");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                     : "aaa",
                            thumbnails_id               : 0,
                            alarm_data              : "",
                            alarm_state             : "",
                            yAxis                   : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_thumbnails(this, opts);
                            $(this).data("view_thumbnails", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
