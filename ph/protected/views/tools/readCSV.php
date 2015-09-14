<div class="container graph">
    <br/>
    <div class="hero-unit">
<?php
    	
    	$row = 1;
    	$coaches = array();
    	$myproject = '';
    	$projects = array();
    	$created = time();
        if (($handle = fopen("upload/data.csv", "r")) !== FALSE) 
        {
            
            
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
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
            {
                $num = count($data);
                
                $row++;
                
                for ($c=0; $c < $num; $c++) 
                {
                    $line = explode("\t", $data[$c]);
                    $email = trim((isset($line[$emailId]))?$line[$emailId]:null);
                     //echo "----------------------->".$email.'<br/>';
                     if($email)
                     {
                         $first = (isset($line[$firstnameId])) ? $line[$firstnameId] : null;;
                         $last = (isset($line[$lastnameId])) ? $line[$lastnameId] : null;
                         $name = ($first || $last) ? $first." ".$last : "";
                         $cp = (isset($line[$cpId]))?$line[$cpId]:null;
                         $newAccount = array(
                        			'email'=>$email,
                                    'created' => $created,
                                    'type' => "citoyen"
                                    );
                         
                         if($tags)
                            $newAccount["tags"]=$tags; 
                         if($cp && is_numeric($cp))
                            $newAccount["cp"]=$cp;
                         if($cityId && (isset($line[$cityId])))
                            $newAccount["city"]=$line[$cityId]; 
                         if($webId && (isset($line[$webId])))
                            $newAccount["website"]=$line[$webId]; 
                            
                         if(stripos($cp, "974")!== false)
                             $newAccount['country'] = 'Réunion';
                         else if(stripos($cp, "973")!== false)
                             $newAccount['country'] = 'Guyanne';
                         else if(stripos($cp, "976")!== false)
                             $newAccount['country'] = 'Mayotte';
                         else if(stripos($cp, "988")!== false)
                             $newAccount['country'] = 'Nouvelle-Calédonie';
                         else 
                             $newAccount['country'] = 'France';    
                             
                         if( preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email) ) 
                         {
                             $account = Yii::app()->mongodb->citoyens->findOne(array("email"=>$email));
                             if(!$process){
                                 if(!$account){
                                     $echoStr .=  'will save > '.$name.' | '.$email.' | '.$cp.'<br/>';
                                     $insertCount++;
                                 }
                                 else {
                                     $echoStr .=  'xxxx wont save > exist in db : '.$name.' | '.$email.' | '.$cp.'<br/>';
                                     $existCount++;
                                 }
                             }
                             else if(!$account){
                                 Yii::app()->mongodb->citoyens->insert($newAccount);
                                 $insertCount++;
                             } else
                                 $existCount++;
                             
                         } else
                             $echoStr .=  $lineIndex." - wont save malformed Email ------>".$email.'<br/>';
                     }
                     
                }
                $lineIndex++;
            }
            fclose($handle);
            
            echo "<br/> <h2>insert count : ".$insertCount."</h2>";
            echo "<br/> <h2>exist count : ".$existCount."</h2>";
            echo $echoStr;
        }
    	?>
    	</div></div>