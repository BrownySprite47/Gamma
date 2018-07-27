<?php

/**
 * Add Error Handler
 */
require_once CORE_DIR . '/core/errors/errors_handler.php';

/**
 * Define Root Dir constant
 */
define('CORE_DIR', $_SERVER['DOCUMENT_ROOT']);

/**
 * Define key constant for password
 */
define('KEY', 'HHJknj45');
/**
 * Define site constant
 */
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    define('SITE', 'https://'.$_SERVER["SERVER_NAME"]);
} else {
    define('SITE', 'http://'.$_SERVER["SERVER_NAME"]);
}

/**
 * Define Analytics adn debug constants
 */
if (SITE == 'http://kakuchat.loc') {
    define('ANALYTICS', false);
    define('DEBUG_DB', true);
} else {
    define('ANALYTICS', true);
    define('DEBUG_DB', false);
}

/**
 *  Define size File constants
 */
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

/**
 * On / Off Error Handler
 */
if ($_SERVER["SERVER_NAME"] == 'kakuchat.loc') {
    new ErrorHandler(true);
} else {
    new ErrorHandler(false);
}
