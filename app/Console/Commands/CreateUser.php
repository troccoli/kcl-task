<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command create a user that can be used to test the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $password = fake()->word();
        /** @var User $user */
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $this->info('A new user has been created.');
        $this->info(sprintf('The username is "%s"', $user->email));
        $this->info(sprintf('And the password is "%s"',$password));
    }
}
