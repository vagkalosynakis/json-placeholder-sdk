<?php

namespace Vkal\Classes\http;

class Credentials {
    protected $env;
    protected $clientId;
    protected $clientSecret;

    public function __construct(){}


    public function setEnv(string $env): self
    {
        $this->env = $env;
        return $this;
    }

    public function getEnv(): string
    {
        return $this->env;
    }

    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientSecret(string $clientSecret): self
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }
}