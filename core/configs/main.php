<?php

require_once CORE_DIR . '/core/errors/errors_handler.php';

define('KEY', 'HHJknj45');
define('CORE_DIR', $_SERVER['DOCUMENT_ROOT']);

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    define('SITE', 'https://'.$_SERVER["SERVER_NAME"]);
} else{
    define('SITE', 'http://'.$_SERVER["SERVER_NAME"]);
}

if (SITE == 'http://kakuchat.loc') {
    define('ANALYTICS', false);
    define('DEBUG_DB', true);
}else{
    define('ANALYTICS', true);
    define('DEBUG_DB', false);
}

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

if ($_SERVER["SERVER_NAME"] == 'kakuchat.loc') {
    new ErrorHandler(true);
}else{
    new ErrorHandler(false);
}

