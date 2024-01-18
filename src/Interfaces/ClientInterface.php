<?php

Namespace Vkal\Interfaces;

interface ClientInterface{
    public function getHeaders(?string $key);
    public function setHeaders();
    public function setUrl(string $url);
    public function request();
}