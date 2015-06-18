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
        if(isset($_FILES['fileimport']) && isset($_FILES['mapping']) )
        {
            if (($handle = fopen('/home/raphael/Bureau/'.$_FILES['fileimport']['name'], "r")) !== FALSE) 
                {
                    $t = file_get_contents('/home/raphael/Bureau/'.$_FILES['mapping']['name']);
                    $mapping = json_decode($t);
                    $i = 0 ;
                    $data = fgetcsv($handle, ";");
                    $tabCode = explode("\t", $data[0]);
                    while (($data2 = fgetcsv($handle, ";")) !== FALSE) 
                    {
                        $line = explode("\t", $data2[0]);
                        $res = PHDB::findOne(City::COLLECTION, array("insee" => $line[0]));
                        
                        if($res != null)
                        {
                            foreach ($tabCode as $keyCode => $valueCode) 
                            {
                                foreach ($mapping->cityDataSrc->fields as $key => $value) 
                                {
                                    if($valueCode == $key)
                                    {   
                                        $map = explode(".", $value);
                                        if(!isset($commune[$line[0]]))
                                        {
                                            $commune[$line[0]] = FileHelper::create_json($map, $line[$keyCode]);
                                        }
                                        else
                                        {
                                            $commune[$line[0]] = FileHelper::create_json_with_father($map, $line[$keyCode], $commune[$line[0]]) ;
                                        
                                        }
                                    }
                                }   
                            }
                        }
                        else
                        {
                            foreach ($tabCode as $keyCode => $valueCode) 
                            {
                                foreach ($mapping->cityDataSrc->fields as $key => $value) 
                                {
                                    if($valueCode == $key)
                                    {   
                                        $map = explode(".", $value);
                                        if(!isset($rejet[$line[0]]))
                                        {
                                            $rejet[$line[0]] = FileHelper::create_json($map, $line[$keyCode]);
                                        }
                                        else
                                        {
                                            $rejet[$line[0]] = FileHelper::create_json_with_father($map, $line[$keyCode], $rejet[$line[0]]) ;
                                        }
                                    }
                                }   
                            }
                        }

                    }
                    $json["commune"] = $commune ;
                    if(isset($rejet))
                        $jsonrejet["commune"] = $rejet ;
                    else
                        $jsonrejet = "";

                }
                fclose($handle);
                $this->render("dataImport",array("json"=>json_encode($json),
                                                "jsonrejet"=>json_encode($jsonrejet),
                                                "result"=>false));  
        }
        else
        {
            $this->render("dataImport",array("result"=>false));  
        }
    } 
    public function actionImportMongo() 
    {
        $donnees = $_POST['visualisationJSON'];
        $res = PHDB::insert(City::COLLECTION, json_encode($donnees));
        return Rest::json(array('result'=> $res));
        //$this->render("dataImport",array("result"=>$res));
    }  
}