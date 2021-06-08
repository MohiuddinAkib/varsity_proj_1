<?php

namespace App\Http\Livewire;

use Form;
use App\Models\Seminar;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SeminarCreate extends Component
{
    use AuthorizesRequests;

    public string $form_method = "saveSeminar";
    public string $card_title = "create social activity";

    public string $name = "";
    public string $location = "";
    public string $contact_number = "";
    public string $type = "education";
    public string $activity_date = "";
    public string $organization_id = "";

    protected function getRules()
    {
        return [
            "name" => ["string", "required"],
            "location" => ["string", "required"],
            "activity_date" => ["date", "required"],
            "contact_number" => ["string", "required", "min:11"],
            "organization_id" => ["required", "exists:App\Models\Organization,id"],
            "type" => ["string", "required", Rule::in(["education", "employee_seminar", "food_donation", "welfare", "money_donation", "cloth_distribution"])],
        ];
    }

    public function mount()
    {
        $this->fill([
            "organization_id" => auth()->user()->organization->id
        ]);
    }we

    public function saveSeminar()
    {
        $validated = $this->validate();
        Seminar::create($validated);
        session()->flash("success", "Successfully created organization");
        $this->reset(
            "name",
            "location",
            "contact_number",
            "type",
            "activity_date",
            "organization_id",
        );
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
                "type" => collect([
                    "label" => Form::label("type", "Type", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("type") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::select("type", [
                        "education" => "Education Event",
                        "employee_seminar" => "Employee Seminar", "food_donation" => "Food Donation", "welfare" => "Welfare", "money_donation" => "Money Donation", "cloth_distribution" => "Cloth Distribution"
                    ], null, ["wire:model" => "type", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("type") ? "border-red-400" : "")]),
                ]),
                "location" => collect([
                    "label" => Form::label("location", "Location", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("location") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("location", null, ["wire:model" => "location", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("location") ? "border-red-400" : "")]),
                ]),
                "contact_number" => collect([
                    "label" => Form::label("contact_number", "Contact Number", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("contact_number") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("contact_number", null, ["wire:model" => "contact_number", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("contact_number") ? "border-red-400" : "")]),
                ]),
                "activity_date" => collect([
                    "label" => Form::label("activity_date", "Activity Date", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("activity_date") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::date("activity_date", now(), ["wire:model" => "activity_date", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("activity_date") ? "border-red-400" : "")]),
                ]),
            ]),
            "form_bottom_buttons" => [
                "submit" => Form::submit("Create"),
            ]
        ]);

        return view('livewire.seminar-create', compact("inputs"));
    }
}
