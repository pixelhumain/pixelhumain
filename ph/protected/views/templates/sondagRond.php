<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css'); //for CSS external files onloading
$cs->registerScriptFile('http://' , CClientScript::POS_END); //for javascript external files onloading
?>

<!-- BLOCK CSS -->
<style>
body {
    background:url(http://onlineaccelerator.com.au/content/oa/assets/images/accelerator-bg.jpg); 
    background-position:50% 0;    
}
.circle-big {
    position: relative;
    height:600px;
    width:600px;
    background: #c02026;
    border-radius: 50% 50%;
    margin: 20px auto;
    border: 4px solid white;
}
.circle-inner {
    border-radius: 50%;
    width: 370px;
    height: 370px;
    border: 4px solid white;
    background-color: black;
    display: block;
    position: absolute;
    overflow: hidden;
    text-align:center;
    top: 50%;
    left: 50%;
    margin-top:-185px;
    margin-left:-185px
}
.circle, .cloned-circle {
    border-radius: 50%;
    width: 84px;
    height: 84px;
    background-color: white;
    display: block;
    position: absolute;
    overflow: hidden;
    top: 50%;
    left: 50%;
    margin-top:-42px;
    margin-left:-42px;
    transition: all .3s linear;
    background-repeat:no-repeat;
    background-position:center;
    z-index:2;
}

.circle:hover { cursor: not-allowed; }

#container { width:100%; height:100%; }

#pointer {
    position:absolute;
    left:50%;
    margin-left:-55px;
    height:135px;
    width:100px;
    background:#6d0000;
    border: 5px solid white; 
    border-radius: 0 0 50px 50px;
    z-index:1;
}

#pointer:after {
    content: ' ';
	height: 0;
	position: absolute;
	width: 0;
	border: 20px solid transparent;
	border-top-color: white;
	top: 100%;
	left: 50%;
	margin-left: -20px;
}

.circle-inner h4 {
    color:white;
    font-weight: normal;
    font-style: normal;
    width:262px;
    line-height: 1.1;
    font-family: "museo-sans", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    margin: 80px auto;
    text-align: center;
    font-size: 23px;
}

.circle-inner a {
    display: inline-block;
    color:white;
    font-weight: bold;
    text-decoration:none;
    font-family: "museo-sans", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    cursor: pointer;
    text-transform: uppercase;
    background-color: #a6ce38;
    font-size:15px;
    border: none;
    position:absolute;
    bottom:60px;
    width: 76px;
    padding:10px 0;
}
.circle-inner a.yes { margin-left: -86px; }

