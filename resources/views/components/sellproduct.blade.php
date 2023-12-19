<h2>Enter Sell Item Quantity</h2>
<h4>Product Id: {{$id}} </h4>
<h4>Product Name: {{$product_name}} </h4>
<h4>Product Price: {{$price}} </h4>

<form action="{{route('confirmsell',['id'=>$id,'product_name'=>$product_name,'price'=>$price,'quantity'=>$quantity])}}" method="post">
  @csrf
  <input type="text" name="sell" id="" placeholder="Enter Sell Quantity"><br><br>
  @error('sell')
  {{$message}}    
  @enderror
  <button type="submit">Confirm</button>
  <a href="{{route('getproduct',['id'=>$category_id])}}">Go Back</a>
  

  @if(session()->has('message'))
  <h4>{{session()->get('message')}}</h4>
  @endif

</form>