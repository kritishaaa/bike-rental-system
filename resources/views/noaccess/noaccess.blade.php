<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBRS</title>
    <!-- Include the Tailwind CSS CDN -->
    <link rel="stylesheet" href="{{asset('build/assets/style.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles()
</head>
<body class="font-sans antialiased bg-slate-100">
  <div class="flex flex-col min-h-screen">


<div class="flex-shrink-0">
      @include('layouts.navigation')
</div>




 <div class=" flex-grow flex flex-col justify-center items-center min-h-[500px]">
  




    <div class="h-32">
        <p class=" text-3xl p-3">  You do not have Permission to view this page  </p>
    </div>
      <a class="bg-slate-800 text-white px-4 py-1 rounded cursor-pointer" href="/">Visit Home Page</a>
    
    
  </div>


 
  

<div>
    @include('frontend.partials.footer')
</div>

  </div>
@livewireScripts()
</body>
</html>
