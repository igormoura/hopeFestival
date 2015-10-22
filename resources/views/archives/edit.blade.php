@extends('app')
@section('content')
<div class="container">
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <h1>Update Archive</h1>
  {!! Form::model($archive,['method' => 'PATCH','route'=>['archives.update',$archive->id]]) !!}
  <div class="form-group">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('Archive URL', 'Archive URL:') !!}
     {!! Form::File('archive_url',null,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@stop