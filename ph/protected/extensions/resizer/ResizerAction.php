<?php
/**
 * Resizer extension controller action class
 *
 * This class implements interface to connect resizer as certain
 * controller action. Extends CAction.
 *
 * PHP version 5.3
 *
 * LICENSE: This source file is subject to  GNU General Public License v2.
 *
 * @category   Extensions
 * @package    resizer
 * @author     Bogdan Burim <bgdn2007@ukr.net>
 * @copyright  2013 Bogdan Burim
 * @version    0.1
 * @link       http://www.yiiframework.com/extension/resizer/
 * @see        Yii Framework
 */

/**
 * class ResizerAction
 *
 * This class implements interface to connect resizer extension as certain
 * controller action.
 *
 * @category   Extensions
 * @package    resizer
 * @author     Bogdan Burim <bgdn2007@ukr.net>
 * @copyright  2013 Bogdan Burim
 */
class ResizerAction extends CAction
{

    /*
     * public $options
     *
     * Extension's configurable options
     */
    public $options = array();

    public function run()
    {
        $defaults = array(
            'action_name' => Yii::app()->controller->action->id,
            'cache_dir'   => Yii::getPathOfAlias('webroot') . '/assets/',
            'base_dir'    => Yii::getPathOfAlias('webroot') . '/',
        );

        $settings = array_merge($defaults, $this->options);

        defined('DS')                         or define('DS', DIRECTORY_SEPARATOR);
        defined('RSZR_DIMENSIONS_DELIMITER')  or define('RSZR_DIMENSIONS_DELIMITER',  'x');
        defined('RSZR_ORIGINALS_BASE_PATH')   or define('RSZR_ORIGINALS_BASE_PATH',   $settings['base_dir']);
        defined('RSZR_CACHED_IMAGES_PATH')    or define('RSZR_CACHED_IMAGES_PATH',    $settings['cache_dir']);
        defined('RSZR_URI_EXPLODE_DELIMITER') or define('RSZR_URI_EXPLODE_DELIMITER', $settings['action_name']);

        // Include core file
        require(dirname(__FILE__) . DS . 'index.php');
    }
}