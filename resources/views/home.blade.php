@extends('layouts.app')

@section('content')
<script>
        window.amy = {!! json_encode([
            'user_id' => $user['user_id']
        ]) !!};

        window.initList = {!! json_encode($categories); !!};
        window.initTask = {!! json_encode($tasks); !!}
        window.initCompletedTask = {!! json_encode($completed_tasks); !!}
        window.initDetail= {!! json_encode($detail); !!}
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
