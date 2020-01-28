@extends('layouts.app')

@section('page-title')
    {{ __('subscriptions.index.title') }}
@endsection

@push('navigation')
    <li class="active">
        {{ __('subscriptions.index.breadcrumb') }}
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{
                                trans_choice(
                                    'subscriptions.index.subscribers_no',
                                    count($subscriptions->where('is_subscribed', true)),
                                    [
                                        'no' => count($subscriptions->where('is_subscribed', true))
                                    ]
                                )
                            }}
                        </div>

                        @if ($subscriptions)
                            <div class="panel-body">
                                <ul class="chatonline row">
                                    @foreach($subscriptions as $subscription)
                                        <li class="col-sm-3">
                                            <a href="javascript:void(0)">
                                                <img src="{{ $subscription->external_fields['photo_50'] }}"
                                                     alt="user-img" class="img-circle">

                                                <span>
                                                {{ $subscription->external_fields['first_name'] }}
                                                    {{ $subscription->external_fields['last_name'] }}

                                                    @if($subscription->is_subscribed)
                                                        <small class="text-success">
                                                        {{ __('subscriptions.index.is_subscribed')  }}
                                                    </small>
                                                    @endif
                                        </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
