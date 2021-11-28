<?php

namespace RandomUser\Tests\Unit\Controller;

use RandomUser\Command\UserLoader;
use RandomUser\Controller\UserLoader as UserLoaderController;
use TestCase;

class UserLoaderTest extends TestCase
{

    public function testLoadUsers(
    ): void {
        $command = $this->createMock(UserLoader::class);
        $model = new UserLoaderController($command);

        $command
            ->expects($this->once())
            ->method('exec');

        $model->loadUsers();
    }
}