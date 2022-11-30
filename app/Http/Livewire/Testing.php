<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Testing extends Component
{
    public $count = 0;

    public function render()
    {
        return view('livewire.testing');
    }

    public function increment()

    {

        $this->count++;

    }
}
