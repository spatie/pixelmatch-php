# A pixel-level image comparison package for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/pixelmatch-php.svg?style=flat-square)](https://packagist.org/packages/spatie/pixelmatch-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/spatie/pixelmatch-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/pixelmatch-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/pixelmatch-php.svg?style=flat-square)](https://packagist.org/packages/spatie/pixelmatch-php)

Pixelmark is a small and fast Javascript library for pixel-level image comparison.
This package can execute the same pixel-level image comparison in PHP.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/pixelmatch-php.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/pixelmatch-php)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/pixelmatch-php
```

In your project, or on your server, you must have the JavaScript package [`mjml`](https://github.com/mjmlio/mjml) installed.

```bash
npm install mjml
```

... or Yarn.

```bash
yarn add mjml
```

Make sure you have installed Node 16 or higher.

## Usage

```php
$pixelMatch = \Spatie\PixelMatch::new("path/to/file1.png", "path/to/file2.png");

$pixelMatch->compare();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Niels Vanpachtenbeke](https://github.com/nielsvanpach)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
