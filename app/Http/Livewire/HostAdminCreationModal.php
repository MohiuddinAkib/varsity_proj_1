<?php

namespace App\Http\Livewire;

use App\Facades\User;
use Livewire\Component;

class HostAdminCreationModal extends Component
{
    /**
     * @var boolean
     */
    public $isOpen;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $password_confirmation;
    /**
     * @var string
     */
    public $contact_number;

    protected $listeners = ["toggle" => "toggle"];

    protected $rules = [
        "name" => ["required", "string"],
        "email" => ["required", "email", "unique:users,email"],
        "password" => ["required", "string", "min:8", "confirmed"],
        "contact_number" => ["required", "string", "min:11", "max:14"],
    ];

    public function mount(bool $open)
    {
        $this->fill([
            "isOpen" => $open
        ]);
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function saveUser()
    {
        $this->validate();

        User::createHostAdmin($this->name, $this->email, $this->contact_number, $this->password);

        $this->reset([
            "name",
            "email",
            "password",
            "password_confirmation",
            "contact_number",
        ]);
    }

    public function render()
    {
        return view('livewire.host-admin-creation-modal');
    }
}
