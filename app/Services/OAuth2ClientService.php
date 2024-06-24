<?php

namespace App\Services;

use App\Models\SettingApi;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class OAuth2ClientService
{
    protected $httpClient;
    protected $apiUrl;


    public function __construct()
    {
        $this->httpClient = new Client([
            'timeout'         => 8.0,  // batas waktu maksimal untuk seluruh permintaan (dalam detik)
            'connect_timeout' => 3.0   // batas waktu untuk mencoba melakukan koneksi ke server (dalam detik)
        ]);
        $this->apiUrl = env('RME_URL');
    }

    // public function getToken()
    // {
    //     $client = new Client();

    //     try {
    //         $response = $client->post('https://api-satusehat.kemkes.go.id/oauth2/v1/accesstoken', [
    //             'headers' => [
    //                 'Content-Type' => 'application/x-www-form-urlencoded',
    //             ],
    //             'form_params' => [
    //                 'grant_type'    => 'client_credentials',
    //                 'client_id'     => '37ISDRZj9EBUf9WPujky7HY2S6gKADpnLKqzuDdf63Vrnphc',
    //                 'client_secret' => 'QuqhjY8aK6COUnItyAl5EJKdyOTiE5pADg44GCtxtxvrefmdOU5wnd6S2WSYhzt3',
    //             ],
    //         ]);

    //         $data = json_decode($response->getBody(), true);

    //         return response()->json($data);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function getToken()
    {
        try {
            // Mengirimkan permintaan POST dengan data JSON
            $req = $this->httpClient->post($this->apiUrl, [
                'json' => [
                    'const_users' => '2632703b-ab24-4aeb-98a6-8e3211d6fbc1',
                    'id'          => '100122945',
                ]
            ]);
            $statusCode = $req->getStatusCode();
            $response   = $req->getBody()->getContents();
            return [$statusCode,$response];
        } catch (RequestException $e) {
            // Log error untuk debugging
            Log::error('OAuth2 Token Request Failed', [
                'error' => $e->getMessage(),
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null
            ]);
            return null;
        }
    }

    public function requestSatuSehat($token, $resources, $id) {
        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];

        $url = "https://api-satusehat.kemkes.go.id/fhir-r4/v1/$resources/$id";
        $request = new Request('GET', $url, $headers);

        try {
            $res = $this->httpClient->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $response = json_decode($res->getBody()->getContents());

            return [$statusCode, $response];

        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $res = json_decode($e->getResponse()->getBody()->getContents());

            return [$statusCode, $res];

        }
    }

    public function requestKFA($token, $resources) {
        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];

        $url = "https://api-satusehat.kemkes.go.id/$resources";
        $request = new Request('GET', $url, $headers);

        try {
            $res = $this->httpClient->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $response = json_decode($res->getBody()->getContents());

            return [$statusCode, $response];

        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $res = json_decode($e->getResponse()->getBody()->getContents());

            return [$statusCode, $res];

        }
    }

    public function storeSatuSehat($token, $resources, $payload) {
        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];

        $body = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $url = "https://api-satusehat.kemkes.go.id/fhir-r4/v1/$resources";

        $request = new Request('POST', $url, $headers, $body);

        try {
            $res = $this->httpClient->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $response = json_decode($res->getBody()->getContents());

            return [$statusCode, $response];

        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $res = json_decode($e->getResponse()->getBody()->getContents());

            return [$statusCode, $res];

        }
    }
}
