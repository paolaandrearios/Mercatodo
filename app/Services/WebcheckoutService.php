<?php

namespace App\Services;

use App\Contracts\WebcheckoutContract;
use App\Request\CreateSessionRequest;
use App\Request\GetInformationRequest;
use GuzzleHttp\Client;

class WebcheckoutService implements WebcheckoutContract
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getInformation(?int $session_id): array
    {
        $getInformation = new GetInformationRequest();
        $data = $getInformation->auth();
        $url = $getInformation::url($session_id);

        return $this->request($data, $url);
    }

    public function createSession(array $data): array
    {
        $createSessionRequest = new CreateSessionRequest($data);

        $data = $createSessionRequest->toArray();
        $url = $createSessionRequest::url(null);

        return $this->request($data, $url);
    }

    private function request(array $data, string $url): array
    {
        $response = $this->client->request('post', $url, [
            'json' => $data,
            'verify' => false,
        ]);

        $content = $response->getBody()->getContents();

        return json_decode($content, true);
    }
}
