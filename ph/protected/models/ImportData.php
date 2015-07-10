<?php
/*
	
 */
class ImportData
{ 
	
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
            mkdir("../../modules/cityData/importHistory/".$nameFolder , 0777);
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/importHistory.json", $post['jsonmapping']);
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/cityData_1.json", $post['jsonimport']);
            file_put_contents("../../modules/cityData/importHistory/".$nameFolder."/error_1.json", $post['jsonrejet']);

            $textFileSh = "mongoimport --db pixelhumain --collection cityData cityData_1.json --jsonArray;\n";
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




        if($post['chooseSelected'] == "new"){
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
        }

    
        if(isset($objectImport->insee))
        {
            $res = PHDB::findOne(City::COLLECTION_DATA, array("insee" => $objectImport->insee));
            
            if($res == null)
            {
                //var_dump($value);
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
		return $resMapping;
        //return true ;
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

            $path = '../../modules/cityData/filesCityData/'.$arrayNameFile[0].'/' ;
            if(!file_exists($path))
                mkdir($path , 0777);


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

            Yii::app()->session["tabCSV"] = $tabCSV;

            $params = array("result"=>true,
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
            $arrayHeadCsv = $arrayCSV->fgetcsv() ;
            $i++;
        }
        /*foreach ($arrayCSV as $key => $value) 
	    {
	        if($key == 0)
	            $arrayHeadCsv = $value;
	    }*/
        
        $jsonMapping["src"] = $createMappingWithCSV['source'];
        

        //create json for mapping
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
           /*var_dump($createMappingWithCSV['tabidmapping']);
            var_dump(isset($arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]]));
            var_dump($value);
            var_dump($key);*/
            if($value != '' && isset($arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]]))
            {   
                $d = $arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]];
                $jsonfilsFields[$d] = $value;
            }
        }
        
        foreach ($createMappingWithCSV['tabTypeMapping'] as $key => $value) 
        {
            /*var_dump($createMappingWithCSV['tabidmapping'][$key]);
            var_dump($value);*/
            if($value != '' && isset($arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]]))
            {   
                $d = $arrayHeadCsv[$createMappingWithCSV['tabidmapping'][$key]];
                $jsonfilsType[$d] = $value;
            }
        }
        
        $jsonMapping["fields"] = $jsonfilsFields;
        $jsonMapping["type"] = $jsonfilsType;

        $idLien = $createMappingWithCSV['lien'];

           
            //json import csv
            $i = 0 ;
            $inc_import = 0 ;
            $inc_rejet = 0 ;
            //while(count($arrayCSV) > $i) {
            foreach ($arrayCSV as $key => $line) 
            {
                
                if($i>0 && $line[0] != null)
                {
                    if (($i%500) == 0)
                    {
                        set_time_limit(30) ;
                    }

                    //$line = $arrayCSV[$i];

                    $valueIdLien = $line[$idLien];

                    $res = PHDB::findOne(City::COLLECTION, array("insee" => $valueIdLien));
                  
                    
                    if($res != null)
                    {
                        $commune["insee"] = $valueIdLien;
                        $arrayCsvImport[$i] = $line ;
                        foreach ($arrayHeadCsv as $keyCode => $valueCode) 
                        {
                            foreach ($jsonMapping['fields'] as $key => $value) 
                            {
                               // var_dump($value);
                                if($valueCode == $key)
                                { 
                                    $map = explode(".", $value);
                                    if(!isset($commune[$map[0]]))
                                    {
                                        if(count($map) > 1)
                                        {
                                            //echo"type : ";
                                           // var_dump($jsonMapping['type'][$key]);
                                            $newmap = array_splice($map, 1);
                                            $commune[$map[0]] = FileHelper::create_json($newmap, $line[$keyCode], $jsonMapping['type'][$key]);
                                        }
                                        else
                                        {

                                            /*echo"</br> bon1 $line[$keyCode] : ";
                                            var_dump($line[$keyCode]);*/
                                            if($jsonMapping['type'][$key] == "INT")
                                                $commune[$map[0]] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $commune[$map[0]] = floatval($line[$keyCode]);
                                            else
                                                $commune[$map[0]] = $line[$keyCode];
                                        }
                                    }
                                    else
                                    {
                                        if(count($map) > 1)
                                        { 
                                            //echo"type2 : ";
                                            //var_dump($jsonMapping['type'][$key]);
                                            $newmap = array_splice($map, 1);
                                            $commune[$map[0]] = FileHelper::create_json_with_father($newmap, $line[$keyCode], $commune[$map[0]], $jsonMapping['type'][$key]) ;
                                        }
                                        else
                                        {

                                            //echo"</br> bon2 $line[$keyCode] : ";
                                            //($line[$keyCode]);
                                            if($jsonMapping['type'][$key] == "INT")
                                                $commune[$map[0]] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $commune[$map[0]] = floatval($line[$keyCode]);
                                            else
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
                        //var_dump($line);
                        $rejet["insee"] = $valueIdLien;
                        $arrayCsvRejet[$i] = $line ;

                        foreach ($arrayHeadCsv as $keyCode => $valueCode) 
                        {
                           foreach ($jsonMapping['fields'] as $key => $value) 
                            {
                                if($valueCode == $key)
                                { 
                                    $map = explode(".", $value);
                                    if(!isset($rejet[$map[0]]))
                                    {
                                        if(count($map) > 1)
                                        {
                                            $newmap = array_splice($map, 1);
                                            $rejet[$map[0]] = FileHelper::create_json($newmap, $line[$keyCode], $jsonMapping['type'][$key]);
                                        }
                                        else
                                        {
                                            if($jsonMapping['type'][$key] == "INT")
                                                $rejet[$map[0]] = intval($line[$keyCode]);
                                            else if($jsonMapping['type'][$key] == "FLOAT")
                                                $rejet[$map[0]] = floatval($line[$keyCode]);
                                            else
                                                $rejet[$map[0]] = $line[$keyCode];
                                        }
                                    }
                                    else
                                    {
                                        
                                        if(count($map) > 1)
                                        { 
                                           // $newmap = array_splice($map, 1);
                                           // $rejet[$map[0]] = FileHelper::create_json_with_father($newmap, $line[$keyCode], $rejet[$map[0]]) ;
                                        }
                                        else
                                        {
                                            //$rejet[$map[0]] = $line[$keyCode];
                                        }
                                    }
                                }
                            }
                        }
                        $jsonrejet[] = $rejet ;
                        $inc_rejet++;
                    }
                }
                $i++;                
            }

            if(!isset($commune))
            {
                $jsonimport = [];
                $arrayCsvImport = [];
            }
            if(!isset($rejet))
            {
                $jsonrejet = [];
                $arrayCsvRejet = [];
            }

            $params = array('result'=> true,
                                    'jsonmapping'=>FileHelper::indent_json(json_encode($jsonMapping)),
                                    "jsonimport"=>FileHelper::indent_json(json_encode($jsonimport)),
                                    "jsonrejet"=>FileHelper::indent_json(json_encode($jsonrejet)),
                                    "tabCode"=>$arrayHeadCsv,
                                    "lien"=>$createMappingWithCSV['lien'],
                                    "arraymappingfields"=>$jsonMapping['fields'],
                                    "arrayCsvImport"=>$arrayCsvImport,
                                    "nbcommunemodif"=>count($arrayCsvImport),
                                    "nbinfoparcommune"=>count($jsonMapping['fields']),
                                    "nbcommunerejet"=>count($arrayCsvRejet),
                                    "arrayCsvRejet"=>$arrayCsvRejet);

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
            

            $params = array('result'=> true,
                            'jsonmapping'=>FileHelper::indent_json(json_encode($jsonMapping)),
                            "jsonimport"=>FileHelper::indent_json(json_encode($jsonimport)),
                            "jsonrejet"=>FileHelper::indent_json(json_encode($jsonrejet)),
                            "lien"=>$post['lien']);

            return $params;
         
    } 
}
