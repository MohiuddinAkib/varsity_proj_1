<?php


namespace App\Contract;


use App\Models\User;

interface IUserService
{
    /**
     * @param string $name
     * @param string $email
     * @param string $contact_number
     * @param string $password
     * @return User
     */
    public function createSystemAdmin(string $name, string $email, string $contact_number, string $password): User;

    /**
     * @param string $name
     * @param string $email
     * @param string $contact_number
     * @param string $password
     * @return User
     */
    public function createHostAdmin(string $name, string $email, string $contact_number, string $password): User;

    /**
     * @param string $name
     * @param string $email
     * @param string $contact_number
     * @param string $password
     * @return User
     */
    public function createLocalAdmin(string $name, string $email, string $contact_number, string $password): User;
}
