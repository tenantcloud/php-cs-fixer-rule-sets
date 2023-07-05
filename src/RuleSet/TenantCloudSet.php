<?php

namespace TenantCloud\PhpCsFixer\RuleSet;

use PhpCsFixerCustomFixers\Fixer\CommentSurroundedBySpacesFixer;
use PhpCsFixerCustomFixers\Fixer\ConstructorEmptyBracesFixer;
use PhpCsFixerCustomFixers\Fixer\DataProviderReturnTypeFixer;
use PhpCsFixerCustomFixers\Fixer\DeclareAfterOpeningTagFixer;
use PhpCsFixerCustomFixers\Fixer\EmptyFunctionBodyFixer;
use PhpCsFixerCustomFixers\Fixer\MultilineCommentOpeningClosingAloneFixer;
use PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer;
use PhpCsFixerCustomFixers\Fixer\NoTrailingCommaInSinglelineFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessParenthesisFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessStrlenFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocParamTypeFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocSelfAccessorFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocTypesCommaSpacesFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocTypesTrimFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitAssertArgumentsOrderFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitDedicatedAssertFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitNoUselessReturnFixer;

/**
 * Rule set of all TenantCloud's projects.
 *
 * The general idea is:
 *  - the least code possible without hurting readability. No typehint doubling PHPDocs, single line instead of multiline etc
 *  - the least amount of merges (ordered imports etc)
 *  - PSR practices
 */
