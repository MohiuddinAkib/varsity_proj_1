<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SocialActivityList extends Component
{
    public string $page_title = "social activity";

    public function render()
    {
        return view('livewire.social-activity-list');
    }
}
