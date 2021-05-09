<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // To Get Posts With Comments
        $posts = Post::with(['comments'=>function($q) {
            $q ->select('id','post_id','comment');
        }])->get();
        return view('home',compact('posts'));
    }

    public function saveComment(Request $request) {
        // dd($request);
        Comment::create([
            'user_id' => Auth::id(),
//            'user_name' => Auth::user()->name,
            'comment' => $request ->post_content,
            'post_id' => $request ->post_id,
     ]);

        $data =[
            'user_id' => Auth::id(),
            'user_name'  => Auth::user() -> name,
            'comment' => $request -> post_content,
            'post_id' =>$request -> post_id ,
        ];

        event(new NewNotification($data));
        return redirect() -> back() -> with(['success'=> 'تم اضافه تعليقك بنجاح ']);
    }
}
