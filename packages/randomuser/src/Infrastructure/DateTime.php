<?php

namespace RandomUser\Infrastructure;

class DateTime
{
    public static function getNow(): string
    {
        return date('Y-m-d H:i:s');
    }
}
