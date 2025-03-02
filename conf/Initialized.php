<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'foodapp');
defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'conf');
defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

require_once(INC_PATH.DS."Constant.php");
require_once(INC_PATH.DS."Database.php");
require_once(CORE_PATH.DS."User.php");