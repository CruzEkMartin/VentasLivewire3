<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ver usuario')]
class UserShow extends Component
{

    public User $usuario;

    public function render()
    {
        return view('livewire.user.user-show');
    }
}
