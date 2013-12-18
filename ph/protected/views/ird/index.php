<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://code.highcharts.com/highcharts.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://code.highcharts.com/modules/exporting.js' , CClientScript::POS_END);
?>
<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
</style>

<div class="container graph">

    <br/>
    <div class="hero-unit">
        <h2>IRD : Historique des données recoltées</h2>
        <a class="entypo-left btn nextStat" href="javascript:statPanelIndex (-1)"></a> <a class="entypo-right  btn prevStat" href="javascript:statPanelIndex (1)"></a>
        
        <div class="clear"></div>
        <div id="graph" style="width:800px;">
            <div id="stats1" class="hide chart">
            	<div id="container3" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
            
            <div id="stats2"  class="hide chart">
            	<div id="container4" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
            
            <div id="stats3" class="hide chart">
            	<div id="container5" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
            
            <div id="stats4"  class="hide chart">
            	<div id="container6" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
            
            <div id="stats5"  class="hide chart">
            	<div id="container7" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
        
        
    </div>
    
</div>

<script type="text/javascript">

var statnum = $(".chart").length;
var statsPanelCount = $(".chart").length;
function statPanelIndex (step){
	$("#stats"+statnum).hide();
	$(".nextStat,.prevStat").show();
	if(statnum == statsPanelCount && step == 1)
		statnum = 1;
	else if ( statnum == 1 && step == -1 )
		statnum = statsPanelCount;
	else
		statnum = statnum + step;	
	
	$("#stats"+statnum).fadeIn(500);
}

