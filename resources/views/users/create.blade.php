@extends('layouts.app')

@section('title')
    @parent &dash; New User
@endsection

@section('content')
    <div class="container">
        @include('partials.breadcrumb')

        @include('partials.uifeedback')

        <div class="card mt-5">
            <div class="card-header border-bottom-0">
                <h5 class="card-title my-1">
                    New User
                </h5>
            </div>
            <form id="create_user_form" action="{{ URL::to('users') }}" method="POST">
                @csrf

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-row">
                            <label for="name" class="col-sm-2 col-form-label">
                                Name
                            </label>
                            <div class="col-sm-10">
                                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" required min="6">
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row">
                            <label for="email" class="col-sm-2 col-form-label">
                                Email
                            </label>
                            <div class="col-sm-10">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row">
                            <label for="password" class="col-sm-2 col-form-label">
                                Password
                            </label>
                            <div class="col-sm-10">
                                <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">
                                Confirm password
                            </label>
                            <div class="col-sm-10">
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                            </div>
                        </div>
                    </li>
                </ul>
            </form>
            <div class="card-footer">
                <div class="form-row pull-right">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success" form="create_user_form" name="return" value="1">Create & Add Another</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success" form="create_user_form">Create User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection