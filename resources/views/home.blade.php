@extends('layouts.app')

@section('content')
<script>
        window.amy = {!! json_encode([
            'token' => $token['token'],
            'user_id' => $token['user_id'],
            'token_id' => $token['id'],
        ]) !!};

        window.initList = {!! json_encode($categories); !!};
        window.initTask = {!! json_encode($tasks); !!}
</script>
<style>
.modal-content {
    padding: 20px;
}
</style>
<div class="amy-main" id="body">
    <templateamy></templateamy>
</div>
@endsection

@section('script')
        <script type="text/javascript">
        </script>
@endsection
