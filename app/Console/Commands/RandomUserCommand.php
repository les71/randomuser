<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use RandomUser\Model\MysqlUserModel;
use RandomUser\Model\UserLoaderModel;
use RandomUser\Command\UserLoader;
use RandomUser\Controller\UserLoader as UserLoaderController;

class RandomUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'randomuser:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'load randomuser from API';

    public function handle(): void
    {
        $controller = new UserLoaderController(
            new UserLoader(
                new UserLoaderModel(
                    new Client()
                ),
                new MysqlUserModel(
                    DB::table('randomusers')
                )
            )
        );

        $this->info($controller->loadUsers()->getResult());
    }
}
