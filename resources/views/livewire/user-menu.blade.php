<div class="flex gap-3">

    <div class="flex flex-row items-center">
        <a onclick="ToggleModal('userModal')"><i class="fa fa-user hover:bg-slate-300 p-3 rounded-full"></i></a>

        @if ($rentc)
            <a href="{{ route('renter.rent.details') }}"> <i
                    class="fas fa-motorcycle animate-pulse  hover:bg-slate-300 p-3 rounded-full text-lg  ">
                    <sup><small>1</small></sup></i>
            </a>
        @endif


    </div>
    <div class="fixed z-10 top-16 right-9 bg-slate-200 rounded-md shadow-lg p-2 flex flex-col w-52  border-black "
        style="display:none" id="userModal">
        <div>
            <p class="text-xl font-semibold">{{ strtoupper(auth()->user()->role) }}: {{ auth()->user()->name }}</p>

        </div>
        <hr class="h-0.5 bg-black my-2">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <ul class="text-center">
                <li class="hover:bg-gray-300 p-1 cursor-pointer"><a href="">Profile</a></li>
                <li class="hover:bg-gray-300 p-1 cursor-pointer"><input type="submit" value="Logout"
                        class="min-w-full min-h-full px-4"></li>
            </ul>
        </form>
    </div>
    <script>
        var notifications;

        function ToggleModal(notifications) {
            var component = document.getElementById(notifications)

            if (component.style.display == "none") {
                component.style.display = "flex";
            } else {
                component.style.display = "none";
            }
        }
    </script>









</div>
