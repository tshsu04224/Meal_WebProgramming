<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\PostUser;
use Carbon\Carbon;

use App\Notifications\MealReminder;
use App\Notifications\DeletePost;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Carbon::setLocale('zh-tw');
        $now = Carbon::now();

        $user = Auth::user();
        $posts = Post::orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        $participatedPostIds = PostUser::where('user_id', $user->id)
            ->pluck('post_id');

        // 获取所有当前用户没有参加的饭局信息
        $postIds = Post::whereNotIn('id', $participatedPostIds)
            ->get();

        $postLists = [];
        foreach ($postIds as $post) {
            $postDatetime = Carbon::create($post->date . $post->time)->setTimezone('Asia/Taipei');
            if ($postDatetime > $now && $post->status == 1) {
                $postLists[] = $post;
            }
        }

        $timeCreateds = [];
        foreach ($posts as $post) {
            $timeCreateds[$post->id] = Carbon::parse($post->created_at)->diffForHumans();
        }

        return view('posts.index', [
            'posts' => $posts,
            'postLists' => $postLists,
            'timeCreateds' => $timeCreateds
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $now = Carbon::now();
        $postDatetime = Carbon::create($request->date . $request->time)->setTimezone('Asia/Taipei');

        if ($postDatetime <= $now) {
            return redirect()->back()->withErrors(['time' => '不可輸入過去的時間']);
        }

        //user already create a post at this session
        $existingPost = Post::where('user_id', Auth::user()->id)
            ->where('date', $request->input('date'))
            ->where('time', $request->input('time'))
            ->first();

        if ($existingPost) {
            return redirect()->back()->withErrors(['time' => '您在這個時段已經創建一個飯局了']);
        }

        //user already join other post at this session
        $date = $request->input('date');
        $time = $request->input('time');
        $joiningPosts = PostUser::where('user_id', Auth::user()->id)->get();
        foreach ($joiningPosts as $joiningPost) {
            $joinPost = $joiningPost->post;
            if ($joinPost->date == $date && $joinPost->time == $time) {
                return redirect()->back()->withErrors(['time' => '您在這個時段已參加一個飯局了']);
            }
        }
        $post = new Post;
        $post->title = $request->input('title');
        $post->restaurant = $request->input('restaurant');
        $post->date = $request->input('date');
        $post->time = $request->input('time');
        $post->content = $request->input('content');
        $post->user_id = $request->user()->id;
        $post->save();

        $post_user = new PostUser;
        $post_user->post_id = $post->id;
        $post_user->user_id = $post->user->id;
        $post_user->save();

        return redirect(route('posts.show', ['post' => $post]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $exist = PostUser::where('user_id', Auth::user()->id)->where('post_id', $post->id)->exists();
        $postOwner = Post::where('user_id', Auth::user()->id)->where('id', $post->id)->exists();

        $post_users = PostUser::where('post_id', $post->id)->get();

        $avatars = [];
        foreach ($post_users as $postUser) {
            $user = User::find($postUser->user_id);
            $avatars[] = $user->profile->avatar;
        }
        return view('posts.show', ['post' => $post, 'exist' => $exist, 'postOwner' => $postOwner, 'avatars' => $avatars]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.show', ['post' => $post]);
        }
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->restaurant = $request->input('restaurant');
        $post->date = $request->input('date');  
        $post->time = $request->input('time');
        $post->content = $request->input('content');
        $post->save();

        return redirect(route('posts.show', ['post' => $post]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->id === $post->user_id) {

            $post_users = PostUser::where('post_id', $post->id)->get();
            foreach ($post_users as $post_user) {
                $user = User::find($post_user->user_id);
                $user->notify(new DeletePost($post));
            }
            $post->delete();
        }

        return redirect(route('/'));
    }

    public function notifyUsersBeforeEvent()
    {
        $now = Carbon::now();
        $oneHourFromNow = $now->copy()->addHour();


        $currentDate = $now->toDateString();
        $currentTime = $now->toTimeString();
        $oneHourFromNowDate = $oneHourFromNow->toDateString();
        $oneHourFromNowTime = $oneHourFromNow->toTimeString();

        $eventsToday = Post::where('date', $currentDate)
            ->whereBetween('time', [$currentTime, '23:59:59'])
            ->get();

        $eventsNextDay = Post::where('date', $oneHourFromNowDate)
            ->whereBetween('time', ['00:00:00', $oneHourFromNowTime])
            ->get();

        $posts = $eventsToday->merge($eventsNextDay);

        foreach ($posts as $post) {
            $post_users = PostUser::where('post_id', $post->id)->get();
            foreach ($post_users as $post_user) {
                $user = User::find($post_user->user_id);
                $user->notify(new MealReminder($post));
            }
        }

        return redirect()->back();
    }

    public function endPost(Request $request)
    {
        $post = Post::find($request->post_id);
        $post->status = 2;
        $post->save();
        return redirect(route('/'));
    }
}
