<?php

namespace Vkal\Models;

class Credentials {
    protected string $env;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct(string $env, string $clientId, string $clientSecret)
    {
        $this->env = $env;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function getEnv()
    {
        return $this->env;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }
}