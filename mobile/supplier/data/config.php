<?php
// database host
$db_host   = "localhost:3306";

// database name
$db_name   = "bzl";

// database username
$db_user   = "root";

// database password
$db_pass   = "root";

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

define('AUTH_KEY', 'this is a key');

define('OLD_AUTH_KEY', '');

define('API_TIME', '.2017-09-16 10:10:48.');

?>