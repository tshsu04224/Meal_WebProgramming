<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Post;
use App\Models\PostUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $profile = new Profile;
        $profile->username = $request->input('username');
        $profile->gender = $request->input('gender');
        $profile->birthday = $request->input('birthday');
        $profile->bio = $request->input('bio');
        $profile->profile_picture = $request->file('image');
        $profile->save();



        return redirect(route('profiles.show', ['profile' => $profile]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $user = $profile;

        return view('profiles.show', ['profile' => $profile, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $user = Auth::user();
        $avatar = $profile->avatar;
        return view('profiles.edit', ['profile' => $profile, 'user' => $user, 'avatar' => $avatar]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $profile->username = $request->input('username');
        $profile->gender = $request->input('gender');
        $profile->birthday = $request->input('birthday');
        $profile->bio = $request->input('bio');
        $profile->save();

        return redirect(route('profiles.show', ['profile' => $profile]));
    }

    public function postUsers($post)
    {
        $post = Post::find($post);
        $post_users = PostUser::where('post_id', $post->id)->get();
        $profiles = [];
        foreach ($post_users as $post_user) {
            $profiles[] = $post_user->user;
        }
        return view('profiles.postUsers', ['profiles' => $profiles]);
    }


    public function avatar(Request $request)
    {
        $imagePath = time();
        $request->avatar->move(storage_path('app/public'), $imagePath);
        $profile = Auth::user()->profile;
        $avatar = $profile->avatar;
        $avatar->image = $imagePath;
        $avatar->save();

        return redirect()->route('profiles.show', ['profile' => $profile]);
    }

    public function removeAvatar()
    {
        $user = Auth::user();
        Storage::delete($user->profile->avatar->image);
        $user->profile->avatar->image = NUll;
        $user->profile->avatar->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
