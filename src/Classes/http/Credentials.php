<?php

namespace Vkal\Classes\http;

class Credentials {
    protected $env;
    protected $clientId;
    protected $clientSecret;

    public function __construct(){}

    public function setEnv(string $env)
    {
        $this->env = $env;
        return $this;
    }

    public function getEnv()
    {
        return $this->env;
    }

    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }
}