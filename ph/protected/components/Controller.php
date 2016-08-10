<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    public $appKey;
	public $appType;

	//login settings
	//request password for the login 
    public $secure=true;
    //show social button on login
    public $hasSocial=true;

    //must be carefull with this technique
    //can open the door to attacks 
    //account usurpation is obvious , this needs to be doubled by mail validation
    public $loginRegister=false;
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/mainSearch';
	/**
	 * This object can be filled specifically according to context 
	 * it will be rendered once page logic is done  
	 */
	public $topMenu = array();
	public $sidebar1 = array();
	public $sidebar2 = array();
	public $toolbarMBZ = null;
	public $toolbarMenuAdd = null;
	public $toolbarMenuMaps = null;
	public $title = "";
	public $keywords = "";
	public $description = "";
	public $percent = 15;
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public $moduleId = "communecter";
}