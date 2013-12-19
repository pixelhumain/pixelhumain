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
            
            <div id="stats6"  class="hide chart">
            	<div id="container8" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
            
            <div id="stats7"  class="hide chart">
            	<div id="container9" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
            
            <div id="stats8"  class="hide chart">
            	<div id="container10" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
         <div class="clear"></div>
        <a class="entypo-left btn nextStat" href="javascript:statPanelIndex (-1)"></a> <a class="entypo-right  btn prevStat" href="javascript:statPanelIndex (1)"></a>
        
        
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

$people = array("fatal"=>array(0,0,0,0,0),"nonfatal"=>array(0,0,0,0,0));
$month = array("fatal"=>array(0,0,0,0,0,0,0,0,0,0,0,0),"nonfatal"=>array(0,0,0,0,0,0,0,0,0,0,0,0));
$timehour = array("fatal"=>array(0,0,0,0,0,0,0,0,0,0,0,0,0,0),"nonfatal"=>array(0,0,0,0,0,0,0,0,0,0,0,0,0,0));

$ct = 0;

foreach ($attacks as $a=>$v)
{
    if( isset($v["YEAR"]) )
    {
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
        
        //['Alone','2 to 4','5 to 10','>10','No Data']
        if($v["PEOPLE IN WATER"] == 1){
            if($v["FATAL"]=="Fatal") $people["fatal"][0] +=1;
            else $people["nonfatal"][0] +=1;
        } else if( in_array($v["PEOPLE IN WATER"], array(2,3,4)) ){
            if($v["FATAL"]=="Fatal") $people["fatal"][1] +=1;
            else $people["nonfatal"][1] +=1;
        } else if( in_array($v["PEOPLE IN WATER"], array(5,6,7,8,9,10)) ){
            if($v["FATAL"]=="Fatal") $people["fatal"][2] +=1;
            else $people["nonfatal"][2] +=1;
        } else if( $v["PEOPLE IN WATER"] > 10 ){
            if($v["FATAL"]=="Fatal") $people["fatal"][3] +=1;
            else $people["nonfatal"][3] +=1;
        } else {
            if($v["FATAL"]=="Fatal") $people["fatal"][4] +=1;
            else $people["nonfatal"][4] +=1;
        } 
        
        //['Jan','Fev','Mars','Avril','Mai','Juin','Juil','Aout','Sep','Oct','Nov','Dec']
        if($v["FATAL"]=="Fatal") $month["fatal"][intval($v["MONTH"])-1] +=1;
        else $month["nonfatal"][intval($v["MONTH"])-1] +=1;
        
        //['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24']
        if($v["TIME ROUNDED"] != "ND"){
            if($v["FATAL"]=="Fatal") $timehour["fatal"][intval($v["TIME ROUNDED"])-6] +=1;
            else $timehour["nonfatal"][intval($v["TIME ROUNDED"])-6] +=1;
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

$ct = 0;
$sep = "";
foreach ( $counted as $y )
{
    if($ct > 0)$sep = ",";
    $yearCount .= $sep.$years[$y]["total"] ;
    $fatalCount .= $sep.$years[$y]["fatal"] ;
    $nonfatalCount .= $sep.$years[$y]["nonfatal"] ;
    
    $surfCount .= $sep.$surf[$y]["total"] ;
    $chasseCount .= $sep.$chasse[$y]["total"] ;
    $nageCount .= $sep.$nage[$y]["total"] ;
    $windsurfCount .= $sep.$windsurf[$y]["total"] ;
    $kayakCount .= $sep.$kayak[$y]["total"] ;
    $autreCount .= $sep.$autre[$y]["total"] ;
    $nodataCount .= $sep.$nodata[$y]["total"] ;
    $ct++; 
    
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

peopleFatalCount = [<?php echo implode(",", $people["fatal"]) ?>];
peopleNonFatalCount = [<?php echo implode(",", $people["nonfatal"]) ?>];

monthFatalCount = [<?php echo implode(",", $month["fatal"]) ?>];
monthNonFatalCount = [<?php echo implode(",", $month["nonfatal"]) ?>];

timehourFatalCount = [<?php echo implode(",", $timehour["fatal"]) ?>];
timehourNonFatalCount = [<?php echo implode(",", $timehour["nonfatal"]) ?>];
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


$('#container8').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: "Attaque Fatale - Non fatale par nombre de personne dans l'eau"
    },
    xAxis: {
        categories: ['Alone','2 to 4','5 to 10','>10','No Data']
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
        data: peopleFatalCount
    }, {
        name: 'Non-Fatale',
        data: peopleNonFatalCount
    }]
});

$('#container9').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: "Attaque Fatale - Non fatale par mois"
    },
    xAxis: {
        categories: ['Jan','Fev','Mars','Avril','Mai','Juin','Juil','Aout','Sep','Oct','Nov','Dec']
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
        data: monthFatalCount
    }, {
        name: 'Non-Fatale',
        data: monthNonFatalCount
    }]
});

$('#container10').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: "Attaque Fatale - Non fatale par Heure"
    },
    xAxis: {
        categories: ['6h','7h','8h','9h','10h','11h','12h','13h','14h','15h','16h','17h','18h','19h']
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
        data: timehourFatalCount
    }, {
        name: 'Non-Fatale',
        data: timehourNonFatalCount
    }]
});


};
</script>	
<?php //var_dump($years)?>		