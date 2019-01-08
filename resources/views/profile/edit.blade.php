@extends('layouts.app')

@section('title')
    @parent &dash; Edit Profile
@endsection

@section('content')
    <div class="container">
        @include('partials.breadcrumb')

        @include('partials.uifeedback')

        <div class="card mt-5">
            <div class="card-header border-bottom-0">
                <div class="form-row align-items-center">
                    <div class="col">
                        <h5 class="card-title my-1">
                            Edit Profile
                        </h5>
                    </div>
                </div>
            </div>
            <form id="edit_profile_form" action="{{ URL::to('profile') }}" method="POST">
                @method('PUT')
                @csrf

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input id="name" type="text" name="name" value="{{ old('name', $profile->name) }}" class="form-control" placeholder="Name" required min="6">
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input id="email" type="email" name="email" value="{{ old('email', $profile->email) }}" class="form-control" placeholder="Email" required>
                            </div>
                        </div>                        
                    </li>
                    <li class="list-group-item">
                        <div class="form-row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input id="password" type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm password</label>
                            <div class="col-sm-10">
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                            </div>
                        </div>
                    </li>
                </ul>
            </form>

            <div class="card-footer">
                <div class="form-row pull-right">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success pull-right" form="edit_profile_form" name="return" value="1">Update & Continue Editing</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success pull-right" form="edit_profile_form">Update Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection