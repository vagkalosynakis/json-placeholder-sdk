<?php

namespace Vkal\Classes\http;

class Response {
    protected $status_code;
    protected $body;
    protected $errors;

    public function __construct(int $status_code, mixed $body, array $errors = [])
    {
        $this->status_code = $status_code;
        $this->body = $body;
        $this->errors = $errors;
    }

    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    public function getBody(): mixed
    {
        return $this->body;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}