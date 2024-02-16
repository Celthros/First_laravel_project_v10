<?php

namespace App\Providers;

use App\Services\Mailchimp\MailchimpNewsletter;
use App\Services\Omnisend\OmnisendNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function () {

            $client = new Client();
            return new OmnisendNewsletter($client);

            /*             $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us8'
            ]);
            return new MailchimpNewsletter($client); */
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        Model::unguard();
    }
}
