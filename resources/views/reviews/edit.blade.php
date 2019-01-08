@extends('layouts.app')

@section('title')
    @parent &dash; Edit Review
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
                                Edit Review
                            </h5>
                        </div>
                    </div>
                </div>
                <form id="edit_review_form" action="{{ URL::to('reviews/' . $review->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="post" class="col-sm-2 col-form-label">
                                    Post
                                </label>
                                <div class="col-sm-10">
                                    <label class="form-control" readonly>
                                        {{ $review->post->title }}
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="rating" class="col-sm-2 col-form-label">
                                    Rating
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" id="rating" name="rating" value="{{ old('rating', $review->rating) }}" class="form-control" min=1 max=10 required>
                                    <small class="form-text text-muted">Give a note between 1 and 10 </small>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="body" class="col-sm-2 col-form-label">
                                    Body
                                </label>
                                <div class="col-sm-10">
                                    <textarea id="body" name="body" class="form-control ckeditor" placeholder="Body" required>{{ old('body', $review->body) }}</textarea>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
                        
                <div class="card-footer pull-right">
                    <div class="form-row align-items-center pull-right">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success" form="edit_review_form" name="return" value="1">Update & Continue Editing</button>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success" form="edit_review_form">Update Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
@endpush