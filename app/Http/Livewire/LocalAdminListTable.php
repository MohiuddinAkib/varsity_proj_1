<?php

namespace App\Http\Livewire;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LocalAdminListTable extends LivewireDatatable
{
    public $model = User::class;

    public function builder()
    {
        $organization_ids = auth()->user()->organizations->map->id;
        return User::query()->role("local_admin")->whereIn("organization_id", $organization_ids);
    }

    public function columns()
    {
        return [
            Column::name("id")->hide(),
            Column::name("name")->label("Name")->filterable()->searchable(),
            Column::name("email")->label("Email")->filterable()->searchable(),
            Column::name("contact_number")->label("Contact Number")->filterable()->searchable(),
            Column::name("organization.name")->label("Organization")->filterable()->searchable(),
            DateColumn
                ::name("created_at")->label("Created At")->filterable()->searchable(),
            Column::delete(),
        ];
    }
}
