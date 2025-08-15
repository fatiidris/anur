<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class PaystackServices
{
    protected $client;
    protected $secretKey;

    public function __construct()
    {
        
        $this->client = new Client([
     'base_uri' => 'https://api.paystack.co',
     'headers' => [
        'Authorization' => 'Bearer ' . config('services.paystack.secret_key'),
        'Content-Type' => 'application/json',
    ],
     'verify' => false
    ]); 
        $this->secretKey = config('services.paystack.secret_key'); // set in config/services.php
    }

    /**
     * Initialize Paystack payment
     */
    public function initializeTransaction(array $data)
    {
        $response = $this->client->post('/transaction/initialize', [
                'json' => $data
                // 'amount' => $data['amount'], // amount in kobo
                // 'callback_url' => $data['callback_url'],
            ]);

        // if ($response->successful()) {
        //     return $response->json()['data']['authorization_url'];
        // }

        // throw new \Exception('Paystack Initialization Failed: ' . $response->body());
        return json_decode($response->getBody(), true);
    }

    /**
     * Verify Paystack payment
     */
    public function verifyTransaction($reference)
    {
        $response = $this->client->get("/transaction/verify/{$reference}");

    //     if ($response->successful()) {
    //         return $response->json();
    //     }

    //     throw new \Exception('Payment Verification Failed: ' . $response->body());
    // 
         return json_decode($response->getBody(), true);
    }
}
