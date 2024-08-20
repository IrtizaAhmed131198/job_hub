<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ThirdPartyApiService
{
    protected $baseUrl = 'https://ivs.idenfy.com/api/v2/token';
    protected $username;
    protected $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function generateToken($requestData)
    {
        $response = Http::withBasicAuth($this->username, $this->password)
                        ->post($this->baseUrl, $requestData);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception("Failed to generate token: " . $response->body());
        }
    }
}