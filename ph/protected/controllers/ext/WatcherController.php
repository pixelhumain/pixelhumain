<?php
/**
 * WatcherController.php
 *
 * API REST pour géré l'application mobile Water Watecher
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class WatcherController extends Controller {

    const moduleTitle = "Water Watcher App";
    
    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() {
	    $this->render("/watcher/index");
	}

	/**
	 * List all observations 
	 * @param  [type] $id
	 * @return [type]
	 */
	public function actionObservations($id=null) {
	    $attacks = Yii::app()->mongodb->ird->find(); 
	    echo json_encode( array( "list" => $attacks ) );
	    Yii::app()->end();
	}
	
	
}