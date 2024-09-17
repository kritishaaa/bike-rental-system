<nav
    class="shadow-lg px-2 py-2 bg-slate-200 bg-opacity-70 sticky top-0 left-0 font-semibold min-w-max transition-transform">
    <div id="contact">
        <div class="font-light flex justify-end pr-10 pb-2 text-xs">
            <span>Contact : {{ $companyphonenumber }} | Address: {{ $companyaddress }}</span>
        </div>
        <hr class=" border-black opacity-40 px-36 py-1">
    </div>
    <div class="flex flex-row justify-between px-28 ">
        <big class="font-medium text-2xl">{{ $companyname }}</big>
        <div class=" flex flex-shrink gap-16 justify-center items-center">
            <a href="{{ route('home') }}">Home</a>
            @if (!auth()->user())
                <a href="{{ route('login') }}">Login</a>
            @else
                <livewire:user-menu />
            @endif
        </div>

    </div>
    <div class="hidden bg-blue-400 h-56 min-w-fit absolute top-[4.5rem] right-12 rounded shadow-lg">
        <p class="text-lg font-semibold p-2 text-center">Notification</p>
        <hr class="h-1">

        <div class="p-2 m-2 rounded shadow-md w-96">
            <p>Notication Text</p>
            <small class=" flex justify-end ">Sent Time</small>
        </div>

    </div>
</nav>




<script>
    let contact = document.querySelector('#contact');
    window.addEventListener('scroll', function() {
        let navbar = document.getElementsByTagName('nav')[0];


        console.log(window.scrollY);

        if (window.scrollY > 0) {
            navbar.classList.remove('bg-slate-200');
            navbar.classList.remove('bg-opacity-70');
            navbar.classList.add('bg-gray-200');
            navbar.classList.add('bg-opacity-100');
            contact.classList.add('hidden')

        } else {
            navbar.classList.remove('bg-gray-200');
            navbar.classList.remove('bg-opacity-100');
            navbar.classList.add('bg-gray-200');
            navbar.classList.add('bg-opacity-70');
            contact.classList.remove('hidden')

        }
    });

    let currentUrl = window.location.href;

    if (currentUrl != "{{ route('home') }}") {
        contact.classList.add('hidden');
    }
</script>
