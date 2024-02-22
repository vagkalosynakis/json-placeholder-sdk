<?php

namespace Vkal\Classes;

use Vkal\Interfaces\ClientInterface;
use Vkal\Classes\Models\Posts;
use Vkal\Classes\Models\Users;
use Vkal\Classes\http\CurlClient;
use Vkal\Classes\Container;
use Vkal\Classes\http\Credentials;

class Helper {
    protected $client;
    protected $posts;
    protected $users;
    protected $credentials;

    public function __construct(
        ClientInterface $client,
        Posts $posts,
        Users $users
    )
    {
        $this->client = $client;
        $this->posts = $posts;
        $this->users = $users;

        $client = (new Container())->get(CurlClient::class);
        $this->setClient($client);
    }

    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function setCredentials(Credentials $credentials): self
    {
        $this->credentials = $credentials;
        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function posts(): Posts
    {
        return $this->posts;
    }

    public function users(): Users
    {
        return $this->users;
    }

    // TODO add helper functions here
}