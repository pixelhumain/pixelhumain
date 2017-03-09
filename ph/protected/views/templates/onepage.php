<?php 
$cs = Yii::app()->getClientScript();
//$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.6/jquery.scrollTo.min.js' , CClientScript::POS_END);
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans);
*, *:before, *:after { box-sizing: border-box; }

html { height: 100%; width: 100%; background: aaa;}
body { font: 15px/1em 'Open Sans', sans-serif; }

/* Main Nav */
#main-nav 			{ position: absolute; width: 100%; background: #bbb; z-index:1; height: 75px; left: 0; top:60px;} /* Height of header */
#main-nav.fixed		{ position: fixed; top:60px;}

#main-nav li { float: left; text-align:center; width: 20%;}
#main-nav .current a { background: #aaa; color: #fff;}
#main-nav a	 { padding: 30px; display: block; color: #111; text-decoration: none; text-transform: uppercase;}
#main-nav a:hover { background: #ddd;}

/* Main Content */
#main-wrapper { width: 85%; margin: 0 auto;}

.wrapper		  { height: 375px; text-align: center; font-weight: bold; padding: 150px 0 0 0;} /* Height of nav bar added to total height: 300 */

/* Section Background Colors */
#main-header,
#main-footer  { background: #f1c40f;}
#section01 		{ background: #2ecc71;}
#section02 		{ background: #e74c3c;}
#section03 		{ background: #16a085;}
#section04 		{ background: #2c3e50;}
</style>

<!-- Start Main Nav -->
<nav id='main-nav'>
  <ul id='main-nav-list'>
    <li>
      <a href='#main-header'>Top</a>
    </li>
    <li>
      <a href='#section01'>Section 1</a>
    </li>
    <li>
      <a href='#section02'>Section 2</a>
    </li>
    <li>
      <a href='#section03'>Section 3</a>
    </li>
    <li>
      <a href='#section04'>Section 4</a>
    </li>
  </ul>
</nav>
<!-- End Main Nav -->
<!-- Start Conent Wrapper -->
<div id='main-wrapper'>
  <!-- Start Header -->
  <header class='wrapper' id='main-header'>
    <h1>Header</h1>
  </header>
  <!-- Start Section 01 -->
  <section class='wrapper' id='section01'>
    <h1>Section 1</h1>
  </section>
  <!-- Start Section 02 -->
  <section class='wrapper' id='section02'>
    <h1>Section 2</h1>
  </section>
  <!-- Start Section 03 -->
  <section class='wrapper' id='section03'>
    <h1>Section 3</h1>
  </section>
  <!-- Start Section 04 -->
  <section class='wrapper' id='section04'>
    <h1>Section 4</h1>
  </section>
  <!-- Start Footer -->
  <footer class='wrapper' id='main-footer'>
    <h1>Footer</h1>
  </footer>
</div>
<!-- End Content Wrapper -->


