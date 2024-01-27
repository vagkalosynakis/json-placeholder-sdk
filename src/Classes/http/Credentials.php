<?php

namespace Vkal\Classes\http;

class Credentials {
    protected string $env;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct(){}

    public function setEnv($env)
    {
        $this->env = $env;
        return $this;
    }

    public function getEnv()
    {
        return $this->env;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }
}