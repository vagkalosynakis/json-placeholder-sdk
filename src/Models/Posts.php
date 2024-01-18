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
        );

        return json_decode($response->getBody(), true);
    }

    public function create(array $body)
    {
        $url = Config::get('base_url').$this->endpoint;

        $response = $this->client->request(
            'POST',
            $url,
            array_merge(
                ['verify' => false],
                ['form_params' => $body]
            )
        );

        return json_decode($response->getBody(), true);
    }

    public function delete(?int $id)
    {
        $url = Config::get('base_url').$this->endpoint;
        if (!empty($id)) {
            $url .= "/$id";
        }

        $response = $this->client->request(
            'DELETE',
            $url,
            ['verify' => false]
        );

        return json_decode($response->getBody(), true);
    }

    public function update(array $body)
    {
        $url = Config::get('base_url').$this->endpoint;

        $response = $this->client->request(
            'POST',
            $url,
            array_merge(
                ['verify' => false],
                $body
            )
        );

        return json_decode($response->getBody(), true);
    }
}