/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1
*/
(function($) {
            $.view_destroy_determine = $.view_destroy_determine || {version:'0.0.1'};
            var view_destroy_determine = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                action_destroy_determine: function() {
                                        action_destroy_determine();
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
                                // init web destroy_determine
                                
                    }
                    /*
                     *  params : 0.3 0.3 0.6
                     *  lib    : higtchart
                     *  output : $( "p" )
                     *  auth   : Jack
                     */
                    function action_destroy_determine()
                    {
                            if($(opts.this).parent().children(".view").attr( "tmp_id" )!=null)
                            {
                                        if($(opts.this).parent().children(".view").attr( "tmp_id" ).search("line_localhost")==0) // 等於零是第一個字就找到
                                        {
                                                    $.View.view_line()._SetOpts({this : opts.this});
                                                    $.View.view_line().destory();
                                        }
                                        else if($(opts.this).parent().children(".view").attr( "tmp_id" ).search("column_localhost")==0)
                                        {
                                                    $.View.view_column()._SetOpts({this : opts.this});
                                                    $.View.view_column().destory();
                                        }
                                        else if($(opts.this).parent().children(".view").attr( "tmp_id" ).search("pie_localhost")==0)
                                        {
                                                    $.View.view_pie()._SetOpts({this : opts.this});
                                                    $.View.view_pie().destory();
                                        }
                                        else if($(opts.this).parent().children(".view").attr( "tmp_id" ).search("timeline_localhost")==0)
                                        {
                                                    $.View.view_timeline_h()._SetOpts({this : opts.this});
                                                    $.View.view_timeline_h().destory();
                                        }
                                        else if($(opts.this).parent().children(".view").attr( "tmp_id" ).search("map_localhost")==0)
                                        {
                                                    $.View.view_map()._SetOpts({this : opts.this});
                                                    $.View.view_map().destory();
                                        }
                            }
                    }
                    
            };//--view_destroy_determine


            // jQuery plugin implementation
            $.fn.view_destroy_determine = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_destroy_determine");
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
                            el = new view_destroy_determine(this, opts);
                            $(this).data("view_destroy_determine", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);