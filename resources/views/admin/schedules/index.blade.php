@extends('layouts.app')

@section('page-title')
    {{ __('schedules.index.heading') }}
@endsection

@push('navigation')
    <li class="active">
        {{ __('schedules.index.breadcrumb') }}
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <div class="btn-group">
                        <a href="{{ route('admin.schedules.create') }}"
                           class="btn btn-primary waves-effect waves-light">
                            <i class="fa fa-plus m-r-5"></i>
                            {{ __('schedules.index.create.schedule') }}
                        </a>
                    </div>
                </div>

                @if ($activeSchedules->count())
                    <div class="panel-body">
                        <div class="comment-center">
                            @foreach($activeSchedules as $activeSchedule)
                                <div class="comment-body">
                                    <div class="mail-content" style="padding-left: 0;">
                                        <h5>
                                            {{ $activeSchedule->name }}
                                        </h5>

                                        <span class="time">
                                            {!! $activeSchedule->formattedWhen() !!} - {{ __('schedules.index.author') }}:
                                            <strong>{{ $activeSchedule->user->name }}</strong>
                                        </span>

                                        <span class="mail-desc">
                                            {{ $activeSchedule->message }}
                                        </span>
{{--
                                        <a href="javascript:void(0);"
                                           class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                            <i class="fa fa-check text-success"></i>
                                            <span class="m-l-5">
                                                {{ __('schedules.index.send') }}
                                            </span>
                                        </a>
--}}
                                        <a href="{{ route('admin.schedules.edit', $activeSchedule->id) }}"
                                           class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                            <i class="fa fa-pencil text-info"></i>
                                            {{ __('schedules.index.edit') }}
                                        </a>

                                        <a href="javascript:void(0);" class="btn-rounded btn btn-default btn-outline"
                                           onclick="document.getElementById('delete-schedule-{{ $activeSchedule->id }}').submit()">
                                            <i class="fa fa-close text-danger"></i>
                                            {{ __('schedules.index.delete') }}
                                        </a>

                                        <form id="delete-schedule-{{ $activeSchedule->id }}"
                                              action="{{ route('admin.schedules.destroy', $activeSchedule->id) }}"
                                              method="post">
                                            @csrf @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center">
                {{ $activeSchedules->links() }}
            </div>
        </div>

        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix" style="padding-bottom: 32px;">
                    История рассылок
                </div>

                @if ($completedSchedules->count())
                    <div class="panel-body">
                        <div class="comment-center">
                            @foreach($completedSchedules as $completedSchedule)
                                <div class="comment-body">
                                    <div class="mail-content" style="padding-left: 0;">
                                        <h5>
                                            {{ $completedSchedule->name }}
                                        </h5>

                                        <span class="time">
                                            {!! $completedSchedule->formattedWhen() !!} - {{ __('schedules.index.author') }}:
                                            <strong>{{ $completedSchedule->user->name }}</strong>
                                        </span>

                                        <span class="mail-desc">
                                            {{ $completedSchedule->message }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center">
                {{ $completedSchedules->links() }}
            </div>
        </div>
    </div>
@endsection
