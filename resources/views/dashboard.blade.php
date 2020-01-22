@extends('layouts.app')

@section('page-title')
    Панель управления
@endsection

@section('content')
    <div class="row">
        @can('manage-mailing')
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Быстрая рассылка
                        </div>

                        <div class="panel-body">
                            <form action="{{ route('admin.mailing.send') }}" class="form-horizontal form-material" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="col-md-12" for="message">Сообщение</label>

                                    <div class="col-md-12">
                                        <textarea id="message" name="message" rows="5" class="form-control form-control-line" required style="resize: none"></textarea>
                                    </div>
                                </div>

                                {{--<div class="form-group">
                                    <input type="file"
                                           name="image"
                                           multiple
                                           data-allow-reorder="true"
                                           data-max-file-size="3MB"
                                           data-max-files="3">
                                </div>--}}

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success pull-right">Отправить</button>
                                    </div>
                                </div>

                            </form>

                            <link href="{{ asset('ample/plugins/filepond/filepond.min.css') }}" rel="stylesheet">
                            <script src="{{ asset('ample/plugins/filepond/filepond.min.js') }}"></script>

                            <link href="{{ asset('ample/plugins/filepond/plugins/filepond-plugin-image-preview.min.css') }}" rel="stylesheet">
                            <script src="{{ asset('ample/plugins/filepond/plugins/filepond-plugin-image-preview.min.js') }}"></script>

                            <script>
                                //FilePond.registerPlugin(FilePondPluginImagePreview);
                                //FilePond.create(document.querySelector('input[type=file]'));
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection
