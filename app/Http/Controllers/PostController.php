<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\Response
    {
        $res = [
            'status' => true,
            'data' => Post::latest()->get(),
            'message' => 'enjoy the meat'
        ];
        return response($res, 200);
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
    public function store(Request $request): \Illuminate\Http\Response
    {
        $request->validate([
            'user_id' => ['required'],
            'title' => ['required', 'string'],
            'summary' => ['string'],
            'filename' => ['required'],
            'filename.*' => ['image'],
            'description' => ['required', 'string']
        ]);

        $data = array();

        if ($request->has('filename')) {
            foreach ($request->filename as $image) {
                $img = Image::make($image)->encode('webp')->fit(1080);
                $filename = config('app.name') . '-posts' . '-' . Str::random('10') . '-' .time() . '.webp';
                $img->save(storage_path('app/public/images/') . $filename);
                $data[] = $filename;
            }
        }

        $post = Post::create([
            'user_id' => $request->input('user_id'),
            'title' => $request->input('title'),
            'slug' => Str::of($request->input('title') . '-' . Str::random(7))->slug('-'),
            'summary' => $request->input('summary'),
            'filename' => json_encode($data),
            'description' => $request->input('description')
        ]);

        $res = [
            'status' => true,
            'data' => $post,
            'message' => 'post created successfully'
        ];

        return response($res, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->filename = json_decode($post->filename);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'summary' => ['string'],
            'description' => ['required', 'string']
        ]);

        $post->update($request->only(['title', 'summary', 'description']));

        $res = [
            'status' => true,
            'data' => $post,
            'message' => 'post updated successfully'
        ];

        return response()->json($res, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        foreach (json_decode($post->filename) as $file){
            Storage::delete('public/images/' . $file);
        }
        return $post->delete();
    }

    public function search(Request $request)
    {
        if ($request->input('q') === null) {
            return null;
        } else {
            $result = Post::where('title', 'like', '%' . $request->input('q') . '%')->get();
            return response()->json([
                'result' => $result
            ]);
        }
    }
}
