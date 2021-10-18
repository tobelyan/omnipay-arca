# Omnipay: ARCA

**arca driver for the Omnipay Laravel payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.5+. This package implements ARCA support for Omnipay. With CardBinding Support 

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
    $gateway->setParameter('language',\App::getLocale()); // Language
    $gateway->setParameter('amount',10); // Amount to charge
    $gateway->setParameter('TransactionId',XXXX); // Transaction ID from your system

```

3. Call purchase, it will automatically redirect to ARCA's hosted page

```php

    $purchase = $gateway->purchase()->send();

    $purchase->redirect();

```
4. Here we should get callback url to check status, e.g

```php
public function checkStatus(Request $request) {
    $orderId = $request->orderId;
    //then make a request
    $gateway = Omnipay::create('Arca');
    $gateway->setUserName(env('username'));
    $gateway->setPassword(env('password'));
    $purchase = $gateway->getOrderStatus(['transactionId' => $request->orderId])->send();
    if($purchase->isSuccessful()) {
        //your logic
    }
}
```

Card Binding

Add these methods to your logic

```php
    $gateway->setParameter('clientId', auth()->user()->id);
    $gateway->setParameter('bindingPayment',true);
    $gateway->setParameter('bindingId',$card->bindingId);

    //Send Binding info using these methods
    $gateway->setParameter('mdOrder',$orderId);
    $purchase = $gateway->makeBindingPayment()->send();
    //then send Redirection
    if ($purchase->isRedirect()) {
        $purchase->redirect();
    }
```

Data you will get after payment

```php
$purchaseData = [
    'user_id'=>auth()->user()->id,
    'expiration'=>$purchase->getData()['cardAuthInfo']['expiration'],
    'cardholderName'=>$purchase->getData()['cardAuthInfo']['cardholderName'],
    'approvalCode'=>$purchase->getData()['cardAuthInfo']['approvalCode'],
    'pan'=>$purchase->getData()['cardAuthInfo']['pan'],
    'clientId'=>$purchase->getData()['bindingInfo']['clientId'],
    'bindingId'=>$purchase->getData()['bindingInfo']['bindingId'],
    'secure_hash'=>md5($purchase->getData()['cardAuthInfo']['pan'])
];
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
