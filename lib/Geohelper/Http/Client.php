<?php

namespace Geohelper\Http;

use Geohelper\Exception\CurlException;
use Geohelper\Response\ApiResponse;

class Client
{
    protected $url;
    protected $defaultParameters;

    public function __construct($url, array $defaultParameters = array())
    {
        if (false === stripos($url, 'http://')) {
            throw new \InvalidArgumentException(
                'API schema requires HTTPS protocol'
            );
        }

        $this->url = $url;
        $this->defaultParameters = $defaultParameters;
    }

    public function makeRequest($path, array $parameters = array()) {

        $parameters = array_merge($this->defaultParameters, $parameters);

        $url = $this->url . $path;

        if (count($parameters)) {
            $url .= '?' . http_build_query($parameters, '', '&');
        }

        $curlHandler = curl_init();
        curl_setopt($curlHandler, CURLOPT_URL, $url);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandler, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curlHandler, CURLOPT_FAILONERROR, false);
        curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlHandler, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandler, CURLOPT_CONNECTTIMEOUT, 30);

        $responseBody = curl_exec($curlHandler);
        $statusCode = curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);
        $errno = curl_errno($curlHandler);
        $error = curl_error($curlHandler);

        curl_close($curlHandler);

        if ($errno) {
            throw new CurlException($error, $errno);
        }

        return new ApiResponse($statusCode, $responseBody);
    }
}
