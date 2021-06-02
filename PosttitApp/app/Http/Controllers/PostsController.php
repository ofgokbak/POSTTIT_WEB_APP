<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Posts;
use App\Vote;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }
    //
    public function create()
    {
        //return posts folder create.blade.php - Onur
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            //'another' => '', - if you dont need validation - Onur
            'title' => 'required|max:140',
            'image' => 'image|nullable',
            'description' => 'required|max:500',
            'topic' => 'required',
        ]);


        if (array_key_exists("image", $data)) {
            $imagePath = request('image')->store('uploads', 'public');
             $image = Image::make(public_path("storage/{$imagePath}"))->fit(1280, 720);
             $image->save();
            //use auth user to save the post - Onur
            auth()->user()->posts()->create([
                'title' => $data['title'],
                'image' => $imagePath,
                'description' => $data['description'],
                'topic' => $data['topic'],
            ]);
        } else {
            // $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            // $image->save();
            //use auth user to save the post - Onur
            auth()->user()->posts()->create([
                'title' => $data['title'],
                'description' => $data['description'],
                'topic' => $data['topic'],
            ]);
        }






        return redirect('/home');
    }

    public function show(\App\Posts $post)
    {
        $uservotes = 0;
        if (auth()->user()) {
            //$user = auth()->user()->votes()->pluck('votes.user_id');
            $uservotes = auth()->user()->votes()->get()->toArray();
            //$uservotedposts = Posts::whereIn('user_id', $user)->latest()->get()->toArray();
            //dd($uservotes);

        }
        $comments = Comment::where('post_id', $post->id)->paginate(8);

        //dd($post);
        return view('posts.show', compact('post', 'uservotes', 'comments'));
    }

    public function delete(\App\Posts $post){


        Comment::where('post_id',$post->id)->delete();
        
        Vote::where('post_id',$post->id)->delete();
        
        Posts::where('id',$post->id)->delete();

         return redirect('/home')->with('success', 'Post has been removed successfully!');
     }
}
