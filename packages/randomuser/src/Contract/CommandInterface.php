<?php

namespace RandomUser\Contract;

use RandomUser\Domain\Result;

interface CommandInterface
{
    public function exec(): Result;
}