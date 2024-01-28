<?php

namespace Vkal\Traits;

use Vkal\Config;
use Vkal\Classes\http\Response;

trait canUpdate {
    public function update(array $body)
    {
        $url = Config::get('base_url').$this->endpoint;

        $response = $this->client->request(
            'PUT',
            $url,
            $body
        );

        return new Response(
            $response->getStatusCode(),
            $response->getBody()
        );
    }
}