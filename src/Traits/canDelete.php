<?php

namespace Vkal\Traits;

use Vkal\Config;
use Vkal\Classes\http\Response;

trait canDelete {
    
    public function delete(?int $id): Response
    {
        $url = Config::get('base_url').$this->endpoint;
        if (!empty($id)) {
            $url .= "/$id";
        }

        $response = $this->client->request(
            'DELETE',
            $url
        );

        return new Response(
            $response->getStatusCode(),
            $response->getBody(),
            $response->getErrors()
        );
    }
}