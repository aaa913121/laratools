<?php

namespace Nolin\Laratools\Services;

class CurlService extends Service
{
    protected $client;

    public function __construct($url)
    {
        $this->client = curl_init($url);
    }

    /**
     * send
     *
     * @return Array
     */
    public function send()
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
        ];
        curl_setopt_array($this->client, $options);
        $response = curl_exec($this->client);

        return json_decode($response, true);
    }
}
