<?php

namespace Vkal\Models;

class Response {
    protected int $status_code;
    protected array $headers;
    protected mixed $body;

    public function __construct(int $status_code, array $headers, mixed $body)
    {
        $this->status_code = $status_code;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getStatusCode()
    {
        return $this->status_code;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getBody()
    {
        return $this->body;
    }

}