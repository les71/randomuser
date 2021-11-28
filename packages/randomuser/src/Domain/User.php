<?php

namespace RandomUser\Domain;

class User
{
    private const DEFAULT_PASSWORD = 'abcd';

    private $name;
    private $gender;

    public function __construct(
        string $name,
        string $gender
    ) {
        $this->name = $name;
        $this->gender = $gender;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getPassword(): string
    {
        return self::DEFAULT_PASSWORD;
    }
}