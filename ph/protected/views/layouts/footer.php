<footer>  

   <div id="contact" class="center">
        <div class="homestead blueDark" style="height:250px;">
        	<?php 
        	$cornerDev = !PHDB::checkMongoDbPhpDriverInstalled(false)?null:Yii::app()->mongodb->cornerDev->findOne(array("url"=>"/".Yii::app()->controller->id."/".Yii::app()->controller->action->id));
        	if($cornerDev){?>
       		 <ul class="cornerDev pull-right" style="position:relative; top:0px; right:0px;list-style:none;min-width:150px;">
            	<li><a class="label" href="javascript:filterType('participant')">Inscrits <span class="badge badge-info"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
            	<li><a class="label" href="javascript:filterType('brainstorm')">Brainstorms <span class="badge badge-inverse"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
            	<li><a class="label" href="javascript:filterType('discussion')">Discussions <span class="badge badge-info"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
            	<li><a class="label" href="javascript:filterType('event')">Evenements <span class="badge badge-inverse"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
            	<li><a class="label" href="javascript:filterType('project')">Projets <span class="badge badge-info"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
            	<li><a class="label" href="javascript:filterType('post')">Annonces <span class="badge badge-inverse"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
            </ul>
            <?php }?>
        	
        
        	<span class="icon-globe greenDark" style="font-size:300%"></span><br/><br/>
        	<h1>Contact</h1>
        	<div>
        	+262-262.34.36.86
        	<br/>contact @ pixelhumain.com
        	</div>
        	<br/>
        	
        	<a href="https://www.facebook.com/groups/pixelhumain/" target="_blank"><span class="icon-facebook-rect blueDark" style="font-size:200%"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	<a href="https://plus.google.com/u/0/communities/111483652487023091469?cfem=1" target="_blank"><span class="icon-googleplus-rect blueDark" style="font-size:200%"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	<a href="http://groups.diigo.com/group/pixelhumain" target="_blank"><span class="icon-diigo blueDark" style="font-size:200%"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	<a href="https://trello.com/board/pixel-humain-echolocal/50a3e15a175358d65a0089ef" target="_blank"><span class="icon-trello blueDark" style="font-size:200%"></span></a>&nbsp;&nbsp;&nbsp;
        	<a href="http://blog.pixelhumain.com/" target="_blank"><span class="icon-blogger-rect blueDark" style="font-size:200%"></span></a> &nbsp;&nbsp;&nbsp;&nbsp;
        	<a href="http://twitter.com/pixelhumain" target="_blank"><span class="icon-twitter blueDark" style="font-size:200%"></span></a> &nbsp;&nbsp;&nbsp;&nbsp;
        	<a href="https://github.com/pixelhumain/pixelhumain" target="_blank"><span class="icon-github-text blueDark" style="font-size:200%"></span></a> &nbsp;&nbsp;&nbsp;&nbsp;
        	<br/><br/>
        	<a href="<?php echo Yii::app()->createUrl('index.php/templates/page/name/faq')?>"><span class="icon-help blueDark" style="font-size:200%"></span></a> &nbsp;&nbsp;&nbsp;&nbsp;
        	<a href="<?php echo Yii::app()->createUrl('index.php/templates/page/name/faq')?>"><span class="icon-plus blueDark" style="font-size:200%"></span><span class="icon-plus blueDark" style="font-size:200%"></span></a> &nbsp;&nbsp;&nbsp;&nbsp;
        	
        	
        </div>
        <br/><br/>
        <div class="blueDarkbg" style="width:100%; height:60px;color:white;padding:5px;margin-top:20px;">
        	Le Pixel Humain, sous <img src="<?php echo Yii::app()->createUrl('images/open-licence.png')?>" style="height:45px"/> licence ouverte & opensource,  Porté par L'association Open Atlas
        </div>
       
        
    </div>
    
</footer>