<?php

namespace App\Services\Mailchimp;

use App\Services\Newsletter;
use \MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{

    public function __construct(protected ApiClient $client)
    {
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    public function unsubscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->deleteListMember($list, md5($email));
    }

    //  base on informaiton below create a function that calls mailchimp for AppServiceProvider.php
    public function register(): void
    {
        app()->bind(Newsletter::class, function () {

            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us8'
            ]);
            return new MailchimpNewsletter($client);
        });
    }
}
