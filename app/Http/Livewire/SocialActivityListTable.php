<?php

namespace App\Http\Livewire;

use App\Models\SocialActivity;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SocialActivityListTable extends LivewireDatatable
{
    public $model = SocialActivity::class;

    public function builder()
    {
        if (auth()->user()->hasRole("local_admin")) {
            return SocialActivity::query()->whereOrganizationId(auth()->user()->organization_id);
        }

        $organiztion_ids = auth()->user()->organizations->map->id;

        return SocialActivity::query()->whereIn("organization_id", $organiztion_ids);
    }

    public function columns()
    {
        return [
            Column::name("id")->hide(),
            Column::name("name")->label("Name")->filterable()->searchable(),
            Column::name("location")->label("Location")->filterable(),
            Column::name("type")->label("Type")->filterable(),
            Column::callback(["volunteers"], function ($volunteers) {
                $parsed = json_decode($volunteers);
                return implode(", ", $parsed);
            })->label("Volunteers"),
            DateColumn::name("activity_date")->label("Holding date")->filterable(),
            BooleanColumn::name("is_approved")->label("Approved"),
            Column::callback(["id", "is_approved"], function ($id, $name, $is_sold, $is_approved) {
                return view('social-activity-list-table-actions', compact('id', "is_approved"));
            })
        ];
    }

    public function toggleApproval(int $id)
    {
        $social_activity = SocialActivity::findOrFail($id);

        $social_activity->is_approved = !$social_activity->is_approved;

        $social_activity->save();
    }
}
