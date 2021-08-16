# Laravel OCRmyPDF

[![Latest Version on Packagist](https://img.shields.io/packagist/v/zarulizham/laravel-ocrmypdf.svg?style=flat-square)](https://packagist.org/packages/zarulizham/laravel-ocrmypdf)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/zarulizham/laravel-ocrmypdf/run-tests?label=tests)](https://github.com/zarulizham/laravel-ocrmypdf/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/zarulizham/laravel-ocrmypdf/Check%20&%20fix%20styling?label=code%20style)](https://github.com/zarulizham/laravel-ocrmypdf/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/zarulizham/laravel-ocrmypdf.svg?style=flat-square)](https://packagist.org/packages/zarulizham/laravel-ocrmypdf)


## Pre-requisite

OCRmyPDF: https://ocrmypdf.readthedocs.io/en/latest/
## Installation

You can install the package via composer:

```bash
composer require zarulizham/laravel-ocrmypdf
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="ZarulIzham\OCRmyPDF\OCRmyPDFServiceProvider" --tag="laravel-ocrmypdf-config"
```

This is the contents of the published config file:

```php
return [
    'path' => env('OCRMYPDF_PATH', '/usr/local/bin/ocrmypdf'),
];
```

## Usage

```php
OCRmyPDF::input(storage_path('panic.pdf'))
    ->output(storage_path('converted/panic.pdf'))
    ->redoOcr()
    ->addOption('--redo-ocr')
    ->addOption('--title Panic Document')
    ->addOption('--author Zarul Izham')
    ->begin();
```

## Testing

Put PDF inside ./tests/storage and edit test script.

```bash
composer test
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
