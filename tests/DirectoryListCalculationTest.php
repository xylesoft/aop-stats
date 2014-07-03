<?php

use \Xylesoft\AopStats\Examples\DirectoryListCalculation;

class DirectoryListCalculationTest extends PHPUnit_Framework_TestCase {

	/**
	 *
	 */
	public function testConstruct() {
		$object = new DirectoryListCalculation(__DIR__ . '/testFlatPath/');

		$this->assertInstanceOf('\\Xylesoft\\AopStats\\Examples\\DirectoryListCalculation', $object);
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testInvalidPath() {
		new DirectoryListCalculation(__DIR__ . '/moose/');
	}

	public function testFlatTreverse() {
		$object = new DirectoryListCalculation(__DIR__ . '/testFlatPath/');

		$results = $object->treverse();

		$this->assertCount(6, $results);
		$this->assertContains(__DIR__ . '/testFlatPath/cats.txt', $results);
		$this->assertContains(__DIR__ . '/testFlatPath/frozenmineralwater.txt', $results);
		$this->assertContains(__DIR__ . '/testFlatPath/goodbye.txt', $results);
		$this->assertContains(__DIR__ . '/testFlatPath/hello.txt', $results);
		$this->assertContains(__DIR__ . '/testFlatPath/hownowbrowncow.txt', $results);
		$this->assertContains(__DIR__ . '/testFlatPath/mrg.txt', $results);
	}

	public function testNestedTreverse() {
		$object = new DirectoryListCalculation(__DIR__ . '/testNestedPath/');

		$results = $object->treverse();

		$this->assertCount(8, $results);
		$this->assertContains(__DIR__ . '/testNestedPath/animals/cats.txt', $results);
		$this->assertContains(__DIR__ . '/testNestedPath/animals/dog.txt', $results);
		$this->assertContains(__DIR__ . '/testNestedPath/frozenmineralwater.txt', $results);
		$this->assertContains(__DIR__ . '/testNestedPath/goodbye.txt', $results);
		$this->assertContains(__DIR__ . '/testNestedPath/hello.txt', $results);
		$this->assertContains(__DIR__ . '/testNestedPath/hownowbrowncow.txt', $results);
		$this->assertContains(__DIR__ . '/testNestedPath/weirdos/mrg.txt', $results);
		$this->assertContains(__DIR__ . '/testNestedPath/weirdos/mrg.txt', $results);
	}
}
 