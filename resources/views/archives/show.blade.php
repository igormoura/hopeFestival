@extends('app')
@section('content')
<div class="container">
  <h1>Archive Show</h1>
  <form class="form-horizontal">
    <div class="form-group">
      <label for="image" class="col-sm-2 control-label">ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="id" value="{{$archive->id}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="isbn" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" value="{{$archive->name}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">Archive URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="archive_url" value="{{$archive->archive_url}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="author" class="col-sm-2 control-label">Date Create</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="date_create"  value="{{date('d/m/Y H:i:s', strtotime($archive->created_at))}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="publisher" class="col-sm-2 control-label">Date Update</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="date_update" value="{{date('d/m/Y H:i:s', strtotime($archive->updated_at))}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a href="{{ url('archives')}}" class="btn btn-primary">Back</a>
      </div>
    </div>
  </form>
</div>
@stop