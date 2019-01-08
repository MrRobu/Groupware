@extends('layouts.app')

@section('title')
    @parent &dash; New Review
@endsection

@section('content')
    <div class="container">
        @include('partials.breadcrumb')

        @include('partials.uifeedback')

            <div class="card mt-5">
                <div class="card-header border-bottom-0">
                    <h5 class="my-1">
                        New Review
                    </h5>
                </div>
                <form id="create_review_form" action="{{ URL::to('reviews') }}" method="POST">
                    @csrf

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="post" class="col-sm-2 col-form-label">
                                    Post
                                </label>
                                <div class="col-sm-10">
                                    <select id="post" name="post_id" class="custom-select" required>
                                        <option></option>
                                        @foreach (App\Models\Post::unratedBy(Auth::user())->get() as $post)
                                            <option value="{{ $post->id }}" @if(old('post_id', $review->post_id) == $post->id) selected @endif>{{ $post->title }}</option>    
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="rating" class="col-sm-2 col-form-label">
                                    Rating
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" id="rating" name="rating" value="{{ old('rating', 10) }}" class="form-control" min=1 max=10 required>
                                </div>
                            </div>
                        </li>                        
                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="body" class="col-sm-2 col-form-label">
                                    Body
                                </label>
                                <div class="col-sm-10">
                                    <textarea id="body" name="body" class="form-control ckeditor" aria-valuetext="{{ old('body') }}" required></textarea>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
                <div class="card-footer">
                    <div class="form-row align-items-center pull-right">
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-success" form="create_review_form" name="return" value=1>Create & Add Another</button>
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-success" form="create_review_form">Create Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection