<?php

namespace App\Classes;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Client;


class WebService
{
    public static function conexao($metodo, $url, $header, $body = null)
    {
        $client = new Client();
        $res = $client->request($metodo, $url, [
            'headers' => $header,
            \GuzzleHttp\RequestOptions::JSON => $body
        ]);
        return $res;
    }
}
