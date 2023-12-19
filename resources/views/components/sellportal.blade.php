<h2>Sell Your Products</h2>
<p>Select Product Category</p>
@if (session()->has('success'))
{{session()->get('success')}}<br>  
@endif

@foreach ($category_id_name as $item)    
<a href="{{route('getproduct',['id'=>$item->id])}}">{{$item->category_name}}</a><br><br>
@endforeach    

<br><br>
<a href="{{route('home')}}">Go Back</a>