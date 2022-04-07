<?php

namespace Iterable;

use GuzzleHttp\RequestOptions;
use Iterable\Constants\Api;
use Psr\Http\Message\ResponseInterface;

class Client
{

    private \GuzzleHttp\Client $httpClient;

    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => Api::BASE_URL
        ]);
        $this->apiKey = $apiKey;
    }

    public function get(string $endpoint, array $queryParameters = []): ResponseInterface
    {
        return $this->httpClient->get($endpoint, [
            RequestOptions::HEADERS => $this->getHeadersWithApiKey(),
            RequestOptions::QUERY => $queryParameters
        ]);
    }

    public function post(string $endpoint, array $body = []): ResponseInterface
    {
        return $this->httpClient->post($endpoint, [
            RequestOptions::HEADERS => $this->getHeadersWithApiKey(),
            RequestOptions::BODY => $body
        ]);
    }

    public function postJson(string $endpoint, array $json = []): ResponseInterface
    {
        return $this->httpClient->post($endpoint, [
            RequestOptions::HEADERS => $this->getHeadersWithApiKey(),
            RequestOptions::JSON => $json
        ]);
    }

    private function getHeadersWithApiKey(): array
    {
        return [Api::API_KEY_HEADER => $this->apiKey];
    }


}