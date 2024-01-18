<?php

namespace Vkal\Models;

use Vkal\Models\AbstractModel;
use Vkal\Config;
use Vkal\Interfaces\ClientInterface;
use Vkal\Traits\canCreate;
use Vkal\Traits\canDelete;
use Vkal\Traits\canGet;
use Vkal\Traits\canUpdate;

class Posts extends AbstractModel {

    use canGet, canCreate, canDelete, canUpdate;

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