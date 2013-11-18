<?php 
$cs = Yii::app()->getClientScript();
//$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js' , CClientScript::POS_END);
?>
<style>
/*! normalize.css v2.1.2 | MIT License | git.io/normalize */

/* ==========================================================================
   HTML5 display definitions
   ========================================================================== */

/**
 * Correct `block` display not defined in IE 8/9.
 */

article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
main,
nav,
section,
summary {
    display: block;
}

/**
 * Correct `inline-block` display not defined in IE 8/9.
 */

audio,
canvas,
video {
    display: inline-block;
}

/**
 * Prevent modern browsers from displaying `audio` without controls.
 * Remove excess height in iOS 5 devices.
 */

audio:not([controls]) {
    display: none;
    height: 0;
}

/**
 * Address styling not present in IE 8/9.
 */

[hidden] {
    display: none;
}

/* ==========================================================================
   Base
   ========================================================================== */

/**
 * 1. Set default font family to sans-serif.
 * 2. Prevent iOS text size adjust after orientation change, without disabling
 *    user zoom.
 */

html {
    font-family: sans-serif; /* 1 */
    -ms-text-size-adjust: 100%; /* 2 */
    -webkit-text-size-adjust: 100%; /* 2 */
}

/**
 * Remove default margin.
 */

body {
    margin: 0;
}

/* ==========================================================================
   Links
   ========================================================================== */

/**
 * Address `outline` inconsistency between Chrome and other browsers.
 */

a:focus {
    outline: thin dotted;
}

/**
 * Improve readability when focused and also mouse hovered in all browsers.
 */

a:active,
a:hover {
    outline: 0;
}

/* ==========================================================================
   Typography
   ========================================================================== */

/**
 * Address variable `h1` font-size and margin within `section` and `article`
 * contexts in Firefox 4+, Safari 5, and Chrome.
 */

h1 {
    font-size: 2em;
    margin: 0.67em 0;
}

/**
 * Address styling not present in IE 8/9, Safari 5, and Chrome.
 */

abbr[title] {
    border-bottom: 1px dotted;
}

/**
 * Address style set to `bolder` in Firefox 4+, Safari 5, and Chrome.
 */

b,
strong {
    font-weight: bold;
}

/**
 * Address styling not present in Safari 5 and Chrome.
 */

dfn {
    font-style: italic;
}

/**
 * Address differences between Firefox and other browsers.
 */

hr {
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    height: 0;
}

/**
 * Address styling not present in IE 8/9.
 */

mark {
    background: #ff0;
    color: #000;
}

/**
 * Correct font family set oddly in Safari 5 and Chrome.
 */

code,
kbd,
pre,
samp {
    font-family: monospace, serif;
    font-size: 1em;
}

/**
 * Improve readability of pre-formatted text in all browsers.
 */

pre {
    white-space: pre-wrap;
}

/**
 * Set consistent quote types.
 */

q {
    quotes: "\201C" "\201D" "\2018" "\2019";
}

/**
 * Address inconsistent and variable font size in all browsers.
 */

small {
    font-size: 80%;
}

/**
 * Prevent `sub` and `sup` affecting `line-height` in all browsers.
 */

sub,
sup {
    font-size: 75%;
    line-height: 0;
    position: relative;
    vertical-align: baseline;
}

sup {
    top: -0.5em;
}

sub {
    bottom: -0.25em;
}

/* ==========================================================================
   Embedded content
   ========================================================================== */

/**
 * Remove border when inside `a` element in IE 8/9.
 */

img {
    border: 0;
}

/**
 * Correct overflow displayed oddly in IE 9.
 */

svg:not(:root) {
    overflow: hidden;
}

/* ==========================================================================
   Figures
   ========================================================================== */

/**
 * Address margin not present in IE 8/9 and Safari 5.
 */

figure {
    margin: 0;
}

/* ==========================================================================
   Forms
   ========================================================================== */

/**
 * Define consistent border, margin, and padding.
 */

fieldset {
    border: 1px solid #c0c0c0;
    margin: 0 2px;
    padding: 0.35em 0.625em 0.75em;
}

/**
 * 1. Correct `color` not being inherited in IE 8/9.
 * 2. Remove padding so people aren't caught out if they zero out fieldsets.
 */

legend {
    border: 0; /* 1 */
    padding: 0; /* 2 */
}

/**
 * 1. Correct font family not being inherited in all browsers.
 * 2. Correct font size not being inherited in all browsers.
 * 3. Address margins set differently in Firefox 4+, Safari 5, and Chrome.
 */

button,
input,
select,
textarea {
    font-family: inherit; /* 1 */
    font-size: 100%; /* 2 */
    margin: 0; /* 3 */
}

/**
 * Address Firefox 4+ setting `line-height` on `input` using `!important` in
 * the UA stylesheet.
 */

button,
input {
    line-height: normal;
}

/**
 * Address inconsistent `text-transform` inheritance for `button` and `select`.
 * All other form control elements do not inherit `text-transform` values.
 * Correct `button` style inheritance in Chrome, Safari 5+, and IE 8+.
 * Correct `select` style inheritance in Firefox 4+ and Opera.
 */

button,
select {
    text-transform: none;
}

/**
 * 1. Avoid the WebKit bug in Android 4.0.* where (2) destroys native `audio`
 *    and `video` controls.
 * 2. Correct inability to style clickable `input` types in iOS.
 * 3. Improve usability and consistency of cursor style between image-type
 *    `input` and others.
 */

