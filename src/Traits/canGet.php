<?php

namespace Vkal\Traits;

use Vkal\Config;

trait canGet {
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
}