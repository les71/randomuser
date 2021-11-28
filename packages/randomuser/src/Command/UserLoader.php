<?php

namespace RandomUser\Command;

use RandomUser\Contract\CommandInterface;
use RandomUser\Contract\UserLoaderInterface;
use RandomUser\Contract\UserModelInterface;
use RandomUser\Domain\Result;
use RandomUser\Exception\LoadErrorException;

class UserLoader implements CommandInterface
{
    private $loader;
    private $model;

    public function __construct(
        UserLoaderInterface $loader,
        UserModelInterface $model
    ) {
        $this->loader = $loader;
        $this->model = $model;
    }

    public function exec(): Result
    {
        try {
            $Users = $this->loader->load();
        }catch (LoadErrorException $exception){
            return new Result(Result::RESULT_ERR);
        }

        foreach ($Users as $user){
            $this->model->save($user);
        }

        return new Result(Result::RESULT_OK);
    }
}