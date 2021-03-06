@extends('layouts.app')

@section('title')
    @parent &dash; Profile Details
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
                            Profile Details
                        </h5>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete_modal" data-action="{{ URL::to('profile') }}">
                            <i class="fa fa-2x fa-trash-o"></i>
                        </button>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-sm btn-outline-primary" href="{{ URL::to('profile/edit') }}">
                            <i class="fa fa-2x fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="form-row">
                        <label for="name" class="col-sm-2 col-form-label">
                            Name
                        </label>
                        <label class="col-sm-10 col-form-label">
                            {{ $profile->name }}
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                     <div class="form-row">
                        <label for="email" class="col-sm-2 col-form-label">
                            Email
                        </label>
                        <label class="col-sm-10 col-form-label">
                            {{ $profile->email }}
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
                            Posts
                        </h5>
                    </div>
                    @can('attach-post', $profile)
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ URL::to('posts/create?user_id=' . $profile->id) }}">Attach Post</a>
                        </div>
                    @endcan
                </div>
            </div>
            @if($profile->posts->count())
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 100px">
                                    ID
                                </th>
                                <th scope="col">
                                    Title
                                </th>
                                <th scope="col" class="text-center">
                                    Published at
                                </th>
                                <th scope="col" class="text-center" width="180">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profile->posts as $post)
                                <tr>
                                    <th scope="row" class="text-center align-middle">
                                        {{ $post->id }}
                                    </th>
                                    <td style="vertical-align:middle">
                                        {{ $post->title }}
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($post->published_at)
                                            {{ $post->published_at->toDayDateTimeString() }}
                                        @else
                                            <i class="text-muted">Unpublished</i>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <a class="btn btn-sm btn-link" href="{{ URL::to('posts/' . $post->id) }}" title="Show post">
                                            <i class="fa fa-2x fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-link" href="{{ URL::to('posts/' . $post->id . '/edit') }}" title="Edit post">
                                            <i class="fa fa-2x fa-edit"></i>
                                        </a>
                                        <button type="submit" class="btn btn-sm btn-link" title="Delete post" data-toggle="modal" data-target="#delete_modal" data-action="{{ URL::to('posts/' . $post->id) }}">
                                            <i class="fa fa-2x fa-trash-o"></i>
                                        </button>
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
                    <a href="{{ URL::to('posts/create?user_id=' . $profile->id) }}">
                        <button class="btn btn-sm btn-outline-primary">Create Post</button>
                    </a>
                </div>
            @endif
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <div class="form-row align-items-center">
                    <div class="col">
                        <h5 class="card-title my-1">
                            Reviews
                        </h5>
                    </div>
                    @can('attach-review', $profile)
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ URL::to('reviews/create') }}">Attach Review</a>
                        </div>
                    @endcan
                </div>
            </div>
            @if($profile->reviews->count())
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center" style="width: 100px">
                                ID
                            </th>
                            <th scope="col">
                                Post
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
                        @foreach ($profile->reviews as $review)
                            <tr>
                                <th scope="row" class="text-center align-middle">
                                    {{ $review->id }}
                                </th>
                                <td class="align-middle">
                                    <a href="{{ URL::to('posts/' . $review->post_id) }}">
                                        {{ $review->post->title }}
                                    </a>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-inline-flex my-1">
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
            @else
                <div class="d-flex flex-column align-items-center justify-content-center text-muted py-3">
                    <i class="fa fa-5x fa-table"></i>
                    <h6 class="card-title">
                        No records found
                    </h6>
                    @can('attach-review', $profile)
                        <a href="{{ URL::to('reviews/create') }}">
                            <button class="btn btn-sm btn-outline-primary">Attach Review</button>
                        </a>
                    @endcan
                </div>
            @endif
        </div>

        @include('partials.delete_modal')
    </div>
@endsection