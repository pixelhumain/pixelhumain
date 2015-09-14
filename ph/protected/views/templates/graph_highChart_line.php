<?php 
$cs = Yii::app()->getClientScript();
//$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://code.highcharts.com/highcharts.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://code.highcharts.com/modules/exporting.js' , CClientScript::POS_END);

?>
<style>

</style>



<div class="container graph">
    <br/>
    <div class="hero-unit">

<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div>
</div>


<script type="text/javascript"		>
initT['animInit'] = function(){

        $('#container2').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Historic World Population by Region'
            },
            subtitle: {
                text: 'Source: Wikipedia.org'
            },
            xAxis: {
                categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Population (millions)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' millions'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Year 1800',
                data: [107, 31, 635, 203, 2]
            }, {
                name: 'Year 1900',
                data: [133, 156, 947, 408, 6]
            }, {
                name: 'Year 2008',
                data: [973, 914, 4054, 732, 34]
            }]
        });

        $('#container4').highcharts({

            chart: {
                type: 'bubble',
                plotBorderWidth: 1,
                zoomType: 'xy'
            },

            title: {
                text: 'Highcharts bubbles with radial gradient fill'
            },

            xAxis: {
                gridLineWidth: 1
            },

            yAxis: {
                startOnTick: false,
                endOnTick: false
            },

            series: [{
                data: [
                    [9, 81, 63],
                    [98, 5, 89],
                    [51, 50, 73],
                    [41, 22, 14],
                    [58, 24, 20],
                    [78, 37, 34],
                    [55, 56, 53],
                    [18, 45, 70],
                    [42, 44, 28],
                    [3, 52, 59],
                    [31, 18, 97],
                    [79, 91, 63],
                    [93, 23, 23],
                    [44, 83, 22]
                ],
                marker: {
                     fillColor: {
                         radialGradient: { cx: 0.4, cy: 0.3, r: 0.7 },
                         stops: [
                             [0, 'rgba(255,255,255,0.5)'],
                             [1, 'rgba(69,114,167,0.5)']
                         ]
                     }
                }
            }, {
                data: [
                    [42, 38, 20],
                    [6, 18, 1],
                    [1, 93, 55],
                    [57, 2, 90],
                    [80, 76, 22],
                    [11, 74, 96],
                    [88, 56, 10],
                    [30, 47, 49],
                    [57, 62, 98],
                    [4, 16, 16],
                    [46, 10, 11],
                    [22, 87, 89],
                    [57, 91, 82],
                    [45, 15, 98]
                ],
                marker: {
                     fillColor: {
                         radialGradient: { cx: 0.4, cy: 0.3, r: 0.7 },
                         stops: [
                             [0, 'rgba(255,255,255,0.5)'],
                             [1, 'rgba(170,70,67,0.5)']
                         ]
                     }
                }
            }]

        });    


  
};
</script>