<?php

namespace Geohelper;

use Geohelper\Http\Client;

class ApiClient
{
    const VERSION = 'v1';
    const URL = 'http://geohelper.info/';

    protected $client;

    public function __construct($apiKey)
    {
        $url = sprintf('%sapi/%s', self::URL, self::VERSION);

        $this->client = new Client($url, array('apiKey' => $apiKey));
    }

    public function citiesList(
        array $filter = array(),
        array $locale = array('lang' => 'ru'),
        array $pagination = array('page' => 1, 'limit' => 20),
        array $order = array()
    )
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }

        if (count($locale)) {
            $parameters['locale'] = $locale;
        }

        if (count($pagination)) {
            $parameters['pagination'] = $pagination;
        }

        if (count($order)) {
            $parameters['order'] = $order;
        }

        return $this->client->makeRequest('/cities', $parameters);
    }

    public function countriesList(
        array $filter = array(),
        array $locale = array('lang' => 'ru'),
        array $pagination = array('page' => 1, 'limit' => 20),
        array $order = array()
    )
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }

        if (count($locale)) {
            $parameters['locale'] = $locale;
        }

        if (count($pagination)) {
            $parameters['pagination'] = $pagination;
        }

        if (count($order)) {
            $parameters['order'] = $order;
        }

        return $this->client->makeRequest('/countries', $parameters);
    }

    public function regionsList(
        array $filter = array(),
        array $locale = array('lang' => 'ru'),
        array $pagination = array('page' => 1, 'limit' => 20),
        array $order = array()
    )
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }

        if (count($locale)) {
            $parameters['locale'] = $locale;
        }

        if (count($pagination)) {
            $parameters['pagination'] = $pagination;
        }

        if (count($order)) {
            $parameters['order'] = $order;
        }

        return $this->client->makeRequest('/regions', $parameters);
    }

    public function streetsList(
        array $filter = array(),
        array $locale = array('lang' => 'ru'),
        array $pagination = array('page' => 1, 'limit' => 20),
        array $order = array()
    )
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }

        if (count($locale)) {
            $parameters['locale'] = $locale;
        }

        if (count($pagination)) {
            $parameters['pagination'] = $pagination;
        }

        if (count($order)) {
            $parameters['order'] = $order;
        }

        return $this->client->makeRequest('/streets', $parameters);
    }

    public function phoneDataGet(
        array $filter = array(),
        array $locale = array('lang' => 'ru')
    )
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }

        if (count($locale)) {
            $parameters['locale'] = $locale;
        }

        return $this->client->makeRequest('/phone-data', $parameters);
    }

    public function serviceLocalityGet(
        array $filter = array(),
        array $locale = array('lang' => 'ru'),
        array $pagination = array('page' => 1, 'limit' => 20),
        array $order = array()
        )
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }

        if (count($locale)) {
            $parameters['locale'] = $locale;
        }

        if (count($pagination)) {
            $parameters['pagination'] = $pagination;
        }

        if (count($order)) {
            $parameters['order'] = $order;
        }

        return $this->client->makeRequest('/service-locality', $parameters);
    }

    public function postCodeGet(
        array $filter = array(),
        array $locale = array('lang' => 'ru')
    )
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }

        if (count($locale)) {
            $parameters['locale'] = $locale;
        }

        return $this->client->makeRequest('/post-code', $parameters);
    }
}