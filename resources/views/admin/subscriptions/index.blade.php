@extends('layouts.app')

@section('page-title')
    Подписки на рассылку
@endsection

@section('navigation')
    <li class="active">
        Подписки на рассылку
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if ($subscriptions)
                            <ul class="chatonline row">
                                @foreach($subscriptions as $subscription)
                                    <li class="col-sm-3">
                                        <a href="javascript:void(0)">
                                            <img src="{{ $subscription->external_fields['photo_50'] }}" alt="user-img" class="img-circle">

                                            <span>
                                                {{ $subscription->external_fields['first_name'] }}
                                                {{ $subscription->external_fields['last_name'] }}

                                                @if($subscription->is_subscribed)
                                                    <small class="text-success">Подписка активна</small>
                                                @endif
                                        </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                Подписки отсутствуют
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
