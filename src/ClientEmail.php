<?php

declare(strict_types=1);

namespace Mailjet;

use Mailjet\Exception\InvalidArgument;
use Mailjet\Internal\Json;
use Mailjet\Resource\EndpointInterface;

class ClientEmail
{
    private $apiKey;
    private $secretKey;
    private $baseUrl;
    private $httpClient;

    /**
     * @param string $apiKey    used as username for the authentication
     * @param string $secretKey used as password for the authentication
     * @param string $baseUrl   scheme + authority uri parts prefixed before any endpoint
     */
    public function __construct(string $apiKey, string $secretKey, string $baseUrl = 'https://api.mailjet.com')
    {
        if (!ApiKey::isValid($apiKey)) {
            throw InvalidArgument::withMessage('Invalid api key given');
        }
        if (!ApiKey::isValid($secretKey)) {
            throw InvalidArgument::withMessage('Invalid secret key given');
        }

        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
        $this->baseUrl = $baseUrl;
        $this->httpClient = Internal\HttpClient::get();
    }

    public function request(EndpointInterface $endpoint)
    {
        return $this->httpClient->requestAuthBasic(
            $endpoint::method(),
            $this->baseUrl . '/' . $endpoint::path(),
            $this->apiKey,
            $this->secretKey,
            Json::encode($endpoint->payload())
        );
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}
