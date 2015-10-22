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
  <h1>Update Version</h1>
  {!! Form::model($version,['method' => 'PATCH','route'=>['versions.update',$version->id]]) !!}
  <div class="form-group">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('Number', 'Number:') !!}
    {!! Form::text('number',null,['class'=>'form-control']); !!}
  </div>
  <div class="form-group">
    {!! Form::label('Application', 'Application:') !!}
    {!! Form::select('application_id', $applications, Input::old('id'), ['class'=>'form-control']); !!}
  </div>
  <div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
  </div>
  {!! Form::close() !!}
</div>
@stop