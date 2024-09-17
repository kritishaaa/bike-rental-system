@extends('layouts.app')




@section('content')
    <script>
        var dates = @json($dates);
        var bikecounts = @json($bikecounts);
        var postion;

        var sublength = 10;
        var sub_dates_array = [];
        var sub_bikecounts_array = [];
        var k = 0;

        for (var i = 0; i < Math.ceil(dates.length / sublength); i++) {
            sub_dates_array[i] = []; // Create an empty array for each dates sub array
            sub_bikecounts_array[i] = []; // Create an empty array for each dates sub array

            for (var j = 0; j < sublength; j++) {
                if (k > dates.length) {
                    break;
                }

                sub_dates_array[i][j] = dates[k];
                sub_bikecounts_array[i][j] = bikecounts[k];
                k++;
            }
        }


        postion = sub_bikecounts_array.length - 1;
    </script>

    <div class="flex flex-col space-y-2">
        <h2 class="text-2xl font-bold">Dashboard</h2>

        <hr class="h-1 bg-black">
    </div>


    <div class="flex flex-row space-x-2 py-6">

        <div class="bg-gray-800 w-32 rounded-md text-white flex flex-col align-center justify-center p-6">
            <h2 class="font-bold text-xl">Brands</h2>
            <p class="text-2xl">{{ $brands }}</p>
        </div>
        <div class="bg-gray-800 w-32 rounded-md text-white flex flex-col align-center justify-center p-6">
            <h2 class="font-bold text-xl">Variants</h2>
            <p class="text-2xl">{{ $variants }}</p>
        </div>
        <div class="bg-gray-800 w-32 rounded-md text-white flex flex-col align-center justify-center p-6">
            <a href="{{ route('bikes.index') }}" class="font-bold text-xl">Bikes</a>
            <div>
                <p class="text-2xl">{{ $bikes }}</p>
            </div>
        </div>
        <div class="bg-gray-800 w-40 rounded-md text-white flex flex-col align-center justify-center p-6">
            <a href="{{ route('rents.index') }}" class="font-bold text-xl">Rents</a>
            <div>
                <p class="text-xs">New rent request : {{ $newrents }}</p>
                <p class="text-xs">Registered rent : {{ $registeredrents }}</p>
                <p class="text-sm">Total : {{ $rents }}</p>
            </div>
        </div>
        <div class="bg-gray-800 w-32 rounded-md text-white flex flex-col align-center justify-center p-6">
            <h2 class="font-bold text-xl">Renters</h2>
            <p class="text-2xl">{{ $renters }}</p>
        </div>

    </div>


    <div class="border-2 border-gray-500 rounded-sm p-4">

        <div class="flex flex-row justify-between items-center">
            <h2 class="font-bold text-xl px-2 py-6">Rental Records</h2>
            <div class="flex gap-2 items-center">
                <p>Show Days</p>
                <select name="days" id="days" class="rounded-sm " onchange="changedays(this.value)">
                    <option value="5">5</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                </select>
            </div>
        </div>

        <div style="height: 400px;width: inherit">
            <canvas id="myChart"></canvas>
        </div>
        <div class="flex justify-between  align-middlem-6 m-6">
            <Button class="bg-blue-400 text-white px-2 py-1 rounded-sm" onclick="prev()">Previous</Button>
            <span>Bikes on Rent</span>
            <Button class="bg-blue-400 text-white px-2 py-1 rounded-sm" onclick="next()">Next</Button>
        </div>


    </div>




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js">
    </script>

    <script>
        var bikechart = document.getElementById("myChart");










        const ctx = document.getElementById("myChart");

        var chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: sub_dates_array[postion],
                datasets: [{
                    label: "Number of Bike on Rent",
                    data: sub_bikecounts_array[postion],
                    borderWidth: 1,
                    borderColor: '454545',
                    backgroundColor: "#453645"
                }, ],
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });


        function prev() {
            postion = postion - 1;



            if (postion < -1) {
                postion = sub_dates_array.length - 1;

            }


            chart.data.datasets[0].data = sub_bikecounts_array[postion];
            chart.data.labels = sub_dates_array[postion];
            chart.update();
            console.log(postion);

        }


        function next() {
            postion = postion + 1;

            if (postion > sub_bikecounts_array.length) {
                postion = 0;

            }


            chart.data.datasets[0].data = sub_bikecounts_array[postion];
            chart.data.labels = sub_dates_array[postion];
            chart.update();




        }
        p = 0;

        function changedays(input) {

            let data = convert_subarrays(input);

            console.log(data.Dates);
            chart.data.datasets[0].data = data.bikecounts[postion];
            chart.data.labels = data.Dates[postion];
            chart.update();



        }



        function convert_subarrays(sublength) {
            k = 0;
            console.log(Math.ceil(dates.length / sublength));

            for (var i = 0; i < Math.ceil(dates.length / sublength); i++) {
                sub_dates_array[i] = []; // Create an empty array for each dates sub array
                sub_bikecounts_array[i] = []; // Create an empty array for each dates sub array

                for (var j = 0; j < sublength; j++) {
                    if (k >= dates.length) {
                        break;
                    }

                    sub_dates_array[i][j] = dates[k];
                    sub_bikecounts_array[i][j] = bikecounts[k];
                    k++;
                }
            }


            return {
                Dates: sub_dates_array,
                bikecounts: sub_bikecounts_array
            };
        }
    </script>
@endsection
