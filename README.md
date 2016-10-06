# Geohelper API PHP client

PHP-client for [Geohelper API](http://geohelper.info/ru/doc/api).

Use [API documentation](http://geohelper.info/ru/documentation)

## Requirements

* PHP 5.3 and above
* PHP's cURL support

## Install

1) Get [composer](https://getcomposer.org/download/)

2) Run into your project directory:
```bash
composer require dmamontov/geohelper-api-client-php ~1.0.0
```

If you have not used `composer` before, include autoloader into your project.
```php
require 'path/to/vendor/autoload.php';
```

## Usage

### Get countries
```php
$client = new \Geohelper\ApiClient(
    'api_key'
);


try {
    $response = $client->countriesList();
} catch (\Geohelper\Exception\CurlException $e) {
    echo "Connection error: " . $e->getMessage();
}

if ($response->isSuccessful()) {
    $countries = isset($response['result']) ? $response['result'] : array();
    foreach ($countries as $country) {
        echo $country['name'];
    }
} else {
    echo sprintf(
        "Error: [HTTP-code %s] %s",
        $response->getStatusCode(),
        $response->getErrorMsg()
    );
}
```
