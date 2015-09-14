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
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2010'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]
            }]
        });



  
};
</script>