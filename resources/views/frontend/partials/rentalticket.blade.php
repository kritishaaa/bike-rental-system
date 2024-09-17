<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bike Rental Ticket</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://kit.fontawesome.com/a21da4aff9.js" crossorigin="anonymous"></script>

   

    </head>
    <body class="font-sans antialiased">


      
  <div class="fixed top-0  left-0 min-h-full p-7 w-screen flex justify-center items-center backdrop-blur-sm ">
    <div class="bg-white  text-md overflow-hidden p-4 rounded relative hover:scale-110 border-slate-500 border-[1px]">
        <h2 class="font-medium text-xl">Bike Rental Ticket</h2>
        <hr class="bg-black h-0.5">
     
        <div class="text-sm text-center">
            <p>Company Name</p>
            <p>Company Address</p>
            <p>Company Location</p>
        </div>

        <hr class="h-0.5 bg-gray-800">

     <div class="flex flex-row justify-center items-center">

  
        <div>

            <p>Bike Number: {{ $rentalbike->bike->number_plate }}</p>
            <p>Bike Model: {{ $rentalbike->bike->model_year }}</p>
             <p>Rental Status: {{ $rentalbike->status }}</p>
               <p>From Day: {{ $rentalbike->rent_from_date }}</p>
                 <p>To Day: {{ $rentalbike->rent_to_date }}</p>
                 <p>Rental Price:  {{ $rentalbike->bike->variant->variant_rental_price  }}</p>
                 <p>Rental Days: {{ $rentalbike->total_rental_price/$rentalbike->bike->variant->variant_rental_price }}</p>
           
                <p>Total Rental Price: {{ $rentalbike->total_rental_price }}</p>
           
        </div>

        <div class="flex flex-col place-items-end justify-center text-sm">
             <p>Renter Name: {{ $rentalbike->user->name  }}</p>
              <p>Renter Email: {{ $rentalbike->user->email  }}</p>
            <p>Booked on : {{ $rentalbike->created_at->format('Y-m-d') }}</p>
           <img src="{{ asset('storage/variant_images/'.$rentalbike->bike->variant->variant_image)}}" alt="image" class="h-52 object-cover border-0.5 border-black rounded scale-75">
        </div>

     </div>

        <div>

        </div>
       
    </div>

    
</div>

    

  
    </body>
</html>
