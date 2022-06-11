<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc("updated_at");
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.create", compact(["categories", "tags"]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "title" => "required|max:250",
                "content" => "required",
                "category_id" => "required|exists:categories,id",
                "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            ],
            [
                "title.required" => "The title is required",
                "title.max" =>
                    "The title may not be greater than 250 characters",
                "content.required" => "The content is required",
                "category_id.required" => "The category is required",
                "category_id.exists" => "The category does not exist",
                "image.image" => "The image must be an image",
                "image.mimes" =>
                    "The image must be a file of type: jpeg, png, jpg, gif, svg",
                "image.max" =>
                    "The image may not be greater than 2048 kilobytes",
            ]
        );

        $postData = $request->all();
        $newPost = new Post();
        $newPost->fill($postData);
        $newPost->slug = Post::createSlug($postData["title"]);
        $newPost->image = $request["image"]
            ? Storage::put("posts", $request["image"])
            : null;
        $newPost->save();

        $newPost->tags()->sync($request->tags);

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (!$post) {
            abort(404);
        }
        $category = Category::find($post->category_id);
        $tags = $post->tags;
        return view("admin.posts.show", compact("post", "category", "tags"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (!$post) {
            abort(404);
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view("admin.posts.edit", compact("post", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title" => "required|max:250",
            "content" => "required",
            "category_id" => "required|exists:categories,id",
        ]);

        $postData = $request->all();
        $post->fill($postData);
        $post->slug = Post::createSlug($postData["title"]);
        $post->update();
        return redirect()->route("admin.posts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post) {
            $post->tags()->sync([]);
            $post->delete();
        }
        return redirect()->route("admin.posts.index");
    }
}
