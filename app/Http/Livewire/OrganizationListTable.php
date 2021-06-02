<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class OrganizationListTable extends LivewireDatatable
{
    public $model = Organization::class;

    public function builder()
    {
        return Organization::query()->whereOwnerId(auth()->id());
    }

    public function columns()
    {
        return [
            Column::name("id")->hide(),
            Column::name("name")->label("Name")->filterable()->searchable(),
            Column::name("branch")->label("Branch")->filterable()->searchable(),
            Column::name("contact_number")->label("Contact Number")->filterable()->searchable(),
            DateColumn::name("created_at")->label("created_at")->filterable()->searchable(),
            Column::delete(),
        ];
    }
}
