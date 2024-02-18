<?php

namespace Vkal\Classes\Models;

use Vkal\Interfaces\ClientInterface;

abstract class AbstractModel {
    protected $endpoint;
    protected $client;
}