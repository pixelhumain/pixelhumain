<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/magic.css');*/
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
            <li><?php 
                echo "<span style='color:green'>You are running on PHP ".phpversion()."</span>";
            ?></li>

            <li>
                <?php 
                $alias = substr($_SERVER['SCRIPT_NAME'], 1, strrpos($_SERVER['SCRIPT_NAME'], "/"));
                $color = ($alias == "ph/")? "green" : "red";
                $txt = ($alias == "ph/") ? "Your alias is good : $alias " : "Your alias should : 127.0.0.1/ph" ;
                echo "<span style='color:".$color."'>  $txt </span>";    
                ?>
            </li>

            <li>
                <?php 
                echo "<span style='color:green'>You have Mongo driver v.".phpversion("mongo");
                try{
                    $m = new Mongo();
                    $adminDB = $m->pixelhumain; //require admin priviledge
                    $mongodb_info = $adminDB->command(array('buildinfo'=>true));
                    $mongodb_version = $mongodb_info['version'];
                    echo " and Mongo DB v.".$mongodb_info["version"]."</span>";
                } catch (Exception $e) {
                    echo 'Exception reçue : ',  $e->getMessage(), "\n";
                }
                
                ?>
            </li>

            <li>
                <?php 
                try{
                    $m = new MongoClient();
                    $color = (isset($m)) ? "green" : "red";
                    echo "<span style='color:".$color."'> MongoClient connection is working</span><br/>";
                } catch (Exception $e) {
                    echo "<span style='color:red'> MongoClient connection <br/>error message : ".$e->getMessage()."</span><br/>";
                }
                ?>
            </li>
            <li>
            <?php 
                $color = "red";
                if(isset($m)){
                $db = $m->pixelhumain;
                $color = (isset($db)) ? "green" : "red";
                } 
                echo "<span style='color:".$color."'> Test : Connected to Database '".$db."' was found </span><br/>";
                ?>
            </li>
            <li>
            <?php 
                $color = "red";
                if(isset($m)){
                    $collection = $db->surveys;
                    $color = (isset($collection)) ? "green" : "red";
                }
                echo "<span style='color:".$color."'> Test : Colection 'Lists' was found </span><br/>";
                ?>
            </li>
        </ul>
----------------------------------------------------------- <br/>
<h2> PATHS AND URLS</h2>       
        <?php 

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
        
/*
if(isset($m)){
$cursor = $collection->find();
foreach ($cursor as $document) {
    echo $document["name"] . "<br/>";
}

        $assoNames = array();
        $tmp = iterator_to_array(Yii::app()->mongodb->groups->find( array("type"=>"association"), array("name" => 1) ));
        foreach($tmp as $a)
            $assoNames[$a['name']] = $a['name'] ;
        var_dump($assoNames);

    }*/?>
        
    	<div  id="coco" style="display:block">
        	<h2>TEST</h2>    	
        	  <?php 

                if(isset($m)){
                $test = Yii::app()->mongodb->test->findOne(array("ki"=>"lo"));
                $test["ki"] = "ki";
                Yii::app()->mongodb->test->save($test);
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
};
</script>			