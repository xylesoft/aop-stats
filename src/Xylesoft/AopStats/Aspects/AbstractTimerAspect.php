<?php
/**
 * Created by PhpStorm.
 * User: jeramyw
 * Date: 03/07/14
 * Time: 15:15
 */

namespace Xylesoft\AopStats\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Aop\Intercept\FieldAccess;
use Go\Lang\Annotation\Around;
use Go\Lang\Annotation\Pointcut;
use Go\Lang\Annotation\DeclareParents;
use Xylesoft\AopStats\Interfaces\Logger;


/**
 * Class AbstractTimerAspect
 *
 * @package Xylesoft\AopStats\Aspects
 */
class AbstractTimerAspect implements Aspect {

	/**
	 * @var Logger
	 */
	protected $logger;

	/**
	 * @var
	 */
	protected $timer;

	/**
	 * @var
	 */
	protected $processTime;

	protected $name;

	protected static $accumulativeTime = [];

	/**
	 * Start the timer
	 */
	protected function startTimer() {

		$this->timer = getrusage()['ru_utime.tv_usec'];
		$this->logger->writeln(sprintf('%s: Timer started @ [%d μs].', $this->name, $this->timer));
	}

	/**
	 * Stop the timer
	 */
	protected function stopTimer() {

		$stopTime = getrusage()['ru_utime.tv_usec'];
		$this->processTime = ($stopTime - $this->timer);

		if (! array_key_exists(($this->name) ?: get_class($this), self::$accumulativeTime)) {
			self::$accumulativeTime[($this->name) ?: get_class($this)] = 0;
		}

		self::$accumulativeTime[($this->name) ?: get_class($this)] += $this->processTime;

		$this->logger->writeln(sprintf('%s: Timer stopped @ [%d μs].', $this->name, $stopTime));
		$this->logger->writeln(sprintf('%s: Start->Stop Runtime: [%d μs].', $this->name, $this->processTime));
	}

	protected function accumulativeTime($name = null) {

		$name = ($name) ?: get_class($this);

		$this->logger->writeln(sprintf('%s: Accumulative Time: [%d μs / %.6f s].', $name, self::$accumulativeTime[$name], self::$accumulativeTime[$name]/1000000));
	}

	/**
	 * @param Logger $logger
	 * @param string $name  Give the aspect a name to provide context in logs.
	 */
	public function __construct(Logger $logger, $name = null) {

		$this->logger = $logger;
		$this->name = ($name) ?: get_class($this);
	}

}