<?php
/*
	
 */
class ImportData
{ 
	const MICROFORMATS = "microformats";
    const ORGANIZATIONS = "organizations";
	//Insert les données dans Mongo, et créer les fichier dans CityData/importHistory
	public static function importMongoDB($post)
    {

	 	$objectImport = json_decode($post['jsonimport']) ;
        //var_dump($jsonMapping);
        $objectMapping = json_decode($post['jsonmapping']) ;
        //var_dump($objectMapping);
        $nameFile = explode(".", $objectMapping->nameFile);
        $files_importHistory = scandir("../../modules/cityData/importHistory/");
         
        
        
        $i = 0 ;
        $nameFolder = false ;
        while($i < count($files_importHistory) && $nameFolder == false ) 
        {
            
            if(strpos($files_importHistory[$i], $nameFile[0]) !== false) 
            {
               $nameFolder = $files_importHistory[$i];
            }
            $i++;
        }



        if($nameFolder == false)
        {
            $nameFolder = date("Ymd").'_'.$nameFile[0] ;
            mkdir("../../modules/cityData/importHistory/".$nameFolder , 0775);
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/importHistory.json", $post['jsonmapping']);
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/cityData_1.json", $post['jsonimport']);
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/error_1.json", $post['jsonrejet']);

            $textFileSh = "mongoimport --db pixelhumain --collection importHistory importHistory.json --jsonArray;\n";
            $textFileSh = $textFileSh . "mongoimport --db pixelhumain --collection cityData cityData_1.json --jsonArray;\n";
            
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/importMongo.sh", $textFileSh);

            
            if(file_exists("../../modules/cityData/importHistory/importMongoAll.sh") == true)
                $textImportMongoAll = file_get_contents("../../modules/cityData/importHistory/importMongoAll.sh", FILE_USE_INCLUDE_PATH);
            else
                $textImportMongoAll = "" ;


            $textImportMongoAll = $textImportMongoAll."cd ".$nameFolder.";\n";
            $textImportMongoAll = $textImportMongoAll."sh importMongo.sh;\n";
            $textImportMongoAll = $textImportMongoAll."cd .. ;\n";
        }
        else
        {

            $files = scandir("../../modules/cityData/importHistory/".$nameFolder);
            $count = 1 ;
            foreach ($files as $key => $value) {
                $name_file = explode(".", $value);

                if (strpos($name_file[0], "cityData") !== false) 
                {
                   $count++;
                }
            }

            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/importHistory.json", $post['jsonmapping']);
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/cityData_".$count.".json", $post['jsonimport']);
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/error_".$count.".json", $post['jsonrejet']);

            $textFileSh = file_get_contents("../../modules/cityData/importHistory/".$nameFolder."/importMongo.sh", FILE_USE_INCLUDE_PATH);
            $textFileSh = $textFileSh . "mongoimport --db pixelhumain --collection cityData cityData_".$count.".json --jsonArray;\n";
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/importMongo.sh", $textFileSh);


            if(file_exists("../../modules/cityData/importHistory/importMongoAll.sh") == true)
                $textImportMongoAll = file_get_contents("../../modules/cityData/importHistory/importMongoAll.sh", FILE_USE_INCLUDE_PATH);
            else
            {   $textImportMongoAll = "cd ".$nameFolder.";\n";
                $textImportMongoAll = $textImportMongoAll."sh importMongo.sh;\n";
                $textImportMongoAll = $textImportMongoAll."cd .. ;\n";
            }
        }

        //var_dump($textImportMongoAll);
        file_put_contents("../../modules/cityData/importHistory/importMongoAll.sh", $textImportMongoAll);  




        /*if($post['chooseSelected'] == "new"){
           $resMapping = PHDB::insert(City::COLLECTION_IMPORTHISTORY, $objectMapping);
        }
        else
        {
            $resMapping = PHDB::update(City::COLLECTION_IMPORTHISTORY,
                            array("_id"=>new MongoId($post['mappingSelected'])), 
                            array('$set' => array('src' => $objectMapping->src,
                                            'date_update' => $objectMapping->date_update,
                                            'nameFile' => $objectMapping->nameFile,
                                            'url' => $objectMapping->url,
                                            'separateur' => $objectMapping->separateur,
                                            'idlien' => $objectMapping->idlien,
                                            'fields' => $objectMapping->fields)),
                            array("upsert" => true));
        }*/

    
        /*if(isset($objectImport->insee))
        {
            $res = PHDB::findOne(City::COLLECTION_DATA, 
                                    array("insee" => $objectImport->insee, 
                                    $post["typeData"] => array( '$exists' => 1 )));
            echo "</br> 1 : " ;
            var_dump($post["typeData"]);
            var_dump($res);
            if($res == null)
            {
                $resData = PHDB::insert(City::COLLECTION_DATA, $objectImport);
            }
            else
            {
                $resData = PHDB::update(City::COLLECTION_DATA, 
                            array("_id"=>new MongoId($res["_id"])),
                            array('$set' => $objectImport),
                            array("upsert" => true));
            }
        }
        else
        {
            foreach ($objectImport as $key => $value) 
            {
               
                $res = PHDB::findOne(City::COLLECTION_DATA, 
                                        array("insee" => $value->insee, 
                                                $post["typeData"] => array( '$exists' => 1 )));
                if($res == null)
                {
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
        }*/


        if(isset($objectImport->insee))
        {
            $res = PHDB::findOne("cities", 
                                    array("insee" => $objectImport->insee));
            echo "</br> 1 : " ;
            var_dump($post["typeData"]);
            var_dump($res);
            if($res == null)
            {
                //$resData = PHDB::insert(City::COLLECTION_DATA, $objectImport);
            }
            else
            {
                $resData = PHDB::update("cities", 
                            array("_id"=>new MongoId($res["_id"])),
                            array('$set' => $objectImport),
                            array("upsert" => true));
            }
        }
        else
        {
            foreach ($objectImport as $key => $value) 
            {
               
                $res = PHDB::findOne("cities", 
                                        array("insee" => $value->insee));
                if($res == null)
                {
                    //$resData = PHDB::insert("cities", $value);
                }
                else
                {
                   $resData = PHDB::update("cities", 
                                array("_id"=>new MongoId($res["_id"])),
                                array('$set' => $value),
                                array("upsert" => true));
                }
                
            }  
        }



		return true;
    }

