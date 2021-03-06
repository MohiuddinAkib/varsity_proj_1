<?php

namespace App\Http\Livewire;

use Form;
use User;
use Livewire\Component;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HostAdminCreate extends Component
{
    use AuthorizesRequests;

    public string $form_method = "saveUser";
    public string $card_title = "create host admin";

    public string $name = "";
    public string $email = "";
    public string $password = "";
    public string $contact_number = "";
    public string $password_confirmation = "";

    protected function getRules()
    {
        return [
            "name" => ["string", "required"],
            "password" => ["min:8", "required", "confirmed"],
            "contact_number" => ["string", "required", "min:11", "max:14"],
            "email" => ["email", "required", "unique:App\Models\User,email"],
        ];
    }

    public function saveUser()
    {
        $this->authorize("create-host-admin");

        $this->validate();

        try {
            User::createHostAdmin($this->name, $this->email, $this->contact_number, $this->password);
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
            ]),
            "form_bottom_buttons" => [
                "submit" => Form::submit("Create"),
            ]
        ]);

        return view("livewire.host-admin-create", compact("inputs"));
    }
}
