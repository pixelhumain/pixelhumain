<div class="container graph">
    <br/>
    <div class="hero-unit">
<?php
    	
    	$row = 1;
    	$coaches = array();
    	$myproject = '';
    	$projects = array();
    	$created = time();
        if (($handle = fopen("upload/HIST_POP_COM_RP10.csv", "r")) !== FALSE) 
        {
            
            
            $codeInseeID = 0;
            $nameID = 6;
            $popMun2010ID = 7;
            $popMun1999ID = 8;
            $popMun1990ID = 9;
            $popMun1982ID = 10;
            $popMun1974ID = 11;
            $popMun1967ID = 12;
            $popMun1961ID = 13;
              
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
                    $codeInsee = $line[$codeInseeID];
                    if( preg_match('/974/',$codeInsee))
                    {
                         
                         $newAccount = array(
                             "name"=>$line[$nameID],
                             "codeinsee"=>$codeInsee,
                             "type"=>"commune",
                             "created"=>$created,
                             "demographie"=>array(
                             					"2010"=>$line[$popMun2010ID],
                                                 "1999"=>$line[$popMun1999ID],
                                                 "1990"=>$line[$popMun1990ID],
                                                 "1982"=>$line[$popMun1982ID],
                                                 "1974"=>$line[$popMun1974ID],
                                                 "1967"=>$line[$popMun1967ID],
                         						 "1961"=>$line[$popMun1961ID]
                                                 )
                         );
                         $cpExist = Yii::app()->mongodb->codespostaux->findOne(array("codeinsee"=>$codeInsee,"type"=>"commune"));
                         if(!$process)
                         {
                             if(!$cpExist){
                                 $echoStr .=  'will save > '.$line[$nameID].' | '.$codeInsee.' | '.$line[$popMun2010ID].' | '.$line[$popMun1999ID].'<br/>';
                                 $insertCount++;
                             }
                             else {
                                 $echoStr .=  'xxxx wont save > exist in db : '.$codeInsee.'<br/>';
                                 $existCount++;
                             }
                         }
                         else if(!$cpExist){
                             Yii::app()->mongodb->codespostaux->insert($newAccount);
                             $insertCount++;
                         } else
                             $existCount++;
                         
                         $lineIndex++;
                     }
                     
                }
            }
            fclose($handle);
            
            echo "<br/> <h2>insert count : ".$insertCount."</h2>";
            echo "<br/> <h2>exist count : ".$existCount."</h2>";
            echo $echoStr;
        }
    	?>
    	</div></div>