<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("admin.users.index", compact("users"));
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
    public function show(User $user)
    {
        return view("admin.users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!$user) {
            abort(404);
        }

        return view("admin.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                "name" => "required|max:250",
                "email" => "required|email|max:250",
                "avatar" => "nullable|mimes:jpg,png|max:2048",
                "cover" => "nullable|mimes:jpg,png|max:2048",
            ],
            [
                "name.required" => "The name is required",
                "name.max" => "The name may not be greater than 250 characters",
                "email.required" => "The email is required",
                "email.email" => "The email must be a valid email address",
                "email.max" =>
                    "The email may not be greater than 250 characters",
                "avatar.image" => "The avatar must be an image",
                "cover.image" => "The cover must be an image",
                "avatar.max" =>
                    "The avatar may not be greater than 2048 kilobytes",
                "cover.max" =>
                    "The cover may not be greater than 2048 kilobytes",
                "avatar.mimes" => "The avatar must be a file of type: jpg, png",
                "cover.mimes" => "The cover must be a file of type: jpg, png",
            ]
        );

        $userData = $request->all();
        $user->fill($userData);
        // $user->avatar = Storage::put("public/users", $request["avatar"]);
        // $user->cover = Storage::put("public/users", $request["cover"]);
        $user->avatar = $request->file("avatar")
            ? Storage::put("users", $request->file("avatar"))
            : $user->avatar;
        $user->cover = $request->file("cover")
            ? Storage::put("users", $request->file("cover"))
            : $user->cover;
        $user->update();
        return redirect()->route("admin.users.show", $user);
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
