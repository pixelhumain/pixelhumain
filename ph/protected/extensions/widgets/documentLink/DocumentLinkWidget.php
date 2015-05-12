<?php
class DocumentLinkWidget extends CWidget {
	public $document;
	public $text;
	
    public function run() {
        $this->render('documentLink');
    }
 
}
?>