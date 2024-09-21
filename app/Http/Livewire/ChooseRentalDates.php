<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class ChooseRentalDates extends Component
{
    public $from_min_date;

    public $from_max_date;

    public $to_min_date;

    public $date;

    public $from_date;

    public $to_date;

    public $err_msg;

    public function mount()
    {
        $this->date = Carbon::now();
        $this->from_min_date = Carbon::now();

        $this->from_min_date = $this->from_min_date->toDateString();
    }

    public function updated()
    {
        if ($this->from_date > $this->to_date) {
            $this->err_msg = 'Please Select from date less than to date';
        }
    }

    public function submit()
    {

        if (empty($this->from_date) || empty($this->to_date)) {

            $this->err_msg = 'Please Select the rental Dates';
        } else {
            session()->put('from_date', $this->from_date);
            session()->put('to_date', $this->to_date);

            return redirect(route('renter.showbikes'));
        }
    }

    public function render()
    {

        return view('livewire.choose-rental-dates');
    }
}
