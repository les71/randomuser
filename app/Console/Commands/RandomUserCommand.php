<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RandomUser\Command\UserLoader;
use RandomUser\Contract\UserModelInterface;
use RandomUser\Controller\UserLoader as UserLoaderController;
use RandomUser\Model\UserLoaderModel;

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
                App::make(UserModelInterface::class)
            )
        );

        $this->info($controller->loadUsers()->getResult());
    }
}
