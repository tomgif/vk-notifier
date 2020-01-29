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
                <link href="{{ asset('ample/plugins/filepond/filepond.min.css') }}" rel="stylesheet">
                <link href="{{ asset('ample/plugins/filepond/plugins/filepond-plugin-image-preview.min.css') }}"
                      rel="stylesheet">
            @endpush

            @push('footer')
                <script src="{{ asset('ample/plugins/filepond/filepond.min.js') }}"></script>
                <script
                    src="{{ asset('ample/plugins/filepond/plugins/filepond-plugin-image-preview.min.js') }}"></script>
                <script>
                    FilePond.registerPlugin(FilePondPluginImagePreview);
                    FilePond.create(document.getElementById('attachments'), {
                        server: '{{ route('api.upload.vk') }}',

                        labelIdle: '{{ __('dashboard.labelIdle') }}',
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

                <div class="panel-body">
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="mail-content" style="padding-left: 0;">
                                <h5>Pavan kumar</h5><span class="time">10:20 AM   20  may 2016</span>

                                <br>

                                <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. Aenean commodo dui pellentesque molestie feugiat</span>

                                <a href="javascript:void(0);" class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                    <i class="fa fa-check text-success"></i>
                                </a>

                                <a href="javascript:void(0);" class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                    <i class="fa fa-pencil text-info"></i>
                                </a>

                                <a href="javascript:void(0);" class="btn-rounded btn btn-default btn-outline">
                                    <i class="fa fa-close text-danger"></i>
                                </a>
                            </div>
                        </div>

                        <div class="comment-body">
                            <div class="mail-content" style="padding-left: 0;">
                                <h5>Pavan kumar</h5><span class="time">10:20 AM   20  may 2016</span>

                                <br>

                                <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. Aenean commodo dui pellentesque molestie feugiat</span>

                                <a href="javascript:void(0);" class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                    <i class="fa fa-check text-success"></i>
                                </a>

                                <a href="javascript:void(0);" class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                    <i class="fa fa-pencil text-info"></i>
                                </a>

                                <a href="javascript:void(0);" class="btn-rounded btn btn-default btn-outline">
                                    <i class="fa fa-close text-danger"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
