(function($) {
            $.view_trigger = $.view_trigger || {version:'0.0.1'};
            var view_trigger = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                action_trigger: function() {
                                        action_trigger();
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
                    }
                    
                    function action_trigger()
                    {
                                $.each( $.example_datatable.fnGetNodes() , function(index, value) {
                                            opts.VCOT_data[ index ] = $.example_datatable.fnGetData( this ) ;
                                });

                                get_datatables_for_timeline();
                                get_datatables_for_map();
                    }
                    
                    function get_datatables_for_timeline()
                    {
                                /*
                                var Time = opts.VCOT_data[ opts.Number ][1].split( "/" );
                                $.timeline_1.setVisibleChartRange( 
                                            new Date( Time[0], Time[1]-1, Time[2]-2, 0, 0, 0 ), 
                                            new Date( Time[0], Time[1]-1, parseInt(Time[2])+3, 0, 0, 0 ) 
                                );*/
                                if( $.timeline_1 != undefined )
                                $.timeline_1.setVisibleChartRange( 
                                            new Date( 2010 , 7 , 17 , 0, 0, 0 ), 
                                            new Date( 2010 , 8 ,  3 , 0, 0, 0 ) 
                                );

                                
                    }
                    
                    function get_datatables_for_map()
                    {
                                //       $.tmp_aaa = opts.VCOT_data[ opts.Number ][0];
                                
                                //if( opts.VCOT_data != undefined )
                                //var Data = opts.VCOT_data[ opts.Number ][3];
                            
                                //$.View.view_map()._SetOpts({ geocode : Data});
                                if( $.google_map != undefined )
                                {
                                            $.View.view_map()._SetOpts({ geocode : "台北市中正區" });
                                            $.View.view_map().geocode();
                                }

                    }
                    
                    
            };//--view_trigger


            // jQuery plugin implementation
            $.fn.view_trigger = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_trigger");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                    : "aaa",
                            trigger_id             : 0,
                            alarm_state            : "",
                            
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_trigger(this, opts);
                            $(this).data("view_trigger", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);