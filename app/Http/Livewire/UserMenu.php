<?php

namespace App\Http\Livewire;

use App\Models\Rent;
use Livewire\Component;

class UserMenu extends Component
{
    public $rentc;

    public function mount()
    {
        $this->rentc =
            $result = Rent::select('rents.*', 'bikes.*', 'users.*')
                ->join('users', 'users.id', '=', 'rents.user_id')
                ->join('bikes', 'bikes.id', '=', 'rents.bike_id')
                ->where('user_id', auth()->user()->id)
                ->where('status', 'On Rent')
                ->whereIn('rental_status', ['Pending', 'Approved'])
                ->pluck('status');

        $this->rentc = $this->rentc->toArray();
    }

    public function render()
    {
        return view('livewire.user-menu');
    }
}
