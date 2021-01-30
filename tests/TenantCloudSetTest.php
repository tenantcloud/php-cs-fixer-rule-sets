<?php

use TenantCloud\PhpCsFixer\RuleSet\TenantCloudSet;

test('returns correct descriptions', function () {
	$set = new TenantCloudSet();

	expect($set->getName())->toBe('@TenantCloud');
	expect($set->isRisky())->toBeTrue();
});
