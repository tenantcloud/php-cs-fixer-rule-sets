const { readFile, writeFile } = require('fs/promises');

module.exports = () => async (template, source) => {
	const sourceCsFixerConfig = (
		await readFile(source.path('.php-cs-fixer.dist.php'))
	)
		.toString()
		.replace(
			'vendor/tenantcloud/php-cs-fixer-rule-sets/bootstrap.php',
			'bootstrap.php'
		);

	await writeFile(source.path('.php-cs-fixer.dist.php'), sourceCsFixerConfig);

	return {
		reserved: [],
	};
};
