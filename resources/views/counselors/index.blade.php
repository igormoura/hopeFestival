@extends('app')
@section('content')
<div class="container">
 @if (Session::has('error'))
  <div class="alert alert-danger">{{ Session::get('error') }}</div>
 @elseif (Session::has('success'))
  <div class="alert alert-success">{{ Session::get('success') }}</div>
 @endif

 <h1>Conselheiros</h1>  

 {!! Form::open(array('action' => array('CounselorController@search'))) !!} 
 <div class="form-group col-md-6">
  {!! Form::label('Name', 'Nome:') !!}
  {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>
 <div class="form-group col-md-6" style="margin-top: 4px; margin-left: -12px;">
 <br />
 {!! Form::submit('Buscar', array('class'=>'btn btn-primary col-md-6')) !!}
 <div class="form-group">
  <a href="#" class="btn btn-success btn-modal-register col-md-6" style="float: right; margin-right: -15px;" data-toggle="modal" data-target="#modalCheckingCodeBar">Checking Code bar</a>
</div>
 </div>

{!! Form::close() !!}
<hr>

<table class="table table-striped table-bordered table-hover">
 <thead>
   <tr class="bg-info">
     <th>ID</th>
     <th>Nome</th>
     <th>Email</th>
     <th>Telefone</th>
     <th>Igreja</th>
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
     @if ($counselor->accreditation == 1)
      <td><a href="#" class="btn btn-warning btn-modal-checking"data-toggle="modal" data-target="#modalChecking" counselor="{{$counselor->name}}" value="{{$counselor->id}}">Checking</a></td>
     @else
      <td><a href="#" class="btn btn-success btn-modal-register"data-toggle="modal" data-target="#modalRegister" counselor="{{$counselor->name}}" value="{{$counselor->id}}">Credenciar</a></td>
     @endif
   </tr>
   @endforeach
 </tbody>
</table>
{!! $counselors->render() !!}
</div>

<!-- Modal Checking Code Bar-->
<div class="modal fade" id="modalCheckingCodeBar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Checking Code Bar</h4>
      </div>
      {!! Form::open(array('action' => array('CounselorController@checkingCodeBar'))) !!} 
      <div class="modal-body">
        <div class="form-group">
          {!! Form::label('code_bar', 'Code Bar:') !!}
          {!! Form::text('code_bar',null,['class'=>'form-control']) !!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!! Form::submit('Save', array('class'=>'btn btn-success')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Modal Register-->
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Credenciar Conselheiro</h4>
      </div>
      {!! Form::open(array('action' => array('CounselorController@register'))) !!} 
      <div class="modal-body">
        <div class="form-group">
          {!! Form::label('code_bar', 'Código de barras:') !!}
          {!! Form::text('code_bar',null,['class'=>'form-control']) !!}
          {!! Form::hidden('counselor', '', array('id' => 'counselorId')) !!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        {!! Form::submit('Credenciar', array('class'=>'btn btn-success')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Modal Checking -->
<div class="modal fade" id="modalChecking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Checking</h4>
      </div>
      {!! Form::open(array('action' => array('CounselorController@checking'))) !!} 
      <div class="modal-body">
        <div class="form-group">
          {!! Form::label('counselor_name', '', array('id' => 'counselorName')) !!}
          {!! Form::hidden('counselor', '', array('id' => 'counselorCheckingId')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('day_event', 'Dia do Evento:') !!}
          {!! Form::date('day_event', \Carbon\Carbon::now()) !!} 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        {!! Form::submit('Cheking', array('class'=>'btn btn-success')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