initT['animInit'] = function(){
statPanelIndex (1);

//prepoaring graph data
<?php 
$years = array();
$counted = array();
$surf = array();
$chasse = array();
$nage = array();
$windsurf = array();
$kayak = array();
$autre = array();
$nodata = array();


$ct = 0;

foreach ($attacks as $a=>$v)
{
    if( isset($v["YEAR"]) ){
        if(!in_array($v["YEAR"],$counted))
	    {
	        $years[ $v["YEAR"] ] = array("total"=>0,"fatal"=>0,"nonfatal"=>0);
	        $surf[ $v["YEAR"] ] = array("total"=>0,"fatal"=>0,"nonfatal"=>0);
            $chasse[ $v["YEAR"] ] = array("total"=>0,"fatal"=>0,"nonfatal"=>0);
            $nage[ $v["YEAR"] ] = array("total"=>0,"fatal"=>0,"nonfatal"=>0);
            $windsurf[ $v["YEAR"] ] = array("total"=>0,"fatal"=>0,"nonfatal"=>0);
            $kayak[ $v["YEAR"] ] = array("total"=>0,"fatal"=>0,"nonfatal"=>0);
            $autre[ $v["YEAR"] ] = array("total"=>0,"fatal"=>0,"nonfatal"=>0);
            $nodata[ $v["YEAR"] ] = array("total"=>0,"fatal"=>0,"nonfatal"=>0);
	        array_push($counted,$v["YEAR"] );
	        
	    }
	    
	    $years[ $v["YEAR"] ]["total"] += 1;
	    if($v["FATAL"]=="Fatal") $years[ $v["YEAR"] ]["fatal"] +=1; else $years[ $v["YEAR"] ]["nonfatal"] +=1;
        
        if (strtolower($v["ACTIVITY CAT"]) == "surfing" ) {
            $surf[ $v["YEAR"] ]["total"] +=1;
            if($v["FATAL"]=="Fatal") $surf[ $v["YEAR"] ]["fatal"] +=1; else $surf[ $v["YEAR"] ]["nonfatal"] +=1;
        } else if (strtolower($v["ACTIVITY CAT"]) == "kayaking" ) {
             $kayak[ $v["YEAR"] ]["total"] +=1; 
             if($v["FATAL"]=="Fatal") $kayak[ $v["YEAR"] ]["fatal"] +=1; else $kayak[ $v["YEAR"] ]["nonfatal"] +=1;
        } else if (strtolower($v["ACTIVITY CAT"]) == "spearfishing" ) {
             $chasse[ $v["YEAR"] ]["total"] +=1; 
             if($v["FATAL"]=="Fatal") $chasse[ $v["YEAR"] ]["fatal"] +=1; else $chasse[ $v["YEAR"] ]["nonfatal"] +=1;
        } else if (strtolower($v["ACTIVITY CAT"]) == "swimming" ) {
             $nage[ $v["YEAR"] ]["total"] +=1; 
             if($v["FATAL"]=="Fatal") $nage[ $v["YEAR"] ]["fatal"] +=1; else $nage[ $v["YEAR"] ]["nonfatal"] +=1;
        } else if (strtolower($v["ACTIVITY CAT"]) == "windsurfing" ) {
             $windsurf[ $v["YEAR"] ]["total"] +=1; 
             if($v["FATAL"]=="Fatal") $windsurf[ $v["YEAR"] ]["fatal"] +=1; else $windsurf[ $v["YEAR"] ]["nonfatal"] +=1;
        } else if (strtolower($v["ACTIVITY CAT"]) == "running" ) {
             $autre[ $v["YEAR"] ]["total"] +=1; 
             if($v["FATAL"]=="Fatal") $autre[ $v["YEAR"] ]["fatal"] +=1; else $autre[ $v["YEAR"] ]["nonfatal"] +=1;
        } else  {
            $nodata[ $v["YEAR"] ]["total"] +=1;
            if($v["FATAL"]=="Fatal") $nodata[ $v["YEAR"] ]["fatal"] +=1; else $nodata[ $v["YEAR"] ]["nonfatal"] +=1;
        }
    }
}
sort($counted,SORT_NUMERIC );
array_reverse($counted);
$yearLabels = "";
foreach ($counted as $y){
    $yearLabels .= ($ct > 0 ) ? ",'".$y."'" :"'".$y."'";
    $ct++;
}

$yearCount = $fatalCount = $nonfatalCount = 
$surfCount = $chasseCount = $nageCount = $windsurfCount = $kayakCount = $autreCount = $nodataCount = 
$surfFatalCount = $chasseFatalCount = $nageFatalCount = $windsurfFatalCount = $kayakFatalCount = $autreFatalCount = $nodataFatalCount = 
$surfNonFatalCount = $chasseNonFatalCount = $nageNonFatalCount = $windsurfNonFatalCount = $kayakNonFatalCount = $autreNonFatalCount = "";

foreach ( $counted as $y )
{
    $yearCount .= ($yearCount != "") ? ",".$years[$y]["total"] : $years[$y]["total"] ;
    $fatalCount .= ($fatalCount != "") ? ",".$years[$y]["fatal"] : $years[$y]["fatal"] ;
    $nonfatalCount .= ($nonfatalCount != "") ? ",".$years[$y]["nonfatal"] : $years[$y]["nonfatal"] ;
    
    $surfCount .= ($surfCount != "") ? ",".$surf[$y]["total"] : $surf[$y]["total"] ;
    $chasseCount .= ($chasseCount != "") ? ",".$chasse[$y]["total"] : $chasse[$y]["total"] ;
    $nageCount .= ($nageCount != "") ? ",".$nage[$y]["total"] : $nage[$y]["total"] ;
    $windsurfCount .= ($windsurfCount != "") ? ",".$windsurf[$y]["total"] : $windsurf[$y]["total"] ;
    $kayakCount .= ($kayakCount != "") ? ",".$kayak[$y]["total"] : $kayak[$y]["total"] ;
    $autreCount .= ($autreCount != "") ? ",".$autre[$y]["total"] : $autre[$y]["total"] ;
    $nodataCount .= ($nodataCount != "") ? ",".$nodata[$y]["total"] : $nodata[$y]["total"] ;
    
    $surfFatalCount += $surf[$y]["fatal"] ;
    $chasseFatalCount += $chasse[$y]["fatal"] ;
    $nageFatalCount += $nage[$y]["fatal"] ;
    $windsurfFatalCount += $windsurf[$y]["fatal"] ;
    $kayakFatalCount += $kayak[$y]["fatal"] ;
    $autreFatalCount += $autre[$y]["fatal"] ;
    
    
    $surfNonFatalCount += $surf[$y]["nonfatal"] ;
    $chasseNonFatalCount += $chasse[$y]["nonfatal"] ;
    $nageNonFatalCount += $nage[$y]["nonfatal"] ;
    $windsurfNonFatalCount += $windsurf[$y]["nonfatal"] ;
    $kayakNonFatalCount += $kayak[$y]["nonfatal"] ;
    $autreNonFatalCount += $autre[$y]["nonfatal"] ;
}

$sportFatalCount = $surfFatalCount.",".$kayakFatalCount.",".$chasseFatalCount.",".$nageFatalCount.",".$windsurfFatalCount.",".$autreFatalCount;
$sportNonFatalCount = $surfNonFatalCount.",".$kayakNonFatalCount.",".$chasseNonFatalCount.",".$nageNonFatalCount.",".$windsurfNonFatalCount.",".$autreNonFatalCount;

?>

yearLabels = [<?php echo $yearLabels ?>];
yearCount = [<?php echo $yearCount ?>];
fatalCount = [<?php echo $fatalCount ?>];
nonfatalCount = [<?php echo $nonfatalCount ?>];

surfCount = [<?php echo $surfCount ?>];
chasseCount = [<?php echo $chasseCount ?>];
nageCount = [<?php echo $nageCount ?>];
windsurfCount = [<?php echo $windsurfCount ?>];
kayakCount = [<?php echo $kayakCount ?>];
autreCount = [<?php echo $autreCount ?>];
nodataCount = [<?php echo $nodataCount ?>];

sportFatalCount = [<?php echo $sportFatalCount ?>];
sportNonFatalCount = [<?php echo $sportNonFatalCount ?>];

//console.log(fatalCount,nonfatalCount);

$('#container3').highcharts({
    chart: {
        type: 'column',
        margin: [ 50, 50, 100, 80]
    },
    title: {
        text: "Nombre d'attaques par an"
    },
    xAxis: {
        categories: yearLabels,
        labels: {
            rotation: -45,
            align: 'right',
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: '<b>{point.y:.1f} Attaque(s)</b>',
    },
    series: [{
        name: 'Attaque(s)',
        data: yearCount,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            x: 4,
            y: 10,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif',
                textShadow: '0 0 3px black'
            }
        }
    }]
});


