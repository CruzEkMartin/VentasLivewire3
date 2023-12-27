<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Messages extends Component
{
    public function render()
    {
        return view('livewire.messages');
    }

    //cuando se emita un evento msg
    #[On('msg')]
    public function msgs($msg)
    {
        session()->flash('msg', $msg);
    }
}
