<?php
class DirectoryHelper {
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Directory Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/directory_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Create a Directory Map
 *
 * Reads the specified directory and builds an array
 * representation of it.  Sub-folders contained with the
 * directory will be mapped as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	int		depth of directories to traverse (0 = fully recursive, 1 = current dir, etc)
 * @return	array
 */
	public static function directory_map($source_dir, $directory_depth = 0, $hidden = FALSE)
	{
		if ($fp = @opendir($source_dir))
		{
			$filedata	= array();
			$new_depth	= $directory_depth - 1;
			$source_dir	= rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

			while (FALSE !== ($file = readdir($fp)))
			{
				// Remove '.', '..', and hidden files [optional]
				if ( ! trim($file, '.') OR ($hidden == FALSE && $file[0] == '.'))
				{
					continue;
				}

				if (($directory_depth < 1 OR $new_depth > 0) && @is_dir($source_dir.$file))
				{
					$filedata[$file] = self::directory_map($source_dir.$file.DIRECTORY_SEPARATOR, $new_depth, $hidden);
				}
				else
				{
					$filedata[] = $file;
				}
			}

			closedir($fp);
			return $filedata;
		}

		return FALSE;
	}

	public static function safe_directory($path) {
		if (empty($path)){
			throw new CException(Yii::t('app', "Path cannot be empty"), 500);
		} elseif (! file_exists($path) && ! mkdir($path, 0754, TRUE)){
			throw new CException(Yii::t('app', "Cannot create directory :path", array(':path' => $path)), 500);
		} elseif (! is_dir($path)){
			throw new CException(Yii::t('app', "Path :path already exists but not a directory.", array(':path' => $path)), 500);
		} elseif (! is_readable($path)) {
			throw new CException(Yii::t('app', "Cannot read directory contents of :path.", array(':path' => $path)), 500);
		} elseif (! is_writable($path)) {
			throw new CException(Yii::t('app', "Cannot write into directory :path.", array(':path' => $path)), 500);
		}
		return $path;
	}
}


/* End of file directory_helper.php */
/* Location: ./system/helpers/directory_helper.php */