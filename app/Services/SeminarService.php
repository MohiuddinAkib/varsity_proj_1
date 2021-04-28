<?php


namespace App\Services;

use App\Contract\ISeminarService;
use App\Models\Seminar;

class SeminarService implements ISeminarService
{

    /**
     * @param string $name
     * @param string $type
     * @param string $location
     * @param \DateTime $activity_date
     * @param int $organization_id
     * @param string $contact_number
     * @return Seminar
     */
    public function create(string $name, string $type, string $location, \DateTime $activity_date, int $organization_id, string $contact_number): Seminar
    {
        // TODO: Implement create() method.
    }
}
