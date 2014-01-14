

<!-- BLOCK CSS -->
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
@charset "UTF-8";
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

html, body {
  height: 100%;
  width: 100%;
}

a {
  text-decoration: none;
  color: #30436e;
}
a:hover {
  text-decoration: underline;
  color: #96a8d2;
}

header[role="banner"] {
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -ms-transform: translateZ(0);
  -o-transform: translateZ(0);
  transform: translateZ(0);
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  z-index: 1;
  width: 230px;
  background: #32394B;
}

.utility-nav {
  position: relative;
}

.utility-nav__items {
  padding: 18px 0;
  background: #4966A0;
  font-size: 12px;
  font-size: .75rem;
  text-align: center;
}
.utility-nav__items span:after {
  content: "•";
  margin: 0 5px;
}
.utility-nav__items span:last-child:after {
  content: "";
}

form {
  width: 92%;
  margin: 10px auto;
}

input[type="search"] {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  width: 100%;
  box-shadow: inset 0 2px 2px rgba(0, 0, 0, 0.5);
  border: none;
  padding: 8px;
  background: #484A5B;
}

.menu__items {
  list-style-type: none;
  padding: 0 10px;
  width: 100%;
}
.menu__items:before {
  border-bottom: 1px solid #414656;
  content: "Favorites";
  display: block;
  margin-bottom: 10px;
  width: 100%;
  font-size: 12px;
  font-size: .675rem;
  color: #747687;
}
.menu__items li {
  box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.2), 0 1px 0 rgba(255, 255, 255, 0.05);
}
.menu__items li:last-child {
  box-shadow: none;
}
.menu__items a {
  display: inline-block;
  padding: 10px 0;
  color: white;
}

.menu-trigger {
  height: 25px;
  width: 25px;
  position: absolute;
  top: 12px;
  left: 10px;
  z-index: 1;
  text-indent: -9999em;
  background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/392/menu-alt-512.png) top left no-repeat;
  background-size: cover;
  color: white;
}
.menu-trigger:hover {
  cursor: pointer;
}

.status-nav {
  padding: 14px 0;
  width: 100%;
  background: #E9E9E9;
  text-align: center;
}
.status-nav span:after {
  content: "•";
  margin: 0 5px;
}
.status-nav span:last-child:after {
  content: "";
}

.panel {
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -ms-transform: translateZ(0);
  -o-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-transition: 0.275s transform ease-in-out;
  -moz-transition: 0.275s transform ease-in-out;
  -o-transition: 0.275s transform ease-in-out;
  transition: 0.275s transform ease-in-out;
  height: 100%;
  width: 100%;
  overflow: auto;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 2;
  background: #C4CDDF;
}
.panel.is-moved {
  -webkit-transform: translateX(230px);
  -moz-transform: translateX(230px);
  -ms-transform: translateX(230px);
  -o-transform: translateX(230px);
  transform: translateX(230px);
}

.l-users {
  width: 100%;
  padding: 0 10px;
  position: relative;
  margin: 10px auto;
}

.random-user--wrap {
  margin: 60px 0;
  padding: 10px;
  position: relative;
  background: white;
}
.random-user--wrap:first-child {
  margin-top: 10px;
}

.random-user__name {
  margin: 0;
  position: absolute;
  top: 10px;
  left: 70px;
  font-size: 11px;
  font-size: .675rem;
}

.share {
  list-style-type: none;
  padding: 0;
  margin: 0;
  width: 100%;
  display: flex;
  flex-flow: row wrap;
  flew-direction: row;
  background: #EFF2F5;
  position: absolute;
  bottom: -50px;
  left: 0;
}
.share li {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 50px;
  width: 33.333333%;
  border-right: 2px solid #DBDEE1;
  text-align: center;
}
.share li:last-child {
  border-right: none;
}
</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">
	<header class="panel--reset" role="banner">
  <form role="form">
    <input type="search" placeholder="Search">
  </form>

  <nav role="navigation">
    <ul class="menu__items">
      <li><a href="#">News Feed</a></li>
      <li><a href="#">Messages</a></li>
      <li><a href="#">Nearby</a></li>
      <li><a href="#">Events</a></li>
      <li><a href="#">Friends</a></li>
    </ul>
  </nav>
</header>

