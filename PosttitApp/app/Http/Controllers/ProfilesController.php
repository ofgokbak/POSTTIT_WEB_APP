<?php

namespace App\Http\Controllers;

use App\User;
use App\Posts;
use App\Comment;
use App\Vote;
use App\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    public function index($user)
    {
        //dd(User::find($user)); see user property details - Onur
        //find the user and assign it the $user
        $user = User::findOrFail($user);

        $uposts = $user->posts()->paginate(5);
        $uservotes = 0;
        if (auth()->user()) {
            //$user = auth()->user()->votes()->pluck('votes.user_id');
            $uservotes = auth()->user()->votes()->get()->toArray();
            //$uservotedposts = Posts::whereIn('user_id', $user)->latest()->get()->toArray();
            //dd($uservotes);

        }

        //return the view of the user
        return view('profiles.index', ['user' => $user, 'uposts' => $uposts, 'uservotes' => $uservotes]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'description' => 'max:120',
            'url' => 'url|nullable',
            'image' => 'image|nullable',

        ]);



        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            //$image->resize(50, 50);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
    public function delete(User $user){

        Comment::where('user_id',$user->id)->delete();
        Vote::where('user_id',$user->id)->delete();
        $posts = Posts::where('user_id',$user->id)->get();
        foreach($posts as $post)
        {
            Comment::where('post_id',$post->id)->delete();
            Vote::where('post_id',$post->id)->delete();
        }
        
        Posts::where('user_id',$user->id)->delete();
        Profile::where ('user_id',$user->id)->delete();
        User::where('id',$user->id)->delete();
        

         return redirect('/home')->with('success', 'Post has been removed successfully!');
     }
}