class TenantCloudSet
{
	/**
	 * @return array<string, boolean|array<string, mixed>>
	 */
	public function rules(): array
	{
		return [
			'@PhpCsFixer'    => true,
			'@Symfony'       => true,
			'@Symfony:risky' => true,
			'@PSR12'         => true,
			'@PSR12:risky'   => true,
			// Use `??=` whenever possible
			'assign_null_coalescing_to_coalesce_equal' => true,
			// Single space before/after operators (=, <=, >=, ?? etc), except for `=>`
			'binary_operator_spaces' => [
				'operators' => [
					'=>' => 'align_single_space_minimal',
				],
			],
			// Blank line before all of those constructs.
			'blank_line_before_statement' => [
				'statements' => [
					'break', 'continue', 'declare', 'default', 'do', 'exit', 'for', 'foreach',
					'goto', 'if', 'return', 'switch', 'throw', 'try', 'while', 'yield', 'yield_from',
				],
			],
			// One blank line in between methods and properties
			'class_attributes_separation' => [
				'elements' => ['method' => 'one', 'property' => 'one'],
			],
			// Spaces around string concatenation 'asd' . 'asd'
			'concat_space' => [
				'spacing' => 'one',
			],
			'error_suppression' => [
				// Mutes trigger_error() with E_USER_DEPRECATED, but we handle deprecations manually so this is needed.
				'mute_deprecation_error' => false,
			],
			// Import global classes, but neither require nor forbid function/constant imports
			'global_namespace_import' => true,
			// Remove @throws from code.
			'general_phpdoc_annotation_remove' => [
				// We don't believe so called "checked exceptions" are a good design. We're following the logic of Kotlin:
				// https://kotlinlang.org/docs/reference/exceptions.html#checked-exceptions
				'annotations' => ['throws'],
			],
			// Rename lower case & plural form @inheritDoc
			'general_phpdoc_tag_rename' => [
				'replacements' => [
					'inheritDocs' => 'inheritDoc',
					'inheritdoc'  => 'inheritDoc',
				],
			],
			// Forces proper indentation on Heredoc/Nowdoc
			'heredoc_indentation' => true,
			// `$i++` instead of `++$i`
			'increment_style' => [
				'style' => 'post',
			],
			// `[$var1, $var2] = something()` instead of `list($var1, $var2) = something()`
			'list_syntax' => [
				'syntax' => 'short',
			],
			// Do not remove "unused" use($var) from closures, as some Laravel code uses reflection to access those.
			'lambda_not_used_import' => false,
			// Do not move semicolon to a newline after a multiline construct.
			'multiline_whitespace_before_semicolons' => false,
			// Replace `str*` functions with `mb_str*`
			'mb_str_functions' => true,
			// Allow `strpos()` instead of `\strpos()`
			'native_function_invocation' => false,
			// Allow `JSON_THROW_ON_ERROR` instead of `\JSON_THROW_ON_ERROR`
			'native_constant_invocation' => false,
			// Do not remove trailing whitespace from string as it might break something with no profit.
			'no_trailing_whitespace_in_string' => false,
			// Reorder constructs in a class/interface/enum
			'ordered_class_elements' => [
				'order' => [
					// First `use SomeTrait`
					'use_trait',
					// Then enums `case SOMETHING`
					'case',
					// Then `public const` and `private const`
					'constant_public', 'constant_protected', 'constant_private',
					// Then `public` and `private` properties, both static and regular, in no specific order.
					'property_public', 'property_protected', 'property_private',
					// `__construct` after properties, but before all methods
					'construct',
					// PHPUnit's `setUp` and `tearDown` before all test cases and methods
					'phpunit',
					// Then `public` and `private` methods, both static and regular, in no specific order.
					'method_public', 'method_protected', 'method_private',
					// `__magic` after all regular methods
					'magic',
					// __destruct always last
					'destruct',
				],
			],
			// Sort imports by class, function and then const. Sort by alphabet in each of the groups.
			'ordered_imports' => [
				'imports_order'  => ['class', 'function', 'const'],
				'sort_algorithm' => 'alpha',
			],
			// Forces `&&` and `||` (or similar) operators to be at the end of the line, when multiline.
			'operator_linebreak' => [
				'only_booleans' => true,
				'position'      => 'end',
			],
			// Allow PHPDoc summary to not end with a punctuation symbol.
			'phpdoc_summary' => false,
			// Do not require @coversNothing for PHPUnit test cases for now
			'php_unit_test_class_requires_covers' => false,
			// Do not mark PHPUnit test cases as @internal
			'php_unit_internal_class' => false,
			// Force naming on PHPUnit test data providers to match the test: `testSomething` -> `somethingProvider`
			'php_unit_data_provider_name' => [
				'prefix' => '',
				'suffix' => 'Provider',
			],
			// Force PHPUnit test data providers to be static functions
			'php_unit_data_provider_static' => true,
			// Do not convert protected to private because it's risky. Better done with Rector
			'protected_to_private' => false,
			// Forces PHPDoc to be single line for constants and properties.
			'phpdoc_line_span' => [
				'const'    => 'single',
				'property' => 'single',
			],
			// Do not replace `@property-read` and `@property-write` with `@property`
			'phpdoc_no_alias_tag' => [
				'replacements' => ['type' => 'var', 'link' => 'see'],
			],
			// Force {@inheritDoc} to @inheritDoc whenever possible.
			'phpdoc_tag_type' => [
				'tags' => [
					'inheritDoc' => 'annotation',
				],
			],
			'phpdoc_to_comment' => [
				// Avoid converting generic trait uses and return type variable declaration from PHPDoc to comments
				'ignored_tags' => ['var', 'use'],
			],
			// Simplifies `if($cond) { return true; } return false` kind of cases into `return (bool) $cond;`
			'simplified_if_return' => true,
			// Use `??` whenever possible
			'ternary_to_null_coalescing' => true,
			// Converts closures to arrow functions whenever possible
			'use_arrow_functions' => true,
			// `$something === 'string'` instead of `'string' === $something`
			'yoda_style' => [
				'always_move_variable' => true,
				'equal'                => false,
				'identical'            => false,
			],

			CommentSurroundedBySpacesFixer::name()           => true,
			ConstructorEmptyBracesFixer::name()              => true,
			DataProviderReturnTypeFixer::name()              => true,
			DeclareAfterOpeningTagFixer::name()              => true,
			EmptyFunctionBodyFixer::name()                   => true,
			MultilineCommentOpeningClosingAloneFixer::name() => true,
			MultilinePromotedPropertiesFixer::name()         => [
				'minimum_number_of_parameters' => 2,
			],
			NoTrailingCommaInSinglelineFixer::name() => true,
			NoUselessCommentFixer::name()            => true,
			NoUselessParenthesisFixer::name()        => true,
			NoUselessStrlenFixer::name()             => true,
			PhpUnitAssertArgumentsOrderFixer::name() => true,
			PhpUnitDedicatedAssertFixer::name()      => true,
			PhpUnitNoUselessReturnFixer::name()      => true,
			PhpdocParamTypeFixer::name()             => true,
			PhpdocSelfAccessorFixer::name()          => true,
			PhpdocTypesCommaSpacesFixer::name()      => true,
			PhpdocTypesTrimFixer::name()             => true,
			PhpdocSelfAccessorFixer::name()          => true,
		];
	}
}
