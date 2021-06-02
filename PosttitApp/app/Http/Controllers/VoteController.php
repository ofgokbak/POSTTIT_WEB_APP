<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeup(Posts $post)
    {

        $vote = auth()->user()->votes()->where('post_id', $post->id)->first();

        //echo $vote;
        if (is_null($vote)) {
            $p = Posts::find($post->id);
            $p->increment('vote_count');
            $p->save();
            auth()->user()->votes()->create([
                'vote_type' => 'UP',
                'post_id' => $post->id,
            ]);
        } else {
            if ($vote->vote_type == 'UP') {
                $p = Posts::find($post->id);
                $p->decrement('vote_count');
                $p->save();
                $vote->vote_type = '0';
                $vote->save();
            } else if ($vote->vote_type == 'DOWN') {
                $p = Posts::find($post->id);
                $p->increment('vote_count', 2);
                $p->save();
                $vote->vote_type = 'UP';
                $vote->save();
            } else if ($vote->vote_type == '0') {
                $p = Posts::find($post->id);
                $p->increment('vote_count');
                $p->save();
                $vote->vote_type = 'UP';
                $vote->save();
            }
        }
        $post = Posts::find($post->id);
        return $post->vote_count;
    }

    public function storedown(Posts $post)
    {
        $vote = auth()->user()->votes()->where('post_id', $post->id)->first();
        //echo $vote;
        if (is_null($vote)) {
            $p = Posts::find($post->id);
            $p->decrement('vote_count');
            $p->save();

            auth()->user()->votes()->create([
                'vote_type' => 'DOWN',
                'post_id' => $post->id,
            ]);
        } else {
            if ($vote->vote_type == 'DOWN') {
                $p = Posts::find($post->id);
                $p->increment('vote_count');
                $p->save();
                $vote->vote_type = '0';
                $vote->save();
            } else if ($vote->vote_type == 'UP') {
                $p = Posts::find($post->id);
                $p->decrement('vote_count', 2);
                $p->save();
                $vote->vote_type = 'DOWN';
                $vote->save();
            } else if ($vote->vote_type == '0') {
                $p = Posts::find($post->id);
                $p->decrement('vote_count');
                $p->save();
                $vote->vote_type = 'DOWN';
                $vote->save();
            }
        }

        $post = Posts::find($post->id);
        return $post->vote_count;
    }
}
