<?php

namespace App\services;
use Illuminate\Support\Facades\Http;


class Paymob {
    private $API_KEY;
    private $AUTH_TOKEN;
    private $ORDER_ID;
    private $INTEGRATION_ID;
    private $EXPIRATION;
    private $MERCHANT_ID;
    public $PAYMENT_TOKEN; // MAIN PAYMENT TOKEN

    public function __construct($api_key, $integration_id, $expiration)
    {
        $this->API_KEY = $api_key;
        $this->INTEGRATION_ID = $integration_id;
        $this->EXPIRATION = $expiration;
    }

    public function get_auth_token()
    {
        $url = "https://accept.paymob.com/api/auth/tokens";
        $data = [
            "api_key" => $this->API_KEY
        ];
        if(!isset($this->API_KEY)){return;}
        $response = HTTP::post($url, $data); 
        if($response->successful()){
            $this->AUTH_TOKEN = $response->json()["token"];
            $this->MERCHANT_ID = $response->json()["profile"]["id"];
            return $response->json()["token"];
        }
        else{
            return "ERROR DURING AUTH";
        }
    }

    public function order($payment_methods, $amount_cents, $currency, $items){
        $url = "https://accept.paymob.com/api/ecommerce/orders";
        if(!isset($this->MERCHANT_ID)){return "AUTH FIRST";}
        $data = [
                "merchant_id"=> $this->MERCHANT_ID,
                "amount_cents"=> $amount_cents, 
                "currency"=> $currency,
                "payment_methods"=> $payment_methods, //array
                "items"=> $items //array
            ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. $this->AUTH_TOKEN,
            'Accept' => 'application/json',
        ])->post($url, $data);
        
        if ($response->successful()) {
            $this->ORDER_ID = $response->json()['id'];
            return $response->json()['id'];
        } else {
            return $response->body();
        }
    }

    public function get_payment_token($billing_data, $amount_cents , $currency){
        $url = "https://accept.paymob.com/api/acceptance/payment_keys";
        $data = 
        [
            "auth_token"=>  $this->AUTH_TOKEN,
            "amount_cents"=> (string) $amount_cents,
            "expiration"=> (int) $this->EXPIRATION,
            "order_id"=> $this->ORDER_ID,
            "integration_id"=>  $this->INTEGRATION_ID,
            "currency"=> $currency,
            "billing_data"=> $billing_data,
        ];
        if(!isset($this->AUTH_TOKEN, $amount_cents, $this->EXPIRATION,  $this->ORDER_ID, $this->INTEGRATION_ID, $currency, $billing_data)){return "AUTH FIRST";}
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. $this->AUTH_TOKEN,
            'Accept' => 'application/json',
        ])->post($url, $data);
        
        if ($response->successful()) {
            $this->PAYMENT_TOKEN = $response->json()['token']; // payment token
            return $response->json()['token'];
        } else {
            return $response->body();
        }

    }

    public function check(){
        if(!isset($this->ORDER_ID)){return;}
        // check
        $url = "https://accept.paymob.com/api/ecommerce/orders/" . $this->ORDER_ID;

        $response = HTTP::withToken($this->AUTH_TOKEN)->get($url);

        if($response->successful()){
            return $response->json()["paid_amount_cents"] > 0 ;
        }
        else{
            return $response->body();
        }

    }
}