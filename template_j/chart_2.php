<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Highstock Example</title>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style type="text/css">
        $ {
            demo.css
        }
    </style>
    <script type="text/javascript">

        $.Ajax = function ( type , url , data , data2 , back , error_back)
        {
                   if( error_back == "" ) {
                           error_back = function(e) { console.log(e); };
                   }
                   $.ajax({
                               type : type ,
                               url : url ,
                               async: true ,
                               data : data ,
                               data2 : data2 ,
                               success : back ,
                               error : error_back
                   });
        }

        function allpoint()
        {
                var symbol = 'SH000300';
                var securityExchange = 'SHSE';
                var connurl = "http://114.55.28.16:7845/" ;
            
                $.ajax({
                    type: 'Get',
                    url: connurl + 'api/Stocks',
                    dataType: "json",
                    data: {
                        symbol: symbol,
                        securityExchange: securityExchange
                    },
                    async: false,
                    success: function (data) {
                        
                        console.log( data );
                                var data = JSON.parse( data ).Datas ;
                                
                                // split the data set into ohlc and volume
                                var ohlc = [],
                                    volume = [],
                                    dataLength = data.length,
                                    // set the allowed units for data grouping
                                    groupingUnits = [
                                        [
                                            'week', // unit name
                                            [1] // allowed multiples
                                        ],
                                        [
                                            'month', [1, 2, 3, 4, 6]
                                        ]
                                    ],

                                    i = 0;

                                for (i; i < dataLength; i += 1) {
                                    ohlc.push([
                                        new Date( data[i].MDEntryTime ).getTime(), // the date
                                        parseFloat( data[i].FirstPx ), // open
                                        parseFloat( data[i].HighPx ), // high
                                        parseFloat( data[i].LowPx ), // low
                                        parseFloat( data[i].Price ), // close
                                    ]);

                                    volume.push([
                                        new Date( data[i].MDEntryTime ).getTime(), // the date
                                        parseFloat( data[i].TotalVolumeTraded ) // the volume
                                    ]);
                                }


                                // create the chart
                                $.highcharts_StockChart = $('#container').highcharts('StockChart', {
                                    chart : {
                                                events : {
                                                    load : function () {

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
                                                    }
                                                }
                                            },

                                    rangeSelector: {
                                        selected: 1
                                    },

                                    title: {
                                        text: 'AAPL Historical'
                                    },

                                    yAxis: [{
                                        labels: {
                                            align: 'right',
                                            x: -3
                                        },
                                        title: {
                                            text: 'OHLC'
                                        },
                                        height: '60%',
                                        lineWidth: 2
                                    }, {
                                        labels: {
                                            align: 'right',
                                            x: -3
                                        },
                                        title: {
                                            text: 'Volume'
                                        },
                                        top: '65%',
                                        height: '35%',
                                        offset: 0,
                                        lineWidth: 2
                                    }],

                                    series: [{
                                        type: 'candlestick',
                                        name: 'AAPL',
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

                        /*
                        var now = new Date();
                        var markdata = data.Datas;
                        var tmpArray = [];
                        for (var i = 0; i < markdata.length; i++) {
                            var high = markdata[i].HighPx;
                            var low = markdata[i].LowPx;
                            var open = markdata[i].FirstPx;
                            var close = markdata[i].Price;
                            var time = new Date(markdata[i].MDEntryTime)
                            var volume = markdata[i].TotalVolumeTraded;
                            var kTick = KTick.createWithFullData(periodType, open, high, low, close, time, volume, Math.random() > .98)
                            tmpArray.splice(0, 0, kTick);
                            now -= periodType == 'm1' ? 60 * 60000 : 60000; // h1 or m1
                        }
                        wrapper_.getKChart().appendKTicks(tmpArray);*/
                    },
                    error: function () {
                        alert("ERROR!!!");
                    }
                });

        }

        function addpoint()
        {
                    var chart = $.highcharts_StockChart.highcharts().series ;
                    
                    var x = (new Date()).getTime(), // current time
                        y = Math.round(Math.random() * 1000000000);

                        console.log( [ x , 20.50 , 20.67 , 20.36 ,20.40 ,y] );
                        // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                        chart[0].addPoint( [ x ,520.50 ,20.67 ,20.36 ,20.40 ,y], true, true);
                        chart[1].addPoint( [ x ,520.50 ,20.67 ,20.36 ,20.40 ,y], true, true);
                        
                    
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
            
                var data = {
                };
                var success_back = function( data ) {
                            
                                var data = JSON.parse( data ).Datas ;
                                
                                // split the data set into ohlc and volume
                                var ohlc = [],
                                    volume = [],
                                    dataLength = data.length,
                                    // set the allowed units for data grouping
                                    groupingUnits = [
                                        [
                                            'week', // unit name
                                            [1] // allowed multiples
                                        ],
                                        [
                                            'month', [1, 2, 3, 4, 6]
                                        ]
                                    ],

                                    i = 0;

                                for (i; i < dataLength; i += 1) {
                                    ohlc.push([
                                        new Date( data[i].MDEntryTime ).getTime(), // the date
                                        parseFloat( data[i].FirstPx ), // open
                                        parseFloat( data[i].HighPx ), // high
                                        parseFloat( data[i].LowPx ), // low
                                        parseFloat( data[i].Price ), // close
                                    ]);

                                    volume.push([
                                        new Date( data[i].MDEntryTime ).getTime(), // the date
                                        parseFloat( data[i].TotalVolumeTraded ) // the volume
                                    ]);
                                }


                                // create the chart
                                $.highcharts_StockChart = $('#container').highcharts('StockChart', {
                                    chart : {
                                                events : {
                                                    load : function () {

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
                                                    }
                                                }
                                            },

                                    rangeSelector: {
                                        selected: 1
                                    },

                                    title: {
                                        text: 'AAPL Historical'
                                    },

                                    yAxis: [{
                                        labels: {
                                            align: 'right',
                                            x: -3
                                        },
                                        title: {
                                            text: 'OHLC'
                                        },
                                        height: '60%',
                                        lineWidth: 2
                                    }, {
                                        labels: {
                                            align: 'right',
                                            x: -3
                                        },
                                        title: {
                                            text: 'Volume'
                                        },
                                        top: '65%',
                                        height: '35%',
                                        offset: 0,
                                        lineWidth: 2
                                    }],

                                    series: [{
                                        type: 'candlestick',
                                        name: 'AAPL',
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
                                

                }
                var error_back = function( data ) {
                        console.log(data);
                }
                $.Ajax( "POST" , "plugin/data10.php" , data , "" , success_back , error_back);
                
                
        });
    </script>
</head>

<body>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


    <div id="container" style="height: 400px; min-width: 310px"></div>
</body>

</html>