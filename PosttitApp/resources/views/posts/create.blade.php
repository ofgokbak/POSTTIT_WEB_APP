@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/post" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Post</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Post Title</label>

                            <div class="col-md-6">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">#</span>
                                    </div>
                                    <input  id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title') }}" autocomplete="title" autofocus>

                                </div>

                                @error('title')

                                <strong>{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">Post Topic</label>

                            <div class="col-md-6">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Kind</label>
                                    </div>
                                    <select class="custom-select form-control @error('topic') is-invalid @enderror"
                                        name="topic" value="{{ old('topic') }}" id="topic" name="Subject"
                                        autocomplete="title" autofocus>
                                        <option value="Sports">Sports</option>
                                        <option value="Gaming">Gaming</option>
                                        <option value="Politics">Politics</option>
                                        <option value="Funny">Funny</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                @error('topic')

                                <strong>{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Post Image</label>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>

                                @error('image')

                                <strong>{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Post
                                Description</label>

                            <div class="col-md-6">

                                <textarea class="form-control" id="description" rows="7" name="description"></textarea>

                                @error('description')

                                <strong>{{ $message }}</strong>

                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pl-4">
                            <label for="button" class="col-md-4 col-form-label text-md-right"></label>

                            <button class="btn btn-primary">Add New Post</button>

                            @error('button')

                            <strong>{{ $message }}</strong>

                            @enderror
                        </div>
                    </div>



                </div>
            </div>
        </div>
</div>
</form>
</div>
@endsection
