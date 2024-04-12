<?php
namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;


class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'website_id' => 'required|exists:websites,id',
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
    
        $post = new Post;
        $post->website_id = $validated['website_id'];
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();
    
        return response()->json($post, 201);
    }
}