button,
html input[type="button"], /* 1 */
input[type="reset"],
input[type="submit"] {
    -webkit-appearance: button; /* 2 */
    cursor: pointer; /* 3 */
}

/**
 * Re-set default cursor for disabled elements.
 */

button[disabled],
html input[disabled] {
    cursor: default;
}

/**
 * 1. Address box sizing set to `content-box` in IE 8/9.
 * 2. Remove excess padding in IE 8/9.
 */

input[type="checkbox"],
input[type="radio"] {
    box-sizing: border-box; /* 1 */
    padding: 0; /* 2 */
}

/**
 * 1. Address `appearance` set to `searchfield` in Safari 5 and Chrome.
 * 2. Address `box-sizing` set to `border-box` in Safari 5 and Chrome
 *    (include `-moz` to future-proof).
 */

input[type="search"] {
    -webkit-appearance: textfield; /* 1 */
    -moz-box-sizing: content-box;
    -webkit-box-sizing: content-box; /* 2 */
    box-sizing: content-box;
}

/**
 * Remove inner padding and search cancel button in Safari 5 and Chrome
 * on OS X.
 */

input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-decoration {
    -webkit-appearance: none;
}

/**
 * Remove inner padding and border in Firefox 4+.
 */

button::-moz-focus-inner,
input::-moz-focus-inner {
    border: 0;
    padding: 0;
}

/**
 * 1. Remove default vertical scrollbar in IE 8/9.
 * 2. Improve readability and alignment in all browsers.
 */

textarea {
    overflow: auto; /* 1 */
    vertical-align: top; /* 2 */
}

/* ==========================================================================
   Tables
   ========================================================================== */

/**
 * Remove most spacing between table cells.
 */

table {
    border-collapse: collapse;
    border-spacing: 0;
}
</style>

    <style>
@import url("http://fonts.googleapis.com/css?family=Lato:300,400,700");
@import url("http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:before, :after {
  content: '';
  display: block;
  position: absolute;
  box-sizing: border-box;
}

html, body {
  height: 100%;
}

body {
  display: flex;
  font: 16px/1 'Lato', sans-serif;
  color: #777;
  background: #eeeeee;
}

.main {
  flex: 1;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
}

.nav {
  width: 230px;
  background: #4a6a8a;
}

.link {
  position: relative;
  display: block;
  padding-left: 60px;
  height: 40px;
  line-height: 40px;
  font-size: 14px;
  font-weight: 700;
  color: #eeeeee;
  cursor: pointer;
  transition: .2s all;
}
.link:before {
  top: 12px;
  left: 23px;
  font: 16px fontawesome;
}
.link:hover {
  background: #43607d;
}
.link.active {
  background: #3c566f;
  box-shadow: inset 5px 0 0 #00aaff;
}
.link.i1:before {
  content: '\f00a';
}
.link.i2:before {
  content: '\f012';
}
.link.i3:before {
  content: '\f018';
}
.link.i4:before {
  content: '\f024';
}
.link.i5:before {
  content: '\f08d';
}
.link.i6:before {
  content: '\f002';
}
.link.i7:before {
  content: '\f085';
}
.link.i8:before {
  content: '\f08b';
}

.title {
  height: 40px;
  line-height: 40px;
  margin: 10px 0;
  padding: 0 22px;
  text-transform: uppercase;
  color: #7f9dbb;
  background: #43607d;
}

.chart {
  width: 210px;
  margin: 0 auto;
}

.desc {
  position: absolute;
  top: 50%;
  left: 280px;
  font-size: 50px;
  font-weight: 300;
  margin-top: -30px;
}
</style>

<div class='nav'>
  <div class='title'>Last Hour</div>
  <div class='chart' id='p1'>
    <canvas id='c1'></canvas>
  </div>
  <div class='title'>Navigation</div>
  <div class='link i1 active'>Dashboard</div>
  <div class='link i2'>Statistics</div>
  <div class='link i3'>Roadmap</div>
  <div class='link i4'>Milestones</div>
  <div class='link i5'>Tickets</div>
  <div class='title'>Account</div>
  <div class='link i6'>Search</div>
  <div class='link i7'>Settings</div>
  <div class='link i8'>Logout</div>
</div>
<div class='main'>
  <div class='desc'>
    Live Chart Navigation
  </div>
</div>


<script type="text/javascript">
initT['animInit'] = function(){
	$('.link').on('click', function() {
	    $('.link').removeClass('active');
	    $(this).toggleClass('active');
	  });
	var c1 = document.getElementById("c1");
	var parent = document.getElementById("p1");
	c1.width = parent.offsetWidth;
	c1.height = parent.offsetHeight;

	var data1 = {
	  labels : ["00","10","20","30","40","50","60"],
	  datasets : [
	    {
	      fillColor : "rgba(255,255,255,.1)",
	      strokeColor : "rgba(255,255,255,1)",
	      pointColor : "#0af",
	      pointStrokeColor : "rgba(255,255,255,1)",
	      data : [150,200,235,290,300,350, 450]
	    }
	  ]
	}

	var options1 = {
	  scaleFontColor : "rgba(255,255,255,1)",
	  scaleLineColor : "rgba(255,255,255,1)",
	  scaleGridLineColor : "transparent",
	  bezierCurve : false,
	  scaleOverride : true,
	  scaleSteps : 5,
	  scaleStepWidth : 100,
	  scaleStartValue : 0
	}

	new Chart(c1.getContext("2d")).Line(data1,options1)
};
</script>