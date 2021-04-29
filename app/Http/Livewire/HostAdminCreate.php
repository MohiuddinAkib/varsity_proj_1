<?php

namespace App\Http\Livewire;

use App\Facades\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class HostAdminCreate extends Component
{
    use AuthorizesRequests;

    public Collection $inputs;
    public string $form_method = "saveUser";
    public string $card_title = "create host admin";

    public string $name = "";
    public string $email = "";
    public string $password = "";
    public string $password_confirmation = "";
    public string $contact_number = "";

    protected array $rules = [
        "name" => ["string", "required"],
        "password" => ["min:8", "required", "confirmed"],
        "contact_number" => ["string", "required", "min:11", "max:14"],
        "email" => ["email", "required", "unique:App\Models\User,email"],
    ];

    public function mount()
    {
        $this->fill([
            "inputs" => collect([
                "name" => ([
                    "label" => "Name",
                    "type" => "text"
                ]),
                "email" => ([
                    "label" => "Email",
                    "type" => "email"
                ]),
                "password" => ([
                    "label" => "Password",
                    "type" => "password"
                ]),
                "password_confirmation" => ([
                    "label" => "Password Confirmation",
                    "type" => "password"
                ]),
                "contact_number" => ([
                    "label" => "Contact Number",
                    "type" => "text"
                ]),
            ])
        ]);
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
        return view("livewire.host-admin-create");
    }
}
