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
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{ __('subscriptions.peer_id') }}</th>
                            <th class="text-center">{{ __('subscriptions.user_id') }}</th>
                            <th class="text-center">{{ __('subscriptions.is_subscribed') }}</th>
                            <th class="text-center">{{ __('subscriptions.description') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->peer_id }}</td>
                        <td>{{ $subscription->user_id }}</td>
                        <td>
                            @if ($subscription->is_subscribed)
                                <i class="text-primary fa fa-circle"></i>
                            @else
                                <i class="text-danger fa fa-circle-o"></i>
                            @endif
                        </td>
                        <td class="txt-oflo">{{ $subscription->description }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
