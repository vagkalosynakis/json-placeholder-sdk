<?php

namespace Vkal\Traits;

use Vkal\Config;
use Vkal\Classes\http\Response;


trait canCreate {
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

        return new Response(
            $response->getStatusCode(),
            $response->getBody()
        );
    }
}