# Contributing Guide

This page contains guidelines for contributing to **vimrcfu**. Please review these guidelines before submitting any pull requests to the project.

This contributing guide is based on the original [Laravel Contribution Guide](https://github.com/laravel/framework/blob/4.1/CONTRIBUTING.md).

## Which Branch?

All changes targeting the current version should be sent to the `dev` branch.

## Pull Requests

Before sending a pull request for a new feature, you should first create an issue with `[Proposal]` in the title. The proposal should describe the new feature, as well as implementation ideas. The proposal will then be reviewed and either approved or denied. Once a proposal is approved, a pull request may be created implementing the new feature.

Pull requests for bugs may be sent without creating any proposal issue. If you believe that you know of a solution for a bug that has been filed on GitHub, please leave a comment detailing your proposed fix.

### Feature Requests

If you have an idea for a new feature you would like to see added to **vimrcfu**, you may create an issue on GitHub with `[Request]` in the title. The feature request will then be reviewed.

## Coding Standards

Adherence to coding standard can be enforced with [PHP Coding Standards Fixer](http://cs.sensiolabs.org).

Install with `composer global require fabpot/php-cs-fixer @stable` and then in the direcotry where you checked out the repository execute: `php-cs-fixer fix --config-file="config.php_cs"`

The following should be adhered to throughout the code base ([Laravel 4.2 Coding Style](http://laravel.com/docs/4.2/contributions#coding-style)):
* Namespace declarations should be on the same line as `<?php`.
* Class opening `{` should be on the same line as the class name.
* Function and control structure opening `{` should be on a separate line.

### Docblocks

The use of docblocks is required. New code which isn't documented with docblocks for functions will be refused.

When writing `@param` or `@return` statements it's encouraged to use the full namespace instead of the reference. This is to improve the readability to know immediatly which type of object you're dealing with.

## Testing

The current test suite is still being worked on but it is encouraged to write tests for new code and/or features.
