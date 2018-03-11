# Common PHP7 Patterns and Constructs

## Install

```bash

composer install cradlephp/components

```

## Components

Curl - [https://github.com/CradlePHP/components/blob/master/docs/curl.md](https://github.com/CradlePHP/components/blob/master/docs/curl.md)

Data - [https://github.com/CradlePHP/components/blob/master/docs/data.md](https://github.com/CradlePHP/components/blob/master/docs/data.md)

Event - [https://github.com/CradlePHP/components/blob/master/docs/event.md](https://github.com/CradlePHP/components/blob/master/docs/event.md)

Helper - [https://github.com/CradlePHP/components/blob/master/docs/helper.md](https://github.com/CradlePHP/components/blob/master/docs/helper.md)

Http - [https://github.com/CradlePHP/components/blob/master/docs/http.md](https://github.com/CradlePHP/components/blob/master/docs/http.md)

i18n - [https://github.com/CradlePHP/components/blob/master/docs/i18n.md](https://github.com/CradlePHP/components/blob/master/docs/i18n.md)

Image - [https://github.com/CradlePHP/components/blob/master/docs/image.md](https://github.com/CradlePHP/components/blob/master/docs/image.md)

Profiler - [https://github.com/CradlePHP/components/blob/master/docs/profiler.md](https://github.com/CradlePHP/components/blob/master/docs/profiler.md)

Resolver - [https://github.com/CradlePHP/components/blob/master/docs/resolver.md](https://github.com/CradlePHP/components/blob/master/docs/resolver.md)

See [https://cradlephp.github.io/](https://cradlephp.github.io/) for more information about the entire project.

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
