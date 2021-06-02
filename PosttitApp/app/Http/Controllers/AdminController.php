<?php

namespace App\Http\Controllers;
use App\User;
use App\Posts;
use App\Profile;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class AdminController extends Controller
{

    public function index()
    {
        if(!is_null(auth()->user()))
        {
//            Check whether logged-in
            if(auth()->user()->isAdmin == 1 || $post->user == auth()->user())
            {
//            Check whether user is an admin
                $sports = Posts::where('topic','Sports')->count();
                $gaming = Posts::where('topic','Gaming')->count();
                $funny = Posts::where('topic','Funny')->count();
                $politics= Posts::where('topic','Politics')->count();
                $other = Posts::where('topic','Other')->count();


                $topic = array('Sports', 'Gaming', 'Funny', 'Politics', 'Other');
                $data  = array($sports, $gaming, $funny, $politics, $other);

                $profiles = Profile::orderBy('rating', 'DESC')->paginate(5);
                $profileName = array();
                $profileRating = array();
                foreach ($profiles as $profile)
                {
                    $user = User::find($profile->user_id);
                    array_push($profileName, $user->username);
                    array_push($profileRating, $profile->rating);
                }
                return view('admin.index',['Topics' => $topic, 'Data' => $data, 'Profile_Names' => $profileName, 'Profile_Ratings' => $profileRating]);
                //return the view of the admin statistics.
            }
        }
    }
}
