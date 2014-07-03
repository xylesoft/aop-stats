<?php

class Logger implements \Xylesoft\AopStats\Interfaces\Logger {

	private $resource;

	public function __construct($logFileLocation, $append = false) {
		if (! is_writeable(dirname($logFileLocation))) {
			throw new InvalidArgumentException('Can not write file to: ' . $logFileLocation);
		}

		$this->resource = fopen($logFileLocation, ($append) ? 'a' : 'w');
	}

	public function __destruct() {
		fclose($this->resource);
	}

	/**
	 * Write a single line without a new line.
	 *
	 * @param string $message
	 * @return void
	 */
	public function write($message) {
		fwrite($this->resource, $message);
	}

	/**
	 * Write a single with a new line.
	 *
	 * @param string $message
	 * @return void
	 */
	public function writeln($message) {
		$this->write($message . PHP_EOL);
	}


} 