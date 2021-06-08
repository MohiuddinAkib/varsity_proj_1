<?php

namespace App\Http\Livewire;

use App\Models\Seminar;
use Mediconesystems\LivewireDatatables\BooleanColumn;
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
            BooleanColumn::name("is_approved")->label("Approved"),
            Column::callback(["id", "is_approved"], function ($id, $name, $is_sold, $is_approved) {
                return view('seminal-list-table-actions', compact('id', "is_approved"));
            })
        ];
    }
}
