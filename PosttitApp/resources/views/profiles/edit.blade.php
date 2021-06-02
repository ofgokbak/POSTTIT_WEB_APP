@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        {{-- <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> --}}

                    {{-- <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm"
                        class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <input id="description" type="text"
                            class="form-control @error('description') is-invalid @enderror" name="description"
                            value="{{old('description') ?? $user->profile->description}}">

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">URL</label>

                    <div class="col-md-6">
                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                            value="{{old('url') ?? $user->profile->url}}">

                        @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">Profile Image</label>

                    <div class="col-md-6">

                        <div class="form-group">
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        @error('image')

                        <strong>{{ $message }}</strong>

                        @enderror
                    </div>
                </div>



                <div class="form-group row pl-4">
                    <label for="button" class="col-md-4 col-form-label text-md-right"></label>

                    <button class="btn btn-primary">Update</button>

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