<!-- #Panel -->
<div class="panel panel--reset" role="main">

  <b class="menu-trigger">menu</b>

  <div class="utility-nav">

    <div class="utility-nav__items panel--reset">
      <span><a href="#friend-requests">Friend Requests</a></span>
      <span><a href="#messages">Messages</a></span>
      <span><a href="#notifications">Notifications</a></span>
    </div>

    <div class="status-nav panel--reset">
      <span><a href="#status">Status</a></span>
      <span><a href="#photo">Photo</a></span>
      <span><a href="#check-in">Check In</a></span>
    </div>
  </div>

  <div class="fb-users l-users">
    <div class="random-user--wrap panel--reset">
      <img src="" width="50" height="auto" alt="">
      <p class="random-user__name"><span class="fname"></span> <span class="lname"></span></p>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

      <ul class="share">
        <li><a href="#like">Like</a></li>
        <li><a href="#comment">Comment</a></li>
        <li><a href="#share">Share</a></li>
      </ul> 
    </div>
    
    <div class="random-user--wrap panel--reset">
      <img src="" width="50" height="auto" alt="">
      <p class="random-user__name"><span class="fname"></span> <span class="lname"></span></p>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

      <ul class="share">
        <li><a href="#like">Like</a></li>
        <li><a href="#comment">Comment</a></li>
        <li><a href="#share">Share</a></li>
      </ul>  
    </div>
      
    <div class="random-user--wrap panel--reset">
      <img src="" width="50" height="auto" alt="">
      <p class="random-user__name"><span class="fname"></span> <span class="lname"></span></p>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      
      <ul class="share">
        <li><a href="#like">Like</a></li>
        <li><a href="#comment">Comment</a></li>
        <li><a href="#share">Share</a></li>
      </ul> 
    </div>
    
    <div class="random-user--wrap panel--reset">
      <img src="" width="50" height="auto" alt="">
      <p class="random-user__name"><span class="fname"></span> <span class="lname"></span></p>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      
      <ul class="share">
        <li><a href="#like">Like</a></li>
        <li><a href="#comment">Comment</a></li>
        <li><a href="#share">Share</a></li>
      </ul>
    </div>
    
    <div class="random-user--wrap panel--reset">
      <img src="" width="50" height="auto" alt="">
      <p class="random-user__name"><span class="fname"></span> <span class="lname"></span></p>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      
      <ul class="share">
        <li><a href="#like">Like</a></li>
        <li><a href="#comment">Comment</a></li>
        <li><a href="#share">Share</a></li>
      </ul>
    </div>
  </div>
</div>


	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){
	!function(){"use strict";function a(b){if(!(this instanceof a))return new a(b);if(!b)throw new Error("No DOM elements passed into Touche");return this.nodes=b,this}var b="ontouchstart"in window||"msmaxtouchpoints"in window.navigator;if(a.prototype.on=function(a,c){var d,e,f=this.nodes,g=f.length;if(b&&"click"===a&&(d=!0),e=function(a,b,c){var e,f=function(){!e&&(e=!0)&&c.apply(this,arguments)};a.addEventListener(b,f,!1),d&&a.addEventListener("touchend",f,!1)},g)for(;g--;)e(f[g],a,c);else e(f,a,c);return this},window.Touche=a,window.jQuery&&b){var c=jQuery.fn.on;jQuery.fn.on=function(){var a=arguments[0];return arguments[0]="click"===a?"touchend":a,c.apply(this,arguments),this}}}();


// DemoJS
// ======================================================

$('.menu-trigger').on('click', function() {
  $('.panel').toggleClass('is-moved');
});

// http://stackoverflow.com/questions/18409551/prevent-nested-elements-from-triggering-an-event-for-parent-element
$('.panel--reset').on('click', function(e) {
  if(e.target == e.currentTarget) {
    $('.panel').toggleClass('is-moved');
  }
});


// Random User
// http://randomuser.me
// ======================================================

$.ajax({
  url: 'http://api.randomuser.me/?results=5',
  dataType: 'json',
  success: function(data) {
    // uncomment console.log to view the user Object
    // console.log(data.results);

    $('.random-user--wrap > img').each(function(i) {
      $(this).attr('src', data.results[i].user.picture);
    });
    
    $('.fb-users > .random-user--wrap span.fname').each(function(i) {
      $(this).append(data.results[i].user.name.first);
    });

    $('.fb-users > .random-user--wrap span.lname').each(function(i) {
      $(this).append(data.results[i].user.name.last);
    });
  }
});

  
};
</script>