@extends('layouts.app')

@section('content')

<h1>id = {{ $task->id }} のタスク詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $task->status }}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $task->content }}</td>
        </tr>
    </table>

    <form action="{{asset('/tasks/edit/'.$task->id)}}" method="get">
        @csrf
        <input type="submit" class="btn btn-light" name="{{$task->id}}" value="このタスクを編集">
    </form>


    <form action="{{asset('/tasks/destroy/'.$task->id)}}" method="get">
        @csrf
        <input type="submit" class="btn btn-danger" name="{{$task->id}}" value="削除">
    </form>

@endsection