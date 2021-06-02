@extends('layouts.app')


@section('content')

<div class="grid-container">

    <div class="headings w-100 h-100">
        <div>
            <h5>Trending Now</h5>
        </div>


        <div class="cards w-100">
            @if(!empty($trendingposts) && sizeof($trendingposts) > 2)
            @for ($i = 0; $i < 3; $i++) <a href="/post/{{$trendingposts[$i]->id}}">
                <div class="card text-white h-100 w-100">
                    <img style="max-height: 180px; max-width:320px; filter: brightness(0.5);"
                        src="/storage/{{$trendingposts[$i]->image}}" class="card-img h-100" alt="...">
                    <div class="card-img-overlay w-100">

                        <h5 style="align-self:flex-end" class="card-title">
                            <?php $heading = $trendingposts[$i]->title;
                        if (str_word_count($heading) > 5) {
                        $heading = substr($heading, 0, 30) . "...";
                        } echo $heading;?>
                        </h5>
                        <p style="align-self:flex-end" class="card-text">
                            <?php $heading = $trendingposts[$i]->description;
                        if (str_word_count($heading) > 5) {
                                $heading = substr($heading, 0, 30) . "...";
                        } echo $heading;?>
                        </p>
                    </div>
                </div></a>
                @endfor
                @else
                <strong><h6>3 Post needed in order to display the content in this section</h6></strong>
                @endif


        </div>

    </div>

    <div class="side-menu w-100">
        <div class="posts">
            <div>
                <h5>Popular Posts</h5>
            </div>
            <ul class="list-group">
                @foreach ($postmenu as $post)

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a
                        href="/post/{{$post->id}}"><?php $heading = $post->title;
                                                                                                                                    if (str_word_count($heading) >6) {
                                                                                                                                        $heading = substr($heading, 0, 30) . "...";

                                                                                                                                    } echo $heading;?></a>
                    <span class="badge badge-primary badge-pill">{{$post->vote_count}}</span>
                </li>





                @endforeach
            </ul>
        </div>

        <div class="poptopics">
            <div>
                <h5>Popular Topics</h5>
            </div>
            <ul class="list-group">


                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a
                            href="#"><i class="fas fa-futbol"></i> Sports</a>
                        <span class="badge badge-primary badge-pill"></span>
                    </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a
                        href="#"><i class="fas fa-gamepad "></i> Gaming</a>
                    <span class="badge badge-primary badge-pill"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a
                        href="#"><i class="fas fa-handshake"></i> Politics</a>
                    <span class="badge badge-primary badge-pill"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a
                        href="#"><i class="fas fa-laugh-beam"></i> Funny</a>
                    <span class="badge badge-primary badge-pill"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a
                        href="#">Other</a>
                    <span class="badge badge-primary badge-pill"></span>
                </li>

            </ul>
        </div>

        <div class="footer">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <a href="#">
                            <li>Help</li>
                        </a>
                        <a href="#">
                            <li>About</li>
                        </a>
                        <a href="#">
                            <li>Privacy Policy</li>
                        </a>

                    </ul>
                    <center class="ff">Posttit Inc © 2020. All rights reserved</center>
                </div>
            </div>
        </div>

    </div>


    <div id="app" class="page-content w-100">
        <div>
            <h5>Posts</h5>
        </div>
        <div class="d-flex">

        <div class="dropdown p-1">
            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Session::get('view') == "card")<i class="fas fa-images"></i>@else<i class="fas fa-list"></i> @endif Change View
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/home/card"><i class="fas fa-images"></i> Card View</a>

                <a class="dropdown-item" href="/home/list"><i class="fas fa-list"></i> List View</a>

            </div>
        </div>	</div>&nbsp
        @if(sizeof($posts) > 0)
        @if(Session::get('view') == "card")
        @foreach ($posts as $post)
        <div class="card mb-4 w-100" style="width: 18rem;">
            <div class="vote_place"></div>

            @if (!is_null($post->image))
            <img style="" src="/storage/{{$post->image}}" class="card-img" alt="...">
            @endif


            <div class="card-body">
                <h5 class="card-title">
                    <h4>{{$post->title}}</h4>
                </h5>
                <p class="card-text">
                    <?php $heading = $post->description;
                    if (str_word_count($heading) > 300)
                    {$heading = substr($heading, 0, 800) . "...";
                    $post->image = $heading;
                    } echo $heading;?></p>
                <p class="card-text"><small class="text-muted">Posted by
                        <a href="{{ route('profile.show',$post->user_id) }}">

                            {{$post->user->username}}</a> on
                        {{$post->created_at}} - {{$post->comments()->count()}} Replies - <a href="">{{$post->topic}}</a> <br>
                        </small></p>


                            <!-- Admin can delete the post -->

                            @if(!is_null(auth()->user()))
                            <!-- Check whether logged-in -->
                                @if(auth()->user()->isAdmin == 1 || $post->user == auth()->user())
                                <!-- Check whether use is an admin -->
                                    <p style="margin-left:auto;"><a data-toggle="modal" data-target="#exampleModal{{$post->id}}" style="color: red;" href="">Delete Post</a>&nbsp;&nbsp;</p>
                                    <!-- Add delete post link  -->
                                @endif

                            @endif

                                <!-- Button trigger modal -->


                                <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete the post?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-secondary" data-dismiss="modal" href="">No</a>
                                                            <a class="btn btn-danger" href="/deletePost/{{$post->id}}">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                <div style="display:flex" class="bott">

                    <a href="/post/{{$post->id}}" class="btn btn-primary">Read</a>
                    <div style="margin-left:auto" class="voting">
                        <up-button post-id="{{$post->id}}" test="{{$post->vote_count ?? '0'}}"
                            uservotes="{{json_encode($uservotes)}}"></up-button>

                    </div>
                </div>

            </div>
        </div>
        @endforeach
        @elseif (Session::get('view') == "list")
            @foreach ($posts as $post)

                <div class="card w-100 mt-2">

                    <div class="card-body">

                        <h5 class="card-title">{{$post->title}}</h5>

                        <p class="card-text"><small class="text-muted">Posted by
                                <a href="{{ route('profile.show',$post->user_id) }}">

                                    {{$post->user->username}}</a> on
                                {{$post->created_at}} - {{$post->comments()->count()}} Replies - <a href="">{{$post->topic}}</a> <br>
                            </small></p>

                                <!-- Admin can delete the post -->


                                @if(!is_null(auth()->user()))
                                <!-- Check whether logged-in -->
                                    @if(auth()->user()->isAdmin == 1 || $post->user == auth()->user())
                                    <!-- Check whether use is an admin -->
                                        <p style="margin-left:auto;"><small><a data-toggle="modal" data-target="#exampleModal{{$post->id}}" style="color: red;" href="">Delete Post</a>&nbsp;&nbsp;</small></p>
                                         <!-- Add delete post link  -->
                                    @endif

                                @endif


                                <!-- Button trigger modal -->


                                <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete the post?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-secondary" data-dismiss="modal" href="">No</a>
                                                            <a class="btn btn-danger" href="/deletePost/{{$post->id}}">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                        <div style="display:flex" class="bott">

                            <a href="/post/{{$post->id}}" class="btn btn-primary">Read</a>
                            <div style="margin-left:auto" class="voting">
                                <up-button post-id="{{$post->id}}" test="{{$post->vote_count ?? '0'}}"
                                           uservotes="{{json_encode($uservotes)}}"></up-button>

                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endif
        &nbsp;
        <div>
            {{$posts->links()}}
        </div>
    </div>
    @else
        <center><h4>No Posts</h4></center>
    @endif
