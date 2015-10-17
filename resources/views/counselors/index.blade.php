@extends('app')
@section('content')
<div class="container">
 <h1>Counselors</h1>

 {!! Form::open(array('action' => array('CounselorController@search'))) !!} 
 <div class="form-group">
  {!! Form::label('Name', 'Name:') !!}
  {!! Form::text('name',null,['class'=>'form-control']) !!}
  {!! Form::submit('Search', array('class'=>'btn btn-default')) !!}
</div>
{!! Form::close() !!}
<hr>
<table class="table table-striped table-bordered table-hover">
 <thead>
   <tr class="bg-info">
     <th>Id</th>
     <th>Name</th>
     <th>Email</th>
     <th>Phone</th>
     <th>Church</th>
     <th>Pastor</th>
     <th colspan="2">Actions</th>
   </tr>
 </thead>
 <tbody>
   @foreach ($counselors as $counselor)
   <tr>
     <td>{{ $counselor->id }}</td>
     <td>{{ $counselor->name }}</td>
     <td>{{ $counselor->email }}</td>
     <td>{{ $counselor->phone_cel }}</td>
     <td>{{ $counselor->church }}</td>
     <td>{{ $counselor->pastor }}</td>
     <td><a href="{{url('counselors',$counselor->id)}}" class="btn btn-primary">Show</a></td>
     <td><a href="#" class="btn btn-success btn-modal"data-toggle="modal" data-target="#myModal" value="{{$counselor->id}}">Register</a></td>
   </tr>
   @endforeach
 </tbody>
</table>
{!! $counselors->render() !!}
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Register</h4>
      </div>
      {!! Form::open(array('action' => array('CounselorController@register'))) !!} 
      <div class="modal-body">
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
        <div class="form-group">
          {!! Form::label('code_bar', 'Code Bar:') !!}
          {!! Form::text('code_bar',null,['class'=>'form-control']) !!}
          {!! Form::hidden('counselor', '', array('id' => 'counselorId')) !!}
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {!! Form::submit('Save', array('class'=>'btn btn-primary')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

  