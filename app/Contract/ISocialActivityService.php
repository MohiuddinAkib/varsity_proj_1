<?php


namespace App\Contract;

use App\Models\SocialActivity;

interface ISocialActivityService
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
    public function create(string $name, string $type, string $location, string $activity_date, int $organization_id, array $volunteers): SocialActivity;
}
