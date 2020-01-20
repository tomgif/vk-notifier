@extends('layouts.less')

@section('title')
    <h4 class="page-title">
        {{ __('Register')  }}
    </h4>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="white-box">
            <form method="POST" class="form-horizontal form-material" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="col-md-12">
                        {{ __('Name') }}
                    </label>

                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control form-control-line{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-md-12">
                        {{ __('E-Mail Address') }}
                    </label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control form-control-line{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                        <input id="password" type="password" class="form-control form-control-line{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                    <label for="password-confirm" class="col-md-12">{{ __('Confirm Password') }}</label>

                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control form-control-line" name="password_confirmation" required>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
