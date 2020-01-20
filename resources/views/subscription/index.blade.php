@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Подписки на рассылку</h3>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>peer id</th>
                            <th>user id</th>
                            <th>is_subscribed</th>
                            <th>description</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->peer_id }}</td>
                        <td>{{ $subscription->user_id }}</td>
                        <td>{{ $subscription->is_subscribed }}</td>
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
