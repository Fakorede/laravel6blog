<?php

namespace App\Http\Controllers;

use App\Image;
use App\BlogPost;
use App\Events\BlogPostPosted;
use App\Http\Requests\StorePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'posts.index',
            [
                'posts' => BlogPost::latestWithRelations()->get(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validatedData);


        if($request->hasFile('thumbnail')) 
        {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $blogPost->image()->save(
                Image::make(['path' => $path])
            );
        }

        event(new BlogPostPosted($blogPost));

        $request->session()->flash('status', 'Blog post was created!');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use ($id) {
            return BlogPost::with('comments', 'tags', 'user', 'comments.user')
                ->findOrFail($id);
        });

        // sessions to keep track of users
        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post-{$id}-users";

        $users = Cache::tags(['blog-post'])->get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            // if user is expired, remove from list and decrease counter else keep on cached list
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }
        // If user isnt on the list or was on the list and removed
        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }
        // update user with current time
        $usersUpdate[$sessionId] = $now;

        Cache::tags(['blog-post'])->forever($usersKey, $usersUpdate);

        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        return view('posts.show', [
            'post' => $blogPost,
            'counter' => $counter,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, "You can't edit this blog post");
        // }
        $this->authorize('update', $post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {

        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, "You can't edit this blog post");
        // }
        $this->authorize('update', $post);

        $validatedData = $request->validated();
        $post->fill($validatedData);

        if($request->hasFile('thumbnail')) 
        {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');

            if($post->image) 
            {
                Storage::disk('public')->delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else 
            {
                $post->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }

        $post->save();
        $request->session()->flash('status', 'Blog post was updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('delete-post', $post)) {
        //     abort(403, "You can't delete this blog post");
        // }
        $this->authorize('delete', $post);

        $post->delete();
        $request->session()->flash('status', 'Blog post was deleted!');

        return redirect()->route('posts.index');
    }
}
