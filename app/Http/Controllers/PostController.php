<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }
    //
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(32);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        // dd('Creating post...');
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:2200'],
            'image' => ['required'],
        ]);

        // Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' => auth()->user()->id
        // ]);

        // Another way to create a post
        // $post = new Post();
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $request->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('dash.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('post.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    // public function authorize($ability, $arguments = [])
    // {
    //     return true;
    // }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Delete image
        $path_image = public_path('uploads/' . $post->image);
        if (File::exists($path_image)) {
            unlink($path_image);
        }

        return redirect()->route('dash.index', auth()->user()->username);
    }
}