<?php 
$depuis = 1980;
$ct = 0;
$fiveYearLabels = "";
$fiveYearCount = "";
$cumul = 0;
for( $ix = 1980; $ix < date('Y'); $ix++ )
{
    if(isset($years[$ix]))
    {
        $cumul += $years[$ix]["total"]; 
        
    }
    if($ix > $depuis + 3)
    {
        $fiveYearLabels .= ($fiveYearLabels != "" ) ? ",'".$depuis."-".$ix."'" : "'".$depuis."-".$ix."'";
        $fiveYearCount .= ($fiveYearCount != "" ) ? ",".$cumul."" : $cumul;
        $cumul = 0;
        $depuis += 4;
        $ct++;
    }
}
?>
fiveYearLabels = [<?php echo $fiveYearLabels;?>];
fiveYearCount = [<?php echo $fiveYearCount;?>];

$('#container4').highcharts({
    chart: {
        type: 'column',
        margin: [ 50, 50, 100, 80]
    },
    title: {
        text: "Nombre d'attaques par 5 ans"
    },
    xAxis: {
        categories: fiveYearLabels,
        labels: {
            rotation: -45,
            align: 'right',
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: '<b>{point.y:.1f} Attaque(s)</b>',
    },
    series: [{
        name: 'Attaque(s)',
        data: fiveYearCount,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            x: 4,
            y: 10,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif',
                textShadow: '0 0 3px black'
            }
        }
    }]
});

$('#container5').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: 'Attaque Fatale - Non fatale par année'
    },
    xAxis: {
        categories: yearLabels
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total fruit consumption'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    legend: {
        align: 'right',
        x: -70,
        verticalAlign: 'top',
        y: 20,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        formatter: function() {
            return '<b>'+ this.x +'</b><br/>'+
                this.series.name +': '+ this.y +'<br/>'+
                'Total: '+ this.point.stackTotal;
        }
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
    series: [{
        name: 'Fatale',
        data: fatalCount
    }, {
        name: 'Non-Fatale',
        data: nonfatalCount
    }]
});


$('#container6').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: 'Distribution des attaques par sport'
    },
    xAxis: {
        categories: yearLabels
    },
    yAxis: {
        min: 0,
        title: {
            text: "Nombres d'attaques"
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    legend: {
        align: 'right',
        x: -70,
        verticalAlign: 'top',
        y: 20,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        formatter: function() {
            return '<b>'+ this.x +'</b><br/>'+
                this.series.name +': '+ this.y +'<br/>'+
                'Total: '+ this.point.stackTotal;
        }
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },

    series: [{
        name: 'surfing',
        data: surfCount
    }, {
        name: 'kayaking',
        data: nonfatalCount
    },
    {
        name: 'spearfishing',
        data: chasseCount
    },
    {
        name: 'swimming',
        data: nageCount
    },
    {
        name: 'windsurfing',
        data: windsurfCount
    },
    {
        name: 'autre',
        data: autreCount
    },
    {
        name: 'no Data',
        data: nodataCount
    }
    ]
});


$('#container7').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: 'Attaque Fatale - Non fatale par sport'
    },
    xAxis: {
        categories: ['surf & body','kayaking','spearfishing','swimming','windsurfing','autre']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total fruit consumption'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    legend: {
        align: 'right',
        x: -70,
        verticalAlign: 'top',
        y: 20,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        formatter: function() {
            return '<b>'+ this.x +'</b><br/>'+
                this.series.name +': '+ this.y +'<br/>'+
                'Total: '+ this.point.stackTotal;
        }
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
    series: [{
        name: 'Fatale',
        data: sportFatalCount
    }, {
        name: 'Non-Fatale',
        data: sportNonFatalCount
    }]
});


};
</script>	
<?php //var_dump($years)?>		