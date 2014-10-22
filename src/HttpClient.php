<?php

namespace Saxulum\HttpClient\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Request as GuzzleRequest;
use GuzzleHttp\Message\Response as GuzzleResponse;
use Saxulum\HttpClient\HeaderConverter;
use Saxulum\HttpClient\HttpClientInterface;
use Saxulum\HttpClient\Request;
use Saxulum\HttpClient\Response;

class HttpClient implements HttpClientInterface
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
        $guzzleRequest = $this->prepareRequest($request);

        /** @var GuzzleResponse $guzzleResponse */
        $guzzleResponse = $this->client->send($guzzleRequest);

        return new Response(
            $guzzleResponse->getProtocolVersion(),
            (int) $guzzleResponse->getStatusCode(),
            $guzzleResponse->getReasonPhrase(),
            HeaderConverter::convertComplexAssociativeToFlatAssociative($guzzleResponse->getHeaders()),
            (string) $guzzleResponse->getBody()
        );
    }

    /**
     * @param  Request       $request
     * @return GuzzleRequest
     */
    protected function prepareRequest(Request $request)
    {
        $guzzleRequest = $this->client->createRequest(
            $request->getMethod(),
            (string) $request->getUrl(),
            array(
                'version' => $request->getProtocolVersion(),
            )
        );

        $guzzleRequest->setHeaders($request->getHeaders());
        $guzzleRequest->setBody($request->getContent());

        return $guzzleRequest;
    }
}
