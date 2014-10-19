# saxulum-http-client-adapter-guzzle

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-http-client-adapter-guzzle.png?branch=master)](https://travis-ci.org/saxulum/saxulum-http-client-adapter-guzzle)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-http-client-adapter-guzzle/downloads.png)](https://packagist.org/packages/saxulum/saxulum-http-client-adapter-guzzle)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-http-client-adapter-guzzle/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-http-client-adapter-guzzle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/saxulum/saxulum-http-client-adapter-guzzle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/saxulum/saxulum-http-client-adapter-guzzle/?branch=master)

## Features

 * Provides a http client interface adapter for [guzzle][1]

## Requirements

 * PHP 5.3+

## Installation

Through [Composer](http://getcomposer.org) as [saxulum/saxulum-http-client-adapter-guzzle][2].

## Usage

``` {.php}
use Saxulum\HttpClient\Guzzle\HttpClient;
use Saxulum\HttpClient\Request;

$httpClient = new HttpClient();
$response = $httpClient->request(new Request(
    '1.1',
    Request::METHOD_GET,
    'http://en.wikipedia.org',
    array(
        'Connection' => 'close',
    )
));
```

You can inject your own guzzle client instance while creating the http client instance.

``` {.php}
use GuzzleHttp\Client;
use Saxulum\HttpClient\Guzzle\HttpClient;

$client = new Client;
$httpClient = new HttpClient($client);
```

[1]: https://packagist.org/packages/guzzlehttp/guzzle
[2]: https://packagist.org/packages/saxulum/saxulum-http-client-adapter-guzzle