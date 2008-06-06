<?php

/* Remove magic quotes. */
if(get_magic_quotes_gpc()) {
	foreach(array('_GET', '_POST', '_COOKIE', '_REQUEST') as $a) {
		if (is_array($$a)) {
			foreach($$a as &$v) {
				/* We don't use array-parameters anywhere.
				 * Ignore any that may appear.
				 */
				if(is_array($v)) {
					continue;
				}
				/* Unescape the string. */
				$v = stripslashes($v);
			}
		}
	}
}


/* Initialize the autoloader. */
require_once(dirname(dirname(__FILE__)) . '/lib/_autoload.php');

$path_extra = dirname(dirname(__FILE__)) . '/lib';


/** + start modify include path + */
$path = ini_get('include_path');
$path = $path_extra . PATH_SEPARATOR . $path;
ini_set('include_path', $path);
/** + end modify include path + */


/**
 * If you have troubles with the ini_set method above, in example because you run on a hosted
 * web hotel where this method is not allowed to call, comment out the three lines above, and instead
 * uncomment this line:
 */
//$SIMPLESAML_INCPREFIX = $path_extra . '/';


$configdir = dirname(dirname(__FILE__)) . '/config';
SimpleSAML_Configuration::init($configdir);




?>