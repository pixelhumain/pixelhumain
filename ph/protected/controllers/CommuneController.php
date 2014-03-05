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
        array_push( $this->sidebar1, array( "label"=>"Invitation","href"=>"#invitation", "iconClass"=>"icon-link",  "isModal"=>true));
        array_push( $this->sidebar1, array( "label"=>"Ajouter", "iconClass"=>"icon-plus",
                                            "children"=> array( 
                                                array( "label"=>"Actualité", "onclick"=>"openModal('actuAjoutForm','data',null,'dynamicallyBuild')"),
                                                array( "label"=>"Évenement", "href"=>Yii::app()->createUrl('evenement/creer')),
                                                array( "label"=>"Pensée", "onclick"=>"openModal('actuAjoutForm','data',null,'dynamicallyBuild')"),
                                                array( "label"=>"Projet", "onclick"=>"openModal('actuAjoutForm','data',null,'dynamicallyBuild')"),
                                                array( "label"=>"Lieu", "onclick"=>"openModal('actuAjoutForm','data',null,'dynamicallyBuild')"),
                                                array( "label"=>"Date", "onclick"=>"openModal('actuAjoutForm','data',null,'dynamicallyBuild')"),
                                                array( "label"=>"Question", "onclick"=>"openModal('actuAjoutForm','data',null,'dynamicallyBuild')"),
                                                array( "label"=>"Annonces", "onclick"=>"openModal('actuAjoutForm','data',null,'dynamicallyBuild')"),
                                                array( "label"=>"Covoiturage", "onclick"=>"openModal('actuAjoutForm','data',null,'dynamicallyBuild')"),
                                            ) 
                                        ));

        
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
    public function actionCandidat($ci) 
    {
        $this->render("candidats",array( 'ci' => $ci ,
        								'candidat' => Yii::app()->mongodb->codespostauxCandidats->findOne(array('codeinsee'=>$ci ) )
                                          ));
	}
    
}