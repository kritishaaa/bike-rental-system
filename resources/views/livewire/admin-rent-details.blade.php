<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="flex flex-row space-x-2 py-6 min-w-full justify-center shadow-lg">
        @php
            $sn = 1;
        @endphp

        <div>
            <div class="flex flex-row justify-between items-center">
                <div>
                    <label for="entries" class="text-sm m-2">Show</label>
                    <select id="entries" name="entries" class="text-sm m-2" wire:model="entries">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                    <span class="text-sm">Entries</span>
                </div>

                <div class="flex gap-6 items-center">
                    <div>
                        <span class="text-sm">Select By Payment Method</span>
                        <select id="rental-status" name="rental-status"
                            class="rounded bg-gray-300 flex items-center py-1 px-4" wire:model="paymentmethod">
                            <option disabled>--select--</option>
                            <option value="">Show all</option>
                            <option value="Credit">Credit</option>
                            <option value="Cash on Hand">Cash on Hand</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div>
                        <span class="text-sm">Select By Rental Status</span>
                        <select id="rental-status" name="rental-status"
                            class="rounded bg-gray-300 flex items-center py-1 px-4" wire:model="rentalstatus">
                            <option disabled>--select--</option>
                            <option value="">Show all</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Marked_as_return">Marked as Return</option>
                            <option value="Reject">Reject</option>
                        </select>
                    </div>
                    <a href="{{ route('rents.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md">Add
                        Rent</a>
                </div>
            </div>

            <table class="divide-y divide-gray-700">
                <thead class="bg-gray-200 py-3">
                    <tr>
                        <th class="p-3">Sn</th>
                        <th class="p-3">Renter Name</th>
                        <th class="p-3">Rental Bike</th>
                        <th>Rental Number</th>
                        <th class="p-3">Booking Date</th>
                        <th class="p-3">From Date</th>
                        <th class="p-3">To Date</th>
                        <th class="p-3">Total Rental Price</th>
                        <th class="p-3">Payment Method</th>
                        <th class="p-3">Rental Status</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rents as $rent)
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td><a href="">{{ $rent->user->name }}</a></td>
                            <td><a href="">{{ $rent->bike->number_plate }}</a></td>
                            <td>{{ $rent['rental_number'] }}</td>
                            <td>{{ $rent['created_at']->diffForHumans() }}</td>
                            <td>{{ $rent['rent_from_date'] }}</td>
                            <td>{{ $rent['rent_to_date'] }}</td>
                            <td class="text-center">Rs {{ $rent['total_rental_price'] }}</td>

                            <td>
                                <div class="flex gap-3">
                                    <p class=" p-2  rounded-sm ">{{ $rent['payment_method'] }}</p>

                                </div>
                            </td>
                            @php
                                $status = str_replace('_', ' ', $rent->rental_status);
                            @endphp
                            <td class="text-center"> {{ $status }}</td>
                            <td>

                                <button class="bg-blue-500 text-xs text-white px-2 py-[1px] min-w-fit rounded block"
                                    title="Click here to switch payment mode to paid"
                                    wire:click="tooglerentdialog({{ $rent['id'] }})">Change status</button>


                                {{--                
                @if ($rent['status'] == 'Payment Pending')
              <div class="flex flex-row gap-2 p-3">
                  <button class="bg-blue-500 text-xs text-white px-2 py-[1px] min-w-fit rounded block" title="Click here to switch payment mode to paid" wire:click="switchtopaid({{ $rent['id'] }})">Approve</button>
                <a href="#" class="bg-red-500 text-white py-1 px-2 text-sm rounded-sm" wire:click="switchtoreject({{ $rent['id'] }})">Reject</a>
              </div>
              @elseif($rent['status'] == 'Paid')
                <div class="flex flex-row gap-2 p-3">
                <button class="bg-blue-500 text-white py-0.5 px-2 text-xs rounded-sm  ">Mark as Return</button>
                <button class="bg-red-500 text-white py-1 px-2 text-xs rounded-sm">Cancel Rent</button>
              </div>
              @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $rents->links() }}
        </div>

    </div>

    @if ($rentdialog == 'show')


        <div class="fixed top-0 left-0 w-screen h-screen backdrop-blur-sm flex flex-row justify-center items-center">


            <div class="bg-white rounded shadow-md shadow-slate-700 p-4 relative {{ $display }}">
                <button wire:click="tooglerentdialog(2)"> <i
                        class="fa fa-times hover:bg-black hover:text-white p-1 rounded-full absolute top-2 right-2"
                        aria-hidden="true"></i>
                </button>

                <h2 class="text-xl font-semibold mt-4 p-3 rounded-sm">Rental Transaction Information</h2>
                <hr class="h-0.5 bg-black">
                <p class="my-3">Rental Number: {{ $rent1->rental_number }}</p>
                <p class="my-3">Rental Status: {{ $rent1->rental_status }}</p>
                <form wire:submit.prevent="saverentaltransaction">

                    <div class="flex flex-col gap-3 mt-4">

                        <div class=" grid grid-cols-2 content-center items-center gap-2">

                            <div class="flex flex-col align-middle gap-4 justify-center">
                                <label for="">Payment Method</label>
                                @if ($rentalpayments['payment_method'] != 'Credit')
                                    <label for="">Rental Status</label>
                                    <label for="" class=" {{ $refundclass }} ">Refund Amount <br>
                                        <center><small>(Optional)</small></center>
                                    </label>
                                @endif
                            </div>
                            <div class="flex flex-col justify-center gap-2">
                                <select name="" id="" class="rounded scale-90"
                                    wire:model.lazy="rentalpayments.payment_method">

                                    {{-- {{-- <option @if ($rent1->status == 'Payment Pending') selected @endif   value="Payment Pending">Payment Pending</option> --}}
                                    <option @if ($rent1->payment_method == 'Credit') selected @endif value="Credit">Credit
                                    </option>
                                    <option @if ($rent1->payment_method == 'Cash on Hand') selected @endif value="Cash on Hand">Cash
                                        on
                                        Hand</option>
                                    <option @if ($rent1->payment_method == 'Online') selected @endif value="Online">Online
                                    </option>
                                </select>

                                @if ($rentalpayments['payment_method'] != 'Credit')
                                    <select name="" id="" class="rounded scale-90"
                                        wire:model.lazy="rentalpayments.rental_status">
                                        <option @if ($rent1->rental_status == 'Pending') selected @endif value="Pending">
                                            Pending</option>
                                        <option @if ($rent1->rental_status == 'Approved') selected @endif value="Approved">
                                            Approve on Rent</option>
                                        <option @if ($rent1->rental_status == 'Marked_as_return') selected @endif
                                            value="Marked_as_return">Mark as Return</option>
                                        <option @if ($rent1->rental_status == 'Reject') selected @endif value="Reject">Reject
                                        </option>
                                    </select>
                                    <input type="number" placeholder="Refund Amount" wire:model="rentalpayments.refund"
                                        class="rounded scale-90 {{ $refundclass }}">
                                @endif
                            </div>

                        </div>


                        <button class="text-white py-1 rounded bg-black" wire:loading.attr="disabled">
                            <i class="animate-spin fa fa-spinner" aria-hidden="true" wire:loading></i>

                            Save
                        </button>


                    </div>

                </form>
            </div>

        </div>
    @endif
</div>
