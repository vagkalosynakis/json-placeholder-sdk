<?php

namespace Vkal\Traits;

use Vkal\Config;
use Vkal\Classes\http\Response;

trait canGet {
    public function get(int $id = null): Response
    {
        $url = Config::get('base_url').$this->endpoint;
        if (!empty($id)) {
            $url .= "/$id";
        }

        $response = $this->client->request(
            'GET',
            $url
        );

        return new Response(
            $response->getStatusCode(),
            $response->getBody()
        );
    }
}