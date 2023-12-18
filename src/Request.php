<?php

namespace src;

class Request
/**
 * Request class handles validating and sanitizing
 * input from GET, POST.
 *
 * Provides methods to safely access sanitized
 * user input.
 */
{
    private array $Form = [];
    private string $method;
    private array $Params = [];

    public function __construct(array $server, array $post, array $get)
    {
        $this->method = $server['REQUEST_METHOD'];
        $this->Params = $this->validateParams($get);
        $this->Form = $this->validateForm($post);
    }

    private function validateForm($post)
    {
        foreach ($post as $field) {
            $field = htmlspecialchars($field, ENT_QUOTES, 'UTF-8');
        }
        unset($field);
        return $post;
    }

    private function validateParams($get)
    {
        foreach ($get as $field) {
            $field = htmlspecialchars($field, ENT_QUOTES, 'UTF-8');
        }
        unset($field);
        return $get;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParams(): array
    {
        return $this->Params;
    }

    public function getForm(): array
    {
        return $this->Form;
    }
}
