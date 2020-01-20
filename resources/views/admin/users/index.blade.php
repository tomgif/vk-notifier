@extends('layouts.app')

@section('page-title')
    Управление пользователями
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
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Права</th>
                            <th>Дата регистрации</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="txt-oflo">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Изменить</a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @method('DELETE') @csrf
                                        <button class="btn btn-danger">Удалить</button>
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
