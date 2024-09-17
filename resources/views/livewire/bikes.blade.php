<div>

    <div>
        {{-- Close your eyes. Count to one. That is how long forever feels. --}}


        <div class="flex flex-row justify-end m-3">
        </div>
        <div class="px-1 shadow-lg">

            <div class="flex flex-row justify-between items-center">
                <div>

                    <p>Show <select name="" id="" class="text-sm m-2" wire:model="items">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>

                        </select> Entries</p>
                </div>

                <div class="flex gap-2 items-center">
                    <p>Select Status</p>
                    <select name="" id="" class="rounded bg-gray-300 flex items-center py-1"
                        wire:model="rentalstatus">
                        <option disabled>--select--</option>
                        <option value="">Show all</option>
                        <option value="Unavalable">On Rent</option>
                        <option value="Available">Available Bikes</option>


                    </select>

                    <a href="{{ route('bikes.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md">Add
                        Bike</a>
                </div>
            </div>

            {{-- //mytable --}}
            <table class="divide-y divide-gray-700 w-full">
                <thead class="bg-gray-200 py-3">
                    <tr class=" divide-gray-500 text-center">
                        <th class="p-3 ">Sn</th>
                        <th class="p-3 ">Bike Number Plate</th>
                        <th class="p-3 ">cc</th>
                        <th class="p-3">Bike Brand</th>
                        <th class="p-3">Variant name</th>
                        <th class="p-3">Bill Book</th>
                        <th class="p-3">Model Year</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Added date</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>



                <tbody>
                    @foreach ($bikes as $bike)
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td> {{ $bike['number_plate'] }}</td>
                            <td>{{ $bike['cc'] }}</td>
                            <td>{{ $bike->variant->brand->brand_name }}</td>
                            <td>{{ $bike->variant->variant_name }}</td>
                            <td><button class="bg-blue-500 rounded-md text-white px-1 text-xs scale-105"
                                    wire:click="billbookdialog({{ $bike['id'] }})" target="_blank"><small>View Bill
                                        Book</small></button></td>
                            <td>{{ $bike['model_year'] }}</td>

                            <td>
                                @if ($bike['status'] == 'Available')
                                    <small class="bg-green-500 p-1 rounded-sm text-white">Available</small>
                                @else
                                    <small class="bg-red-500 p-1 rounded-sm text-white">Unavailable</small>
                                @endif
                            </td>
                            <td>{{ $bike['created_at']->diffForHumans() }}</td>
                            <td>
                                <div class="flex flex-row gap-2">
                                    <a href="{{ route('bikes.edit', $bike['id']) }}"
                                        class="bg-blue-500 text-white py-1 px-2 rounded-sm">Edit</a>
                                    <form action="{{ route('bikes.destroy') }}" method="post">

                                        @csrf
                                        <input type="hidden" name="bike_id" id=""
                                            value="{{ $bike['id'] }}">
                                        <input type="submit" value="Delete"
                                            class="bg-red-500 text-white rounded-sm py-1 px-2">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <script>
                let table = new DataTable('#mytable')
            </script>

            @if ($billbookdialog == 'show')
                <div
                    class="fixed w-screen h-screen top-0 left-0 justify-center flex flex-row items-center backdrop-blur-lg">


                    <div class="bg-white rounded relative p-2">
                        <button type="button" wire:click="billbookdialog(2)" class=" absolute top-2 right-2"> <i
                                class="fa fa-times hover:bg-black hover:text-white rounded-full p-1"
                                aria-hidden="true"></i>
                        </button>
                        <p class="text-lg font-semibold p-3">BillBook View</p>
                        <hr class="h-1">

                        <div class="h-[400px] overflow-y-auto min-w-[600px]">
                            <img src="{{ asset($image_url) }}" alt="image" class="w-full object-cover">
                        </div>
                    </div>
            @endif

        </div>


    </div>
