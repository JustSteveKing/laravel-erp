# Laravel ERP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/juststeveking/laravel-erp.svg?style=flat-square)](https://packagist.org/packages/juststeveking/laravel-transporter)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/JustSteveKing/laravel-erp/run-tests?label=tests)](https://github.com/JustSteveKing/laravel-transporter/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/juststeveking/laravel-erp.svg?style=flat-square)](https://packagist.org/packages/juststeveking/laravel-transporter)

A simple to use opinionated ERP package to work with Laravel

## Installation

You can install the package via composer:

```bash
composer require juststeveking/laravel-erp
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="JustSteveKing\Laravel\ERP\ERPServiceProvider" --tag="erp-config"
```

## Testing

To run the tests in parallel:

```bash
composer run test
```

To run the tests with a coverage report:

```bash
composer run test-coverage
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Steve McDougall](https://github.com/JustSteveKing)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
