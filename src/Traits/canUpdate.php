<?php

namespace Vkal\Traits;

use Vkal\Config;

trait canUpdate {
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