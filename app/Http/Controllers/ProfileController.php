<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use TsfCorp\UiFeedback\Facades\UiFeedback;
use TsfCorp\UiFeedback\MessageFormat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user();

        $this->authorize('view', $profile);

        return view('profile.show')
            ->with('profile', $profile);
    }

    public function edit()
    {
        $profile = Auth::user();

        $this->authorize('update', $profile);

        return view('profile.edit')
            ->with('profile', $profile);
    }

    public function update(UserUpdateRequest $request)
    {
        $profile = Auth::user();

        $this->authorize('update', $profile);

        $profile->name = $request->get('name');
        $profile->email = $request->get('email');

        if ($request->get('password')) {
            $profile->password = Hash::make($request->get('password'));
        }

        $profile->save();

        UiFeedback::set(MessageFormat::SUCCESS, 'Profile successfully updated!');

        if ($request->get('return')) {
            return back();
        }

        return redirect('profile');
    }

    public function destroy()
    {
        $profile = Auth::user();

        $this->authorize('delete', $profile);

        $profile->delete();

        return redirect('home');
    }
}
