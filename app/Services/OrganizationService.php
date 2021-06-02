<?php


namespace App\Services;

use App\Facades\User;
use App\Models\Organization;
use App\Contract\IOrganizationService;

class OrganizationService implements IOrganizationService
{
    /**
     * @param string $name
     * @param string $branch
     * @param string $contact_number
     * @param int $owner_id
     * @param string $localadmin_name
     * @param string $localadmin_email
     * @param string $localadmin_mobile_number
     * @return Organization
     */
    public function create(string $name, string $branch, string $contact_number, int $owner_id, string $localadmin_name = "", string $localadmin_email = "", string $localadmin_mobile_number = ""): Organization
    {
        $organization = Organization::create([
            "name" => $name,
            "branch" => $branch,
            "contact_number" => $contact_number,
            "owner_id" => $owner_id,
        ]);

        $user = User::findByNameEmailContact($localadmin_name, $localadmin_email, $localadmin_mobile_number);

        if ($user) {
            $organization->local_admin()->save($user);
        } else {
            $user = $organization->local_admin()->create([
                "password" => "admin1234",
                "name" => $localadmin_name,
                "email" => $localadmin_email,
                "contact_number" => $localadmin_mobile_number,
            ]);

            $user->assignRole("local_admin");
        };

        return $organization;
    }

    /**
     * @param array $employee_data
     * @param int $organization_id
     * @return array
     */
    public function addEmployees(array $employee_data, int $organization_id): array
    {
        // TODO: Implement addEmployees() method.
    }

    public function remove(int $organization_id): bool|null
    {
        return Organization::delete($organization_id);
    }
}
