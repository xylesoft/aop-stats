<?php
/**
 * Created by PhpStorm.
 * User: jeramyw
 * Date: 03/07/14
 * Time: 13:18
 */

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Logger.php';

use Xylesoft\AopStats\ApplicationAspectKernel;
use Xylesoft\AopStats\Examples\DirectoryListCalculation;
use Xylesoft\AopStats\Aspects\TreverseAspect;

$kernel = ApplicationAspectKernel::getInstance();
$kernel->init([
	'debug' => true,
	'cacheDir' => __DIR__ . '/tests/cache/',
	'includePaths' => []
]);

$logger = new \Logger(__DIR__ . '/log.txt');

$kernel->getContainer()->registerAspect(new TreverseAspect($logger, 'DirectoryListCalculation->treverse'));

$logger->writeln('Analyising: ' . realpath(__DIR__ . '/tests/testFlatPath/'));
$obj = new DirectoryListCalculation(__DIR__ . '/tests/testFlatPath/');
$obj->treverse();

$logger->writeln('Analyising: ' . realpath(__DIR__ . '/../'));
$obj = new DirectoryListCalculation(__DIR__ . '/../');
$obj->treverse();