.spin-one    { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon1.png);  }
.spin-two    { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon2.png);  }
.spin-three  { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon3.png);  }
.spin-four   { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon4.png);  }
.spin-five   { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon5.png);  }
.spin-six    { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon6.png);  }
.spin-seven  { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon7.png);  }
.spin-eight  { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon8.png);  }
.spin-nine   { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon9.png);  }
.spin-ten    { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon10.png); }
.spin-eleven { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon11.png); }
.spin-twelve { background-image: url(http://onlineaccelerator.com.au/content/oa/assets/images/icon12.png); }
</style>

<!-- BLOCK HTML  -->


<!-- Developed for onlineaccelerator.com -->
<div id='container'>
    <div id='pointer'></div>
    <div class="circle-big">
        <div class="circle spin-one" data-angle=270></div>
        <div class="circle spin-two" data-angle=300></div>
        <div class="circle spin-three" data-angle=330></div>
        <div class="circle spin-four" data-angle=0></div>
        <div class="circle spin-five" data-angle=30></div>
        <div class="circle spin-six" data-angle=60></div>
        <div class="circle spin-seven" data-angle=90></div>
        <div class="circle spin-eight" data-angle=120></div>
        <div class="circle spin-nine" data-angle=150></div>
        <div class="circle spin-ten" data-angle=180></div>
        <div class="circle spin-eleven" data-angle=210></div>    
        <div class="circle spin-twelve" data-angle=240></div>
        <div class="circle-inner">
            <h4 id='question'>Have you explored how the internet can work harder for you?</h4>
            <a class="button yes" onclick="answer('y')">Yes</a>
            <a class="button no" onclick="answer('n')">No</a>
        </div>
    </div>
</div>


<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

	var circleArray = document.getElementsByClassName("circle"),
    interfaceLock = false,
    angle = 0,
    currentContentNum = 0;
    questionElem = document.getElementById('question'),
    questionArray = [
        'Have you explored how the internet can work harder for you?', 
        'Could you benefit from an instant increase in traffic to your website?', 
        'Do you have an online marketing strategy?', 
        'Do you fully understand how social media can help your business?', 
        'Do you have the right digital tools to attract the right customers?', 
        'Does your technology still tie you to your desk?', 
        'Would you like to increase the number of qualified leads coming through your website?', 
        'Would you like clarity on what to say, how to say it and where to share it?', 
        'Do you want your business to rank at the top of the Google search result?', 
        'Would you like your website to be making you money by selling or processing payments online?', 
        'Are you reaching your customers on their preferred device?', 
        'Do you know what search terms your best customers are using to find you?'
    ],
    answerArray = [
        'n', 
        'y', 
        'n', 
        'n', 
        'n', 
        'y', 
        'y', 
        'y', 
        'y', 
        'y', 
        'n', 
        'n', 
    ];

chargearray();

function chargearray () {
    //alert(currentContentNum)
    for (var i = 0, j = circleArray.length; i < j; i++) {
        var circle = circleArray[i];
        var circleAngle = parseInt (circle.dataset.angle);
        var totalAngle = angle + circleAngle
        var style = "rotate(" + totalAngle + "deg) translate(245px)";
        totalAngle = - totalAngle;
        style = style + " rotate(" + totalAngle + "deg)"
        circle.style.webkitTransform = style;
        circle.style.Transform = style;
    }
}

function answer(input) {
    if (interfaceLock == false) {
        if(input == answerArray[currentContentNum]) {
            if ($('.critical-meter .two').length < 6) {
                $('.circle-big > .circle:nth-child('+currentContentNum+')').clone().css({
                    'position' : 'static',
                    '-webkit-transform' : 'none'
                }).appendTo($('.critical-meter .row')).removeClass('circle').addClass('cloned-circle').wrap('<div class="two columns" />');
            }
            if ($('.critical-meter .two').length > 0 && $('.critical-meter .two').length < 3) {
                $('.alertometer h4').text('Moderate').attr('class', 'text-green2');
            }
            if ($('.critical-meter .two').length > 2 && $('.critical-meter .two').length < 5) {
                $('.alertometer h4').text('Severe').attr('class', 'text-yellow');
            }
            if ($('.critical-meter .two').length > 4) {
                $('.alertometer h4').text('Critical').attr('class', 'text-red');
                $('.transform-business .bright.button').addClass('highlighted');
            }
            if ($('.critical-meter .two').length >= 6) {
                interfaceLock = true;
                $('.circle-inner').html("<h3 class='neg-margin'>Digital engagement for your business is at a critical state!</h3><h5 class='neg-margin'>Take action before it&lsquo;s too late.</h5><a class='button not-absolute' href='/discovery/'>Book a discovery session</a>")
            }
        }
        angle -= 30;
        if(currentContentNum + 1 < questionArray.length)
        {
            currentContentNum++;
        }
        else { currentContentNum = 0; }
        questionElem.innerHTML = questionArray[currentContentNum];
        chargearray();
    }
}

document.onkeydown = function (e) {
    e = e || window.event;
    switch(e.which || e.keyCode) {
        case 37:
            angle += 30;
            if(currentContentNum - 1 < 0)
            {
                currentContentNum = questionArray.length - 1;
            } else {
                currentContentNum --;
            }
            questionElem.innerHTML = questionArray[currentContentNum];
            chargearray();
            break;
        case 39:
            angle -= 30;
            if(currentContentNum + 1 < questionArray.length)
            {
                currentContentNum++;
            }
            else { currentContentNum = 0; }
            questionElem.innerHTML = questionArray[currentContentNum];
            chargearray();
            break;
    }
}

};
</script>