@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                                <div class="top-right links">
                                    @auth
                                        <a href="{{ route('users.index') }}">Use Listing</a>
                                    @else
                                        <a href="{{ route('login') }}">Login</a>
                                        <a href="{{ route('register') }}">Register</a>
                                    @endauth
                                </div>
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
