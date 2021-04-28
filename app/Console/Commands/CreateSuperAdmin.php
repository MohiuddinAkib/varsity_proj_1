<?php

namespace App\Console\Commands;

use App\Facades\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates user to manage the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask("Enter name");
        $email = $this->ask("Enter email address");
        $phone = $this->ask("Enter contact number");
        $password = $this->secret("Enter password");

        Validator::make(
            [
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "password" => $password
            ],
            [
                "name" => ["required", "string"],
                "password" => ["required", "string", "min:8"],
                "phone" => ["required", "string", "min:11", "max:14"],
                "email" => ["required", "email", "unique:users,email"],
            ]
        )->validate();

        try {
            User::createSystemAdmin($name, $email, $phone, $password);
            $this->info("Successfully create user");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

        return 0;
    }
}
