<div>
  <form action="{{route('addproduct')}}" method="post">
    @csrf
    <label for="productname">Product Name</label>
    <input type="text" name="productname"><br><br>
    @error('productname')
      <p>{{$message}}</p>      
    @enderror
    <label for="productdetails">Product Details</label>
    <input type="text" name="productdetails"><br><br>
    @error('productdetails')
      <p>{{$message}}</p>      
    @enderror
    <label for="productcategory">Product Category</label>
    <select name="productcategory" id="">
      @foreach ($result as $item )
      <option name="productcategory" value="{{$item->id}}">{{$item->category_name}}</option>
      @endforeach      
    </select><br><br>
    @error('productcategory')
      <p>{{$message}}</p>      
    @enderror
    <label for="productprice">Product Price</label>
    <input type="text" name="productprice"><br><br>
    @error('productprice')
      <p>{{$message}}</p>      
    @enderror
    <label for="productquantity">Product Quantity</label>
    <input type="text" name="productquantity"><br><br>
    @error('productquantity')
      <p>{{$message}}</p>      
    @enderror
    <button type="submit">Add Item</button>
    @if(session()->has('success'))
    <p>{{session()->get('success')}}</p>
    @endif

  </form>

  <a href="{{route('home')}}">Go Back</a>
</div>