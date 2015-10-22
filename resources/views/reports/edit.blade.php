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
  <h1>Update Customer</h1>
  {!! Form::model($customer,['method' => 'PATCH','route'=>['customers.update',$customer->id]]) !!}
  <div class="form-group">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('Document', 'Document:') !!}
    {!! Form::text('document',null,['class'=>'form-control customer-document']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email',null,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('Phone', 'Phone:') !!}
    {!! Form::text('phone',null,['class'=>'form-control customer-phone']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('Application/Version', 'Application/Version:') !!}
    {!! Form::select('version_id', $applications_version, Input::old('id'), ['class'=>'form-control']); !!}
  </div>
<div class="form-group">
  {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
</div>
@stop