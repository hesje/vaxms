<?php

namespace App\Http\Livewire\Parent;

use App\Models\Child;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Overview extends Component
{
    public Child $selected;
    public ?Child $creating = null;
    public ?Child $deleting = null;

    public function render()
    {
        return view('livewire.parent.overview', [
            'children' => Auth::user()->children()->get(),
        ]);
    }

    public function selectChild(Child $child)
    {
        $this->selected = $child;
    }

    public function addChild()
    {
        $this->creating = new Child();

        $this->dispatchBrowserEvent('add-child');
    }

    public function saveChild()
    {
        $this->validate();
        Auth::user()->children()->save($this->creating);
    }

    public function rules()
    {
        return [
            'creating.name' => 'required|string|max:100|min:2',
            'creating.dob' => 'required|date|before_or_equal:today',
        ];
    }

    public function confirmRemoval(Child $child)
    {
        $this->deleting = $child;
        $child->dispatchBrowserEvent('confirmRemoval-child');
    }

    public function removeChild()
    {
        $this->deleting->delete();
    }

    public function closeModal()
    {
        $deleting = null;
        dispatchBrowserEvent('close-modal');
    }
}
