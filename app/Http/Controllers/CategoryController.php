<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index(){
        return view('all_categories', ['categories' => category::all()]);            
    }

    public function deletecategory($key){
        if(category::where(['id'=>$key])->delete()){
            return redirect('/successfull_callcategory');
        }else{
            return redirect('/unsuccessfull_callcategory');
        }
    }

    public function editcategory($key){
        return view('editcategory', ['category' => category::where(['id'=>$key])->get()]);            
    }

    public function successfull(){
        return view('all_categories', ['categories' => category::all(),
        'sucess' => 'Product category is successfully removed from the system.']);
    }

    public function unsuccessfull(){
        return view('all_categories', ['categories' => category::all(),
        'error' => 'There was an error while removing the category.']);
    }



    public function newcategory(Request $request){
        
        $this->validate($request,['categoryname' =>'required']);
        if(category::where(['c_name'=>$request->categoryname])->count() == 0){
            $category = new category();
            $category->c_name = $request->categoryname;
            if($category->save()){
                return view('new_categories', ['sucess' => 'Category is successfully saved.']);            
            }else{
                return view('new_categories', ['error' => 'There was an error while saving the newly created category.']);            
            }
        }else{
            return view('new_categories', ['error' => 'Category already exist in the system.']);                        
        }

    }

    public function savecategory(Request $request){
        
        $this->validate($request,['categoryname' =>'required',
        'id'=>'required']);
        if(category::where(['c_name'=>$request->categoryname])->count() == 0){
            $category =  new category(['id'=>$request->id]);
            if($category->where(['id'=>$request->id])->update(['c_name' => $request->categoryname])){
                return view('all_categories', ['categories' => category::all(),
                'sucess' => 'Successfully updated the category.']);
            }
        }else{
            return view('all_categories', ['categories' => category::all(),
            'error' => 'There was an error while saving the newly created category.']);            
        }
    }
}
