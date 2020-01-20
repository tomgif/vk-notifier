@extends('layouts.less')

@section('title')
    <h4 class="page-title">
        {{ __('Reset Password')  }}
    </h4>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="white-box">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" class="form-horizontal form-material" action="{{ route('password.email') }}">
                @csrf

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
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
