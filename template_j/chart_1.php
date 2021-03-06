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
        $(function() {
            
            $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function(data) {

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
                        data[i][0], // the date
                        data[i][1], // open
                        data[i][2], // high
                        data[i][3], // low
                        data[i][4] // close
                    ]);

                    volume.push([
                        data[i][0], // the date
                        data[i][5] // the volume
                    ]);
                }


                // create the chart
                $('#container').highcharts('StockChart', {
                    chart : {
                                events : {
                                    load : function () {

                                        // set up the updating of the chart each second
                                        var series = this.series[0];
                                        setInterval(function () {
                                            var x = (new Date()).getTime(), // current time
                                                y = Math.round(Math.random() * 1000000000);
                                                
                                                console.log( [ x , 20.50 , 20.67 , 20.36 ,20.40 ,y] );
                                                // console.log( [1246406400000,20.50,20.67,20.36,20.40,103568150] );
                                                series.addPoint( [ x ,20.50,20.67,20.36,20.40,y], true, true);
                                                
                                        }, 1000);
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
                
            });
        });
    </script>
</head>

<body>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


    <div id="container" style="height: 400px; min-width: 310px"></div>
</body>

</html>