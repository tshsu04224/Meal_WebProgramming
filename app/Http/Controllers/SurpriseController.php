<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostUser;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;

class SurpriseController extends Controller
{
    public function surprise()
    {
        $now = Carbon::now();

        $user = Auth::user();
        $posts = Post::orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        $participatedPostIds = PostUser::where('user_id', $user->id)
            ->pluck('post_id');

        // 获取所有当前用户没有参加的饭局信息
        $postIds = Post::whereNotIn('id', $participatedPostIds)->get();
        
        $postLists = [];
        foreach ($postIds as $post) {
            $postDatetime = Carbon::create($post->date . $post->time)->setTimezone('Asia/Taipei');
            if ($postDatetime > $now && $post->status == 1) {
                $postLists[] = $post;
            }
        }

        if($postLists != []){
            $postLists = $postLists[array_rand($postLists)];
        }

        return view('surprise', ['postLists' => $postLists]);
    }
}
