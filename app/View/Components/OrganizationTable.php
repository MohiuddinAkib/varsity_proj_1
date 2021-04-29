<?php

namespace App\View\Components;

use App\Models\Organization;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrganizationTable extends Component
{
    public Collection $columns;
    public LengthAwarePaginator $organizations;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->columns = auth()->user()->hasRole("super_admin") ? $this->columnsSuperAdminView() : $this->columnsHostAdminView();
        $this->organizations = auth()->user()->hasRole("super_admin") ? Organization::latest()->paginate() : auth()->user()->organizations()->latest()->paginate();
    }

    public function columnsSuperAdminView()
    {
        return collect([
            "name" => "Name",
            "branch" => "Branch",
            "contact_number" => "Contact Number",
            "owner_id" => [
                "label" => "Owner",
                "renderer" => function (Organization $model) {
                    return $model->owner->name;
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

    public function renderModelField(Organization $model, string $columnKey)
    {
        $columnOptions = $this->columns[$columnKey];

        if (is_string($columnOptions)) {
            return $model[$columnKey];
        }

        return $columnOptions["renderer"]($model);
    }

    public function columnsHostAdminView()
    {
        return $this->columnsSuperAdminView()->except("owner");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.organization-table");
    }
}
