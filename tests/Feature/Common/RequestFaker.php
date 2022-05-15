<?php

namespace Tests\Feature\Common;

trait RequestFaker
{
    public function getApiHeaders($token): array
    {
        return
        [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
            'locale' => 'en',
        ];
    }
}
