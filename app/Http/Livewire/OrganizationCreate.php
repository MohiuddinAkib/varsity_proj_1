<?php

namespace App\Http\Livewire;

use Form;
use Livewire\Component;
use App\Models\Organization;
use Illuminate\Support\Collection;
use App\Facades\Organization as OrganizationFacade;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationCreate extends Component
{
    use AuthorizesRequests;

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
        $errors = $this->getErrorBag();

        $inputs = collect([
            "fields" => collect([
                "name" => collect([
                    "label" => Form::label("name", "Name", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("name") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("name", null, ["wire:model" => "name", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("name") ? "border-red-400" : "")]),
                ]),
                "branch" => collect([
                    "label" => Form::label("branch", "Email Address", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("branch") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("branch", null, ["wire:model" => "branch", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("branch") ? "border-red-400" : "")]),
                ]),
                "contact_number" => collect([
                    "label" => Form::label("contact_number", "Contact Number", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("contact_number") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("contact_number", null, ["wire:model" => "contact_number", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("contact_number") ? "border-red-400" : "")]),
                ]),
                "local_admin_name" => collect([
                    "label" => Form::label("local_admin_name", "Local admin name", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("local_admin_name") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("local_admin_name", null, ["wire:model" => "local_admin_name", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("local_admin_name") ? "border-red-400" : "")]),
                ]),
                "local_admin_email" => collect([
                    "label" => Form::label("local_admin_email", "Local admin email", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("local_admin_email") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::email("local_admin_email", null, ["wire:model" => "local_admin_email", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("local_admin_email") ? "border-red-400" : "")]),
                ]),
                "local_admin_contact_number" => collect([
                    "label" => Form::label("local_admin_contact_number", "Local admin contact number", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("local_admin_contact_number") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("local_admin_contact_number", null, ["wire:model" => "local_admin_contact_number", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("local_admin_contact_number") ? "border-red-400" : "")]),
                ]),
            ]),
            "form_bottom_buttons" => [
                "submit" => Form::submit("Create"),
            ]
        ]);

        return view('livewire.organization-create', compact("inputs"));
    }
}
