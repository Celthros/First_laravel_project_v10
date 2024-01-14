<?php

namespace App\Services\Omnisend;

use GuzzleHttp\Client;

class Newsletter
{
    public function subscribe(string $email, string $type = null)
    {
        $type ??= config('services.omnisend.endpoint') . config('services.omnisend.type.contacts');

        return $this->client()->request('POST', $type, [
            'body' => json_encode([
                "sendWelcomeEmail" => true,
                "identifiers" => [
                    [
                        "type" => "email",
                        "channels" => [
                            "email" => [
                                "status" => "subscribed"
                            ]
                        ],
                        "id" => $email
                    ]
                ]
            ]),
            'headers' => [
                'X-API-KEY' => config('services.omnisend.key'),
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
    }

    protected function client()
    {
        return new Client();
    }
}
