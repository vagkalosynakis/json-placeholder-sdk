<?php

namespace Vkal\Models;

use Vkal\Interfaces\ClientInterface;

abstract class AbstractModel {
    protected string $endpoint;
    protected ClientInterface $client;
}