<?php

namespace Vkal\Models;

use Vkal\Models\AbstractModel;
use Vkal\Config;
use Vkal\Interfaces\ClientInterface;

class Posts extends AbstractModel {
    protected string $endpoint;
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $class_name = (new \ReflectionClass($this))->getShortName();
        $this->endpoint = Config::get(implode('.',[
            'endpoints',
            $class_name
        ]));
        $this->client = $client;
    }    

    public function get(int $id = null)
    {
        return 'getting';
    }

    public function create()
    {
        return 'creating';
    }

    public function delete()
    {
        return 'deleting';
    }

    public function update()
    {
        return 'updating';
    }
}