<?php

use PhpCsFixer\RuleSet\RuleSets;
use TenantCloud\PhpCsFixer\RuleSet\TenantCloudSet;

$sets = [
	'@TenantCloud' => new TenantCloudSet(),
];

// So for whatever reason php-cs-fixer still doesn't support JUST passing rule sets into the config,
// so we're using this hack to make php-cs-fixer think this is a default ruleset.
$reflection = new ReflectionClass(RuleSets::class);
$reflection->setStaticPropertyValue(
	'setDefinitions',
	array_merge(
		RuleSets::getSetDefinitions(),
		$sets
	)
);
