<?php
/** @var CClientScript $cs */
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/pricing.css');
?>
<style>

h2 {
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  font-family: "Homestead";
}
</style>
<div class="container" id="accueil">
    <br/>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit">
    <h2>Financement Citoyen</h2>
	Le Crowd Funding, n'est pas nouveau en soi, mais aujourd'hui, c'est devenue une facon d'etre soutenue et levé des fonds de facon participative.
	<h3>Le principe</h3>
	- Donner une petite somme pour participer au financement d'un projet qui demande de grand moyen
	- Plus on est nombreux, plus la somme a donner individuelle sera faible <br/>
	- Pourquoi attendre des subventions, si on peut se regrouper entre citoyens, et développer le projet tout de suite<br/>
	- Un don de confiance et de finance
	 
	Avec le Financement citoyen des projets comme le Pixel Humain peuvent voir le jour beaucoup rapidement.
    <h3>Pourquoi ?</h3>
    - Payer le dévellopement <br/>
    - Payer le graphisme <br/>
    - Payer la communication et le marketing<br/>
    - Perreniser le projet dans le temps  <br/>
    
    <h3>Qu'est ce que j'ai a y gagner ?</h3>

<ul class="pricing_table">
		<li class="price_block">
			<h3>CITOYEN</h3>
			<div class="price">
				<div class="price_figure">
					<span class="price_number">GRATUIT</span>
					<span class="price_tenure">pour toujours</span>
				</div>
			</div>
			<ul class="features">
				<li>Utilsez</li>
				<li>Contribuez</li>
				<li>Participez</li>
				<li>Agissez</li>
				<li>Réflechissez</li>
				<li>24/7 support Email</li>
			</ul>
			<div class="footer">
				<a href="javascript:alert('');" class="action_button">C'est parti</a>
			</div>
		</li>
		<li class="price_block">
			<h3>CITOYEN++</h3>
			<div class="price">
				<div class="price_figure">
					<span class="price_number">1€</span>
					<span class="price_tenure">soutien pour 1an</span>
				</div>
			</div>
			<ul class="features">
				<li>Carte d'adhérent</li>
				<li>1 Sticker</li>
				<li>10 Active Projects</li>
				<li>10 Colors</li>
				<li>Contact privilégié</li>
				<li>24/7 Email support</li>
			</ul>
			<div class="footer">
				<a href="#" class="action_button">C'est parti</a>
			</div>
		</li>
		<li class="price_block">
			<h3>A Vie</h3>
			<div class="price">
				<div class="price_figure">
					<span class="price_number">100€</span>
					<span class="price_tenure">soutien à vie</span>
				</div>
			</div>
			<ul class="features">
				<li>1 Tshirt</li>
				<li>1 Affiche Proverbe</li>
				<li>1 Carambar</li>
				<li>1 Sticker</li>
				<li>un contact direct</li>
				<li>24/7 Email support</li>
			</ul>
			<div class="footer">
				<a href="#" class="action_button">C'est parti</a>
				
			</div>
		</li>
		<li class="price_block">
			<h3>5 vies</h3>
			<div class="price">
				<div class="price_figure">
					<span class="price_number">500€</span>
					<span class="price_tenure">soutien pour 5 vies</span>
				</div>
			</div>
			<ul class="features">
				<li>Unlimited Storage</li>
				<li>Unlimited Clients</li>
				<li>Unlimited Projects</li>
				<li>Unlimited Colors</li>
				<li>Free Goodies</li>
				<li>24/7 Email support</li>
			</ul>
			<div class="footer">
				<a href="#" class="action_button">C'est parti</a>
			</div>
		</li>
	</ul>
	<div class="clear"></div>
