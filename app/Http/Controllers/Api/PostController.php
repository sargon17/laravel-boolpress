<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::with("category")
            ->reorder("updated_at", "desc")
            ->get();
        $posts = $posts->map(function ($post) {
            return [
                "id" => $post->id,
                "title" => $post->title,
                "content" => $post->content,
                "slug" => $post->slug,
                "category" => $post->category->name,
                "image" => $post->image,
                "created_at" => $post->created_at->diffForHumans(),
                "updated_at" => $post->updated_at->diffForHumans(),
            ];
        });

        $result = [
            "results" => $posts,
            "success" => true,
        ];
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug", $slug)
            ->with("category", "tags")
            ->first();

        $result = [
            "result" => [
                "id" => $post->id,
                "title" => $post->title,
                "content" => $post->content,
                "category" => $post->category->name,
                "image" => $post->image,
                "updated_at" => $post->updated_at->diffForHumans(),
                "tags" => $post->tags->map(function ($tag) {
                    return $tag->name;
                }),
            ],
            "success" => true,
        ];

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
