<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/magic.css');*/


function checkServerVar()
{
	$vars=array('HTTP_HOST','SERVER_NAME','SERVER_PORT','SCRIPT_NAME','SCRIPT_FILENAME','PHP_SELF','HTTP_ACCEPT','HTTP_USER_AGENT');
	$missing=array();
	foreach($vars as $var)
	{
		if(!isset($_SERVER[$var]))
			$missing[]=$var;
	}
	if(!empty($missing))
		return '$_SERVER does not have '.implode(', ',$missing);
	
	if(!isset($_SERVER["REQUEST_URI"]) && isset($_SERVER["QUERY_STRING"]))
		return 'Either $_SERVER["REQUEST_URI"] or $_SERVER["QUERY_STRING"] must exist.';

	if(!isset($_SERVER["PATH_INFO"]) && strpos($_SERVER["PHP_SELF"],$_SERVER["SCRIPT_NAME"]) !== 0)
		return 'Unable to determine URL path info. Please make sure $_SERVER["PATH_INFO"] (or $_SERVER["PHP_SELF"] and $_SERVER["SCRIPT_NAME"]) contains proper value.';

	return '';
}

function checkCaptchaSupport()
{
	if(extension_loaded('imagick'))
	{
		$imagick=new Imagick();
		$imagickFormats=$imagick->queryFormats('PNG');
	}
	if(extension_loaded('gd'))
		$gdInfo=gd_info();
	if(isset($imagickFormats) && in_array('PNG',$imagickFormats))
		return '';
	elseif(isset($gdInfo))
	{
		if($gdInfo['FreeType Support'])
			return '';
		return 'GD installed,<br />FreeType support not installed';
	}
	return 'GD or ImageMagick not installed';
}

?>
<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}

</style>
<div style="width:50px;height:50px;background-color: #324553; padding:3px;float:left;"><a href="#" id="trigger" class="menu-trigger"></a></div>
    <div class="hero-unit " id="">
    	
        <h2>TEST INSTALLATION REQUIREMENTS</h2>
        
        <ul>
<?php           
/*
$a = array("cococ","frfr",Api::$userMap);
var_dump($this::$a);
 */
