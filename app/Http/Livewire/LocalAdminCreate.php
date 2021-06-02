<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Form;
use App\Facades\User;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LocalAdminCreate extends Component
{
    use AuthorizesRequests;

    public string $form_method = "saveUser";
    public string $card_title = "create local admin";

    public array $organizations = [];
    public string $name = "";
    public string $email = "";
    public string $password = "";
    public string $contact_number = "";
    public string $organization_id = "";
    public string $password_confirmation = "";

    protected array $rules = [
        "name" => ["string", "required"],
        "password" => ["min:8", "required", "confirmed"],
        "contact_number" => ["string", "required", "min:11", "max:14"],
        "email" => ["email", "required", "unique:App\Models\User,email"],
        "organization_id" => ["required", "exists:App\Models\Organization,id"],
    ];

    public function mount()
    {
        $organizations = auth()->user()->organizations->mapWithKeys(fn($item) => [$item["id"] => $item["name"]])->toArray();

        $this->fill([
            "organizations" => $organizations,
            "organization_id" => array_key_first($organizations)
        ]);
    }

    public function saveUser()
    {
        $this->authorize("create-local-admin");

        $this->validate();
        try {
            User::createLocalAdmin($this->name, $this->email, $this->contact_number, $this->password, $this->organization_id);
            $this->reset(
                "name",
                "email",
                "password",
                "password_confirmation",
                "contact_number"
            );
            session()->flash("success", "Succesfully created user");
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
                "email" => collect([
                    "label" => Form::label("email", "Email Address", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("email") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::email("email", null, ["wire:model" => "email", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("email") ? "border-red-400" : "")]),
                ]),
                "password" => collect([
                    "label" => Form::label("password", "Password", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("password") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::password("password", ["wire:model" => "password", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("password") ? "border-red-400" : "")]),
                ]),
                "password_confirmation" => collect([
                    "label" => Form::label("password_confirmation", "Confirm Passowrd", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("password_confirmation") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::password("password_confirmation", ["wire:model" => "password_confirmation", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("password_confirmation") ? "border-red-400" : "")]),
                ]),
                "contact_number" => collect([
                    "label" => Form::label("contact_number", "Contact Number", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("contact_number") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("contact_number", null, ["wire:model" => "contact_number", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("contact_number") ? "border-red-400" : "")]),
                ]),
                "organization_id" => collect([
                    "label" => Form::label("organization_id", "Organization", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("organization_id") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::select("organization_id", $this->organizations, null, ["wire:model" => "organization_id", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("organization_id") ? "border-red-400" : "")]),
                ]),
            ]),
            "form_bottom_buttons" => [
                "submit" => Form::submit("Create"),
            ]
        ]);


        return view('livewire.local-admin-create', compact("inputs"));
    }
}
