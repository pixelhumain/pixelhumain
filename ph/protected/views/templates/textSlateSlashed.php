<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Josefin+Sans);

* { box-sizing: border-box; }

body{

  font-family:'Josefin Sans', Arial, "Trebuchet MS", sans-serif;
  background-color:#282e3a;
}

#reloj{
  position:relative;
  display:block;
  color:gray;
  font-size:30px;
  background: rgb(0,0,0);
  background: rgb(0,0,0) linear-gradient(140deg, rgba(0,0,0,0) 50%, rgba(255,255,255,0.05) 50%, rgba(255,255,255,0.0) 100%);
  width:550px;
  padding:70px;
  margin:0 auto;
  transition:background-color 0.5s linear;
}

#letras{
   display:inline-block;
   line-height:41px;
   text-align:center;
   transition:all 0.5s linear;
}
#letras{
    width:35px;
}

#f1,#f2,#f3,#f4{ 
    position:absolute;
    color:gray;    
    font-size:15px;
}
#f1, #f2{
  top:15px;
}
#f3, #f2{
  right:25px;
}
#f1, #f4{
  left:25px;
}
#f3, #f4{
  bottom:20px;
}
</style>
<div id="reloj">
<div class="letras">
 <span id="es"> E S </span> 
 <span> D X</span>
 <span id="son"> S O N </span>
 <span> F </span>
 <span id="la"> L A </span>
  <span id="s">S</span>
 <span id="1"> U N A </span><br>
 <span id="2"> D O S</span>
 <span> I D F X</span>
 <span id="3"> T R E S </span> 
  <span> O R E F </span><br>
 <span id="4"> C U A T R O</span>
  <span> L X R I</span>
 <span id="5">C I N C O</span>  
 <br>
 <span id="6">S E I S</span>
 <span> B N D I</span>
 <span id="7"> S I E T E</span> 
 <span> I</span>
 <span> L I S</span> <br> 
 <span id="8">O C H O</span>
 <span> E R U K</span>
 <span id="9">N U E V E</span>
 <span id="y"> Y </span><br>
 <span> L A </span>
 <span id="10">D I E Z</span>
 <span >L K F I E</span>
 <span id="11"> O N C E</span><br>
 <span id="12">D O C E</span>
 <span>D X F R T</span>
 <span id="men">M E N O S</span><br>
  <span> O </span>
 <span id="20">V E I N T E</span>
  <span> L K I S I  </span>
 <span id="die">D I E Z</span><br>
 <span>T W</span>
 <span id="25">V E I N T I </span>
 <span id="cin">C I N C O</span>
 <span>E Q</span><br>
 <span id="med"> M E D I A</span>
 <span>K C V J </span>
   <span id="cuarto">C U A R T O</span><br>
   <span id="f1">●</span>
   <span id="f2">●</span>
   <span id="f3">‌●</span>
   <span id="f4">‌●</span> 
</div>
</div>

<br/>

