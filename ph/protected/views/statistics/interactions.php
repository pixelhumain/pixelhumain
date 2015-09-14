<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5/dat.gui.min.js' , CClientScript::POS_END);
?>


<script type="text/javascript"		>
initT['animInit'] = function(){

	/*
	 * Copyright MIT © <2013> <Francesco Trillini>
	 *
	 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
	 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
	 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and 
	 * to permit persons to whom the Software is furnished to do so, subject to the following conditions:
	 
	 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
	 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR 
	 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
	 * FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
	 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	 */

	var Molecules = {}; 
	 
	;(function(Molecules, undefined) {
		
		var self = window.Molecules || {}, canvas, context, mouse = { x: 0, y: 0}, molecules = [], MAX_MOLECULES = ~~((innerWidth + innerHeight) / 20), FPS = 60;
		
		// Dat GUI default values
		var attraction = 0.0007, friction = 0.2, light = transparent = false, color = '#95ff00';
		
		/*
		 * Settings.
		 */
		
		var Settings = function() {
			
			this.attraction = 0.0007;
			this.friction = 0.2;
			this.light = this.transparent = false;
			this.color = '#95ff00';
			
			this.changeAttraction = function(value) {
			
				attraction = value;
			
			};
			
			this.changeFriction = function(value) {
			
				friction = value;
			
			};
			
			this.enableLight = function(value) {
			
				light = value;
			
			};
			
			this.enableTransparency = function(value) {
			
				transparent = value;
			
			};
			
			this.changeColor = function(value) {
			
				color = value;
			
			};
			
			this.deleteAll = function(value) {
			
				molecules = [];
			
			};
					
		};	
			
		/*
	 	 * Init.
		 */
		
		self.init = function() {
			
			var settings = new Settings();
			var GUI = new dat.GUI();
			
			// Dat GUI main
			GUI.add(settings, 'attraction').min(0.0005).max(0.005).onChange(settings.changeAttraction);
			GUI.add(settings, 'friction').min(0.1).max(0.9).onChange(settings.changeFriction);
			GUI.add(settings, 'light').onChange(settings.enableLight);
			GUI.add(settings, 'transparent').onChange(settings.enableTransparency);
			GUI.addColor(settings, 'color').onChange(settings.changeColor);
			GUI.add(settings, 'deleteAll');
			
			var body = document.querySelector('body');
			
			canvas = document.createElement('canvas');
				
			canvas.width = innerWidth;
			canvas.height = innerHeight;
			
			canvas.style.position = 'absolute';
			canvas.style.top = 0;
			canvas.style.bottom = 0;
			canvas.style.left = 0;
			canvas.style.right = 0;
			canvas.style.zIndex = -1;
	    
	    canvas.style.cursor = 'pointer';
			
			canvas.style.background = '-webkit-radial-gradient(rgb(100, 100, 100), rgb(0, 0, 0))'
			canvas.style.background = '-moz-radial-gradient(rgb(100, 100, 100), rgb(0, 0, 0))';
			canvas.style.background = '-ms-radial-gradient(rgb(100, 100, 100), rgb(0, 0, 0))';
			canvas.style.background = '-o-radial-gradient(rgb(100, 100, 100), rgb(0, 0, 0))';
			canvas.style.background = 'radial-gradient(rgb(100, 100, 100), rgb(0, 0, 0))';
			
	        body.appendChild(canvas);
			
			// Browser supports canvas?
			if(!!(self.gotSupport())) {
			
				context = canvas.getContext('2d');
					
				// Events
				if('ontouchstart' in window)
				
					canvas.addEventListener('touchstart', self.onTouchStart, false);
					
				else
				
					canvas.addEventListener('mousedown', self.onMouseDown, false);			
	      
				// On resize event			
				window.onresize = onResize;
			
				self.createMolecules();
				
			}
			
			else {
			
				console.error('Sorry, your browser sucks :(');
			
			}
	        
		};
		
		/*
		 * Checks if browser supports canvas element.
		 */
		
		self.gotSupport = function() {
		
			return canvas.getContext && canvas.getContext('2d');
		
		};
		
		/*
		 * On resize window event.
		 */
		
		function onResize() {
		
			canvas.width = window.innerWidth;
			canvas.height = window.innerHeight;
		
		}
		
		/*
		 * Mouse down event.
		 */
		
		self.onMouseDown = function(event) {
		
			event.preventDefault();
		
			mouse.x = event.pageX - canvas.offsetLeft;
			mouse.y = event.pageY - canvas.offsetTop;
				
			self.addMolecule();	
				
		};
		
		/*
		 * Touch start event.
		 */
		
		self.onTouchStart = function(event) {
		
			event.preventDefault();
			
			mouse.x = event.touches[0].pageX - canvas.offsetLeft;
			mouse.y = event.touches[0].pageY - canvas.offsetTop;
			
			self.addMolecule();	
				
		};
		
		/*
		 * Clear the screen.
		 */
		
		self.clear = function() {
		
			context.clearRect(0, 0, canvas.width, canvas.height);
			
		};
		
		/*
		 * Populate molecules.
		 */

		self.createMolecules = function() {
		
			for(var quantity = 0, len = MAX_MOLECULES; quantity < len; quantity++) {
			
				var radius = 2 + ~~(Math.random() * 8);
				
				molecules.push({
				
					x: 20 + Math.random() * (innerWidth - 40) | 0,
					y: 20 + Math.random() * (innerHeight - 40) | 0,
					vx: - 1 + Math.random() * 2,
					vy: - 1 + Math.random() * 2,
					minRadius: radius,
					maxRadius: radius	
					
				});
				
			}
			
			self.merge();
		
		};
		
		/*
		 * Add a new molecule.
		 */
		
		self.addMolecule = function() {
			
			var angle, radius;
			
			angle = Math.random() * Math.PI * 2;
			radius = 2 + ~~(Math.random() * 8);
				
			molecules.push({
				
				x: mouse.x,
				y: mouse.y,
				vx: 2 + Math.random() * 6 * Math.cos(angle),
				vy: 2 + Math.random() * 6 * Math.sin(angle),
				minRadius: radius,
				maxRadius: 0
				
			});
		
		};
		
		/*
		 * Let's merge our molecules! :D
		 */
		
		self.merge = function() {
		
			self.clear();
			
			molecules.forEach(function(molecule, index) {
				
				// Add velocity
				molecule.x += molecule.vx;
				molecule.y += molecule.vy;
				
				// Reach the towards radius
				molecule.maxRadius += (molecule.minRadius - molecule.maxRadius) * 0.1;
				
				// Width bounds
				if((molecule.x >= canvas.width - molecule.maxRadius * 4 && molecule.vx > 0) || (molecule.x <= molecule.maxRadius * 4 && molecule.vx < 0)) {
				
					molecule.vx *= -1;
					molecule.vx *= friction;
					
				}
					
				// Height bounds	
				if((molecule.y >= canvas.height - molecule.maxRadius * 4 && molecule.vy > 0) || (molecule.y <= molecule.maxRadius * 4 && molecule.vy < 0)) {
				
					molecule.vy *= -1;
					molecule.vy *= friction;
					
				}
						
				// Checks a neighborhood nextBludger
				for(var nextMolecule = index + 1; nextMolecule < molecules.length; nextMolecule++) {
				
					var otherMolecule = molecules[nextMolecule];
					
					// Oh we've found one!
					if(self.distanceTo(molecule, otherMolecule) < 100) {
						
						context.save();
						context.beginPath();
						context.globalCompositeOperation = 'destination-over';
						context.globalAlpha = 1 - self.distanceTo(molecule, otherMolecule) / 100;
						context.lineWidth = 1;
						context.strokeStyle = color;
						context.moveTo(molecule.x, molecule.y);
						context.lineTo(otherMolecule.x, otherMolecule.y);
						context.stroke();
						context.closePath();
						context.restore();
					
						// Spring force	
						var attractionX = (molecule.x - otherMolecule.x) * attraction;
						var attractionY = (molecule.y - otherMolecule.y) * attraction;
						
						molecule.vx -= attractionX;
						molecule.vy -= attractionY;
						
						otherMolecule.vx += attractionX;
						otherMolecule.vy += attractionY;
						 	  
					} 
					
				}
							
				// Drawing stuff
				if(!transparent) {
				
					context.save();
					context.globalCompositeOperation = 'lighter';
					context.translate(molecule.x, molecule.y);
					
					// Radial shadow
					var gradient = context.createRadialGradient(0, 0, 0, 0, 0, molecule.maxRadius * 2);
					gradient.addColorStop(0, color);
					!light ? gradient.addColorStop(1, 'rgba(0, 0, 0, 0.2)') : gradient.addColorStop(1, 'rgba(255, 255, 255, 0.2)');
				
					context.fillStyle = gradient;
					context.beginPath();
					context.arc(0, 0, molecule.maxRadius * 4, 0, Math.PI * 2);
					context.closePath();
					context.fill();
					context.restore();
					
				}
					
			});
					
			requestAnimFrame(self.merge);
		
		};
		
		/*
		 * Distance between two points.
		 */
		
		self.distanceTo = function(pointA, pointB) {
		
			var dx = Math.abs(pointA.x - pointB.x);
			var dy = Math.abs(pointA.y - pointB.y);
			
			return Math.sqrt(dx * dx + dy * dy);
		
		};
		
		/*
		 * Request new frame by Paul Irish.
		 * 60 FPS.
		 */
		
		window.requestAnimFrame = (function() {
		 
			return  window.requestAnimationFrame       || 
				window.webkitRequestAnimationFrame || 
				window.mozRequestAnimationFrame    || 
				window.oRequestAnimationFrame      || 
				window.msRequestAnimationFrame     || 
				  
				function(callback) {
				  
					window.setTimeout(callback, 1000 / FPS);
					
				};
				  
	    	})();

		window.addEventListener ? window.addEventListener('load', self.init, false) : window.onload = self.init;
		
	})(Molecules);

};
</script>	