<?php

namespace App\Livewire;

use Livewire\Component;

class DatetimeFilter extends Component
{
    public $start = "";
    public $end = "";
    
    public function render()
    {
        return view('livewire.datetime-filter',['start'=>$this->start]);
    }
}
