@extends('layouts.app')

@section('page-title')
    Управление пользователями
@endsection

@section('navigation')
    <li class="active">
        Управление пользователями
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('users.login') }}</th>
                            <th>{{ __('users.email') }}</th>
                            <th>{{ __('users.roles') }}</th>
                            <th>{{ __('users.registration_date') }}</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ implode(', ', $user->roles->pluck('name')->map(function ($name) {
                                        return __('users.' . $name);
                                    })->toArray()) }}
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td class="txt-oflo">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                                        {{ __('users.edit') }}
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block">
                                        @method('DELETE') @csrf
                                        <button class="btn btn-danger">{{ __('users.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
