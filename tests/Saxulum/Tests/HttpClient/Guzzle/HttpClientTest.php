<?php

namespace Saxulum\Tests\HttpClient\Guzzle;

use Saxulum\HttpClient\Guzzle\HttpClient;
use Saxulum\HttpClient\Request;

class HttpClientTest extends \PHPUnit_Framework_TestCase
{
    public function testHttpClient()
    {
        $httpClient = new HttpClient();

        $response = $httpClient->request(new Request(
            '1.1',
            Request::METHOD_GET,
            'http://en.wikipedia.org',
            array(
                'Connection' => 'close',
            )
        ));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getStatusMessage());
        $this->assertEquals('text/html; charset=UTF-8', $response->getHeader('Content-Type'));
    }
}
