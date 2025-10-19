<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude([
        'Http', // Exclude controllers as they are thin
        'var',
        'vendor',
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        // Basic rules
        '@PSR12' => true,
        '@Symfony' => true,
        '@PhpCsFixer' => true,
        
        // Array rules
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => true,
        
        // Class rules
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
                'property' => 'one',
                'trait_import' => 'none',
            ],
        ],
        'no_unused_imports' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],
        
        // Function rules
        'function_declaration' => [
            'closure_function_spacing' => 'one',
        ],
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],
        
        // String rules
        'single_quote' => true,
        'concat_space' => ['spacing' => 'one'],
        'escape_implicit_backslashes' => true,
        
        // Control structure rules
        'control_structure_braces' => true,
        'control_structure_continuation_position' => true,
        'elseif' => true,
        'no_alternative_syntax' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'switch_continue_to_break' => true,
        
        // Operator rules
        'binary_operator_spaces' => [
            'default' => 'single_space',
            'operators' => [
                '=>' => 'single_space',
                '=' => 'single_space',
                '==' => 'single_space',
                '===' => 'single_space',
                '!=' => 'single_space',
                '!==' => 'single_space',
                '<' => 'single_space',
                '>' => 'single_space',
                '<=' => 'single_space',
                '>=' => 'single_space',
                '&&' => 'single_space',
                '||' => 'single_space',
                '+' => 'single_space',
                '-' => 'single_space',
                '*' => 'single_space',
                '/' => 'single_space',
                '%' => 'single_space',
            ],
        ],
        'unary_operator_spaces' => true,
        'not_operator_with_successor_space' => true,
        'object_operator_without_whitespace' => true,
        
        // Cast rules
        'cast_spaces' => true,
        'no_short_bool_cast' => true,
        
        // Comment rules
        'single_line_comment_style' => [
            'comment_types' => ['hash'],
        ],
        'multiline_comment_opening_closing' => true,
        
        // General rules
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => [
            'statements' => ['return', 'throw', 'try'],
        ],
        'braces' => [
            'allow_single_line_closure' => true,
            'position_after_anonymous_constructs' => 'same',
            'position_after_control_structures' => 'same',
            'position_after_functions_and_oop_constructs' => 'next',
        ],
        'clean_namespace' => true,
        'declare_strict_types' => true,
        'encoding' => true,
        'full_opening_tag' => true,
        'indentation_type' => true,
        'line_ending' => true,
        'linebreak_after_opening_tag' => true,
        'constant_case' => ['case' => 'lower'],
        'lowercase_keywords' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'method_chaining_indentation' => true,
        'native_function_casing' => true,
        'no_closing_tag' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'switch',
                'throw',
                'use',
            ],
        ],
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'echo_tag_syntax' => ['format' => 'long'],
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_around_offset' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_curly_braces' => true,
        'no_unset_cast' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'object_operator_without_whitespace' => true,
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_public',
                'property_protected',
                'property_private',
                'construct',
                'destruct',
                'magic',
                'phpunit',
                'method_public',
                'method_protected',
                'method_private',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'phpdoc_indent' => true,
        'phpdoc_inline_tag_normalizer' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_without_name' => true,
        'return_type_declaration' => true,
        'self_accessor' => true,
        'short_scalar_cast' => true,
        'single_blank_line_at_eof' => true,
        'single_class_element_per_statement' => true,
        'single_line_after_imports' => true,
        'single_line_comment_style' => [
            'comment_types' => ['hash'],
        ],
        'single_trait_insert_per_statement' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'visibility_required' => true,
        'whitespace_after_comma_in_array' => true,
    ])
    ->setFinder($finder);

return $config;
