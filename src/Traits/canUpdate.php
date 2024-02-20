<?php

namespace Vkal\Traits;

use Vkal\Config;
use Vkal\Classes\http\Response;

trait canUpdate {
    
    /**
     * Updates a resources
     * using the $body as payload.
     *
     * @param array<mixed> $body
     * @return Response
     */
    public function update(array $body): Response
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