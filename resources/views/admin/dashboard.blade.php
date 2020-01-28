@extends('layouts.app')

@section('page-title')
    {{ __('dashboard.dashboard.heading') }}
@endsection

@section('content')
    <div class="row">
        @can('manage-mailing')
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="panel">
                    <div class="sk-chat-widgets">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ __('mailing.quick.mailing.heading') }}
                            </div>

                            <div class="panel-body">
                                <form action="{{ route('admin.mailing.send') }}" class="form-horizontal form-material"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label class="col-md-12" for="message">
                                            {{ __('mailing.quick.mailing.message') }}
                                        </label>

                                        <div class="col-md-12">
                                            <textarea id="message" name="message" rows="5"
                                                      class="form-control form-control-line" required
                                                      style="resize: none"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="file"
                                               id="attachments"
                                               name="files[]"
                                               multiple
                                               data-allow-reorder="true"
                                               data-max-file-size="3MB"
                                               data-max-files="3">
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
                </div>
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

                        labelIdle: '<?php echo __('dashboard.labelIdle') ?>',
                        labelInvalidField: '<?php echo __('dashboard.labelInvalidField') ?>',
                        labelFileWaitingForSize: '<?php echo __('dashboard.labelFileWaitingForSize') ?>',
                        labelFileSizeNotAvailable: '<?php echo __('dashboard.labelFileSizeNotAvailable') ?>',
                        labelFileLoading: '<?php echo __('dashboard.labelFileLoading') ?>',
                        labelFileLoadError: '<?php echo __('dashboard.labelFileLoadError') ?>',
                        labelFileProcessing: '<?php echo __('dashboard.labelFileProcessing') ?>',
                        labelFileProcessingComplete: '<?php echo __('dashboard.labelFileProcessingComplete') ?>',
                        labelFileProcessingAborted: '<?php echo __('dashboard.labelFileProcessingAborted') ?>',
                        labelFileProcessingError: '<?php echo __('dashboard.labelFileProcessingError') ?>',
                        labelFileProcessingRevertError: '<?php echo __('dashboard.labelFileProcessingRevertError') ?>',
                        labelFileRemoveError: '<?php echo __('dashboard.labelFileRemoveError') ?>',
                        labelTapToCancel: '<?php echo __('dashboard.labelTapToCancel') ?>',
                        labelTapToRetry: '<?php echo __('dashboard.labelTapToRetry') ?>',
                        labelTapToUndo: '<?php echo __('dashboard.labelTapToUndo') ?>',
                        labelButtonRemoveItem: '<?php echo __('dashboard.labelButtonRemoveItem') ?>',
                        labelButtonAbortItemLoad: '<?php echo __('dashboard.labelButtonAbortItemLoad') ?>',
                        labelButtonRetryItemLoad: '<?php echo __('dashboard.labelButtonRetryItemLoad') ?>',
                        labelButtonAbortItemProcessing: '<?php echo __('dashboard.labelButtonAbortItemProcessing') ?>',
                        labelButtonUndoItemProcessing: '<?php echo __('dashboard.labelButtonUndoItemProcessing') ?>',
                        labelButtonRetryItemProcessing: '<?php echo __('dashboard.labelButtonRetryItemProcessing') ?>',
                        labelButtonProcessItem: '<?php echo __('dashboard.labelButtonProcessItem') ?>'
                    });
                </script>
            @endpush
        @endcan
    </div>
@endsection
