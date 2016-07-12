/*
            abin ++ 2014.7.9
 **/
(function($) {
            $.process_iframe = $.process_iframe || {version:'0.0.1'};
            var process_iframe = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destory : function() {
                                        destory();
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
                            $("#myModalforiframe #myModalforiframeYes").unbind('click').bind( 'click' , function() {
                                    Save();
                            });
                            console.log(opts.target);
                            preinstall();
                    }
                    
                    function destory() 
                    {
                            //opts.target.html("");
                    }
                    
                    function init_html() 
                    {
                            
                    }
                    
                    function Save() {
                            var input = $("#myModalforiframe input[data-input=EVENT_Click]").val();
                            
                            if( input.search("http://") == -1 ) {
                                    input = "http://" + input;
                            }
                            
                            opts.target.attr( "src" , input );
                            /*
                            var prev = $("#myModalforPageNextPrevBody [data-input=prevpage]").val();
                            var next = $("#myModalforPageNextPrevBody [data-input=nextpage]").val();
                            if( prev.search("http://") == -1 ) {
                                    prev = "http://" + prev;
                            }
                            if( next.search("http://") == -1 ) {
                                    next = "http://" + next;
                            }
                            opts.target.find("[data-target=prev]").attr("onclick","location.href = '" + prev + "'" );
                            opts.target.find("[data-target=next]").attr("onclick","location.href = '" + next + "'");
                            */
                    }
                    
                    function preinstall() {
                        
                            $("#myModalforiframe #myModalforiframeTitle").html("Iframe");
                            $("#myModalforiframe #myModalforiframeBody label").html("Iframe Link Url ");
                        
                            var src = opts.target.attr( "src");
                            $("#myModalforiframe input[data-input=EVENT_Click]").val( src );
                            /*
                            var prev = opts.target.find("[data-target=prev]").attr("onclick").replace("location.href = '", "");
                            var next = opts.target.find("[data-target=next]").attr("onclick").replace("location.href = '", "");
                            prev = prev.substr( 0 , prev.length-1 );
                            next = next.substr( 0 , next.length-1 );
                            $("#myModalforPageNextPrevBody [data-input=prevpage]").val( prev );
                            $("#myModalforPageNextPrevBody [data-input=nextpage]").val( next );
                            */
                    }
            };//--process_iframe


            // jQuery plugin implementation
            $.fn.process_iframe = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("process_iframe");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                     : "aaa",
                            thumbnails_id               : 0,
                            alarm_data              : "",
                            alarm_state             : "",
                            yAxis                   : "",
                            publish                 : false ,
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new process_iframe(this, opts);
                            $(this).data("process_iframe", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);