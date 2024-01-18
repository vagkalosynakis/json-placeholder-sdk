<?php

namespace Vkal\Classes\Models;

use Vkal\Classes\Models\AbstractModel;
use Vkal\Config;
use Vkal\Interfaces\ClientInterface;
use Vkal\Traits\canGet;

class Users extends AbstractModel {

    use canGet;

    protected string $endpoint;
    protected ClientInterface $client;
    protected string $class_name;

    public function __construct(ClientInterface $client)
    {
        $this->class_name = (new \ReflectionClass($this))->getShortName();
        $this->endpoint = Config::get(implode('.',[
            'endpoints',
            $this->class_name
        ]));
        $this->client = $client;
    }

}