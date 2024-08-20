<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaService
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $shortcode;
    protected $passkey;
    protected $callbackUrl;

    public function __construct()
    {
        $this->consumerKey = config('services.mpesa.consumer_key');
        $this->consumerSecret = config('services.mpesa.consumer_secret');
        $this->shortcode = config('services.mpesa.shortcode');
        $this->passkey = config('services.mpesa.passkey');
        $this->callbackUrl = config('services.mpesa.callback_url');
    }

    // private function getAccessToken()
    // {
    //     $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
    //         ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

    //     if ($response->successful()) {
    //         return $response->json()['access_token'];
    //     } else {
    //         throw new \Exception('Unable to generate access token');
    //     }
    // }

    // public function initiatePayment($amount, $phoneNumber, $reference)
    // {
    //     $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    //     $timestamp = now()->format('YmdHis');
    //     $password = base64_encode($this->shortcode.$this->passkey.$timestamp);

    //     $response = Http::post($url, [
    //         'BusinessShortCode' => '174379',
    //         'Password' => 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTYwMjE2MTY1NjI3',
    //         'Timestamp' => '20160216165627',
    //         'TransactionType' => 'CustomerPayBillOnline',
    //         'Amount' => 1,
    //         'PartyA' => '254708374149',
    //         'PartyB' => '174379',
    //         'PhoneNumber' => '254708374149',
    //         'CallBackURL' => 'http://localhost/mpesa/callback',
    //         'AccountReference' => 'Test',
    //         'TransactionDesc' => 'Payment for Job Application',
    //     ]);

    //     dd($response);

    //     return $response->json();
    // }

    public function getAccessToken()
    {
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumerKey . ':' . $consumerSecret);

        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response);
        return $result->access_token;
    }

    public function generatePassword($shortcode, $passkey, $timestamp)
    {
        $password = base64_encode($shortcode . $passkey . $timestamp);
        return $password;
    }



    public function makeHttp($url, $body)
    {
        $accessToken = $this->getAccessToken();
        $url = 'https://sandbox.safaricom.co.ke/mpesa/' . $url;
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => array('Content-Type:application/json','Authorization:Bearer '. $accessToken),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($body)
            )
        );
        $curl_response = curl_exec($curl);
        curl_close($curl);
        return $curl_response;
    }


    public function initiatePayment($amount, $phoneNumber, $reference)
    {
        $shortcode = env('MPESA_SHORTCODE');
        $passkey = env('MPESA_PASSKEY');
        $timestamp = date('YmdHis');
        $password = $this->generatePassword($shortcode, $passkey, $timestamp);

        $curl_post_data = array(
            'BusinessShortCode' => $shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => '254708374149',
            'PartyB' => $shortcode,
            'PhoneNumber' => '254708374149',
            'CallBackURL' => route('mpesaCallback'),
            'AccountReference' => $reference,
            'TransactionDesc' => 'Payment'
        );

        $url = '/stkpush/v1/processrequest';
        $response = $this->makeHttp($url, $curl_post_data);
        return json_decode($response);
    }



    public function generateSecurityCredential($initiatorPassword)
    {
        $publicKey = url('public/assets/mpesa_certificate/mpesa_cert.pem');
        openssl_public_encrypt($initiatorPassword, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);
        return base64_encode($encrypted);
    }

    public function initiateB2C($amount, $phoneNumber, $commandID, $remarks, $occasion)
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
        $initiatorName = env('MPESA_INITIATOR_NAME');
        $initiatorPassword = env('MPESA_INITIATOR_PASSWORD');
        $shortcode = env('MPESA_SHORTCODE');
        $securityCredential = $this->generateSecurityCredential($initiatorPassword);

        $curl_post_data = array(
            'InitiatorName' => $initiatorName,
            'SecurityCredential' => $securityCredential,
            'CommandID' => $commandID,
            'Amount' => $amount,
            'PartyA' => $shortcode,
            'PartyB' => 254708374149,
            'Remarks' => $remarks,
            'QueueTimeOutURL' => route('mpesaB2CCallback'),
            'ResultURL' => route('mpesaB2CCallback'),
            'Occasion' => $occasion
        );

        $response = $this->makeHttp($url, $curl_post_data);
        return json_decode($response);
    }
}
