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
  <h1>Create Archive</h1>
  {!! Form::open(['url' => 'archives']) !!}
  <div class="form-group">
    {!! Form::label('Name', 'name:') !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('Archive', 'Archive:') !!}
    {!! Form::File('archive_url', null, ['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
  </div>
  {!! Form::close() !!}
</div>
@stop