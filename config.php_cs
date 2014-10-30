<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
  ->exclude(['views', 'config', 'database/migrations', 'lang', 'start'])
  ->in('app');

return Symfony\CS\Config\Config::create()
  ->fixers(['encoding', 'linefeed', 'indentation', 'tailing_spaces', 'unused_use', 'object_operator', 'phpdoc_params', 'visibility', 'short_tag', 'php_closing_tag', 'return', 'extra_empty_lines', 'lowercase_constants', 'lowercase_keywords', 'include', 'function_declaration', 'controls_spaces', 'spaces_cast', 'elseif', 'eof_ending', 'standardize_not_equal', 'new_with_braces'])
  ->finder($finder);
