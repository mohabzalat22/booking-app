<?php

namespace App\Livewire;

use Livewire\Component;

class ToastSuccessComponent extends Component
{
    public $message;
    public function render()
    {
        return view('livewire.toast-success-component');
    }

    public function mount($message)
    {
        $this->message = $message;
    }
}
