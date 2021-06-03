<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SeminarList extends Component
{
    public string $page_title = "seminar";

    public function render()
    {
        return view('livewire.seminar-list');
    }
}
