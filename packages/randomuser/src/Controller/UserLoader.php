<?php

namespace RandomUser\Controller;

use RandomUser\Contract\CommandInterface;
use RandomUser\Domain\Result;

class UserLoader
{
    private $userLoaderCommand;

    public function __construct(
        CommandInterface  $userLoaderCommand
    ) {
      $this->userLoaderCommand = $userLoaderCommand;
    }

    public function loadUsers(): Result
    {
        return $this->userLoaderCommand->exec();
    }
}