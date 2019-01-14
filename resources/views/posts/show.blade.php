@extends('layouts.app')

@section('title')
    @parent &dash; Post Details
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
                            Post Details
                        </h5>
                    </div>
                    @can('delete', $post)
                        <div class="col-auto">
                            <button type="submit" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete_modal" data-action="{{ URL::to('posts/' . $post->id) }}">
                                <i class="fa fa-2x fa-trash-o"></i>
                            </button>
                        </div>
                    @endcan
                    @can('update', $post)
                        <div class="col-auto">
                            <a class="btn btn-sm btn-outline-primary" href="{{ URL::to('posts/' . $post->id . '/edit') }}">
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
                            <a href="{{ URL::to('users/' . $post->user_id) }}">
                                {{ $post->user->name }}
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
                            @if($post->rating)
                                <i class="fa fa-2x fa-star px-1" style="color:rgb(255, 200, 0);"></i>
                                <div>
                                    <label class="my-0" style="font-size: 18px">
                                        {{ $post->rating }}
                                    </label>
                                    <label class="text-muted my-0">
                                        /10
                                    </label> 
                                </div>
                            @else
                                <b>-</b>
                            @endif
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row">
                        <label class="col-sm-2 col-form-label">
                            Reviews
                        </label>
                        <label class="col-sm-10 col-form-label">
                            {{ $post->reviews->count() }}
                        </label>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row">
                        <label class="col-sm-2 col-form-label">
                            Title
                        </label>
                        <label class="col-sm-10 col-form-label">
                            {{ $post->title }}
                        </label>
                    </div>
                </li>

                <li class="list-group-item">
                     <div class="form-row">
                        <label class="col-sm-2 col-form-label">
                            Body
                        </label>
                        <div class="col-sm-10 border p-2">
                            {!! $post->body !!}
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row align-items-center">
                        <label class="col-sm-2 col-form-label">
                            Published At
                        </label>
                        <label class="col-sm-10 col-form-label">
                            @if($post->published_at) 
                                {{ $post->published_at->toDayDateTimeString() }}
                            @else
                                <i class="text-muted">Unpublished</i>
                            @endif
                        </label>
                    </div>
                </li>
            </ul>
        </div>
        
        <div class="card mt-5">
            <div class="card-header">
                <div class="form-row align-items-center">
                    <div class="col">
                        <h5 class="card-title my-1">
                            Reviews
                        </h5>
                    </div>
                    @can('attach-review', $post)
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ URL::to('reviews/create?post_id=' . $post->id) }}">Attach Review</a>
                        </div>
                    @endcan
                </div>
            </div>
            @if($post->reviews->count())
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 100px">
                                    ID
                                </th>
                                <th scope="col">
                                    User
                                </th>
                                <th scope="col" class="text-center">
                                    Rating
                                </th>
                                <th scope="col" class="text-center" width="180">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post->reviews as $review)
                                <tr>
                                    <th scope="row" class="text-center align-middle">
                                        {{ $review->id }}
                                    </th>
                                    <td class="align-middle">
                                        <a href="{{ URL::to('users/' . $review->user_id) }}">
                                            {{ $review->user->name }}
                                        </a>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-inline-flex">
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
                                    </td>
                                    <td class="text-center align-middle">
                                        @can('view', $review)
                                            <a class="btn btn-sm btn-link" href="{{ URL::to('reviews/' . $review->id) }}" title="Show Review">
                                                <i class="fa fa-2x fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('update', $review)
                                            <a class="btn btn-sm btn-link" href="{{ URL::to('reviews/' . $review->id . '/edit') }}" title="Edit Review">
                                                <i class="fa fa-2x fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $review)
                                            <button type="submit" class="btn btn-sm btn-link" title="Delete Review" data-toggle="modal" data-target="#delete_modal" data-action="{{ URL::to('reviews/' . $review->id) }}">
                                                <i class="fa fa-2x fa-trash-o"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center text-muted py-3">
                    <i class="fa fa-5x fa-table"></i>
                    <h6 class="card-title">
                        No records found
                    </h6>
                    @can('attach-review', $post)
                        <a href="{{ URL::to('reviews/create?post_id=' . $post->id) }}">
                            <button class="btn btn-sm btn-outline-primary">Attach Review</button>
                        </a>
                    @endcan
                </div>
            @endif
        </div>

        @include('partials.delete_modal')
    </div>
@endsection