@extends('layouts.app')

@section('content')
<script>
        window.amy = {!! json_encode([
            'token' => $token['token'],
            'user_id' => $token['user_id'],
            'token_id' => $token['id'],
        ]) !!};

        window.initList = {!! json_encode($categories); !!}
</script>
<style>
input[type=text] {
    width: 100%;
}
.modal-content {
    padding: 20px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="top">
        </div>
        <div class="body" id="body">
            <div v-if="listsActive" v-bind:class="{'listsActive': listsActive}">
                <ul>
                    <templatelists v-for="list in lists" v-bind:name="list.name" v-bind:id="list.id" v-bind:key="list.name"></templatelists>
                </ul>
                <form v-on:submit="addList">
                <input type="text" placeholder="リストを追加する" v-model="newList">
                </form>

            </div>
            <div v-if="tasksActive" v-bind:class="{'tasksActive': tasksActive}">
                <div class="arrow" v-on:click="backToList">
                ←
                </div>
                <form v-on:submit="addTask">
                <input type="text" placeholder="new task" v-model="newTask">
                </form>
                <ul>
                    <templatetasks v-for="task in tasks" v-bind:name="task.name" v-bind:id="task.id" v-bind:key="task.name"></templatetasks>
                </ul>
                <form method="post" id="import" enctype="multipart/form-data">
                    <input type="file" name="import">
                    <button type="button" id="import" v-on:click="importTasks">インポート</button>
                </form>
            </div>

<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="detail-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title"></h4>
      </div>
      <div class="modal-body">
        <input type="text" id="modal-rename">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" v-on:click="renameCategory">rename</button>
        <button type="button" class="btn" v-on:click="deleteCategory">delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('script')
        <script type="text/javascript">

        </script>
@endsection
