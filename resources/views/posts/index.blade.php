@extends('layouts.app')

@section('title')
    @parent &dash; Posts
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
                            Posts
                        </h5>
                    </div>
                    @can('create', App\Models\Post::class)
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ URL::to('posts/create') }}">Create Post</a>
                        </div>
                    @endcan
                </div>
            </div>
            @if($paginator->total())
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
                                <th scope="col">
                                    User
                                </th>
                                <th scope="col" class="text-center">
                                    Rating
                                </th>
                                <th scope="col" class="text-center">
                                    Reviews
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
                            @foreach ($paginator->items() as $post)
                                @cannot('see-in-list', $post)
                                    @continue
                                @endcannot
                                <tr>
                                    <th scope="row" class="text-center align-middle">
                                        {{ $post->id }}
                                    </th>
                                    <td style="vertical-align:middle">
                                        {{ $post->title }}
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ URL::to('users/' . $post->user_id) }}">
                                            {{ $post->user->name }}
                                        </a>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($post->rating)
                                            <div class="d-inline-flex">
                                                <i class="fa fa-2x fa-star px-1" style="color:rgb(255, 200, 0);"></i>
                                                <div>
                                                    <label class="my-0" style="font-size: 18px">
                                                        {{ $post->rating }}
                                                    </label>
                                                    <label class="text-muted my-0">
                                                        /10
                                                    </label> 
                                                </div>
                                            </div>
                                        @else
                                            <b>-</b>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <label>
                                            {{ $post->reviews->count() }}
                                        </label>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($post->published_at)
                                            {{ $post->published_at->toDayDateTimeString() }}
                                        @else
                                            <i class="text-muted">Unpublished</i>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @can('view', $post)
                                            <a class="btn btn-sm btn-link" href="{{ URL::to('posts/' . $post->id) }}" title="Show Post">
                                                <i class="fa fa-2x fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('update', $post)
                                            <a class="btn btn-sm btn-link" href="{{ URL::to('posts/' . $post->id . '/edit') }}" title="Edit Post">
                                                <i class="fa fa-2x fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $post)
                                            <button type="submit" class="btn btn-sm btn-link" title="Delete Post" data-toggle="modal" data-target="#delete_modal" data-action="{{ URL::to('posts/' . $post->id) }}">
                                                <i class="fa fa-2x fa-trash-o"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($paginator->hasPages())
                    <div class="card-footer d-flex justify-content-center">
                        {{ $paginator->render() }}
                    </div>
                @endif
            @else
                <div class="d-flex flex-column align-items-center justify-content-center text-muted py-3">
                    <i class="fa fa-5x fa-table"></i>
                    <h6 class="card-title">
                        No records found
                    </h6>
                    @can('create', App\Models\Post::class)
                        <a href="{{ URL::to('posts/create') }}">
                            <button class="btn btn-sm btn-outline-primary">Create Post</button>
                        </a>
                    @endcan
                </div>
            @endif
        </div>

        @include('partials.delete_modal')
    </div>
@endsection
