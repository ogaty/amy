@extends('layouts.app')

@section('content')
<div class="ui aligned center aligned grid">
    <div class="column" style="max-width: 450px">
        <h2 class="ui violet header">
            <div class="content">
            Login
            </div>
        </h2>
        <form class="ui large form" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
            @if ($errors->has('email'))
            <div class="ui error message">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
            @endif
            <div class="uifluid large submit button">
            <button type="submit" class="btn btn-primary">
                                    Login
            </button>
            </div>
            </div>
        </form>
    </div>
</div>

@endsection
