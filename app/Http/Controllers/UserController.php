<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use TsfCorp\UiFeedback\Facades\UiFeedback;
use TsfCorp\UiFeedback\MessageFormat;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __contruct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $paginator = User::paginate();

        return view('users.index')
            ->with('paginator', $paginator);
    }

    public function show(User $user)
    {
        return view('users.show')
            ->with('user', $user);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        UiFeedback::set(MessageFormat::SUCCESS, 'User successfully created!');

        if ($request->get('return')) {
            return back();
        }

        return redirect('users/' . $user->id);
    }

    public function edit(User $user)
    {
        return view('users.edit')
            ->with('user', $user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();

        UiFeedback::set(MessageFormat::SUCCESS, 'User successfully updated!');

        if ($request->get('return')) {
            return back();
        }

        return redirect('users/' . $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        UiFeedback::set(MessageFormat::SUCCESS, 'User successfully deleted!');

        return redirect('users');
    }
}
