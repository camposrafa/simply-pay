<?php

namespace App\Console\Commands;

use App\Domain\Application\Auth\Logout\Command as LogoutCommand;
use App\Domain\Application\Auth\Logout\Handler;
use App\Domain\Application\Jobs\User\Notifier;
use App\Domain\Application\Payment\Create\Command as CreateCommand;
use App\Domain\Application\Payment\Create\Handler as CreateHandler;
use App\Domain\Application\User\Wallet\Deposit\Command as DepositCommand;
use App\Domain\Application\User\Wallet\Deposit\Handler as DepositHandler;
use App\Domain\Infra\RmFinances\CheckerRepository;
use App\Domain\Models\User;
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
        App::make(DepositHandler::class)->handle(new DepositCommand(1, 50));
    }
}
