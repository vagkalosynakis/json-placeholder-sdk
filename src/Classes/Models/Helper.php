<?php

namespace Vkal\Classes\Models;

use Vkal\Interfaces\ClientInterface;
use Vkal\Classes\Models\Posts;
use Vkal\Classes\Models\Users;

class Helper {
    protected $client;
    protected $posts;
    protected $users;

    public function __construct(
        ClientInterface $client,
        Posts $posts,
        Users $users
    )
    {        
        $this->client = $client;
        $this->posts = $posts;
        $this->users = $users;
    }

    public function posts() {
        return $this->posts;
    }

    public function users() {
        return $this->users;
    }

    // TODO add helper functions here
}