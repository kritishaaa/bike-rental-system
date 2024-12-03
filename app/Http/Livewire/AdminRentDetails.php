<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Bike;
use App\Models\Rent;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\BikeStatusMail;
use Illuminate\Support\Facades\Mail;

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
public $user;
    public function tooglerentdialog($id)
    {
        
        if ($this->rentdialog == 'hide') {
            $this->rentdialog = 'show';

            $this->rent1 = Rent::find($id);
            $this->user = User::find($this->rent1['user_id']);

            $this->rentalpayments = $this->rent1->toArray();
        } else {
            $this->rentdialog = 'hide';
        }
    }

    public function saverentaltransaction()
    {
    
        try {

            $this->validate([
                'rentalpayments.rental_status' => 'required|string',
                'rentalpayments.payment_method' => 'required|string',
                'rentalpayments.deposit_document_name' => 'nullable|string|max:255', // Validation for document name
                'rentalpayments.refund' => 'nullable|numeric',
            ]);
    
            $data = [
                'rental_status' => $this->rentalpayments['rental_status'],
                'payment_method' => $this->rentalpayments['payment_method'],
                'deposit_document_name' => $this->rentalpayments['deposit_document_name'] ?? null, // Add document name to data
            ];
            if($this->rentalpayments['rental_status'] == "On Rent"){
                
                try {
                    $user = $this->rent1['user']; 
                    $toDate = $this->rent1['rent_to_date']; 
                    
                    Mail::to($user->email)->send(new BikeStatusMail($user->name, $this->rent1['bike_name'], $toDate));
                    
                    logger('Email sent successfully!');
                } catch (\Exception $e) {
                    logger('Error sending email: ' . $e->getMessage());
                }
              
                }

            if ($data['rental_status'] == 'Marked_as_return') {
                $bike = Bike::find($this->rent1['bike_id']);
                if ($bike) {
                    $bike->status = 'Available';
                    $bike->save();
                }
            }
    
            $rental = Rent::find($this->rentalpayments['id']);
            if ($rental) {
                $rental->update($data);
            }

            session()->flash('success', 'Rental and Payment Status Updated Successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    
    
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
