@extends('layouts.app')

@section('title')
    @parent &dash; Edit Post
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
                                Edit Post
                            </h5>
                        </div>
                    </div>
                </div>
                <form id="edit_post_form" action="{{ URL::to('posts/' . $post->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="title" class="col-sm-2 col-form-label">
                                    Title
                                </label>
                                <div class="col-sm-10">
                                    <input id="title" type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" placeholder="Title" required min="6">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="body" class="col-sm-2 col-form-label">
                                    Body
                                </label>
                                <div class="col-sm-10">
                                    <textarea id="body" name="body" class="form-control ckeditor" placeholder="Body" required>
                                        {{ old('body', $post->body) }}
                                    </textarea>
                                </div>
                            </div>
                        </li>

                        @if(!$post->published_at)
                            <li class="list-group-item">
                                <div class="form-row">
                                    <label class="col-sm-2 col-form-label">
                                        Publish
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="publish" value="1" @if(old('publish')) checked @endif>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </form>
                        
                <div class="card-footer pull-right">
                    <div class="form-row align-items-center pull-right">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success" form="edit_post_form" name="return" value="1">Update & Continue Editing</button>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success" form="edit_post_form">Update Post</button>
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