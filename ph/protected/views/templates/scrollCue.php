<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://soxofaan.github.io/scrollocue/js/scrollocue.js' , CClientScript::POS_END); //for javascript external files onloading
?>

<!-- BLOCK CSS -->
<style>

body {
	background-color: #000;
	color: #666;
	font-family: Arial, sans-serif;
	font-size: 72pt;
	font-weight: bold;
}

#container2 {
	position: fixed;
	left: 20px;
	right: 20px;
}

h1 {
	color: #fff;
}

p {
	margin: 0;
	padding: 0;
	border-width: 20px 0;
	border-style: solid;
	border-color: transparent;
	transition: color .75s;
	-webkit-transition: color .75s;
}

.section {
	margin: 1em 0;
}


.cursor {
	color: #fff;
	border-color: #fff;
}

.yokohama .cursor {
	color: #FA558A;
	border-color: #FA558A;
}



.wrong {
	background-color: #444;
}

.wrong .cursor {
	color: #F5D77A;
	border-color: #F5D77A;
	background-color: #222;
}

.emphasis {
	color: #855;
}

.emphasis.cursor {
	color: #d33;
	border-color: #d33;
}

.title {
	text-align: right;
}

.meta {
	font-style: italic;
	font-size: 60%;
	margin: 3em 0;
}

.meta p {
	border-width: 10px 0;
}

.meta .cursor {
	color: #fff;
	border-color: #fff;
}


.name {
	font-style: italic;
	color: #36E6F5;
}


.funky .cursor {
	-webkit-animation: funkycolors 2s linear 0s infinite alternate;
	animation: funkycolors 2s linear 0s infinite alternate;

}

@-webkit-keyframes funkycolors {
	0% { color: #36E6F5; border-color: #36E6F5;}
	25% { color: #444; border-color: #444;}
	50% { color: #FA558A; border-color: #FA558A;}
	75% { color: #444; border-color: #444;}
	100% { color: #A0D335; border-color: #A0D335; }
}

@-moz-keyframes funkycolors {
	0% { color: #36E6F5; border-color: #36E6F5;}
	25% { color: #444; border-color: #444;}
	50% { color: #FA558A; border-color: #FA558A;}
	75% { color: #444; border-color: #444;}
	100% { color: #A0D335; border-color: #A0D335; }
}


</style>

<!-- BLOCK HTML  -->

<div id="container2">

    <h1>Scrollocue</h1>

    <div class="section meta">
      <p>A simple autocue/teleprompter system.</p>
      <p>Just use the arrows or spacebar to scroll.</p>
      <p>Now, let's walk through some text.</p>
    </div>

    <div class="section title">
      <p>Around the World in 80 Days</p>
      <p>Jules Verne</p>
    </div>

    <div class="section passenger">
      <p>"There is no young lady on board,"</p>
      <p>interrupted the purser.</p>
      <p>"Here is a list of the passengers;</p>
      <p>you may see for yourself."</p>
      <p><span class="name">Passepartout</span> scanned the list,</p>
      <p>but his master's name was not upon it.</p>
      <p>All at once an idea struck him.</p>
    </div>

    <div class="section yokohama">
      <p>"Ah! am I on the Carnatic?"</p>
      <p>"Yes."</p>
      <p>"On the way to Yokohama?"</p>
      <p>"Certainly."</p>
    </div>

    <div class="section wrong">
      <p><span class="name">Passepartout</span> had for an instant feared that he was on the wrong boat;</p>
      <p>but, though he was really on the Carnatic, his master was not there.</p>
    </div>

    <div class="section fogg">
      <p>He fell thunderstruck on a seat.</p>
      <p>He saw it all now.</p>
      <p>He remembered that the time of sailing had been changed,</p>
      <p>that he should have informed his master of that fact,</p>
      <p>and that he had not done so.</p>
      <p>It was his fault, then, that Mr. Fogg and Aouda had missed the steamer.</p>
      <p class="emphasis">Yes, but it was still more the fault of the traitor who,</p>
      <p>in order to separate him from his master,</p>
      <p>and detain the latter at Hong Kong,</p>
      <p class="emphasis">had inveigled him into getting drunk!</p>
      <p>He now saw the detective's trick;</p>
      <p>and at this moment Mr. Fogg was certainly ruined,</p>
      <p>his bet was lost,</p>
      <p>and he himself perhaps arrested and imprisoned!</p>
      <p>At this thought <span class="name">Passepartout</span> tore his hair.</p>
      <p>Ah, if Fix ever came within his reach,</p>
      <p>what a settling of accounts there would be!</p>
    </div>


    <div class="section meta funky">
     <p>applause</p>
   </div>


 </div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

	$('#container2').scrollocue();
};
</script>