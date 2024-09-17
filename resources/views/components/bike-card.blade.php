  <div class="flex flex-row justify-around px-4 pb-6 ">


      @forelse ($bikes as $bike)
          <div
              class="max-w-[20rem] mx-auto bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl hover:scale-110  ">

              <img style="width: 250px; height: 200px;object-fit: cover"
                  src="{{ asset('storage/variant_images/' . $bike->variant->variant_image) }}"
                  alt="{{ asset('storage/variant_images/' . $bike->variant->variant_name) }}">
              <div class="p-4">
                  <h2 class="text-xl font-semibold text-gray-800">{{ $bike->variant->variant_name }}</h2>
                  <p class="mt-1">
                      <span class="text-gray-700 font-semibold"> Brand:</span>
                      <span class=""text-gray-800 ml-2">{{ $bike->variant->brand->brand_name }}.</span>
                  </p>
                  <div class="mt-1">
                      <span class="text-gray-700 font-semibold">Rental Price:</span>
                      <span class="text-gray-800 ml-2">{{ $bike->variant->variant_rental_price }}</span>
                  </div>
                  <div class="mt-1">
                      <span class="text-gray-700 font-semibold">Bike cc:</span>
                      <span class="text-gray-800 ml-2">{{ $bike->cc }} cc</span>
                  </div>
                  <form action="{{ route('renter.bikedetails') }}" method="POST">
                      <div class="mt-2">
                          @csrf
                          <input type="hidden" name="bike_id" value="{{ $bike->id }}">
                          <button
                              class="inline-block  w-full  text-center bg-gray-600 hover:bg-black text-white font-semibold py-2 px-4 rounded"
                              type="submit">
                              Rent Bike
                          </button>
                      </div>
                  </form>
              </div>
          </div>
          @php
              if ($loop->iteration == 4) {
                  break;
              }
          @endphp
      @empty

          <div class="max-w-[20rem] mx-auto bg-white rounded-lg overflow-hidden   ">

              <p class="text-xl font-semibold">No bikes Available</p>
          </div>
      @endforelse


  </div>
