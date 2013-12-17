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
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'Browser<br>shares',
                align: 'center',
                verticalAlign: 'middle',
                y: 50
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white',
                            textShadow: '0px 1px 2px black'
                        }
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%']
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                innerSize: '50%',
                data: [
                    ['Firefox',   45.0],
                    ['IE',       26.8],
                    ['Chrome', 12.8],
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]
            }]
        });



  
};
</script>