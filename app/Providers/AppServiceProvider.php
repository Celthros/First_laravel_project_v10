<?php

namespace App\Providers;

use GuzzleHttp\Client;
use App\Services\Newsletter;
use MailchimpMarketing\ApiClient;
use Illuminate\Foundation\Auth\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Services\Omnisend\OmnisendNewsletter;
use App\Services\Mailchimp\MailchimpNewsletter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function () {

            //$client = new Client();
            //return new OmnisendNewsletter($client);

            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us8'
            ]);
            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->username === 'tyler34';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
