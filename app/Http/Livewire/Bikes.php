<?php

namespace App\Http\Livewire;

use App\Models\Bike;
use Livewire\Component;

class Bikes extends Component
{
    public $sn = 1;

    public $image_url;

    public $rentalstatus;

    public $billbookdialog = 'hide';

    public $items = 10;

    public function billbookdialog($id)
    {

        if ($this->billbookdialog == 'hide') {

            $this->billbookdialog = 'show';
            $bike = Bike::find($id);
            $this->image_url = 'storage/bike_images/'.$bike['billbook'];

        } else {

            $this->billbookdialog = 'hide';

        }

    }

    public function render()
    {

        $bikes = Bike::when($this->rentalstatus, function ($q) {
            $q->where('status', '=', $this->rentalstatus);
        })->orderBy('id', 'DESC')->paginate($this->items);

        return view('livewire.bikes', compact('bikes'));
    }
}
