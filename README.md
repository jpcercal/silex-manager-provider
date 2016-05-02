# SilexManagerProvider

[![Build Status](https://img.shields.io/travis/jpcercal/silex-manager-provider/master.svg?style=square)](http://travis-ci.org/jpcercal/silex-manager-provider)
[![Code Climate](https://codeclimate.com/github/jpcercal/silex-manager-provider/badges/gpa.svg)](https://codeclimate.com/github/jpcercal/silex-manager-provider)
[![Coverage Status](https://coveralls.io/repos/github/jpcercal/silex-manager-provider/badge.svg?branch=master)](https://coveralls.io/github/jpcercal/silex-manager-provider?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/cekurte/silex-manager-provider.svg?style=square)](https://packagist.org/packages/cekurte/silex-manager-provider)
[![License](https://img.shields.io/packagist/l/cekurte/silex-manager-provider.svg?style=square)](https://packagist.org/packages/cekurte/silex-manager-provider)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b00b1e95-36e7-4ac7-b576-6617e89e7d9f/mini.png)](https://insight.sensiolabs.com/projects/b00b1e95-36e7-4ac7-b576-6617e89e7d9f)

- A simple silex service provider (covered by php unit tests) that adds a Manager to register other Service Providers to increase the power of your application, **contribute with this project**!

## Installation

The package is available on [Packagist](http://packagist.org/packages/cekurte/silex-manager-provider).
The source files is [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) compatible.
Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compatible.

```shell
composer require cekurte/silex-manager-provider
```

## Documentation

To use this library you need register the [Cekurte\Silex\Manager\Provider\ManagerServiceProvider](https://github.com/jpcercal/silex-manager-provider/blob/v0.0.2/src/Provider/ManagerServiceProvider.php). See also the library Environment [cekurte/environment](http://packagist.org/packages/cekurte/environment).

```php
<?php

use Cekurte\Environment\Environment;
use Cekurte\Silex\Manager\Provider\ManagerServiceProvider;

// ...
$app['cekurte.manager.providers'] = [
    // ...
    'Silex\Provider\SessionServiceProvider' => [
        'register' => true,
    ],
    'Silex\Provider\SwiftmailerServiceProvider' => [
        'register' => true,
        'type'     => 'array',
        'src'      => [
            'swiftmailer.use_spool' => Environment::get('SWIFTMAILER_USE_SPOOL'),
            'swiftmailer.options'   => [
                'host'       => Environment::get('SMTP_HOST'),
                'port'       => Environment::get('SMTP_PORT'),
                'username'   => Environment::get('SMTP_USERNAME'),
                'password'   => Environment::get('SMTP_PASSWORD'),
                'encryption' => Environment::get('SMTP_ENCRYPTION'),
                'auth_mode'  => Environment::get('SMTP_AUTH_MODE'),
            ],
        ],
    ],
    // ...
];

$app->register(new ManagerServiceProvider());

// ...
```

If you liked of this library, give me a *star* **=)**.

Contributing
------------

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Make your changes
4. Run the tests, adding new ones for your own code if necessary (`vendor/bin/phpunit`)
5. Commit your changes (`git commit -am 'Added some feature'`)
6. Push to the branch (`git push origin my-new-feature`)
7. Create new Pull Request
