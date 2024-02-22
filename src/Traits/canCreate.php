<?php

namespace Vkal\Traits;

use Vkal\Config;
use Vkal\Classes\http\Response;

trait canCreate {

    /**
     * Creates a resources
     * using the $body as payload.
     *
     * @param array<mixed> $body
     * @return Response
     */
    public function create(array $body): Response
    {
        $url = Config::get('base_url').$this->endpoint;

        $response = $this->client->request(
            'POST',
            $url,
            $body
        );

        return new Response(
            $response->getStatusCode(),
            $response->getBody(),
            $response->getErrors()
        );
    }
}