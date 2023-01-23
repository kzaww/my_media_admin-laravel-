<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    //direct category list
    public function categoryList()
    {
        $data = Category::when(request('key'),function($query){
                        $query->where('category_title','like','%'.request('key').'%');
        })
                        ->get();
        return view('admin.category.categoryList',compact('data'));
    }

    //create Category
    public function categoryCreate(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'title' => 'required|unique:categories,category_title',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('createFail','Create Category Fail,Try Again!')
                        ->withErrors($validator)
                        ->withInput();
        }

        Category::create([
            'category_title'=> $request['title'],
            'category_description' => $request['description']
        ]);
        return back()->with('createSuccess','Successfully Created!!');
    }

    //delete Category
    public function categoryDelete(Request $request)
    {
        if($request->id){
            Category::where('category_id',$request->id)->delete();
            return back()->with('deleteSuccess','Successfully Deleted!!');
        }else{
            return back()->with('deleteFail','delete fail,Try Again!');
        }

    }

    //direct edit page
    public function categoryEdit($id)
    {
        $data = Category::where('category_id',$id)->first();
        return view('admin.category.categoryEdit',compact('data'));
    }

    //update category
    public function categoryUpdate(Request $request)
    {
        Validator::make($request->all(),[
            'title' => "required|unique:categories,category_title,$request->id,category_id",
            'description' => 'required'
        ])->validate();

        $data = $this->updateDataInfo($request->all());
        Category::where('category_id',$request->id)->update($data);
        return redirect()->route('admin#categoryList')->with('updateSuccess','Successfully Updated!!');
    }

    //formate data
    private function updateDataInfo($data)
    {
        return [
            'category_title' => $data['title'],
            'category_description' => $data['description']
        ];
    }
}
