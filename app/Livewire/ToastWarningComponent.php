<?php

namespace App\Livewire;

use Livewire\Component;

class ToastWarningComponent extends Component
{
    public $message;
    public function render()
    {
        return view('livewire.toast-warning-component');
    }

    public function mount($message)
    {
        $this->message = $message;
    }
}
