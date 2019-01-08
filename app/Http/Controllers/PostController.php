<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\PostCreateRequest;
use Carbon\Carbon;
use TsfCorp\UiFeedback\Facades\UiFeedback;
use TsfCorp\UiFeedback\MessageFormat;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __contruct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        $paginator = Post::paginate();

        return view('posts.index')
            ->with('paginator', $paginator);
    }

    public function show(Post $post)
    {
        return view('posts.show')
            ->with('post', $post);
    }

    public function create(Request $request)
    {
        $post = new Post;

        return view('posts.create')
            ->with('post', $post);
    }

    public function store(PostCreateRequest $request)
    {
        $post = new Post($request->all());
        $post->user_id = Auth::user()->id;

        if ($request->get('publish')) {
            $post->published_at = Carbon::now();
        }

        $post->save();

        UiFeedback::set(MessageFormat::SUCCESS, 'Post successfully created!');

        if ($request->get('return')) {
            return back();
        }

        return redirect('posts/' . $post->id);
    }

    public function edit(post $post)
    {
        return view('posts.edit')
            ->with('post', $post);
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->title = $request->get('title');
        $post->body = $request->get('body');

        if ($request->get('publish')) {
            $post->published_at = Carbon::now();
        }

        $post->save();

        UiFeedback::set(MessageFormat::SUCCESS, 'Post successfully updated!');

        if ($request->get('return')) {
            return back();
        }

        return redirect('posts/' . $post->id);
    }

    public function destroy(post $post)
    {
        $post->delete();

        UiFeedback::set(MessageFormat::SUCCESS, 'Post successfully deleted!');

        return redirect('posts');
    }
}
