# Common PHP7 Patterns and Constructs

## Install

```bash

composer install cradlephp/components

```

## Components

 - Curl - cURL wrapper class that helps making cUrl calls easier
 - Data - Manages data structs of all kinds. Models, Collections and Registry objects are covered here
 - Event - Similar to JavaScript Events. Covers basic and wildcard events.
 - Helper - Miscellaneous traits used to add class features
 - Http - Deals with Routers, Request, Response and Middleware
 - i18n - Covers Language translations and timezone conversions
 - Image - Dynamic Image processor
 - Profiler - Assists with troubleshooting code
 - Resolver - IoC to manage dependency injections

See the [Wiki](https://github.com/CradlePHP/components/wiki) for documentation on these components. See [https://cradlephp.github.io/](https://cradlephp.github.io/) for more information about the entire project.

====

<a name="contributing"></a>
# Contributing to Cradle PHP

Thank you for considering to contribute to Cradle PHP.

Please be aware that master branch contains all edge releases of the current version. Please check the version you are working with and find the corresponding branch. For example `v1.1.1` can be in the `1.1` branch.

Bug fixes will be reviewed as soon as possible. Minor features will also be considered, but give me time to review it and get back to you. Major features will **only** be considered on the `master` branch.

1. Fork the Repository.
2. Fire up your local terminal and switch to the version you would like to
contribute to.
3. Make your changes.
4. Always make sure to sign-off (-s) on all commits made (git commit -s -m "Commit message")

## Making pull requests

1. Please ensure to run [phpunit](https://phpunit.de/) and
[phpcs](https://github.com/squizlabs/PHP_CodeSniffer) before making a pull request.
2. Push your code to your remote forked version.
3. Go back to your forked version on GitHub and submit a pull request.
4. All pull requests will be passed to [Travis CI](https://travis-ci.org/CradlePHP/components) to be tested. Also note that [Coveralls](https://coveralls.io/github/CradlePHP/components) is also used to analyze the coverage of your contribution.
