<?php

use Xylesoft\AopStats\ApplicationAspectKernel;
use Xylesoft\AopStats\Examples\DirectoryListCalculation;

/**
 * Class AspectDirectoryListTest
 */
class AspectDirectoryListTest extends PHPUnit_Framework_TestCase {


	public function testKernel() {
		$kernel = ApplicationAspectKernel::getInstance();

		$kernel->init([
			'debug' => true,
			'cacheDir' => __DIR__ . '/cache/',
			'includePaths' => [__DIR__ . '/../src/']
		]);

		$this->assertInstanceOf('\\Xylesoft\\AopStats\\ApplicationAspectKernel', $kernel);
	}

	public function testInterception() {
		$object = new DirectoryListCalculation(__DIR__ . '/testFlatPath/');
		$object->treverse();
	}

}
 