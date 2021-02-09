<?php

namespace Adenijiayocharles\Identibyte;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Identibyte
{
    /**
     * Checks if an email address is from a disposal email provider
     * @param   [string]$email  [Email address to be checked]
     * @return  [array]        [The whole response from the identibyte sevice]
     */
    public static function check($email = null)
    {
        if (!is_string($email)) {
            throw new \InvalidArgumentException('Invalid argument type. Argument must be of type string');
        }

        if (is_null($email)) {
            throw new \InvalidArgumentException('Method requires an email or domain name to continue');
        }
        return self::makeRequest($email);
    }

    /**
     * Checks if an email address is disposable
     * @param   [string]$email  [Email address to be checked]
     * @return  [string]          [false is email is not disposable and true if it is a disposable email]
     */
    public static function isDisposableEmail($email)
    {
        $response = self::makeRequest($email);
        return $response['email']['disposable'] ? 'true' : 'false';
    }

    /**
     * Makes request to Identibyte
     * @param   [string]  $data  [email to be checked]
     * @return  Identibyte Response
     */
    private static function makeRequest($data)
    {
        $key = config('identibyte.key');

        if (is_null($key)) {
            throw new \Exception('Please publish the config and add your Identibyte api key to your .env');
        }

        try {
            $client = new Client([
                'base_uri' => 'https://identibyte.com'
            ]);

            $url = '/check/' . $data . '?api_token=' . $key;
            $response = $client->request('get', $url);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return json_decode($response->getBody()->getContents(), true);
            } else {
                return $statusCode;
            }

        } catch (GuzzleException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
