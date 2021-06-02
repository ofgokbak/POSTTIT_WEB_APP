@extends('layouts.app')

@section('content')
<div class="grid-container">
    <div class="page-content">

        <div class="content-head w-100">
            <ul class="list-group list-group-horizontal-lg">
                <a href="#" class="list-group-item list-group-item-action">Posts</a>
                <a href="#" class="list-group-item list-group-item-action">Replies</a>
                <a href="#" class="list-group-item list-group-item-action">Votes</a>
            </ul>
        </div>

        <div id="app" class="content-content">

            @if ($user->posts->count()<=0) <center>

                <h4>No posts</h4>
                </center>
                @endif

                @foreach ($uposts as $post)

                <div class="card mb-4 w-100 post-container" style="width: 18rem;">
                    <div class="vote_place"></div>
                    @if (!is_null($post->image))
                    <img style="" src="/storage/{{$post->image}}" class="card-img" alt="...">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">
                            <h4>{{$post->title}}</h4>
                        </h5>
                        <p class="card-text"><?php $heading = $post->description;
                                    if (str_word_count($heading) > 300) {
                                        $heading = substr($heading, 0, 800) . "...";
                                        $post->image = $heading;
                                    } echo $heading;?></p>
                        <p class="card-text"><small class="text-muted">Posted by
                                <a href="">{{$user->username}}</a> on {{$post->created_at}}-
                                {{$post->comments()->count()}} Replies</small></p>
                        <div style="display:flex" class="bott">

                            <a href="/post/{{$post->id}}" class="btn btn-primary">Read</a>
                            <div style="margin-left:auto" class="voting">
                                <up-button post-id="{{$post->id}}" test="{{$post->vote_count ?? '0'}}"
                                    uservotes="{{json_encode($uservotes)}}">
                                </up-button>

                            </div>
                        </div>
                    </div>
                </div>



                @endforeach
                <div>
                    {{$uposts->links()}}
                </div>
        </div>
    </div>

    <div class="side-menu">

        <div class="profile">
            <div class="card">
                <div class="card-body">

                    <center>
                        @if($user->profile->image == null || $user->profile->image == "")
                            <i class="fas fa-user fa-5x"></i>
                        @else
                        <img style="max-width:150px;
                                              max-height:150px;" ;id="acc" src="{{$user->profile->profileImage()}}"
                            class="rounded-circle w-100
                                                                             " alt="...">
                            @endif
                    </center>

                    &nbsp;
                    <h5 style="  font-weight: bold;" class="card-title">{{$user->username}}  
                    @if(!is_null(auth()->user()))
                    <!-- Check whether logged-in -->
                                        
                        @if($user->isAdmin == 1 ?? '')
                        <!-- Check whether use is an admin -->
                        
                        (admin)
                        <!-- Display the admin in a parenthesis with username -->
                        @endif
                    
                    @endif</h5>
                    <div style="display:flex; justify-content:space-between" class="info">
                        <label style="  font-weight: bold;" for="">Rating</label>
                        <label style="  font-weight: bold;" for="">Joined At</label>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items: flex-end;" class="info">
                        <label for=""><i class="fas fa-star"></i></center>
                            {{$user->profile->rating ?? '1'}}</label>
                        <label for=""><i class="fas fa-birthday-cake"></i> {{$user->created_at->format('Y-m-d') }}</label>
                    </div>&nbsp;
                    <p class="card-text">{{$user->profile->description ?? 'No biography yet.'}}</p>
                    <p class="card-text"><a href="{{$user->profile->url}}">{{$user->profile->url ?? ''}}</a></p>

                    @can('update', $user->profile)
                    <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
                    @endcan
                    <br><br>

                            @if(!is_null(auth()->user()))
                            <!-- Check whether logged-in -->
                    
                                @if(auth()->user()->isAdmin == 1)
                                <!-- Check whether user is an admin -->
                                
                                <p style="margin-left:auto;"><a data-toggle="modal" data-target="#exampleModal{{$user->id}}" style="color: red;" href="">Delete User</a>&nbsp;&nbsp;</p>
                                <!-- Add Delete User link  -->
                                @endif
                                
                            @endif
                                <!-- Button trigger modal -->
                         
                         
                                <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete {{$user->username}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-secondary" data-dismiss="modal" href="">No</a>
                                                            <a class="btn btn-danger" href="/profile/{{$user->id}}/delete">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                </div>
            </div>
        </div>


        <div class="profile-mobile">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="..." class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>

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



</div>

<style>
    .grid-container {
        margin-top: 2vh;
        height: 100%;
        display: grid;
        grid-column-gap: 1em;
        grid-row-gap: 2em;
        grid-template-columns: repeat(12, 1fr);



        grid-template-areas:
            ". . . s s c c c c . . ."
            ". . . s s c c c c . . ."
            ". . . . . c c c c . . ."
    }

    .page-content {
        grid-area: c;

        height: 100%;
        display: grid;
        grid-column-gap: 1em;
        grid-row-gap: 2em;
        grid-template-columns: repeat(5, 1fr);
        grid-auto-rows: minmax(min-content, max-content);




        grid-template-areas:
            "h h h h h "
            "m m m m m "

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

    .side-menu {
        grid-area: s;


        height: 100%;
        display: grid;
        grid-column-gap: 1em;
        grid-row-gap: 2em;
        grid-template-columns: repeat(2, 1fr);



        grid-template-areas:
            "p p"
            "f f"
    }

    .content-head {
        grid-area: h;

    }

    .content-content {
        grid-area: m;

    }

    .profile {
        grid-area: p;

    }

    .profile-mobile {
        display: none;
    }

    .footer {
        grid-area: f;

    }




    @media screen and (max-width: 1150px) {
        .profile-mobile {
            display: none;
        }

        .profile {
            display: none;
        }

        .side-menu {
            display: none;
        }


        .grid-container {
            padding: 4vw;
            justify-items: center;
            grid-template-areas:
                ". . s s s s s s s s . ."
                ". . c c c c c c c c . ."
                ". . c c c c c c c c . ."
        }

        .page-content {
            width: 100%;
        }




    }

    @media screen and (max-width: 500px) {
        .profile-mobile {
            display: none;
        }

        .profile {
            display: none;
        }

        .side-menu {
            display: none;
        }


        .grid-container {
            padding: 4vw;
            justify-items: center;
            grid-template-areas:
                "s s s s s s s s s s s s"
                "c c c c c c c c c c c c"
                "c c c c c c c c c c c c"
        }

        .page-content {
            width: 100%;
        }




    }
</style>

@endsection
