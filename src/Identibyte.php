<?php

namespace Adenijiayocharles\Identibyte;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Identibyte
{
    public static function check(string $email)
    {
        $client = new Client([
            'base_uri' => 'https://identibyte.com'
        ]);
        $key = config('identibyte.key');
        $url = "/check/" . $email."?api_token=".$key;
        try {
            $response = $client->request('get', $url);
            return response()->json([
                'code' => $response->getStatusCode(),
                "body" => $response->getBody()->getContents()
            ]);
        } catch (GuzzleException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
