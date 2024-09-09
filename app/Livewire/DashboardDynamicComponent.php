<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardDynamicComponent extends Component
{
    public $component = 'profile';
    public function change($e){
        switch($e){
            case 'profile':
                $this->component = $e;
                break;

            case 'tickets':
                $this->component = $e;
                break;
                
            case 'wallets':
                $this->component = $e;
                break;
        }

    }
    public function render()
    {
        return view('livewire.dashboard-dynamic-component',['component'=>$this->component]);
    }
}
