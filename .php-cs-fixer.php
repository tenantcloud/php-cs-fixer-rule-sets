<?php

require __DIR__ . '/src/TenantCloud/PhpCsFixer/RuleSet/TenantCloudSet.php';

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use TenantCloud\PhpCsFixer\RuleSet\TenantCloudSet;

$finder = Finder::create()
	->in('src')
	->in('tests')
	->name('*.php')
	->notName('_*.php')
	->ignoreVCS(true);

return (new Config())
	->setFinder($finder)
	->setRiskyAllowed(true)
	->setIndent("\t")
	->setRules([
		...(new TenantCloudSet())->rules(),
	]);
