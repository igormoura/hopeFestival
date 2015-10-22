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
  <h1>Update Application</h1>
  {!! Form::model($application,['method' => 'PATCH','route'=>['applications.update',$application->id]]) !!}
  <div class="form-group">
      {!! Form::label('Name', 'Name:') !!}
      {!! Form::text('name',null,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
      {!! Form::label('Description', 'Description:') !!}
      {!! Form::text('description',null,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
      {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@stop