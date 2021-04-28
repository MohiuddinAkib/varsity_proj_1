<?php


namespace App\Services;

use App\Contract\ISocialActivityService;
use App\Models\SocialActivity;

class SocialActivityService implements ISocialActivityService
{


    /**
     * @param string $name
     * @param string $type
     * @param string $location
     * @param \DateTime $activity_date
     * @param int $organization_id
     * @param array $volunteers
     * @return SocialActivity
     */
    public function create(string $name, string $type, string $location, \DateTime $activity_date, int $organization_id, array $volunteers): SocialActivity
    {
        // TODO: Implement create() method.
    }
}