?>
            <li><?php  // check PHP version required by yii
            	if(version_compare(PHP_VERSION,"5.1.0",">="))            
                	echo "<span style='color:green'>You are running on PHP ".phpversion()." which is compatible with PH</span>";
            	else
            		echo "<span style='color:red'>You are running a too old PHP version [".phpversion()."]. PH requires PHP5.1.1.0 or earlier</span>";
            ?></li>
            
             <li><?php  // check server var
            	$res = checkServerVar();
            	if(empty($res))            
                	echo '<span style="color:green"> variables $_SERVER are OK</span>';
            	else
					echo '<span style="color:red"> variables $_SERVER are not OK : ['.$res.']</span>';            
            	?>
            </li>                      
            
            <li><?php  // check extension Reflection            	
            	if(class_exists('Reflection',false))            
                	echo '<span style="color:green"> extension Reflection is installed.</span>';
            	else
					echo '<span style="color:red"> extension Reflection is not installed. Please install it on your PHP server</span>';            
            	?>
            </li> 
            
            <li><?php  // check extension pcre            	
            	if(extension_loaded("pcre"))            
                	echo '<span style="color:green"> extension PCRE is installed.</span>';
            	else
					echo '<span style="color:red"> extension PCRE is not installed. Please install it on your PHP server</span>';            
            	?>
            </li> 
            
            <li><?php  // check extension SPL            	
            	if(extension_loaded("SPL"))            
                	echo '<span style="color:green"> extension SPL is installed.</span>';
            	else
					echo '<span style="color:red"> extension SPL is not installed. Please install it on your PHP server</span>';            
            	?>
            </li> 
            
            <li><?php  // check extension DOM            	
            	if(class_exists('DOMDocument',false))            
                	echo '<span style="color:green"> extension DOM is installed.Used by CHtmlPurifier and CWsdlGenerator</span>';
            	else
					echo '<span style="color:red"> extension DOM is not installed. Please install it on your PHP server. it is required by CHtmlPurifier and CWsdlGenerator</span><br/>sudo apt-get install php5.6-dom';            
            	?>
            </li> 
            
            <li><?php  // check extension PDO            	
            	if(class_exists('pdo',false))            
                	echo '<span style="color:green"> extension PDO is installed (usefull for db related class).</span>';
            	else
					echo '<span style="color:red"> extension PDO is not installed. Please install it on your PHP server. It is required for db classes</span>';            
            	?>
            </li> 
            
            <li><?php  // check extension mcrypt            	
            	if(extension_loaded("mcrypt"))            
                	echo '<span style="color:green"> extension Mcrypt is installed. Used by CSecurityManager. (encryption and decryptions methods)</span>';
            	else
					echo '<span style="color:red"> extension Mcrypt is not installed. Please install it on your PHP server. It is required by CSecurityManager (encryption and decryptions methods)</span><br/>sudo apt-get install php5.6-mcrypt';            
            	?>
            </li> 

                                    
            <li><?php  // check extension GD
            	$res = checkCaptchaSupport();     	
            	if(empty($res))            
                	echo '<span style="color:green"> extension GD with FreeType support or ImageMagick extension with PNG supported is installed.</span>';
            	else
					echo '<span style="color:red"> extension GD with FreeType support or ImageMagick extension with PNG supported is not installed. Please install it on your PHP server. It is required by CCaptachaAction and image manipulation classes</span>';            
            	?>
            </li> 
            
            <li><?php  // check extension Ctype            	
            	if(extension_loaded("ctype"))            
                	echo '<span style="color:green"> extension Ctype is installed. Used by CDateFormatter, CDateTimeParser, CTextHighlighter, CHtmlPurifier</span>';
            	else
					echo '<span style="color:red"> extension Ctype is not installed. Please install it on your PHP server. It is required by CDateFormatter, CDateTimeParser, CTextHighlighter, CHtmlPurifier</span>';            
            	?>
            </li> 
            
            <li><?php  // check extension Fileinfo            	
            	if(extension_loaded("fileinfo"))            
                	echo '<span style="color:green"> extension Fileinfo is installed. Used by CFileValidator</span>';
            	else
					echo '<span style="color:red"> extension Fileinfo is not installed. Please install it on your PHP server</span>';            
            	?>
            </li> 

	         
            
            <li>
                <?php 
                // good alias is "/ph" or custom virtual host such as http://local.ph.com
                $alias = substr($_SERVER['SCRIPT_NAME'], 1, strrpos($_SERVER['SCRIPT_NAME'], "/"));
                
                $color = (empty($alias ) || $alias == "ph/")? "green" : "red";
                $txt = (empty($alias) || $alias == "ph/") ? "Your app alias is good." : "Your alias should be [127.0.0.1/ph] or a virtual host such as [local.ph.com]" ;
                echo "<span style='color:".$color."'>  $txt </span>";    
                ?>
            </li>
	<br/>
            <li><?php  // check extension mongo            	
            	if(extension_loaded("mongo"))            
                	echo '<span style="color:green"> extension Mongo v'.phpversion("mongo").' is installed. Used as database by PH</span>';
            	else
					echo '<span style="color:red"> extension Mongo is not installed. Please install it on your PHP server. It is requiredfor all database stuff</span><br/>sudo apt-get install php5.6-mongo';            
            	?>
            </li>     
            
            <li><?php  // check Yii::app()->mongodb is instanciated            	
            	if(PHDB::checkMongoDbPhpDriverInstalled(false))            
                	echo '<span style="color:green"> Yii::app()->mongodb is instanciated. Access to mongodb is OK.</span>';
            	else
					echo '<span style="color:red"> Yii::app()->mongodb is not instanciated. Fix credentails on protected/config/dbconfig.php and</span>';            
            	?>
            </li>             

            <?php
            if(extension_loaded("mongo"))
            {?>
	            <li>
	                <?php 
	                try{
	                    $m = new MongoClient();
	                    $color = (isset($m)) ? "green" : "red";
	                    echo "<span style='color:".$color."'> MongoClient connection is working</span><br/>";
	                } catch (Exception $e) {
	                    echo "<span style='color:red'> MongoClient connection failed. Check mongodb is running + check protected/config/dbconfig.php credentials <br/>error message : ".$e->getMessage()."</span><br/>";
	                }
	                ?>
	            </li>
	                
	            <?php if(isset($m)){?>        
	            	<li>
		            <?php 
		                $color = "red";
		                $db = null;
		                if(isset($m)){
		                $db = $m->pixelhumain;
		                $color = (isset($db)) ? "green" : "red";
		                } 
		                echo "<span style='color:".$color."'> Mongo Test : Connected to Database '".$db."' was found </span><br/>";
		                ?>
		            </li>
	            
		            <li>
		            <?php 
		                $color = "red";
		                if(isset($m)){
		                    $collection = $db->surveys;
		                    $color = (isset($collection)) ? "green" : "red";
		                }
		                echo "<span style='color:".$color."'> Mongo Test : Collection 'Lists' was found </span><br/>";
		                ?>
		            </li>
	            <?php }?>
	            <?php /*?>
	            <li>
	                <?php
	                var_dump(Yii::app()->mongodb->citoyens);
	                var_dump(Yii::app()->mongodb->citoyens->findOne(array("email"=>"egpc@egpc.com")));
	                ?>
	            </li>
	            <?php */ ?>
	         <?php }?>
        </ul>
        
----------------------------------------------------------- <br/>

