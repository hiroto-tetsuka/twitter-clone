@extends('layouts.app')

@section('content')

<h1>タスク新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            
            {!! Form::model($task, ['route' => 'tasks.store']) !!}
            @csrf

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    {!! Form::label('status', 'タイトル:') !!}
                    @csrf
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                    @csrf
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    @csrf
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                    @csrf
                </div>

                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection