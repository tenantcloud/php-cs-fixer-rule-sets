# php-cs-fixer rule sets

## Usage

Install the package:
`composer require --dev tenantcloud/php-cs-fixer-rule-sets`

Then use the rule sets in php-cs-fixer's config:

```php
require __DIR__ . '/vendor/kubawerlos/php-cs-fixer-custom-fixers/bootstrap.php';
require __DIR__ . '/vendor/tenantcloud/php-cs-fixer-rule-sets/bootstrap.php';

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
```
