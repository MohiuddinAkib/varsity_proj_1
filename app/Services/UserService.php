<?php


namespace App\Services;

use App\Models\User;
use App\Contract\IUserService;

class UserService implements IUserService
{


    /**
     * @param string $name
     * @param string $email
     * @param string $contact_number
     * @param string $password
     * @return User
     */
    public function createSystemAdmin(string $name, string $email, string $contact_number, string $password): User
    {
        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "contact_number" => $contact_number,
        ]);

        $user->assignRole("super_admin");

        return $user;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $contact_number
     * @param string $password
     * @return User
     */
    public function createHostAdmin(string $name, string $email, string $contact_number, string $password): User
    {
        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "contact_number" => $contact_number,
        ]);

        $user->assignRole("host_admin");

        return $user;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $contact_number
     * @param string $password
     * @return User
     */
    public function createLocalAdmin(string $name, string $email, string $contact_number, string $password): User
    {
        // TODO: Implement createLocalAdmin() method.
    }

    public function findByNameEmailContact(string $email)
    {
        return User::whereEmail($email)->first();
    }
}
