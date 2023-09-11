# A pixel-level image comparison package for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/Pixelmatch-php.svg?style=flat-square)](https://packagist.org/packages/spatie/Pixelmatch-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/spatie/Pixelmatch-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/Pixelmatch-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/Pixelmatch-php.svg?style=flat-square)](https://packagist.org/packages/spatie/Pixelmatch-php)

Pixelmatch is a small and fast Javascript library for pixel-level image comparison.
This package can execute the same pixel-level image comparison in PHP.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/Pixelmatch-php.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/Pixelmatch-php)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/Pixelmatch-php
```

In your project, or on your server, you must have the JavaScript package [`Pixelmatch`](https://github.com/mapbox/Pixelmatch) installed.

```bash
npm install Pixelmatch
```

... or Yarn.

```bash
yarn add Pixelmatch
```

Make sure you have installed Node 16 or higher.

## Usage

To quickly see the percentage of pixels that are different between two images, you can use the `mismatchingPercentage` method.

### Mismatching results in percentage or amount of pixels

```php
use Spatie\Pixelmatch\Pixelmatch;

$pixelmatch = Pixelmatch::new("path/to/file1.png", "path/to/file2.png");

$pixelmatch->mismatchingPercentage(); // returns 3
$pixelmatch->matchingPercentage(); // returns 97
```

To get the amount of mismatched pixels, you can use the `mismatchingPixels` method.

```php
use Spatie\Pixelmatch\Pixelmatch;


$pixelmatch = Pixelmatch::new("path/to/file1.png", "path/to/file2.png");

$pixelmatch->mismatchingPixels(); // returns an int
```

### Options

#### Ignoring anti-aliasing

To ignore anti-aliased pixels, you can use the `includeAa` method.

```php
$pixelmatch->includeAa();
```

#### Setting a threshold

To set the threshold for the amount of mismatching pixels, you can use the `threshold` method.
The threshold should be between 0 and 1.

```php
$pixelmatch->threshold(0.05);
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
