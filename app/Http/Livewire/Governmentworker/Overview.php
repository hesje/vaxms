<?php

namespace App\Http\Livewire\Governmentworker;

use App\Models\Country;
use App\Models\Vaccination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Overview extends Component
{
    public Country $country;
    public Vaccination $selectedVax;
    public ?Vaccination $creatingVax = null;
    public $deletingVax;
    public int $age = 0;

    public function render()
    {
        $this->country = Auth::check()? Auth::user()->country()->first() : Country::find(47);
        return view('livewire.governmentworker.overview');
    }

    public function rules()
    {
        return [
            'creatingVax.name' => 'required|string|max:100|min:2',
            'age' => 'required|integer|max:100|min:2',
        ];
    }

    public function addVaccination()
    {
        $this->creatingVax = new Vaccination();
        $this->dispatchBrowserEvent('add-vaccination');
    }

    public function saveVaccination()
    {
        $this->validate();
        $this->creatingVax->save();
        Auth::user()->country()->first()->vaccinations()->attach($this->creatingVax, ['age_at_administration'=> $this->age]);
        $this->dispatchBrowserEvent('close-modal');
        $this->creatingVax = null;
    }

    public function confirmRemovalVaccination($pivot_id)
    {
        $this->deletingVax = $pivot_id;
        $this->dispatchBrowserEvent('confirm-removal-vaccination');
    }

    public function removeVaccination()
    {
        DB::table('country_vaccination')->where('id', '=', $this->deletingVax)->delete();
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->deletingVax = null;
        $this->dispatchBrowserEvent('close-modal');
    }
}
