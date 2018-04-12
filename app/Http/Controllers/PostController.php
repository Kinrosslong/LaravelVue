<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostController extends Controller
{

    public function index()
    {   
       return Post::paginate(10);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function demo() 
    {
        // echo 456;
        $users = DB::select('select * from posts');
        $users = DB::table('posts')->get(); 
        dd($users);
        return $users;
    }
}
