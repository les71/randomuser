<?php

namespace RandomUser\Model;

use Illuminate\Database\Query\Builder;
use RandomUser\Contract\UserModelInterface;
use RandomUser\Domain\User;
use RandomUser\Infrastructure\DateTime;

class MysqlUserModel implements UserModelInterface
{
    private $userTable;

    public function __construct(
        Builder $userTable
    ) {
        $this->userTable = $userTable;
    }

    public function save(User $user): void
    {
        $this->userTable->insert(
            [
                'name' => $user->getName(),
                'gender' => $user->getGender(),
                'password' => $user->getPassword(),
                "created_at" => DateTime::getNow(),
                "updated_at" => DateTime::getNow()
            ]
        );
    }
}