    public static function createCSV ($arrayCSV, $nameFile, $path)
    {
        //$csv = new SplFileObject('../../modules/cityData/fileCityData/'.$file['fileimport']['name'].'_'.$countFile.'.csv', 'w');
        $csv = new SplFileObject($path.$nameFile, 'w');
        foreach ($arrayCSV as $lineCSV) {
            $csv->fputcsv($lineCSV);
        }
    }

    public static function useCSV($file, $post) 
    {
        header('Content-Type: text/html; charset=UTF-8');
        if(isset($file['fileimport']))
        {
            $csv = new SplFileObject($file['fileimport']['tmp_name'], 'r');
            $csv->setFlags(SplFileObject::READ_CSV);
            $csv->setCsvControl($post['separateurDonnees'], $post['separateurTexte'], '"');
            

            $arrayNameFile = explode(".", $file['fileimport']['name']);

            $path = '../../modules/cityData/filesCityData/' ;
            if(!file_exists($path))
                mkdir($path , 0775);

            $path = '../../modules/cityData/filesCityData/'.$arrayNameFile[0].'/' ;
            if(!file_exists($path))
                mkdir($path , 0775);


            $countLine = 0;
            $countFile = 1;
            foreach ($csv as $key => $value) 
            {
                $tabCSV[$key] = $value;
                if($key == 0)
                    $headerCSV = $value;
                
                if($countLine == 0 || $key == 0)
                    $arrayCSV[0] = $headerCSV;
                else
                    $arrayCSV[$countLine] = $value;


                if($countLine == 5000)
                {
                    $nameFile = $arrayNameFile[0].'_'.$countFile.'.csv' ;
                    ImportData::createCSV($arrayCSV, $nameFile, $path);
                    $countLine = 0;
                    $countFile++;
                    $arrayCSV = array();
                }
                else
                    $countLine++;

            }

            $nameFile = $arrayNameFile[0].'_'.$countFile.'.csv' ;
            ImportData::createCSV($arrayCSV, $nameFile, $path);

            //Yii::app()->session["tabCSV"] = $tabCSV;

            $params = array("result"=>true,
                            "tabCSV" => $tabCSV,
                            "separateur"=>$post['separateurDonnees'],
                            "nameFile"=>$file['fileimport']['name'],
                            "choose"=>$post['choose']);
            
            if($post['choose'] == "modify")
                $params['chooseMapping'] = $post['chooseMapping'];

        }
        else
        {
        	$params = array("choose"=>false,"result"=>false);  
        }

        return $params ;
    }


