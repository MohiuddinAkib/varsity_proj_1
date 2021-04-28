<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    /**
     * @var bool
     */
    public $openUserCreateModal = false;

    public function toggleUserCreationModal()
    {
        $this->syncInput("openUserCreateModal", !$this->openUserCreateModal);
        $this->emitTo("host-admin-creation-modal","toggle", $this->openUserCreateModal);
    }

    public function updatedOpenUserCreateModal($value)
    {
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
