<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/menu/normalize.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/menu/demo.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/menu/icons.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/menu/component.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/menu/modernizr.custom.js' , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/menu/classie.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/menu/mlpushmenu.js' , CClientScript::POS_END);
?>
<!-- mp-menu -->
<nav id="mp-menu" class="mp-menu">
	<div class="mp-level">
		<h2 class="icon icon-world">All Categories</h2>
		<ul>
			<li class="icon icon-arrow-left">
				<a class="icon icon-display" href="#">Devices</a>
				<div class="mp-level">
					<h2 class="icon icon-display">Devices</h2>
					<a class="mp-back" href="#">retour</a>
					<ul>
						<li class="icon icon-arrow-left">
							<a class="icon icon-phone" href="#">Mobile Phones</a>
							<div class="mp-level">
								<h2>Mobile Phones</h2>
								<a class="mp-back" href="#">retour</a>
								<ul>
									<li><a href="#">Super Smart Phone</a></li>
									<li><a href="#">Thin Magic Mobile</a></li>
									<li><a href="#">Performance Crusher</a></li>
									<li><a href="#">Futuristic Experience</a></li>
								</ul>
							</div>
						</li>
						<li class="icon icon-arrow-left">
							<a class="icon icon-tv" href="#">Televisions</a>
							<div class="mp-level">
								<h2>Televisions</h2>
								<a class="mp-back" href="#">retour</a>
								<ul>
									<li><a href="#">Flat Superscreen</a></li>
									<li><a href="#">Gigantic LED</a></li>
									<li><a href="#">Power Eater</a></li>
									<li><a href="#">3D Experience</a></li>
									<li><a href="#">Classic Comfort</a></li>
								</ul>
							</div>
						</li>
						<li class="icon icon-arrow-left">
							<a class="icon icon-camera" href="#">Cameras</a>
							<div class="mp-level">
								<h2>Cameras</h2>
								<a class="mp-back" href="#">retour</a>
								<ul>
									<li><a href="#">Smart Shot</a></li>
									<li><a href="#">Power Shooter</a></li>
									<li><a href="#">Easy Photo Maker</a></li>
									<li><a href="#">Super Pixel</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
				<a class="icon icon-news" href="#">Magazines</a>
				<div class="mp-level">
					<h2 class="icon icon-news">Magazines</h2>
					<a class="mp-back" href="#">retour</a>
					<ul>
						<li><a href="#">National Geographic</a></li>
						<li><a href="#">Scientific American</a></li>
						<li><a href="#">The Spectator</a></li>
						<li><a href="#">The Rambler</a></li>
						<li><a href="#">Physics World</a></li>
						<li><a href="#">The New Scientist</a></li>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
				<a class="icon icon-shop" href="#">Store</a>
				<div class="mp-level">
					<h2 class="icon icon-shop">Store</h2>
					<a class="mp-back" href="#">retour</a>
					<ul>
						<li class="icon icon-arrow-left">
							<a class="icon icon-t-shirt" href="#">Clothes</a>
							<div class="mp-level">
								<h2 class="icon icon-t-shirt">Clothes</h2>
								<a class="mp-back" href="#">retour</a>
								<ul>
									<li class="icon icon-arrow-left">
										<a class="icon icon-female" href="#">Women's Clothing</a>
										<div class="mp-level">
											<h2 class="icon icon-female">Women's Clothing</h2>
											<a class="mp-back" href="#">retour</a>
											<ul>
												<li><a href="#">Tops</a></li>
												<li><a href="#">Dresses</a></li>
												<li><a href="#">Trousers</a></li>
												<li><a href="#">Shoes</a></li>
												<li><a href="#">Sale</a></li>
											</ul>
										</div>
									</li>
									<li class="icon icon-arrow-left">
										<a class="icon icon-male" href="#">Men's Clothing</a>
										<div class="mp-level">
											<h2 class="icon icon-male">Men's Clothing</h2>
											<a class="mp-back" href="#">retour</a>
											<ul>
												<li><a href="#">Shirts</a></li>
												<li><a href="#">Trousers</a></li>
												<li><a href="#">Shoes</a></li>
												<li><a href="#">Sale</a></li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</li>
						<li>
							<a class="icon icon-diamond" href="#">Jewelry</a>
						</li>
						<li>
							<a class="icon icon-music" href="#">Music</a>
						</li>
						<li>
							<a class="icon icon-food" href="#">Grocery</a>
						</li>
					</ul>
				</div>
			</li>
			<li><a class="icon icon-photo" href="#">Collections</a></li>
			<li><a class="icon icon-wallet" href="#">Credits</a></li>
		</ul>
			
	</div>
</nav>
<!-- /mp-menu -->
