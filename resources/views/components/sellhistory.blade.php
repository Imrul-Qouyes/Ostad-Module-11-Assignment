<h2>ALL Products Sell Transaction History</h2>

<table style="width:100%; border: 1px solid black">
  <th style="border: 1px solid black">Id</th>
  <th style="border: 1px solid black">Product Name</th>
  <th style="border: 1px solid black">Price</th>
  <th style="border: 1px solid black">Quantity</th>
  <th style="border: 1px solid black">Total</th>
  <th style="border: 1px solid black">Sold Date</th>
  @foreach ($results as $item )
  <tr>
    <td style="border: 1px solid black">{{$item->id}}</td>
    <td style="border: 1px solid black">{{$item->product_name}}</td>
    <td style="border: 1px solid black">{{$item->price}}</td>
    <td style="border: 1px solid black">{{$item->quantity}}</td>
    <td style="border: 1px solid black">{{$item->total}}</td>
    <td style="border: 1px solid black">{{$item->sell_date}}</td>

  </tr>
  @endforeach

</table>

<a href="{{route('home')}}">Go Back</a>