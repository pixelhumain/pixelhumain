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
            if (($handle = fopen($_FILES['fileimport']['tmp_name'], "r")) !== FALSE) 
            {
                    $t = file_get_contents($_FILES['mapping']['tmp_name']);
                    $mapping = json_decode($t);
                    
                    $data = fgetcsv($handle, ";");
                    
                    $tabCode = explode("\t", $data[0]);


                    $arrayCsvImport[0] = $tabCode ;
                    $arrayCsvRejet[0] = $tabCode ;
                    $i = 1 ;

                    while (($data2 = fgetcsv($handle, ";")) !== FALSE) 
                    {
                        if (($i%2000) == 0)
                        {
                            set_time_limit(30) ;
                        }

                        $line = explode("\t", $data2[0]);
                        $res = PHDB::findOne(City::COLLECTION, array("insee" => $line[0]));
                      
                        if($res != null)
                        {
                            $arrayCsvImport[$i] = $line ;
                            foreach ($tabCode as $keyCode => $valueCode) 
                            {
                                $autre = $mapping->cityDataSrc->fields[$valueCode];
                                var_dump($autre);
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
                            $arrayCsvRejet[$i] = $line ;
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
                        $i++;
                    }
                    $json["codeInsee"] = $commune ;
                    if(isset($rejet))
                        $jsonrejet["codeInsee"] = $rejet ;
                    else
                        $jsonrejet["codeInsee"] = [];

                }
                fclose($handle);
                $this->render("dataImport",array("json"=>$json,
                                                "jsonrejet"=>$jsonrejet,
                                                "arrayCsvImport"=>$arrayCsvImport,
                                                "arrayCsvRejet"=>$arrayCsvRejet,
                                                "jsonmapping"=>$mapping,
                                                "tabCode"=>$tabCode,
                                                "result"=>false));  
        }
        else
        {
            $this->render("dataImport",array("result"=>false));  
        }
    } 
    public function actionImportMongo() 
    {
        if($_POST['chooseSelected'] == "new")
        {
            $resData = PHDB::insert(City::COLLECTION_DATA, json_decode($_POST['jsonimport']));
            $resMapping = PHDB::insert(City::COLLECTION_IMPORTHISTORY, json_decode($_POST['jsonmapping']));
        }
        else
        {
            $resMapping = PHDB::update(City::COLLECTION_IMPORTHISTORY,
                            array("_id"=>new MongoId($_POST['mappingSelected'])), 
                            array('$cityDataSrc' => json_decode($_POST['jsonmapping'])));
            $resData = PHDB::insert(City::COLLECTION_DATA, json_decode($_POST['jsonimport']));
        }
        
        return Rest::json(array('result'=> $resMapping));
        //$this->render("dataImport",array("result"=>$res));
    }


    public function actionTraiterCSV() 
    {
        if(isset($_FILES['fileimport']))
        {
            
            if (($handle = fopen($_FILES['fileimport']['tmp_name'], "r")) !== FALSE) 
            {
                $i = 0 ;

                while (($data = fgetcsv($handle, $_POST['separateur'])) !== FALSE) 
                {
                    $tabCSV[$i] = explode("\t", $data[0]);
                    $i++;
                }
                    
            }
            fclose($handle);
            Yii::app()->session["tabCSV"] = $tabCSV;

            $this->render("traiterCSV",array("result"=>true,
                                                "separateur"=>$_POST['separateur'],
                                                "nameFile"=>$_FILES['fileimport']['name'],
                                                "choose"=>$_POST['choose'],
                                                "chooseMapping"=>$_POST['chooseMapping']));  
        }
        else
        {
            $this->render("traiterCSV",array("tabCSV"=>true,"result"=>false));  
        }
    }


    public function actionTraiterMapping() 
    {
        if(isset($_POST['tabmapping']))
        {
            $tabCSV =  Yii::app()->session["tabCSV"] ;
            $tabMapping = $_POST['tabmapping'] ;
            $tabCode = $tabCSV[0];
            
             $jsonfils["src"] = $_POST['source'];
            //json mapping
            if($_POST['chooseSelected'] == "new")            
                $jsonfils["date_create"] = date("d/m/y");
            else
            {
                $oneMapping = PHDB::findOne(City::COLLECTION_IMPORTHISTORY, array("_id"=>new MongoId($_POST['mappingSelected'])));
                $jsonfils["date_create"] = $oneMapping['cityDataSrc']["date_create"];
            }
            
            $jsonfils["date_update"] = date("d/m/y");
            $jsonfils["url"] = $_POST['url'];
            $jsonfils["nameFile"] = $_POST['nameFile'];
            $jsonfils["separateur"] = $_POST['separateur'];
            $jsonfils["codeInsee"] = $_POST['lien'];

           foreach ($tabMapping as $key => $value) 
           {
                if($value != '')
                    $jsonfilsFields[$tabCode[$key]] = $value;
           }
        
            $jsonfils["fields"] = $jsonfilsFields;

            $jsonmapping["cityDataSrc"] = $jsonfils ;

            foreach ($tabCode as $keyCode => $valueCode) 
            {
                if($valueCode == $_POST['lien'])
                { 
                   $idLien = $keyCode ; 
                }
            }
            //json import csv
            $i = 1 ;
            while (count($tabCSV) > $i) 
            {
                if (($i%2000) == 0)
                {
                    set_time_limit(30) ;
                }

                $line = $tabCSV[$i];
                $res = PHDB::findOne(City::COLLECTION, array("insee" => $line[0]));
              
                if($res != null)
                {
                    $arrayCsvImport[$i] = $line ;
                    foreach ($tabCode as $keyCode => $valueCode) 
                    {
                        if(isset($jsonmapping["cityDataSrc"]['fields'][$valueCode]))
                        {
                           $map = explode(".", $value);
                            if(!isset($commune[$line[$idLien]]))
                            {
                                $commune[$line[$idLien]] = FileHelper::create_json($map, $line[$keyCode]);
                            }
                            else
                            {
                                $commune[$line[$idLien]] = FileHelper::create_json_with_father($map, $line[$keyCode], $commune[$line[0]]) ;
                            }
                            
                        }   
                    }
                }
                else
                {
                    $arrayCsvRejet[$i] = $line ;
                    foreach ($tabCode as $keyCode => $valueCode) 
                    {
                       if(isset($jsonmapping["cityDataSrc"]['fields'][$valueCode]))
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
                $i++;
            }
            $jsonimport["codeInsee"] = $commune ;
                    if(isset($rejet))
                        $jsonrejet["codeInsee"] = $rejet ;
                    else
                        $jsonrejet["codeInsee"] = [];

            return Rest::json(array('result'=> true,
                                    'jsonmapping'=>FileHelper::indent_json(json_encode($jsonmapping)),
                                    "jsonimport"=>FileHelper::indent_json(json_encode($jsonimport)),
                                    "jsonrejet"=>FileHelper::indent_json(json_encode($jsonrejet)),
                                    "tabCode"=>$tabCode,
                                    "lien"=>$_POST['lien'],
                                    "arraymappingfields"=>$jsonmapping["cityDataSrc"]['fields'],
                                    "arrayCsvImport"=>$arrayCsvImport,
                                    "nbcommunemodif"=>count($arrayCsvImport),
                                    "nbinfoparcommune"=>count($jsonmapping["cityDataSrc"]['fields']),
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



     
    





}