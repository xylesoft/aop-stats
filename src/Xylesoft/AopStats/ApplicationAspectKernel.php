<?php

namespace Xylesoft\AopStats;

use Go\Core\AspectContainer;
use Go\Core\AspectKernel;

use Xylesoft\AopStats\Aspects\TreverseAspect;

class ApplicationAspectKernel extends AspectKernel {

	protected function configureAop(AspectContainer $container)
	{
	}
} 