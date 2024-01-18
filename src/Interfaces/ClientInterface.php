<?php

Namespace Vkal\Interfaces;

use Vkal\Models\Response;

interface ClientInterface{
    public function getToken(): string;
    public function getHeaders(?string $key): array;
    public function setHeaders(): self;
    public function setUrl(string $url): self;
    public function request(): Response;
}