<script type="text/javascript"		>
initT['animInit'] = function(){
	// Sticky navigation with content section highlight.

	// Help from https://github.com/davist11/jQuery-One-Page-Nav and http://jqueryfordesigners.com/fixed-floating-elements/


	$(document).ready(function() {
	  $('#main-nav-list').onePageNav({
	    scrollThreshold: 0.0, // Adjust if Navigation highlights too early or too late
	    scrollOffset: 75 //Height of Navigation Bar
	  });
	  
	  // Sticky Header - http://jqueryfordesigners.com/fixed-floating-elements/         
	  var top = $('#main-nav').offset().top - parseFloat($('#main-nav').css('margin-top').replace(/auto/, 0));
	  
	  $(window).scroll(function (event) {
	    // what the y position of the scroll is
	    var y = $(this).scrollTop();
	    
	    // whether that's below the form
	    if (y >= top) {
	      // if so, ad the fixed class
	      $('#main-nav').addClass('fixed');
	    } else {
	      // otherwise remove it
	      $('#main-nav').removeClass('fixed');
	    }
	  });
	  
	});

	// Custom 

	/*
	 * jQuery One Page Nav Plugin
	 * http://github.com/davist11/jQuery-One-Page-Nav
	 *
	 * Copyright (c) 2010 Trevor Davis (http://trevordavis.net)
	 * Dual licensed under the MIT and GPL licenses.
	 * Uses the same license as jQuery, see:
	 * http://jquery.org/license
	 *
	 * @version 2.2
	 *
	 * Example usage:
	 * $('#nav').onePageNav({
	 *   currentClass: 'current',
	 *   changeHash: false,
	 *   scrollSpeed: 750
	 * });
	 */

	;(function($, window, document, undefined){

		// our plugin constructor
		var OnePageNav = function(elem, options){
			this.elem = elem;
			this.$elem = $(elem);
			this.options = options;
			this.metadata = this.$elem.data('plugin-options');
			this.$nav = this.$elem.find('a');
			this.$win = $(window);
			this.sections = {};
			this.didScroll = false;
			this.$doc = $(document);
			this.docHeight = this.$doc.height();
		};

		// the plugin prototype
		OnePageNav.prototype = {
			defaults: {
				currentClass: 'current',
				changeHash: false,
				easing: 'swing',
				filter: '',
				scrollSpeed: 750,
				scrollOffset: 0,
				scrollThreshold: 0.5,
				begin: false,
				end: false,
				scrollChange: false
			},

			init: function() {
				var self = this;
				
				// Introduce defaults that can be extended either
				// globally or using an object literal.
				self.config = $.extend({}, self.defaults, self.options, self.metadata);
				
				//Filter any links out of the nav
				if(self.config.filter !== '') {
					self.$nav = self.$nav.filter(self.config.filter);
				}
				
				//Handle clicks on the nav
				self.$nav.on('click.onePageNav', $.proxy(self.handleClick, self));

				//Get the section positions
				self.getPositions();
				
				//Handle scroll changes
				self.bindInterval();
				
				//Update the positions on resize too
				self.$win.on('resize.onePageNav', $.proxy(self.getPositions, self));

				return this;
			},
			
			adjustNav: function(self, $parent) {
				self.$elem.find('.' + self.config.currentClass).removeClass(self.config.currentClass);
				$parent.addClass(self.config.currentClass);
			},
			
			bindInterval: function() {
				var self = this;
				var docHeight;
				
				self.$win.on('scroll.onePageNav', function() {
					self.didScroll = true;
				});
				
				self.t = setInterval(function() {
					docHeight = self.$doc.height();
					
					//If it was scrolled
					if(self.didScroll) {
						self.didScroll = false;
						self.scrollChange();
					}
					
					//If the document height changes
					if(docHeight !== self.docHeight) {
						self.docHeight = docHeight;
						self.getPositions();
					}
				}, 250);
			},
			
			getHash: function($link) {
				return $link.attr('href').split('#')[1];
			},
			
			getPositions: function() {
				var self = this;
				var linkHref;
				var topPos;
				var $target;
				
				self.$nav.each(function() {
					linkHref = self.getHash($(this));
					$target = $('#' + linkHref);

					if($target.length) {
						topPos = $target.offset().top;
						self.sections[linkHref] = Math.round(topPos) - self.config.scrollOffset;
					}
				});
			},
			
			getSection: function(windowPos) {
				var returnValue = null;
				var windowHeight = Math.round(this.$win.height() * this.config.scrollThreshold);

				for(var section in this.sections) {
					if((this.sections[section] - windowHeight) < windowPos) {
						returnValue = section;
					}
				}
				
				return returnValue;
			},
			
			handleClick: function(e) {
				var self = this;
				var $link = $(e.currentTarget);
				var $parent = $link.parent();
				var newLoc = '#' + self.getHash($link);
				
				if(!$parent.hasClass(self.config.currentClass)) {
					//Start callback
					if(self.config.begin) {
						self.config.begin();
					}
					
					//Change the highlighted nav item
					self.adjustNav(self, $parent);
					
					//Removing the auto-adjust on scroll
					self.unbindInterval();
					
					//Scroll to the correct position
					$.scrollTo(newLoc, self.config.scrollSpeed, {
						axis: 'y',
						easing: self.config.easing,
						offset: {
							top: -self.config.scrollOffset
						},
						onAfter: function() {
							//Do we need to change the hash?
							if(self.config.changeHash) {
								window.location.hash = newLoc;
							}
							
							//Add the auto-adjust on scroll back in
							self.bindInterval();
							
							//End callback
							if(self.config.end) {
								self.config.end();
							}
						}
					});
				}

				e.preventDefault();
			},
			
			scrollChange: function() {
				var windowTop = this.$win.scrollTop();
				var position = this.getSection(windowTop);
				var $parent;
				
				//If the position is set
				if(position !== null) {
					$parent = this.$elem.find('a[href$="#' + position + '"]').parent();
					
					//If it's not already the current section
					if(!$parent.hasClass(this.config.currentClass)) {
						//Change the highlighted nav item
						this.adjustNav(this, $parent);
						
						//If there is a scrollChange callback
						if(this.config.scrollChange) {
							this.config.scrollChange($parent);
						}
					}
				}
			},
			
			unbindInterval: function() {
				clearInterval(this.t);
				this.$win.unbind('scroll.onePageNav');
			}
		};

		OnePageNav.defaults = OnePageNav.prototype.defaults;

		$.fn.onePageNav = function(options) {
			return this.each(function() {
				new OnePageNav(this, options).init();
			});
		};
		
	})( jQuery, window , document );
  
};
</script>