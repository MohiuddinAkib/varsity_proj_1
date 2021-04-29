<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrganizationList extends Component
{
    public string $page_title = "organization";

    public function render()
    {
        return view('livewire.organization-list');
    }
}
