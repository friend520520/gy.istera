<!DOCTYPE HTML>
<html>

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highstock Example</title>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
        
        <script src="https://code.highcharts.com/stock/highstock.js"></script>
        <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
        
        <script type="text/javascript">
          
                $.highcharts_StockChart = [];
                function allpoint( symbol , securityExchange , connurl , foucs , foucs_index ) {

                        $.ajax({
                                type: 'Get',
                                url: connurl + 'api/Stocks',
                                dataType: "json",
                                data: {
                                        symbol: symbol,
                                        securityExchange: securityExchange
                                },
                                async: false,
                                success: function(data) {

                                        console.log(data);

                                        var data = data.Datas;

                                        // split the data set into ohlc and volume
                                        var ohlc = [],
                                                volume = [],
                                                dataLength = data.length,
                                                // set the allowed units for data grouping
                                                groupingUnits = [
                                                    ['minute',[1,5,15, 30]],  
                                                    ['hour',[1, 2,4]],  
                                                    ['day',[1]],  
                                                    ['week',[1]],  
                                                    ['month',[1]],  
                                                    ['year',[1]]  
                                                ],

                                                i = 0;

                                        for (i; i < dataLength; i += 1) {
                                                var index = dataLength - i - 1 ;
                                                ohlc.push([
                                                        new Date(data[index].MDEntryTime).getTime(), // the date
                                                        parseFloat(data[index].FirstPx), // open
                                                        parseFloat(data[index].HighPx), // high
                                                        parseFloat(data[index].LowPx), // low
                                                        parseFloat(data[index].Price), // close
                                                ]);

                                                volume.push([
                                                        new Date(data[index].MDEntryTime).getTime(), // the date
                                                        parseFloat(data[index].TotalVolumeTraded) // the volume
                                                ]);
                                        }


                                        // create the chart
                                        $.highcharts_StockChart[ foucs_index ] = foucs.highcharts('StockChart', {
                                                chart: {
                                                        events: {
                                                                load: function() {

                                                                        /*
                                                                        // set up the updating of the chart each second
                                                                        var series = this.series[0];
                                                                        setInterval(function () {
                                                                            var x = (new Date()).getTime(), // current time
                                                                                y = Math.round(Math.random() * 1000000000);

                                                                                console.log( [ x , 20.50 , 20.67 , 20.36 ,20.40 ,y] );
                                                                                // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                                                                                series.addPoint( [ x ,20.50,20.67,20.36,20.40,y], true, true);

                                                                        }, 1000);*/
        
                                                                        var tmp_focus_get = this.series[0].xAxis.getExtremes() ;
                                                                        var dMin = tmp_focus_get.dataMin;
                                                                        var dMax = tmp_focus_get.dataMax;
                                                                        var detla = parseInt( ( dMax - dMin ) / 2 );

                                                                        this.series[0].xAxis.setExtremes( dMax - detla , dMax );
                                                                        this.series[0].redraw();
                                                                        this.series[1].redraw();
        
                                                                }
                                                        }
                                                },

                                                rangeSelector: {
                                                        selected: 1
                                                },

                                                title: {
                                                        text: symbol + ' ' + securityExchange
                                                },

                                                yAxis: [{
                                                        labels: {
                                                                align: 'right',
                                                                x: -3
                                                        },
                                                        title: {
                                                                text: symbol
                                                        },
                                                        height: '80%',
                                                        lineWidth: 2,
                                                        plotLines: [{
                                                            value: 3100,
                                                            color: 'green',
                                                            dashStyle: 'shortdash',
                                                            width: 2,
                                                            label: {
                                                                text: 'Last quarter minimum'
                                                            }
                                                        }, {
                                                            value: 3060,
                                                            color: 'red',
                                                            dashStyle: 'shortdash',
                                                            width: 2,
                                                            label: {
                                                                text: 'Last quarter maximum'
                                                            }
                                                        }]
                                                }, {
                                                        labels: {
                                                                align: 'right',
                                                                x: -3
                                                        },
                                                        title: {
                                                                text: 'Volume'
                                                        },
                                                        top: '80%',
                                                        height: '20%',
                                                        offset: 0,
                                                        lineWidth: 2
                                                }],

                                                series: [{
                                                        type: 'candlestick',
                                                        name: symbol ,
                                                        data: ohlc,
                                                        dataGrouping: {
                                                                units: groupingUnits
                                                        }
                                                }, {
                                                        type: 'column',
                                                        name: 'Volume',
                                                        data: volume,
                                                        yAxis: 1,
                                                        dataGrouping: {
                                                                units: groupingUnits
                                                        }
                                                }]
                                        });

                                },
                                error: function() {
                                        alert("ERROR!!!");
                                }
                        });

                }
                
                function gettick( symbol , securityExchange , connurl , foucs , foucs_index ) {

                        $.ajax({
                                type: 'Get',
                                url: connurl + 'api/Stocks',
                                dataType: "json",
                                data: {
                                        symbol: symbol,
                                        securityExchange: securityExchange
                                },
                                async: false,
                                success: function(data) {

                                        console.log(data);

                                        var data = data.Datas;

                                        // split the data set into ohlc and volume
                                        var ohlc = [],
                                                volume = [],
                                                dataLength = data.length,
                                                // set the allowed units for data grouping
                                                groupingUnits = [
                                                    ['minute',[1,5,15, 30]],  
                                                    ['hour',[1, 2,4]],  
                                                    ['day',[1]],  
                                                    ['week',[1]],  
                                                    ['month',[1]],  
                                                    ['year',[1]]  
                                                ],

                                                i = 0;

                                        for (i; i < dataLength; i += 1) {
                                                var index = dataLength - i - 1 ;
                                                ohlc.push([
                                                        new Date(data[index].MDEntryTime).getTime(), // the date
                                                        parseFloat(data[index].FirstPx), // open
                                                        parseFloat(data[index].HighPx), // high
                                                        parseFloat(data[index].LowPx), // low
                                                        parseFloat(data[index].Price), // close
                                                ]);

                                                volume.push([
                                                        new Date(data[index].MDEntryTime).getTime(), // the date
                                                        parseFloat(data[index].TotalVolumeTraded) // the volume
                                                ]);
                                        }


                                        // create the chart
                                        $.highcharts_StockChart[ foucs_index ] = foucs.highcharts('StockChart', {
                                                chart: {
                                                        events: {
                                                                load: function() {

                                                                        /*
                                                                        // set up the updating of the chart each second
                                                                        var series = this.series[0];
                                                                        setInterval(function () {
                                                                            var x = (new Date()).getTime(), // current time
                                                                                y = Math.round(Math.random() * 1000000000);

                                                                                console.log( [ x , 20.50 , 20.67 , 20.36 ,20.40 ,y] );
                                                                                // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                                                                                series.addPoint( [ x ,20.50,20.67,20.36,20.40,y], true, true);

                                                                        }, 1000);*/
        
                                                                        var tmp_focus_get = this.series[0].xAxis.getExtremes() ;
                                                                        var dMin = tmp_focus_get.dataMin;
                                                                        var dMax = tmp_focus_get.dataMax;
                                                                        var detla = parseInt( ( dMax - dMin ) / 2 );

                                                                        this.series[0].xAxis.setExtremes( dMax - detla , dMax );
                                                                        this.series[0].redraw();
                                                                        this.series[1].redraw();
        
                                                                }
                                                        }
                                                },

                                                rangeSelector: {
                                                        selected: 1
                                                },

                                                title: {
                                                        text: symbol + ' ' + securityExchange
                                                },

                                                yAxis: [{
                                                        labels: {
                                                                align: 'right',
                                                                x: -3
                                                        },
                                                        title: {
                                                                text: symbol
                                                        },
                                                        height: '80%',
                                                        lineWidth: 2,
                                                        plotLines: [{
                                                            value: 3100,
                                                            color: 'green',
                                                            dashStyle: 'shortdash',
                                                            width: 2,
                                                            label: {
                                                                text: 'Last quarter minimum'
                                                            }
                                                        }, {
                                                            value: 3060,
                                                            color: 'red',
                                                            dashStyle: 'shortdash',
                                                            width: 2,
                                                            label: {
                                                                text: 'Last quarter maximum'
                                                            }
                                                        }]
                                                }, {
                                                        labels: {
                                                                align: 'right',
                                                                x: -3
                                                        },
                                                        title: {
                                                                text: 'Volume'
                                                        },
                                                        top: '80%',
                                                        height: '20%',
                                                        offset: 0,
                                                        lineWidth: 2
                                                }],

                                                series: [{
                                                        type: 'candlestick',
                                                        name: symbol ,
                                                        data: ohlc,
                                                        dataGrouping: {
                                                                units: groupingUnits
                                                        }
                                                }, {
                                                        type: 'column',
                                                        name: 'Volume',
                                                        data: volume,
                                                        yAxis: 1,
                                                        dataGrouping: {
                                                                units: groupingUnits
                                                        }
                                                }]
                                        });

                                },
                                error: function() {
                                        alert("ERROR!!!");
                                }
                        });

                }

                function addpoint() {
                        var chart = $.highcharts_StockChart[1].highcharts().series;

                        var x = (new Date()).getTime(), // current time
                                y = Math.round(Math.random() * 1000000000);

                        console.log([x, 20.50, 20.67, 20.36, 20.40, y]);
                        // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                        chart[0].addPoint([x, 520.50, 20.67, 20.36, 20.40, y], true, true);
                        chart[1].addPoint([x, 520.50, 20.67, 20.36, 20.40, y], true, true);


                        /*
                         * 

                        var time = healthdata.t;
                        var i=0;
                        $.each( healthdata , function(index, value) {
                                if( index != "t" ) {
                                        var series = chart.series[i];
                                        var obj = {
                                                name: index,
                                                x : time,
                                                y : parseFloat(healthdata[index])
                                        };
                                        series.addPoint( obj , false, false);
                                        i++;
                                }
                        });
                         * 
                         */
                }


                $(function() {

                        allpoint( 'SH000300' , 'SHSE' , "http://114.55.28.16:7845/" , $("#container") , 1 );
                        
                        $("#container").mousewheel( function(objEvent, intDelta) {
                        
                                    var tmp_focus_get = $.highcharts_StockChart[1].highcharts().series[0].xAxis.getExtremes() ;


                                    //var xMin = tmp_focus_get.userMin;    
                                    //var xMax = tmp_focus_get.userMax;
                                    var xMin = tmp_focus_get.min;
                                    var xMax = tmp_focus_get.max;

                                    var dMin = tmp_focus_get.dataMin;
                                    var dMax = tmp_focus_get.dataMax;

                                    if( $.delta == undefined || $.delta == 0 )
                                    {
                                    $.delta = parseInt( ( dMax - dMin ) / 1000 ) * 2 ;
                                    $.tmp_delta_level = 100 ; //Math.abs( intDelta ) ;
                                    }


                                    console.log( intDelta , $.delta );

                                    if( intDelta == 1 )
                                    {
                                                var tmp_x1 = ( xMin + ( $.delta * $.tmp_delta_level / 20  ) ) ;
                                                var tmp_x2 = ( xMax - ( $.delta * $.tmp_delta_level / 20 ) ) ;
                                                console.log( tmp_x1 , tmp_x2 );
                                                if( tmp_x1 < tmp_x2 )
                                                {
                                                $.highcharts_StockChart[1].highcharts().series[0].xAxis.setExtremes( tmp_x1 , tmp_x2 );
                                                //$.highcharts_StockChart[1].highcharts().series[1].xAxis.setExtremes( xMin + $.delta , xMax - $.delta );

                                                }

                                    }

                                    if( intDelta == -1 )
                                    {
                                                if( dMin > xMin - $.delta * $.tmp_delta_level )
                                                {
                                                            var tmp_x1 = dMin ;
                                                }else{
                                                            var tmp_x1 = xMin - $.delta ;
                                                }

                                                if( dMax < xMax + $.delta * $.tmp_delta_level )
                                                {
                                                            var tmp_x2 = dMax ;
                                                }else{
                                                            var tmp_x2 = xMax + $.delta ;
                                                }


                                                $.highcharts_StockChart[1].highcharts().series[0].xAxis.setExtremes( tmp_x1 , tmp_x2  );
                                                //$.highcharts_StockChart[1].highcharts().series[1].xAxis.setExtremes( tmp_x1 , tmp_x2  );
                                    }

                                                /*
                                    if ($.swipe_queue)
                                    clearInterval($.swipe_queue);
                                    $.swipe_queue = setTimeout(function() {
                                        

                                    }, 100);*/

                        });
                });

        </script>
</head>

<body>


        <div id="container" style="height: 800px; min-width: 310px"></div>
</body>

</html>