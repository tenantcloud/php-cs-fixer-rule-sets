# php-cs-fixer rule sets

## Usage
Install the package:
`composer require --dev tenantcloud/php-cs-fixer-rule-sets`

Then use the rule sets in php-cs-fixer's config:
```php
return (new PhpCsFixer\Config())
	->setFinder($finder)
	->setRiskyAllowed(true)
	->setIndent("\t")
	->setRules([
		'@TenantCloud' => true,
	]);
```

## Commands
Install dependencies:
`docker run -it --rm -v $PWD:/app -w /app composer install`

Run tests:
`docker run -it --rm -v $PWD:/app -w /app php:7.4-cli vendor/bin/pest`

Run php-cs-fixer on self:
`docker run -it --rm -v $PWD:/app -w /app composer cs-fix`
