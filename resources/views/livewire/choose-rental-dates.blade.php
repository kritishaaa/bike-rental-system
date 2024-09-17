<div>
    {{-- Success is as dangerous as failure. --}}

    <form wire:submit.prevent="submit" method="POST">

        <div class="w-full h-[26rem] gap-10 bg-slate-500 flex justify-start items-center p-10 " id="divCover">
            <div class="bg-slate-100 rounded-md p-5">
                <h2 class="font-semibold text-3xl text-center">Choose a Dates</h2>
                <div class="flex gap-3">
                    <div>
                        <label for="">From Date</label>
                        <input type="date" min="{{ $from_min_date }}" wire:model="from_date" name="from_date"
                            max="" id="from_date"
                            class="appearance-none leading-tight block bg-gray-100 rounded-md">
                    </div>
                    <div>
                        <label for="">To Date</label>
                        <input type="date" min="{{ $from_date }}" name="to_date" id="from_date"
                            wire:model="to_date" class="appearance-none leading-tight block bg-gray-100 rounded-md">
                    </div>
                </div>
                <div class="text-center text-sm py-0.5"><span class="text-red-500">{{ $err_msg }}</span></div>
                <button class="bg-gray-700 hover:bg-black w-full mt-2 font-semibold rounded-sm text-white p-2"
                    type="submit">Find a Bike</button>
            </div>

            <div class="text-white">

                <p class="font-semibold text-3xl"> Your best experiences</p>
                <p class="font-normal text-md">Rent our best bike on ride</p>
                <button class="bg-slate-600 px-3 py-1 rounded my-1" type="button">Discover</button>

            </div>

        </div>


    </form>
</div>
