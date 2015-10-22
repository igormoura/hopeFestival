@extends('app')
@section('content')
<div class="container">
  <h1>Customer Show</h1>
  <form class="form-horizontal">
    <div class="form-group">
      <label for="image" class="col-sm-2 control-label">ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="id" value="{{$customer->id}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="isbn" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" value="{{$customer->name}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Document</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="document" value="{{$customer->document}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" value="{{$customer->email}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Phone</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="phone" value="{{$customer->phone}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Application/Version</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="version_id" value="{{$customer->version->name}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="author" class="col-sm-2 control-label">Date Create</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="date_create"  value="{{date('d/m/Y H:i:s', strtotime($customer->created_at))}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="publisher" class="col-sm-2 control-label">Date Update</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="date_update" value="{{date('d/m/Y H:i:s', strtotime($customer->updated_at))}}" readonly>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a href="{{ url('customers')}}" class="btn btn-primary">Back</a>
      </div>
    </div>
  </form>
</div>
@stop