<h2> PATHS AND URLS </h2>       
        <?php 
echo "Session userId:".Yii::app()->session["userId"]."<br/>";
echo "Base URL de YII : ".str_replace("\\", "/",Yii::app()->basePath)."<br/>";
$conflen=strlen('SCRIPT');
$B=substr(__FILE__,0,strrpos(__FILE__,'/'));
$A=substr($_SERVER['DOCUMENT_ROOT'], strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
echo "A:".$A."<br/>";
$C=substr($B,strlen($A));
$posconf=strlen($C)-$conflen-1;
$D=substr($C,1,$posconf);
$k_path_url = (isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') ? 'https://' : 'http://';
 echo $k_path_url.$_SERVER['SERVER_NAME'].'/'.$D." :: HTTPS / SERVER_NAME / <br/>";
 echo $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']." :: HTTP_HOST / REQUEST_URI <br/>";
 echo $folder = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1)." ::  SCRIPT_NAME / <br/>";
 echo $k_path_url.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1)." :: SERVER_NAME / SCRIPT_NAME<br/>";
 echo "Home URL :: ".Yii::app()->homeUrl."<br>" ;
        

/*if(isset($m)){
$cursor = $collection->find();
foreach ($cursor as $document) {
    echo $document["name"] . "<br/>";
}

    }*/?>
        <input type="text" class="dateInput"/>
    	<div  id="coco" style="display:block">
        	<h2>TEST</h2>    	
        	  <?php 

                if(isset($m)){
                	$test = !PHDB::checkMongoDbPhpDriverInstalled(false)?null:Yii::app()->mongodb->test->findOne(array("ki"=>"lo"));
                
            	}

            /*$newInfos = array("api" =>array(
                "scenario" => array('label' => "Scenario", "key"=>"scenario","onclick"=>"toggleScenario('scenario')",
                "hide"=>true,
                "blocks"=>array(
                        array("label"=>"Inscription / Creation","children"=>array(
                                                                    "EGPC envoie une invitation par campagne mail contenant un lien d'inscription",
                                                                    "Le nouveau venu s'inscrit en citoyen : email + cp ",
                                                                    "peut creer une association + mot clef",
                                                                    "peut creer une entreprise + mot clef",
                                                                    "peut creer un groupe + mot clef",
                                                                    "peut inviter qlq'un dans chacune de ces entités",
                                                                    "peut creer un evenement en tant que citoyen ou pour son entité",
                                                                    "peut inviter qlq'un à un evenement",
                                                                    )
                            ),
                        array("label"=>"Visualisation","children"=>array(
                                                                    "Tout le monde peut visualiser l'organisation de EGPC",
                                                                    "Voir un listing de chaque entité  (Gpe. , Ass. , Ent., Cit. )",
                                                                    "Voir tout les evenements",
                                                                    "Filtrer par mots clefs",
                                                                    "Ouvrir une entité (Gpe. , Ass. , Ent., Cit. )",
                                                                    "Ouvrir un evenement"
                                                                    )
                            ),
                        array("label"=>"Communication","children"=>array(
                                                                    "Send a message to list of people",
                                                                    )
                            ),
                    )),
            "user"=>array('label' => "User", "key"=>"user", "children"=> array(
                                                    array( "label"=>"Login","href"=>"#blockLogin"),
                                                    array( "label"=>"Save User","href"=>"#blockSaveUser"),
                                                    array( "label"=>"Get User","href"=>"#blockGetUser"),
                                                    array( "label"=>"ConfirmUserRegistration","href"=>"#blockGetUser"),
                                                    array( "label"=>"GetPeople","href"=>"#blockgetPeople")
                                                    )),
            "entities"=>array('label' => "Entities", "key"=>"entities", "children"=> array(
                                                    array( "label"=>"Save Group","href"=>"#blocksaveGroup"),
                                                    array( "label"=>"GetGroup","href"=>"#blockgetgroup"),
                                                    array( "label"=>"linkUser2Group","href"=>"#blocklinkUser2Group"),
                                                    array( "label"=>"unlinkUser2Group","href"=>"#blocklinkUser2Group"),
                                                    array( "label"=>"getGroups","href"=>"#blockgetGroups")
                                                    )),
            "communications"=>array('label' => "Communication", "key"=>"communications", "children"=> array(
                                                    array( "label"=>"sendMessage","href"=>"#blocksendMessage")
                                                    )),
        ));
        Yii::app()->mongodb->applications->update( array("key" => "egpc"), 
                                                        array('$set' => $newInfos ) 
                                                      );*/
                ?>  
        </div>
	</div>
    
<script type="text/javascript"		>
initT['animInit'] = function(){
	setTimeout( function() { $('#coco').addClass('tinRightIn'); } , 2000);

    //init Input type 
    $(".dateInput").datepicker();

};
</script>			