<?php
/**
 * ActionLocaleController.php
 *
 * tout une liste d'outils
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */

class ToolsController extends Controller {
    const moduleTitle = "Outils";

    public function actions()
    {
        return array(
            'getby' => 'application.controllers.generic.GetByAction',                      
        );
    }

    /**
     * Runs through a tab seperated CSV file
     * saves to table citoyen or group 
     */
	public function actionIndex($process=0) {
	    $this->render("readCSV",array("process"=>$process));
	}
	/* Import les colonne des données insee*/
    public function actionPopulation($process=0) {
	    $this->render("popCSV",array("process"=>$process));
	}
    public function actionImport($group,$type) {
        $this->render("pasteIn",array("group"=>$group,"type"=>$type,));
	}
    public function actionConvert() {
        $this->render("rdf2jsonSchema");
    }
    public function actionVie() {
        $this->render("vietree");
    }
    public function actionTchat() {
        $this->render("tchat");
    }
	public function actionVisualizeImport($group,$type) {
	    $process = 0;
        $row = 1;
    	$created = time();
    	$CsvString = "Toto Coco	toto@coco.com
Titi Kiki	toto@kiki.com";
        
        $firstnameId = 1;
        $lastnameId = 2;
        $emailId = 0;
        $cpId = 3;
        $webId = null;
        $cityId = null;
        $tags = array("");
            
        $insertCount = 0;
        $existCount = 0;
        $lineIndex = 0;
        $echoStr = "";
        $data = str_getcsv($CsvString, "\n");
        foreach( $data as &$Row )
        { 
            $row = str_getcsv($Row, '\t' , '"' );
            var_dump($row);
            echo $row[0]." - ".$row[1]."<br/>";
        }
        
        echo "<br/> <h2>insert count : ".$insertCount."</h2>";
        echo "<br/> <h2>exist count : ".$existCount."</h2>";
        echo $echoStr;
    }

    public function actionDataImport() 
    {
        $this->render("dataImport");  
       
    } 
    public function actionImportMongo() 
    {
        if(isset($_POST['jsonimport']) && isset($_POST['jsonmapping']) && isset($_POST['jsonrejet']))
        {
            $res = ImportData::importMongoDb($_POST);
            return Rest::json(array('result'=> $res));
        }
        else
            return Rest::json(array('result'=> false));
    }


    public function actionTraiterCSV() 
    {
        $this->title = "Import de données dans cityData";
        if(isset($_FILES['fileimport']) && isset($_FILES['fileimport']) && isset($_POST['separateurDonnees']) && isset($_POST['separateurTexte']) && isset($_POST['choose']) && isset($_POST['chooseMapping']))
            $params = ImportData::useCSV($_FILES, $_POST);
        else
            $params = array("choose"=>false,"result"=>false);
        $this->render("traiterCSV",$params);
        
    }


    public function actionTraiterMapping() 
    {
        if(isset($_POST['tabmapping']))
        {
            if(isset($_POST['mappingSelected']))
                $mappingSelected = $_POST['mappingSelected'] ;
            else
                $mappingSelected = null ;
            
            $params = ImportData::createMappingWithCSV($_POST,Yii::app()->session["tabCSV"]);
            return Rest::json($params);
        }
        else
        {
            return Rest::json(array('result'=> "mappingempty",
                                    'tabmapping'=>$_POST['tabmapping']));
        }
    } 



    public function actionIndentJson() 
    {
       return Rest::json(array('jsonindent'=> FileHelper::indent_json($_POST['jsonnonindent'])));   
    }



    public function actionImportJson() 
    {
        $params = ImportData::useJson($_FILES, $_POST);
        $this->render("importJson",$params); 
    }

   
    

    public function actionTraiterMappingJson() 
    {
        if(isset($_POST['tabmapping']))
        {
            $params = ImportData::createMappingWithJSON($_POST);
            return Rest::json($params);
        } 
    } 


     /*** Import organizations and others***/

     public function actionImportData() {
        /*$controller->title = "Surveys";
        $controller->subTitle = "Nombres de votants inscrit : ";
        $controller->pageTitle = "Communecter - Surveys ";*/
        //$this->render("importData");
        $params = ImportData::parsingCSV($_FILES, $_POST);
        $this->render("importData",$params); 
    }

    public function actionPreviewData(){
        $params = ImportData::previewData($_POST);
        return Rest::json($params);
    }

    public function actionImportMongo2() 
    {
        $params = ImportData::importMongoDB2($_POST);
        return Rest::json($params);
    }

}