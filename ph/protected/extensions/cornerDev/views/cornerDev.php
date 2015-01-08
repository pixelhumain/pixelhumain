<div id="cornerDevContainer" >
	
    <script>
        var activeSectionId = <?php echo ($activeSection!=null) ? "'".$activeSection['id']."'": "null"?>;
        var activeFrameId = <?php echo ($activeFrame !=null ) ? "'".$activeFrame['id']."'": "null"?>;
        var jsonPath='<?php echo substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1)?>corner/getjson';
        var pathKey='<?php echo $pathKey?>';
        var saveScript = '<?php echo substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1)?>corner/savesitemap';
        var imgUrl = '<?php echo $this->baseUrl?>';
    </script>
<?php if($exists){?>    
    <div id="cornerDev" class="<?php echo $this->postionCssClass ?>" >
    	<div class="fr"><a href="#" onclick="toggleOpenClose()"><img src="<?php echo $this->baseUrl?>/images/up.png " width="25"/></a></div>
        <u>CORNER DEV</u>
        <br/><br/>
        pathKey : <?php echo $pathKey?>
        
		<br/>title : <?php echo $activeFrame['title']?>
        <br/>link : <?php echo $activeFrame['link']?>
        <br/>ID : <?php echo $activeFrame['id']?>
        
        <br/><br/><span>ACTIVITY</span>  
        <?php
        if(isset($activeFrame['action']))
            echo '<br/>action : '.$activeFrame['action'];
        ?>
        <br/>state : <?php echo $activeFrame['state']?>
        <br/>progress : <?php echo $activeFrame['progress']."%"?>
        <br/><br/>
        <br/><img src="<?php echo $this->baseUrl?>/images/details.png " width="30" alt="EDIT DETAILS "/><a class='cornerEditDetails' href='<?php echo Yii::app()->createUrl('/corner/details/section/'.htmlentities($activeSection['id']).'/id/'.htmlentities($activeFrame['id']))?>'> EDIT DETAILS </a>
        <div class="line">&nbsp;</div>
        <img src="<?php echo $this->baseUrl?>/images/actions.png " width="30" alt="CORNER ACTIONS "/><a href='#' onclick='closeAll();$("#cornerActions").slideDown()'> ACTIONS</a>
        <div class="line">&nbsp;</div>
        <img src="<?php echo $this->baseUrl?>/images/sitemap.png " width="30"/><a href='<?php echo $this->sitemapUrl.'?section='.$activeSection['id']?>' target="_blank" > Sitemap View</a>
    	<div class="line">&nbsp;</div>
    	<img src="<?php echo $this->baseUrl?>/images/sitemap-add.png " width="30"/><a class='cornerEditDetails' href='<?php echo Yii::app()->createUrl('/corner/details/section/null/id/null')?>'> Add Child Frame</a>
    	<div class="line">&nbsp;</div>
    </div>
    <?php $iconsize = '35'?>
    <div id="cornerActions">
    	<div class="fr"><a href="#" onclick="$('#cornerActions').slideUp();"><img src="<?php echo $this->baseUrl?>/images/no.png " width="25"/></a></div>
    	
        <br/><img src="<?php echo $this->baseUrl?>/images/comment2.png " width="<?php echo $iconsize?>"/><a href='#' onclick='closeAll();$("#cornerComments").slideDown()' > Comment ( Bug, Wish, Log, Ideas)</a>
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/puzzle5.png " width="<?php echo $iconsize?>"/><a href='#' onclick='closeAll();$("#cornerZones").slideDown();'> Zone View (<?php echo (isset($activeFrame['zones'])) ? count($activeFrame['zones']) : 0 ?>)</a>
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/inprogress.png " width="<?php echo $iconsize?>"/><a href='#' onclick='closeAll();$("#cornerInProgress").slideDown()'> What's Cooking (inprogress) </a>
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/experiment.png " width="<?php echo $iconsize?>"/><a href='#' onclick='closeAll();$("#cornerToBeTested").slideDown()'> To be tested </a>
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/useCase.png " width="<?php echo $iconsize?>"/><a href='#' onclick='closeAll();$("#cornerUseCase").slideDown()' > Use Cases (<?php echo (isset($activeFrame['useCase'])) ? count($activeFrame['useCase']) : 0 ?>)</a>        
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/mobile.png " width="<?php echo $iconsize?>"/><a href='#' onclick='alert("show in mobile tester")'> Mobile View (TODO) </a>

        
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/files.png " width="<?php echo $iconsize?>"/><a href='#' onclick='alert("show list of child pages")'> File View / Add (TODO)</a>
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/files.png " width="<?php echo $iconsize?>"/><a href='#' onclick='alert("show list of relative ressources")'> File View / Add (TODO)</a>
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/translate.png " width="<?php echo $iconsize?>"/><a href='#' onclick='alert("translate")'> Translate This page (TODO)</a>
        <div class="line"></div><img src="<?php echo $this->baseUrl?>/images/repository.png " width="<?php echo $iconsize?>"/><a href='#' onclick='alert("show SVN info")'> Check repo Updates / Update (TODO)</a>
    </div>
    
    <div id="cornerComments">
    	<div class="fr"><a href="#" onclick="$('#cornerComments').slideUp();"><img src="<?php echo $this->baseUrl?>/images/no.png " width="25"/></a></div>
    	<?php
    	if(isset($activeFrame['comment'])){ 
            foreach ($activeFrame['comment'] as $c){ 
                echo '<img src="'.$this->baseUrl.'/images/'.$c['type'].'.png " width="20" alt="'.$c['type'].'"/>';
                echo $c['user'].' - '.$c['date'].' - '.$c['type'].'<br/>'.$c['txt'].'<div class="line">&nbsp;</div>';
                if($c['type']=='bug' && isset($c['htmlID']))
                    echo '<style>#'.$c['htmlID'].'{border:1px solid red;}</style>';
            }
    	} 
    ?>
    	<br/><img src="<?php echo $this->baseUrl?>/images/comment-add.png " width="<?php echo $iconsize?>"/><a id='cornerComment' href='<?php echo Yii::app()->createUrl('/corner/comment/section/'.htmlentities($activeSection['id']).'/id/'.htmlentities($activeFrame['id']))?>' > Comment ( Bug, Wish, Log, Ideas)</a>
    </div>
    
    <div id="cornerUseCase">
    	<div class="fr"><a href="#" onclick="$('#cornerUseCase').slideUp();"><img src="<?php echo $this->baseUrl?>/images/no.png " width="25"/></a></div>
    	<?php
    	if(isset($activeFrame['useCase']))
    	{ 
    	    $ct = 0;
            foreach ($activeFrame['useCase'] as $uc=>$val)
            { 
                echo '<a href="#" onclick="$(\'#useCase'.$ct.'\').slideToggle();">case Name : '.$uc.'</a><ul id="useCase'.$ct.'" class="hidden">';
                foreach ($val as $case)
                    echo '<li class="pl10">-'.$case.'</li>';
                
                echo '</ul><div class="line">&nbsp;</div>';
                $ct++;
            }
    	} 
    ?>
    	<br/><img src="<?php echo $this->baseUrl?>/images/useCase.png " width="<?php echo $iconsize?>"/><a class='cornerAddmultiple' href='<?php echo Yii::app()->createUrl('/corner/addmultiple')?>'> Use Case View / Add </a>
    </div>
    
    <div id="cornerZones">
    	<div class="fr"><a href="#" onclick="$('#cornerZones').slideUp();"><img src="<?php echo $this->baseUrl?>/images/no.png " width="25"/></a></div>
    	<?php
    	if(isset($activeFrame['zones']))
    	{ 
    	    $ct = 0;
            foreach ($activeFrame['zones'] as $z)
            { 
                echo '<a href="#" onclick="$(\'#zone'.$ct.'\').slideToggle();">zone Name : '.$z["spec"]["title"].'</a><ul id="zone'.$ct.'" class="hidden">';
                /*foreach ($val as $case)
                    echo '<li class="pl10">-'.$case.'</li>';*/
                echo '</ul>';
                echo'<div id="zone'.$ct.'" class="jqDnR" style="color:black; font-weight:bold; border:3px solid black; background-color:'.(($z["spec"]["state"]=="done")? "green" : "white").'; z-index:10000;position:fixed;top:'.$z["coord"]["top"].';left:'.$z["coord"]["left"].';height:'.$z["coord"]["height"].';width:'.$z["coord"]["width"].';">'.
                    '<div class="jqHandle jqDrag">move</div><br />'.
                    $z["spec"]["title"].
                    '<div class="jqHandle jqResize">resize</div>'.
                    '</div>';
                echo'<div class="line">&nbsp;</div>';
                $ct++;
                
            }
    	} 
        ?>
    	<br/><img src="<?php echo $this->baseUrl?>/images/puzzle5.png " width="<?php echo $iconsize?>"/><a class='cornerAddmultiple' href='<?php echo Yii::app()->createUrl('/corner/addmultiple')?>'> Zone View / Add </a>
    </div>
    
    <div id="cornerInProgress">
        <div class="fr"><a href="#" onclick="$('#cornerInProgress').slideUp();"><img src="<?php echo $this->baseUrl?>/images/no.png " width="25"/></a></div>
        <?php 
        foreach ($inprogress as $ip) 
            echo '<a href="/perfony/iperfony/'.$ip['link'].'">'.$ip['id'].$ip['progress'].'</a><br/>'; 
        ?>
    </div>
    
    <div id="cornerToBeTested">
        <div class="fr"><a href="#" onclick="$('#cornerToBeTested').slideUp();"><img src="<?php echo $this->baseUrl?>/images/no.png " width="25"/></a></div>
        <?php 
        foreach ($tobetested as $ip) 
            echo '<a href="/perfony/iperfony/'.$ip['link'].'">'.$ip['id'].$ip['progress'].'</a><br/>'; 
        ?>
    </div>
    <?php } else {?>
    <div id="cornerDev" class="<?php echo $this->postionCssClass ?>">
        <u>CORNER DEV</u>
        <br/>
        pathKey : <?php echo $pathKey?>
    	<br/><a class='cornerEditDetails' href='<?php echo Yii::app()->createUrl('/corner/details/section/null/id/null')?>'> ADD TO SITEMAP</a>
    </div>
    <?php }?>
    <div id="cornerDialogContainer" ></div>
</div>