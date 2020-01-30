@extends('layouts.app')

@section('page-title')
    {{ __('schedules.create.heading') }}
@endsection

@push('navigation')
    <li class="active">
        {{ __('schedules.create.breadcrumb') }}
    </li>
@endpush

@section('content')
    <div class="col-md-6 col-xs-12">
        <div class="white-box">
            <form action="{{ route('admin.schedules.store') }}" class="form-horizontal form-material" method="POST">
                @csrf

                <div class="form-group">
                    <label class="col-md-12" for="when">
                        {{ __('schedules.when') }}
                    </label>

                    <div class="col-md-12">
                        <input id="when" name="when" class="flatpickr flatpickr-input active form-control form-control-line{{ $errors->has('when') ? ' is-invalid' : '' }}"
                               type="text" value="{{ old('when') }}" readonly="readonly" required>

                        @if ($errors->has('when'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('when') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="name">
                        {{ __('schedules.name') }}
                    </label>

                    <div class="col-md-12">
                        <input id="name" name="name" type="text" placeholder="{{ __('schedules.name.placeholder') }}"
                               class="form-control form-control-line{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="message">
                        {{ __('schedules.message') }}
                    </label>

                    <div class="col-md-12">
                        <textarea id="message" name="message" rows="5"
                                  placeholder="{{ __('schedules.message.placeholder') }}"
                                  class="form-control form-control-line" required
                                  style="resize: none">{{old('message')}}</textarea>

                        @if ($errors->has('message'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success pull-right">
                            {{ __('schedules.create.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('head')
    <link href="{{ asset('ample/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
@endpush

@push('footer')
    <script src="{{ asset('ample/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('ample/plugins/flatpickr/' . Config::get('app.locale') . '.js') }}"></script>
    <script>
        flatpickr(document.getElementById('when'), {
            locale: '{{ Config::get('app.locale') }}',
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            defaultDate: '{{ Carbon\Carbon::now()->addMinutes(5) }}',
            minDate: '{{ Carbon\Carbon::now()->addMinutes(5) }}'
        });
    </script>
@endpush
