@extends('layouts.app')

@section('content')
    
<div class="flex flex-col space-y-2">
    <h2 class="text-2xl font-bold">Brands</h2>

    <hr class="h-1 bg-black">
   </div>


   <div class="flex flex-row justify-end m-3">
      <a href="{{  route('brands.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md">Add Brand</a>
   </div>
   <div class="px-10">
    
<table id="mytable" >
   <thead>
      <tr>
         <th>Sn</th>
         <th>Brand Logo</th>
         <th>Brand Name</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>

    @php
        $sn=1;
    @endphp
   
    @foreach ($brands as $brand)
       
      <tr>
         <td>{{$sn++}}</td>
         <td><img src="{{ asset('storage/'.$brand['brand_logo']) }}" alt="brandlogo" style="object-fit: cover" class="h-20"></td>
         <td>{{ $brand['brand_name']}}</td>
         
         <td>
            <a href="{{ route('brands.edit', ['id'=>$brand['id']]) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Edit</a>
            <a onclick="toogle({{$brand['id']}})"  class="bg-red-500 text-white py-1 px-2 rounded-md" id="{{ 'btdelete'.$brand['id'] }}">Delete</a>
             

         </td>
      </tr>
      @endforeach
   </tbody>
</table>

   </div>

   <div id="DeleteModal" style="display: none;" class=" bg-gray-400 fixed top-0 left-0 h-screen w-screen backdrop-blur-md bg-opacity-50  flex flex-row items-center justify-center">
    <div class="bg-white border border-black p-8 flex flex-col justify-center items-center w-fit rounded-md">
       <p> Are you Sure to Delete ?</p>
      <form action="{{route('brands.destroy')}}" method="post">
         @csrf
         <input type="hidden" name="brand_id" id="dataid"   value="">
        
        <Button type="submit" class="bg-green-500 px-2 py-1 rounded-md text-white"  alt="dsds" >Yes</Button>
        <Button class="bg-red-500 px-2 py-1 rounded-md text-white" onclick="toogle()" type="button">No</Button>
        
       </form>

    </div>
   </div>

<script>
   let table=new DataTable('#mytable')

   var component;

   var d1=document.getElementById()

   

   function toogle(x){
    component=document.getElementById("DeleteModal");

    if(component.style.display=="none"){
        component.style.display="flex";
        document.getElementById("dataid").value=x;
        
    }
    else{
        component.style.display="none";
    }
   }

   

</script>

@endsection