<?php
namespace Geohelper\Response;

use Geohelper\Exception\InvalidJsonException;

class ApiResponse implements \ArrayAccess
{
    protected $statusCode;

    protected $response;

    public function __construct($statusCode, $responseBody = null)
    {
        $this->statusCode = (int) $statusCode;

        if (!empty($responseBody)) {
            $response = json_decode($responseBody, true);

            if (!$response && JSON_ERROR_NONE !== ($error = json_last_error())) {
                throw new InvalidJsonException(
                    "Invalid JSON in the API response body. Error code #$error",
                    $error
                );
            }

            $this->response = $response;
        }
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function isSuccessful()
    {
        return $this->statusCode < 400 && is_bool($this->response['success']);
    }

    public function __call($name, $arguments)
    {
        $propertyName = strtolower(substr($name, 3, 1)) . substr($name, 4);

        if (!isset($this->response[$propertyName])) {
            throw new \InvalidArgumentException("Method \"$name\" not found");
        }

        return $this->response[$propertyName];
    }

    public function getErrorMsg()
    {
        if (!isset($this->response['error'])) {
            throw new \InvalidArgumentException('Method "getErrorMsg" not found');
        }

        return $this->response['error']['message'];
    }

    public function __get($name)
    {
        if (!isset($this->response[$name])) {
            throw new \InvalidArgumentException("Property \"$name\" not found");
        }

        return $this->response[$name];
    }

    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException('This activity not allowed');
    }

    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException('This call not allowed');
    }

    public function offsetExists($offset)
    {
        return isset($this->response[$offset]);
    }

    public function offsetGet($offset)
    {
        if (!isset($this->response[$offset])) {
            throw new \InvalidArgumentException("Property \"$offset\" not found");
        }

        return $this->response[$offset];
    }
}
