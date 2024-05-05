<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesOverview extends Component
{
    public ?Role $selectedRole = null;
    public string $search = '';

    public function mount($role) {
        $this->selectedRole = $role;
    }
    public function render()
    {
        $roles = Role::where('name', 'like', '%'.$this->search.'%')->get();
        return view('livewire.roles-overview', ['roles' => $roles]);
    }
}
