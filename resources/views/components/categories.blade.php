<div>
  <table style="width:50%; border: 1px solid black">
    <th style="border: 1px solid black">Id</th>
    <th style="border: 1px solid black">Category Name</th>
    <th style="border: 1px solid black">Action</th>
  
    @foreach ($results as $item)    
    <tr>
      <td style="border: 1px solid black">{{$item->id}}</td>
      <td style="border: 1px solid black">{{$item->category_name}}</td>
      <td style="border: 1px solid black"><a href="{{route('deletecategoryview',['id'=>$item->id])}}">Delete</a></td>
    </tr>
    @endforeach
  </table>
  @if (session()->has('success'))
    <h5>{{session()->get('success')}}</h5>
  @endif
  
  <a href="{{route('addcategoryview')}}">Go Back</a>
</div>