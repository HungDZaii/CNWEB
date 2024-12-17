<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view("Post.index", compact("posts"));
    }

    public function create(){
        return view('Post.create');
    }

    public function store(Request $request){
        //dd($request);
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], [
            'name.required' => 'Vui lòng chọn tên.',

            'content.required' => 'Vui lòng nhập số lượng.',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);
        return redirect()->route('Post.index')->with('success', 'Thêm bài viết thành công!');
    }

    public function edit($id){
        $post = Post::find($id);
        //dd($post);
        return view('Post.edit' , compact('post'));
    }

    public function update(Request $request , $id){
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], [
            'name.required' => 'Vui lòng chọn tên.',

            'content.required' => 'Vui lòng nhập số lượng.',
        ]);

        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);
        return redirect()->route('Post.index')->with('success', 'Sửa bài viết thành công!');
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('Post.index')->with('success', 'Xóa bài viết thành công!');
    }
}
