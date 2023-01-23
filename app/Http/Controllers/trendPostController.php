<?php

namespace App\Http\Controllers;

use App\Models\Action_Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class trendPostController extends Controller
{
    //direct trend post page
    public function trendPost()
    {
        $data = Action_Log::Select('posts.*','action_logs.*',DB::raw('count(action_logs.post_id) as view'))
                        ->leftJoin('posts','posts.post_id','action_logs.post_id')
                        ->leftJoin('categories','categories.category_id','posts.category_id')
                        ->groupBy('action_logs.post_id')
                        ->orderBy('view','desc')
                        ->get();

        // dd($data->toArray());
        return view('admin.trendPost',compact('data'));
    }
}
