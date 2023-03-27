<?php

namespace App\Http\Livewire;

use App\Models\Vgroup;
use Livewire\Component;

class Vehicle extends Component
{
    public $currentPage = 1;
    public $type, $vehicle_groups= [];


    public function mount()
    {
    }

    public function updated() {
//        $('#vehicle_groups').select2();
        $this->dispatchBrowserEvent('contentChanged');

    }

    public function render()
    {
        $vehicleGroups = Vgroup::get(['id', 'group_name']);
        return view('admin.livewire.vehicle', compact('vehicleGroups'));
    }

    public function gotToNextPage()
    {
        if ($this->currentPage === 1) {
            $this->validate([
                'type' => ['required'],
                'vehicle_groups' => ['required']
            ]);

        } elseif ($this->currentPage === 2) {

        } else {

        }
        $this->currentPage++;
    }

    public function gotToPreviousPage()
    {
        $this->currentPage--;
    }


    public function submitForm()
    {
        $this->currentPage = 1;
    }

    public function hydrate()  // hydrate the select2 element on every re-render
    {
        $this->emit('select2');
    }

    public function selected_select2_item($value)  // function load from listener
    {
        dd($value);
    }
}
