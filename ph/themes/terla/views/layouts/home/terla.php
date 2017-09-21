<style>

	#bg-homepage{
		width:100%;
	}
	.pageContent{
		margin-top:-5px;
	}
	.carousel-caption {
	    right: 10%;
	    left: 60%;
	    top:100px;
	    padding-bottom: 30px;
	    text-align: left;
	}

    @media (min-width: 767px) and (max-width: 992px) {
        #mainNav .dropdown-result-global-search{
            width:40% !important;
        }
    } 
</style>

<div class="pageContent col-md-12 no-padding padding-top-25">

	<div class="row">
		<div id="myCarousel" class="carousel carousel-home slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">

		    <div class="item active">
		      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion4.jpg" alt="Reunion 1">
		      <div class="carousel-caption">
		        <h3>Bienvenu chez l'habitant</h3>
		        <p>L’objectif de ce projet est de promouvoir la culture réunionnaise en passant par des habitant, ou des prestataire à taille humaine, qui ont une légitimité pour la représenter. Des acteurs qui vont garantir la véracité et l’authenticité de notre culture et favoriser son développement. 
				</p>
		      </div>
		    </div>

		    <div class="item">
		      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion5.jpg" alt="Reunion 1">
		      <div class="carousel-caption">
		        <h3>Bienvenu chez l'habitant</h3>
		        <p>L’objectif de ce projet est de promouvoir la culture réunionnaise en passant par des habitant, ou des prestataire à taille humaine, qui ont une légitimité pour la représenter. Des acteurs qui vont garantir la véracité et l’authenticité de notre culture et favoriser son développement. 
				</p>
		      </div>
		    </div>

		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left"></span>
		    <span class="sr-only">Précédent</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		    <span class="sr-only">Suivant</span>
		  </a>
		</div>
	</div>
	<div class="row col-md-10 col-md-offset-1 margin-bottom-20">
		<div class="row col-md-10 col-md-offset-1 bg-lightgray">
			<h2 class="col-md-12 letter-blue-2">Some of our top trip</h2>
			<div class="row col-md-10">	
				<p>
					Lipsr rakeklaef zejfiaoiz ijezfjezajifo jiofeza quesako ezokdozdoiezi dezijdjiezdjiezijdijez ijezdjezid ezdiezjd ezdiezjdo
				</p>
			</div>
			<div class="row col-md-2">
				<a href="javascript:;" class="btn bg-orange">View more</a>
			</div>
		</div>
	</div>

	<div id="presentation-home" class="row col-md-10 col-md-offset-1 margin-bottom-20">
		<div class="videoWrapper col-xs-12 col-sm-6 col-md-6">
			<iframe width="100%" height="500" src="https://www.youtube.com/embed/4MeoJPnxZeg?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen hidepanel all></iframe>
		</div>
		<div class="row col-md-6 col-xs-12">
			<div class="row col-md-12 content-img">
				<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion5.jpg" 
		         	alt="Generic placeholder thumbnail" height=240>
		    </div>
		    <div id="presentation-home-slogan" class="row col-md-12  content-img">
				<img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion4.jpg" 
		         		alt="Generic placeholder thumbnail" height=250>
		        <h3 class="text-white title">What's client say</h3>
		        <div class="col-md-6">
		        	<i> Slauru akldz djzajkd zakjd kzjdka kzajd<br/>heuaiueuea euiueza<br/>kezdkzdez.</i>
		        	<h3 class="text-white">John Doe</h3>
		        </div>
		    </div>	
		</div>
	</div>
	<div id="ccouer-home" class="col-md-12 no-padding" style="background-image:url('<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion3.jpg');">
		<h3 class="col-md-6 col-md-offset-3 letter-orange-2 text-center text-white padding-25">Nos coups de coeurs</h3><br>
		<div class="col-md-12">
		   <div class="col-sm-6 col-md-3 text-center">
		   	<div class="col-md-12 no-padding entity">
		      <a href="#" class="col-md-12 no-padding margin-bottom-10">
		         <img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion5.jpg" 
		         		alt="Generic placeholder thumbnail" class="img-responsive">
		      </a>
		      <div class="col-md-12 content-desc">
		      <h4>Title</h4>
		      <p>Lorem oiruz oriuze rouzirye zeruyzeir uyzire </p>
		      <a href="#" class="btn bg-orange text-white">Voir plus</a>
		      </div>
		   	</div>
		   </div>
		   
		   <div class="col-sm-6 col-md-3 text-center">
		   <div class="col-md-12 no-padding entity">
		      <a href="#" class="col-md-12 no-padding margin-bottom-10">
		         <img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion1.jpg" 
		         		alt="Generic placeholder thumbnail" class="img-responsive">
		      </a>
		      <div class="col-md-12 content-desc">
		      <h4>Title</h4>
		      <p>Lorem oiruz oriuze rouzirye zeruyzeir uyzire yuizeyriuzye </p>
		      <a href="#" class="btn bg-orange text-white">Voir plus</a>
		      </div>
		   	</div>
			</div>
		   
		   <div class="col-sm-6 col-md-3 text-center">
		   <div class="col-md-12 no-padding entity">
		      <a href="#" class="col-md-12 no-padding margin-bottom-10">
		         <img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion4.jpg" 
		         		alt="Generic placeholder thumbnail" class="img-responsive">
		      </a>
		      <div class="col-md-12 content-desc">
		      <h4>Title</h4>
		      <p>Lorem oiruz oriuze rouzirye zeruyzeir uyzire yuizeyriuzye </p>
		      <a href="#" class="btn bg-orange text-white">Voir plus</a>
		      </div>
		     </div>
		   </div>
		   
		   <div class="col-sm-6 col-md-3 text-center">
		   <div class="col-md-12 no-padding entity">
		      <a href="#" class="col-md-12 no-padding margin-bottom-10">
		         <img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion5.jpg" 
		         		alt="Generic placeholder thumbnail" class="img-responsive">
		      </a>
		      <div class="col-md-12 content-desc">
		      	<h4>Title</h4>
		      	<p>Lorem oiruz oriuze rouzirye zeruyzeir uyzire yuizeyriuzye</p>
		      	<a href="#" class="btn bg-orange text-white">Voir plus</a>
		      </div>
		   </div>
		   </div>
		</div>
	</div>
	<div class="col-md-12 padding-20 bg-orange text-center">
		<span class="text-white">Envie d'encore plus? Aller sur notre carte</span>
		<button class="btn btn-orange bg-orange text-white btn-show-map">Découvrir</button>
	</div>
	

	<div class="row col-md-10 col-md-offset-1">
		<hr>
		<h1 class="col-md-6 col-md-offset-3 letter-blue-3 text-center text-white padding-25">
			<i class="fa fa-chevron-down"></i>
		</h1>
		<br>
		<div class="col-md-12 letter-blue-3">
		   <div class="col-sm-6 col-md-4">
		      <a href="#" class="thumbnail pull-left col-md-4">
		         <img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion3.jpg" 
		         		alt="Generic placeholder thumbnail">
		      </a>
		      <div class="col-md-8">
			      <h3>Prestation</h3>
		   	  </div>
		   </div>
		   
		   <div class="col-sm-6 col-md-4">
		      <a href="#" class="thumbnail pull-left col-md-4">
		         <img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion3.jpg" 
		         		alt="Generic placeholder thumbnail">
		      </a>
		      <div class="col-md-8">
			      <h3>Prestation</h3>
		   	  </div>
		   </div>
		   
		   <div class="col-sm-6 col-md-4">
		      <a href="#" class="thumbnail pull-left col-md-4">
		         <img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion3.jpg" 
		         		alt="Generic placeholder thumbnail">
		      </a>
		      <div class="col-md-8">
			      <h3>Prestation</h3>
		   	  </div>
		   </div>
		   
		   <div class="col-sm-6 col-md-4">
		      <a href="#" class="thumbnail pull-left col-md-4">
		         <img 	src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion3.jpg" 
		         		alt="Generic placeholder thumbnail">
		      </a>
		      <div class="col-md-8">
			      <h3>Prestation</h3>
		   	  </div>
		   </div>
		</div>
	</div>
	

</div>

<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $this->renderPartial($layoutPath.'footer', array("subdomain"=>"welcome")); 
?>


<script type="text/javascript">


jQuery(document).ready(function() {


});

</script>
