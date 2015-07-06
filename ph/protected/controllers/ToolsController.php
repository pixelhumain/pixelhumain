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
        $namefile = explode(".", $jsonmapping->nameFile);
        if( file_exists ( "../../modules/cityData/importHistory/".date("Ymd").'_'.$namefile[0] ) == false)
            mkdir("../../modules/cityData/importHistory/".date("Ymd").'_'.$namefile[0] , 0777);
        

        file_put_contents("../../modules/cityData/importHistory/".date("Ymd").'_'.$namefile[0]."/importHistory.json", $_POST['jsonmapping']);
        file_put_contents("../../modules/cityData/importHistory/".date("Ymd").'_'.$namefile[0]."/import.json", $_POST['jsonimport']);
        file_put_contents("../../modules/cityData/importHistory/".date("Ymd").'_'.$namefile[0]."/rejet.json", $_POST['jsonrejet']);

        if($_POST['chooseSelected'] == "new")
        {
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
        }

        

        if(isset($jsonimport->insee))
        {
            $res = PHDB::findOne(City::COLLECTION_DATA, array("insee" => $jsonimport->insee));
            
            if($res == null)
            {
                //var_dump($value);
                $resData = PHDB::insert(City::COLLECTION_DATA, $jsonimport);
            }
            else
            {
               $resData = PHDB::update(City::COLLECTION_DATA, 
                            array("_id"=>new MongoId($res["_id"])),
                            array('$set' => $jsonimport),
                            array("upsert" => true));
            }
        }
        else
        {
            foreach ($jsonimport as $key => $value) 
            {
               
                $res = PHDB::findOne(City::COLLECTION_DATA, array("insee" => $value->insee));
                //var_dump($res);
                if($res == null)
                {
                    //var_dump($value);
                    $resData = PHDB::insert(City::COLLECTION_DATA, $value);
                }
                else
                {
                   $resData = PHDB::update(City::COLLECTION_DATA, 
                                array("_id"=>new MongoId($res["_id"])),
                                array('$set' => $value),
                                array("upsert" => true));
                }
                
            }  
        }
        

        /*if($_POST['chooseSelected'] == "new")
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
        }*/
        
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
            $tabIDMapping = $_POST['tabidmapping'] ;
           
            

            foreach ($tabCSV as $key => $value) 
           {
                if($key == 0)
                    $tabCode = $value;
           }


            //var_dump($tabCSV);
             $jsonmapping["src"] = $_POST['source'];
            //json mapping
            if($_POST['chooseSelected'] == "new")            
                $jsonmapping["date_create"] = date("d/m/y");
            else
            {
                $oneMapping = PHDB::findOne(City::COLLECTION_IMPORTHISTORY, array("_id"=>new MongoId($_POST['mappingSelected'])));
                $jsonmapping["date_create"] = $oneMapping["date_create"];
                //$jsonmapping["lastImportId"] = $oneMapping['lastImportId'];
            }
            
            $jsonmapping["date_update"] = date("d/m/y");
            $jsonmapping["url"] = $_POST['url'];
            $jsonmapping["nameFile"] = $_POST['nameFile'];
            $jsonmapping["separateur"] = $_POST['separateur'];
            $jsonmapping["codeInsee"] = $_POST['lien'];

           foreach ($tabMapping as $key => $value) 
           {
                if($value != '' && isset($tabCode[$tabIDMapping[$key]]))
                 {   
                    $d = $tabCode[$tabIDMapping[$key]];
                    $jsonfilsFields[$d] = $value;}
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
            $inc_import = 0 ;
            $inc_rejet = 0 ;
            while (count($tabCSV) > $i) 
            {

                if (($i%500) == 0)
                {
                    set_time_limit(30) ;
                }

                $line = $tabCSV[$i];

                $valueIdLien = $line[$idLien];

               
                
                $res = PHDB::findOne(City::COLLECTION, array("insee" => $valueIdLien));
              
                if($res != null)
                {
                    $commune["insee"] = $valueIdLien;
                    $arrayCsvImport[$i] = $line ;
                    foreach ($tabCode as $keyCode => $valueCode) 
                    {
                        foreach ($jsonmapping['fields'] as $key => $value) 
                        {
                           // var_dump($value);
                            if($valueCode == $key)
                            { 
                                $map = explode(".", $value);
                                
                                
                                if(!isset($commune[$map[0]]))
                                {
                                    if(count($map) > 1)
                                    {
                                        $newmap = array_splice($map, 1);
                                        $commune[$map[0]] = FileHelper::create_json($newmap, $line[$keyCode]);
                                    }
                                    else
                                    {
                                        $commune[$map[0]] = $line[$keyCode];
                                    }
                                }
                                else
                                {
                                    if(count($map) > 1)
                                    { 
                                       $newmap = array_splice($map, 1);
                                        $commune[$map[0]] = FileHelper::create_json_with_father($newmap, $line[$keyCode], $commune[$map[0]]) ;
                                    }
                                    else
                                    {
                                        $commune[$map[0]] = $line[$keyCode];
                                    }
                                }
                            }
                            
                        }   
                    }
                    $inc_import++;
                    $jsonimport[] = $commune ;
                }
                else
                {
                    $arrayCsvRejet[$i] = $line ;
                    $rejet["insee"] = $valueIdLien;
                    foreach ($tabCode as $keyCode => $valueCode) 
                    {
                       foreach ($jsonmapping['fields'] as $key => $value) 
                        {
                            if($valueCode == $key)
                            { 
                             
                                $map = explode(".", $value);
                                if(!isset($rejet[$map[0]]))
                                {
                                    if(count($map) > 1)
                                    {
                                        $newmap = array_splice($map, 1);
                                        $rejet[$map[0]] = FileHelper::create_json($newmap, $line[$keyCode]);
                                    }
                                    else
                                    {
                                        $rejet[$map[0]] = $line[$keyCode];
                                    }
                                }
                                else
                                {
                                    if(count($map) > 1)
                                    { 
                                       $newmap = array_splice($map, 1);
                                        $rejet[$map[0]] = FileHelper::create_json_with_father($newmap, $line[$keyCode], $rejet[$map[0]]) ;
                                    }
                                    else
                                    {
                                        $rejet[$map[0]] = $line[$keyCode];
                                    }
                                }
                            }
                        }   
                    }
                    $jsonrejet[] = $rejet ;
                    $inc_rejet++;
                }
                $i++;

                
            }

            if(!isset($commune))
            {
                $jsonimport["codeInsee"] = [];
                $arrayCsvImport = [];
            }
            if(!isset($rejet))
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
        header('Content-Type: text/html; charset=UTF-8');
        if(isset($_FILES['fileimport']))
        {
            $json = file_get_contents($_FILES['fileimport']['tmp_name']);
            $json_objet = json_decode($json, true);
            

            
            $chaine = FileHelper::arbreJson($json_objet , "", "");

            $arbre = explode(";",  $chaine);
            

            foreach ($arbre as $key => $value) 
            {
                $arbre[$key] = substr($value, 1);
            }
            
            $params = array("result"=>true,
                            "arbre"=>$arbre,
                            "nameFile"=>$_FILES['fileimport']['name'],
                            "json_origine"=>$json,
                            "choose"=>$_POST['choose']);
            
            if($_POST['choose'] == "modify")
                $params['chooseMapping'] = $_POST['chooseMapping'];



            $this->render("importJson",$params);
        }
        else
        {
            $this->render("importJson",array("result"=>false));  
        }
    }

   
    

     public function actionTraiterMappingJson() 
    {
        if(isset($_POST['tabmapping']))
        {
            //var_dump($_POST['json_origine']);
            $json_objet = json_decode($_POST['json_origine'], true);
            
            $tabMapping = $_POST['tabmapping'] ;
            $tabIDMapping = $_POST['tabidmapping'] ;
         
            
            $jsonmapping["src"] = $_POST['source'];
            //json mapping
            if($_POST['chooseSelected'] == "new")            
                $jsonmapping["date_create"] = date("d/m/y");
            else
            {
                $oneMapping = PHDB::findOne(City::COLLECTION_IMPORTHISTORY, array("_id"=>new MongoId($_POST['mappingSelected'])));
                $jsonmapping["date_create"] = $oneMapping["date_create"];
               // $jsonmapping["lastImportId"] = $oneMapping['lastImportId'];
            }
            
            $jsonmapping["date_update"] = date("d/m/y");
            $jsonmapping["url"] = $_POST['url'];
            $jsonmapping["nameFile"] = $_POST['nameFile'];
            //$jsonmapping["separateur"] = $_POST['separateur'];
            $jsonmapping["codeInsee"] = $_POST['lien'];

           foreach ($tabMapping as $key => $value) 
           {
                if($value != '')
                    $jsonfilsFields[$tabIDMapping[$key]] = $value;
           }
        
            $jsonmapping["fields"] = $jsonfilsFields;

            $idLien = $_POST['lien'];
            $cheminLien = explode(".", $_POST['lien']);
            //var_dump($cheminLien);
            $valueIdLien = FileHelper::get_value_json($json_objet, $cheminLien) ;
            //var_dump($valueIdLien);

            $res = PHDB::findOne(City::COLLECTION, array("insee" => $valueIdLien));
            $inc_import = 0 ;
            $inc_rejet = 0 ;
            if($res != null)
            {
                $commune["insee"] = $valueIdLien;
                foreach ($jsonmapping['fields'] as $key => $value)
                {
                   $map = explode(".", $value);
                   $cheminJson = explode(".", $key);
                   $value_json = FileHelper::get_value_json($json_objet, $cheminJson);
                    if(!isset($commune[$map[0]]))
                    {
                        if(count($map) > 1)
                        {
                            $newmap = array_splice($map, 1);
                            $commune[$map[0]] = FileHelper::create_json($newmap,  $value_json);
                        }
                        else
                        {
                            $commune[$map[0]] = $value_json;
                        }
                    }
                    else
                    {
                        
                        if(count($map) > 1)
                        {
                            $newmap = array_splice($map, 1);
                            $commune[$map[0]] = FileHelper::create_json_with_father($newmap, $value_json, $commune[$map[0]]) ;
                        }
                        else
                        {
                            $commune[$map[0]] = $value_json;
                        }
                    }



                }
            }
            else
            {
                foreach ($jsonmapping['fields'] as $key => $value)
                {
                    $map = explode(".", $value);
                    $cheminJson = explode(".", $key);
                    if(!isset($rejet[$valueIdLien]))
                    {
                        if(count($map) > 1)
                        {
                            $newmap = array_splice($map, 1);
                            $rejet[$map[0]] = FileHelper::create_json_with_father($newmap, $value_json) ;
                        }
                        else
                        {
                            $rejet[$map[0]] = $value_json;
                        }
                    }
                    else
                    {
                        if(count($map) > 1)
                        {
                            $newmap = array_splice($map, 1);
                            $rejet[$map[0]] = FileHelper::create_json_with_father($newmap, $value_json, $rejet[$map[0]]) ;
                        }
                        else
                        {
                            $rejet[$map[0]] = $value_json;
                        }
                    }
                }
            }
                
          
            
            if(isset($commune))
            {
                $jsonimport = $commune ;
            }
            else
            {
                $jsonimport = [];
                $arrayCsvImport = [];
            }
            if(isset($rejet))
            {
                $jsonrejet = $rejet ;
            }
            else
            {
                $jsonrejet = [];
                $arrayCsvRejet = [];
            }
            return Rest::json(array('result'=> true,
                                    'jsonmapping'=>FileHelper::indent_json(json_encode($jsonmapping)),
                                    "jsonimport"=>FileHelper::indent_json(json_encode($jsonimport)),
                                    "jsonrejet"=>FileHelper::indent_json(json_encode($jsonrejet)),
                                    "lien"=>$_POST['lien']));
        } 
    } 



}