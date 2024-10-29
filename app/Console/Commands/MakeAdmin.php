<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class MakeAdmin extends Command implements PromptsForMissingInput
{
    protected $signature = 'make:admin {email} {--P|password=} {--N|name=}';

    protected $description = 'Command to create admin user';

    protected function promptForMissingArgumentsUsing()
    {
        return [
            'email' => 'Enter your email to submit as admin'
        ];
    }

    public function handle()
    {
        if (!$this->argument('email')) {
            $this->error('Email is required.');
        }
        
        if(!$this->option('password')) {
            $password = $this->secret('Enter your password');
        }

        if (User::where('email', $this->argument('email'))->exists()) {
            $this->newLine();
            $this->error('User already exists.');
            return;
        }

        $this->info('Create user as admin...');
        $password = $this->option('password') ?? $password;
        User::create([
            'name'      => $this->option('name') ?? 'Admin',
            'email'     => $this->argument('email'),
            'password'  => bcrypt($password),
        ]);

        $this->newLine();
        $this->info('Success to create admin user.');
    }
}
