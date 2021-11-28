<?php

namespace RandomUser\Tests\Unit\Infrastructure;

use PHPUnit\Framework\TestCase;
use RandomUser\Infrastructure\DateTime;

class DateTimeTest extends TestCase
{

    public function testGetNow(): void
    {
        $this->assertSame(date('Y-m-d H:i:s'), DateTime::getNow());
    }
}
