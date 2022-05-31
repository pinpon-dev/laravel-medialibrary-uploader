# A helper to directly upload files from request to laravel-medialibrary

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pinpon/laravel-medialibrary-uploader.svg?style=flat-square)](https://packagist.org/packages/pinpon/simple-uploader)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/pinpon-dev/laravel-medialibrary-uploader/run-tests?label=tests)](https://github.com/pinpon/simple-uploader/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/pinpon-dev/laravel-medialibrary-uploader/Check%20&%20fix%20styling?label=code%20style)](https://github.com/pinpon/simple-uploader/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/pinpon/laravel-medialibrary-uploader.svg?style=flat-square)](https://packagist.org/packages/pinpon/simple-uploader)

An easy-to-use helper to directly upload files from request to your models' media collections

```php
use Pinpon\Uploader\MediaUploader

MediaUploader::upload(['image'])->to($model);
```

## Installation

You can install the package via composer:

```bash
composer require pinpon/laravel-medialibrary-uploader
```

## Usage

**Warning:** The request file key must match the media collection's name

```php
use Pinpon\Uploader\MediaUploader

$model = Model::first();

// Upload from one key
MediaUploader::upload('image')->to($model);

// Upload from multiple keys
MediaUploader::upload(['image', 'banner'])->to($model);


$model->getMedia('image');
$model->getMedia('banner');
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

- [Nicolas Perraut](https://github.com/Pin-Pon.dev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
