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
                                   'communcted'=>Yii::app()->mongodb->citoyens->count(array('cp'=>$cp) )));
	}
    public function actionAnnuaireelus($ci) 
    {
        $annuaire = Yii::app()->mongodb->codespostaux->findOne(array('codeinsee'=>$ci,"type"=>"commune" ),array("annuaireElu") ); 
        $this->render("annuaireElus",array( 'ci' => $ci ,
        									'annuaire' => $annuaire
                                          ));
	}
    public function actionServicesMunicipaux($ci) 
    {
        $service = Yii::app()->mongodb->codespostaux->findOne(array('codeinsee'=>$ci,"type"=>"commune" ),array("servicesMunicipaux") ); 
        $this->render("services",array( 'ci' => $ci ,
        									'service' => $service
                                          ));
	}
}