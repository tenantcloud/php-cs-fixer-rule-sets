<?php

namespace TenantCloud\PhpCsFixer\RuleSet;

use IteratorAggregate;
use PhpCsFixerCustomFixers\Fixer\CommentedOutFunctionFixer;
use PhpCsFixerCustomFixers\Fixer\CommentSurroundedBySpacesFixer;
use PhpCsFixerCustomFixers\Fixer\ConstructorEmptyBracesFixer;
use PhpCsFixerCustomFixers\Fixer\DeclareAfterOpeningTagFixer;
use PhpCsFixerCustomFixers\Fixer\EmptyFunctionBodyFixer;
use PhpCsFixerCustomFixers\Fixer\IssetToArrayKeyExistsFixer;
use PhpCsFixerCustomFixers\Fixer\MultilineCommentOpeningClosingAloneFixer;
use PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer;
use PhpCsFixerCustomFixers\Fixer\NoCommentedOutCodeFixer;
use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoDuplicatedArrayKeyFixer;
use PhpCsFixerCustomFixers\Fixer\NoDuplicatedImportsFixer;
use PhpCsFixerCustomFixers\Fixer\NoImportFromGlobalNamespaceFixer;
use PhpCsFixerCustomFixers\Fixer\NoLeadingSlashInGlobalNamespaceFixer;
use PhpCsFixerCustomFixers\Fixer\NoNullableBooleanTypeFixer;
use PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoReferenceInFunctionDefinitionFixer;
use PhpCsFixerCustomFixers\Fixer\NoSuperfluousConcatenationFixer;
use PhpCsFixerCustomFixers\Fixer\NoTrailingCommaInSinglelineFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessDirnameCallFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessDoctrineRepositoryCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessParenthesisFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessStrlenFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocNoIncorrectVarAnnotationFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocNoSuperfluousParamFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocOnlyAllowedAnnotationsFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocParamTypeFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocSelfAccessorFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocSingleLineVarFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocTypesCommaSpacesFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocTypesTrimFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocVarAnnotationToAssertFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitAssertArgumentsOrderFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitDedicatedAssertFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitNoUselessReturnFixer;
use PhpCsFixerCustomFixers\Fixer\PromotedConstructorPropertyFixer;
use PhpCsFixerCustomFixers\Fixer\ReadonlyPromotedPropertiesFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceAfterStatementFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceBeforeStatementFixer;
use PhpCsFixerCustomFixers\Fixer\StringableInterfaceFixer;
use Traversable;

/**
 * Rule set of all TenantCloud's projects.
 *
 * The general idea is:
 *  - the least code possible without hurting readability. No typehint doubling PHPDocs, single line instead of multiline etc
 *  - the least amount of merges (ordered imports etc)
 *  - PSR practices
 *
 * As a rule, all available fixers should be listed here, even when disabled, for two reasons:
 *  1. it makes it explicit that the fixer was intentionally omitted (disabled),
 *     not just missed in a new release of php-cs-fixer
 *  2. it makes it clearer why the fixer was omitted
 *
 * Also sets are intentionally not used because they make it much harder to see what rules are used and with which configuration,
 * and also forced us to lock the php-cs-fixer to a patch version so running `composer update` is safe and doesn't
 * also require fixing the code style in the entire codebase if new rules are added to sets.
 *
 * @implements IteratorAggregate<string, bool|array<string, mixed>>
 */
class TenantCloudSet implements IteratorAggregate
{
	/**
	 * @deprecated Use the iterator with destructuring
	 *
	 * @return array<string, bool|array<string, mixed>>
	 */
	public function rules(): array
	{
		return [...$this];
	}

	/**
	 * @return Traversable<string, bool|array<string, mixed>>
	 */
	public function getIterator(): Traversable
	{
		yield from $this->enabled();

		yield from $this->todo();

		yield from $this->disabled();
	}

