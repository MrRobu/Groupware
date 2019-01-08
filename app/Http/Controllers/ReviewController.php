<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use TsfCorp\UiFeedback\MessageFormat;
use Illuminate\Support\Facades\Auth;
use TsfCorp\UiFeedback\Facades\UiFeedback;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Requests\ReviewCreateRequest;

class ReviewController extends Controller
{
    public function __contruct()
    {
        $this->authorizeResource(Review::class, 'review');
    }

    public function index()
    {
        $paginator = Review::paginate();

        return view('reviews.index')
            ->with('paginator', $paginator);
    }

    public function show(Review $review)
    {
        return view('reviews.show')
            ->with('review', $review);
    }

    public function create(Request $request)
    {
        $review = new Review;
        $review->post_id = $request->get('post_id');

        return view('reviews.create')
            ->with('review', $review);
    }

    public function store(ReviewCreateRequest $request)
    {
        $review = new Review($request->all());
        $review->user_id = Auth::user()->id;
        $review->save();

        UiFeedback::set(MessageFormat::SUCCESS, 'Review successfully created!');

        if ($request->get('return')) {
            return back();
        }

        return redirect('reviews/' . $review->id);
    }

    public function edit(Review $review)
    {
        return view('reviews.edit')
            ->with('review', $review);
    }

    public function update(ReviewUpdateRequest $request, Review $review)
    {
        $review->update($request->all());

        UiFeedback::set(MessageFormat::SUCCESS, 'Review successfully updated!');

        if ($request->get('return')) {
            return back();
        }

        return redirect('reviews/' . $review->id);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        UiFeedback::set(MessageFormat::SUCCESS, 'Review successfully deleted!');

        return redirect('reviews');
    }
}
