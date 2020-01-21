@extends('layouts.app')

@section('page-title')
    Редактирование пользователя #{{ $user->id  }}
@endsection

@section('navigation')
    <li class="active">
        Редактирование пользователя
    </li>
@endsection

@section('content')
    <div class="col-md-8 col-xs-12">
        <div class="white-box">
            <form action="{{ route('admin.users.update', $user->id) }}" class="form-horizontal form-material" method="POST">
                @method('PATCH')

                <div class="form-group">
                    <label class="col-md-12" for="name">
                        {{ __('users.login') }}
                    </label>

                    <div class="col-md-12">
                        <input id="name" name="name" type="text" placeholder="Johnathan Doe" class="form-control form-control-line{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $user->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="email">
                        {{ __('users.email') }}
                    </label>

                    <div class="col-md-12">
                        <input id="email" name="email" type="text" placeholder="Johnathan Doe" class="form-control form-control-line{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-12">{{ __('users.roles') }}</label>
                    <div class="col-sm-12">
                        @foreach($roles as $role)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" name="roles[]" type="checkbox" value="{{ $role->id }}"
                                           @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                    {{ __('users.' . $role->name) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">{{ __('users.update') }}</button>
                    </div>
                </div>

                @csrf
            </form>
        </div>
    </div>
@endsection