    public static  function createMappingWithCSV($createMappingWithCSV, $arrayCSV) 
    {
        $arrayNameFile = explode(".", $createMappingWithCSV['nameFile']);
        $pathSubFile =  '../../modules/cityData/filesCityData/'.$arrayNameFile[0].'/'.$createMappingWithCSV['subfile'] ;
        $arrayCSV = new SplFileObject($pathSubFile, 'r');
        $arrayCSV->setFlags(SplFileObject::READ_CSV);
        $arrayCSV->setCsvControl(',', '"', '"');
        
        $i = 0 ;
        while (!$arrayCSV->eof() && $i == 0) {
            //var_dump($i);
            $arrayHeadCsv = $arrayCSV->fgetcsv() ;
            $i++;

        }

        $jsonMapping["src"] = $createMappingWithCSV['source'];
        
        if($createMappingWithCSV['chooseSelected']== "new")            
            $jsonMapping["date_create"] = date("d/m/y");
        else
        {
            $oneMapping = PHDB::findOne(City::COLLECTION_IMPORTHISTORY, array("_id"=>new MongoId($createMappingWithCSV['mappingSelected'])));
            $jsonMapping["date_create"] = $oneMapping["date_create"];
           
        }
            
        $jsonMapping["date_update"] = date("d/m/y");
        $jsonMapping["url"] = $createMappingWithCSV['url'];
        $jsonMapping["nameFile"] = $createMappingWithCSV['nameFile'];
        $jsonMapping["separateur"] = $createMappingWithCSV['separateur'];
        $jsonMapping["idlien"] = $createMappingWithCSV['lien'];

        
        foreach ($createMappingWithCSV['tabmapping'] as $key => $value) 
        {
            if($value != '' && isset($arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]]))
            {   
                $d = $arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]];
                $jsonfilsFields[$d] = $value;
            }
        }
        
        foreach ($createMappingWithCSV['tabTypeMapping'] as $key => $value) 
        {
            if($value != '' && isset($arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]]))
            {   
                $d = $arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]];
                $jsonfilsType[$d] = $value;
            }
        }

        foreach ($createMappingWithCSV['tabLibelleMapping'] as $key => $value) 
        {
            if($value != '' && isset($arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]]))
            {   
                $d = $arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]];
                $jsonfilsLibelle[$d] = $value;
            }
        }
        
        $jsonMapping["fields"] = $jsonfilsFields;
        $jsonMapping["type"] = $jsonfilsType;
        $jsonMapping["labels"] = $jsonfilsLibelle;

        $idLien = $createMappingWithCSV['lien'];

           
        //json import csv
            $i = 0 ;
            $inc_import = 0 ;
            $inc_rejet = 0 ;
            
            foreach ($arrayCSV as $key => $line) 
            {
                
                if($i>0 && $line[0] != null)
                {
                    if (($i%2) == 0)
                    {
                        set_time_limit(30) ;
                    }

                    $valueIdLien = $line[$idLien];

                    $res = PHDB::findOne(City::COLLECTION, array("insee" => $valueIdLien));
                  
                    
                    if($res != null)
                    {
                        $commune["insee"] = $valueIdLien;
                        
                        foreach ($arrayHeadCsv as $keyCode => $valueCode) 
                        {
                            foreach ($jsonMapping['fields'] as $key => $value) 
                            {
                                if($valueCode == $key)
                                {
                                    $map = explode(".", $value);
                                    $mapLabel = $map ;
                                    //$map[] = "value" ;
                                    //$mapLabel[] = "label" ;
                                    if(!isset($commune[$map[0]]))
                                    {
                                        if(count($map) > 1)
                                        {
                                            $newmap = array_splice($map, 1);
                                            //$newmapLabel = array_splice($mapLabel, 1);
                                            $commune[$map[0]] = FileHelper::create_json($newmap, $line[$keyCode], $jsonMapping['type'][$key]);
                                            //$commune[$map[0]] = FileHelper::create_json_with_father($newmapLabel, $jsonMapping['labels'][$key], $commune[$map[0]], "STRING");
                                            //$commune[$map[0]] = FileHelper::create_json($newmapLabel, $jsonMapping['labels'][$key], "STRING");
                                        }
                                        else
                                        {

                                            /*if($jsonMapping['type'][$key] == "INT")
                                                $commune[$map[0]]["value"] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $commune[$map[0]]["value"] = floatval($line[$keyCode]);
                                            else
                                                $commune[$map[0]]["value"] = $line[$keyCode];

                                            $commune[$map[0]]["label"] = $jsonMapping['label'][$key] ;*/

                                            if($jsonMapping['type'][$key] == "INT")
                                                $commune[$map[0]] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $commune[$map[0]] = floatval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "JSON")
                                                $commune[$map[0]] = json_decode($line[$keyCode], true);
                                            else
                                                $commune[$map[0]] = $line[$keyCode];
                                        }
                                    }
                                    else
                                    {
                                        if(count($map) > 1)
                                        { 
                                            $newmap = array_splice($map, 1);
                                            //$newmapLabel = array_splice($mapLabel, 1);
                                            $commune[$map[0]]= FileHelper::create_json_with_father($newmap, $line[$keyCode], $commune[$map[0]], $jsonMapping['type'][$key]) ;
                                            //$commune[$map[0]] = FileHelper::create_json_with_father($newmapLabel, $jsonMapping['labels'][$key], $commune[$map[0]], "STRING");
                                        }
                                        else
                                        {

                                            /*if($jsonMapping['type'][$key] == "INT")
                                                $commune[$map[0]]["value"] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $commune[$map[0]]["value"] = floatval($line[$keyCode]);
                                            else
                                                $commune[$map[0]]["value"] = $line[$keyCode];

                                            $commune[$map[0]]["label"] = $jsonMapping['label'][$key] ;*/

                                            if($jsonMapping['type'][$key] == "INT")
                                                $commune[$map[0]] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $commune[$map[0]] = floatval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "JSON")
                                                $commune[$map[0]] = json_decode($line[$keyCode], true);
                                            else
                                                $commune[$map[0]] = $line[$keyCode];
                                        }
                                    }
                                    break;
                                }
                                
                            }   
                        }
                        //$inc_import++;
                        $jsonimport[] = $commune ;
                    }
                    else
                    {
                        $rejet["insee"] = $valueIdLien;

                        foreach ($arrayHeadCsv as $keyCode => $valueCode) 
                        {
                           foreach ($jsonMapping['fields'] as $key => $value) 
                            {
                                if($valueCode == $key)
                                { 
                                    $map = explode(".", $value);
                                    //$mapLabel = $map ;
                                    //$map[] = "value" ;
                                    //$mapLabel[] = "label" ;
                                    if(!isset($rejet[$map[0]]))
                                    {
                                        if(count($map) > 1)
                                        {
                                            $newmap = array_splice($map, 1);
                                            //$newmapLabel = array_splice($mapLabel, 1);
                                            $rejet[$map[0]] = FileHelper::create_json($newmap, $line[$keyCode], $jsonMapping['type'][$key]);
                                            //$rejet[$map[0]] = FileHelper::create_json_with_father($newmapLabel, $jsonMapping['labels'][$key], $rejet[$map[0]], "STRING");
                                        }
                                        else
                                        {
                                            /*if($jsonMapping['type'][$key] == "INT")
                                                $rejet[$map[0]]["value"] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $rejet[$map[0]]["value"] = floatval($line[$keyCode]);
                                            else
                                                $rejet[$map[0]]["value"] = $line[$keyCode];

                                            $rejet[$map[0]]["label"] = $jsonMapping['label'][$key] ;*/

                                            if($jsonMapping['type'][$key] == "INT")
                                                $rejet[$map[0]] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $rejet[$map[0]] = floatval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "JSON")
                                                $rejet[$map[0]] = json_decode($line[$keyCode], true);
                                            else
                                                $rejet[$map[0]] = $line[$keyCode];
                                        }
                                    }
                                    else
                                    {
                                        
                                        if(count($map) > 1)
                                        { 
                                            $newmap = array_splice($map, 1);
                                            //$newmapLabel = array_splice($mapLabel, 1);
                                            $rejet[$map[0]] = FileHelper::create_json_with_father($newmap, $line[$keyCode], $rejet[$map[0]], $jsonMapping['type'][$key]) ;
                                            //$rejet[$map[0]] = FileHelper::create_json_with_father($newmapLabel, $jsonMapping['labels'][$key], $rejet[$map[0]], "STRING");
                                        }
                                        else
                                        {
                                           /* if($jsonMapping['type'][$key] == "INT")
                                                $rejet[$map[0]]["value"] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $rejet[$map[0]]["value"] = floatval($line[$keyCode]);
                                            else
                                                $rejet[$map[0]]["value"] = $line[$keyCode];

                                            $rejet[$map[0]]["label"] = $jsonMapping['label'][$key] ;*/

                                            if($jsonMapping['type'][$key] == "INT")
                                                $rejet[$map[0]] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $rejet[$map[0]] = floatval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "JSON")
                                                $rejet[$map[0]] = json_decode($line[$keyCode], true);
                                            else
                                                $rejet[$map[0]] = $line[$keyCode];

                                        }
                                    }
                                    break;
                                }
                            }
                        }
                        $jsonrejet[] = $rejet ;
                        //$inc_rejet++;
                    }
                }
                $i++;                
            }

            if(!isset($commune))
            {
                $jsonimport = array();
            }
            if(!isset($rejet))
            {
                $jsonrejet = array();
                
            }

            $params = array('result'=> true,
                                'jsonmapping'=>json_encode($jsonMapping),
                                "jsonimport"=>json_encode($jsonimport),
                                "jsonrejet"=>json_encode($jsonrejet));

           /* $params = array('result'=> true,
                                    'jsonmapping'=>json_encode($jsonMapping),
                                    "jsonimport"=>json_encode($jsonimport),
                                    "jsonrejet"=>json_encode($jsonrejet),
                                    "tabCode"=>$arrayHeadCsv,
                                    "lien"=>$createMappingWithCSV['lien'],
                                    "arraymappingfields"=>$jsonMapping['fields'],
                                    "arrayCsvImport"=>$arrayCsvImport,
                                    "nbcommunemodif"=>count($arrayCsvImport),
                                    "nbinfoparcommune"=>count($jsonMapping['fields']),
                                    "nbcommunerejet"=>count($arrayCsvRejet),
                                    "arrayCsvRejet"=>$arrayCsvRejet); */

            return $params ;
        
    }



    public static function useJson($file, $post) 
    {
        header('Content-Type: text/html; charset=UTF-8');
        if(isset($file['fileimport']))
        {
            $json = file_get_contents($file['fileimport']['tmp_name']);
            $json_objet = json_decode($json, true);
            

            
            $chaine = FileHelper::arbreJson($json_objet , "", "");

            $arbre = explode(";",  $chaine);
            

            foreach ($arbre as $key => $value) 
            {
                $arbre[$key] = substr($value, 1);
            }
            
            $params = array("result"=>true,
                            "arbre"=>$arbre,
                            "nameFile"=>$file['fileimport']['name'],
                            "json_origine"=>$json,
                            "choose"=>$post['choose']);
            
            if($post['choose'] == "modify")
                $params['chooseMapping'] = $post['chooseMapping'];
		}
        else
        {
            $params['result'] = false;
        }
        return $params ;
    }




    public static function createMappingWithJSON($post)  
    {
            $json_array = json_decode($post['json_origine'], true);
            
            $jsonMapping["src"] = $post['source'];
            //json mapping
            if($post['chooseSelected'] == "new")            
                $jsonMapping["date_create"] = date("d/m/y");
            else
            {
                $oneMapping = PHDB::findOne(City::COLLECTION_IMPORTHISTORY, array("_id"=>new MongoId($post['mappingSelected'])));
                $jsonMapping["date_create"] = $oneMapping["date_create"];
               // $jsonmapping["lastImportId"] = $oneMapping['lastImportId'];
            }
            
            $jsonMapping["date_update"] = date("d/m/y");
            $jsonMapping["url"] = $post['url'];
            $jsonMapping["nameFile"] = $post['nameFile'];
            $jsonMapping["lien"] = $post['lien'];

           foreach ($post['tabmapping'] as $key => $value) 
           {
                if($value != '')
                    $jsonfilsFields[$post['tabidmapping'][$key]] = $value;
           }
        
            $jsonMapping["fields"] = $jsonfilsFields;

            $idLien = $post['lien'];
            $cheminLien = explode(".", $idLien);
            //var_dump($cheminLien);
            $valueIdLien = FileHelper::get_value_json($json_array, $cheminLien) ;
            //var_dump($valueIdLien);

            $res = PHDB::findOne(City::COLLECTION, array("insee" => $valueIdLien));
            $inc_import = 0 ;
            $inc_rejet = 0 ;
            if($res != null)
            {
                $commune["insee"] = $valueIdLien;
                foreach ($jsonMapping['fields'] as $key => $value)
                {
                   $map = explode(".", $value);
                   $cheminJson = explode(".", $key);
                   $value_json = FileHelper::get_value_json($json_array, $cheminJson);
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
                foreach ($jsonMapping['fields'] as $key => $value)
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
                $jsonimport = array();
                $arrayCsvImport = array();
            }
            if(isset($rejet))
            {
                $jsonrejet = $rejet ;
            }
            else
            {
                $jsonrejet = array();
                $arrayCsvRejet = array();
            }
            

            $params = array('result'=> true,
                            'jsonmapping'=>FileHelper::indent_json(json_encode($jsonMapping)),
                            "jsonimport"=>FileHelper::indent_json(json_encode($jsonimport)),
                            "jsonrejet"=>FileHelper::indent_json(json_encode($jsonrejet)),
                            "lien"=>$post['lien']);

            return $params;
         
    } 



    /******** Partie pour importData.php ***************/
    public static function getMicroFormats($params, $fields=null, $limit=0) 
    {
        $microFormats =PHDB::findAndSort(self::MICROFORMATS,$params, array("created" =>1), $limit, $fields);
        return $microFormats;
    }

    public static function parsingCSV($file, $post) 
    {
        header('Content-Type: text/html; charset=UTF-8');
        if(isset($file['fileImport']) && isset($post['separateurDonnees']) && isset($post['separateurTexte']) && isset($post['chooseCollection']))
        {
            $csv = new SplFileObject($file['fileImport']['tmp_name'], 'r');
            $csv->setFlags(SplFileObject::READ_CSV);
            
            $csv->setCsvControl($post['separateurDonnees'], $post['separateurTexte'], '"');
            /*$csvControl = $csv->getCsvControl();
            var_dump($csvControl);
            $csv->setCsvControl($csvControl[0], $csvControl[1]);*/

            $arrayNameFile = explode(".", $file['fileImport']['name']);
            // On découpe le fichier s'il est trop gros, 5000 ligne par fichier

            $path = '../../modules/cityData/filesImportData/' ;
            if(!file_exists($path))
                mkdir($path , 0775);

            $path = '../../modules/cityData/filesImportData/'.$arrayNameFile[0].'/' ;
            if(!file_exists($path))
                mkdir($path , 0775);

            $countLine = 0;
            $countFile = 1;

            foreach ($csv as $key => $value) 
            {

                //if(is_string($value))

                $arrayCSV[$key] = $value;
                if($key == 0)
                    $headerCSV = $value;
                
                if($countLine == 0 || $key == 0)
                    $arrayCSV[0] = $headerCSV;
                else
                    $arrayCSV[$countLine] = $value;


                if($countLine == 5000)
                {
                    $nameFile = $arrayNameFile[0].'_'.$countFile.'.csv' ;
                    ImportData::createCSV($arrayCSV, $nameFile, $path);
                    $countLine = 0;
                    $countFile++;
                    $arrayCSV = array();
                }
                else
                    $countLine++;

            }
            $nameFile = $arrayNameFile[0].'_'.$countFile.'.csv' ;
            ImportData::createCSV($arrayCSV, $nameFile, $path);

            $params = array("createLink"=>true,
                            "arrayCSV" => $arrayCSV,
                            "nameFile"=>$file['fileImport']['name'],
                            "idCollection"=>$post['chooseCollection']);
        }
        else
        {
            $params = array("createLink"=>false);  
        }

        return $params ;
    }



    public static  function previewData($post) 
    {
        /**** new ****/
        
        if(isset($post['infoCreateData']) && isset($post['idCollection']) && isset($post['subFile']) && isset($post['nameFile']))
        {
            $pathSubFile =  '../../modules/cityData/filesImportData/'.$post['nameFile'].'/'.$post['subFile'] ;
            $arrayCSV = new SplFileObject($pathSubFile, 'r');
            $arrayCSV->setFlags(SplFileObject::READ_CSV);
            $arrayCSV->setCsvControl(',', '"', '"');

            $i = 0 ;
            while (!$arrayCSV->eof() && $i == 0) {
                $arrayHeadCSV = $arrayCSV->fgetcsv() ;
                $i++;
            }
           
            $i = 0 ;
            // On parcourt les lignes du CSV
            

            foreach ($arrayCSV as $keyCSV => $lineCSV) 
            {
                // On rejet la premier lignes qui correspond a l'en-tete, et les lignes qui seraient null
                if($i>0 && $lineCSV[0] != null)
                {
                    if (($i%500) == 0)
                    {
                        set_time_limit(30) ;
                    }


                    foreach($post['infoCreateData']as $key => $objetInfoData) 
                    {
                        //$objetInfoData->idHeadCSV;
                        //$objetInfoData->valueLinkCollection;
                        $valueData = $lineCSV[$objetInfoData['idHeadCSV']] ;
                        //var_dump($valueData);
                        
                        if(!empty($valueData))
                        {
                            $paramsInfoCollection = array("_id"=>new MongoId($post['idCollection']));
                            $fieldsInfoCollection =  array("mappingFields.".$objetInfoData['valueLinkCollection']);

                            $infoCollection = ImportData::getMicroFormats($paramsInfoCollection);

                           
                            //var_dump($infoCollection) ; 
                            $mappingTypeData = explode(".", $post['idCollection'].".mappingFields.".$objetInfoData['valueLinkCollection']);


                            $typeData = FileHelper::get_value_json($infoCollection,$mappingTypeData);
                            /*var_dump($mappingTypeData) ; 
                           
                            var_dump($typeData) ; */

                            $mapping = explode(".", $objetInfoData['valueLinkCollection']);
                           
                            if(isset($jsonData[$mapping[0]]))
                            {
                                if(count($mapping) > 1)
                                { 
                                    $newmap = array_splice($mapping, 1);
                                    $jsonData[$mapping[0]] = FileHelper::create_json_with_father($newmap, $valueData, $jsonData[$mapping[0]], $typeData);
                                }
                                else
                                {
                                    $jsonData[$mapping[0]] = $valueData;
                                }
                            }
                            else
                            {
                                if(count($mapping) > 1)
                                { 
                                    $newmap = array_splice($mapping, 1);
                                    $jsonData[$mapping[0]] = FileHelper::create_json($newmap, $valueData, $typeData);
                                }
                                else
                                {
                                    $jsonData[$mapping[0]] = $valueData;
                                }
                            }
                        }
                        
                    }
                    $newOrganization = Organization::newOrganizationFromImportData($jsonData);
                    $newOrganization["role"] = $post["role"];
                   // var_dump($newOrganization);
                    try{
                        $arrayJson[] = Organization::getAndCheckOrganization($newOrganization) ;
                    }
                    catch (CTKException $e){
                        $newOrganization["msgError"] = $e->getMessage();
                        $arrayJsonError[] = $newOrganization ;
                    }

                     //var_dump($arrayJson);
                }
                $i++;
            }

            //var_dump($newOrganization);
            if(!isset($arrayJson))
                $arrayJson = array();

            if(!isset($arrayJsonError))
                $arrayJsonError = array();

            $params = array("result" => true,
                            "jsonImport"=> json_encode($arrayJson),
                            "jsonError"=> json_encode($arrayJsonError));
        }
        else
        {
            $params = array("result" => false); 
        }
        return $params;
    }



    public static function importMongoDB2($post)
    {
        /***** new version *****/

        $newFolder = false ;

        $path = '../../modules/cityData/importData/' ;
        if(!file_exists($path))
            mkdir($path , 0775);


        $pathFile = '../../modules/cityData/importData/'.$post['nameFile'].'/' ;
        if(!file_exists($pathFile))
        {
            mkdir($pathFile , 0775);
            $count = 1 ;
            $newFolder = true ;
        }    
        else
        {
            $files = scandir($pathFile);
            $count = 1 ;
            foreach ($files as $key => $value) {
                $name_file = explode(".", $value);
                if (strpos($name_file[0], "cityData") !== false) 
                {
                   $count++;
                }
            }
        }

        //importmongo all
        if(file_exists("../../modules/cityData/importData/importAllMongo.sh") == true)
            $textImportMongoAll = file_get_contents("../../modules/cityData/importData/importAllMongo.sh", FILE_USE_INCLUDE_PATH);
        else
            $textImportMongoAll = "" ;

        if($newFolder)
        {
            $textImportMongoAll = $textImportMongoAll."cd ".$post['nameFile'].";\n";
            $textImportMongoAll = $textImportMongoAll."sh importMongo.sh;\n";
            $textImportMongoAll = $textImportMongoAll."cd .. ;\n";
        }

        //importmongo 
        if(file_exists("../../modules/cityData/importData/".$post['nameFile']."/importMongo.sh") == true)
            $textFileSh = file_get_contents("../../modules/cityData/importData/".$post['nameFile']."/importMongo.sh", FILE_USE_INCLUDE_PATH);
        else
            $textFileSh = "" ;


        $textFileSh = $textFileSh . "mongoimport --db pixelhumain --collection organizations ".$post['nameFile']."_".$count.".json --jsonArray;\n";
        
        file_put_contents("../../modules/cityData/importData/".$post['nameFile']."/".$post['nameFile']."_".$count.".json", $post['jsonImport']);
        file_put_contents("../../modules/cityData/importData/".$post['nameFile']."/error_".$count.".json", $post['jsonError']);
        file_put_contents("../../modules/cityData/importData/".$post['nameFile']."/importMongo.sh", $textFileSh);
        file_put_contents("../../modules/cityData/importData/importAllMongo.sh", $textImportMongoAll);

        if(isset($post['jsonImport']))
        {
            $arrayDataImport = json_decode($post['jsonImport'], true) ;

            foreach ($arrayDataImport as $key => $value) 
            {
                $newOrganization = Organization::newOrganizationFromImportData($value);
                /*echo "YOYOYOYOYO";
                var_dump($newOrganization);*/
                try{
                    //$resData[] = $newOrganization;
                     //var_dump("yo");
                   $resData[] = Organization::insert($newOrganization, $post['memberId']) ; 
                }
                catch (CTKException $e){
                    $resData[] = $e->getMessage();
                }        
            }
            $params = array("result" => true, 
                            "resData" => $resData);
        }
        else
        {
            $params = array("result" => false); 
        }
        return $params;
    }
}
