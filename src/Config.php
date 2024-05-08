<?php

namespace TenantCloud\PhpCsFixer;

use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixerCustomFixers\Fixers;
use TenantCloud\PhpCsFixer\RuleSet\TenantCloudSet;

final class Config
{
	private function __construct() {}

	public static function make(): PhpCsFixerConfig
	{
		return (new PhpCsFixerConfig())
			->registerCustomFixers(new Fixers())
			->setRiskyAllowed(true)
			->setIndent("\t")
			->setRules([
				...new TenantCloudSet(),
			]);
	}
}
