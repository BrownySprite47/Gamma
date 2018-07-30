<?php
define("CORE_DIR", __DIR__ . '/../');


require_once CORE_DIR . '/core/configs/main.php';

require_once CORE_DIR . '/core/library/main.php';
require_once CORE_DIR . '/core/library/database.php';
require_once CORE_DIR . '/core/library/visitors.php';
require_once CORE_DIR . '/core/library/session.php';
require_once CORE_DIR . '/core/models/status.php';
require_once CORE_DIR . '/core/models/main.php';
require_once CORE_DIR . '/core/models/admin.php';
require_once CORE_DIR . '/core/models/user.php';
require_once CORE_DIR . '/core/models/leaders.php';
require_once CORE_DIR . '/core/models/news.php';
require_once CORE_DIR . '/core/models/projects.php';
require_once CORE_DIR . '/core/models/comments.php';

session_start();

require_once CORE_DIR . '/core/library/access.php';
require_once CORE_DIR . '/core/library/router.php';



//$date = date('m/d/Y h:i:s a', time());
