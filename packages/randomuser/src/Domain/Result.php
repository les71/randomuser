<?php

namespace RandomUser\Domain;

class Result
{
    public const RESULT_OK = "OK";
    public const RESULT_ERR = "FAILED";

    private $result;

    public function __construct(
        string $result
    ) {
        $this->result = $result;
    }

    public function getResult(): string
    {
        return $this->result;
    }

}