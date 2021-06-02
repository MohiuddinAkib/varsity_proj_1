<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class LocalAdminTable extends Component
{

    public Collection $columns;

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
                "label" => "Organization",
                "renderer" => function (User $model) {
                    return $model->organization?->name ?? "No Organization";
                }
            ],
            "created_at" => "Created At",
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.local-admin-table', [
            "host_admins" => User::role("local_admin")->latest()->paginate(),
        ]);
    }
}
