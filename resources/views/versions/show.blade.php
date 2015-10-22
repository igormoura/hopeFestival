@extends('app')
@section('content')
<div class="container">
  <h1>Version Show</h1>
  <form class="form-horizontal">
    <div class="form-group">
      <label for="image" class="col-sm-2 control-label">ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="id" value="{{$version->id}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="isbn" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" value="{{$version->name}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="isbn" class="col-sm-2 control-label">Number</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="number" value="{{$version->number}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Application</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="description" value="{{$version->application->name}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="author" class="col-sm-2 control-label">Date Create</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="date_create"  value="{{date('d/m/Y H:i:s', strtotime($version->created_at))}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="publisher" class="col-sm-2 control-label">Date Update</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="date_update" value="{{date('d/m/Y H:i:s', strtotime($version->update_at))}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a href="{{ url('versions')}}" class="btn btn-primary">Back</a>
      </div>
    </div>
  </form>
</div>
@stop