</div>
<style>
    .grid-container {

        height: 100%;
        display: grid;
        grid-column-gap: 1em;
        grid-row-gap: 2em;
        grid-template-columns: repeat(12, 1fr);

        justify-items: center;



        grid-template-areas:
            ". . . h h h h h h . . ."
            ". . . s s c c c c . . ."
            ". . . . . c c c c . . ."

    }



    .side-menu {
        grid-area: s;


        height: 100%;
        display: grid;
        grid-column-gap: 1em;
        grid-row-gap: 2em;
        grid-template-columns: repeat(2, 1fr);



        grid-template-areas:
            "m m"
            "t t"
            "f f"




    }

    .posts {
        grid-area: m;
    }

    .poptopics{
        grid-area: t;
    }


    .footer {
        grid-area: f;
    }

    #up {
        fill: rgba(56, 56, 56);
    }

    #down {
        fill: rgba(56, 56, 56);
    }

    #up:hover {
        fill: rgba(197, 55, 0);
    }



    #down:hover {
        fill: rgba(95, 115, 203);

    }

    #votelabel {
        font-size: 1.3em;
    }

    .active {
        background-color: red;
    }


    .page-content {
        grid-area: c;

    }

    .headings {
        grid-area: h;

    }

    .cards {
        display: flex;
       justify-content: space-between;
    }

    @media screen and (max-width: 1500px) {
        .grid-container {


            grid-template-areas:
                ". s s s c c c c c c . ."
                ". s s s c c c c c c . ."
                ". . . . c c c c c c . ."

        }

        .headings {
            display: none;
        }




    }

    @media screen and (max-width: 800px) {
        .grid-container {

            justify-items: center;
            padding: 4vw;
            grid-template-areas:
                "c c c c c c c c c c c c"
                "c c c c c c c c c c c c"
                "c c c c c c c c c c c c"

        }

        .headings {
            display: none;
        }

        .side-menu {
            display: none;
        }




    }
</style>
@endsection
