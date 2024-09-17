@if(Session::has('success'))
<div id="success" class="bg-green-500 text-white p-2 w-fit rounded-md fixed top-3 right-3">
  {{session('success')}}
</div>
<script>
  $(document).ready(function(){
  
    $("#success").fadeOut(3000);
});
</script>
@endif