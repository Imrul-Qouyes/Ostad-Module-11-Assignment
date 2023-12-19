<table style="width:100%; border: 1px solid black">
  <th style="border: 1px solid black">Id</th>
  <th style="border: 1px solid black">Product Name</th>
  <th style="border: 1px solid black">Product Description</th>
  <th style="border: 1px solid black">Price</th>
  <th style="border: 1px solid black">Quantity</th>
  <th style="border: 1px solid black">Category</th>
  <th style="border: 1px solid black">Action</th>
  @foreach ($results as $item )
  <tr>
    <td style="border: 1px solid black">{{$item->id}}</td>
    <td style="border: 1px solid black">{{$item->product_name}}</td>
    <td style="border: 1px solid black">{{$item->product_description}}</td>
    <td style="border: 1px solid black">{{$item->price}}</td>
    <td style="border: 1px solid black">{{$item->quantity}}</td>
    <td style="border: 1px solid black">{{$item->category_name}}</td>
    <td style="border: 1px solid black">
      <a href="{{route('editproduct',['id'=>$item->id,
      'product_name'=>$item->product_name,
      'product_description'=>$item->product_description,
      'price'=>$item->price,
      'quantity'=>$item->quantity,
      'category_id'=>$item->category_id])}}">Edit</a> | <a href="{{route('deleteproductview',['id'=>$item->id,
      'category_id'=>$item->category_id])}}">Delete</a> | <a href="{{route('sellproduct',['id'=>$item->id,
      'product_name'=>$item->product_name,
      'price'=>$item->price,
      'quantity'=>$item->quantity,
      'category_id'=>$item->category_id])}}">SELL</a>
    </td>
  </tr>
  @endforeach

</table>
@if (session()->has('success'))
  {{session()->get('success')}}<br>
@endif

<a href="{{route('sellportal')}}">Go Back</a>