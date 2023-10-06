<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{
    /*    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return $post->get();//$postの中身を戻り値にする。
    }*/
      public function index(Request $request,Post $posts)
    {
       
       $keyword = $request->input('keyword');

        $query = Post::query();

        if(!empty($keyword)) {
            $query->where('artist_name', 'LIKE', "%{$keyword}%")
                ->orWhere('venue', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->paginate(10);
        
       return view('posts.index')->with(['posts' => $posts,'keyword'=>$keyword]);  
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }
    
        public function show(Post $posts)
    {
        return view('posts.show')->with(['post' => $posts]);
     //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
        public function create()
    {
        return view('posts.create');
    }
        public function store(PostRequest $request, Post $post)
    {
        // dd($request->all());
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}
