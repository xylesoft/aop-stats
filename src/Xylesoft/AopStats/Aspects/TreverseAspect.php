<?php

namespace Xylesoft\AopStats\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Xylesoft\AopStats\Examples\DirectoryListCalculation;

/**
 * Have to include these namespaces or the annotation FUBAR's
 */
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;


class TreverseAspect extends AbstractTimerAspect {

	var $timer;

	/**
	 * Method that will be called before real method
	 *
	 * @param MethodInvocation $invocation Invocation
	 * @Before("execution(public Xylesoft\AopStats\Examples\DirectoryListCalculation->treverse(*))")
	 */
	public function beforeMethodExecution(MethodInvocation $invocation)
	{
		$this->startTimer('DirectoryListCalculation->treverse');
	}

	/**
	 * Method that will be called before real method
	 *
	 * @param MethodInvocation $invocation Invocation
	 * @After("execution(public Xylesoft\AopStats\Examples\DirectoryListCalculation->treverse(*))")
	 */
	public function afterMethodExecution(MethodInvocation $invocation)
	{
		$this->stopTimer('DirectoryListCalculation->treverse');
		$this->accumulativeTime('DirectoryListCalculation->treverse');
	}
}