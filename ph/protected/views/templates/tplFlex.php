

<!-- BLOCK CSS -->
<style>
body{
	background-color: #262626;
	color: #cccccc;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
/* fonts */
h1,h2,h3,h4,h5{
	color: #ffffff;
}
a{
	color: #ffffff;
	text-decoration: none;
}
a:hover{
	color: #27b1ef;
	text-decoration: underline;
}
code{
	display: block;
	padding: 0.5em 0;
}
@font-face {
	font-family: 'icomoon';
	src:url('http://chrisyaxley.co.uk/cssDemos/fonts/icomoon.eot');
	src:url('http://chrisyaxley.co.uk/cssDemos/fonts/fonts/icomoon.eot?#iefix') format('embedded-opentype'),
		url('http://chrisyaxley.co.uk/cssDemos/fonts/icomoon.woff') format('woff'),
		url('http://chrisyaxley.co.uk/cssDemos/fonts/icomoon.ttf') format('truetype'),
		url('http://chrisyaxley.co.uk/cssDemos/fonts/icomoon.svg#icomoon') format('svg');
	font-weight: normal;
	font-style: normal;
}

[class^="icon2-"], [class*=" icon2-"] {
	color: #ffffff;
	font-family: 'icomoon';
	font-style: normal;
	font-size: 4em;
	font-weight: normal;
	font-variant: normal;
	line-height: 1;
	text-transform: none;
	speak: none;
	
	/* Better Font Rendering =========== */
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}

.icon2-css3:before {
	content: "\e600";
}
.icon2-table:before {
	content: "\e601";
}
.icon2-expand:before {
	content: "\e602";
}
.page{
	max-width: 90em;
	margin: 0 auto;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	box-sizing: border-box;
}
.col{
	background-color: #414141;
	margin: 0.5em 0;
	position: relative;
	padding: 0.725em 12px;
}
/* Navigation */
.navigation {
	display: -webkit-flex;
	display: -webkit-box;
	display: -moz-box;
	display: -ms-flexbox;
	display: box;
	display: flexbox;
	display: flex;
	-webkit-justify-content: center;
	-ms-box-pack: center;
	-moz-justify-content: center;
	justify-content: center;
	-webkit-box-orient: horizontal;
	-moz-box-orient: horizontal;
}
.navigation ul{
	list-style-type: none;
	margin: 0 0 2em 0;
	padding: 0;
	width: 100%;
	text-align: center;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: -moz-box;
	display: box;
	display: flexbox;
	display: flex;
	-webkit-flex-flow: row wrap;
	-moz-flex-flow: row wrap;
	flex-flow: row wrap;
	-ms-box-orient: horizontal;
	-webkit-justify-content: center;
	-ms-box-pack: center;
	-moz-justify-content: center;
	justify-content: center;
}
.navigation li {
	background-color: #212121;
	border-left: 1px solid #333333;
	margin: 0;
	padding: 1em;
	transition: all .5s;
	width: 100%;
	-webkit-box-flex: 1;
	-webkit-flex: auto;
	-moz-box-flex: 1;
	-ms-flex: auto;
	flex: auto;
	-webkit-transition: all .5s; /* Safari */
}
.navigation li:hover{
	background-color: #414141;
}
.navigation li:first-child{
	border-bottom: 5px solid #fc9c9c;
}
.navigation li:nth-child(2){
	border-bottom: 5px solid #FFC;
}
.navigation li:nth-child(2):hover{
	border-bottom: 5px solid #FF0;
}
.navigation li:nth-child(3){
	border-bottom: 5px solid #39F;
}
.navigation li:nth-child(3):hover{
	border-bottom: 5px solid #00F;
}
.navigation li:nth-child(4){
	border-bottom: 5px solid #6F9;
}
.navigation li:nth-child(4):hover{
	border-bottom: 5px solid #0C0;
}
.navigation li:first-child:hover{
	border-bottom: 5px solid #ff0000;
}
.navigation li:last-child{
	border-bottom: 5px solid #666666;
}
.navigation li:last-child:hover{
	border-bottom: 5px solid #ffffff;
}
.navigation li a{
	color: #ffffff;
	text-decoration: none;
}
.navigation li:hover a{
	text-decoration: underline;
}
a[href="#navigation"] {
	background-color: #212121;
	border-bottom: 5px solid #fc9c9c;
	color: #ffffff;
	display : block;
	padding: 0.5em;
	text-decoration: none;
	font-size: 1.275em;
}
a[href="#navigation"]:before{
	content: '\2630';
	padding-right: 0.5em;
}

@media only screen and (min-width: 48em){
	.page{
		padding: 1.500em;
	}
	/* Header */
	header{
		display: flex;
		padding: 1em 0;
	}
	header .image-wrapper{
		-webkit-box-flex: 1;
		-webkit-flex: auto;
		-moz-box-flex: 1;
		-ms-flex: auto;
		flex: auto;
	}
	.page-subtitle{
		flex: auto;
		margin: 0;
		line-height: 1.7em;
		text-align: right;
		-webkit-box-flex: 1;
		-webkit-flex: auto;
		-moz-box-flex: 1;
		-ms-flex: auto;
	}
	a[href="#navigation"] {
		display : none;
	}
	.content-group{
		display: table-footer-group;
	}
	.navigation{
		display: table-header-group;
	}
	.navigation ul {
		display: -webkit-box;
	}

	.content{
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: -moz-box;
		display: box;
		display: flexbox;
		display: flex;
		-webkit-flex-direction: row;
		-moz-flex-direction: row;
		flex-direction: row;
		-webkit-flex-wrap: nowrap;
		-moz-flex-wrap: nowrap;
		flex-wrap: nowrap;
		-webkit-justify-content: stretch;
		-ms-box-pack: stretch;
		-moz-justify-content: stretch;
		justify-content: stretch;
	}
	.col{
		margin: 0.5em;
		width: auto;
		-webkit-box-flex: 1;
		-moz-box-flex: 1;
		-webkit-flex: 1;
		-ms-flex: 1;
		flex: 1;
		display: table-cell;
	}
	.feature{
		width: auto;
		-webkit-box-flex: 2;
		-moz-box-flex: 2;
		-webkit-flex: 2;
		-ms-flex: 2;
		flex: 2;
	}

	/* Article Columns */
	article{
		column-count:3;
		-moz-column-count:3;
		-webkit-column-count:3;
		column-gap : 48px; 
		-webkit-column-gap : 48px;
		-moz-column-gap : 48px;
		column-rule-width : 1px;
		column-rule-style : solid;
		column-rule-color : #e3e2e0;
		-webkit-column-rule-width : 1px;
		-webkit-column-rule-style : solid;
		-webkit-column-rule-color : #e3e2e0; 
		-moz-column-rule-width : 1px;
		-moz-column-rule-style : solid;
		-moz-column-rule-color : #e3e2e0; 
	}
	article p{
		margin-top: 0;
	}
}

</style>

<!-- BLOCK HTML  -->

<div class="page">
        <header role="banner">
            <div class="image-wrapper">
                <img src="http://chrisyaxley.co.uk/images/ChrisYaxleyLogo.png" width="102" height="64" alt="ChrisYaxleyLogo">
            </div>
            <h1 class="page-subtitle">Modern CSS techniques</h1>
            <!-- Header content -->
        </header>

        <div class="content-group">
            <a href="#navigation">Skip to navigation</a>
            <section class="content">

                <div class="col">
                <h3>Full Article</h3>
                    <article>
                        <p>This demo uses three CSS3 techniques. They are <a href="http://www.w3.org/TR/css3-flexbox/" title="CSS Flexible Box Layout Module">CSS Flexible Box Layout Module</a>, <a href="http://www.w3.org/TR/css3-multicol/" title="CSS Multi-column Layout Module">CSS Multi-column Layout Module</a> and a technique for providing "content first" mobile friendly responsive navigation using the CSS property <a href="http://www.w3.org/TR/CSS2/tables.html#table-display" title="Display Table-header-group">Display Table-header-group</a>. Each of these have different levels of support, which I will give more details of below.</p>
                        <p>This page has been built with a mobile first approach, with a single breakpoint above 48em (768px) width.</p>
                        <p>I don't plan to go into how these examples where made here, the link around the page should give you more than enough examples and great advice on using these techniques.</p>
                    </article><!-- article -->
                </div><!-- col -->
            </section>
            <section class="content">

                <div class="col feature">
                    
                    <i class="icon2-expand"></i>

                    <div class="details">
                        <h3>Flexbox</h3>
                        <p>I hate grid systems. Why? Because I cant do the maths. Well maybe I could, but I don't want too. Every grid system I have used is over complex, never does exactly what you need it too and always has bugs.</p>
                        <p>Flexbox Layout is currently a W3C Candidate Recommendation. Basically it wants to stop us developers having to deal with all the shit current grid systems give us and automatically distribute items horizontally and vertically (as you can see all the boxes in this row are automatically given the same height when I apply the display: table-cell; property to the column) in the space available.</p>
                        <p>There are many properties in the Flexbox spec which give you true control over your layouts. As you can see if you are viewing the page about 48em's wide the 'Feature' column below is wider than its two siblings. This is a simple case of giving this column a <code>flex: 2;</code> Given that its two siblings have a <code>flex: 1;</code> this mean s that column 1 gets twice the amount of space available, and reduces the size of the other two columns in this row without any additional code.</p>
                        <p>You will also notice all the column are nicely spaced from each other with margin. This is automatically taken in to consideration when the column withs are calculated.</p>
                        <h4>Compatibility</h4>
                        <p>This is where things start to fall away a little. If you need to support IE &#60; 10 then I am afraid another solution is needed. But who does that these days? Well even if you are luckily enough not to have to worry about legacy browsers, its still not that simple. Flexbox has the potential to reduce the amount of CSS we need to create a grid dramatically, but for now, we pretty much have to write each property 4 or 5 (two different MS browser prefixes is a lovely added annoyance) times. Currently to support IE10 and above, Chrome, Firefox, Safari and Opera our CSS would need to be: <code>display: -webkit-flex;<br />display: -moz-flex;<br /> display: -ms-flex;<br /> display: -ms-flexbox; </code> But if like any sane person you are using a CSS pre-processor like SASS there are some great mixins out there. I really like  mastastealth's <a href="https://github.com/mastastealth/sass-flex-mixin" title="">sass-flex-mixin</a>. There are also other bugs, please see the always excellent <a href="http://caniuse.com/#search=flexbox" title="Can I use Flexbox">Can I use Flexbox</a> for more information.</p>
                        
                    </div><!-- details -->
                </div><!-- col -->

                <div class="col">
                    <i class="icon2-table"></i>

                    <div class="details">
                        <h3>Display Table-header-group</h3>
                        <p>This technique can frighten some developers. The word table is enough for a lot of people to dismiss this without question. </p><p>But all this does is displays the element denoted as the header above the element set to the table-footer.</p>
                        <p>In this example the mark up is such that the navigation comes after the main content. This goes against some schools of thought. But as this page is built mobile first and we want the user to be able to get to the content as quickly as possible, I have decided the content is more important than navigation and should come below. We obviously need to give the user a nice quick way of getting to the navigation, so there is a single link above the content to take the user to the navigation.</p>
                        <p>Once the page width goes above our breakpoint we then apply a couple of css properties, we first give the navigation container display: table-header-group; and the content-group (a wrapper around all the main content of the page) display: table-footer-group;. This places the navigation in a traditional position above the content. We also hide the navigation skip link.</p>
                        <p>This technique is simple, with no JavaScript and provides quick access to content and navigation both on small screen and more traditional screen sizes.</p>
                        <h4>Compatibility</h4>
                        <p>Basically everything about IE7, so bloody use it.</p>
                    </div><!-- details -->
                </div><!-- col -->

                <div class="col">
                    <i class="icon2-css3"></i>

                    <div class="details">
                        <h3>Columns</h3>
                        <p>Hopefully if you are using a modern browser you have already seen column-count being used in the introduction of this page. If you have a wide content area and a lot of text, having long times of text can one look nasty, but two is really hard to read. This technique has been used in print for hundreds of years, and it is a huge surprise to me it has taken this long to have a workable version for the web.</p>
                        <p>People have been trying to do this on the web for years. Which is pretty easy in a non CMS'd site that the author is also the developer, but as soon as you need this to happen automatically (without JavaScript) and I think you might run into issues.</p>
                        <p>Column-count is a way of you controlling how many vertical columns your content is split up into, as simple as that really. There a number of additional properties that help you make this as pretty as possible. Above I have used column-gap and column-rule.</p>
                        <h4>Compatibility</h4>
                        <p>Column-count its self can be used be used on IE10 and greater. But both web-kit & Mozilla browsers need prefixes on break-before, break-after, break-inside.</p>
                    </div><!-- details -->
                </div><!-- col -->
            </section>
        </div><!-- end of content group-->
        <nav class="navigation" id="navigation">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="http://caniuse.com/#search=flex" target="_blank">Can I use Flex?</a></li>
                <li><a href="http://dev.w3.org/csswg/css-flexbox/" target="_blank">w3c Flex Spec Draft</a></li>
                <li><a href="http://philipwalton.github.io/solved-by-flexbox/">Paul Walton's examples</a></li>
                <li><a href="https://developer.mozilla.org/en-US/docs/Web/Guide/CSS/Flexible_boxes">Mozilla Flex Dev Guide</a></li>
            </ul>
        </nav>
    </div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>