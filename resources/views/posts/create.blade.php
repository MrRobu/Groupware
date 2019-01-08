@extends('layouts.app')

@section('title')
    @parent &dash; New Post
@endsection

@section('content')
    <div class="container">
        @include('partials.breadcrumb')

        @include('partials.uifeedback')

            <div class="card mt-5">
                <div class="card-header border-bottom-0">
                    <h5 class="my-1">
                        New Post
                    </h5>
                </div>
                <form id="create_post_form" action="{{ URL::to('posts') }}" method="POST">
                    @csrf

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-row">
                                <label for="title" class="col-sm-2 col-form-label">
                                    Title
                                </label>
                                <div class="col-sm-10">
                                    <input id="title" type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title" required min="6">
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
                                        {{ old('body') }}
                                    </textarea>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-row">
                                <label class="col-sm-2 col-form-label">
                                    Publish
                                </label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input my-2" type="checkbox" name="publish" value="1" @if(old('publish')) checked @endif>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
                <div class="card-footer">
                    <div class="form-row align-items-center pull-right">
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-success" form="create_post_form" name="return" value=1>Create & Add Another</button>
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-success" form="create_post_form">Create Post</button>
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