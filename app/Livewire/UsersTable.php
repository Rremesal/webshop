<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UsersTable extends Component
{
    public Collection $users;

    public function mount($users) {
        $this->users = $users;
    }


    public function render()
    {
        $this->users = User::all();

        return view('livewire.users-table', ['users' => $this->users]);
    }
}
