<?php


namespace App\Services;

use App\Contract\IOrganizationService;
use App\Models\Organization;

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
    public function create(string $name, string $branch, string $contact_number, int $owner_id, string $localadmin_name, string $localadmin_email, string $localadmin_mobile_number): Organization
    {
        // TODO: Implement create() method.
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
}
