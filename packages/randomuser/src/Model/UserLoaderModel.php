<?php

namespace RandomUser\Model;

use GuzzleHttp\Client;
use RandomUser\Contract\UserLoaderInterface;
use RandomUser\Domain\User;
use RandomUser\Exception\LoadErrorException;
use Throwable;

class UserLoaderModel implements UserLoaderInterface
{
    private $loader;

    public function __construct(
        Client $loader
    ) {
        $this->loader = $loader;
    }

    /**
     * @return User[]
     * @throws LoadErrorException
     */
    public function load(): array
    {
        try {
            $users = json_decode($this->loader->get(env('RANDOMUSER_URL'))->getBody());
        }catch (Throwable $throwable) {
            throw new LoadErrorException($throwable->getMessage());
        }

        return array_map(
            function ($user) {
                return new User(
                    sprintf('%s %s', $user->name->first, $user->name->last),
                    $user->gender
                );
            },
            $users->results
        );
    }
}