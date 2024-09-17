<div>
    <div>

        <div id="loader">


        </div>

        <div>
            {{-- Stop trying to control. --}}




            <div class="p-4 shadow-md shadow-black">
                <h2 class="text-3xl font-semibold text-center">Bike Details</h2>

                <div
                    class="flex flex-row justify-center items-center gap-4 m-5 shadow-sm shadow-gray-800 rounded-md py-8">

                    <div>

                        <img src="{{ 'storage/variant_images/' . $bike->variant->variant_image }}" alt=""
                            class="w-[350px] h-[300px] object-cover">

                        <div class="flex flex-row gap-4 justify-center">
                            <div>
                                <p>From date</p>
                                <input type="date" min="{{ date('Y-m-d') }}" name="" id=""
                                    class="w-[100%] bg-slate-200 rounded" wire:model="from_date"
                                    @if (session()->get('from_date')) value="{{ $from_date }}" readonly @endif>
                            </div>
                            <div>
                                <p>To date</p>
                                <input type="date" name="" id=""
                                    class="w-[100%] bg-slate-200 rounded" wire:model="to_date"
                                    @if (session()->get('to_date')) value="{{ $to_date }}" readonly @endif>
                            </div>
                        </div>
                        @if ($dateerror)
                            <div class="flex flex-row justify-center py-1"> <span
                                    class="text-red-600 text-sm">{{ $dateerror }}</span></div>
                        @endif

                    </div>

                    <div>
                        <div class="font-normal  grid grid-cols-2 gap-6 text-md ">
                            <div>
                                <ul>
                                    <li>Bike Name:</li>
                                    <li>Bike Brand:</li>
                                    <li>Bike Variant:</li>
                                    <li>Rental Price Per Day:</li>
                                    <li>Bike cc:</li>
                                    <li>Bike Rides :</li>
                                    <li>Bike Model Year: </li>
                                    <li>Bike Number Plate</li>
                                    <li>View Bill Book:</li>

                                </ul>
                            </div>
                            <div>
                                <ul>
                                    <li>{{ $bike->number_plate }}</li>
                                    <li>{{ $bike->variant->brand->brand_name }}</li>
                                    <li>{{ $bike->variant->variant_name }}</li>
                                    <li>{{ $bike->variant->variant_rental_price }}</li>
                                    <li>{{ $bike->cc }}</li>
                                    <li>{{ $rentcounts }}</li>
                                    <li>{{ $bike->model_year }}</li>
                                    <li>Bike Number Plate</li>
                                    <li>View <button class="bg-gray-900 text-white py-0.5 px-3 text-sm rounded"
                                            wire:click="billbookdialog">Click me</button></li>

                                </ul>
                            </div>

                        </div>
                        <Button class="min-w-full text-white rounded py-1.5 hover:bg-black my-4  bg-slate-700"
                            wire:click="toogle">Rent Bike</Button>
                    </div>

                </div>



                <div
                    class="w-screen h-screen {{ $billbookdisplay }} top-0 right-0 backdrop-blur-sm bg-opacity-70 bg-gray-300 flex justify-center items-center">

                    <div class="bg-white">

                        <div class="bg-white rounded relative p-2">
                            <button type="button" wire:click="billbookdialog(2)" class=" absolute top-2 right-2"> <i
                                    class="fa fa-times hover:bg-black hover:text-white rounded-full p-1"
                                    aria-hidden="true"></i>
                            </button>
                            <p class="text-lg font-semibold p-3">BillBook View</p>
                            <hr class="h-1">

                            <div class="h-[400px] overflow-y-auto min-w-[600px]">
                                <img src="{{ asset($image_url) }}" alt="image" class="w-full object-contain">
                            </div>
                        </div>
                    </div>
                </div>

                @if ($rentdialog == 'show')
                    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded-lg shadow-lg">
                            <div class="flex items-center justify-center mb-3">
                                <svg class="animate-spin h-6 w-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.843 3.029 7.971l2.03-2.03zM12 20a8 8 0 100-16 8 8 0 000 16z">
                                    </path>
                                </svg>
                                <span class="text-blue-500 font-semibold">Please wait...</span>
                            </div>
                            <p class="text-gray-600">Rental Process is Proccessing.....</p>
                        </div>
                    </div>
                @endif



                @if ($recommendedbikes)

                    <div class=" m-5 shadow-sm shadow-gray-800 rounded-md py-5">
                        <h2 class="text-2xl font-semibold text-center pb-3">Recommentdation Bikes</h2>

                        <div class="flex flex-row text-sm justify-center gap-4">
                            @forelse ($recommendedbikes as $rbike)
                                <div class="flex flex-row gap-3 border-2 w-60 rounded">
                                    <div>
                                        <img src="{{ asset('storage/variant_images/' . $rbike->variant->variant_image) }}"
                                            alt="image" class="w-[100px] h-[180px] object-contain">

                                    </div>
                                    <div>
                                        <ul>
                                            <li>
                                                <p>{{ $rbike->variant->brand->brand_name }}</p>
                                            </li>
                                            <li>
                                                <p>{{ $rbike->variant->variant_name }}</p>
                                            </li>
                                            <li>
                                                <p>Rental Price: {{ $rbike->variant->variant_rental_price }}</p>
                                            </li>
                                            <li>
                                                <p>cc: {{ $rbike->cc }}</p>
                                            </li>
                                        </ul>
                                        <form ction="{{ route('renter.bikedetails') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="bike_id" value="{{ $rbike->id }}">
                                            <button type="submit"
                                                class="bg-slate-600 text-white hover:bg-black text-ellipsis min-w-full px-3 rounded-sm align-middle ">View
                                                Details</button>

                                        </form>
                                    </div>
                                </div>
                                @php
                                    if ($loop->iteration == 3) {
                                        break;
                                    }
                                @endphp

                            @empty

                                <h2 class="text-xl font-mono text-center pb-3">No Bikes Availables</h2>
                            @endforelse



                        </div>


                @endif
                <div>

                </div>


            </div>
        </div>

        @if ($toogledialog == 'show')
            <div class=" fixed  top-0 h-screen w-screen backdrop-blur-[10px] flex justify-center items-center"
                id="resultdialog">
                <div class="bg-white inline-block p-6 rounded relative shadow-2xl shadow-black hover:scale-105">
                    <button class="absolute top-2 right-4" wire:click="toogle()" title="close dialog"><i
                            class="fas fa-times scale-110 rounded"></i>
                    </button>

                    <p class="text-xl font-semibold text-center p-3">Rental Billing Details </p>
                    <hr class="bg-slate-900">
                    <div class="grid grid-cols-2 gap-5 p-3">

                        <div>
                            <ul>
                                <li>Bike varinat:</li>
                                <li>Bike number:</li>
                                <li>From date:</li>
                                <li>To date:</li>
                                <li>Rental price:</li>
                                <li>Rental Days: </li>
                                <li>Total Rental Price :</li>
                            </ul>
                        </div>

                        <div>
                            <ul>
                                <li>{{ $bike->variant->variant_name }}</li>
                                <li>{{ $bike->number_plate }}</li>
                                <li>{{ $from_date }} </li>
                                <li>{{ $to_date }} </li>
                                <li>Rs {{ $bike->variant->variant_rental_price }}</li>
                                <li>{{ $rentaldays }} </li>
                                <li>Rs {{ $total_rental_price }} </li>
                            </ul>
                        </div>

                    </div>

                    <div>
                        <h1 class="font-semibold">Payment Methods</h1>
                        <div class="flex flex-row justify-center gap-3 py-1">
                            <button class="bg-slate-800 hover:bg-black text-sm px-3 py-0.5 rounded-sm text-white"
                                wire:click="checkout">Cash on Hand
                                <small>(Credit)</small>
                            </button>
                            <button class="bg-violet-950 hover:bg-violet-500  text-sm px-3 py-0.5 rounded-sm text-white"
                                id="payment-button">Pay
                                with Khalti</button>
                        </div>
                    </div>



                    @if ($checkout == 'show')
                        <div class="flex flex-col justify-center">
                            <p class="text-slate-950 text-center font-semibold p-2 text-sm">Are you sure to Check out ?
                            </p>
                            <button class="bg-slate-500 text-white text-sm hover:bg-black rounded  px-3 py-1"
                                wire:click="rentbike">Rent Bike on Cash on Hand</button>
                        </div>
                    @endif

                </div>
        @endif


    </div>

    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_018852f60fab4f69a4c7e0ee6351c724",
            "productIdentity": "{{ $bike->number_plate }}",
            "productName": "{{ $bike->variant->variant_name }}",
            "productUrl": "http://127.0.0.1:8000/bikedetails",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
            ],
            "eventHandler": {
                onSuccess(payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('khaltirent') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            data: payload,
                        },
                        dataType: 'json',
                        success: function(response) {
                            // Handle the success response

                            console.log(response);

                            window.location.href = response.redirectto;

                        },
                        error: function(xhr, status, error) {
                            // Handle the error
                            console.log(error);
                        }
                    });
                },
                onError(error) {
                    console.log(error);
                },
                onClose() {
                    console.log('widget is closing');

                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function() {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({
                amount: {{ $total_rental_price * 10 }}
            });
        }
    </script>

</div>

</div>

</div>
