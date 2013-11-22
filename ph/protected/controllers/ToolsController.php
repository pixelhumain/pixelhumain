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
	public function actionVisualizeImport($group,$type) {
	    $process = 0;
        $row = 1;
    	$created = time();
    	$CsvString = "Pierre COUPIAC	p.coupiac@orange.fr
Josse ATK	josselynew@gmail.com
alainmouetaux	alainmouetaux@orange.fr
Brigitte Denys	yannobri@wanadoo.fr 
	974.bio@voila.fr 
aujoulat	p.aujoulat@only.fr 
	a.rochard974@yahoo.fr 
Nelly Bouineau	bouineaunelly@yahoo.fr
Celine Chabut	chabut.celine@gmail.com
Didier Bourse	d.bourse@wanadoo.fr
Béatrice Couturier	beatrice@asso-liberte.com
Anne-Marie Coupiac	ploumix@voila.fr
Agnes Coupiac	agnes.coupiac@hotmail.fr
Jean Coupiac	j.coupiac@wanadoo.fr
Olivier Coupiac	olivier.coupiac@gmail.com
Xavier Coupiac	coupiac-xavier@bbox.fr
COUPIAC Paul	macapa33@wanadoo.fr
marion coupiac	marioncoupiac@orange.fr 
Sylvain Courdil	unit.et.metis@gmail.com
Louis-Bernard Coupiac	lb.coupiac@laposte.net
loic Damey	dameylo@gmail.com
Patricia Coupiac	patricia.coupiac@ac-montpellier.fr
Philippe Derudder	derudder@lhed.fr";
        
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
}