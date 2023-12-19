<h3>Are you sure?</h3>
<form action="{{route('deleteproduct',['id'=>$id])}}" method="POST">  
  @csrf
  <button type="submit">OK</button>
</form>
<button><a href="{{route('getproduct',['id'=>$category_id])}}">CANCEL</a></button>