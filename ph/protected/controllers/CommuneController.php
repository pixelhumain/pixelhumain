<?php
/**
 * CommuneController.php
 *
 * tous ce que propose le PH pour les associations
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class CommuneController extends Controller {
    const moduleTitle = "Commune";
    public $showSidebar1 = true;
    
	public function actionIndex() {
	    $this->render("index");
	}
    public function actionView($cp) 
    {
        $this->render("view",array('cp'=>$cp,
        						   'dep'=>substr($cp, 0,3),
                                   'communected'=>Yii::app()->mongodb->citoyens->count(array('cp'=>$cp) ),
                                   'commune'=>Yii::app()->mongodb->codespostaux->findOne(array('codeinsee'=>OpenData::$codePostalToCodeInsee["974"][$cp],"type"=>"commune" ) )
                                    ));
	}
    public function actionAnnuaireelus($ci) 
    {
        $this->render("annuaireElus",array( 'ci' => $ci ,
        									'annuaire' => Yii::app()->mongodb->codespostaux->findOne(array('codeinsee'=>$ci,"type"=>"commune" ),array("annuaireElu") )
                                          ));
	}
    public function actionServicesMunicipaux($ci) 
    {
        $this->render("services",array( 'ci' => $ci ,
        									'service' => Yii::app()->mongodb->codespostaux->findOne(array('codeinsee'=>$ci,"type"=>"commune" ),array("servicesMunicipaux") )
                                          ));
	}
	
    public function actionBudget($ci) 
    {
        $this->render("budget",array( 'ci' => $ci ,
        									'service' => Yii::app()->mongodb->codespostaux->findOne(array('codeinsee'=>$ci,"type"=>"commune" ),array("budget","name") )
                                          ));
	}
   
}