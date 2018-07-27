<?php


$controller = getUrnSegments();

if ($controller == '') {
    $controller = 'index';
}
$action = 'index';

if (file_exists(CORE_DIR . '/core/controllers/' . $controller . '.php')) {
    require_once CORE_DIR . '/core/controllers/' . $controller . '.php';

    if (function_exists($action)) {
        $action();
    } else {
        show404page();
    }
} elseif (file_exists(CORE_DIR . '/core/controllers/' . $controller . '/index.php')) {
    require_once CORE_DIR . '/core/controllers/' . $controller . '/index.php';

    if (function_exists($action)) {
        $action();
    } else {
        show404page();
    }
} elseif (file_exists(CORE_DIR . '/core/controllers/' . $controller . '/index/index.php')) {
    require_once CORE_DIR . '/core/controllers/' . $controller . '/index/index.php';

    if (function_exists($action)) {
        $action();
    } else {
        show404page();
    }
} elseif (file_exists(CORE_DIR . '/core/controllers/' . $controller . '/index/index/index.php')) {
    require_once CORE_DIR . '/core/controllers/' . $controller . '/index/index/index.php';

    if (function_exists($action)) {
        $action();
    } else {
        show404page();
    }
} else {
    show404page();
}
