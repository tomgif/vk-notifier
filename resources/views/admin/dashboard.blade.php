@extends('layouts.app')

@section('page-title')
    {{ __('dashboard.dashboard.heading') }}
@endsection

@section('content')
    <div class="row">
        @can('manage-mailing')
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('mailing.quick.mailing.heading') }}
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('admin.mailing.send') }}" class="form-horizontal form-material"
                              method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea id="message" name="message" rows="5"
                                              placeholder="Напишите что произошло"
                                              class="form-control form-control-line" required
                                              style="resize: none"></textarea>
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
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success pull-right">
                                        {{ __('mailing.quick.mailing.send') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @push('head')
                <link href="{{ secure_asset('ample/plugins/filepond/filepond.min.css') }}" rel="stylesheet">
                <link href="{{ secure_asset('ample/plugins/filepond/plugins/filepond-plugin-image-preview.min.css') }}" rel="stylesheet">
            @endpush

            @push('footer')
                <script src="{{ secure_asset('ample/plugins/filepond/filepond.min.js') }}"></script>
                <script src="{{ secure_asset('ample/plugins/filepond/plugins/filepond-plugin-image-preview.min.js') }}"></script>
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
        @endcan

        <div class="col-lg-8 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Расписание рассылок
                </div>

                @if ($schedules->count())
                    <div class="panel-body">
                        <div class="comment-center">
                            @foreach($schedules as $schedule)
                                <div class="comment-body">
                                    <div class="mail-content" style="padding-left: 0;">
                                        <h5>{{ $schedule->name }}</h5>

                                        <span class="time">
                                            {!! $schedule->formattedWhen() !!} - cоздатель: <strong>{{ $schedule->user->name }}</strong>
                                        </span>

                                        <span class="mail-desc">
                                            {{ $schedule->message }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
