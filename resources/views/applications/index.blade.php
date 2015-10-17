@extends('app')
@section('content')
<div class="container">
 <h1>Applications</h1>
 <a href="{{url('/applications/create')}}" class="btn btn-success">Create Application</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
   <thead>
     <tr class="bg-info">
       <th>Id</th>
       <th>Name</th>
       <th>Description</th>
       <th>Versions</th>
       <th colspan="3">Actions</th>
     </tr>
   </thead>
   <tbody>
   @foreach ($applications as $application)
     <tr>
       <td>{{ $application->id }}</td>
       <td>{{ $application->name }}</td>
       <td>{{ $application->description }}</td>
       <td class="versions">@foreach ($application->versions as $version)
            <p class="p-table">{{ $version->name }}</p>
            @endforeach
       </td>
       <td><a href="{{url('applications',$application->id)}}" class="btn btn-primary">Show</a></td>
       <td><a href="{{route('applications.edit',$application->id)}}" class="btn btn-warning">Edit</a></td>
       <td>
       {!! Form::open(['method' => 'DELETE', 'route'=>['applications.destroy', $application->id]]) !!}
       {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
       {!! Form::close() !!}
       </td>
     </tr>
   @endforeach
   </tbody>
  </table>
</div>
@endsection


