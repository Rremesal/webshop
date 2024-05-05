<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserOverview extends Component
{
    public string $search = '';


    public function render()
    {
        $users = User::where('first_name', 'LIKE', '%'.$this->search.'%')->orWhere('last_name', 'LIKE', '%'.$this->search.'%')->get();
        return view('livewire.user-overview', ['users' => $users]);
    }
}
