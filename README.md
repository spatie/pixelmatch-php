# Compare images using PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/pixelmatch-php.svg?style=flat-square)](https://packagist.org/packages/spatie/pixelmatch-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/spatie/pixelmatch-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/pixelmatch-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/pixelmatch-php.svg?style=flat-square)](https://packagist.org/packages/spatie/pixelmatch-php)

This package can compare two images and return the percentage of matching pixels. It's a PHP wrapper around the [Pixelmatch](https://github.com/mapbox/pixelmatch) JavaScript library.

Here's a quick example on how to use the package.

```php
use Spatie\Pixelmatch\Pixelmatch;

$pixelmatch = Pixelmatch::new("path/to/file1.png", "path/to/file2.png");

$pixelmatch->matchedPixelPercentage(); // returns a float, for example 97.5
$pixelmatch->mismatchedPixelPercentage(); // returns a float, for example 2.5
```

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/pixelmatch-php.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/pixelmatch-php)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/pixelmatch-php
```

In your project, or on your server, you must have the JavaScript package [`Pixelmatch`](https://github.com/mapbox/Pixelmatch) installed.

```bash
npm install pixelmatch
```

... or Yarn.

```bash
yarn add pixelmatch
```

Make sure you have installed Node 16 or higher.

## Usage

Here's how you can get the percentage of matching pixels between two images.

```php
use Spatie\Pixelmatch\Pixelmatch;

$pixelmatch = Pixelmatch::new("path/to/file1.png", "path/to/file2.png");

$pixelmatch->matchedPixelPercentage(); // returns a float, for example 97.5
$pixelmatch->mismatchedPixelPercentage(); // returns a float, for example 2.5
```

To get the amount of matched and mismatched pixels, you can use these methods.

```php
use Spatie\Pixelmatch\Pixelmatch;

$pixelmatch = Pixelmatch::new("path/to/file1.png", "path/to/file2.png");

$pixelmatch->matchedPixels(); // returns an int
$pixelmatch->mismatchedPixels(); // returns an int
```

### Setting a threshold

To set the threshold for the amount of mismatching pixels, you can use the `threshold` method. Higher values will make the comparison more sensitive. The threshold should be between 0 and 1. 

If you don't set a threshold, we'll use the default value of `0.1`.

```php
$pixelmatch->threshold(0.05);
```

### Ignoring anti-aliasing

To ignore anti-aliased pixels, you can use the `includeAa` method.

```php
$pixelmatch->includeAa();
```

## Limitations

The package can only compare png images.

Images with different dimensions cannot be compared. If you try to do this, a `Spatie\Pixelmatch\Exceptions\CouldNotCompare` exception will be thrown.

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
- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
