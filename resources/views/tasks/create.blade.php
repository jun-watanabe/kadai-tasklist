@extends('layouts.app')

@section('content')

            
    <div class="row">
       <div class= 'col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3'>
       
            {!! Form::model($task, ['route' => 'tasks.store']) !!}
                
                <h1>タスク新規作成ページ</h1>
                
                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                    
                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
        
            {!! Form::close() !!}
       </div>
    </div>
            

@endsection