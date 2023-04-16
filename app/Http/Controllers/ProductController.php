<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

//     public  function __construct()
//     {
//         // except  ماعدا 
//         // $this->middleware('auth')->except(['index' , 'show']);
// //   only : فقط على هدول 

        
//         $this->middleware('auth')->only(['store' , 'create' , 'update' , 'destroy']);

//     }

    public function index()
    {
        // latest  احدث منشور 

        $pr_product = Product::latest()->paginate(3);
        return view('product.index' , compact('pr_product'))
                        ->with('i',(request()->input('page' , 1)-1) * 5);
    }

    public function create()
    {
        return view('product.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'details' =>'required',
            'image'  =>'required|image|mimes:jpeg,png,jpg,gif,svg',
// |max:2048'

        ]);

        $input = $request->all();
        // save Images
        if($image = $request->file('image'))
        {
            $destinationPath = 'images/';
            $productImage = date('YmdHis').",".$image->getClientOriginalExtension();
            $image->move($destinationPath  , $productImage);
            $input['image'] = $productImage ;
        }
// save 
        Product::create($input);
         // return redirect()->Redirect()->with('seccess' , 'Product Added SeccessFuly ');
        return redirect()->route('index')->with('seccess' , 'Product Added SeccessFuly ');

    }

    public function show(Product $product)
    {
        // $pro_product = product::find( $product);
        return view('product.show' ,  compact('product'));
    }


    public function edit(Product $product)
    {
        return view('product.edit' ,  compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'details' =>'required',
            'image'  =>'required|Image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);

        $input = $request->all();
        // save Images
        if($image->file('image'))
        {
            $destinationPath = '/images';
            $productImage = date('YmdHis').",".$image->getClientOriginalExtension();
            $image->move($destinationPath  , $productImage);
            $input['image'] = $productImage ;
        }else
        {
            //  ألغي الصورة   بي حال انو مابدو يعدل على الصورة 
          unset($input['image'] );

        }
// save 
        $product->update($input);
        return redirect()->route('product.index')->with('seccess' , 'Product Updated SeccessFuly ');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }
}
