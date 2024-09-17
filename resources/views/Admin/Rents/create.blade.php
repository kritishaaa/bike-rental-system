@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        // Select disabled dates with the custom class
        var variant_rental_price = "";


        $(document).ready(function() {

            $(function() {
                $("#from_date").datepicker({
                    minDate: 0,
                    maxDate: "+20D"
                });


            });

            $(function() {
                $("#to_date").datepicker({
                    minDate: 0,
                    maxDate: "+20D"
                });


            });
        });
        // Change the background color of the child span element within disabled dates
    </script>


    @php
        $date = date('Y-m-d');
        $frommaxdate = date('Y-m-d', strtotime($date . ' + 15days'));
        $mintodate = date('Y-m-d', strtotime($date . ' + 1 days'));
        $maxtodate = date('Y-m-d', strtotime($date . ' + 30days'));
    @endphp

    <div>

        <p class="font-bold text-xl">Rent New Bike</p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('rents.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-4 p-3 shadow-lg rounded-lg border border-b-2 border-gray-600">


                <div>
                    <label for="" class="font-bold py-1">Choose Bike Form Rent</label>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label for="variant_rental_price">Choose Bike Brand</label>
                            <select name="brand" id="brand"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">--Select Brand--</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('variant_rental_price')" class="mt-2" />
                        </div>
                        <div>
                            <label for="variant_rental_price">Choose Bike Variant</label>
                            <select name="variant" id="variant"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">

                            </select>
                            <x-input-error :messages="$errors->get('variant_rental_price')" class="mt-2" />
                        </div>
                        <div>
                            <rental_price for="variant_rental_price">Choose Bike </rental_price>
                            <select name="bike" id="bike"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">

                            </select>
                            <x-input-error :messages="$errors->get('variant_rental_price')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 px-2">
                    <div>
                        <label for="from_date">Booking From date</label>
                        <input type="text" name="from_date" id="from_date"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ old('from_date') }}">
                        <x-input-error :messages="$errors->get('from_date')" class="mt-2" />

                        <script>
                            $(document).ready(function() {

                                $('#from_date').datepicker({
                                    dateFormat: 'yy-mm-dd',
                                    minDate: 0,
                                    onSelect: function(selectedDate) {
                                        $('#to_date').datepicker('option', 'minDate', selectedDate);

                                    }
                                });

                                $('#to_date').datepicker({
                                    dateFormat: 'yy-mm-dd',
                                    maxDate: "+30D"
                                });
                            });
                        </script>

                    </div>
                    <div>
                        <label for="to_date">Booking To date</label>
                        <input type="text" name="to_date" id="to_date" onchange="setValues()"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ old('to_date') }}">
                        <x-input-error :messages="$errors->get('to_date')" class="mt-2" />
                    </div>
                </div>


                <div class="p-2">
                    <label for="email" class="font-bold">Enter Renter Email</label>
                    <input type="text" name="email" id="email"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>


                <div>
                    <button class="bg-black text-white w-full rounded-lg py-2" onclick="toggle()" type="button">Add Bike on
                        Rent</button>
                </div>
            </div>

    </div>

    <div class=" p-5 w-screen h-screen rounded-lg fixed top-0 left-0 flex flex-row justify-center items-center bg-slate-400 bg-opacity-70 backdrop-blur-sm"
        id="billModal" style="display: none">
        <div class="bg-white p-5 rounded-md flex flex-col gap-2 " style="width: 32rem">
            <label for="" class="font-bold text-lg">Billing Details</label>
            <hr class="h-0.5 bg-black rounded-md">





            <div class="grid grid-cols-2 justify-items-stretch">
                <div>
                    <p class="text-sm">Rent price per Day: </p>
                    <p class="text-sm">Rental Days: </p>


                </div>
                <div class="flex flex-col items-end">
                    <p class="text-sm" id="rental_perday_price">---</p>
                    <p class="text-sm" id="rental_dates">---</p>


                </div>

            </div>
            <hr class="h-0.5 bg-slate-400">
            <div class="flex flex-row justify-between">
                <p class="text-sm">Total Rental Price: </p>
                <p class="text-sm" id="total_rental_price">---</p>
            </div>
            <div class="flex flex-row justify-center gap-3 pt-3">

                <input class="bg-black text-white t rounded-md py-2 px-4" type="submit" value="Rent New Bike">
                <Button class="bg-black text-white  rounded-md py-2 px-4" onclick="toggle()" type="button">Exit</Button>
            </div>
        </div>
    </div>
    </form>
    </div>






    <script>
        $(document).ready(function() {
            //brand>variant
            $('#brand').change(function() {
                // Get the selected option value
                var brand_id = $(this).val();

                // Create the data to be sent in the POST request
                var postData = {
                    brand_id: brand_id,
                    _token: "{{ csrf_token() }}"
                };

                // Send the POST request
                $.ajax({
                    type: 'POST',
                    url: '/getVariant',
                    data: postData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle the success response

                        // console.log(response);

                        $('#variant').html('<option  value="">-- Select Variant --</option>');
                        $.each(response, function(key, value) {
                            $("#variant").append('<option value="' + value['id'] +
                                '">' + value['variant_name'] + '</option>');
                        });
                        $('#bike').html('<option value="">-- Select Bike --</option>');
                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                        alert(error)
                    }
                });
            });

            //variant>bike

            $('#variant').change(function() {
                // Get the selected option value
                var variant_id = $(this).val();

                // Create the data to be sent in the POST request
                var bikeData = {
                    variant_id: variant_id,
                    _token: "{{ csrf_token() }}"
                };

                // Send the POST request
                $.ajax({
                    type: 'POST',
                    url: '/getBike',
                    data: bikeData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle the success response

                        console.log(response[0]['variant_rental_price']);

                        $('#bike').html('<option value="">-- Select Bike --</option>');
                        $.each(response, function(key, value) {
                            $("#bike").append('<option value="' + value['id'] + '">' +
                                value['number_plate'] + '</option>');
                            var variant_rental_price = value['variant_rental_price'];
                        });

                        $('#rental_perday_price').html(response[0]['variant_rental_price']);





                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                        console.log(error);
                    }
                });
            });


            //bike>rental_dates

            $('#bike').change(function() {
                // Get the selected option value
                var bike_id = $(this).val();

                // Create the data to be sent in the POST request
                var rentData = {
                    bike_id: bike_id,
                    _token: "{{ csrf_token() }}"
                };

                // Send the POST request
                $.ajax({
                    type: 'POST',
                    url: '/getRentalDates',
                    data: rentData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle the success response

                        //  if(response[response.length-1==-1]){
                        //   response[response.length-1]['rent_from_date']=0;
                        //    response[response.length-1]['rent_to_date']=0;

                        // }

                        if (response.length >= 1) {
                            var from_date = response[response.length - 1]['rent_from_date'];
                            var to_date = response[response.length - 1]['rent_to_date'];
                            var rented_dates = getRentedDates(from_date, to_date);
                        } else {

                            var rented_dates = [];

                        }





                        console.log(variant_rental_price);

                        console.log(rented_dates);


                        // Update the datepicker with the new disabled dates
                        $('#from_date').datepicker('option', 'beforeShowDay', function(date) {
                            var stringDate = $.datepicker.formatDate('yy-mm-dd', date);

                            if ($.inArray(stringDate, rented_dates) !== -1) {
                                return [false, 'disable_dates'];
                            }

                            return [true];
                        });





                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                        console.log(error);
                    }
                });
            });



        });
    </script>

    <script>
        function toggle() {
            var billModal = document.getElementById('billModal');

            if (billModal.style.display == 'none') {
                billModal.style.display = 'flex';

            } else {
                billModal.style.display = 'none';

            }



        }

        function setValues() {

            var from_date = new Date(document.getElementById('from_date').value);
            var to_date = new Date(document.getElementById('to_date').value);



            //       var daysDiff = to_date.getTime() - from_date.getTime(); // Difference in milliseconds



            var sub = Math.floor(to_date.getTime() - from_date.getTime());
            var days = Math.floor(sub / (1000 * 3600 * 24));
            rental_dates = days + 1; // Convert milliseconds to days
            console.log(rental_dates);

            if (isNaN(rental_dates)) {
                rental_dates = '--';
            }

            document.getElementById("rental_dates").textContent = rental_dates;

            var rental_perday_price = parseInt(document.getElementById("rental_perday_price").innerHTML);

            var total_rental_price = rental_dates * rental_perday_price;
            document.getElementById("total_rental_price").innerHTML = total_rental_price;

            console.log(total_rental_price);




        }


        function getRentedDates(from_date, to_date) {
            var rented_dates = [];
            var current_date = new Date(from_date);
            var end_date = new Date(to_date);

            while (current_date <= end_date) {
                var formatted_date = formatDate(current_date);
                rented_dates.push(formatted_date);
                current_date.setDate(current_date.getDate() + 1);
            }

            return rented_dates;
        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            return year + '-' + month + '-' + day;
        }
    </script>


    <script></script>
@endsection
