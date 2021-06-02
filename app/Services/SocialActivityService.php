<?php


namespace App\Services;

use App\Exceptions\SocialActivityOnSameLocationAndDateAlreadyExistsException;
use App\Models\SocialActivity;
use App\Contract\ISocialActivityService;

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
    public function create(string $name, string $type, string $location, string $activity_date, int $organization_id, array $volunteers): SocialActivity
    {
        $another_activity = SocialActivity::whereDate("activity_date", $activity_date)->whereLocation($location)->get();

        throw_unless($another_activity->isEmpty(), new SocialActivityOnSameLocationAndDateAlreadyExistsException("activity on the same date already exists"));

        return SocialActivity::create([
            "name" => $name,
            "type" => $type,
            "location" => $location,
            "activity_date" => $activity_date,
            "organization_id" => $organization_id,
            "volunteers" => $volunteers
        ]);
    }
}
