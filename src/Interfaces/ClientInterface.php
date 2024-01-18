<?php

Namespace Vkal\Interfaces;

use Vkal\Classes\http\Response;

interface ClientInterface{
    public function getToken(): string;
    public function setHeaders(array $headers): self;
    public function request(string $method, string $url, array $body = []): Response;
}