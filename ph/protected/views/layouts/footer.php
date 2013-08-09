<footer>  

   <div id="contact" >
        <h1>Contactez, Rejoignez nous </h1>
        
        <br/>
        <p><a href="http://blog.pixelhumain.com/" target="_blank"> Le blog </a></p>
        <p>Pixel Humain sur <a href="https://www.facebook.com/groups/pixelhumain/" target="_blank"> FaceBook </a></p>
        <p><a href="http://groups.diigo.com/group/pixelhumain" target="_blank">Recherche & Dévellopement</a> du Pixel Humain</p>
        <p>Notre <a href="https://trello.com/board/pixel-humain-echolocal/50a3e15a175358d65a0089ef" target="_blank">Plan d'action </a></p>
        <br/>
        <h4>Que vous ayez une idée ou que ce soit par plaisirs,<br/>
        Nous aimons recevoir vos mails!!</h4>
        <br/>
        <p>
        <a class="btn btn-warning btn-large" href="mailto:contact@pixelhumain.com" target="_blank">Envoyer un Mail </a>
        <?php if(isset(Yii::app()->session["userId"])){?>
		<div id="ddinvité" class="wrapper-dropdown-3" tabindex="1">
		    <span>Invité quelqu'un</span>
		    <ul class="dropdown">
		        <li><a href="" target="_blank">Un Citoyens</a></li>
		        <li><a href="" target="_blank">Une Collectivités</a></li>
		        <li><a href="" target="_blank">Une Associations</a></li>
				<li><a href="" target="_blank">Une Entreprises</a></li>
		    </ul>
		</div>
    	<?php }?>
        </p>
    </div>
    
</footer>