<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Ver usuario')]
class UserShow extends Component
{
    use WithPagination;

    public User $usuario;

    public function render()
    {
        $sales = $this->usuario->sales()->paginate(5);

        return view('livewire.user.user-show', compact('sales'));
    }

}