</div>
</div>	
	
	<ul class="skeleton pricing_table" style="margin-top: 100px; overflow: hidden;">
		<li class="label" style="margin: 0 none;">ul.pricing_table</li>
		<li class="price_block">
			<span class="label">li.price_block</span>
			<h3><span class="label">h3</span></h3>
			<div class="price">
				<span class="label">div.price</span>
				<div class="price_figure">
					<span class="label">div.price_figure</span>
					<span class="price_number">
						<span class="label">span.price_number</span>
					</span>
					<span class="price_tenure">
						<span class="label">span.price_tenure</span>
					</span>
				</div>
			</div>
			<ul class="features">
				<li class="label">ul.features</li>
				<br /><br /><br />
			</ul>
			<div class="footer">
				<span class="label">div.footer</span>
			</div>
		</li>
		
		
		<li class="price_block" style="opacity: 0.5;">
			<span class="label">li.price_block</span>
			<h3><span class="label">h3</span></h3>
			<div class="price">
				<span class="label">div.price</span>
				<div class="price_figure">
					<span class="label">div.price_figure</span>
					<span class="price_number">
						<span class="label">span.price_number</span>
					</span>
					<span class="price_tenure">
						<span class="label">span.price_tenure</span>
					</span>
				</div>
			</div>
			<ul class="features">
				<li class="label">ul.features</li>
				<br /><br /><br />
			</ul>
			<div class="footer">
				<span class="label">div.footer</span>
			</div>
		</li>
		<li class="price_block" style="opacity: 0.25;">
			<span class="label">li.price_block</span>
			<h3><span class="label">h3</span></h3>
			<div class="price">
				<span class="label">div.price</span>
				<div class="price_figure">
					<span class="label">div.price_figure</span>
					<span class="price_number">
						<span class="label">span.price_number</span>
					</span>
					<span class="price_tenure">
						<span class="label">span.price_tenure</span>
					</span>
				</div>
			</div>
			<ul class="features">
				<li class="label">ul.features</li>
				<br /><br /><br />
			</ul>
			<div class="footer">
				<span class="label">div.footer</span>
			</div>
		</li>
	</ul>
	<script>
	/**
	 * StyleFix 1.0.3 & PrefixFree 1.0.7
	 * @author Lea Verou
	 * MIT license
	 */
	 (function(){function t(e,t){return[].slice.call((t||document).querySelectorAll(e))}if(!window.addEventListener)return;var e=window.StyleFix={link:function(t){try{if(t.rel!=="stylesheet"||t.hasAttribute("data-noprefix"))return}catch(n){return}var r=t.href||t.getAttribute("data-href"),i=r.replace(/[^\/]+$/,""),s=(/^[a-z]{3,10}:/.exec(i)||[""])[0],o=(/^[a-z]{3,10}:\/\/[^\/]+/.exec(i)||[""])[0],u=/^([^?]*)\??/.exec(r)[1],a=t.parentNode,f=new XMLHttpRequest,l;f.onreadystatechange=function(){f.readyState===4&&l()};l=function(){var n=f.responseText;if(n&&t.parentNode&&(!f.status||f.status<400||f.status>600)){n=e.fix(n,!0,t);if(i){n=n.replace(/url\(\s*?((?:"|')?)(.+?)\1\s*?\)/gi,function(e,t,n){return/^([a-z]{3,10}:|#)/i.test(n)?e:/^\/\//.test(n)?'url("'+s+n+'")':/^\//.test(n)?'url("'+o+n+'")':/^\?/.test(n)?'url("'+u+n+'")':'url("'+i+n+'")'});var r=i.replace(/([\\\^\$*+[\]?{}.=!:(|)])/g,"\\$1");n=n.replace(RegExp("\\b(behavior:\\s*?url\\('?\"?)"+r,"gi"),"$1")}var l=document.createElement("style");l.textContent=n;l.media=t.media;l.disabled=t.disabled;l.setAttribute("data-href",t.getAttribute("href"));a.insertBefore(l,t);a.removeChild(t);l.media=t.media}};try{f.open("GET",r);f.send(null)}catch(n){if(typeof XDomainRequest!="undefined"){f=new XDomainRequest;f.onerror=f.onprogress=function(){};f.onload=l;f.open("GET",r);f.send(null)}}t.setAttribute("data-inprogress","")},styleElement:function(t){if(t.hasAttribute("data-noprefix"))return;var n=t.disabled;t.textContent=e.fix(t.textContent,!0,t);t.disabled=n},styleAttribute:function(t){var n=t.getAttribute("style");n=e.fix(n,!1,t);t.setAttribute("style",n)},process:function(){t('link[rel="stylesheet"]:not([data-inprogress])').forEach(StyleFix.link);t("style").forEach(StyleFix.styleElement);t("[style]").forEach(StyleFix.styleAttribute)},register:function(t,n){(e.fixers=e.fixers||[]).splice(n===undefined?e.fixers.length:n,0,t)},fix:function(t,n,r){for(var i=0;i<e.fixers.length;i++)t=e.fixers[i](t,n,r)||t;return t},camelCase:function(e){return e.replace(/-([a-z])/g,function(e,t){return t.toUpperCase()}).replace("-","")},deCamelCase:function(e){return e.replace(/[A-Z]/g,function(e){return"-"+e.toLowerCase()})}};(function(){setTimeout(function(){t('link[rel="stylesheet"]').forEach(StyleFix.link)},10);document.addEventListener("DOMContentLoaded",StyleFix.process,!1)})()})();(function(e){function t(e,t,r,i,s){e=n[e];if(e.length){var o=RegExp(t+"("+e.join("|")+")"+r,"gi");s=s.replace(o,i)}return s}if(!window.StyleFix||!window.getComputedStyle)return;var n=window.PrefixFree={prefixCSS:function(e,r,i){var s=n.prefix;n.functions.indexOf("linear-gradient")>-1&&(e=e.replace(/(\s|:|,)(repeating-)?linear-gradient\(\s*(-?\d*\.?\d*)deg/ig,function(e,t,n,r){return t+(n||"")+"linear-gradient("+(90-r)+"deg"}));e=t("functions","(\\s|:|,)","\\s*\\(","$1"+s+"$2(",e);e=t("keywords","(\\s|:)","(\\s|;|\\}|$)","$1"+s+"$2$3",e);e=t("properties","(^|\\{|\\s|;)","\\s*:","$1"+s+"$2:",e);if(n.properties.length){var o=RegExp("\\b("+n.properties.join("|")+")(?!:)","gi");e=t("valueProperties","\\b",":(.+?);",function(e){return e.replace(o,s+"$1")},e)}if(r){e=t("selectors","","\\b",n.prefixSelector,e);e=t("atrules","@","\\b","@"+s+"$1",e)}e=e.replace(RegExp("-"+s,"g"),"-");e=e.replace(/-\*-(?=[a-z]+)/gi,n.prefix);return e},property:function(e){return(n.properties.indexOf(e)?n.prefix:"")+e},value:function(e,r){e=t("functions","(^|\\s|,)","\\s*\\(","$1"+n.prefix+"$2(",e);e=t("keywords","(^|\\s)","(\\s|$)","$1"+n.prefix+"$2$3",e);return e},prefixSelector:function(e){return e.replace(/^:{1,2}/,function(e){return e+n.prefix})},prefixProperty:function(e,t){var r=n.prefix+e;return t?StyleFix.camelCase(r):r}};(function(){var e={},t=[],r={},i=getComputedStyle(document.documentElement,null),s=document.createElement("div").style,o=function(n){if(n.charAt(0)==="-"){t.push(n);var r=n.split("-"),i=r[1];e[i]=++e[i]||1;while(r.length>3){r.pop();var s=r.join("-");u(s)&&t.indexOf(s)===-1&&t.push(s)}}},u=function(e){return StyleFix.camelCase(e)in s};if(i.length>0)for(var a=0;a<i.length;a++)o(i[a]);else for(var f in i)o(StyleFix.deCamelCase(f));var l={uses:0};for(var c in e){var h=e[c];l.uses<h&&(l={prefix:c,uses:h})}n.prefix="-"+l.prefix+"-";n.Prefix=StyleFix.camelCase(n.prefix);n.properties=[];for(var a=0;a<t.length;a++){var f=t[a];if(f.indexOf(n.prefix)===0){var p=f.slice(n.prefix.length);u(p)||n.properties.push(p)}}n.Prefix=="Ms"&&!("transform"in s)&&!("MsTransform"in s)&&"msTransform"in s&&n.properties.push("transform","transform-origin");n.properties.sort()})();(function(){function i(e,t){r[t]="";r[t]=e;return!!r[t]}var e={"linear-gradient":{property:"backgroundImage",params:"red, teal"},calc:{property:"width",params:"1px + 5%"},element:{property:"backgroundImage",params:"#foo"},"cross-fade":{property:"backgroundImage",params:"url(a.png), url(b.png), 50%"}};e["repeating-linear-gradient"]=e["repeating-radial-gradient"]=e["radial-gradient"]=e["linear-gradient"];var t={initial:"color","zoom-in":"cursor","zoom-out":"cursor",box:"display",flexbox:"display","inline-flexbox":"display",flex:"display","inline-flex":"display",grid:"display","inline-grid":"display","min-content":"width"};n.functions=[];n.keywords=[];var r=document.createElement("div").style;for(var s in e){var o=e[s],u=o.property,a=s+"("+o.params+")";!i(a,u)&&i(n.prefix+a,u)&&n.functions.push(s)}for(var f in t){var u=t[f];!i(f,u)&&i(n.prefix+f,u)&&n.keywords.push(f)}})();(function(){function s(e){i.textContent=e+"{}";return!!i.sheet.cssRules.length}var t={":read-only":null,":read-write":null,":any-link":null,"::selection":null},r={keyframes:"name",viewport:null,document:'regexp(".")'};n.selectors=[];n.atrules=[];var i=e.appendChild(document.createElement("style"));for(var o in t){var u=o+(t[o]?"("+t[o]+")":"");!s(u)&&s(n.prefixSelector(u))&&n.selectors.push(o)}for(var a in r){var u=a+" "+(r[a]||"");!s("@"+u)&&s("@"+n.prefix+u)&&n.atrules.push(a)}e.removeChild(i)})();n.valueProperties=["transition","transition-property"];e.className+=" "+n.prefix;StyleFix.register(n.prefixCSS)})(document.documentElement);
	</script>