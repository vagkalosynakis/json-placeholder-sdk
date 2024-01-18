<?php

use Vkal\Models\AbstractModel;
use Vkal\Config;

class Posts extends AbstractModel {
    protected string $endpoint;

    public function __construct()
    {
        $this->endpoint = Config::get('endpoints.posts');
    }
}