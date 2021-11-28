<?php

namespace RandomUser\Model;

use MongoDB\Collection;
use RandomUser\Contract\UserModelInterface;
use RandomUser\Domain\User;
use RandomUser\Infrastructure\DateTime;

class MongoUserModel implements UserModelInterface
{
    private $collection;

    public function __construct(
        Collection $collection
    ) {
        $this->collection = $collection;
    }
    public function save(User $user): void
    {
        $this->collection->insertOne(
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