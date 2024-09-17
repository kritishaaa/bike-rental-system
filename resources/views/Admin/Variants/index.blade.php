@extends('layouts.app')

@section('content')
    

<div class="flex flex-col space-y-2">
    <h2 class="text-2xl font-bold">Variants</h2>

    <hr class="h-1 bg-black">
   </div>


   <div class="flex flex-row justify-end m-3 gap-3">
      <a  class="bg-blue-500 text-white py-1 px-3 rounded-sm" style="cursor: pointer;" onclick="toogle('variantchartdiv')">View Chart</a>
      <a href="{{  route('variants.create') }}" class="bg-blue-500 text-white py-1 px-3 rounded-sm">Add Variant</a>
   </div>
   <div class="shadow-lg">
    
<table id="mytable" >
   <thead>
      <tr>
         <th>Sn</th>
         <th>Variant Image</th>
         <th>Variant Name</th>
         <th>Variant Brand</th>
         <th>Rental Price</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>

    @php
        $sn=1;
   
    @endphp
   
    @foreach ($variants as $variant)
       
      <tr>
         <td>{{$sn++}}</td>
         <td><img src="{{ asset('storage/variant_images/'.$variant['variant_image']) }}" alt="variantlogo" style="object-fit: cover" class="h-20"></td>
         <td>{{ $variant['variant_name']}}</td>
         <td>{{ $variant->brand->brand_name}}</td>
         <td>{{ $variant['variant_rental_price']}}</td>
         <td>
            <a href="{{ route('variants.edit', ['id'=>$variant['id']]) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Edit</a>
            <a onclick="toogle('DeleteModal',{{ $variant['id'] }})"  class="bg-red-500 text-white py-1 px-2 rounded-md" id="{{ 'btdelete'.$variant['id'] }}">Delete</a>
             

         </td>
      </tr>
      @endforeach
   </tbody>
</table>


   </div>



   <div class="fixed top-0 left-0 w-screen h-screen flex flex-row justify-center items-center bg-slate-800 backdrop-blur-sm bg-opacity-20" id="variantchartdiv">
   
   <div class="bg-white rounded-md p-4" style="width: 750px;">
      <div class="float-right"><button class="bg-black text-white px-3 py-1 rounded-md" class="btshowgraph" onclick="toogle('variantchartdiv')">Exit</button></div>
       <canvas  id="variantchart" ></canvas>
   </div>
</div>






   <div id="DeleteModal" style="display: none;" class=" bg-gray-400 fixed top-0 left-0 h-screen w-screen backdrop-blur-2xl opacity-90  flex flex-row items-center justify-center">
    <div class="bg-white border border-black p-8 flex flex-col justify-center items-center w-fit rounded-md">
       <p> Are you Sure to Delete ?</p>
       <form action="" method="post">
         @csrf
         @method('delete')
         <input type="hidden" id="dataid" value="" name="id">
        <Button type="submit" class="bg-green-500 px-2 py-1 rounded-md text-white" onclick="delete()" alt="dsds" >Yes</Button>
        <Button class="bg-red-500 px-2 py-1 rounded-md text-white" onclick="toogle("deleteModal")" type="button">No</Button>
        
       </form>

    </div>
   </div>

<script>
   let table=new DataTable('#mytable')

   var component;



   

   function toogle(divid,x){
    component=document.getElementById(divid);

    if(component.style.display=="none"){
        component.style.display="flex";
        document.getElementById('dataid').value=x;


        
    }
    else{
        component.style.display="none";
    }



   }

</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
<script>
  const ctx = document.getElementById('variantchart');

  var variants=@json($variants);
  var variant_names=[];
  var variant_rental_price=[];

  for(i=0;i<variants.length;i++){
       variant_names.push(variants[i]['variant_name']);
       variant_rental_price.push(variants[i]['variant_rental_price']);

  }
console.log(variant_rental_price);
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: variant_names,
      datasets: [{
        label: 'Rental Price',
        data: variant_rental_price,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  $(document).ready(function(){

   $('#variantchartdiv').hide(0);
  $(".btshowgraph").click(function(){
  
    $("#variantchartdiv").toggle();
  });
});

</script>


@endsection