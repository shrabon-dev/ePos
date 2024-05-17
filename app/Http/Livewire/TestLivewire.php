<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestLivewire extends Component
{
    public $select_dropdown_value;
    public $testValue;
    public function updatedSelectDropdownValue($id){
        $this->testValue = $id;
    }
    public function render()
    {
        return view('livewire.test-livewire');
    }
}
