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
    @include('partials.messages')

    <div class="row">
        <div class="col-xs-12">
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

                @if ($schedules->count())
                    <div class="panel-body">
                        <div class="comment-center">
                            @foreach($schedules as $schedule)
                                <div class="comment-body">
                                    <div class="mail-content" style="padding-left: 0;">
                                        <h5>
                                            {{ $schedule->name }}
                                        </h5>

                                        <span class="time">
                                            {!! $schedule->formattedWhen() !!} - {{ __('schedules.index.author') }}:
                                            <strong>{{ $schedule->user->name }}</strong>
                                        </span>

                                        <span class="mail-desc">
                                            {{ $schedule->message }}
                                        </span>

                                        <a href="javascript:void(0);"
                                           class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                            <i class="fa fa-check text-success"></i>
                                            <span class="m-l-5">
                                                {{ __('schedules.index.send') }}
                                            </span>
                                        </a>

                                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                                           class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                            <i class="fa fa-pencil text-info"></i>
                                            {{ __('schedules.index.edit') }}
                                        </a>

                                        <a href="javascript:void(0);" class="btn-rounded btn btn-default btn-outline"
                                           onclick="document.getElementById('delete-schedule-{{ $schedule->id }}').submit()">
                                            <i class="fa fa-close text-danger"></i>
                                            {{ __('schedules.index.delete') }}
                                        </a>

                                        <form id="delete-schedule-{{ $schedule->id }}"
                                              action="{{ route('admin.schedules.destroy', $schedule->id) }}"
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
        </div>

        <div class="text-center">
            {{ $schedules->links() }}
        </div>
    </div>
@endsection
