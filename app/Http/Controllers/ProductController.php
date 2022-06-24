<?php

namespace App\Http\Controllers;

use App\category;
use App\Product;
use App\Pack;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function edit($product){
        
        return view('editproduct', ['products' => Product::where('id',$product)->first(),
            'categories' => category::all(),
            'packs'=> Pack::all(),
            'productid'=>$product
        ]);
    }


    public function productsindex(){

        $productinfo = [];
        $products = Product::all();
        foreach($products as $product){
            $category = category::where('id',$product->category)->get(['c_name']);
            $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
            array_push($productinfo,['id'=>$product->id,
                'serialnumber'=>$product->serialnumber,
                'p_name'=>$product->p_name,
                'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                'category'=>$category[0]->c_name]);
        }

        return Response()->json(['products'=>$productinfo]);
    }

    public function index(){

        $productinfo = [];
        $products = Product::all();
        foreach($products as $product){
            $category = category::where('id',$product->category)->get(['c_name']);
            $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
            array_push($productinfo,['id'=>$product->id,
            'serialnumber'=>$product->serialnumber,
            'p_name'=>$product->p_name,
            'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
            'category'=>$category[0]->c_name]);
        }

        return view('all_product', ['products' => $productinfo]);
    }

    public function newScreenPage(){
        return view('newproduct', ['categories' => category::all(),
        'packs'=> Pack::all()]);
    }

    public function saveproduct(Request $request){
        $this->validate($request,['pname'=>'required',
        'pack'=>'required','cat_id'=>'required']);

        if(Product::where(['serialnumber'=>$request->pserial])->count() == 0){

            if(Product::where(['serialnumber'=>$request->pserial,'p_name'=>$request->pname,'p_size'=>$request->pack,'category'=>$request->cat_id])->count() == 0 ){
                $product = new Product();
                $product->p_name = $request->pname;
                $product->p_size = $request->pack;
                $product->category = $request->cat_id;
                $product->serialnumber = $request->pserial;
                
                if($product->save()){
                    return view('newproduct', ['categories' => category::all(),
                    'sucess' => 'Successfully created a new product.',
                    'packs'=> Pack::all()]);
                }else{
                    return view('newproduct', ['categories' => category::all(),
                        'error' => 'There was an error saving the product.',
                        'packs'=> Pack::all()]);
                }
            }else{
                return view('newproduct', ['categories' => category::all(),
                    'error' => 'There is a product of the same name.',
                    'packs'=> Pack::all()]);
            }
        }else{
            return view('newproduct', ['categories' => category::all(),
            'error' => 'There is a product of the same serial number.',
            'packs'=> Pack::all()]);

        }
            

    }

    public function deleteproduct($key){
        if(Product::where(['id'=>$key])->delete()){
            $productinfo = [];
            $products = Product::all();
            foreach($products as $product){
                $category = category::where('id',$product->category)->get(['c_name']);
                $pack = Pack::where('id',$product->p_size)->get(['packsize','weightunit']);
                array_push($productinfo,['id'=>$product->id,
                'serialnumber'=>$product->serialnumber,
                'p_name'=>$product->p_name,
                'p_size'=>$pack[0]->packsize.''.$pack[0]->weightunit,
                'category'=>$category[0]->c_name]);
            }
    
            return view('all_product', ['products' => $productinfo,
            'sucess' => 'Successfully deleted the product.']);
        }else{
            return view('all_product', ['products' => $productinfo,
            'error' => 'There was an error deleting the product']);
        }
    }
    public function updateproduct(Request $request){
        $this->validate($request,['pname'=>'required',
        'pack'=>'required','cat_id'=>'required']);
        $proceed = false;

        if(Product::where(['serialnumber'=>$request->pserial])->count() == 1){
            if(Product::where(['id'=>$request->id,'serialnumber'=>$request->pserial])->count() == 1){
                $proceed = true;
            }else{
                $proceed = false;
            }
                
        }else if(Product::where(['serialnumber'=>$request->pserial])->count() == 0){
            $proceed = true;
        }
            

        if($proceed){

            if(Product::where(['serialnumber'=>$request->pserial,'p_name'=>$request->pname,'p_size'=>$request->pack,'category'=>$request->cat_id])->count() == 0 ){
                $product = Product::where('id',$request->id)->first();
                $product->p_name = $request->pname;
                $product->p_size = $request->pack;
                $product->category = $request->cat_id;
                $product->serialnumber = $request->pserial;
                
                if($product->save()){
                    return view('editproduct', ['products' => Product::where('id',$request->id)->first(),
                    'categories' => category::all(),
                    'packs'=> Pack::all(),
                    'productid'=>$request->id,
                    'sucess' => 'Successfully updated a product.']);

                }else{
                   
                        return view('editproduct', ['products' => Product::where('id',$request->id)->first(),
                        'categories' => category::all(),
                        'packs'=> Pack::all(),
                        'productid'=>$request->id,
                        'error' => 'There was an error while updating a product.'
                        ]);
                }
            }else{
                return view('editproduct', ['products' => Product::where('id',$request->id)->first(),
                'categories' => category::all(),
                'packs'=> Pack::all(),
                'productid'=>$request->id,
                'error' => 'The exact same product already exists.'
                ]);
            }
        }else{

            return view('editproduct', ['products' => Product::where('id',$request->id)->first(),
            'categories' => category::all(),
            'packs'=> Pack::all(),
            'productid'=>$request->id,
            'error' => 'There is a product of the same serial number.'
            ]);

        }
            

    }
}