<script type="text/javascript"		>
initT['animInit'] = function(){
	function reloj(){
		var min, hr;
		min = new Date();
		hr = new Date();

		var m = min.getMinutes();
		var h = hr.getHours();
		  var foc=0;
		 foc = m%10;
		//prendiendo los focos
		 if((foc==1)||(foc==6)){
		document.getElementById('f4').style.color="gray";
		document.getElementById('f3').style.color="gray";
		document.getElementById('f2').style.color="gray";   document.getElementById('f1').style.color="white";
		document.getElementById('f1').style.textShadow="0px 0px 5px #fff";
		 }
		 else if((foc==2)||(foc==7)){
		   document.getElementById('f4').style.color="gray";
		document.getElementById('f3').style.color="gray";
		document.getElementById('f2').style.color="white";   document.getElementById('f1').style.color="white";
		document.getElementById('f1').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('f2').style.textShadow="0px 0px 5px #fff";
		 }
		 else if((foc==3)||(foc==8)){
		   document.getElementById('f4').style.color="gray";
		document.getElementById('f3').style.color="white";
		document.getElementById('f2').style.color="white";   document.getElementById('f1').style.color="white";
		document.getElementById('f1').style.textShadow="0px 0px 5px #fff";
		document.getElementById('f2').style.textShadow="0px 0px 5px #fff";
		document.getElementById('f3').style.textShadow="0px 0px 5px #fff";
		 }
		 else if((foc==4)||(foc==9)){
		   document.getElementById('f4').style.color="white";
		document.getElementById('f3').style.color="white";
		document.getElementById('f2').style.color="white";   document.getElementById('f1').style.color="white";
		document.getElementById('f1').style.textShadow="0px 0px 5px #fff";
		document.getElementById('f2').style.textShadow="0px 0px 5px #fff";
		document.getElementById('f3').style.textShadow="0px 0px 5px #fff";
		document.getElementById('f4').style.textShadow="0px 0px 5px #fff";
		 }
		 else{ document.getElementById('f4').style.color="gray";
		document.getElementById('f3').style.color="gray";
		document.getElementById('f2').style.color="gray";   document.getElementById('f1').style.color="gray";
		document.getElementById('f1').style.textShadow="none";
		document.getElementById('f2').style.textShadow="none";
		document.getElementById('f3').style.textShadow="none";
		document.getElementById('f4').style.textShadow="none";
		 }
		//cambiando color a los minutos
		function chgColor1(){
		 if((h==13)||(h==1)){
		  document.getElementById('es').style.color="white";
		  document.getElementById('es').style.textShadow="0px 0px 5px #fff";
		  document.getElementById('son').style.color="gray";
		  document.getElementById('son').style.textShadow="none";
		  document.getElementById('la').style.color="white"; 
		  document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		  document.getElementById('s').style.color="gray";
		  document.getElementById('s').style.textShadow="none";
		  document.getElementById('1').style.color="white";
		  document.getElementById('1').style.textShadow="0px 0px 5px #fff";
		 }
		if((h==14)||(h==2)){
		 document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('2').style.color="white";
		 document.getElementById('2').style.textShadow="0px 0px 5px #fff";

		}
		if((h==15)||(h==3)){
		 document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('3').style.color="white";
		 document.getElementById('3').style.textShadow="0px 0px 5px #fff";
		}

		if((h==16)||(h==4)){
		 document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('4').style.color="white";
		 document.getElementById('4').style.textShadow="0px 0px 5px #fff";
		}
		if((h==17)||(h==5)){
		  document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('5').style.color="white";
		 document.getElementById('5').style.textShadow="0px 0px 5px #fff";
		}
		if((h==18)||(h==6)){ 
		 document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('6').style.color="white";
		 document.getElementById('6').style.textShadow="0px 0px 5px #fff";
		}
		if((h==19)||(h==7)){
		 document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('7').style.color="white";
		 document.getElementById('7').style.textShadow="0px 0px 5px #fff";
		}
		if((h==20)||(h==8)){
		  document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('8').style.color="white";
		 document.getElementById('8').style.textShadow="0px 0px 5px #fff";
		}
		if((h==21)||(h==9)){
		document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('9').style.color="white";
		 document.getElementById('9').style.textShadow="0px 0px 5px #fff";
		}
		if((h==22)||(h==10)){
		 document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('10').style.color="white";
		 document.getElementById('10').style.textShadow="0px 0px 5px #fff";
		}
		if((h==23)||(h==11)){
		  document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('11').style.color="white";
		 document.getElementById('11').style.textShadow="0px 0px 5px #fff";
		}
		if((h==0)||(h==12)){
		 document.getElementById('es').style.color="gray";
		 document.getElementById('es').style.textShadow="none";
		 document.getElementById('son').style.color="white";
		 document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('la').style.color="white"; 
		 document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('s').style.color="white";
		 document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		 document.getElementById('12').style.color="white";
		 document.getElementById('12').style.textShadow="0px 0px 5px #fff";
		}   

		}

		function chgColor2(){
		 if((h==13)||(h==1)){
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white"; 
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('1').style.color="gray" ;
		    document.getElementById('1').style.textShadow="none";
		    document.getElementById('2').style.color="white";
		    document.getElementById('2').style.textShadow="0px 0px 5px #fff";
		}
		if((h==14)||(h==2)){
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('2').style.color="gray" ;
		    document.getElementById('2').style.textShadow="none";
		    document.getElementById('3').style.color="white";
		    document.getElementById('3').style.textShadow="0px 0px 5px #fff";
		}
		if((h==15)||(h==3)){
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('3').style.color="gray" ;
		    document.getElementById('3').style.textShadow="none";
		    document.getElementById('4').style.color="white";
		    document.getElementById('4').style.textShadow="0px 0px 5px #fff";
		}

		if((h==16)||(h==4)){
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('4').style.color="gray" ;
		    document.getElementById('4').style.textShadow="none";
		    document.getElementById('5').style.color="white";
		    document.getElementById('5').style.textShadow="0px 0px 5px #fff";
		}
		if((h==17)||(h==5)){
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('5').style.color="gray" ;
		    document.getElementById('5').style.textShadow="none";
		    document.getElementById('6').style.color="white";
		    document.getElementById('6').style.textShadow="0px 0px 5px #fff";
		}
		if((h==18)||(h==6)){ 
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('6').style.color="gray" ;
		    document.getElementById('6').style.textShadow="none";
		    document.getElementById('7').style.color="white";
		    document.getElementById('7').style.textShadow="0px 0px 5px #fff";
		}
		if((h==19)||(h==7)){
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('7').style.color="gray" ;
		    document.getElementById('7').style.textShadow="none";
		    document.getElementById('8').style.color="white";
		    document.getElementById('8').style.textShadow="0px 0px 5px #fff";
		}
		if((h==20)||(h==8)){
		document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('8').style.color="gray" ;
		    document.getElementById('8').style.textShadow="none";
		    document.getElementById('9').style.color="white";
		    document.getElementById('9').style.textShadow="0px 0px 5px #fff";
		}
		if((h==21)||(h==9)){
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('9').style.color="gray" ;
		    document.getElementById('9').style.textShadow="none";
		    document.getElementById('10').style.color="white";
		    document.getElementById('10').style.textShadow="0px 0px 5px #fff";
		}
		if((h==22)||(h==10)){
		  document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('10').style.color="gray" ;
		    document.getElementById('10').style.textShadow="none";
		    document.getElementById('11').style.color="white";
		    document.getElementById('11').style.textShadow="0px 0px 5px #fff";
		}
		if((h==23)||(h==11)){
		    document.getElementById('es').style.color="gray";
		    document.getElementById('es').style.textShadow="none";
		    document.getElementById('son').style.color="white";
		    document.getElementById('son').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="white";
		    document.getElementById('s').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('11').style.color="gray" ;
		    document.getElementById('11').style.textShadow="none";
		    document.getElementById('12').style.color="white";
		    document.getElementById('12').style.textShadow="0px 0px 5px #fff";
		}
		if((h==0)||(h==12)){
		    document.getElementById('es').style.color="white";
		    document.getElementById('es').style.textShadow="0px 0px 5px #fff";
		    document.getElementById('son').style.color="gray";
		    document.getElementById('son').style.textShadow="none";
		    document.getElementById('la').style.color="white";
		    document.getElementById('la').style.textShadow="0px 0px 5px #fff"; 
		    document.getElementById('s').style.color="gray";
		    document.getElementById('s').style.textShadow="none";
		    document.getElementById('12').style.color="gray" ;
		    document.getElementById('12').style.textShadow="none";
		    document.getElementById('1').style.color="white";
		    document.getElementById('1').style.textShadow="0px 0px 5px #fff";
		}  
		}




		if((m==0)||(m==1)||(m==2)||(m==3)||(m==4)){
		document.getElementById('20').style.color="gray";
		document.getElementById('20').style.textShadow="none";
		document.getElementById('25').style.color="gray";
		document.getElementById('25').style.textShadow="none";
		document.getElementById('cin').style.color="gray";
		document.getElementById('cin').style.textShadow="none";
		document.getElementById('die').style.color="gray";
		document.getElementById('die').style.textShadow="none";
		document.getElementById('y').style.color="gray";  
		document.getElementById('y').style.textShadow="none";
		document.getElementById('med').style.color="gray"; 
		document.getElementById('med').style.textShadow="none"; 
		document.getElementById('cuarto').style.color="gray";
		document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="gray";  
		document.getElementById('men').style.textShadow="none";
		  //verificamos la hr para prender sig. hr.
		  chgColor1();
		}//fin 0 min

		//05 min
		if((m==5)||(m==6)||(m==7)||(m==8)||(m==9)){
		document.getElementById('20').style.color="gray";
		 document.getElementById('20').style.textShadow="none";
		document.getElementById('25').style.color="gray";
		 document.getElementById('25').style.textShadow="none";
		document.getElementById('cin').style.color="white";
		  document.getElementById('cin').style.textShadow="0px 0px 5px #fff";
		document.getElementById('die').style.color="gray";
		 document.getElementById('die').style.textShadow="none";
		document.getElementById('y').style.color="white";
		  document.getElementById('y').style.textShadow="0px 0px 5px #fff";  
		document.getElementById('med').style.color="gray"; 
		 document.getElementById('med').style.textShadow="none"; 
		document.getElementById('cuarto').style.color="gray";
		 document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="gray"; 
		 document.getElementById('men').style.textShadow="none"; 
		  //verificamos la hr para prender sig. hr.
		 chgColor1();
		}// fin 5 min

		//10 min
		if((m==10)||(m==11)||(m==12)||(m==13)||(m==14)){
		document.getElementById('20').style.color="gray";
		  document.getElementById('20').style.textShadow="none";
		document.getElementById('25').style.color="gray";
		  document.getElementById('25').style.textShadow="none";
		document.getElementById('cin').style.color="gray";
		  document.getElementById('cin').style.textShadow="none";
		document.getElementById('die').style.color="white";
		  document.getElementById('die').style.textShadow="0px 0px 5px #fff";
		document.getElementById('y').style.color="white"; 
		  document.getElementById('y').style.textShadow="0px 0px 5px #fff"; 
		document.getElementById('med').style.color="gray";
		  document.getElementById('med').style.textShadow="none";  
		document.getElementById('cuarto').style.color="gray";
		  document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="gray";  
		  document.getElementById('men').style.textShadow="none";
		  //verificamos la hr para prender sig. hr.
		 chgColor1();
		}//fin 10 min

		//15 min
		if((m==15)||(m==16)||(m==17)||(m==18)||(m==19)){
		document.getElementById('20').style.color="gray";
		  document.getElementById('20').style.textShadow="none";
		document.getElementById('cin').style.color="gray";
		  document.getElementById('cin').style.textShadow="none";
		document.getElementById('25').style.color="gray";
		  document.getElementById('25').style.textShadow="none";
		document.getElementById('die').style.color="gray";
		  document.getElementById('die').style.textShadow="none";
		document.getElementById('y').style.color="white"; 
		  document.getElementById('y').style.textShadow="0px 0px 5px #fff"; 
		document.getElementById('med').style.color="gray";
		  document.getElementById('med').style.textShadow="none";  
		document.getElementById('cuarto').style.color="white";
		  document.getElementById('cuarto').style.textShadow="0px 0px 5px #fff";
		document.getElementById('men').style.color="gray";
		  document.getElementById('men').style.textShadow="none"; 
		 chgColor1();
		}//fin 15 min

		//20 min
		if((m==20)||(m==21)||(m==22)||(m==23)||(m==24)){
		document.getElementById('cin').style.color="gray";
		  document.getElementById('cin').style.textShadow="none"
		document.getElementById('25').style.color="gray";
		  document.getElementById('25').style.textShadow="none"
		document.getElementById('20').style.color="white";
		  document.getElementById('20').style.textShadow="0px 0px 5px #fff";
		document.getElementById('die').style.color="gray";
		  document.getElementById('die').style.textShadow="none"
		document.getElementById('y').style.color="white";
		  document.getElementById('y').style.textShadow="0px 0px 5px #fff";  
		document.getElementById('med').style.color="gray"; 
		  document.getElementById('med').style.textShadow="none" 
		document.getElementById('cuarto').style.color="gray";
		  document.getElementById('cuarto').style.textShadow="none"
		document.getElementById('men').style.color="gray"; 
		  document.getElementById('men').style.textShadow="none"
		  //verificamos la hr para prender sig. hr.
		  chgColor1();
		}// fin 20 min

		//25 min
		if((m==25)||(m==26)||(m==27)||(m==28)||(m==29)){
		document.getElementById('cin').style.color="white";
		  document.getElementById('cin').style.textShadow="0px 0px 5px #fff";
		document.getElementById('25').style.color="white";
		  document.getElementById('25').style.textShadow="0px 0px 5px #fff";
		document.getElementById('20').style.color="gray";
		  document.getElementById('20').style.textShadow="none";
		document.getElementById('die').style.color="gray";
		  document.getElementById('die').style.textShadow="none";
		document.getElementById('y').style.color="white";
		  document.getElementById('y').style.textShadow="0px 0px 5px #fff";  
		document.getElementById('med').style.color="gray"; 
		  document.getElementById('med').style.textShadow="none"; 
		document.getElementById('cuarto').style.color="gray";
		  document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="gray";
		  document.getElementById('men').style.textShadow="none";
		  //verificamos la hr para prender sig. hr.
		  chgColor1();
		}//fin 25 min

		//30 min
		if((m==30)||(m==31)||(m==32)||(m==33)||(m==34)){
		document.getElementById('cin').style.color="gray";
		document.getElementById('cin').style.textShadow="none";
		document.getElementById('25').style.color="gray";
		  document.getElementById('25').style.textShadow="none";
		document.getElementById('20').style.color="gray";
		  document.getElementById('20').style.textShadow="none";
		document.getElementById('die').style.color="gray";
		  document.getElementById('die').style.textShadow="none";
		document.getElementById('y').style.color="white";
		 document.getElementById('y').style.textShadow="0px 0px 5px #fff";  
		document.getElementById('med').style.color="white";  
		 document.getElementById('med').style.textShadow="0px 0px 5px #fff";
		document.getElementById('cuarto').style.color="gray";
		  document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="gray";
		  document.getElementById('men').style.textShadow="none";
		  //verificamos la hr para prender sig. hr.
		   chgColor1();
		}//fin 30 min

		//35 min
		if((m==35)||(m==36)||(m==37)||(m==38)||(m==39)){
		document.getElementById('cin').style.color="white";
		document.getElementById('cin').style.textShadow="0px 0px 5px #fff";
		document.getElementById('25').style.color="white";
		document.getElementById('25').style.textShadow="0px 0px 5px #fff";
		document.getElementById('20').style.color="gray";
		document.getElementById('20').style.textShadow="none";
		document.getElementById('die').style.color="gray";
		document.getElementById('die').style.textShadow="none";
		document.getElementById('y').style.color="gray"; 
		document.getElementById('y').style.textShadow="none"; 
		document.getElementById('med').style.color="gray"; 
		document.getElementById('med').style.textShadow="none"; 
		document.getElementById('cuarto').style.color="gray";
		document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="white";
		document.getElementById('men').style.textShadow="0px 0px 5px #fff";
		  //verificamos la hr para prender sig. hr.
		  chgColor2();
		}//fin 35 min

		//40 min
		if((m==40)||(m==41)||(m==42)||(m==43)||(m==44)){
		document.getElementById('cin').style.color="gray";
		    document.getElementById('cin').style.textShadow="none";
		document.getElementById('25').style.color="gray";
		    document.getElementById('25').style.textShadow="none";
		document.getElementById('20').style.color="white";
		    document.getElementById('20').style.textShadow="0px 0px 5px #fff";
		document.getElementById('die').style.color="gray";
		    document.getElementById('die').style.textShadow="none"; 
		document.getElementById('y').style.color="gray";
		    document.getElementById('y').style.textShadow="none";  
		document.getElementById('med').style.color="gray";
		    document.getElementById('med').style.textShadow="none";  
		document.getElementById('cuarto').style.color="gray";
		    document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="white";
		    document.getElementById('men').style.textShadow="0px 0px 5px #fff";
		  //verificamos la hr para prender sig. hr.
		   chgColor2();
		}// fin 40 min

		//45 min
		if((m==45)||(m==46)||(m==47)||(m==48)||(m==49)){
		document.getElementById('cin').style.color="gray";
		document.getElementById('cin').style.textShadow="none";
		document.getElementById('25').style.color="gray";
		document.getElementById('25').style.textShadow="none";
		document.getElementById('20').style.color="gray";
		document.getElementById('20').style.textShadow="none";
		document.getElementById('die').style.color="gray";
		document.getElementById('die').style.textShadow="none";
		document.getElementById('y').style.color="gray";  
		document.getElementById('y').style.textShadow="none";
		document.getElementById('med').style.color="gray"; 
		document.getElementById('med').style.textShadow="none"; 
		document.getElementById('cuarto').style.color="white";
		document.getElementById('cuarto').style.textShadow="0px 0px 5px #fff";
		document.getElementById('men').style.color="white"; 
		document.getElementById('men').style.textShadow="0px 0px 5px #fff";
		  //verificamos la hr para prender sig. hr.
		   chgColor2();
		}//fin 45 min

		//50 min
		if((m==50)||(m==51)||(m==52)||(m==53)||(m==54)){  
		document.getElementById('cin').style.color="gray";
		document.getElementById('cin').style.textShadow="none";
		document.getElementById('25').style.color="gray";
		document.getElementById('25').style.textShadow="none";
		document.getElementById('20').style.color="gray";
		document.getElementById('20').style.textShadow="none";
		document.getElementById('die').style.color="white";
		document.getElementById('die').style.textShadow="0px 0px 5px #fff";
		document.getElementById('y').style.color="gray";
		document.getElementById('y').style.textShadow="none";  
		document.getElementById('med').style.color="gray"; 
		document.getElementById('med').style.textShadow="none"; 
		document.getElementById('cuarto').style.color="gray";
		document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="white";
		  document.getElementById('men').style.textShadow="0px 0px 5px #fff";
		  //verificamos la hr para prender sig. hr.
		   chgColor2();
		}//fin 50 min

		//55 min
		if((m==55)||(m==56)||(m==57)||(m==58)||(m==59)){
		document.getElementById('cin').style.color="white";
		document.getElementById('cin').style.textShadow="0px 0px 5px #fff";
		document.getElementById('25').style.color="gray";
		document.getElementById('25').style.textShadow="none";
		document.getElementById('20').style.color="gray";
		document.getElementById('20').style.textShadow="none";
		document.getElementById('die').style.color="gray";
		document.getElementById('die').style.textShadow="none";
		document.getElementById('y').style.color="gray"; 
		document.getElementById('y').style.textShadow="none"; 
		document.getElementById('med').style.color="gray"; 
		document.getElementById('med').style.textShadow="none"; 
		document.getElementById('cuarto').style.color="gray";
		document.getElementById('cuarto').style.textShadow="none";
		document.getElementById('men').style.color="white";
		document.getElementById('men').style.textShadow="0px 0px 5px #fff";
		  //verificamos la hr para prender sig. hr.
		  chgColor2();
		}// fin 55 min

		//fin del cambio
		}//fin de la funcion 
		setInterval(function() {reloj()}, 1000);


  
};
</script>