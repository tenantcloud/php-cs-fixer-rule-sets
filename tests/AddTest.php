<?php

use PhpCsFixer\RuleSet\RuleSets;

it('added a ruleset', function () {
	expect(RuleSets::getSetDefinitionNames())->toContain('@TenantCloud');
	expect(RuleSets::getSetDefinition('@TenantCloud'))->not()->toBeNull();
});
