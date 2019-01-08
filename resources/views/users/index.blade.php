@extends('layouts.app')

@section('title')
    @parent &dash; Users
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
                            Users
                        </h5>
                    </div>
                    @can('users.create', User::class)
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ URL::to('users/create') }}">Create User</a>
                        </div>
                    @endcan
                </div>
            </div>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center" style="width: 100px">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center" style="width: 180px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paginator->items() as $user)
                        <tr>
                            <th scope="row" class="text-center" style="vertical-align:middle">
                                {{ $user->id }}
                            </th>
                            <td style="vertical-align:middle">
                                {{ $user->name }}
                            </td>
                            <td style="vertical-align:middle">
                                {{ $user->email }}
                            </td>
                            <td class="text-center" style="vertical-align:middle">
                                @can('users.view', $user)
                                    <a class="btn btn-sm btn-link" href="{{ URL::to('users/' . $user->id) }}" title="Show User">
                                        <i class="fa fa-2x fa-eye"></i>
                                    </a>
                                @endcan
                                @can('users.update', $user)
                                    <a class="btn btn-sm btn-link" href="{{ URL::to('users/' . $user->id . '/edit') }}" title="Edit User">
                                        <i class="fa fa-2x fa-edit"></i>
                                    </a>
                                @endcan
                                @can('users.delete', $user)
                                    <button type="submit" class="btn btn-sm btn-link" title="Delete User" data-toggle="modal" data-target="#delete_modal" data-action="{{ URL::to('users/' . $user->id) }}">
                                        <i class="fa fa-2x fa-trash-o"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($paginator->hasPages())
                <div class="card-footer d-flex justify-content-center">
                    {{ $paginator->render() }}
                </div>
            @endif
        </div>

        @include('partials.delete_modal')
    </div>
@endsection