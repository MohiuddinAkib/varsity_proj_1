<?php

namespace App\Http\Livewire;

use App\Models\Seminar;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SeminarListTable extends LivewireDatatable
{
    public $model = Seminar::class;

    public function builder()
    {
        if (auth()->user()->hasRole("local_admin")) {
            $organization_id = auth()->user()->organization->id;
            return Seminar::query()->whereOrganizationId($organization_id);
        }

        $organiztion_ids = auth()->user()->organizations->map->id;

        return Seminar::query()->whereIn("organization_id", $organiztion_ids);
    }

    public function columns()
    {
        return [
            Column::name("id")->hide(),
            Column::name("name")->label("Name")->filterable()->searchable(),
            Column::name("type")->label("Type")->filterable(),
            Column::name("location")->label("Location")->filterable(),
            DateColumn::name("activity_date")->label("Date")->filterable(),
            Column::delete(),
        ];
    }
}
