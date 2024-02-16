<?php

namespace App\Services\Omnisend;

use App\Services\Newsletter;
use GuzzleHttp\Client;

class OmnisendNewsletter implements Newsletter
{
    public function __construct(protected Client $client)
    {
    }
    public function subscribe(string $email, string $type = null)
    {
        $type ??= config('services.omnisend.endpoint') . config('services.omnisend.type.contacts');

        return $this->client->request('POST', $type, [
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

    public function unsubscribe(string $email, string $type = null)
    {
        $type ??= config('services.omnisend.endpoint') . config('services.omnisend.type.contacts');

        return $this->client->request('POST', $type, [
            'body' => json_encode([
                "identifiers" => [
                    [
                        "type" => "email",
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


    public function register(): void
    {
        app()->bind(Newsletter::class, function () {

            $client = new Client();
            return new OmnisendNewsletter($client);
        });
    }
}
