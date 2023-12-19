<div>

  <form action="{{route('updateproduct',['id'=>$id,'category_id'=>$category_id])}}" method="post">
    @csrf
 
    <label for="productname">Product Name</label>
    <input type="text" name="productname" value="{{$product_name}}"><br><br>
    @error('productname')
      <p>{{$message}}</p>      
    @enderror
    <label for="productdetails">Product Details</label>
    <input type="text" name="productdetails" value="{{$product_description}}"><br><br>
    @error('productdetails')
      <p>{{$message}}</p>      
    @enderror

    <label for="productprice">Product Price</label>
    <input type="text" name="productprice" value="{{$product_price}}"><br><br>
    @error('productprice')
      <p>{{$message}}</p>      
    @enderror
    <label for="productquantity">Product Quantity</label>
    <input type="text" name="productquantity" value="{{$product_quantity}}"><br><br>
    @error('productquantity')
      <p>{{$message}}</p>      
    @enderror

    <button type="submit">Update</button>
    @if(session()->has('success'))
    <p>{{session()->get('success')}}</p>
    @endif
  </form>

  <a href="{{route('getproduct',['id'=>$category_id])}}">Go Back</a>
</div>