<?php

namespace App\Http\Livewire;

use App\Models\Bike;
use App\Models\Rent;
use Livewire\Component;
use Livewire\WithPagination;

class AdminRentDetails extends Component
{
    use WithPagination;

    public $data = 'djhfd';

    public $paymentmethod;

    public $entries = 10;

    public $rentdialog = 'hide';

    public $rent1;

    public $rentalpayments = ['status' => '', 'payment_method' => '', 'refund'];

    public $refundclass = 'hidden';

    public $rentalstatus = [];

    public $isLoading = false;

    public $display = 'block';

    protected $rents;

    public function tooglerentdialog($id)
    {

        if ($this->rentdialog == 'hide') {
            $this->rentdialog = 'show';

            $this->rent1 = Rent::find($id);
            $this->rentalpayments = $this->rent1->toArray();
        } else {
            $this->rentdialog = 'hide';
        }
    }

    public function saverentaltransaction()
    {
        $this->isLoading = true;

        $data = [
            'rental_status' => $this->rentalpayments['rental_status'],
            'payment_method' => $this->rentalpayments['payment_method'],
        ];

        if ($data['rental_status'] == 'Marked_as_return') {
            $bike = Bike::find($this->rent1['bike_id']);
            $bike->status = 'Available';
            $bike->save();
        }

        Rent::find($this->rentalpayments['id'])->update($data);

        session()->flash('success', 'Rental and Payment Status Changed Successfully');
        // $this->tooglerentdialog($this->rentalpayments['id']);

        $this->isLoading = false;

        return redirect(route('rents.index'));
    }

    public function showrentalrequest()
    {
        $this->data = 'clicked';
    }

    public function render()
    {
        $rents = $this->rents = Rent::when($this->paymentmethod, function ($q1) {
            $q1->where('payment_method', '=', $this->paymentmethod);
        })->when($this->rentalstatus, function ($q1) {
            $q1->where('rental_status', '=', $this->rentalstatus);
        })->orderBy('id', 'desc')
            ->paginate($this->entries);

        return view('livewire.admin-rent-details', compact('rents'));
    }
}
