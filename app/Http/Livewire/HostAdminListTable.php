<?php

namespace App\Http\Livewire;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class HostAdminListTable extends LivewireDatatable
{
    public $exportable = true;

    public $model = User::class;

    public function builder()
    {
        return User::query()->role("host_admin");
    }

    public function columns()
    {
        return [
            Column::name("id")->hide(),
            Column::name("name")->label("Name")->filterable()->searchable(),
            Column::name("email")->label("Email")->filterable()->searchable(),
            Column::name("contact_number")->label("Contact number")->filterable()->searchable(),
            NumberColumn::name("organizations.id:count")->label("Organizations")->filterable(),
            DateColumn::name("created_at")->label("Created At")->filterable(),
            Column::delete(),
        ];
    }
}
