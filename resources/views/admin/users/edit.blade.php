@extends('layouts.app')

@section('page-title')
    {{ __('users.edit.title', ['no' => $user->id]) }}
@endsection

@push('navigation')
    <li class="active">
        {{ __('users.edit.breadcrumb') }}
    </li>
@endpush

@section('content')
    <div class="col-md-4 col-xs-12">
        <div class="white-box">
            <form action="{{ route('admin.users.update', $user->id) }}" class="form-horizontal form-material" method="POST">
                @csrf @method('PATCH')

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
                    <label for="password" class="col-md-12">
                        {{ __('Password') }}
                    </label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control form-control-line{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $errors->first('password') }}
                                </strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-12">
                        {{ __('Confirm Password') }}
                    </label>

                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control form-control-line" name="password_confirmation">
                    </div>
                </div>

                @can('manage-users')
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
                @endcan

                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success pull-right">
                            {{ __('users.update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
