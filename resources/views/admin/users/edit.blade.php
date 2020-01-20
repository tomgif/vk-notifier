@extends('layouts.app')

@section('page-title')
    Редактирование пользователя - {{ $user->name }} [#{{ $user->id  }}]
@endsection

@section('content')
    <div class="col-md-8 col-xs-12">
        <div class="white-box">
            <form action="{{ route('admin.users.update', $user->id) }}" class="form-horizontal form-material" method="POST">
                @method('PATCH')

                <div class="form-group">
                    <label class="col-sm-12">Права доступа</label>
                    <div class="col-sm-12">
                        @foreach($roles as $role)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" name="roles[]" type="checkbox" value="{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Обновить</button>
                    </div>
                </div>

                @csrf
            </form>
        </div>
    </div>
@endsection
