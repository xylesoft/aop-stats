<?php

namespace Xylesoft\AopStats\Interfaces;

interface Logger {

	/**
	 * Write a single line without a new line.
	 *
	 * @param string $message
	 * @return void
	 */
	public function write($message);

	/**
	 * Write a single with a new line.
	 *
	 * @param string $message
	 * @return void
	 */
	public function writeln($message);

}