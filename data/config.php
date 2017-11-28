<?php
// database host
$db_host   = "192.168.27.60";

// database name
$db_name   = "bzl";

// database username
$db_user   = "bzl";

// database password
$db_pass   = "123456";

// HongYuJD-V7.2 bbs.hongyuvip.com
$prefix    = "ecs_";

$timezone    = "PRC";

$cookie_path    = "/";

$cookie_domain    = "";

$session = "1440";

define('EC_CHARSET','utf-8');

if(!defined('ADMIN_PATH'));
{
define('ADMIN_PATH','admin');
}
if(!defined('ADMIN_PATH_M'));
{
define('ADMIN_PATH_M','admin');
}
define('AUTH_KEY', 'this is a key');

define('OLD_AUTH_KEY', '');

define('API_TIME', '2017-09-19 11:30:04');

define('DEBUG_MODE', 1);

?>