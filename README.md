# Omnipay: ARCA

**arca driver for the Omnipay Laravel payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.5+. This package implements ARCA support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "tobelyan/omnipay-arca": "dev-master"
    }
}
```

And run composer to update your dependencies:

    composer update

Or you can simply run

    composer require tobelyan/omnipay-arca

## Basic Usage

1. Use Omnipay gateway class:

```php
    use Omnipay\Omnipay;
```

2. Initialize ARCA gateway:

```php

    $gateway = Omnipay::create('Arca');
    $gateway->setUserName(env('username'));
    $gateway->setPassword(env('password'));
    $gateway->setLanguage('lang'); // Language
    $gateway->setReturnUrl('url'); // request return URL
    $gateway->setAmount(10); // Amount to charge
    $gateway->setTransactionId(XXXX); // Transaction ID from your system

```

3. Call purchase, it will automatically redirect to ARCA's hosted page

```php

    $purchase = $gateway->purchase()->send();
    $purchase->redirect();

```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

Developed BY [DINEURON](https://dineuron.com)

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/thephpleague/omnipay-idram/issues),
or better yet, fork the library and submit a pull request.