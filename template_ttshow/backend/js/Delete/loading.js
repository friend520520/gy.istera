/*
            mmobj = [  { Content : "First" , Url : "" },
                        { Content : "Second" , Url : "" },
                        { Content : "Third" , Url : "" },
                        { Content : "Fourth" , Url : "" },
                        { Content : "Fifth" , Url : "" }];
*/
(function($) {
            $.view_loading = $.view_loading || {version:'0.0.1'};
            var view_loading = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destroy: function() {
                                        destroy();
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
                            
                            Ladda.bind( 'input[type=submit]' );
                            
                            $('#form-submit').unbind("click").bind("click", function(e){
                                    e.preventDefault();
                                    var l = Ladda.create(this);
                                    l.start();
                                    $.post("your-url", 
                                        { data : data },
                                      function(response){
                                        console.log(response);
                                      }, "json")
                                    .always(function() { l.stop(); });
                                    return false;
                            });
                            
                            
                            /*Ladda.bind( 'div:not(.progress-demo) button', { timeout: 2000 } );
                            // Bind progress buttons and simulate loading progress
                            Ladda.bind( '.progress-demo button', {
                                    callback: function( instance ) {

                                            var progress = 0;
                                            var interval = setInterval( function() {

                                                progress = Math.min( progress + Math.random() * 0.1, 1 );
                                                instance.setProgress( progress );

                                                if( progress === 1 ) {
                                                    instance.stop();
                                                    clearInterval( interval );
                                                    }

                                            }, 200 );
                                    }
                            }); */
                            
                    }
                    
                };//--view_loading


            // jQuery plugin implementation
            $.fn.view_loading = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_loading");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                     : "aaa",
                            loading_id               : 0,
                            alarm_data              : "",
                            alarm_state             : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_loading(this, opts);
                            $(this).data("view_loading", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
                    
                    
                    