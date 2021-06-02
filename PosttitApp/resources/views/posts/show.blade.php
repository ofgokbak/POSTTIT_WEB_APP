@extends('layouts.app')

@section('content')
<div id="app" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border:none;" class="card">


                <div style="background-color:rgba(248, 250, 252);" class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            Your comment deleted successfully!
                        </div>
                    @endif
                    <div class="card mb-4 w-100" style="width: 18rem;">
                        @if (!is_null($post->image))
                        <img style="" src="/storage/{{$post->image}}" class="card-img" alt="...">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">
                                <h4>{{$post->title}}</h4>
                            </h5>
                            <p class="card-text">{{$post->description}}</p>
                            <div class="bott">
                                <p class="card-text">Posted by
                                        <a href="{{ route('profile.show',$post->user_id) }}">{{$post->user->username}}</a> on {{$post->created_at}}
                                        - {{$post->comments()->count()}} Replies</p>    



                                <div style="margin-left:auto" class="voting">
                                    <div>
                                        <up-button post-id="{{$post->id}}" test="{{$post->vote_count ?? '0'}}"
                                            uservotes="{{json_encode($uservotes)}}">
                                        </up-button>
                                    </div>


                                </div>
                            </div>


                                            <!-- Admin can delete the post -->

                                     @if(!is_null(auth()->user()))
                                        <!-- Check whether logged-in -->
                                        
                                        @if(auth()->user()->isAdmin == 1 ?? '')
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

                            <form action="/comment/{{$post->id}}">
                                @csrf
                                <div class="form-group">

                                    <textarea class="form-control" id="comment" name="comment" rows="3"
                                        placeholder="Enter Comment"></textarea>
                                </div>
                                @error('comment')

                                <strong>{{ $message }}</strong>

                                @enderror
                                &nbsp;&nbsp;
                                <center><button class="btn btn-primary">Add Comment</button></center>
                            </form>
                            <div class="pt-2">
                                <hr>
                            </div>

                            @foreach ($comments as $comment)

                            <div style="box-shadow: 0 0 3px #e0e7ef; border: 1px solid #e7e7e7;"
                                class="media pt-4 pb-2 pl-2 ">
                                @if($comment->user->profile->image == null || $comment->user->profile->image == "")
                                    <i class="fas fa-user fa-2x pl-3"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @else
                                <img style="max-height:50px; max-witdh:50px;"
                                    src="{{$comment->user->profile->profileImage()}}" class="mr-3 rounded-circle"
                                    alt="...">
                                @endif
                                <div class="media-body">
                                    <a  href="{{ route('profile.show',$post->user_id) }}">
                                        <h5 class="mt-0">{{$comment->user->username}}</h5>

                                    </a>
                                    {{$comment->comment}}
                                    <div class="d-flex">
                                        <div><small> Posted on {{$comment->created_at}}</small></div>
                                        @can('delete', $comment)

                                            <div style="margin-left:auto;"><small><a data-toggle="modal" data-target="#exampleModal{{$comment->id}}" style="color: red;" href="">Delete</a>&nbsp;&nbsp;</small></div>
                                            <!-- Button trigger modal -->



                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Comment</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete the comment?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-secondary" data-dismiss="modal" href="">No</a>
                                                            <a class="btn btn-danger" href="/delete/{{$comment->id}}">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endcan

                                    </div>


                                </div>
                            </div>
                            <hr>
                            @endforeach
                            <div class="pt-5">
                                {{$comments->links()}}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<style>
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

    .bott {
        display: flex;
    }

    @media screen and (max-width: 1200px) {
        .bott {
            display: block;
        }
    }
</style>
@endsection
