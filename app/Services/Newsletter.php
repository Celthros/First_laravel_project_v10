<?php

namespace App\Services;

interface Newsletter
{
    public function subscribe(string $email, string $list = null);

    //public function unsubscribe(string $email, string $list = null);

    //public function register(): void;
}
