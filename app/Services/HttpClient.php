<?php

namespace App\Services;

use App\Contracts\HttpClient as HttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

class HttpClient implements HttpClientInterface
{
    protected $client;
    protected $last_request_url;

    public function __construct()
    {
        $this->client = new Client();
        $this->last_request_url = null;
    }

    public function get($url, array $args = [])
    {
        $response = $this->client->request('GET', $url, [
            'query' => $args,
            'on_stats' => function (TransferStats $stats) use (&$request_url) {
                $request_url = $stats->getEffectiveUri();
            }
        ]);

        $this->last_request_url = $request_url;

        $headers = $this->transformHeaders($response->getHeaders());

        return response($response->getBody(), 
                        $response->getStatusCode())
                        ->withHeaders($headers);
    }

    protected function transformHeaders($headers)
    {
        $results = [];
        foreach ($headers as $name => $values) {
            $results[$name] = implode(', ', $values);
        }
        return $results;
    }
}