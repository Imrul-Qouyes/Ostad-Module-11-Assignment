<h2>Add Product Category</h2>
<form action="{{route('addcategory')}}" method="post">
  @csrf
<label for="categoryname">Enter Product Category Name</label><br><br>
<input type="text" name="categoryname"><br><br>
@error('categoryname')
  {{$message}}<br><br>
@enderror
<button type="submit">ADD CATEGORY</button><br><br>
@if(session()->has('success'))
<p>{{session()->get('success')}}</p>
@endif
</form>
<button><a href="{{route('allcategories')}}">REMOVE CATEGORY</a></button><br><br>
<a href="{{route('home')}}">Go Back</a>