	/**
	 * @return iterable<string, bool|array<string, mixed>>
	 */
	private function enabled(): iterable
	{
		yield from [
			'align_multiline_comment' => true,
			'array_indentation'       => true,
			'array_push'              => true,
			'array_syntax'            => true,
			// Use `??=` whenever possible
			'assign_null_coalescing_to_coalesce_equal' => true,
			// #[Foo] instead of #[Foo()]
			'attribute_empty_parentheses' => true,
			'backtick_to_shell_exec'      => true,
			// Single space before/after operators (=, <=, >=, ?? etc), except for `=>`
			'binary_operator_spaces' => [
				'operators' => [
					'=>' => 'align_single_space_minimal',
				],
			],
			'blank_line_after_namespace'   => true,
			'blank_line_after_opening_tag' => true,
			// Blank line before all of those constructs.
			'blank_line_before_statement' => [
				'statements' => [
					'break', 'continue', 'declare', 'default', 'do', 'exit', 'for', 'foreach',
					'goto', 'if', 'return', 'switch', 'throw', 'try', 'while', 'yield', 'yield_from',
				],
			],
			'blank_line_between_import_groups' => true,
			'blank_lines_before_namespace'     => true,
			'braces_position'                  => [
				'allow_single_line_empty_anonymous_classes' => true,
			],
			'cast_spaces' => true,
			// One blank line in between methods and properties
			'class_attributes_separation' => [
				'elements' => [
					'method'   => 'one',
					'property' => 'one',
				],
			],
			'class_definition' => [
				'inline_constructor_arguments' => false,
				'space_before_parenthesis'     => true,
			],
			'class_reference_name_casing'       => true,
			'clean_namespace'                   => true,
			'combine_consecutive_issets'        => true,
			'combine_consecutive_unsets'        => true,
			'combine_nested_dirname'            => true,
			'compact_nullable_type_declaration' => true,
			// Spaces around string concatenation 'asd' . 'asd'
			'concat_space' => [
				'spacing' => 'one',
			],
			'constant_case'                           => true,
			'control_structure_braces'                => true,
			'control_structure_continuation_position' => true,
			'comment_to_phpdoc'                       => true,
			'declare_equal_normalize'                 => true,
			'declare_parentheses'                     => true,
			'dir_constant'                            => true,
			'echo_tag_syntax'                         => true,
			'elseif'                                  => true,
			'empty_loop_body'                         => [
				'style' => 'braces',
			],
			'empty_loop_condition' => true,
			'encoding'             => true,
			'ereg_to_preg'         => true,
			'error_suppression'    => [
				// Mutes trigger_error() with E_USER_DEPRECATED, but we handle deprecations manually so this is needed.
				'mute_deprecation_error' => false,
			],
			'explicit_indirect_variable' => true,
			'explicit_string_variable'   => true,
			'fopen_flag_order'           => true,
			'fopen_flags'                => [
				'b_mode' => false,
			],
			'full_opening_tag'             => true,
			'fully_qualified_strict_types' => [
				'import_symbols' => true,
			],
			'function_declaration' => true,
			'function_to_constant' => true,
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
			'get_class_to_class_keyword' => true,
			// Import global classes, but neither require nor forbid function/constant imports
			'global_namespace_import' => true,
			'heredoc_closing_marker'  => [
				'reserved_closing_markers' => [
					'CSS', 'DIFF', 'HTML', 'JS', 'JSON', 'LUA', 'MD', 'PHP', 'PYTHON', 'RST', 'TS', 'SQL', 'XML', 'YAML',
				],
			],
			// Forces proper indentation on Heredoc/Nowdoc
			'heredoc_indentation' => true,
			'heredoc_to_nowdoc'   => true,
			'implode_call'        => true,
			'include'             => true,
			// `$i++` instead of `++$i`
			'increment_style' => [
				'style' => 'post',
			],
			'indentation_type'            => true,
			'integer_literal_case'        => true,
			'is_null'                     => true,
			'line_ending'                 => true,
			'linebreak_after_opening_tag' => true,
			// `[$var1, $var2] = something()` instead of `list($var1, $var2) = something()`
			'list_syntax' => [
				'syntax' => 'short',
			],
			'logical_operators'          => true,
			'long_to_shorthand_operator' => true,
			'lowercase_cast'             => true,
			'lowercase_keywords'         => true,
			'lowercase_static_reference' => true,
			'magic_constant_casing'      => true,
			'magic_method_casing'        => true,
			// Replace `str*` functions with `mb_str*`
			'mb_str_functions'      => true,
			'method_argument_space' => [
				'attribute_placement' => 'ignore',
				'on_multiline'        => 'ensure_fully_multiline',
			],
			'method_chaining_indentation'        => true,
			'modernize_strpos'                   => true,
			'modernize_types_casting'            => true,
			'multiline_comment_opening_closing'  => true,
			'native_function_casing'             => true,
			'native_type_declaration_casing'     => true,
			'new_with_parentheses'               => true,
			'no_alias_functions'                 => true,
			'no_alias_language_construct_call'   => true,
			'no_alternative_syntax'              => true,
			'no_binary_string'                   => true,
			'no_blank_lines_after_class_opening' => true,
			'no_blank_lines_after_phpdoc'        => true,
			'no_break_comment'                   => true,
			'no_closing_tag'                     => true,
			'no_empty_comment'                   => true,
			'no_empty_phpdoc'                    => true,
			'no_empty_statement'                 => true,
			'no_extra_blank_lines'               => [
				'tokens' => [
					'attribute',
					'case',
					'continue',
					'curly_brace_block',
					'default',
					'extra',
					'parenthesis_brace_block',
					'square_brace_block',
					'switch',
					'throw',
					'use',
				],
			],
			'no_homoglyph_names'                          => true,
			'no_leading_import_slash'                     => true,
			'no_leading_namespace_whitespace'             => true,
			'no_mixed_echo_print'                         => true,
			'no_multiline_whitespace_around_double_arrow' => true,
			'no_multiple_statements_per_line'             => true,
			'no_null_property_initialization'             => true,
			'no_php4_constructor'                         => true,
			'no_short_bool_cast'                          => true,
			'no_singleline_whitespace_before_semicolons'  => true,
			'no_space_around_double_colon'                => true,
			'no_spaces_after_function_name'               => true,
			'no_spaces_around_offset'                     => true,
			'no_superfluous_elseif'                       => true,
			'no_superfluous_phpdoc_tags'                  => [
				'allow_hidden_params' => true,
				'remove_inheritdoc'   => true,
			],
			'no_trailing_comma_in_singleline'   => true,
			'no_trailing_whitespace'            => true,
			'no_trailing_whitespace_in_comment' => true,
			'no_unneeded_braces'                => [
				'namespaces' => true,
			],
			'no_unneeded_control_parentheses' => [
				'statements' => [
					'break',
					'clone',
					'continue',
					'echo_print',
					'others',
					'return',
					'switch_case',
					'yield',
					'yield_from',
				],
			],
			'no_unneeded_final_method'                         => true,
			'no_unneeded_import_alias'                         => true,
			'no_unreachable_default_argument_value'            => true,
			'no_unset_cast'                                    => true,
			'no_unused_imports'                                => true,
			'no_useless_concat_operator'                       => true,
			'no_useless_else'                                  => true,
			'no_useless_nullsafe_operator'                     => true,
			'no_useless_return'                                => true,
			'no_useless_sprintf'                               => true,
			'no_whitespace_before_comma_in_array'              => true,
			'no_whitespace_in_blank_line'                      => true,
			'non_printable_character'                          => true,
			'normalize_index_brace'                            => true,
			'nullable_type_declaration'                        => true,
			'nullable_type_declaration_for_default_null_value' => true,
			'object_operator_without_whitespace'               => true,
			'octal_notation'                                   => true,
			// Forces `&&` and `||` (or similar) operators to be at the end of the line, when multiline.
			'operator_linebreak' => [
				'only_booleans' => true,
				'position'      => 'end',
			],
			// Reorder constructs in a class/interface/enum
			'ordered_class_elements' => [
				'order' => [
					// `use SomeTrait`
					'use_trait',
					// Enum `case SOMETHING`
					'case',
					// `public const` and `private const`
					'constant_public', 'constant_protected', 'constant_private',
					// `public` and `private` properties, both static and regular, in no specific order.
					'property_public', 'property_protected', 'property_private',
					// `__construct`
					'construct',
					// PHPUnit's `setUp` and `tearDown`
					'phpunit',
					// `public` and `private` methods, both static and regular, in no specific order.
					'method_public', 'method_protected', 'method_private',
					// `__magic` after all regular methods
					'magic',
					// `__destruct`
					'destruct',
				],
			],
			// Sort imports by class, function and then const. Sort by alphabet in each of the groups.
			'ordered_imports' => [
				'imports_order' => [
					'class',
					'function',
					'const',
				],
				'sort_algorithm' => 'alpha',
			],
			'ordered_traits' => true,
			'ordered_types'  => [
				'null_adjustment' => 'always_last',
				'sort_algorithm'  => 'none',
			],
			'php_unit_attributes' => true,
			'php_unit_construct'  => true,
			// Force naming on PHPUnit test data providers to match the test: `testSomething` -> `somethingProvider`
			'php_unit_data_provider_name' => [
				'prefix' => '',
				'suffix' => 'Provider',
			],
			// Force PHPUnit test data providers to have `iterable` return type
			'php_unit_data_provider_return_type' => true,
			// Force PHPUnit test data providers to be static functions
			'php_unit_data_provider_static'          => true,
			'php_unit_dedicate_assert'               => true,
			'php_unit_dedicate_assert_internal_type' => true,
			'php_unit_fqcn_annotation'               => true,
			'php_unit_method_casing'                 => true,
			'php_unit_mock_short_will_return'        => true,
			'php_unit_set_up_tear_down_visibility'   => true,
			'php_unit_test_annotation'               => true,
			// array<Foo> insteadof Foo[]
			'phpdoc_array_type'                   => true,
			'phpdoc_add_missing_param_annotation' => true,
			'phpdoc_align'                        => true,
			'phpdoc_annotation_without_dot'       => true,
			'phpdoc_indent'                       => true,
			'phpdoc_inline_tag_normalizer'        => true,
			// Forces PHPDoc to be single line for constants and properties.
			'phpdoc_line_span' => [
				'const'    => 'single',
				'property' => 'single',
			],
			// list<Foo> insteadof array<Foo>
			'phpdoc_list_type' => true,
			'phpdoc_no_access' => true,
			// Do not replace `@property-read` and `@property-write` with `@property`
			'phpdoc_no_alias_tag' => [
				'replacements' => [
					'type' => 'var',
					'link' => 'see',
				],
			],
			'phpdoc_no_empty_return'       => true,
			'phpdoc_no_package'            => true,
			'phpdoc_no_useless_inheritdoc' => true,
			'phpdoc_order'                 => [
				'order' => [
					'param',
					'return',
					'throws',
				],
			],
			'phpdoc_order_by_value'        => true,
			'phpdoc_param_order'           => true,
			'phpdoc_return_self_reference' => true,
			'phpdoc_scalar'                => true,
			'phpdoc_separation'            => [
				'groups' => [
					[
						'Annotation',
						'NamedArgumentConstructor',
						'Target',
					],
					[
						'author',
						'copyright',
						'license',
					],
					[
						'category',
						'package',
						'subpackage',
					],
					[
						'property',
						'property-read',
						'property-write',
					],
					[
						'deprecated',
						'link',
						'see',
						'since',
					],
				],
			],
			'phpdoc_single_line_var_spacing' => true,
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
			'phpdoc_trim'                                   => true,
			'phpdoc_trim_consecutive_blank_line_separation' => true,
			'phpdoc_types'                                  => true,
			'phpdoc_types_order'                            => [
				'null_adjustment' => 'always_last',
				'sort_algorithm'  => 'none',
			],
			'phpdoc_var_annotation_correct_order' => true,
			'phpdoc_var_without_name'             => true,
			'pow_to_exponentiation'               => true,
			'psr_autoloading'                     => true,
			'random_api_migration'                => true,
			'regular_callable_call'               => true,
			'return_assignment'                   => true,
			'return_to_yield_from'                => true,
			'return_type_declaration'             => true,
			'self_accessor'                       => true,
			'self_static_accessor'                => true,
			'semicolon_after_instruction'         => true,
			'set_type_to_cast'                    => true,
			'short_scalar_cast'                   => true,
			'simple_to_complex_string_variable'   => true,
			// Simplifies `if($cond) { return true; } return false` kind of cases into `return (bool) $cond;`
			'simplified_if_return'               => true,
			'single_blank_line_at_eof'           => true,
			'single_class_element_per_statement' => [
				'elements' => [
					'property',
				],
			],
			'single_import_per_statement' => [
				'group_to_single_imports' => false,
			],
			'single_line_after_imports'   => true,
			'single_line_empty_body'      => true,
			'single_line_comment_spacing' => true,
			'single_line_comment_style'   => [
				'comment_types' => [
					'hash',
				],
			],
			'single_line_throw'                 => true,
			'single_quote'                      => true,
			'single_space_around_construct'     => true,
			'single_trait_insert_per_statement' => true,
			'space_after_semicolon'             => [
				'remove_in_empty_for_expressions' => true,
			],
			'spaces_inside_parentheses'   => true,
			'standardize_increment'       => true,
			'standardize_not_equals'      => true,
			'statement_indentation'       => true,
			'string_implicit_backslashes' => [
				'single_quoted' => 'ignore',
			],
			'string_length_to_empty'         => true,
			'string_line_ending'             => true,
			'switch_case_semicolon_to_colon' => true,
			'switch_case_space'              => true,
			'switch_continue_to_break'       => true,
			'ternary_operator_spaces'        => true,
			'ternary_to_elvis_operator'      => true,
			// Use `??` whenever possible
			'ternary_to_null_coalescing'  => true,
			'trailing_comma_in_multiline' => true,
			'trim_array_spaces'           => true,
			'type_declaration_spaces'     => true,
			'types_spaces'                => true,
			'unary_operator_spaces'       => [
				'only_dec_inc' => false,
			],
			// Converts closures to arrow functions whenever possible
			'use_arrow_functions'             => true,
			'visibility_required'             => true,
			'whitespace_after_comma_in_array' => true,
			// `$something === 'string'` instead of `'string' === $something`
			'yoda_style' => [
				'always_move_variable' => true,
				'equal'                => false,
				'identical'            => false,
			],

			CommentSurroundedBySpacesFixer::name()           => true,
			ConstructorEmptyBracesFixer::name()              => true,
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
			PhpdocNoSuperfluousParamFixer::name()    => true,
			PromotedConstructorPropertyFixer::name() => [
				'promote_only_existing_properties' => true,
			],
			// Occasionally useful when refactoring code and you're adding imports
			NoDuplicatedImportsFixer::name() => true,
		];
	}

