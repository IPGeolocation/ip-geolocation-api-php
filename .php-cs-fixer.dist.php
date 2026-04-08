<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/lib',
        __DIR__ . '/tests',
    ])
    ->exclude('vendor')
;

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR12' => true,
        'phpdoc_order' => true,
        'array_syntax' => [ 'syntax' => 'short' ],
        'strict_comparison' => true,
        'strict_param' => true,
        'no_trailing_whitespace' => false,
        'no_trailing_whitespace_in_comment' => false,
        'braces' => false,
        'single_blank_line_at_eof' => false,
        'blank_line_after_namespace' => false,
        'no_leading_import_slash' => false,
    ])
    ->setFinder($finder)
;
