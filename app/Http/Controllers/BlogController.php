<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('blog.index', compact('posts'));
    }
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xml,csv|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        // Process the uploaded file as needed
        // call the existing import logic

        return redirect('/')->with('success', 'File uploaded successfully!');
    }
    public function show(Post $post)
    {
    $posts = Post::all(); 
        return view('blog.show', compact('post', 'posts'));
    }
    
    public function edit(Post $post)
    {
        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
    // Validate and update the post
        $request->validate([
            'title' => 'required',
            'content' => 'required',
    ]);

    $post->update($request->all());

    return redirect()->route('blog.show', $post);
}
}
