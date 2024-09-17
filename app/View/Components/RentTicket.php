<?php

namespace App\View\Components;

use App\Models\Rent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RentTicket extends Component
{
    /**
     * Create a new component instance.
     */
    public $rent, $rentalbike;
    public function __construct()
    {
        //
        $this->rent = Rent::find(2);
        $this->rentalbike = $this->rent;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rent-ticket');
    }
}
