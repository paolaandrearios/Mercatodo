<?php

namespace App\Request;

use Illuminate\Http\Request;

class CreateSessionRequest extends GetInformationRequest
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = array_merge($data, parent::auth());
    }

    public static function url(?int $session_id): string
    {
        return config('webcheckout.url') . '/api/session';
    }

    public function toArray()
    {
        return array_merge($this->data, [
            'ipAddress' => app(Request::class)->getClientIp(),
            'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ]);
    }
}
