<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class postController extends Controller
{
    //direct product list
    public function postList()
    {
        $category = Category::get();
        $data = Post::when(request('key'),function($query){
                    $query->orwhere('post_title','like','%'.request('key').'%')
                        ->orwhere('category_title','like','%'.request('key').'%');
        })
                    ->leftjoin('categories','posts.category_id','categories.category_id')->get();

        return view('admin.post.postList')->with(['category'=>$category,'data'=>$data]);
    }

    //create product
    public function postCreate(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'image' => 'required|mimes:png,jpg,jpeg,webp',
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);
        if($validate->fails()){
            return back()->with('failCreate','Create Post Fail,Try Again')
                        ->withErrors($validate)
                        ->withInput();
        }

        $file = $request->file('image');
        $imageName = uniqid().'_'.$file->getClientOriginalName();
        $data = $this->productDataInfo($request->all(),$imageName);
        $file->storeAs('public',$imageName);
        Post::create($data);
        return back()->with('successCreate','Create Post Success!');
    }

    //delete product
    public function postDelete(Request $request)
    {
        $dbimage = Post::where('post_id',$request->id)->first();
        $dbimage = $dbimage->image;

        if(Storage::exists('public/',$dbimage)){
            Storage::delete('public/'.$dbimage);
            Post::where('post_id',$request->id)->delete();
            return back()->with('deleteSuccess','Successfully Deleted!!');
        }else{
            return back()->with('deleteFail','Something Wrong,Try Again!');
        }
    }

    //direct edit page
    public function postEdit($id)
    {
        $category = Category::get();
        $data = Post::where('post_id',$id)->first();
        return view('admin.post.postEdit')->with(['data'=>$data,'category'=>$category]);
    }

    //update data
    public function postUpdate(Request $request)
    {
        Validator::make($request->all(),[
            'title' => "required|unique:posts,post_title,$request->id,post_id",
            'description' => 'required',
            'category' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file'
        ])->validate();

        $data = $this->updatePostData($request->all());
        if($request->file('image'))
        {
            $file = $request->file('image');
            $imageName = uniqid().'_'.$file->getClientOriginalName();
            $dbimage = Post::where('post_id',$request->id)->first();
            $dbimage = $dbimage->image;
            $data['image'] = $imageName;
            Post::where('post_id',$request->id)->update($data);
            $file->storeAs('public/',$imageName);
            if(Storage::exists('public/',$dbimage)){
                Storage::delete('public/'.$dbimage);
            }
        }else{
            Post::where('post_id',$request->id)->update($data);
        }
        return redirect()->route('admin#postList')->with('successUpdate','Successfully Updated!');
    }

    //direct detail page
    public function postDetails($id)
    {
        $data = Post::leftJoin('categories','categories.category_id','posts.category_id')
                    ->where('post_id',$id)->first();
        return view('admin.post.postDetail',compact('data'));
    }

    //change product format
    private function productDataInfo($data,$image)
    {
        return [
            'post_title' => $data['title'],
            'post_description' => $data['description'],
            'category_id' => $data['category'],
            'image' => $image
        ];
    }

    //change updatepost format
    private function updatePostData($data)
    {
        return [
            'post_title' => $data['title'],
            'post_description' => $data['description'],
            'category_id' => $data['category'],
        ];
    }
}
