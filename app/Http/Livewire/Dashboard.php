<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class Dashboard extends Component
{
    use WithPagination;

    public string $page_title = "dashboard";

    public function mount()
    {
    }

    public function render()
    {
        return view("livewire.dashboard", [
            "host_admins" => User::role("host_admin")->latest()->paginate()
        ]);
    }
}
