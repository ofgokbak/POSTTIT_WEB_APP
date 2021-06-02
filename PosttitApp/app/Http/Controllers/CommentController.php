<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Posts;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //


    public function store(Posts $post)
    {

        $data = request()->validate([
            //'another' => '', - if you dont need validation - Onur
            'comment' => 'required',

        ]);


        auth()->user()->comments()->create([
            'comment' => $data['comment'],
            'post_id' => $post->id

        ]);

        return redirect("/post/$post->id");
    }

    public function delete(Comment $comment){

       $comment = Comment::find($comment->id);
       $post = Posts::find($comment->post_id);
       $comment->delete();
        return redirect("/post/$post->id")->with('success', 'Your message has been sent successfully!');
    }

}
