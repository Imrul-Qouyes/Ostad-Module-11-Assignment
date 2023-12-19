<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{

    function homepage(){

        return view('page.home');

    }

    function getproducts(Request $request){

        $categoryIdfromRoute = $request->id;
        $result = DB::table('products')
        ->select('products.*','categories.category_name')
        ->join('categories','products.category_id','=','categories.id')
        ->where('categories.id','=',$categoryIdfromRoute)
        ->get();

        return view('page.products',['results'=>$result]);
    
    }
    
    function addproductView(){

        $result = DB::table('categories')
        ->select('id','category_name')
        ->get();
        
        return view('page.addproduct',['result'=>$result]);
    }

    function addproduct(Request $request){

        //Input Validation
        $this->validate($request,
        ['productname'=>'required',
        'productdetails' => 'required',
        'productcategory'=>'required',
        'productprice'=>'required',
        'productquantity'=>'required']);
        
        // Data Insertion
         DB::table('products')
         ->insert(
            ['product_name'=>$request->input('productname'),'product_description'=>$request->input('productdetails'),'price'=>$request->input('productprice'),
            'quantity'=>$request->input('productquantity'),
            'category_id'=>$request->input('productcategory'),
            'created_at'=>(DB::raw('CURRENT_TIMESTAMP')),
            'updated_at'=>(DB::raw('CURRENT_TIMESTAMP'))]);


        return redirect()->back()->with(['success'=>'Product Successfully Added']);
    }

    function addcategoryview(){
        return view('page.addcategory');
    }

    function allcategories(){

        $results = DB::table('categories')
        ->select('id','category_name')
        ->get();
        return view('page.categories',['results'=>$results]);
    }

    function deletecategoryview(Request $request){

        $categoryId = $request->id;

        return view('page.deletecategory',['category_id'=>$categoryId]);
    }

    function deletecategory(Request $request){

        $categoryId = $request->category_id;

        DB::table('categories')
        ->where('id','=',$categoryId)
        ->delete();

        return redirect()->route('allcategories')->with(['success'=>'Category Deleted Successfully']);
    }

    function addcategory(Request $request){

        $this->validate($request,['categoryname'=>'required']);
        $categoryName = $request->categoryname;

        DB::table('categories')
        ->insert(['category_name'=>$categoryName,
        'created_at'=>(DB::raw('CURRENT_TIMESTAMP')),
        'updated_at'=>(DB::raw('CURRENT_TIMESTAMP'))]);

        return redirect()->back()->with(['success'=>'Product Category Added Succssfully']);

    }


    function sellportal(){

       $category_ID_Name = DB::table('categories')
       ->select('id','category_name')
       ->get();

        return view('page.sellportal',['category_id_name'=>$category_ID_Name]);
    }


    function sellproduct(Request $request){
        $id = $request->id;
        $categoryId = $request->category_id;
        $productName = $request->product_name;
        $productPrice = $request->price;
        $productQuantity = $request->quantity;

        return view('page.sellproduct',['id'=>$id,
        'category_id'=>$categoryId,
        'product_name'=>$productName,
        'price'=>$productPrice,
        'quantity'=>$productQuantity]);
    }


    function confirmsell(Request $request){

        $sellquantity = $request->input('sell');
        $id = $request->id; // sell item Id

        $quantityFromDB = DB::table('products')
        ->select('quantity')
        ->where('products.id','=',$id)
        ->get();
        
        // Getting quantity for each product to Sell Item
        $result =0;
        foreach($quantityFromDB as $item){
            $result = $item->quantity;
        }

        // Checking Quantity For Sell
        $newresult = '';
        if($result == 0){

            $newresult = "Out of Stock";
            return redirect()->back()->with(['message'=>$newresult]);

        } else if ($result > $sellquantity){

            // Sell Quantity input feild validation
            $this->validate($request,['sell'=>'required']);

            // Updating the Quantity in products table
            $newresult = $result - $sellquantity;
            DB::table('products')->where('id','=',$id)->update(['quantity'=>$newresult]);


            //insert sell record into sell records table
            $productName = $request->product_name;
            $productPrice = $request->price;
            $total = $productPrice *  $sellquantity;
            $selldate = (DB::raw('CURRENT_DATE'));

            DB::table('sell_records')
            ->insert(['product_name'=>$productName,
            'price'=>$productPrice,
            'quantity'=>$sellquantity,
            'total'=>$total,
            'sell_date'=>$selldate]);

            return redirect()->back()->with(['message'=>'Item sold successfully']);

        } else if ($result < $sellquantity){

            $newresult = "Stock is Limited.Only {$result} items is available.";

            return redirect()->back()->with(['message'=>$newresult]);
        }
        

    }


    function editproduct(Request $request){

        $productId = $request->id;
        $product_name = $request->product_name;
        $product_description = $request->product_description;
        $product_price = $request->price;
        $product_quantity = $request->quantity;
        $categoryId = $request->category_id;

        return view('page.editproduct',['id'=>$productId,
        'product_name'=>$product_name,
        'product_description'=>$product_description,
        'product_price'=>$product_price,
        'product_quantity'=>$product_quantity,
        'category_id'=>$categoryId]);
    }

    function updateproduct(Request $request){

        $productId = $request->id;
        $updateProductName = $request->productname;
        $updateProductDetails = $request->productdetails;
        $updateProductPrice = $request->productprice;
        $updateProductQuantity = $request->productquantity;
        $categoryId = $request->category_id;
    

        DB::table('products')
        ->where('id','=',$productId)
        ->update(['product_name'=>$updateProductName,
        'product_description'=>$updateProductDetails,
        'price'=>$updateProductPrice,
        'quantity'=>$updateProductQuantity,
        'updated_at'=>(DB::raw('CURRENT_TIMESTAMP'))]);


        return redirect()->route('getproduct',['id'=>$categoryId])->with(['success'=>'Data Updated Successfully']);
    }

    function deleteproductView(Request $request){

        $productId = $request->id;
        $categoryId = $request->category_id;

        return view('page.deleteproduct',['id'=>$productId,'category_id'=>$categoryId]);
    }
    function deleteproduct(Request $request){

        $productId = $request->id;

        DB::table('products')
        ->where('id','=',$productId)
        ->delete();
        
        return redirect('sellportal')->with(['success'=>'Items Deleted Successfully']);
    }


    function sellhistory(){

        $results = DB::table('sell_records')->get();

        return view('page.sellhistory',['results'=>$results]);
    }

    function totalrevenue(){

        $results = DB::table('sell_records')->get();

        //Storing today, yesterday, this month, last month sell revenue
        $todaySell = 0;
        $yesterdaySell = 0;
        $thismonthSell = 0;
        $lastmonthSell = 0;

        foreach($results as $item){            
        
            $sellday = explode('-', $item->sell_date);            

            if($sellday[1] == date('m') ){
                $thismonthSell += $item->total;
            }
             if($sellday[1] < date('m')){
                $lastmonthSell += $item->total;;
            }
             if($sellday[2] == date('d') && $sellday[1] == date('m')) {
                $todaySell += $item->total;
            }
             if($sellday[2] < date('d') && $sellday[1] == date('m')) {
                $yesterdaySell += $item->total;
            }
        }

        return view('page.totalrevenue',['todaySell'=>$todaySell,
        'yesterdaySell'=>$yesterdaySell,
        'thismonthSell'=>$thismonthSell,
        'lastmonthSell'=>$lastmonthSell]);
    }


}
