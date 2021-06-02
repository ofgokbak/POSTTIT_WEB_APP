<?php

namespace App\Http\Controllers;

use App\User;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $uservotes = 0;
        if (auth()->user()) {
            //$user = auth()->user()->votes()->pluck('votes.user_id');
            $uservotes = auth()->user()->votes()->get()->toArray();
            //$uservotedposts = Posts::whereIn('user_id', $user)->latest()->get()->toArray();
            //dd($uservotes);

        }

        if(Session::get('toggle') == null ){
            Session::put('view', 'card');
            Session::put('toggle', 1);
        }


        //dd($uservotedposts);
        $posts = Posts::orderBy('created_At', 'DESC')->paginate(5)  ;
        $tpost = Posts::orderBy('created_At', 'DESC')->get();
        $postmenu = Posts::orderBy('vote_count', 'DESC')->paginate(10);


        $trendingposts = array();
        foreach ($tpost as $post) {
            if (!is_null($post->image)) {

//                $img = Image::make(public_path("storage/{$post->image}"));
//
//                $img->resize(320, 240);

                array_push($trendingposts, $post);
            }
        }
        //dd($trendingposts);
        //$posts = Posts::all();

        return view('home', ['posts' => $posts, 'uservotes' => $uservotes, 'postmenu' => $postmenu, 'trendingposts' => $trendingposts]);
    }

    public function card(){

        Session::put('view', 'card');
        return redirect('/home');
    }

    public function list(){

        Session::put('view', 'list');
        return redirect('/home');
    }


}
