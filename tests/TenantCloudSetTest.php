<?php

use TenantCloud\PhpCsFixer\RuleSet\TenantCloudSet;

it('returns rules', function () {
	$rules = (new TenantCloudSet())->rules();

	expect($rules)->toBeArray();
});
