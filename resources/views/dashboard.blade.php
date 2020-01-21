@extends('layouts.app')

@section('page-title')
    Панель управления
@endsection

@section('content')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="panel">
            <div class="sk-chat-widgets">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Последние рассылки
                    </div>

                    <div class="panel-body">
                        <ul class="chatonline">
                            <li>
                                <div class="call-chat">
                                    <button class="btn btn-success btn-circle btn-lg" type="button">
                                        <i class="fa fa-phone"></i>
                                    </button>

                                    <button class="btn btn-info btn-circle btn-lg" type="button">
                                        <i class="fa fa-comments-o"></i>
                                    </button>
                                </div>

                                <a href="javascript:void(0)">
                                    <img src="{{ asset('ample/images/logo.png') }}" alt="user-img" class="img-circle">
                                    <span>Varun Dhavan <small class="text-success">online</small></span>
                                </a>
                            </li>

                            <li>
                                <div class="call-chat">
                                    <button class="btn btn-success btn-circle btn-lg" type="button">
                                        <i class="fa fa-phone"></i>
                                    </button>

                                    <button class="btn btn-info btn-circle btn-lg" type="button">
                                        <i class="fa fa-comments-o"></i>
                                    </button>
                                </div>

                                <a href="javascript:void(0)">
                                    <img src="{{ asset('ample/images/logo.png') }}" alt="user-img" class="img-circle">
                                    <span>Genelia Deshmukh <small class="text-warning">Away</small></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
