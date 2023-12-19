<h3>Are you sure?</h3>

<form action="{{route('deletecategory',['category_id'=>$category_id])}}" method="post">
  @csrf
  <button type="submit">OK</button>
</form>

<button><a href="{{route('allcategories')}}">CANCEL</a></button>