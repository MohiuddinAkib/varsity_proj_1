<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;
use Illuminate\Support\Collection;
use App\Facades\Organization as OrganizationFacade;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationCreate extends Component
{
    use AuthorizesRequests;

    public Collection $inputs;
    public string $form_method = "saveOrganization";
    public string $card_title = "create organization";

    public string $name = "";
    public string $branch = "";
    public string $contact_number = "";
    public string $local_admin_name = "";
    public string $local_admin_email = "";
    public string $local_admin_contact_number = "";

    protected array $rules = [
        "name" => ["string", "required"],
        "branch" => ["string", "required"],
        "contact_number" => ["string", "required", "min:11", "max:14"],

        "local_admin_name" => ["string", "required"],
        "local_admin_email" => ["email", "required"],
        "local_admin_contact_number" => ["string", "required", "min:11", "max:14"],
    ];

    public function mount()
    {
        $this->fill([
            "inputs" => collect([
                "name" => ([
                    "label" => "Name",
                    "type" => "text"
                ]),
                "branch" => ([
                    "label" => "Branch",
                    "type" => "text"
                ]),
                "contact_number" => ([
                    "label" => "Contact Number",
                    "type" => "text"
                ]),

                "local_admin_name" => ([
                    "label" => "Local Admin Name",
                    "type" => "text"
                ]),
                "local_admin_email" => ([
                    "label" => "Local Admin Email",
                    "type" => "email"
                ]),
                "local_admin_contact_number" => ([
                    "label" => "Local Admin Contact Number",
                    "type" => "text"
                ]),
            ])
        ]);
    }

    public function saveOrganization()
    {
        $this->authorize("create", Organization::class);
        $this->validate();

        try {
            OrganizationFacade::create($this->name, $this->branch, $this->contact_number, auth()->id(), $this->local_admin_name, $this->local_admin_email, $this->local_admin_contact_number);
            session()->flash("success", "Successfully created organization");
            $this->reset(
                "name",
                "branch",
                "contact_number",
                "local_admin_name",
                "local_admin_email",
                "local_admin_contact_number",
            );
        } catch (\Exception $e) {
            session()->flash("error", "Something went wrong");
        }
    }

    public function render()
    {
        return view('livewire.organization-create');
    }
}
