<?php

namespace App\Http;

class AdyenClient
{
    public $service;

    function __construct() {
        $client = new \Adyen\Client();
        $client->setXApiKey(env('ADYEN_API_KEY'));
        $client->setEnvironment(\Adyen\Environment::LIVE,"f880fb1f8a16d0b6-1boxoffice");

        $this->service = new \Adyen\Service\Checkout($client);
    }
}
