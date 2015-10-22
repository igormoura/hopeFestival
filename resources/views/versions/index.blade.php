@extends('app')
@section('content')
<div class="container">
 <h1>Versions</h1>
 <a href="{{url('/versions/create')}}" class="btn btn-success">Create Version</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
   <thead>
     <tr class="bg-info">
       <th>Id</th>
       <th>Name</th>
       <th>Number</th>
       <th>Application</th>
       <th colspan="3">Actions</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($versions as $version)
     <tr>
       <td>{{ $version->id }}</td>
       <td>{{ $version->name }}</td>
       <td>{{ $version->number }}</td>
       <td>{{ $version->application->name }}</td>
       <td><a href="{{url('versions',$version->id)}}" class="btn btn-primary">Show</a></td>
       <td><a href="{{route('versions.edit',$version->id)}}" class="btn btn-warning">Edit</a></td>
       <td>
         {!! Form::open(['method' => 'DELETE', 'route'=>['versions.destroy', $version->id]]) !!}
         {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
         {!! Form::close() !!}
       </td>
     </tr>
     @endforeach
   </tbody>
 </table>
</div>
@endsection