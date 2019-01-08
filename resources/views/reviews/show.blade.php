@extends('layouts.app')

@section('title')
    @parent &dash; Review Details
@endsection

@section('content')
    <div class="container">
        @include('partials.breadcrumb')

        @include('partials.uifeedback')

        <div class="card mt-5">
            <div class="card-header">
                <div class="form-row align-items-center">
                    <div class="col">
                        <h5 class="card-title my-1">
                            Review Details
                        </h5>
                    </div>
                    @can('delete', $review)
                        <div class="col-auto">
                            <button type="submit" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete_modal" data-action="{{ URL::to('reviews/' . $review->id) }}">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </button>
                        </div>
                    @endcan
                    @can('update', $review)
                        <div class="col-auto">
                            <a class="btn btn-sm btn-outline-primary" href="{{ URL::to('reviews/' . $review->id . '/edit') }}">
                                <i class="fa fa-2x fa-edit"></i>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <label class="col-sm-2 col-form-label">
                            User
                        </label>
                        <label class="col-sm-10 col-form-label">
                            @if($review->user) 
                                <a href="{{ URL::to('users/' . $review->user_id) }}">
                                    {{ $review->user->name }}
                                </a>
                            @else
                                <i class="text-muted">Anonymous</i>
                            @endif
                        </label>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row">
                        <label class="col-sm-2 col-form-label">
                            Post
                        </label>
                        <label class="col-sm-10 col-form-label">
                            <a href="{{ URL::to('posts/' . $review->post_id) }}">
                                {{ $review->post->title }}
                            </a>
                        </label>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row">
                        <label class="col-sm-2 col-form-label">
                            Rating
                        </label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <i class="fa fa-2x fa-star px-1" style="color:rgb(255, 200, 0);"></i>
                            <div>
                                <label class="my-0" style="font-size: 18px">
                                    {{ $review->rating }}
                                </label>
                                <label class="text-muted my-0">
                                    /10
                                </label> 
                            </div>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                     <div class="form-row">
                        <label class="col-sm-2 col-form-label">
                            Body
                        </label>
                        <div class="col-sm-10 border p-2">
                            {!! $review->body !!}
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row">
                        <label class="col-sm-2 col-form-label">
                            Last Update
                        </label>
                        <label class="col-sm-10 col-form-label">
                            {{ $review->updated_at->diffForHumans() }}
                        </label>
                    </div>
                </li>
            </ul>
        </div>

        @include('partials.delete_modal')
    </div>
@endsection