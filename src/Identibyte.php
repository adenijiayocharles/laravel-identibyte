<?php

namespace Adenijiayocharles\Identibyte;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Identibyte
{
    public static function check($email = null)
    {
        $key = config('identibyte.key');

        if(is_null($key)){
            if(!is_string($email)) {
                throw new \InvalidArgumentException('Please publish the config and add your Identibyte api key to your .env');
            }

        }

        if(!is_string($email)) {
            throw new \InvalidArgumentException('Invalid argument type. Argument must be of type string');
        }

        if(is_null($email)){
            throw new \InvalidArgumentException('Method requires an email or domain name to continue');
        }

        $client = new Client([
            'base_uri' => 'https://identibyte.com'
        ]);

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
