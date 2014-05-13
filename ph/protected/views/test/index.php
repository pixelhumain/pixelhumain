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

            <li><?php 
                echo "<span style='color:green'>You are running on PHP ".phpversion()."</span>";
            ?></li>

            <li>
                <?php 
                $alias = substr($_SERVER['SCRIPT_NAME'], 1, strrpos($_SERVER['SCRIPT_NAME'], "/"));
                $color = ($alias == "ph/")? "green" : "red";
                echo "<span style='color:".$color."'> TEst alias : $alias</span>";    
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
                    echo "<span style='color:".$color."'> TEst a MongoClient connection</span><br/>";
                } catch (Exception $e) {
                    echo "<span style='color:red'> TEst a MongoClient connection <br/>error message : ".$e->getMessage()."</span><br/>";
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
                echo "<span style='color:".$color."'> Test : Database Pixelhumain was found </span><br/>";
                ?>
            </li>
            <li>
            <?php 
                $color = "red";
                if(isset($m)){
                    $collection = $db->lists;
                    $color = (isset($collection)) ? "green" : "red";
                }
                echo "<span style='color:".$color."'> Test : Colection 'Lists' was found </span><br/>";
                ?>
            </li>
        </ul>

        
        <?php 
echo "<br/>----------------------------------------------------------- <br/>";
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
        

if(isset($m)){
$cursor = $collection->find();
foreach ($cursor as $document) {
    echo $document["name"] . "<br/>";
}

        $assoNames = array();
        $tmp = iterator_to_array(Yii::app()->mongodb->group->find( array("type"=>"association"), array("name" => 1) ));
        foreach($tmp as $a)
            $assoNames[$a['name']] = $a['name'] ;
        var_dump($assoNames);

    }?>
        
        <div class="input-append">
            <?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'name' => 'eventWhen',
                    'pluginOptions' => array(
                        'format' => 'mm/dd/yyyy'
                    )
                ));
            ?>
            <span class="add-on" style="color:black"><icon class="icon-calendar"></icon></span>
    	</div>
    	
    	<div class="input-append">
           <?php $this->widget(
                'yiiwheels.widgets.daterangepicker.WhDateRangePicker',
                array(
                    'name' => 'daterangepickertest',
                    'htmlOptions' => array(
                        'placeholder' => 'Select date'
                    )
                )
            );
            ?>
            <span class="add-on" style="color:black"><icon class="icon-calendar"></icon></span>
    	</div>
    	
    	<?php
                    $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
                            'name'          => 'photo',
                            'uploadAction'  => $this->createUrl('index.php/templates/upload', array('fine' => 1)),
                            'pluginOptions' => array(
                                'validation'=>array(
                                    'allowedExtensions' => array('jpeg', 'jpg','png','gif')
                                )
                            )
                        ));
                    ?>
    	
    	<div  id="coco" style="display:block">
        	<h2>TEST</h2>    	
        	  <?php 

                if(isset($m)){
                $test = Yii::app()->mongodb->test->findOne(array("ki"=>"lo"));
                $test["ki"] = "ki";
                Yii::app()->mongodb->test->save($test);
            }
                ?>  
        </div>
	</div>
<script type="text/javascript"		>
initT['animInit'] = function(){
	setTimeout( function() { $('#coco').addClass('tinRightIn'); } , 2000);
};
</script>			