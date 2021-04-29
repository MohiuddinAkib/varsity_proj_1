<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class HostAdminTable extends Component
{
    public Collection $columns;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->columns = collect([
            "name" => "Name",
            "email" => "Email",
            "contact_number" => "Contact Number",
            "organizations" => [
                "label" => "Organizations",
                "renderer" => function (User $model) {
                    return $model->organizations->count();
                }
            ],
            "created_at" => "Created At",
        ]);
    }

    public function renderTableColumn(string|array $labelOptions)
    {
        if (is_string($labelOptions)) {
            return $labelOptions;
        }

        return $labelOptions["label"];
    }

    public function renderModelField(User $model, string $columnKey)
    {
        $columnOptions = $this->columns[$columnKey];

        if (is_string($columnOptions)) {
            return $model[$columnKey];
        }

        return $columnOptions["renderer"]($model);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.host-admin-table", [
            "host_admins" => User::role("host_admin")->latest()->paginate()
        ]);
    }
}
