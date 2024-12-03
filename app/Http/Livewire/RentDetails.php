<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Bike;
use App\Models\Rent;
use Livewire\Component;
use Livewire\WithPagination;

class RentDetails extends Component
{
    use WithPagination;

    public $tickettoogle = 'hide';

    public $i_id;

    public $rentalbike;

    public $rentalstatus;

    public $paymentmethod;

    public $bikesinputs = [];

    public function tickettoogle($id)
    {

        if ($this->tickettoogle == 'show') {
            $this->tickettoogle = 'hide';
        } elseif ($this->tickettoogle == 'hide') {
            $this->tickettoogle = 'show';
            $this->i_id = $id;
            $this->rentalbike = Rent::find($id);
        }
    }
    public function cancelrent($id)
    {

        $rental = Rent::find($id);
    
        if ($rental) {
            // Delete the rental record
            $rental->delete();
            session()->flash('message', 'Rent successfully canceled.');
    
            $this->render();
        } else {
            // Show an error message if the record doesn't exist
            session()->flash('error', 'Rent not found.');
        }
    }
    

    public function exportpdf()
    {

        dd($this->rentalbike);
    }

    public function render()
    {

        $rawrent = Rent::where('user_id', '=', auth()->user()->id);
        $rents = Rent::when($this->bikesinputs, function ($q) {
            $q->whereIn('bike_id', $this->bikesinputs);
        })->when(
            $this->paymentmethod,
            function ($q1) {
                $q1->where('payment_method', '=', $this->paymentmethod);
            }

        )->when(
            $this->rentalstatus,
            function ($q1) {
                $q1->where('rental_status', '=', $this->rentalstatus);
            }

        )->where('user_id', '=', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $bikesdata = $rawrent->groupBy('rents.bike_id')->pluck('rents.bike_id');

        $bikes = Bike::whereIn('id', $bikesdata)->get();

        return view('livewire.rent-details', compact('rents', 'bikes'));
    }
}
