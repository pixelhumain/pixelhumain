<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);*/
?>
<style>
li {
    list-style: none;
}
li:before {
    content: "✓ ";
}

input {
    border: none;
    width: 80px;
    font-size: 14px;
    padding: 2px;
}

input:hover {
    background-color: #eee;
}

input:focus {
    background-color: #ccf;
}

input:not(:focus) {
    text-align: right;
}

table {
    border-collapse: collapse;  
}

td {
    border: 1px solid #999;
    padding: 0;
}

tr:first-child td, td:first-child {
    background-color: #ccc;
    padding: 1px 3px;
    font-weight: bold;
    text-align: center;
}

footer {
    font-size: 80%;
}

</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">

<p>Inspired by <a href="http://thomasstreet.net/blog/spreadsheet.html">http://thomasstreet.net/blog/spreadsheet.html</a>. Features:</p>

<ul>
    <li>Under 30 lines of vanilla JavaScript</li>
    <li>Libraries used: <strong>none</strong></li>
    <li>Excel-like syntax (formulas start with "=")</li>
    <li>Support for arbitrary expressions (=A1+B2*C3)</li>
    <li>Circular reference prevention</li>
    <li>Automatic localStorage persistence</li>
</ul>

<table></table>

	</div>
</div>


<script type="text/javascript"		>
initT['animInit'] = function(){
	for (var i=0; i<6; i++) {
	    var row = document.querySelector("table").insertRow(-1);
	    for (var j=0; j<6; j++) {
	        var letter = String.fromCharCode("A".charCodeAt(0)+j-1);
	        row.insertCell(-1).innerHTML = i&&j ? "<input id='"+ letter+i +"'/>" : i||letter;
	    }
	}

	var DATA={}, INPUTS=[].slice.call(document.querySelectorAll("input"));
	INPUTS.forEach(function(elm) {
	    elm.onfocus = function(e) {
	        e.target.value = localStorage[e.target.id] || "";
	    };
	    elm.onblur = function(e) {
	        localStorage[e.target.id] = e.target.value;
	        computeAll();
	    };
	    var getter = function() {
	        var value = localStorage[elm.id] || "";
	        if (value.charAt(0) == "=") {
	            with (DATA) return eval(value.substring(1));
	        } else { return isNaN(parseFloat(value)) ? value : parseFloat(value); }
	    };
	    Object.defineProperty(DATA, elm.id, {get:getter});
	    Object.defineProperty(DATA, elm.id.toLowerCase(), {get:getter});
	});
	(window.computeAll = function() {
	    INPUTS.forEach(function(elm) { try { elm.value = DATA[elm.id]; } catch(e) {} });
	})();

  
};
</script>