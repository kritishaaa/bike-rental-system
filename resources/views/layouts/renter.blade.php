<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $companyname }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/icons8-bike-16.png') }}">
    <!-- Include the Tailwind CSS CDN -->
    <link rel="stylesheet" href="{{ asset('build/assets/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="{{ asset('datatable/jquery-3.6.0.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
</head>

<body class="font-sans antialiased bg-slate-100">

    @include('layouts.navigation')

    @include('layouts.successmsg')

    <div class=" min-h-[50vh]">
        @yield('content')
    </div>



    @include('frontend.partials.footer')
    @livewireScripts()
</body>

</html>
