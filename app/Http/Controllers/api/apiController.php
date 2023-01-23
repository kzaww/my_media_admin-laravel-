<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Action_Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class apiController extends Controller
{
    //login
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if(isset($user)){
            if(Hash::check($request->password, $user->password))
            {
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);
            }else{
                return response()->json([
                    'user' => null,
                    'token' => null
                ]);
            }
        }else{
            return response()->json([
                'user' => null,
                'token' => null
            ]);
        }
    }

    //get post data
    public function post()
    {
        $data = Post::leftJoin('categories','categories.category_id','posts.category_id')
                    ->get();

        return response()->json([
            'data' => $data,
            'status' => 'true'
        ]);
    }

    //get category data
    public function category()
    {
        $data = Category::Select('category_id','category_title','category_description')
                        ->get();

        return response()->json([
            'data' => $data,
            'status' => 'true'
        ]);
    }

    //search post
    public function searchPost(Request $request)
    {
        $data = Post::where('post_title','like','%'.$request->key.'%')
                    ->get();

        return response()->json([
            'data' => $data,
            'status' => 'true'
        ]);
    }

    //search category
    public function searchCategory(Request $request)
    {
        $data = Category::Select('posts.*')
                        ->join('posts','posts.category_id','categories.category_id')
                        ->where('category_title','like','%'.$request->key.'%')
                        ->get();

        return response()->json([
            'data' => $data,
            'status' => 'true'
        ]);
    }

    //detail post
    public function details(Request $request)
    {
        $data = Post::where('post_id',$request->key)->first();

        return response()->json([
            'data' => $data,
            'status' => 'true'
        ]);
    }

    //activity log
    public function activityLog(Request $request)
    {
        Action_Log::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        $data = Action_Log::where('post_id',$request->post_id)->get();

        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
}
