<?php

use TenantCloud\PhpCsFixer\RuleSet\TenantCloudSet;

it('returns correct descriptions', function () {
	$set = new TenantCloudSet();

	expect($set->getName())->toBe('@TenantCloud');
	expect($set->isRisky())->toBeTrue();
});