	/**
	 * These rules are TO DO - we do intent to enable them, but for now they're disabled
	 *
	 * @return iterable<string, bool|array<string, mixed>>
	 */
	private function todo(): iterable
	{
		yield from [
			// Separate task
			'declare_strict_types' => false,

			// Separate task
			// As much as I'd love to enforce final classes, these are unsupported by Mockery.
			// It may be possible with projects like https://github.com/dg/bypass-finals
			'final_class'                            => false,
			'final_internal_class'                   => false,
			'final_public_method_for_abstract_class' => false,

			// Separate task
			// Need to first go over existing strings and remove extra leading whitespaces
			'multiline_string_to_heredoc' => false,

			// Separate task
			// Does not catch all of the uses. Also a lot of Laravel and our custom assertions use non-static methods.
			'php_unit_test_case_static_method_calls' => false,
		];
	}

	/**
	 * @return iterable<string, bool|array<string, mixed>>
	 */
	private function disabled(): iterable
	{
		yield from [
			// Incredibly risky and simply broken on Shim version of php-cs-fixer
			'class_keyword' => false,
			// Do not remove "unused" use($var) from closures, as some Laravel code uses reflection to access those.
			'lambda_not_used_import' => false,
			// Do not move semicolon to a newline after a multiline construct.
			'multiline_whitespace_before_semicolons' => false,
			// Allow `JSON_THROW_ON_ERROR` instead of `\JSON_THROW_ON_ERROR`
			'native_constant_invocation' => false,
			// Allow `strpos()` instead of `\strpos()`
			'native_function_invocation' => false,
			// Do not remove trailing whitespace from string as it might break something with no profit.
			'no_trailing_whitespace_in_string' => false,
			// Do not mark PHPUnit test cases as @internal
			'php_unit_internal_class' => false,
			// Do not add default #[CoversNothing] for PHPUnit test cases; it's better to force the developer
			// to add the correct coverage information manually, rather than guessing for him.
			'php_unit_test_class_requires_covers' => false,
			// Allow PHPDoc summary to not end with a punctuation symbol.
			'phpdoc_summary' => false,
			// Do not convert protected to private because it's risky. Better done with Rector
			'protected_to_private' => false,
			// Useless for us, we never use PHPUnit mocks anyway
			'php_unit_mock' => false,
			// Irrelevant for current version of PHPUnit
			'php_unit_namespaced' => false,
			// Irrelevant for current version of PHPUnit
			'php_unit_expectation' => false,
			// Irrelevant for current version of PHPUnit
			'php_unit_no_expectation_annotation' => false,
			// There are valid use cases for assertEquals()
			'php_unit_strict' => false,
			// No need for specifying test size, there's a default time limit in PHPUnit now
			'php_unit_size_class' => false,
			// Doctrine annotations are being replaced with attributes, so they're irrelevant
			'doctrine_annotation_array_assignment' => false,
			'doctrine_annotation_braces'           => false,
			'doctrine_annotation_indentation'      => false,
			'doctrine_annotation_spaces'           => false,
			// We don't use header comments. The licensing is usually in another place.
			'header_comment' => false,
			// Group imports make merges harder. Instead we just use sorted imports.
			'group_import' => false,
			// All three better done by Rector
			'phpdoc_to_param_type'    => false,
			'phpdoc_to_property_type' => false,
			'phpdoc_to_return_type'   => false,
			// Already handled by general_phpdoc_tag_rename
			'phpdoc_tag_casing' => false,
			// We've never used those, let's not waste resources on them
			'phpdoc_readonly_class_comment_to_keyword' => false,
			// There are (rare) intentional uses of non-strict comparisons.
			'strict_comparison' => false,
			'strict_param'      => false,
			// We don't like a space before/after logical not operator (`!`)
			'not_operator_with_space'           => false,
			'not_operator_with_successor_space' => false,
			// Don't see much value in that.
			'date_time_create_from_format_call' => false,
			// Better done with tools like PHPStan/Rector. And we use Carbon anyway.
			'date_time_immutable' => false,
			// It works okay for larger numbers, but it's quite annoying to see
			// mysql port `3306` changed to `3_306`, or chunk size `1000` to `1_000`
			'numeric_literal_separator' => false,
			// We don't use unset() anyway, especially on properties. If there's
			// ever an unset() on a property, it's likely intentional.
			'no_unset_on_property' => false,
			// This fixer is broken: it assumes that no specified return type is equal to `void`,
			// which breaks a lot of existing code without typehints
			'simplified_null_return' => false,
			// No profit from this one? Actually, I'd like the opposite
			'yield_from_array_to_yields' => false,
			// Some interfaces are used as behavioral markers, e.g. ShouldQueue in Laravel, and it's
			// generally important to know whether the marker is present or not. So to avoid
			// having these markers lost in the rest of the interfaces, this fixer is disabled.
			'ordered_interfaces' => false,
			// php-cs-fixer adds `: void` to all functions, including closures. This isn't ideal,
			// as most of the time the anonymous function is passed directly as an argument to a
			// function, where the correct anonymous function signature is implicitly known from the
			// PHPDoc of the function being called. Adding types to such anonymous function just
			// clutters the code with useless and already known types.
			'void_return' => false,
			// Laravel does some ->bindTo() and ->call() on Closures, which breaks the static closures
			'static_lambda' => false,
			// Commenting out means the functions stay in the code. It's not perfect,
			// so that's better done with tooling like PHPStan.
			CommentedOutFunctionFixer::name() => false,
			// Incredibly risky as `array_key_exists()` returns `true` for `null`, unlike `isset()`
			IssetToArrayKeyExistsFixer::name() => false,
			// Commented code is fine in some situations
			NoCommentedOutCodeFixer::name() => false,
			// We don't use Doctrine
			NoDoctrineMigrationsGeneratedCommentFixer::name() => false,
			NoUselessDoctrineRepositoryCommentFixer::name()   => false,
			// Let's not waste time/resources on this one, it's pretty useless
			NoUselessDirnameCallFixer::name() => false,
			// Var docs are there to fix the incorrect return types of functions
			// They should not be converted to assert() as they shouldn't exist in the first place
			PhpdocVarAnnotationToAssertFixer::name() => false,
			// Not sure what the value of this is
			StringableInterfaceFixer::name() => false,
			// Already handled by binary_operator_spaces
			SingleSpaceAfterStatementFixer::name()  => false,
			SingleSpaceBeforeStatementFixer::name() => false,
			// This only handles one case of generated comments, and we already have that one disabled.
			NoPhpStormGeneratedCommentFixer::name() => false,
			// Already handled by no_useless_concat_operator
			NoSuperfluousConcatenationFixer::name() => false,
			// It's hard to keep track of all new annotations being added by PHPStan, for example,
			// so maintaining a complete list here would be too tedious. Common cases
			// of outdated or useless annotations are already handled by fixers like phpdoc_no_package
			PhpdocOnlyAllowedAnnotationsFixer::name() => false,
			// Already handled by phpdoc_line_span
			PhpdocSingleLineVarFixer::name() => false,
			// We prefer to just have everything imported, regardless of the namespace
			NoImportFromGlobalNamespaceFixer::name()     => false,
			NoLeadingSlashInGlobalNamespaceFixer::name() => false,
			// No reason to disallow this. ?bool is a valid type with valid use cases
			NoNullableBooleanTypeFixer::name() => false,
			// Very occasionally there are uses for this
			NoReferenceInFunctionDefinitionFixer::name() => false,
			// Best not to do this, as this is usually a developer error and should be reviewed manually.
			NoDuplicatedArrayKeyFixer::name() => false,
			// Can't always be done safely. Best done by other tooling, like PHPStan/Rector
			ReadonlyPromotedPropertiesFixer::name() => false,
			// Isn't reliable. Doesn't work on returns.
			PhpdocNoIncorrectVarAnnotationFixer::name() => false,
		];
	}
}
