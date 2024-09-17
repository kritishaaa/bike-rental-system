<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBRS</title>
    <!-- Include the Tailwind CSS CDN -->
    <link rel="stylesheet" href="{{ asset('build/assets/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-slate-100">
    @include('layouts.navigation')

    @isset($rented_user)
        <div class="fixed top-0 left-0 backdrop-blur-sm w-screen h-screen flex justify-center items-center ">
            <div class="bg-white p-24 rounded-sm shadow-sm border-[1px] border-gray-600">
                <p>You have already rented a Bike on Pending or Approved !</p>
            </div>
        </div>
    @endisset


    <div class=" min-h-[50vh]">
        <livewire:bike-catalogue :brands="$brands" :ccs="$ccs" :prices="$prices" />
    </div>



    @include('frontend.partials.footer')
    @livewireScripts()
</body>

</html>
