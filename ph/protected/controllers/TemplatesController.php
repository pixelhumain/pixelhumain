<?php
/**
 * TemplatesController.php
 *
 * Is a selection of template integrated from external sources
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 16/08/13
 */
class TemplatesController extends Controller {

    public function actionIndex() {
       $name = "index";
       if(isset($_GET["name"])) 
           $name = $_GET["name"];
	   $this->render($name);
	}
}