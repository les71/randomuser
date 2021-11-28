<?php

namespace RandomUser\Contract;

use RandomUser\Domain\User;

interface UserModelInterface
{
    public function save(User $user): void;
}