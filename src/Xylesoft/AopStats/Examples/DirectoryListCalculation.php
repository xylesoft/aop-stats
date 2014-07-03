<?php

namespace Xylesoft\AopStats\Examples;

use InvalidArgumentException;

/**
 * Class DirectoryListCalculation
 *
 * Example class for treversing a directory and listing the items.
 */
class DirectoryListCalculation {

	protected $path;

	public function __construct($path) {
		if (! is_dir($path) || ! is_readable($path)) {
			throw new InvalidArgumentException('Invalid or Unreadable path: ' . $path);
		}

		$this->path = $path;
	}

	public function treverse() {

		$run = function($path) use (&$run) {
			$dirRes = opendir($path);
			$files = [];

			while (($file = readdir($dirRes)) !== false) {

				if ($file == '.' || $file == '..') {
					continue 1;
				}

				if (is_dir($path . '/' . $file)) {

					$dir = $path . $file . '/';
					$files = array_merge($files, $run($dir));
				} else {

					$files[] = $path . $file;
				}
			}

			closedir($dirRes);

			return $files;
		};

		return $run($this->path);
	}
}