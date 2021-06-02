<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class LocalAdminList extends Component
{
    use AuthorizesRequests;

    public string $page_title = "local admin";

    public function handleUserDelete(User $user)
    {
        dd($user);

        $this->authorize("delete-local-admin");

    }

    public function render()
    {
        return view('livewire.local-admin-list', [
        ]);
    }
}
