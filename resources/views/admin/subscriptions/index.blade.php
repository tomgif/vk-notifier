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
    @include('partials.messages')

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

                        @if ($subscriptions->count())
                            <div class="panel-body">
                                <ul class="chat-online row">
                                    @foreach($subscriptions as $subscription)
                                        <li class="col-sm-3">
                                            <div class="call-chat">
                                                <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="post" style="display: inline-block;">
                                                    @csrf @method('PATCH')

                                                    <input type="hidden" name="is_subscribed" value="{{ (int)!$subscription->is_subscribed }}">

                                                    <button class="btn btn-success btn-circle btn-sm m-r-5">
                                                        @if ($subscription->is_subscribed)
                                                            <i class="fa fa-circle-o"></i>
                                                        @else
                                                            <i class="fa fa-circle"></i>
                                                        @endif
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="post" style="display: inline-block;">
                                                    @csrf @method('DELETE')

                                                    <button class="btn btn-danger btn-circle btn-sm m-r-5">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <a href="javascript:void(0)">
                                                <img src="{{ $subscription->external_fields['photo_50'] }}"
                                                     alt="user-img" class="img-circle">

                                                <span>
                                                    {{ $subscription->external_fields['first_name'] }} {{ $subscription->external_fields['last_name'] }}

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
