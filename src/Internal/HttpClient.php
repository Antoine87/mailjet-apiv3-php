<?php

declare(strict_types=1);

namespace Mailjet\Internal;

use Symfony\Component\HttpClient\HttpClient as SymfonyHttpClient;

/**
 * @internal
 */
final class HttpClient
{
    private static $instance;
    private $client;

    public function request(string $method, string $url, string $jsonPayload)
    {
        return $this->client->request($method, $url, [
            'body' => $jsonPayload
        ]);
    }

    public function requestAuthBasic(
        string $method,
        string $url,
        string $username,
        string $password,
        string $jsonPayload
    ) {
        return $this->client->request($method, $url, [
            'auth_basic' => [$username, $password],
            'body' => $jsonPayload
        ]);
    }

    public static function get(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct()
    {
        $this->client = SymfonyHttpClient::create([
            'headers' => [
                'User-Agent' => 'Mailjet PHP public api client',
                'Content-Type' => 'application/json'
            ]
        ]);
    }
}
