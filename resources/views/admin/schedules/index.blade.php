@extends('layouts.app')

@section('page-title')
    {{ __('schedules.index.heading') }}
@endsection

@section('navigation')
    <li class="active">
        {{ __('schedules.index.breadcrumb') }}
    </li>
@endsection

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
                            Создать отложенную рассылку
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="comment-center">
                        @if ($schedules)
                            @foreach($schedules as $schedule)
                                <div class="comment-body">
                                    <div class="mail-content" style="padding-left: 0;">
                                        <h5>{{ $schedule->name }}</h5>

                                        <span class="time">{{ $schedule->when }}</span>

                                        <br>

                                        <span class="mail-desc">
                                            {{ $schedule->message }}
                                        </span>

                                        <a href="javascript:void(0);"
                                           class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                            <i class="fa fa-check text-success"></i>
                                        </a>

                                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                                           class="btn btn btn-rounded btn-default btn-outline m-r-5">
                                            <i class="fa fa-pencil text-info"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="btn-rounded btn btn-default btn-outline"
                                            onclick="document.getElementById('delete-schedule-{{ $schedule->id }}').submit()">
                                            <i class="fa fa-close text-danger"></i>
                                        </a>

                                        <form id="delete-schedule-{{ $schedule->id }}" action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="post">
                                            @csrf @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            Нет запланированных рассылок
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if ($schedules->hasMorePages())
            <div class="text-center">
                {{ $schedules->links() }}
            </div>
        @endif
    </div>
@endsection
