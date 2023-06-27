<?php

require __DIR__ . '/vendor/kubawerlos/php-cs-fixer-custom-fixers/bootstrap.php';
require __DIR__ . '/bootstrap.php';

use PhpCsFixer\Finder;
use TenantCloud\PhpCsFixer\Config;
use TenantCloud\PhpCsFixer\RuleSet\TenantCloudSet;

$finder = Finder::create()
	->in('src')
	->in('tests')
	->name('*.php')
	->notName('_*.php')
	->ignoreVCS(true);

return Config::make()->setFinder($finder);
