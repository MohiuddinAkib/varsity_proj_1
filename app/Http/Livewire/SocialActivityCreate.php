<?php

namespace App\Http\Livewire;

use Form;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use SocialActivity;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Exceptions\SocialActivityOnSameLocationAndDateAlreadyExistsException;

class SocialActivityCreate extends Component
{
    use AuthorizesRequests;

    public string $form_method = "saveSocialActivity";
    public string $card_title = "create social activity";

    public string $name = "";
    public string $location = "";
    public string $volunteers = "";
    public string $type = "education";
    public string $activity_date = "";
    public array $volunteer_list = [];
    public string $organization_id = "";

    protected function getRules()
    {
        return [
            "name" => ["string", "required"],
            "type" => ["string", "required", Rule::in(["education", "employee_seminar", "food_donation", "welfare", "money_donation", "cloth_distribution"])],
            "location" => ["string", "required"],
            "activity_date" => ["date", "required"],
            "volunteers" => ["string", "required"],
            "organization_id" => ["required", "exists:App\Models\Organization,id"],
        ];
    }

    public function mount()
    {
        $this->fill([
            "organization_id" => auth()->user()->organization->id
        ]);
    }

    public function saveSocialActivity()
    {
        $this->volunteer_list = Str::of($this->volunteers)->explode(",")->map(fn($name) => Str::of($name)->trim())->toArray();
        $this->validate();
        try {
            SocialActivity::create($this->name, $this->type, $this->location, $this->activity_date, $this->organization_id, $this->volunteer_list);
            session()->flash("success", "Successfully created organization");
        } catch (SocialActivityOnSameLocationAndDateAlreadyExistsException $e) {
            session()->flash("error", $e->getMessage());
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
                "volunteers" => collect([
                    "label" => Form::label("volunteers", "Volunteers", ["class" => "block font-medium text-sm text-gray-700" . ($errors->has("volunteers") ? " font-weight-bold text-red-400" : "")]),
                    "input" => Form::text("volunteers", null, ["wire:model" => "volunteers", "class" => "w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " . ($errors->has("volunteers") ? "border-red-400" : "")]),
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

        return view('livewire.social-activity-create', compact("inputs"));
    }
}
