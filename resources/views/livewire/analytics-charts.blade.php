   <div class="flex flex-col m-2 gap-3">
       {{-- Success is as dangerous as failure. --}}




       <div class="flex flex-row ">
           <div class="flex flex-col justify-between flex-1">
               <div class="flex flex-row justify-between items-center w-full ">
                   <p class="font-semibold text-2xl">Rental Report</p>
                   <input type="month" class="rounded" max="{{ $month }}" value="{{ $month }}"
                       onchange="changemonth(this.value)">
               </div>
               <div class=" flex-1 flex flex-row justify-around items-center">
                   <div class="bg-slate-800 text-white rounded text-center p-10">
                       <p class="font-semibold text-xl  ">Number of Bikes Added: </p>
                       <p id="count_bike" class="font-semibold">{{ $bikecounts }}</p>
                   </div>
                   <div class="bg-slate-800 rounded text-center text-white  p-10">
                       <p class="font-semibold text-xl  "> Total Rents: </p>
                       <p id="count_rent" class="font-semibold">{{ $totalrents }}</->
                   </div>


               </div>
           </div>
           <x-doughnut-chart idvalue="Credit" :month="$month" />
       </div>

       <div class="flex flex-row gap-6  min-w-full justify-between flex-1 my-10">
           {{-- <x-variants-chart idvalue="revenue" :month="$month" /> --}}


           <livewire:variants-chart />
           <livewire:revenve-chart />


           {{-- @livewire('revenve-chart') --}}




       </div>


       <script>
           var bike_count = document.getElementById('count_bike');
           var rent_count = document.getElementById('count_rent');



           function changemonth(month) {

               var postData = {
                   _token: "{{ csrf_token() }}",
                   month: month
               }

               $.ajax({
                   type: 'POST',
                   url: '/changemonth',
                   data: postData,
                   success: function(response) {

                       let variants_names = response[1][1];
                       let variants_counts = response[1][0];

                       let dates = response[2][0];
                       let total_rental_price = response[2][1];

                       let total_revenve = response[3][1];
                       let revenve = response[3][0];

                       let countbike = response[4][1];
                       let countrent = response[4][0];


                       variantchart.data.labels = variants_names;
                       variantchart.data.datasets[0].data = variants_counts;

                       revenvechart.data.labels = dates;
                       revenvechart.data.datasets[0].data = total_rental_price;


                       Revenvedoughnut.data.datasets[0].data = revenve;

                       let totalrevenve = document.getElementById('totalrevenve');
                       totalrevenve.innerText = "Total Revenve: " + total_revenve;

                       rent_count.innerText = countrent;
                       bike_count.innerText = countbike;




                       revenvechart.update();
                       variantchart.update();
                       Revenvedoughnut.update();

                   },
                   error: function(xhr, status, error) {
                       // Handle the error
                       alert(error)
                   }
               });

           }
       </script>





   </div>


   {{--  --}}
