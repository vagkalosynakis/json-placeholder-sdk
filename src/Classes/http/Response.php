<?php

namespace Vkal\Classes\http;

class Response {
    protected int $status_code;
    protected mixed $body;

    public function __construct(int $status_code, mixed $body)
    {
        $this->status_code = $status_code;
        $this->body = $body;
    }

    public function getStatusCode()
    {
        return $this->status_code;
    }

    public function getBody()
    {
        return $this->body;
    }

}