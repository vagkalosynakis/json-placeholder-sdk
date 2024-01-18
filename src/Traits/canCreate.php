<?php

namespace Vkal\Traits;

use Vkal\Config;

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

        return json_decode($response->getBody(), true);
    }
}