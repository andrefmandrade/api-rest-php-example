<?php
if (!defined('__ROOT__')) define('__ROOT__', __DIR__ . '/../');

include_once __ROOT__ . "/vendor/autoload.php";

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$dotenv = Dotenv\Dotenv::createImmutable(__ROOT__);
$dotenv->load();

date_default_timezone_set($_ENV['TIMEZONE']);