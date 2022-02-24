<?php

namespace App\Http\Livewire\Parent;

use App\Models\Child;
use App\Models\Vaccination;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Overview extends Component
{
    public Child $selected;
    public ?Child $creating = null;
    public ?Child $deleting = null;

    public Vaccination $selectedVax;
    public ?Vaccination $creatingVax = null;
    public ?Vaccination $deletingVax = null;

    public function render()
    {
        return view('livewire.parent.overview', [
            'children' => Auth::user()->children()->get(),
            'country' => Auth::user()->country()->first(),
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
        $this->dispatchBrowserEvent('close-modal');
        $this->creating = null;
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
        $this->dispatchBrowserEvent('confirm-removal-child');
    }

    public function removeChild()
    {
        $this->deleting->delete();
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->deleting = null;
        $this->dispatchBrowserEvent('close-modal');
    }


    ///////////////////////////////////////////////
    public function addVaccination()
    {
        $this->creatingVax = new Vaccination();
        $this->dispatchBrowserEvent('add-vaccination');
    }

    public function saveVaccination()
    {
        $this->validate();
        Auth::user()->country()->vaccinations()->save($this->creatingVax);
        $this->dispatchBrowserEvent('close-modal');
        $this->creatingVax = null;
    }



    public function confirmRemovalVaccination(Vaccination $vaccination)
    {
        $this->deletingVax = $vaccination;
        $this->dispatchBrowserEvent('confirm-removal-vaccination');
    }

    public function removeVaccination()
    {
        $this->deletingVax->delete();
        $this->closeModal();
    }
}
