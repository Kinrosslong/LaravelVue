<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{

    public function index(Request $request)
    {   
        // $users = DB::select('select * from posts');
        // $user = DB::select('select * from post where status = ?', [10]); //这样是有占位符的 比较安全 参数绑定可以避免 SQL 注入攻击
        // $user = DB::select('select * from post where status = :status', ['status' => 1]);
        $pagesize = $request->input('pagesize');
        $pagenum = $request->input('pagenum');
        $num = ($pagenum - 1) * $pagesize;
        $users = DB::table('demo')->offset($num)->limit($pagesize)->get(); // get 方法获取表中所有记录     
        $count = DB::table('demo')->count();
        return ['list' => $users, 'count' => $count];
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function demo() 
    {
        // echo 456;
        echo '1'.print(2)+3;
        $users = DB::select('select * from posts');
        $users = DB::table('posts')->get(); 
        dd($users);
        return $users;
    }

    /**
     * 学习一下分支
     */
    public function fenzhi()
    {
        echo "学习分支";
        echo "第一次提交";
        echo "第二次提交";
    }
}
