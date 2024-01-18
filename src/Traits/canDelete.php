<?php

namespace Vkal\Traits;

use Vkal\Config;

trait canDelete {
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
}