<?php
/**
 * KCFinder integration with the CKEditor and management of the storage of uploaded files
 * @author Sylvain Barbot
 */
class KCFinderWidget extends CWidget {
	
	public static $TOTO = "toto";
	// Type de stockage 
	// Stockage à la racine du répertoire d'upload (défault)
	const ROOTDIR_DIRECTORY_STORAGE = "rootdir";
	// Stockage dans un répertoire propre à chaque utilisateur
	// L'utilisateur doit alors être alimenter dans le paramètre $userId
	const USERID_DIRECTORY_STORAGE = "userId";
	/**
	 * Ce paramètre contient le userId. Il doit être alimenté si la méthode de 
	 * stockage choisi dépend de l'id 
	 * @var string the user Id
	 */ 
	public $userId;

	/**
	 * Ce paramètre contient le container de l'objet CKeditor auquel associé le KCFinder 
	 * @var string the user Id
	 */ 
	public $CKEditorContainer;

	/**
	 * Ce paramètre contient l'URL du KCFinder. Par défaut il est dans le thème rapidos
	 * @var string the KCFinder URL
	 */ 
	public $KCFinderURL; 

	/**
	 * Ce paramètre contient la méthode de stockage des fichiers uploadés
	 * Par défaut le stockage est à la racine de l'upload directory
	 * @var string Utiliser les constantes
	 */ 
	public $storageType = self::ROOTDIR_DIRECTORY_STORAGE;

	/**
	 * these constants rappresent the possible status of the widget
	 * @var int
	 */
	const OK = 0;
	const NO_CONFIGURATION_SETS = 1;
	const NO_USERID_SET = 2;
	const NO_CKEDITOR_CONTAINER_SET = 3;
	
	/**
	 * @var int the current status. possible values are those of the constants
	 */
	private $_status;

	/**
	 * @var String The uplaod directory where the files will be saved on the server
	 */
	private $_uploadDir;

	/**
	 * @var String the upload URL where the files will be available
	 */
	private $_uploadURL;

	/**
	 * Initialize the data for the KC finder to work
	 * Mainly the upload directory and URL according to the storage type
	 * @see CWidget::init()
	 */
	public function init()
	{
		parent::init();

		if (!$this->KCFinderURL && $this->KCFinderURL == "") {
			//By default the KCFinder is in the rapidos theme
			//TODO : embed the KCFinder in the extension ?
			$this->KCFinderURL = Yii::app()->baseUrl."/themes/rapidos/assets/plugins/kcfinder/";
		} 

		$this->_status = self::OK;
		//Check the config 
		if (!(isset(Yii::app()->params["uploadURL"]) && isset(Yii::app()->params["uploadDir"]))) {
			$this->_status = self::NO_CONFIGURATION_SETS;
		}

		if (!$this->CKEditorContainer &&  $this->CKEditorContainer == "") {
			$this->_status = self::NO_CKEDITOR_CONTAINER_SET;
		}

		//TODO : ajouter une vérification sur les permissions des répertoires
		
		//By default the URL is on the root dir 
		if ($this->_status == self::OK) {
			switch ($this->storageType) {
				case self::ROOTDIR_DIRECTORY_STORAGE:
					$this->_uploadURL = Yii::app()->params["uploadURL"];
					$this->_uploadDir = Yii::app()->params["uploadDir"];
					break;
				case self::USERID_DIRECTORY_STORAGE:
					if ($this->userId && $this->userId != "") {
						$this->_uploadURL = Yii::app()->params["uploadURL"].$this->userId;
						$this->_uploadDir = Yii::app()->params["uploadDir"].$this->userId;
					} else {
						$this->_status = self::NO_USERID_SET;
					}
					break;
			}
		}
		
		if ($this->_status == self::OK) {
			$_SESSION['KCFINDER'] = array();
        	$_SESSION['KCFINDER']['disabled'] = false;
        	$_SESSION['KCFINDER']['uploadURL'] = $this->_uploadURL;
        	$_SESSION['KCFINDER']['uploadDir'] = $this->_uploadDir;
        	Yii::log("KCFinderWidget initialized with parameters : uploadURL:".$this->_uploadURL." uploadDir:".$this->_uploadDir);
		} 
	}

	/**
	 * add Javascript code to integrate with the CKEditor
	 * @see CWidget::run()
	 */
	public function run() {
		if ($this->_status === self::OK) {
			echo "CKEDITOR.disableAutoInline = true;\n";
        	echo "CKEDITOR.inline( '".$this->CKEditorContainer."',{";
            echo "filebrowserBrowseUrl : '".$this->KCFinderURL."browse.php?opener=ckeditor&type=files',\n";
            echo "filebrowserImageBrowseUrl : '".$this->KCFinderURL."browse.php?opener=ckeditor&type=images',\n";
            echo "filebrowserFlashBrowseUrl : '".$this->KCFinderURL."browse.php?opener=ckeditor&type=flash',\n";
            echo "filebrowserUploadUrl : '".$this->KCFinderURL."upload.php?opener=ckeditor&type=files',\n";
            echo "filebrowserImageUploadUrl : '".$this->KCFinderURL."upload.php?opener=ckeditor&type=images',\n";
            echo "filebrowserFlashUploadUrl : '".$this->KCFinderURL."upload.php?opener=ckeditor&type=flash',\n";
            echo "});\n";
		} else
			echo '<b>'.$this->renderError().'</b>';
	}
	
	/**
	 * @return string the error message to be displayed
	 */
	protected function renderError()
	{
		switch ($this->_status) {
			case self::NO_CONFIGURATION_SETS:
				return Yii::t('KCFinderWidget', 'You need to set a upload directory and URL.<br/>Check the documentation.');
				break;
			case self::NO_USERID_SET:
				return Yii::t('KCFinderWidget', 'Set the user Id to use this type of storage');
				break;
			case self::NO_CKEDITOR_CONTAINER_SET:
				return Yii::t('KCFinderWidget', 'Set the CKEditor container to initialize this widget');
				break;
		}
	}
}