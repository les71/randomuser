<?php

namespace RandomUser\Contract;

use RandomUser\Domain\User;
use RandomUser\Exception\LoadErrorException;

interface UserLoaderInterface
{
    /**
     * @return User[]
     *
     * @throws LoadErrorException
     */
    public function load(): array;
}