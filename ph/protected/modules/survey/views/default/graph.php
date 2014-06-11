<div id="container2" style="min-width: 350px; height: 350px; margin: 0 auto"></div>
<script type="text/javascript">
function setUpGraph(){
	log("setUpGraph");
	$('#container2').highcharts({
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false
	    },
	    title: {
	        text: 'Votes sur <?php echo $name?> '
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
	        name: 'Vote',
	        data: [
	            [ 'Vote Pour',   <?php echo $voteUpCount?> ],
	            [ 'Vote Contre',       <?php echo $voteDownCount?> ],
	            [ 'Abstention',    <?php echo $voteAbstainCount?> ]
	        ]
	    }]
	});
};
</script>