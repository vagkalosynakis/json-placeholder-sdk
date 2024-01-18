<?php

namespace Vkal\Models;

use Vkal\Models\AbstractModel;
use Vkal\Config;
use Vkal\Interfaces\ClientInterface;

class Posts extends AbstractModel {
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

    public function get(int $id = null)
    {
        $url = Config::get('base_url').$this->endpoint;
        if (!empty($id)) {
            $url .= "/$id";
        }

        $response = $this->client->request(
            'GET',
            $url,
            ['verify' => false]
        )->getBody();
        return json_decode($response, true);
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