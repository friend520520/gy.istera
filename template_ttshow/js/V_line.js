/*
 *      a bin ++ 2014.8.21.2100
 *      opts.target
 *      opts.data = 

*/ 
(function($) {
            $.V_line = $.V_line || {version:'0.0.1'};
            var V_line = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destroy: function() {
                                        destroy();
                                },
                                line_default : function() {
                                        line_default();
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
                            $('#sales-charts').html("");
                            
                            $('#sales-charts').highcharts({

                                    title: {
                                        text: 'line'
                                    },

                                    xAxis: {
                                        tickInterval: 1
                                    },

                                    yAxis: {
                                        type: 'logarithmic',
                                        minorTickInterval: 0.1
                                    },

                                    tooltip: {
                                        headerFormat: '<b>{series.name}</b><br />',
                                        pointFormat: 'x = {point.x}, y = {point.y}'
                                    },

                                    series: [{
                                        data: [1, 3, 4, 10, 11, 35, 70, 75, 125, 400],
                                        pointStart: 1
                                    }]
                            });
                    }
                    function destroy() 
                    {
                                opts.target.html( "" );
                            //opts.target.find("[type=line]").remove();
                    }
                    function line_default()
                    {
                            opts.target.append("<div type='line'></div>");
                            opts.target.find("[type=line]").highcharts('StockChart', {
                                    chart : {
                                            inputEnabled: $('#container').width() > 480,
                                            selected: 4,
                                            zoomType: 'x'
                                    },
                                    rangeSelector : {
                                        buttons : [
                                        {
                                            type : 'millisecond',
                                            count : 1000,
                                            text : '1ms'
                                        },
                                        {
                                            type : 'second',
                                            count : 60,
                                            text : '1s'
                                        },
                                        {
                                            type : 'hour',
                                            count : 1,
                                            text : '1h'
                                        }, {
                                            type : 'day',
                                            count : 1,
                                            text : '1D'
                                        }, {
                                            type : 'all',
                                            count : 1,
                                            text : 'All'
                                        }],
                                        selected : 1,
                                        inputEnabled : false
                                    },
                                    plotOptions: {
                                        series: {
                                                compare: 'percent'
                                        }
                                    },
                                    tooltip: {
                                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
                                        valueDecimals: 2
                                    },
                                    series : [{ name : "none" , data :[ [ 0 , 1 ] , [ 1 , 1 ] , [ 2 , 1 ] ] }]
                            });
                    }

            };

            // jQuery plugin implementation
            $.fn.V_line = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("V_line");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            target : "" ,
                            source : "" ,
                            skema : {} ,
                            create_:function(e,m,o){} ,
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new V_line(this, opts);
                            $(this).data("V_line", el);
                    });
                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
