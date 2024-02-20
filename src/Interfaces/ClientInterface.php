<?php

Namespace Vkal\Interfaces;

use Vkal\Classes\http\Response;

interface ClientInterface{

    /**
     * Retrieves an authentication token
     *
     * @return string
     */
    public function getToken(): string;

    /**
     * Sets the headers for
     * all following requests
     *
     * @param array<mixed> $headers
     * @return self
     */
    public function setHeaders(array $headers): self;

    /**
     * Executes the http request
     *
     * @param string $method
     * @param string $url
     * @param array<mixed> $body
     * @return Response
     */
    public function request(string $method, string $url, array $body = []): Response;
}