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
                                dateFormat: 'Y-m-d H:i:S',
                                defaultDate: '{{ Carbon\Carbon::now()->addMinutes(1) }}',
                                minDate: '{{ Carbon\Carbon::now()->addMinutes(1) }}'
                            });
                        </script>
                    @endpush
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
                        <input type="file"
                               id="attachments"
                               name="files[]"
                               multiple
                               data-allow-reorder="true"
                               data-max-file-size="3MB"
                               data-max-files="3">
                    </div>

                    @push('head')
                        <link href="{{ asset('ample/plugins/filepond/filepond.min.css') }}" rel="stylesheet">
                        <link href="{{ asset('ample/plugins/filepond/plugins/filepond-plugin-image-preview.min.css') }}" rel="stylesheet">
                    @endpush

                    @push('footer')
                        <script src="{{ asset('ample/plugins/filepond/filepond.min.js') }}"></script>
                        <script src="{{ asset('ample/plugins/filepond/plugins/filepond-plugin-image-preview.min.js') }}"></script>
                        <script>
                            FilePond.registerPlugin(FilePondPluginImagePreview);
                            FilePond.create(document.getElementById('attachments'), {
                                server: '{{ route('api.upload.vk') }}',

                                labelIdle: '{!! __('dashboard.labelIdle') !!}',
                                labelInvalidField: '{{ __('dashboard.labelInvalidField') }}',
                                labelFileWaitingForSize: '{{ __('dashboard.labelFileWaitingForSize') }}',
                                labelFileSizeNotAvailable: '{{ __('dashboard.labelFileSizeNotAvailable') }}',
                                labelFileLoading: '{{ __('dashboard.labelFileLoading') }}',
                                labelFileLoadError: '{{ __('dashboard.labelFileLoadError') }}',
                                labelFileProcessing: '{{ __('dashboard.labelFileProcessing') }}',
                                labelFileProcessingComplete: '{{ __('dashboard.labelFileProcessingComplete') }}',
                                labelFileProcessingAborted: '{{ __('dashboard.labelFileProcessingAborted') }}',
                                labelFileProcessingError: '{{ __('dashboard.labelFileProcessingError') }}',
                                labelFileProcessingRevertError: '{{ __('dashboard.labelFileProcessingRevertError') }}',
                                labelFileRemoveError: '{{ __('dashboard.labelFileRemoveError') }}',
                                labelTapToCancel: '{{ __('dashboard.labelTapToCancel') }}',
                                labelTapToRetry: '{{ __('dashboard.labelTapToRetry') }}',
                                labelTapToUndo: '{{ __('dashboard.labelTapToUndo') }}',
                                labelButtonRemoveItem: '{{ __('dashboard.labelButtonRemoveItem') }}',
                                labelButtonAbortItemLoad: '{{ __('dashboard.labelButtonAbortItemLoad') }}',
                                labelButtonRetryItemLoad: '{{ __('dashboard.labelButtonRetryItemLoad') }}',
                                labelButtonAbortItemProcessing: '{{ __('dashboard.labelButtonAbortItemProcessing') }}',
                                labelButtonUndoItemProcessing: '{{ __('dashboard.labelButtonUndoItemProcessing') }}',
                                labelButtonRetryItemProcessing: '{{ __('dashboard.labelButtonRetryItemProcessing') }}',
                                labelButtonProcessItem: '{{ __('dashboard.labelButtonProcessItem') }}'
                            });
                        </script>
                    @endpush
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
