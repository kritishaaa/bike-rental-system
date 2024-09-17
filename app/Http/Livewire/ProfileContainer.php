<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ProfileContainer extends Component
{
    public $user;
    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
    }
    public function render()
    {
        return view('livewire.profile-container');
    }
}
