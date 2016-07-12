/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1
            abin ++ 2014.5.4
 **/
(function($) {
            $.view_image = $.view_image || {version:'0.0.1'};
            var view_image = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destory : function() {
                                        destory();
                                },
                                designer_init_image :function() {
                                        designer_init_image();
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
                                tmp_text();
                    }
                    
                    function destory() 
                    {
                            if(opts.target.attr("id") == "workbench") {
                                    opts.target.html("");
                            }
                    }
                    
                    function designer_init_image() 
                    {       
                            console.log(opts.target);
                            console.log(opts.mmobj);
                            if(opts.target.attr("id") == "workbench") {
                                    if( $("#workbench img")[0] == undefined ) {
                                            $("#workbench").append("<center><img></img></center>");
                                    }
                            }
                            opts.target.find("img").attr( "src" , opts.mmobj );
                    }
                    
                    function tmp_text()
                    {
                                opts.image_id++ ;
                                var tmp_id = "image_" + opts.image_id.toString();
                                while(true) {
                                    if($("#"+tmp_id)[0] == undefined) {
                                            break;
                                    }
                                    opts.image_id++;
                                    tmp_id = "image_" + opts.image_id.toString();
                                }
                                
                                $( ".demo #image_localhost" ).parent().attr( "tmp_id" , tmp_id );
                                $( ".demo #image_localhost" ).attr( "id" , tmp_id );
                                
                                opts.target = $("#"+tmp_id);
                                var mmobj = { source : "none" ,
                                               value  : "" ,
                                               imagealign : "center"};
                                mmobj = JSON.stringify(mmobj);
                                opts.target.attr("mmobj",mmobj);
                                var img = '<center> <img src="http://cdn.ypcall.com/Builder/PD/image/image01.jpg" class="img-circle"> </center>';
                                opts.target.append(img);
                    }
                   
            };//--view_image


            // jQuery plugin implementation
            $.fn.view_image = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_image");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                     : "aaa",
                            image_id               : 0,
                            alarm_data              : "",
                            alarm_state             : "",
                            yAxis                   : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_image(this, opts);
                            $(this).data("view_image", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);