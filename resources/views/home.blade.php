@extends('layouts.app')

@section('content')
<div class="container">
    <div class="list">
    <div class="list-header">
        <a href="javascript:void(0);"><span><i class="fa fa-bars" aria-hidden="true"></i></span></a>
        <div>search-box</div>
        <a href="javascript:void(0);"><span><i class="fa fa-search" aria-hidden="true"></i></span></a>
    </div>
    <div class="list-body">
        <div>
            <span><i class="fa fa-bell-o" aria-hidden="true"></i></span>
        </div>
        <div>
            <ul></ul>
        </div>
    </div>
    </div>
    <div class="main">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
