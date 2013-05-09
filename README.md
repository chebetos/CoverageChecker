CoverageChecker
===============

PHP Code Coverage Percentage Calculator from clover xml format file.

This library is based on the coverage-checker.php script from [Marco Pivetta](http://ocramius.github.com/) 
(http://ocramius.github.io/blog/automated-code-coverage-check-for-github-pull-requests-with-travis/).

Specifically in this version
https://raw.github.com/RWOverdijk/AssetManager/a779b01afdd181f2f60c18c45974a749ce04934c/coverage-checker.php

The intention of this project it is to provide some new distributions of the 
script and use modern coding standards.

Project Goals:
--------------
* Composer/packagist distribution.
* Downloadable phar distribution.
* Pear distribution.

Project QA:
-----------
* PHPUnit testing with more than 95% coverage.
* Phing building.
* Apply code coverage check to itself.
* Continuous Integration in travis, and a local xinc.
