# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/richtoms/laravel-jsend.svg?style=flat-square)](https://packagist.org/packages/richtoms/laravel-jsend)
[![Build Status](https://img.shields.io/travis/RichToms/laravel-jsend/master.svg?style=flat-square)](https://travis-ci.org/RichToms/laravel-jsend)
[![Quality Score](https://img.shields.io/scrutinizer/g/richtoms/laravel-jsend.svg?style=flat-square)](https://scrutinizer-ci.com/g/richtoms/laravel-jsend)
[![Total Downloads](https://img.shields.io/packagist/dt/richtoms/laravel-jsend.svg?style=flat-square)](https://packagist.org/packages/richtoms/laravel-jsend)

A package designed to create JSend responses for Laravel. See the [JSend specification](https://github.com/omniti-labs/jsend).

## Installation

You can install the package via composer:

```bash
composer require richtoms/laravel-jsend
```

## Usage

``` php
    // Using the facade
    return JSend::build($data, $statusCode, $headers);

    // Using the response macro
    return response()->jsend($data, $statusCode, $headers);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email richard@toms.dev instead of using the issue tracker.

## Credits

- [Richard Toms](https://github.com/richtoms)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
