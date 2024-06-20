<?php

namespace App\Console\Commands;

use App\Domain\Application\Auth\Logout\Command as LogoutCommand;
use App\Domain\Application\Auth\Logout\Handler;
use App\Domain\Models\User as ModelsUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class Playground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $user = App::make(Handler::class)->handle(new LogoutCommand(
        //     ModelsUser::find(1)
        // ));

        dump($user);
    }
}
