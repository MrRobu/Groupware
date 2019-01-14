@extends('layouts.app')

@section('title')
    @parent &dash; Reviews
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
                            Reviews
                        </h5>
                    </div>
                    @can('create', App\Models\Review::class)
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ URL::to('reviews/create') }}">Create Review</a>
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
                                    Post
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
                            @foreach ($paginator->items() as $review)
                                <tr>
                                    <th scope="row" class="text-center align-middle">
                                        {{ $review->id }}
                                    </th>
                                    <td class="align-middle">
                                        <a href="{{ URL::to('posts/' . $review->post_id) }}">
                                            {{ $review->post->title }}
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ URL::to('users/' . $review->user_id) }}">
                                            {{ $review->user->name }}
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
                    @can('create', App\Models\Review::class)
                        <a href="{{ URL::to('reviews/create') }}">
                            <button class="btn btn-sm btn-outline-primary">Create Review</button>
                        </a>
                    @endcan
                </div>
            @endif
        </div>

        @include('partials.delete_modal')
    </div>
@endsection