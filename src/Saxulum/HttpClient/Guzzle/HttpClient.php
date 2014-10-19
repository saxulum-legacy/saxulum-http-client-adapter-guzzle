<?php

namespace Saxulum\HttpClient\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Request as GuzzleRequest;
use GuzzleHttp\Message\Response as GuzzleResponse;
use Saxulum\HttpClient\HeaderConverter;
use Saxulum\HttpClient\HttpInterface;
use Saxulum\HttpClient\Request;
use Saxulum\HttpClient\Response;

class HttpClient implements HttpInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client = null)
    {
        $this->client = null !== $client ? $client : new Client();
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function request(Request $request)
    {
        $guzzleRequest = new GuzzleRequest(
            $request->getMethod(),
            (string) $request->getUrl(),
            HeaderConverter::convertHeaders($request->getHeaders()),
            $request->getContent(),
            array(
                'protocol_version' => $request->getProtocolVersion(),
            )
        );

        /** @var GuzzleResponse $guzzleResponse */
        $guzzleResponse = $this->client->send($guzzleRequest);

        return new Response(
            $guzzleResponse->getProtocolVersion(),
            (int) $guzzleResponse->getStatusCode(),
            $guzzleResponse->getReasonPhrase(),
            $guzzleResponse->getHeaders(),
            (string) $guzzleResponse->getBody()
        );
    }
}
