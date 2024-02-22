<?php

namespace Vkal\Classes\http;

use Vkal\Interfaces\ClientInterface;
use Vkal\Classes\http\Credentials;
use Vkal\Classes\http\Response;

class CurlClient implements ClientInterface
{
    private $ch;
    private $credentials;

    public function __construct()
    {
        $this->ch = curl_init();
        $this->setDefaultOptions();
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }

    public function setCredentials(Credentials $credentials): self
    {
        $this->credentials = $credentials;
        return $this;
    }

    public function getToken(): string
    {
        return '';
    }

    public function setHeaders(array $headers): self
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        return $this;
    }

    public function request(string $method, string $url, array $body = []): Response
    {
        $this->setRequestMethod($method);
        $this->setRequestBody($body);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $response = curl_exec($this->ch);
        $errors = !empty(curl_error($this->ch)) ? [curl_error($this->ch)] : [];
        return new Response(
            curl_getinfo($this->ch, CURLINFO_HTTP_CODE),
            $response,
            $errors
        );
    }

    private function setDefaultOptions()
    {
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
    }

    private function setRequestMethod(string $method)
    {
        $method = strtoupper($method);

        switch ($method) {
            case 'GET':
                curl_setopt($this->ch, CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                curl_setopt($this->ch, CURLOPT_POST, true);
                break;
            case 'PUT':
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case 'DELETE':
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            default:
                curl_setopt($this->ch, CURLOPT_HTTPGET, true);
                break;
        }
    }

    private function setRequestBody(array $body)
    {
        if (!empty($body)) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($body));
        }
    }

    public function getBody()
    {
        return curl_multi_getcontent($this->ch);
    }

    public function getStatusCode()
    {
        return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }
}
