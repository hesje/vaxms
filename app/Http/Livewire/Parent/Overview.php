<?php

namespace App\Http\Livewire\Parent;

use Livewire\Component;

class Overview extends Component
{
    public $childname = '';

    public function render()
    {
        return view('livewire.parent.overview');
    }

    public function selectChild(String $name)
    {
        $this->childname = $name;
    }

    public function addChild()
    {

    }
}
