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
        $jsonimport = json_decode($_POST['jsonimport']) ;
        $jsonmapping = json_decode($_POST['jsonmapping']) ;
        
        if($_POST['chooseSelected'] == "new")
        {
            
            $resData = PHDB::insert(City::COLLECTION_DATA, $jsonimport);
            $jsonmapping->lastImportId = $jsonimport->_id;
            $resMapping = PHDB::insert(City::COLLECTION_IMPORTHISTORY, $jsonmapping);
        }
        else
        {
            $resMapping = PHDB::update(City::COLLECTION_IMPORTHISTORY,
                            array("_id"=>new MongoId($_POST['mappingSelected'])), 
                            array('$set' => array('src' => $jsonmapping->src,
                                            'date_update' => $jsonmapping->date_update,
                                            'nameFile' => $jsonmapping->nameFile,
                                            'url' => $jsonmapping->url,
                                            'separateur' => $jsonmapping->separateur,
                                            'codeInsee' => $jsonmapping->codeInsee,
                                            'fields' => $jsonmapping->fields)),
                            array("upsert" => true));
            $resData = PHDB::update(City::COLLECTION_DATA, 
                            array("_id"=>new MongoId($jsonmapping->lastImportId->{'$id'})),
                            array('$set' => array('codeInsee' => $jsonimport->codeInsee)),
                            array("upsert" => true));
        }
        
        return Rest::json(array('result'=> $resMapping));
    }


    public function actionTraiterCSV() 
    {
       header('Content-Type: text/html; charset=UTF-8');
        if(isset($_FILES['fileimport']))
        {
            if (($handle = fopen($_FILES['fileimport']['tmp_name'], "r")) !== FALSE) 
            {
                $i = 0 ;
                while (($data = fgetcsv($handle,0, $_POST['separateurDonnees'], $_POST['separateurTexte'])) !== FALSE) 
                {
                    if(count($data) == 1)
                    {    
                       /* if($i == 1)
                            var_dump($data[0]);*/
                        $tabCSV[$i] = explode("\t", $data[0]);
                    }
                    else
                    {    
                        /*if($i == 1)
                            var_dump($data);*/
                        $tabCSV[$i] = $data;

                    }
                    $i++;
                }
                
                    
            }
            fclose($handle);
            Yii::app()->session["tabCSV"] = $tabCSV;

            $params = array("result"=>true,
                            "separateur"=>$_POST['separateurDonnees'],
                            "nameFile"=>$_FILES['fileimport']['name'],
                            "choose"=>$_POST['choose']);
            
            if($_POST['choose'] == "modify")
                $params['chooseMapping'] = $_POST['chooseMapping'];

            $this->render("traiterCSV",$params);
        }
        else
        {
            $this->render("traiterCSV",array("choose"=>false,"result"=>false));  
        }
    }


    public function actionTraiterMapping() 
    {
        if(isset($_POST['tabmapping']))
        {
            $tabCSV =  Yii::app()->session["tabCSV"] ;
            $tabMapping = $_POST['tabmapping'] ;
            $tabCode = $tabCSV[0];
            
             $jsonmapping["src"] = $_POST['source'];
            //json mapping
            if($_POST['chooseSelected'] == "new")            
                $jsonmapping["date_create"] = date("d/m/y");
            else
            {
                $oneMapping = PHDB::findOne(City::COLLECTION_IMPORTHISTORY, array("_id"=>new MongoId($_POST['mappingSelected'])));
                $jsonmapping["date_create"] = $oneMapping["date_create"];
                $jsonmapping["lastImportId"] = $oneMapping['lastImportId'];
            }
            
            $jsonmapping["date_update"] = date("d/m/y");
            $jsonmapping["url"] = $_POST['url'];
            $jsonmapping["nameFile"] = $_POST['nameFile'];
            $jsonmapping["separateur"] = $_POST['separateur'];
            $jsonmapping["codeInsee"] = $_POST['lien'];

           foreach ($tabMapping as $key => $value) 
           {
                if($value != '')
                    $jsonfilsFields[$tabCode[$key]] = $value;
           }
        
            $jsonmapping["fields"] = $jsonfilsFields;

             $idLien = $_POST['lien'];

            /*foreach ($tabCode as $keyCode => $valueCode) 
            {
                if($valueCode == $_POST['lien'])
                { 
                   = $keyCode ; 
                }
            }*/
            //json import csv
            $i = 1 ;
            while (count($tabCSV) > $i) 
            {
                if (($i%2000) == 0)
                {
                    set_time_limit(30) ;
                }

                $line = $tabCSV[$i];

                $valueIdLien = $line[$idLien];

                if(substr($valueIdLien,0,1) == "0")
                    $valueIdLien = substr($valueIdLien,1);
                
                $res = PHDB::findOne(City::COLLECTION, array("insee" => $valueIdLien));
              
                if($res != null)
                {
                    $arrayCsvImport[$i] = $line ;
                    foreach ($tabCode as $keyCode => $valueCode) 
                    {
                        foreach ($jsonmapping['fields'] as $key => $value) 
                        {
                            if($valueCode == $key)
                            { 
                               $map = explode(".", $value);
                                if(!isset($commune[$valueIdLien]))
                                {
                                    $commune[$valueIdLien] = FileHelper::create_json($map, $line[$keyCode]);
                                }
                                else
                                {
                                    $commune[$valueIdLien] = FileHelper::create_json_with_father($map, $line[$keyCode], $commune[$valueIdLien]) ;
                                }
                            }
                            
                        }   
                    }
                }
                else
                {
                    $arrayCsvRejet[$i] = $line ;
                    foreach ($tabCode as $keyCode => $valueCode) 
                    {
                       foreach ($jsonmapping['fields'] as $key => $value) 
                        {
                            if($valueCode == $key)
                            { 
                             
                                $map = explode(".", $value);
                                if(!isset($rejet[$line[$idLien]]))
                                {
                                    $rejet[$valueIdLien] = FileHelper::create_json($map, $line[$keyCode]);
                                }
                                else
                                {
                                    $rejet[$valueIdLien] = FileHelper::create_json_with_father($map, $line[$keyCode], $rejet[$valueIdLien]) ;
                                }
                            }
                        }   
                    }
                }
                $i++;
            }

            if(isset($commune))
            {
                $jsonimport["codeInsee"] = $commune ;
            }
            else
            {
                $jsonimport["codeInsee"] = [];
                $arrayCsvImport = [];
            }
            if(isset($rejet))
            {
                $jsonrejet["codeInsee"] = $rejet ;
            }
            else
            {
                $jsonrejet["codeInsee"] = [];
                $arrayCsvRejet = [];
            }
            return Rest::json(array('result'=> true,
                                    'jsonmapping'=>FileHelper::indent_json(json_encode($jsonmapping)),
                                    "jsonimport"=>FileHelper::indent_json(json_encode($jsonimport)),
                                    "jsonrejet"=>FileHelper::indent_json(json_encode($jsonrejet)),
                                    "tabCode"=>$tabCode,
                                    "lien"=>$_POST['lien'],
                                    "arraymappingfields"=>$jsonmapping['fields'],
                                    "arrayCsvImport"=>$arrayCsvImport,
                                    "nbcommunemodif"=>count($arrayCsvImport),
                                    "nbinfoparcommune"=>count($jsonmapping['fields']),
                                    "nbcommunerejet"=>count($arrayCsvRejet),
                                    "arrayCsvRejet"=>$arrayCsvRejet));
        }
        else
        {
            return Rest::json(array('result'=> "mappingempty",
                                    'tabmapping'=>$_POST['tabmapping']
                                    ));
        }
    } 



    public function actionIndentJson() 
    {
       return Rest::json(array('jsonindent'=> FileHelper::indent_json($_POST['jsonnonindent'])));   
    }



     public function actionImportJson() 
    {
        if(isset($_FILES['fileimport']))
        {
            if (($handle = fopen($_FILES['fileimport']['tmp_name'], "r")) !== FALSE) 
            {
                $i = 0 ;
                while (($data = fgetcsv($handle,0, $_POST['separateurDonnees'], $_POST['separateurTexte'])) !== FALSE) 
                {
                    if(count($data) == 1)
                    {    
                       /* if($i == 1)
                            var_dump($data[0]);*/
                        $tabCSV[$i] = explode("\t", $data[0]);
                    }
                    else
                    {    
                        /*if($i == 1)
                            var_dump($data);*/
                        $tabCSV[$i] = $data;

                    }
                    $i++;
                }     
            }

            fclose($handle);
            Yii::app()->session["tabCSV"] = $tabCSV;

            $params = array("result"=>true,
                                                "separateur"=>$_POST['separateurDonnees'],
                                                "nameFile"=>$_FILES['fileimport']['name'],
                                                "choose"=>$_POST['choose']);
            if(isset($_POST['chooseMapping']))
                $params['chooseMapping'] = $_POST['chooseMapping'];

            $this->render("importJson",$params);
        }
        else
        {
            $this->render("importJson",array("result"=>false));  
        }
    }
    





}