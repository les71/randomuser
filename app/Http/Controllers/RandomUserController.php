<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Laravel\Lumen\Routing\Controller as BaseController;
use RandomUser\Infrastructure\MongoCollection;
use RandomUser\Model\MongoUserModel;
use RandomUser\Model\UserLoaderModel;
use RandomUser\Command\UserLoader;

class RandomUserController extends BaseController
{
    public function exec()
    {
        $processor = new UserLoader(
            new UserLoaderModel(
                new Client()
            ),
            new MongoUserModel(
                MongoCollection::create('randomuser')
            )
        );


        return response(
            $processor->exec()->getResult(),
            200,
            ['Content-Type' => 'text/html']
        );
    }
}
