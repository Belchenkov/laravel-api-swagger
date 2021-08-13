<?php

use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\ConsoleOutput;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('token:generate {id}', function () {
    $id = $this->argument('id');
    $user = User::find($id);

    Auth::setUser($user);

    $console = new ConsoleOutput();
    $console->writeln($user->createToken('admin')->accessToken);
})->describe('Generate Auth Token');
