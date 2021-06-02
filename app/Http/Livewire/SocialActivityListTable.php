<?php

namespace App\Http\Livewire;

use App\Models\SocialActivity;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SocialActivityListTable extends LivewireDatatable
{
    public $model = SocialActivity::class;

    public function builder()
    {
        return SocialActivity::query()->whereOrganizationId(auth()->user()->organization_id);
    }

    public function columns()
    {
        return [
            Column::name("id")->hide(),
            Column::name("name")->label("Name")->filterable()->searchable(),
            Column::name("location")->label("Location")->filterable()->searchable(),
            Column::name("type")->label("Type")->filterable()->searchable(),
            Column::name("volunteers")->label("Volunteers")->filterable()->searchable(),
            DateColumn::name("activity_date")->label("Holding date")->filterable()->searchable(),
            Column::delete(),
        ];
    }
}
